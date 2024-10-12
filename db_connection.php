<?php
$servername = "db"; // or your server name
$username = "newuser"; // your database username
$password = "root"; // your database password
$dbname = "tnpothole"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
