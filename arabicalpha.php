<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'letterland');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all alphabets and objects
$sql = "SELECT * FROM arabicalpha";
$result = $conn->query($sql);

// Store data in an array
$alphabets = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $alphabets[] = $row;
    }
} else {
    echo "No data found!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hausa Alphabets</title>
    <link rel="stylesheet" href="assets/css/arabicalpha.css">
    <script src="https://kit.fontawesome.com/d09b6df77f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        
        <button class="back-btn" onclick="window.history.back();">
        <i class="fa-solid fa-arrow-left"></i> <p>Back</p>
        </button>

        <!-- Slideshow -->
        <div class="slideshow-container">
            <?php foreach ($alphabets as $index => $alphabet): ?>
                <div class="mySlides fade">
                    <div class="content">
                        <!-- Alphabet -->
                        <div class="alphabet">
                            <img src="<?= $alphabet['ara_letter_img'] ?>" alt="Alphabet Image">
                            <button  class="alpha" onclick="playSound('letter<?= $index ?>')">
                            <i class="fa-solid fa-volume-high"></i>
                            </button>
                            <audio id="letter<?= $index ?>"src="<?= $alphabet['ara_letter_audio'] ?>">></audio>
                        </div>
                        <hr>
                        <!-- Object -->
                        <div class="object">
                            <img src="<?= $alphabet['ara_object_img'] ?>" alt="object_name">
                            <p><?= $alphabet['ara_object_name'] ?></p><button class="obj" onclick="playSound('object<?= $index ?>')">
                            <i class="fa-solid fa-volume-high"></i>
                            </button>
                            <audio id="object<?= $index ?>" src="<?= $alphabet['ara_object_audio']?>"></audio>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!--side Navigation Buttons-->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </div>
    <script src="assets/js/hausaalpha.js"></script>
    <script>
        // Navigate to the previous page
        function navigateBack() {
            window.history.back();
        }
        // Auto-play sound 
        window.onload = function () {
            document.getElementById('letter0').play();
            setTimeout(() => {
                document.getElementById('object0').play();
            }, 4000); // Delay object sound after letter sound
        };
    </script>
</body>
</html>
