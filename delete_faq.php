<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "evara_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the FAQ ID is provided
if (isset($_GET['id'])) {
    $faq_id = intval($_GET['id']); // Ensure the ID is an integer

    // Delete the FAQ from the database
    $sql = "DELETE FROM faqs WHERE faq_id = $faq_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('FAQ deleted successfully!'); window.location.href='admin_faq_management.php';</script>";
    } else {
        echo "Error deleting FAQ: " . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit();
}

$conn->close();
?>
