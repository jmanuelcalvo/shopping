<?php
// Database configuration
$dbHost     = "mysql1.carrito.svc.cluster.local";
$dbUsername = "spuser";
$dbPassword = "mypa55";
$dbName     = "shopping";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
