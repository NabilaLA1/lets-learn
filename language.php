<?php include 'fetchuser.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Selection</title>
    <link rel="stylesheet" href="assets/css/language.css">
    <script src="https://kit.fontawesome.com/d09b6df77f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <div class="top-section">
            <div class="welcome-message">
                <h1>Hello, <span class="name"><?php echo htmlspecialchars($child_name); ?>!</span></h1>
                <audio id="welcomeAudio">
                    <source src="welcome_audio.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
            <div class="top-right-buttons">
                <button class="circle-button" onclick="redirectToPage('quiz_score')">
                <i class="fa-solid fa-list-check"></i>
                </button>
                <button class="circle-button" onclick="redirectToPage('editprofile')">
                    <i class="fa-solid fa-gear"></i>
                </button>
            </div>
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
       function redirectToPage(page) {
            if (page === 'hausa') {
                window.location.href = 'hausa.php'; //hausa page
            } else if (page === 'arabic') {
                window.location.href = 'arabic.php';//arabic page
            } else if (page === 'editprofile') {
                window.location.href = 'editprofile.php'; //settings page
            } else if (page === 'quiz') {
                window.location.href = 'quiz-score.php'; //quiz score page
            }
        }
    </script>

</body>
</html>
