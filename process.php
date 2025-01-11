<?php
// Start the session
session_start();

// Step 1: Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "letterland";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 3: Sanitize and validate user inputs
    $child_name = htmlspecialchars(trim($_POST['child_name'])); // Sanitize the child's name
    $child_age = filter_var($_POST['child_age'], FILTER_SANITIZE_NUMBER_INT); // Sanitize the child's age
    $parent_age = filter_var($_POST['parent_age'], FILTER_SANITIZE_NUMBER_INT); // Sanitize the parent's age

    // Validate inputs (basic checks)
    if (empty($child_name) || empty($child_age) || empty($parent_age)) {
        die("All fields are required. Please go back and fill out the form.");
    }

    if (!is_numeric($child_age) || $child_age <= 0) {
        die("Invalid child age. Please enter a positive number.");
    }

    if (!is_numeric($parent_age) || $parent_age <= 0) {
        die("Invalid parent age. Please enter a positive number.");
    }

    // Step 4: Insert data into the database
    $stmt = $conn->prepare("INSERT INTO users (child_name, child_age, parent_age) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $child_name, $child_age, $parent_age);

    if ($stmt->execute()) {
        // Step 5: Store user ID in session and redirect to language.php
        $_SESSION['user_id'] = $stmt->insert_id; // Store the newly created user ID in session
        header("Location: language.php");
        exit;
    } else {
        die("Error: " . $stmt->error);
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
