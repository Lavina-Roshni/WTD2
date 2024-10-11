<?php
// Database connection
$conn = new mysqli("localhost", "username", "password", "tnpothole"); // Update with your credentials

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select all complaints
$query = "SELECT * FROM complaint";
$result = $conn->query($query);

// Start HTML output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reported Potholes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .complaint-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .complaint-container h3 {
            margin-top: 0;
        }
        .complaint-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Reported Potholes</h2>

<?php
// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='complaint-container'>";
        echo "<h3>Description: " . htmlspecialchars($row['description']) . "</h3>";
        echo "<p>Location: (" . htmlspecialchars($row['latitude']) . ", " . htmlspecialchars($row['longitude']) . ")</p>";

        // Check if there are images
        if ($row['images']) {
            $images = explode(', ', $row['images']);
            foreach ($images as $image) {
                echo "<img src='" . htmlspecialchars($image) . "' class='complaint-image' alt='Pothole Image' />";
            }
        }

        echo "<p>Email: " . htmlspecialchars($row['emailid']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No complaints reported.</p>";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
