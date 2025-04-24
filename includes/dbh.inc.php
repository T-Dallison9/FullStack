<?php

$host = 'localhost';
$dbname = 'skewerhouse';
$dbusername = 'root';
$dbpassword = '';

try {
    //Establishing connection with the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    //Error handling
    die("Connection failed: " . $e->getMessage());
}