<?php
$dbHost = 'localhost';
$dbName = 'blog';
$dbUserName = 'root';
$dbPassword = '';
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";

$pdo = new PDO($dsn, $dbUserName, $dbPassword, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);  
?>