<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIT</title>
    <meta name="keywords" content="KIT, Keep in Touch, social network">
    <meta name="description" content="KIT (Keep in Touch) is a social network developed by students of IITU">
    <link rel="shortcut icon" href="assets/img/icon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="main">

        <div class="description">
            <img src="assets/img/k.jpg" alt="KIT">
            <p>Keep in Touch is the largest social network in the world and the company of the same name Keep in Touch, Inc., which owns it. It was founded on February 4, 2021 by Saken Satenov and his roommates Talgat Kuanysh while studying at IITU.</p>
            <br><br>
            <p>Initially, the website was called In Touch and was available only for students of IITU University, then registration was opened for other universities in Almaty, and then for students of any educational institutions in Kazakhstan with an email address in the .edu domain.</p>
        </div>

        <div class="box">
            <h2>Log in</h2>

            <form action="" method="POST">
                <div class="inpB">
                    <input type="email" placeholder="" name="email" required="required">
                    <label for="">Email address</label>
                </div>

                <div class="inpB">
                    <input type="password" placeholder="" name="pass" id="password" required="required">
                    <label for="">Password</label>

                </div>

                <div class="show_pass">
                    <label onclick="showPassword()">Show password</label>
                </div>

                <div class="forgot_pass">
                    <a href="forgot_password.php">Forgot password?</a>
                </div>

                <button class="btn" id="login" name="login">Log in</button>
                <?php include("login_btn.php"); ?>
            </form>

            <center>
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </center>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>