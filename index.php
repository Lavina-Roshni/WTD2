<?php
$conn = mysqli_connect("db", "root", "root", "tnpothole"); // Use actual database name

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
