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
    <title>Friends</title>
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
            <aside>

                <div class="sidebar">
                    <h2>Messages</h2>
                    <hr>

                    <form class='search_form' action=''>
                        <input type='text' class='search_user_fr' placeholder='Search friend' name='search_user'>
                        <button type='submit' class='search_btn update_photo friends' name='search_user_btn' onclick='search_change()'>Submit</button>
                    </form>

                    <div class='friends_list_container'>
                        <?php search_user_sidebar_msgPage(); ?>
                    </div>
                </div>

            </aside>

            <div class="content"> 
                <center><h2>Friends</h2></center><br>
                <hr>
                <form class='search_form' action=''>
                    <input type='text' class='search_user_fr frp' autofocus  placeholder='Search friend' name='search_user'>
                    <button type='submit' class='search_btn update_photo frpage' name='search_user_btn' onclick='search_change()'><span id='btn_search'> <img src='assets/img/loupe.svg' class='svg_img_btn'> </span></button>

                </form>
                <?php search_user(); ?>
            </div>
        </div>

        <footer>
 
        </footer>

    </div>

    <div id="go_top">Go Top</div>
    <script>
        function search_change() {
            document.getElementById("btn_search").innerHTML = "&#10006;"
        }
    </script>
    
    <script src="script.js"></script>
</body>

</html>