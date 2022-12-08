<?php
require_once('config.php');

$dns = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    $conn = new PDO($dns, $user, $password, $options);

    if ($conn) {
        // echo "Success connect!";
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}