<?php
// Database configuration
$dbHost     = getenv('DB_HOST');
//$dbHost     = "mysql.carrito.svc.cluster.local";
$dbUsername = getenv('DB_USERNAME');
//$dbPassword = "mypa55";
$dbPassword = getenv('DB_PASSWD');
//$dbName     = "shopping";
$dbName     = getenv('DB_NAME');

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
