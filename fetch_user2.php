<?php
// Start the session


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

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Query to fetch child's name, child's age, and parent's age
        $query = "SELECT child_name, child_age, parent_age FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $child_name = $data['child_name'];
            $child_age = $data['child_age'];
            $parent_age = $data['parent_age'];
        } else {
            echo "Error: User data not found";
            exit;
        }
    }else {
        echo "Error: No user session found";
        exit;
    }
?>