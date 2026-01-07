<?php
require __DIR__ . '/vendor/autoload.php';

$pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '1234');
$pdo->exec('CREATE DATABASE IF NOT EXISTS posyandu_kelompok8');
echo "Database posyandu_kelompok8 berhasil dibuat!\n";
?>
