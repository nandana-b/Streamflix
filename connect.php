<?php
// Database connection parameters
$host = "localhost";
$user = "root";
$pass = "";
$db = "myLogin";

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    // Output error message if connection fails
    die("Failed to connect to the database: " . $conn->connect_error);
}

?>
