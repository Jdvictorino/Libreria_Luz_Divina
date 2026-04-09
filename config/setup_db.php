<?php
/**
 * Importar base de datos usando PDO con emulación de prepares
 */
$host = 'localhost';
$username = 'root';
$password = '';

echo "=== Importando Base de Datos Librería ===\n\n";

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true,
    ]);
    echo "[OK] Conectado a MySQL.\n";
} catch (PDOException $e) {
    die("[ERROR] " . $e->getMessage() . "\n");
}

// Crear BD
$pdo->exec("CREATE DATABASE IF NOT EXISTS `libreria` DEFAULT CHARACTER SET utf8mb4");
$pdo->exec("USE `libreria`");
echo "[OK] Base de datos 'libreria' lista.\n";

// Leer SQL
$sqlFile = __DIR__ . '/db/Base Datos Libreria.sql';
$sql = file_get_contents($sqlFile);
echo "[OK] Archivo leído (" . strlen($sql) . " bytes).\n";

// Limpiar comentarios y líneas vacías, ejecutar sentencia por sentencia
$lines = explode("\n", $sql);
$statement = '';
$executed = 0;
$errors = 0;

foreach ($lines as $line) {
    $trimmed = trim($line);
    // Ignorar comentarios y líneas vacías
    if (empty($trimmed) || strpos($trimmed, '--') === 0) {
        continue;
    }
    $statement .= ' ' . $trimmed;
    
    // Si la línea termina con ;, ejecutar la sentencia
    if (substr($trimmed, -1) === ';') {
        $statement = trim($statement);
        if (!empty($statement)) {
            try {
                $pdo->exec($statement);
                $executed++;
            } catch (PDOException $e) {
                // Solo reportar errores que no sean "tabla ya existe"
                if (strpos($e->getMessage(), '1050') === false && strpos($e->getMessage(), '1007') === false) {
                    $errors++;
                    if ($errors <= 5) {
                        echo "[AVISO] " . substr($e->getMessage(), 0, 100) . "\n";
                    }
                }
            }
        }
        $statement = '';
    }
}

echo "[OK] $executed sentencias ejecutadas";
if ($errors > 0) echo " ($errors errores)";
echo ".\n";

// Crear tabla contacto
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `contacto` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `fecha` DATETIME NOT NULL,
        `correo` VARCHAR(150) NOT NULL,
        `nombre` VARCHAR(100) NOT NULL,
        `asunto` VARCHAR(200) NOT NULL,
        `comentario` TEXT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo "[OK] Tabla 'contacto' creada.\n";
} catch (PDOException $e) {
    echo "[AVISO] contacto: " . $e->getMessage() . "\n";
}

// Verificar
echo "\n=== Tablas en 'libreria' ===\n";
$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
foreach ($tables as $t) {
    $c = $pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
    echo "  $t: $c registros\n";
}

echo "\n[LISTO] Base de datos configurada.\n";
