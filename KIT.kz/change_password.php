<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_email'])) {
    header("location: index.php");
}
if(isset($_SESSION['user_email'])) {
    $ue = $_SESSION['user_email'];
    $get_id = "select * from users where user_email='$ue'";
    $run_gi = mysqli_query($con, $get_id);
    $row = mysqli_fetch_array($run_gi);

    $user_id = $row['user_id'];
    $f_n = $row['f_name'];
    $l_n = $row['l_name'];
}
else {
    echo "<script>alert('Can not get user_email, error')</script>";
    echo "<script>window.open('index.php', '_self')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <meta name="keywords" content="KIT, Keep in Touch, social network">
    <meta name="description" content="KIT (Keep in Touch) is a social network developed by students of IITU">
    <link rel="shortcut icon" href="assets/img/icon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="main">

        <div class="box forgot_password">
            <h2>Change your password<br><i style="color: #4A8FFF"><?php echo "$f_n $l_n";?></i></h2>

            <form action="" method="POST">
                <div class="inpB">
                    <input type="password" id='password2' name="password" required>
                    <label for="">New password</label>
                </div>
                <div class="show_pass">
                    <label onclick="showPassword2()">Show password</label>
                </div>

                <div class="inpB">
                    <input type="password" id='password3' name="pass1" required>
                    <label for="">Re-enter password</label>
                </div>
                <div class="show_pass">
                    <label onclick="showPassword3()">Show password</label>
                </div>

                <button class="btn" id="login" name="change">Change password</button>
            </form>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
<?php
if(isset($_POST['change'])) {
    $pass = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
    $pass1 = htmlentities(mysqli_real_escape_string($con, $_POST['pass1']));

    if($pass == $pass1) {
        if(strlen($pass) > 7 && strlen($pass) < 61) {
            

            $update = "update users set user_pass='$pass' where user_id='$user_id'";
            $run = mysqli_query($con, $update);
            
            if($run) {
                echo "<script>alert('Your password is successfully changed!')</script>";
                echo "<script>window.open('home.php', '_self')</script>";
            }
            else {
                echo "<script>alert('Can not get user_id, error!')</script>";
                echo "<script>window.open('change_password.php', '_self')</script>";
            }

            
        }
        else {
            echo "<script>alert('Length of password should be between 8 and 60!')</script>";
        }
    }
    else {
        echo "<script>alert('Your password did not match!')</script>";
        echo "<script>window.open('change_password.php', '_self')</script>";
    }
}
?>