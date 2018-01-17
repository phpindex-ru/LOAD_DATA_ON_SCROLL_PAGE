<?php
//DB details
$dbHost = 'localhost';
$dbUsername = 'homestead';
$dbPassword = 'secret';
$dbName = '';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
} 
?>
