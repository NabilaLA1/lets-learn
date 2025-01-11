<?php
// Start the session
session_start();

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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $conn->real_escape_string($_POST['email']);
    $number = $conn->real_escape_string($_POST['number']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO messages (name, email, number, message) VALUES ('$name', '$email', '$number', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        // Store success message in session
        $_SESSION['feedback'] = "Message sent successfully!";
        $_SESSION['feedback_type'] = "success";
    } else {
        // Store error message in session
        $_SESSION['feedback'] = "Error: " . $conn->error;
        $_SESSION['feedback_type'] = "error";
    }

    // Redirect back to the main page
    header("Location: landingpage.php");
    exit;

}
    $conn->close();
?>