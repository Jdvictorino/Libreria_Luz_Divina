<?php
/**
 * Verificación de Status del Proyecto
 * Librería Luz Divina
 */

echo "========================================\n";
echo "VERIFICACIÓN DEL PROYECTO - Librería Luz Divina\n";
echo "========================================\n\n";

// 1. Verificar conexión BD
echo "[1] Verificando conexión a Base de Datos...\n";
try {
    require_once 'config/database.php';
    
    // Verificar tablas
    $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
    echo "    ✓ Conectado a MySQL\n";
    echo "    ✓ Tablas encontradas: " . count($tables) . "\n";
    
    foreach($tables as $table) {
        $count = $pdo->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
        echo "      • $table: " . (int)$count . " registros\n";
    }
} catch (Exception $e) {
    echo "    ✗ ERROR: " . $e->getMessage() . "\n";
}

echo "\n[2] Verificando estructura de archivos...\n";
$archivos = [
    'index.php' => 'Página de libros',
    'autores.php' => 'Página de autores',
    'contacto.php' => 'Página de contacto',
    'procesar_contacto.php' => 'Procesador de contacto',
    'config/database.php' => 'Configuración BD',
    'includes/header.php' => 'Encabezado',
    'includes/footer.php' => 'Pie de página',
    'css/styles.css' => 'Estilos',
    'js/main.js' => 'JavaScript',
];

foreach($archivos as $ruta => $desc) {
    $existe = file_exists($ruta);
    $marca = $existe ? '✓' : '✗';
    echo "    $marca $desc ($ruta)\n";
}

echo "\n[3] Resumen de configuración...\n";
echo "    • Base de datos: libreria\n";
echo "    • Usuario: root\n";
echo "    • Host: localhost\n";
echo "    • Charset: utf8mb4\n\n";

echo "========================================\n";
echo "VERIFICACIÓN COMPLETADA\n";
echo "========================================\n";
echo "\nPróximos pasos:\n";
echo "1. Importar la base de datos 'Base Datos Libreria.sql'\n";
echo "2. Ejecutar 'sql_contacto.sql' para crear tabla de contacto\n";
echo "3. Acceder a http://localhost/libreria/ en el navegador\n";
echo "4. Probar las funcionalidades: libros, autores, contacto\n";
