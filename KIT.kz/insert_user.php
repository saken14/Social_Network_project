<?php 
include("includes/db.php");

    if(isset($_POST['sign_up'])) {
        $first_name = htmlentities(mysqli_real_escape_string($con, $_POST['first_name']));
        $last_name = htmlentities(mysqli_real_escape_string($con, $_POST['last_name']));
        $email = htmlentities(mysqli_real_escape_string($con, $_POST['u_email']));
        $pass = htmlentities(mysqli_real_escape_string($con, $_POST['u_pass']));
        $city = htmlentities(mysqli_real_escape_string($con, $_POST['u_city']));
        $gender = htmlentities(mysqli_real_escape_string($con, $_POST['u_gender']));
        $birthday = htmlentities(mysqli_real_escape_string($con, $_POST['u_birthday']));
        $status = "verified";
        $posts = "no";
        $username = strtolower($first_name . '_' . $last_name);

        $check_username_query = "select user_name from users table where user_email='$email'";
        $run_username = mysqli_query($con, $check_username_query);

        if(strlen($pass) < 8) {
            echo "<script>alert('Password should not be less than 8!')</script>";
            exit();
        }

        $check_email = "select * from users where user_email = '$email'";
        $run_email = mysqli_query($con, $check_email);

        $check = mysqli_num_rows($run_email);

        if($check == 1) {
            echo "<script>alert('Email already exists! Please, try another email.')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
            exit();
        }

        $profile_pic = "my_profile.png";

        $insert = "insert into users (f_name, l_name, user_name, describe_user, relationship, user_pass, user_email, user_city, user_gender, user_birthday, user_image, user_reg_date, status, posts, recovery_acc) values ('$first_name', '$last_name', '$username', 'Hello World! ... (this is my default status)', 'Not specified', '$pass', '$email', '$city', '$gender', '$birthday', '$profile_pic', NOW(), '$status', '$posts', 'Thehardestistostart!')";

        $query = mysqli_query($con, $insert);

        if($query) {
            echo "<script>alert('Well done, you are welcome!')</script>";
            echo "<script>window.open('login.php', '_self')</script>";
        }
        else {
            echo "<script>alert('Something went wrong(registration failed), please try again.')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
        }

    }


?>