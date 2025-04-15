<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register user</title>
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <main>
        <div class="page">
            <div class="content">
                <h2>REGISTER A USER ACCOUNT!</h2>
                <div class="error_message">
                <?php
                    if(isset($_SESSION["error_message"])){
                        $error_message = $_SESSION["error_message"];
                        echo "$error_message" . "<br>";
                        unset($_SESSION["error_message"]);
                    }
                ?>
                </div>
                <form action="../controller/UserController.php" method="post">
                    <div class="form_text" style="margin-bottom: 10%;">
                        <label for="username">Username: </label>
                        <input type="text" name="username" required>
                        <br>
                        <label for="email">Email: </label>
                        <input type="email" name="email" required>
                        <br>
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" required>
                        <br>
                    </div>
                    <div class="buttons">
                        <input type="submit" name="register_user" value="Create account">
                        <div class="separator">
                            <hr>
                            <span>Or</span>
                            <hr>
                        </div>
                        <input type="submit" name="register_user" value="Continue with Google">
                    </div>
                </form>
                <div class="other">
                    <p>Other methods</p>
                    <div class="logo_images">
                        <a href=""><img src="img/facebook_logo.png" class="logo" alt="logo of facebook"></a>
                        <a href=""><img src="img/apple_logo.png" class="logo" alt="logo of apple"></a>
                    </div>
                    <a href="signin.php">Sign in</a>
                </div>
            </div>
        </div>
        <div class="event_img">
            <img src="img/event_pic.jpg" alt="image of an event">
        </div>

    </main>
</body>
</html>