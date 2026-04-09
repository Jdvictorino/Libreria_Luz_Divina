<?php
$pdo = new PDO('mysql:host=localhost;dbname=libreria;charset=utf8mb4','root','');
$tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
echo "Tablas encontradas: " . count($tables) . "\n";
foreach($tables as $t) {
    $c = $pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
    echo "  $t: $c registros\n";
}
