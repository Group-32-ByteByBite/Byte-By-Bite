<?php
// Database configuration
$servername = "faure";
$username = "your_EID"; // Replace with your EID
$password = "your_password"; // Replace with your Student ID number unless you changed it
$dbname = "your_EID"; // Replace with your EID
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
