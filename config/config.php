<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "banhaisan";

// Create connection
$connectMySql = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connectMySql->connect_error) {
    die("Connection failed: " . $connectMySql->connect_error);
}
// Perform database operations here

// Close connection

?>