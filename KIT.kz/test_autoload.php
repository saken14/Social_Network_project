<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_email'])) {
    header("location: index.php");
}

/* for($i=1; $i<=100; $i++) {
    $run_test = mysqli_query($con, "insert into posts (user_id, post_content, upload_image, post_date) values ('1', '$i  test auto loading', 'my_profile.png.145530971', NOW())");
    if($run_test) {
        echo "<script>alert('Success')</script>";
    }
    else {
        echo "<script>alert('ERROR')</script>";
    }
} */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <meta name="keywords" content="KIT, Keep in Touch, social network">
    <meta name="description" content="KIT (Keep in Touch) is a social network developed by students of IITU">
    <link rel="shortcut icon" href="assets/img/icon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <?php include("includes/header.php"); ?>

        <div class="site_content">
            <?php include("aside.php"); ?>

            <div class="content">

            </div>
        </div>

        <footer>

        </footer>

    </div>

    <div id="go_top">Go Top</div>

    
    <script src="script.js"></script>
</body>

</html>