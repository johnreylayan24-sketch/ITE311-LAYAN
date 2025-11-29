<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lms_layan';
$port = 3306;

// Create connection
$mysqli = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
echo "Connected successfully to MySQL!";
