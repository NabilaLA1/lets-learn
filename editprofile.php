<?php
// Include session check to ensure the user is logged in
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Fetch current user details
include 'fetch_user2.php'; // Use the existing backend to get user details
// Check for feedback messages
if (!empty($_SESSION['feedback'])) : ?>
    <div class="feedback-overlay"></div>
    <div class="feedback-box <?php echo $_SESSION['feedback_type']; ?>">
        <span class="icon">
            <?php echo $_SESSION['feedback_type'] === 'success' ? 
                '<i class="fa-solid fa-check" style="color: #05c21b;"></i>' : 
                '<i class="fa-solid fa-xmark" style="color: #ff000d;"></i>'; ?>
        </span>
        <p><?php echo $_SESSION['feedback']; ?></p>
        <button onclick="closeFeedback()">Close</button>
    </div>
    <?php
    // Clear the feedback message after displaying it
    unset($_SESSION['feedback']);
    unset($_SESSION['feedback_type']);
    ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="assets/css/editprofile.css"> 
    <script src="https://kit.fontawesome.com/d09b6df77f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <!-- Back Button -->
        <button class="back-btn" onclick="navigateBack()">
        <i class="fa-solid fa-arrow-left"></i><p> Back</p>
        </button>
        <!-- Title -->
        <h2 class="edit-header">Edit Profile</h2>
        <form id="edit-form" action="process_edit.php" method="POST">
            <!-- Child's Name -->
            <label for="child_name">Child's Name</label>
            <div class="input-group">
                <input type="text" id="child_name" name="child_name" value="<?php echo htmlspecialchars($child_name); ?>" required>
                <i class="fa-solid fa-pen"></i>
            </div>
            
            <!-- Child's Age -->
            <label for="child_age">Child's Age</label>
            <div class="input-group">
                <input type="number" id="child_age" name="child_age" value="<?php echo htmlspecialchars($child_age); ?>" required>
                <i class="fa-solid fa-pen"></i>
            </div>
            
            <!-- Parent's Age -->
            <label for="parent_age">Parent's Age</label>
            <div class="input-group">
                <input type="number" id="parent_age" name="parent_age" value="<?php echo htmlspecialchars($parent_age); ?>" required>
                <i class="fa-solid fa-pen"></i>
            </div>
            
            <!-- Update and Delete Buttons -->
            <div class="button-group">
                <button type="submit" name="update" class="update-button">Update Changes</button>
                <button type="button" onclick="confirmDelete()" class="delete-button">Delete Account</button>
            </div>
        </form>
    </div>
    <div id="delete-popup" class="confirmation-popup">
    <div class="popup-content">
        <p>Are you sure you want to delete your account? This action is irreversible.</p>
        <div class="popup-buttons">
            <button onclick="proceedDelete()" class="confirm-button">Yes, Delete</button>
            <button onclick="closeDeletePopup()" class="cancel-button">Cancel</button>
        </div>
    </div>
</div>
<div id="overlay" class="overlay"></div>
    <script>
        function navigateBack() {
            window.history.back();
        }
                function confirmDelete() {
            // Display the pop-up and overlay
            document.getElementById("delete-popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closeDeletePopup() {
            // Close the pop-up and overlay
            document.getElementById("delete-popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }

        function proceedDelete() {
            // Redirect to the delete account PHP script
            window.location.href = "delete_account.php";
        }
        function closeFeedback() {
        window.location.reload();
        }
    </script>
</body>
</html>
