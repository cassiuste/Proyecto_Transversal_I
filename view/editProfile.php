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
                    </div>
                <form action="#" method="post">
                    <div class="form_text">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="nombredeusuario" required>
                        <br>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="correo@ejemplo.com" required>
                        <br>
                        <label for="age">Edad:</label>
                        <input type="text" id="age" name="age">
                        <label for="dateB">Cumpleaños:</label>
                        <input type="text" id="dateB" name="dateB">
                        <br>
                    </div>
                    <div class="buttons">
                        <button type="submit">Update Profile</button>
                        <a href="dashboard.html" class="back-link">Back to Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>