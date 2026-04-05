<?php
$host = 'db';          // Docker service name
$db   = 'dbfdb';       // New DB name
$user = 'dbfuser';     // New user
$pass = 'dbfpass';     // New password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
