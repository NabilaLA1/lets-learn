<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to index.php if no session exists (user not logged in)
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

// Retrieve user details using the session user ID
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT child_name FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the user's child name
    $row = $result->fetch_assoc();
    $child_name = $row['child_name'];
} else {
    // If user not found, destroy session and redirect to index.php
    session_destroy();
    header("Location: index.php");
    exit;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
