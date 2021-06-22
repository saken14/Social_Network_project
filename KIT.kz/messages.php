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
    <title>Messages</title>
    <meta name="keywords" content="KIT, Keep in Touch, social network">
    <meta name="description" content="KIT (Keep in Touch) is a social network developed by students of IITU">
    <link rel="shortcut icon" href="assets/img/icon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        /* function setCookie(name, value) { 
            document.cookie = name + "=" + value + ";"; 
        }






//switcher
var switcher = document.getElementById("switcher");
var body = document.querySelector("body");
var header = document.querySelector("header");
var sidebar = document.getElementsByClassName("sidebar");
var content = document.querySelector(".content");

//checking if it is turned on initially
if(switcher.getAttribute("data-isTurnedOn") == 'on') {
    $('#switcher').addClass("active");
    $("body").addClass("active");
    $("header").addClass("bg_active");

    $(".sidebar").addClass("bg_active");
    $(".content").addClass("bg_active");
}
//click on switcher
$("div#switcher").off().click(function () {

    if(switcher.getAttribute("data-isTurnedOn") == 'off') {
        jQuery('#switcher').addClass("active");
        jQuery('body').addClass("active");
        jQuery('header').addClass("bg_active");

        for(var i=0; i<sidebar.length; i++) {
            sidebar[i].classList.toggle("bg_active");
        }
        jQuery('.content').addClass("bg_active");
        switcher.setAttribute("data-isTurnedOn", "on");
        setCookie("sw", 'on');
    }
    else {
        $('#switcher').removeClass("active");
        $("body").removeClass("active");
        $("header").removeClass("bg_active");

        $(".sidebar").removeClass("bg_active");
        $(".content").removeClass("bg_active");

        switcher.setAttribute("data-isTurnedOn", "off");
        setCookie("sw", 'off');
    }
}) */
    </script>
</head>

<body>
    <div class="main">
        <?php include("includes/header.php"); ?>

        <div class="site_content">
            <aside>
                <div class="sidebar msg">
                    <h2>Messages</h2>
                    <hr>

                    <form class='search_form' action=''>
                        <input type='text' class='search_user_fr' placeholder='Search friend' name='search_user'>
                        <button type='submit' class='search_btn update_photo friends' name='search_user_btn' onclick='search_change()'>Submit</button>
                    </form>

                    <div class='friends_list_container msg'>
                        <?php search_user_sidebar_msgPage(); ?>
                    </div>
                </div>
            </aside>

            <div class="content msg">
            <?php
            if(isset($_GET['u_id'])) {
                global $con;
                $get_id = $_GET['u_id'];
                $get_user = "select * from users where user_id='$get_id'";
                $run_user = mysqli_query($con, $get_user);
                $row_user = mysqli_fetch_array($run_user);

                $user_to_msg = $row_user['user_id'];
                $user_to_Fname = $row_user['f_name'];
                $user_to_Lname = $row_user['l_name'];
                $user_image = $row_user['user_image'];
            }

            $user = $_SESSION['user_email'];
            $get_user = "select * from users where user_email='$user'";
            $run_user = mysqli_query($con, $get_user);
            $row_user = mysqli_fetch_array($run_user);

            $user_from_msg = $row_user['user_id'];
            $user_from_Fname = $row_user['f_name'];
            $user_from_Lname = $row_user['l_name'];


            $sel_msg = "select * from user_messages where (user_to='$user_to_msg' AND user_from='$user_from_msg') OR (user_to='$user_from_msg' AND user_from='$user_to_msg') ORDER by 1 ASC";
            $run_msg = mysqli_query($con, $sel_msg);
            $msg_count = mysqli_num_rows($run_msg);
            $counter=0;
            
            
            if(isset($_GET['u_id'])) {
                $u_id = $_GET['u_id'];
                $get_idd = $_GET['u_id'];
                $get_userr = "select * from users where user_id='$get_idd'";
                $run_userr = mysqli_query($con, $get_userr);
                $row_userr = mysqli_fetch_array($run_userr);
                if($row_userr) {
                echo "
                    <div class='msg_window'>
                        <div class='post_info msg'>
                            <div class='post_user_img'>
                                <img src='users/$user_image' class='post_ava'>
                            </div>
                            <div class='post_user_info'>
                                <p><strong><a href='user_profile.php?u_id=$user_to_msg'>$user_to_Fname $user_to_Lname</a></strong></p>
                            </div>
                        </div>

                        <div class='msg_container' id='scrollToBottom'> ";
                            while($row_msg = mysqli_fetch_array($run_msg)) {
                                $user_to = $row_msg['user_to'];
                                $user_from = $row_msg['user_from'];
                                $msg_body = $row_msg['msg_body'];
                                $msg_date = $row_msg['date'];
                                $msg_date = date("d.m.Y [H:i]", strtotime($msg_date));
                                
                                $counter++;
                            
                        
                                if($user_to == $user_to_msg && $user_from == $user_from_msg) {
                                        echo "
                                        <div class='msg_f' title='$msg_date'>
                                            $msg_body
                                            <p>$msg_date</p>
                                        </div>
                                        ";
                                }
                                else if($user_to == $user_from_msg && $user_from == $user_to_msg) {
                                        echo "
                                        <div class='msg_t' title='$msg_date'>
                                            $msg_body
                                            <p>$msg_date</p>
                                        </div>
                                        ";
                                }
                            }

                        echo "</div>

                        

                        <div class='type_msg'>
                            <form action='' method='POST'>
                                <textarea class='msg_textarea' maxlength='485' autofocus rows='3' placeholder='&#9998; Write a message...' name='msg_box'></textarea>
                                <button id='post_btn' class='update_photo msg' name='send_msg'>&#10148; Send</button>
                            </form>
                        </div>

                    </div>
                ";
                }
                else {
                    echo "
                    <div class='msg_Tpre'>
                        <center><span>&#9993;</span><br>Please select a chat to start messaging</center>
                    </div>
                    ";
                }
            }
            
            ?>

            <?php
            if(isset($_POST['send_msg'])) {
                if(isset($_GET['u_id'])) {
                    $u_id = $_GET['u_id'];
                }
                $msg = htmlentities($_POST['msg_box']);
                if($msg == '') {
                    echo "<script>alert('Write a message!')</script>";
                    echo "<script>window.open('messages.php?u_id=$u_id', '_self')</script>";
                }
                else {
                    $insert = "insert into user_messages (user_to, user_from, msg_body, date, msg_seen) values ('$user_to_msg', '$user_from_msg', '$msg', NOW(), 'no')";
                    $run_insert = mysqli_query($con, $insert); 
                    echo "<script>window.open('messages.php?u_id=$u_id', '_self')</script>";
                }
            }
            ?>

            </div>
        </div>

        <footer>
 
        </footer>

    </div>

    <div id="go_top">Go Top</div>
    <script>

        var block = document.getElementById("scrollToBottom");
        block.scrollTop = block.scrollHeight;
        
    </script>
    <script src="script.js"></script>
</body>

</html>