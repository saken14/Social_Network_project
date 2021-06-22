<?php
include("db.php");
include("functions/functions.php");
 
    $user = $_SESSION['user_email'];
    $get_user = "select * from users where user_email='$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);


    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $first_name = $row['f_name'];
    $last_name = $row['l_name'];
    $describe_user = $row['describe_user'];
    $relationship_status = $row['relationship'];
    $user_pass = $row['user_pass'];
    $user_email = $row['user_email'];
    $user_city = $row['user_city'];
    $user_gender = $row['user_gender'];
    $user_birthday = $row['user_birthday'];
    $user_birthday_e = $row['user_birthday'];
    $user_image = $row['user_image'];
    $recovery_acc = $row['recovery_acc'];
    $user_reg_date = $row['user_reg_date'];

    $user_birthday = date("F j, Y", strtotime($user_birthday));
    $user_reg_date = date("F j, Y", strtotime($user_reg_date));

    $user_posts = "select * from posts where user_id='$user_id'";
    $run_posts = mysqli_query($con, $user_posts);
    $posts = mysqli_num_rows($run_posts);

?>
<header>

     <div id="switcher" data-isTurnedOn='<?php echo $_COOKIE["sw"]; ?>'>
         <div id="indicator"></div>
     </div>

     <div class="header">
         <div class="logo_img">
             <a href="home.php"><img src="assets/img/logo.png" alt="logo" title="Home page"></a>
         </div>

         <div class="nav_bar">

             <div class="item_of_nav_bar">
                 <a href="home.php" title="Home page"><img src="assets/img/home.svg" id="icon_home"></a>
             </div>
             <div class="item_of_nav_bar">
                 <a href="friends.php" title="Friends"><img src="assets/img/friends.svg" id="icon_friends"></a>
             </div>
             <div class="item_of_nav_bar">
                 <a href="messages.php?u_id=new" title="Chat"><img src="assets/img/chat.svg" id="icon_chat"></a>
             </div>
             <!-- <div class="item_of_nav_bar">
                 <a href="music.php?u_id=<?php //echo $user_id; ?>" title="Music"><img src="assets/img/music.svg" id="icon_music"></a>
             </div> -->
             <div class="item_of_nav_bar">
                 <a href='photos.php?u_id=<?php echo $user_id; ?>' title="Photos"><img src="assets/img/image.svg" id="icon_image"></a>
             </div>
             <div class="item_of_nav_bar">
                 <a href="videos.php?u_id=<?php echo $user_id; ?>" title="Videos"><img src="assets/img/video.svg" id="icon_video"></a>
             </div>

         </div>

         <div class="profile_item">
             <div class="item_of_nav_bar">

                 <a href="profile.php?<?php echo "u_id=$user_id"; ?>" title="Profile"><span><?php echo "$first_name"; ?></span><img src="users/<?php echo"$user_image"; ?>"></a>
             </div>
         </div>
     </div>

 </header>
 <div class="under_header"></div>

 <script src="script.js"></script>