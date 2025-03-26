<?php
// config/config.php

$host = 'localhost';
$db   = 'crm_system';
$user = 'root';
$pass = '';  // or your MySQL password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Handle connection error (e.g., log it or display a friendly message)
    die('Database connection failed: ' . $e->getMessage());
}

?>