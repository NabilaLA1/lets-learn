<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "letterland";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve questions from the database
$sql = "SELECT * FROM hausaquiz_questions";
$result = $conn->query($sql);

$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Object Match Quiz</title>
    <link rel="stylesheet" href="assets/css/objmatch.css">
    <script src="https://kit.fontawesome.com/d09b6df77f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="quiz-container">
    <button class="back-btn" onclick="window.history.back();">
        <i class="fa-solid fa-arrow-left"></i> <p>Back</p>
   </button>
        <div id="progress-bar-container">
            <div id="progress-bar"></div>
        </div>
        <h2 id="question">What alphabet does this object start with?</h2>
        <audio id="question-sound" src="assets/sounds/question.mp3"></audio>

        <?php if (!empty($questions)) : ?>
            <div id="quiz">
                <?php foreach ($questions as $index => $question) : ?>
                    <div class="quiz-item" style="<?= $index > 0 ? 'display: none;' : '' ?>" id="quiz-<?= $index ?>">
                        <img src="<?= htmlspecialchars($question['object_image']) ?>" alt="Quiz Object" class="object-image">
                        <div class="object-name">
                            <?= htmlspecialchars($question['object_name']) ?>
                            <button class="alpha" onclick="playSound('audio-<?= $index ?>')">
                               <i class="fa-solid fa-volume-high"></i>
                            </button>
                            <audio id="audio-<?= $index ?>" src="<?= htmlspecialchars($question['object_audio']) ?>"></audio>
                        </div>
                        <div class="options">
                            <button type="button" class="option-btn" data-id="<?= $question['id'] ?>" correct_option="1">
                                <img src="<?= htmlspecialchars($question['option1_image']) ?>" alt="Option 1">
                            </button>
                            <button type="button" class="option-btn" data-id="<?= $question['id'] ?>" correct_option="2">
                                <img src="<?= htmlspecialchars($question['option2_image']) ?>" alt="Option 2">
                            </button>
                            <button type="button" class="option-btn" data-id="<?= $question['id'] ?>" correct_option="3">
                                <img src="<?= htmlspecialchars($question['option3_image']) ?>" alt="Option 3">
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>No quiz questions available.</p>
        <?php endif; ?>
    </div>

   
<!-- Feedback popup -->
<div id="feedback-popup" style="
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    width: 300px;
    font-size: 18px;
    font-weight: bold;">
    <img id="popup-image" src="" alt="" style="width: 170px; height: 150px; margin-bottom: 2px; display:none; ">
    <span id="popup-text"></span>
</div>

<!-- Background blur -->
<div id="blur-background" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    display: none;
    z-index: 999;">
</div>

        <script>
            let currentQuestion = 0;
            const totalQuestions = <?= count($questions) ?>;

            document.querySelectorAll('.option-btn').forEach(option => {
                option.addEventListener('click', function () {
                    const questionId = this.getAttribute('data-id');
                    const selectedOption = this.getAttribute('correct_option');

                    // Send selected answer to the server
                    fetch('check_answer.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id=${questionId}&correct_option=${selectedOption}`, // Data sent as query string
                    })
                        .then(response => response.text())
                        .then(response => {
                            console.log("Server response:", response);

                            // Display feedback popup
                            const popup = document.getElementById('feedback-popup');
                            const popupImage = document.getElementById('popup-image');
                            const popupText = document.getElementById('popup-text');
                            const blurBackground = document.getElementById('blur-background');

                            if (response.includes("Correct")) {
                                popup.style.backgroundColor = "rgba(34, 139, 34, 0.9)"; // Green background
                                popupText.textContent = "Correct, you rock!";
                                popupImage.src = "assets/images/goodremark.png"; // Replace with the correct image path
                                popupImage.style.display = "block";
                                setTimeout(() => {
                                    popup.style.display = 'none';
                                    blurBackground.style.display = 'none';
                                    nextQuestion();
                                }, 1500);
                            } else if (response.includes("Oops")) {
                                popup.style.backgroundColor = "rgba(255, 45, 0, 0.9)"; // Red background
                                popupText.textContent = "Oops! Try again";
                                popupImage.src = "assets/images/goodremark.png"; // Replace with the incorrect image path
                                popupImage.style.display = "block";
                                setTimeout(() => {
                                    popup.style.display = 'none';
                                    blurBackground.style.display = 'none';
                                    reloadQuestion();
                                }, 1500);
                            }

                            popup.style.display = "block";
                            blurBackground.style.display = "block";
                        })
                        .catch(error => console.error("Error in Fetch:", error));
                    });
                });

                function updateProgressBar() {
                    const progressBar = document.getElementById("progress-bar");
                    const progress = ((currentQuestion + 1) / totalQuestions) * 100; // Calculate percentage
                    progressBar.style.width = `${progress}%`; // Update width
                }

                function nextQuestion() {
                    const questionSound = document.getElementById("question-sound");
                    questionSound.play(); // Play the sound

                    document.getElementById(`quiz-${currentQuestion}`).style.display = 'none';
                    currentQuestion++;
                    if (currentQuestion < totalQuestions) {
                        document.getElementById(`quiz-${currentQuestion}`).style.display = 'block';
                        updateProgressBar(); // Update progress bar
                    } else {
                        showCompletionPopup(); // Show feedback popup on completion
                    }
                }
                
                    function showCompletionPopup() {
                        const popup = document.getElementById("feedback-popup");
                        popup.innerHTML = `
                            <img src="assets/images/completed.png" alt="Completed Icon" style="width: 80px; height: auto;">
                            <p>Congratulations! You've completed the quiz.</p>
                        `;
                        popup.style.display = "block";

                        setTimeout(() => {
                            popup.style.display = "none";
                            window.location.href = `quizscore.php?score=1&total=${totalQuestions}`;
                        }, 2000);
                    }


            function reloadQuestion() {
                // Reload the same question
                const currentQuiz = document.getElementById(`quiz-${currentQuestion}`);
                currentQuiz.style.display = 'block';
            }

            function playSound(audioId) {
                const audio = document.getElementById(audioId);
                audio.play();
            }
    </script>

</body>
</html>
