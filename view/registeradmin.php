<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register admin</title>
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <main>
        <div class="page">
            <div class="content">
                <h2>REGISTER AN ADMIN ACCOUNT!</h2>
                <div class="error_message">
                <?php
                    if(isset($_SESSION["error_message"])){
                        $error_message = $_SESSION["error_message"];
                        echo "$error_message" . "<br>";
                        unset($_SESSION["error_message"]);
                    }
                ?>
                </div>
                <form action="../controller/UserController.php" method="post" enctype="multipart/form-data">
                    <div class="form_text">
                        <label for="username">Username: </label>
                        <input type="text" name="username" required>
                        <br>
                        <label for="email">Email: </label>
                        <input type="email" name="email" required>
                        <br>
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" required>
                        <br>
                        <label for="profile_image">Profile Image: </label>
                        <input type="file" name="profile_image" id="profile_image"><br>
                        <br>
                    </div>
                    <div class="buttons">
                        <input type="submit" name="register_admin" value="Create account">
                        <div class="separator">
                            <hr>
                            <span>Or</span>
                            <hr>
                        </div>
                        <input type="submit" name="register_admin" value="Continue with Google">
                    </div>
                </form>
                <div class="other">
                    <p>Other methods</p>
                    <div class="logo_images">
                        <a href=""><img src="img/sign/facebook_logo.png" class="logo" alt="logo of facebook"></a>
                        <a href=""><img src="img/sign/apple_logo.png" class="logo" alt="logo of apple"></a>
                    </div>
                    <a href="signin.php">Sign in</a>
                    <br>
                    <a href="registeruser.php">Create User account</a>
                </div>
            </div>
        </div>
        <div class="event_img">
            <img src="img/sign/event_pic.jpg" alt="image of an event">
        </div>

    </main>
</body>
</html>