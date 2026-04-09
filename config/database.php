<?php
/**
 * Configuración de conexión a la base de datos usando PDO
 * Librería Luz Divina
 */

$host = 'localhost';
$dbname = 'libreria';
$username = 'root';
$password = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('<div class="alert alert-danger text-center mt-5">Error de conexión a la base de datos: ' . $e->getMessage() . '</div>');
}
