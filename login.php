<?php
session_start();

// Database connection
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "tnpothole";

$conn = mysqli_connect($server_name, $username, $password, $database_name);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle login
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM user WHERE emailid = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Verify the password (assuming the password is hashed in the database)
            if (password_verify($password, $user['password'])) {
                $_SESSION["emailid"] = $email; // Set session variable
                header("Location: sample.html"); // Redirect to home page
                exit;
            } else {
                echo "Invalid login credentials.";
            }
        } else {
            echo "Invalid login credentials.";
        }

        $stmt->close();
    }

    // Handle signup
    if (isset($_POST['save'])) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $district = $_POST['district'];

        // Check if passwords match
        if ($password !== $confirm_password) {
            echo "Passwords do not match.";
            exit;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO user (emailid, name, password, district) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $name, $hashed_password, $district);

        if ($stmt->execute()) {
            echo "Registration successful!";
            // Optionally, redirect to login or login automatically
            $_SESSION["emailid"] = $email; // Set session variable for auto-login
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
