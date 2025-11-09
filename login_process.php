<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evara_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form data and handle potential undefined keys
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
} else {
    echo "Form data not received.";
    exit();
}

// Validate role selection
if ($role == 'null') {
    echo "Please select a role.";
    exit();
}

// Check if the user exists in the database
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND role=?");
$stmt->bind_param("ss", $username, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $row['password'])) {
        // Store session variables
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        // Redirect to the appropriate dashboard
        if ($role == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
