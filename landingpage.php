<?php
// Start the session
session_start();
?>

<?php if (!empty($_SESSION['feedback'])) : ?>
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
    <title>Letterland Landing Page</title>
    <link rel="stylesheet" href="assets/css/style2.css">
    <script src="https://kit.fontawesome.com/d09b6df77f.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="top-navbar">
    <img src="assets/images/Logo.png" alt="LetterLand Logo" class="logo">
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#features">What We Do</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </nav>

    <!-- Home Section -->
    <header id="home" class="hero-section">
    <div class="hero-content">
        <h2>Welcome to LetterLand!</h2>
        <p>Where learning Hausa and Arabic alphabets is made fun and exciting!</p>
        <button onclick="window.location.href='index.php'">Get Started</button>
    </div>
    <div class="hero-image">
        <img src="assets/images/background2.jpeg" alt="background">
    </div>
</header>

    <!-- About Us Section -->
    <section id="about" class="about-section">
        <h2>About Us</h2>
        <p>LetterLand is a fun and interactive platform designed to teach kids alphabets in Hausa and Arabic.
            <br> We make learning exciting and easy for kids!</p>
    </section>

    <!-- What We Do Section -->
    <section id="features" class="features">
        <h2>What LetterLand Does</h2>
        <div class="feature-box">
            <div class="icon"><i class="fa-solid fa-book"></i></div>
            <p>Interactive lessons in Hausa and Arabic.</p>
        </div>
        <div class="feature-box">
            <div class="icon"><i class="fa-solid fa-gamepad"></i></div>
            <p>Fun quizzes and matching games.</p>
        </div>
        <div class="feature-box">
            <div class="icon">🎨</div>
            <p>Engaging visuals to capture attention.</p>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="contact-section">
        <h2>Contact Us</h2>
        <form action="contact.php" method="POST">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            
            <label for="number">Phone Number</label>
            <input type="text" id="number" name="number" placeholder="Enter your phone number" required>
            
            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Write your message" rows="5" required></textarea>
            
            <button type="submit">Send Message</button>
        </form>
    </section>

    <!-- Bottom Navbar -->
    <footer class="bottom-navbar">
        <p>&copy; 2024 Letterland | All Rights Reserved</p>
        <!--<ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#features">What We Do</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>-->
    </footer>
    <script>
        function closeFeedback() {
           window.location.reload();
        }
    </script>
</body>
</html>
