<?php
// db_connection.php
$servername = "db"; // Update if needed
$username = "newuser"; // Update if needed
$password = "root"; // Update if needed
$dbname = "tnpothole"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// complaint.php
require 'db_connection.php'; // Ensure this file is correctly included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'];
    $emailid = 'user@example.com'; // Change to the actual logged-in user's email

    // Handle image upload
    $images = '';
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $uploadsDir = 'uploads/';
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $filename = $_FILES['images']['name'][$key];
            $filepath = $uploadsDir . basename($filename);
            move_uploaded_file($tmp_name, $filepath);
            $images .= $filepath . ', '; // Store paths in a string
        }
        $images = rtrim($images, ', '); // Remove trailing comma
    }

    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO complaint (latitude, longitude, description, images, emailid) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $latitude, $longitude, $description, $images, $emailid);

    if ($stmt->execute()) {
        // Redirect to display page after successful submission
        header("Location: reported.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
