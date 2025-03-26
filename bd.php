<?php
$localhost = "localhost";
$username = "mathias";
$password = "mj180205";
$database = "cinema";

try {
    $pdo = new PDO("mysql:host=$localhost;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
