<?php
// Simulate user retrieval from database
session_start();
$name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "....."; // Replace with actual database logic
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Selection</title>
    <link rel="stylesheet" href="assets/css/language.css">
</head>
<body>
    <div class="wrapper">
        <div class="welcome-message">
            <h1>Welcome Back, <span class="name"><?php echo $name; ?>!</span></h1>
            <audio id="welcomeAudio">
                <source src="welcome_audio.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
        <h2>Select a Language to Learn</h2>
        <div class="language-container">
            <div class="language-wrapper">
                <div class="language-box" id="hausaBox" onclick="redirectToPage('hausa')">
                    <img src="assets/images/Hausa.jpeg" alt="Hausa Language">
                </div>
                <p>Hausa</p>
            </div>
            <div class="language-wrapper">
                <div class="language-box" id="arabicBox" onclick="redirectToPage('arabic')">
                    <img src="assets/images/Arabic.jpeg" alt="Arabic Language">
                </div>
                <p>Arabic</p>
            </div>
        </div>
    </div>
    <script>
        function redirectToPage(language) {
            if (language === 'hausa') {
                window.location.href = 'hausa.php'; // Redirect to Hausa page
            } else if (language === 'arabic') {
                window.location.href = 'arabic.php'; // Redirect to Arabic page
            }
        }
    </script>

</body>
</html>
