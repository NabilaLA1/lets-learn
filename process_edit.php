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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Sanitize input data
    $child_name = htmlspecialchars(trim($_POST['child_name']));
    $child_age = intval($_POST['child_age']);
    $parent_age = intval($_POST['parent_age']);
    $user_id = $_SESSION['user_id'];

    // Update query
    $stmt = $conn->prepare("UPDATE users SET child_name = ?, child_age = ?, parent_age = ? WHERE id = ?");
    $stmt->bind_param("siii", $child_name, $child_age, $parent_age, $user_id);

    if ($stmt->execute()) {
        // Success message
        $_SESSION['feedback'] = "Profile updated successfully!";
        $_SESSION['feedback_type'] = "success";
    } else {
        // Error message
        $_SESSION['feedback'] = "Error updating profile. Please try again.";
        $_SESSION['feedback_type'] = "error";
    }

    // Redirect back to the profile editing page
    header("Location: editprofile.php");
    exit;
}

$conn->close();
?>
