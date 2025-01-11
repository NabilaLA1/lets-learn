<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "letterland";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed");
}

// Check if POST data is valid
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['correct_option'])) {
    $questionId = intval($_POST['id']);
    $selectedOption = intval($_POST['correct_option']);

    // Fetch the correct option for the given question
    $stmt = $conn->prepare("SELECT correct_option FROM hausaquiz_questions WHERE id = ?");
    $stmt->bind_param("i", $questionId);
    $stmt->execute();
    $stmt->bind_result($correct_option);
    $stmt->fetch();
    $stmt->close();

    // Check if the selected option matches the correct option
    if ($correct_option) {
        echo $selectedOption === $correct_option ? "Correct! Well done." : "Oops! That’s not correct.";
    } else {
        echo "Invalid question ID.";
    }
} else {
    echo "Invalid request.";
}

// Close connection
$conn->close();
?>
