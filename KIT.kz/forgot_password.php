<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover password</title>
    <meta name="keywords" content="KIT, Keep in Touch, social network">
    <meta name="description" content="KIT (Keep in Touch) is a social network developed by students of IITU">
    <link rel="shortcut icon" href="assets/img/icon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="main">

        <div class="box forgot_password">
            <h2>Restore password</h2>

            <form action="" method="POST">
                <div class="inpB">
                    <input type="email" name="email" required>
                    <label for="">Email address</label>
                </div><br>

                <div class="inpB2">
                    <label for="">Enter your school best friend name: </label> <br><br>
                    <input type="text" autocomplete='off' placeholder="Name..." name="fr_name" required>
                </div>

                <button class="btn" id="login" name="submit">Continue</button>
            </form>

            <center>
                <p>Back to <a href="login.php">Log In?</a></p>
            </center>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
<?php

include("includes/db.php");

if(isset($_POST['submit'])) {
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $fr_name = htmlentities(mysqli_real_escape_string($con, $_POST['fr_name']));

    $select = "select * from users where user_email = '$email' AND recovery_acc = '$fr_name'";

    $query = mysqli_query($con, $select);

    $check = mysqli_num_rows($query);

    if($check == 1) {
        $_SESSION['user_email'] = $email;
        echo "<script>window.open('change_password.php', '_self')</script>";
    }
    else {
        echo "<script>alert('Your email or friend name is not correct!')</script>";
    }
}

?>