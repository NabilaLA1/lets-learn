<?php
session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate form inputs
    $child_name = htmlspecialchars(trim($_POST['child_name'])); // Sanitize child name
    $child_age = (int) $_POST['child_age']; // Convert age to integer
    $parent_age = (int) $_POST['parent_age']; // Convert age to integer

    // Basic validation
    if (empty($child_name) || $child_age <= 0 || $parent_age <= 0) {
        // If validation fails, redirect back to the form with an error message
        $_SESSION['error'] = "Please fill out the form correctly.";
        header("Location: index.php"); // Replace with your form's filename if it's different
        exit();
    }

    // Store child's name in session for the welcome message
    $_SESSION['child_name'] = $child_name;

    // Redirect to the language selection page
    header("Location: language.php");
    exit();
} else {
    // If accessed directly, redirect back to the form
    header("Location: index.php"); // Replace with your form's filename if it's different
    exit();
}
