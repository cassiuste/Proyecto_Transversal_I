<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="../controller/UserController.php" method="post">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="login">
    </form>
</body>
</html>