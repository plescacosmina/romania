<?php
//DB details
$dbHost = 'localhost';
$dbPDOdsn = 'mysql:host=localhost;dbname=romania';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'romania';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
}

try {
    $dbPDO = new PDO($dbPDOdsn, $dbUsername, $dbPassword);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}