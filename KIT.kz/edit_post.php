<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_email'])) {
    header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit post</title>
    <meta name="keywords" content="KIT, Keep in Touch, social network">
    <meta name="description" content="KIT (Keep in Touch) is a social network developed by students of IITU">
    <link rel="shortcut icon" href="assets/img/icon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main">
        <?php include("includes/header.php"); ?>

        <div class="site_content">
            <?php include("aside_for_profile.php"); ?>

            <div class="content"> 
 
                <?php
                if(isset($_GET['post_id'])) {
                    $get_id = $_GET['post_id'];

                    $post_upd = "select * from posts where post_id='$get_id'";
                    $run_upd = mysqli_query($con, $post_upd);
                    $row = mysqli_fetch_array($run_upd);

                    $content_old = $row['post_content'];
                }
                ?>

                <form action="" method="post" id="f">
                    <center><h2>Edit your post:</h2></center>
                    <textarea rows="10" name="content" class="post_textarea edit" maxlength="500" autofocus id="post_content_text"><?php echo $content_old;?></textarea>
                    <button id='post_btn' class='update_photo' name='sub'>&#10003; Update post</button>
                </form>

                <?php
                if(isset($_POST['sub'])) {

                    $user = $_SESSION['user_email'];
                    $get_user = "select * from users where user_email='$user'";
                    $run_user = mysqli_query($con, $get_user);
                    $row= mysqli_fetch_array($run_user);

                    $user_id = $row['user_id'];

                    $content = $_POST['content'];

                    $upd_post = "update posts set post_content='$content' where post_id='$get_id'";
                    $run_new_upd = mysqli_query($con, $upd_post);

                    if($run_new_upd) {
                        echo "<script>alert('A post has been updated.')</script>";
                        echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
                    }

                }
                ?>

            </div>
        </div>

        <footer>

        </footer>

    </div>

    <div id="go_top">Go Top</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>