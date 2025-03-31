<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLink</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    

    <div id="authDiv">
    <h1 id="title">EventLink</h1>
    <form action="" id="signUpForm">
        <h1 id="signUpTitle">Sign Up</h1>
        <input id="nameSignUp" placeholder="Name"></input><br>
        <input id="emailSignUp" placeholder="Email"></input><br>
        <input id="passwordSignUp"placeholder="Password"></input>
        <p>Already have an account? <a id="goToSignIn">Sign In</a></p>
    </form>

    <form action="" id="signInForm">
        <h1 id="signInTitle">Sign In</h1>
        <input id="emailSignIn" placeholder="Email"></input><br>
        <input id="passwordSignIn" placeholder="Password"></input>
        <p>Don't have an account? <a id="goToSignUp">Sign Up</a></p>
    </form>
    </div>
    
    <script src="auth.js"></script>
</body>
</html>