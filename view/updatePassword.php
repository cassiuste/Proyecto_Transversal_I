<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <main>
        <div class="page">
            <div class="content">
                <h2>UPDATE PASSWORD</h2>
                <div class="error_message">
                <?php
                    if (isset($_SESSION["error_message"])) {
                        echo $_SESSION["error_message"] . "<br>";
                        unset($_SESSION["error_message"]);
                    }
                ?>
                </div>
                <form action="../controller/UserController.php" method="post">
                    <div class="form_text">
                        <label for="username">Username:</label>
                        <input type="text" name="username" required>
                        <br>
                        <label for="new_password">New Password:</label>
                        <input type="password" name="new_password" id="new_password" required>
                        <br>
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" required>
                        <br>
                    </div>
                    <div class="buttons">
                        <input type="submit" name="update_password" value="Update Password">
                    </div>
                </form>
                <div class="other">
                    <a href="signin.php">Back to Login</a>
                </div>
            </div>
        </div>
        <div class="event_img">
            <img src="img/sign/event_pic.jpg" alt="image of an event">
        </div>
    </main>
</body>
</html>