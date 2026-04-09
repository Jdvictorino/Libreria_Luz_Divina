<?php
/**
 * Procesar formulario de contacto
 * Librería Luz Divina
 */
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y validar datos
    $nombre     = trim(htmlspecialchars($_POST['nombre'] ?? ''));
    $correo     = trim(filter_var($_POST['correo'] ?? '', FILTER_SANITIZE_EMAIL));
    $asunto     = trim(htmlspecialchars($_POST['asunto'] ?? ''));
    $comentario = trim(htmlspecialchars($_POST['comentario'] ?? ''));
    $fecha      = date('Y-m-d H:i:s');

    // Validaciones del lado del servidor
    $errores = [];

    if (empty($nombre) || strlen($nombre) < 2) {
        $errores[] = 'El nombre es obligatorio y debe tener al menos 2 caracteres.';
    }
    if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Debes ingresar un correo electrónico válido.';
    }
    if (empty($asunto) || strlen($asunto) < 3) {
        $errores[] = 'El asunto es obligatorio y debe tener al menos 3 caracteres.';
    }
    if (empty($comentario) || strlen($comentario) < 10) {
        $errores[] = 'El comentario es obligatorio y debe tener al menos 10 caracteres.';
    }

    if (!empty($errores)) {
        header('Location: contacto.php?error=1');
        exit;
    }

    try {
        // Insertar en la tabla contacto usando PDO
        $sql = "INSERT INTO contacto (fecha, correo, nombre, asunto, comentario) 
                VALUES (:fecha, :correo, :nombre, :asunto, :comentario)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fecha'      => $fecha,
            ':correo'     => $correo,
            ':nombre'     => $nombre,
            ':asunto'     => $asunto,
            ':comentario' => $comentario,
        ]);

        header('Location: contacto.php?success=1');
        exit;
    } catch (PDOException $e) {
        header('Location: contacto.php?error=1');
        exit;
    }
} else {
    // Si no es POST, redirigir al formulario
    header('Location: contacto.php');
    exit;
}
