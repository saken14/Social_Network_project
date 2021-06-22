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
    <title>Videos</title>
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
            <?php include("aside_for_profile.php"); ?>
            <form action='videos.php?u_id=$<?php echo $user_id; ?>' method='POST' enctype='multipart/form-data'>
                <label class='add_plus'>
                    <img src='assets/img/plus.svg' title='Add image'>
                    <input id='inp_vid' type='file' accept='video/*' name='add_img'  hidden='hidden'>
                </label>

                <div class='preview_modal'>
                    <div class='preview_modal_content'>
                        <span class='close_preview' id='close_preview'>&#10006;</span>
                        <video src='' id='preview_img' controls>
                            Your browser does not support HTML video.
                        </video>
                        <button class='update_photo add_img' name='add_img'>Add</button>
                    </div>
                </div>
                
            </form>
            <?php addVideo(); ?>

            <div class="content">
                <?php
                $id_user = $_GET['u_id'];
                $video_count_query = mysqli_query($con, "select videos_count from users where user_id='$id_user'");
                $video_count_row = mysqli_fetch_array($video_count_query);
                $video_count = $video_count_row['videos_count'];
                
                echo "<p style='font-weight: 500;'>My videos ($video_count)</p><hr style='margin: 8px 0;'>"
                ?>
                <div class='images_container'>
                    <?php echo getAddedVideo(); ?>
                </div>
            </div>

            <div class='view_modal'>
                <div class='view_modal_content'>
                    <div class='to_center_img_view'>
                        <video id='view_img' src='' controls>
                            Your browser does not support HTML video.
                        </video>
                    </div>
                    
                    <p class='pub_date'></p>
                    <span class='del_img' id='del_func'>Delete</span>
                </div>
            </div>
            
        </div>

        <footer>

        </footer>

    </div>

    <div id="go_top">Go Top</div>

    <script>
        //close preview 
        var modal = document.getElementsByClassName("preview_modal")[0];
        var close = document.getElementById("close_preview");
        close.onclick = function () {
            modal.style.display = "none";
        }


        //deleting video
        var del_element = document.getElementById("del_func");
        del_element.onclick = function (e) {
            var id_img = $("#del_func").attr("data-delete_id");
            var id_auth = $("#del_func").attr("data-user_id");

            $.ajax({
                url: "delete_video.php",
                method: "POST",
                dataType: "json",
                data: {id_img: id_img, id_auth: id_auth}
            }).done(function (res) {
                if(!res.error) {
                    window.open('videos.php?u_id=' + id_auth, '_self');
                }
            })
        }
    </script>
    <script src="script.js"></script>
</body>

</html>