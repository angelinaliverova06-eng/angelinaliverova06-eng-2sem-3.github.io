<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db   = 'angelinaliverova_db';
$user = 'phpuser';
$pass = 'phpuser';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Подключение успешно!";
} catch (PDOException $e) {
    echo "❌ Ошибка: " . $e->getMessage();
    exit;
}
?>
