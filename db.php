<?php
$servername = "localhost";  // or 127.0.0.1
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "student_library1";  // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
