<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "letterland";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete user account
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    // Destroy session and redirect to index.php
    session_destroy();
    header("Location: index.php");
    exit;
} else {
    // Error message
    $_SESSION['error'] = "Error deleting account. Please try again.";
    header("Location: editprofile.php");
    exit;
}

$stmt->close();
$conn->close();
?>
