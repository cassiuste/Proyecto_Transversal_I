<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <main>
        <div class="page">
            <div class="content">
                <h2>WELCOME! SIGN IN</h2>
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
                    <div class="form_text">
                        <label for="username">Username: </label>
                        <input type="text" name="username" required>
                        <br>
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" required>
                        <br>
                    </div>
                    <a href="">Forgot Password</a>
                    <br>
                    <div class="buttons">
                        <input type="submit" name="login" value="Login">
                        <div class="separator">
                            <hr>
                            <span>Or</span>
                            <hr>
                        </div>
                        <input type="submit" value="Login with Google">
                    </div>
                </form>
                <div class="other">
                    <p>Other methods</p>
                    <div class="logo_images">
                        <a href=""><img src="img/sign/facebook_logo.png" class="logo" alt="logo of facebook"></a>
                        <a href=""><img src="img/sign/apple_logo.png" class="logo" alt="logo of apple"></a>
                    </div>
                    <a href="registeruser.php">Create User account</a>
                    <br>
                    <a href="registeradmin.php">Create Admin account</a>
                </div>
            </div>
        </div>
        <div class="event_img">
            <img src="img/sign/event_pic.jpg" alt="image of an event">
        </div>

    </main>
</body>
</html>