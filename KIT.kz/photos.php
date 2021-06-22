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
    <title>Photos</title>
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
            <form action='photos.php?u_id=$<?php echo $user_id; ?>' method='POST' enctype='multipart/form-data'>
                <label class='add_plus'>
                    <img src='assets/img/plus.svg' title='Add image'>
                    <input id='inp_img' type='file' accept='image/*'name='add_img'  hidden='hidden'>
                </label>

                <div class='preview_modal'>
                    <div class='preview_modal_content'>
                        <span class='close_preview' id='close_preview'>&#10006;</span>
                        <img id='preview_img' src=''>
                        <button class='update_photo add_img' name='add_img'>Add</button>
                    </div>
                </div>
                
            </form>
            <?php addImage(); ?>

            <div class="content">
                <?php
                $id_user = $_GET['u_id'];
                $photo_count_query = mysqli_query($con, "select images_count from users where user_id='$id_user'");
                $photo_count_row = mysqli_fetch_array($photo_count_query);
                $photo_count = $photo_count_row['images_count'];
                
                echo "<p style='font-weight: 500;'>My photos ($photo_count)</p><hr style='margin: 8px 0;'>"
                ?>
                <div class='images_container'>
                    <?php echo getAddedImg(); ?>
                </div>
            </div>

            <div class='view_modal'>
                <div class='view_modal_content'>
                    <div class='to_center_img_view'>
                        <img id='view_img' src=''>
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


        //deleting img
        var del_element = document.getElementById("del_func");
        del_element.onclick = function (e) {
            var id_img = $("#del_func").attr("data-delete_id");
            var id_auth = $("#del_func").attr("data-user_id");

            $.ajax({
                url: "delete_image.php",
                method: "POST",
                dataType: "json",
                data: {id_img: id_img, id_auth: id_auth}
            }).done(function (res) {
                if(!res.error) {
                    window.open('photos.php?u_id=' + id_auth, '_self');
                }
            })
        }




        /* function animPlus() {
            var elem = document.getElementsByClassName("add_plus")[0];

            elem.style.right = "130px";
            setTimeout(function () {
                elem.style.right = "135px";
            }, 500);
            setTimeout(function () {
                elem.style.right = "130px";
            }, 1000);
            setTimeout(function () {
                elem.style.right = "125px";
            }, 1500);
        }
        setInterval(animPlus, 2000); */
    </script>
    <script src="script.js"></script>
</body>

</html>