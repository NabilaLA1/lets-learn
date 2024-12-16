<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LetterLand</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/d09b6df77f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="logo">
                <img src="assets/images/Logo.png" alt="LetterLand Logo">
            </div>
        </div>
        <div class="right-panel">
            <h2>Please enter your information to get started</h2>
            <form action="process.php" method="POST">
                <div class="input-group">
                    <label for="child_name" class="input-label">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="child_name" name="child_name" placeholder="Child's Name" required>
                    </label>
                </div>
                
                <div class="input-group">
                    <label for="child_age" class="input-label">
                    <i class="fa-solid fa-user"></i>
                    <input type="number" id="child_age" name="child_age" placeholder="Child's Age" required>
                    </label>
                </div>
  
                <div class="input-group">
                    <label for="parent_age" class="input-label">
                    <i class="fa-solid fa-user"></i>
                    <input type="number" id="parent_age" name="parent_age" placeholder="Parent's Age" required>
                    </label>
                </div>

                 <div>
                <button type="submit">Start Learning</button>
                </div>
            </form>

        </div>

    </body>
</html>
