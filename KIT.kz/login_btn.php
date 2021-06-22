<?php

include("includes/db.php");
 
if(isset($_POST['login'])) {
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $pass = htmlentities(mysqli_real_escape_string($con, $_POST['pass']));

    $select = "select * from users where user_email = '$email' AND user_pass = '$pass' AND status = 'verified'";
    $query = mysqli_query($con, $select);

    $check = mysqli_num_rows($query);

    if($check == 1) {
        $_SESSION['user_email'] = $email;
        echo "<script>window.open('home.php', '_self')</script>";
    }
    else {
        echo "<script>alert('Your email or password is not correct!')</script>";
    }
}

?>