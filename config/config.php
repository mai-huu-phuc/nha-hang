<?php

ini_set('session.gc_maxlifetime', 3600);

// Đặt thời gian sống của cookie để khớp với thời gian chờ session
ini_set('session.cookie_lifetime', 3600);
session_start();

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