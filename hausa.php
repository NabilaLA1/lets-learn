<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hausa Page</title>
    <link rel="stylesheet" href="assets/css/hausa.css"> 
    <script src="https://kit.fontawesome.com/d09b6df77f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <!-- Back Button -->
        <button class="back-btn" onclick="navigateBack()">
        <i class="fa-solid fa-arrow-left"></i><p> Back</p>
        </button>

        <!-- Title -->
        <h1 class="title">Hausa</h1>

        <!-- Content Boxes -->
        <div class="language-content">
            <div class="language-wrapper">
                <!-- Alphabets -->
                <div class="box" onclick="navigateTo('alphabets')">
                    <img src="assets/images/hausa A.png" alt="Alphabets" class="box-img">
                </div>
                <p>Alphabets</p>
            </div>
            <div class="language-wrapper">
                <!-- Object Match -->
                <div class="box" onclick="navigateTo('object-match')">
                    <img src="assets/images/hausa obj.png" alt="Object Match" class="box-img">
                </div>
                <p>Object Match</p>
            </div>
        </div>

    </div>
    <script>
        // Navigate to the previous page
        function navigateBack() {
            window.history.back();
        }
        function navigateTo(section) {
            if (section === 'alphabets') {
                window.location.href = 'hausaalpha.php'; // Navigate to Alphabets page
            } else if (section === 'object-match') {
                window.location.href = 'object-match.php'; // Navigate to Object Match page
            }
        }

    </script>
</body>
</html>
