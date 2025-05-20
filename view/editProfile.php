<?php
session_start();

//verificar login
if (isset($_SESSION["logged"])) {
	$username = htmlspecialchars(string: $_SESSION["username"]);
	$email = htmlspecialchars(string: $_SESSION["email"] ?? "No email available");
} else {
    header("location: signin.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../view/css/editProfile.css">
</head>
<body>
    <main>
        <div class="page">
            <div class="content">
                <h2>EDIT YOUR PROFILE</h2>
                <div class="error_message">
                        <?php
                        if(isset($_SESSION["error_message"])){
                            $error_message = $_SESSION["error_message"];
                            echo "$error_message" . "<br>";
                            unset($_SESSION["error_message"]);
                        }
                        ?>
                    </div>
                    <div class="success_message">
                        <?php
                        if(isset($_SESSION["success_message"])){
                            $success_message = $_SESSION["success_message"];
                            echo "$success_message" . "<br>";
                            unset($_SESSION["success_message"]);
                        }
                        ?>
                    </div>
                <form action="../controller/UserController.php" method="post">
                    <div class="form_text">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo "$username"; ?>" required>
                        <br>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo "$email"; ?>" required>
                        <br>
                        <label for="user_password">Password:</label>
                        <input type="password" id="user_password" name="user_password" required>
                        <br>
                    </div>
                    <div class="buttons">
                        <button type="submit" name="update">Update Profile</button>
                        <?php
                            if($_SESSION['rol'] == "admin"){
                                ?><a href="profileadmin.php" class="back-link">Back to Profile</a> <?php   
                            } else{
                                ?><a href="profileupdate.php" class="back-link">Back to Profile</a> <?php   
                            }
                        ?>
                        <!-- <a href="dashboard.html" class="back-link">Back to Profile</a> -->
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>