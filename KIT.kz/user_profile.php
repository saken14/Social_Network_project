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
    <?php
            $user = $_GET['u_id'];
            $get_user = "select * from users where user_id='$user'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);

            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $first_name = $row['f_name'];
            $last_name = $row['l_name'];

        $user = $_SESSION['user_email'];
        $get_user = "select * from users where user_email='$user'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);

        /* $first_name = $row['f_name'];
        $last_name = $row['l_name']; */
        $cur_id = $row['user_id'];

        if($_GET['u_id'] == $cur_id) {
            echo "<script>window.open('profile.php?u_id=$cur_id', '_self')</script>";
            exit();
        }

        $last_id_run = mysqli_query($con, "select user_id from users ORDER by user_id DESC LIMIT 1");
        $row_last_id = mysqli_fetch_array($last_id_run);
        $last_id = $row_last_id['user_id'];
        
        if($_GET['u_id'] <= 0 || $_GET['u_id'] > $last_id) {
            echo "<script>alert('ERROR $last_id')</script>";
            echo "<script>window.open('profile.php?u_id=$cur_id', '_self')</script>";
        }
    ?>
    <title><?php echo $first_name . ' ' . $last_name; ?></title>
    <meta name="keywords" content="KIT, Keep in Touch, social network">
    <meta name="description" content="KIT (Keep in Touch) is a social network developed by students of IITU">
    <link rel="shortcut icon" href="assets/img/icon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <?php include("includes/header.php"); 
            $user = $_GET['u_id'];
            $get_user = "select * from users where user_id='$user'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);

            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $first_name = $row['f_name'];
            $last_name = $row['l_name'];
            $describe_user = $row['describe_user'];
            $relationship_status = $row['relationship'];
            $user_email = $row['user_email'];
            $user_city = $row['user_city'];
            $user_gender = $row['user_gender'];
            $user_birthday = $row['user_birthday'];
            $user_image = $row['user_image'];
            $recovery_acc = $row['recovery_acc'];
            $user_reg_date = $row['user_reg_date'];

            $user_birthday = date("F j, Y", strtotime($user_birthday));
            $user_reg_date = date("F j, Y", strtotime($user_reg_date));
        ?>

        <div class="site_content">
            <?php include("aside_for_profile.php"); ?>

            <div class="content">
                <div class="info_container">
                    <?php
                        echo "
                        <div class='profile_image_section'> 
                            <form action='profile.php?u_id=$user_id' method='POST' enctype='multipart/form-data'>
                            <div class='profile_image'>
                                
                                <img src='users/$user_image' id='blah' alt='your image' data-cur_user_id='$user_id'>
                                
                            </div>
                            </form>
                        </div>
                        ";
                    ?>

                    

                    
                    <div class="about_section">

                        <div class="name_section">
                            <h2><?php echo"$first_name $last_name"; ?></h2>
                            <p><?php echo"$describe_user"; ?></p>
                        </div>
                        <hr>

                        <?php echo"
                            <div class='information_container'>
                                <div class='information_section'>
                                    <p><strong>Birthday:</strong></p>
                                    <p><strong>City:</strong></p>
                                    <p><strong>Relationship:</strong></p>
                                    <p><strong>Registration date:</strong></p>
                                    <p><strong>Gender:</strong></p>
                                </div>
                                <div class='information_section value'>
                                    <p>$user_birthday</p>
                                    <p>$user_city</p>
                                    <p>$relationship_status</p>
                                    <p>$user_reg_date</p>
                                    <p>$user_gender</p>
                                </div>
                            </div>
                        "; ?>
                        <div class="count_container">
                            <?php
                            $user = $_GET['u_id'];
                            $run_user = mysqli_query($con, "select * from users where user_id='$user'");
                            $run_user_row = mysqli_fetch_array($run_user);

                            $posts_count = $run_user_row['posts_count'];
                            $images_count = $run_user_row['images_count'];
                            $videos_count = $run_user_row['videos_count'];

                            echo "
                            <div class='info_block'>
                                <center>
                                    <h4>Posts</h4>
                                    <p>$posts_count</p>
                                </center>
                            </div>
                            <div class='info_block'>
                                <center>
                                    <h4>Images</h4>
                                    <p>$images_count</p>
                                </center>
                            </div>
                            <div class='info_block'>
                                <center>
                                    <h4>Videos</h4>
                                    <p>$videos_count</p>
                                </center>
                            </div>
                            "; ?>
                        </div>

                    </div>

                </div>

                <?php
                $u_id = $_GET['u_id'];
                $res = mysqli_query($con, "select *  from posts where user_id='$u_id' ORDER BY post_id DESC LIMIT 10");

                $posts = array();
                while ($row = mysqli_fetch_assoc($res)) {
                    $posts[] = $row;
                }

                foreach ($posts as $post) {
                    $post_id = $post['post_id'];
                    $user_id = $post['user_id'];
                    $content = $post['post_content'];
                    $upload_image = $post['upload_image'];
                    $post_date = $post['post_date'];
                    $post_date = date("H:i   F j, Y", strtotime($post_date));
                    $post_like = $post['post_like'];
                    $post_com = $post['post_com'];

                    $user = "select * from users where user_id='$user_id' AND posts='yes'";
                    $run_user = mysqli_query($con, $user);
                    $row_user = mysqli_fetch_array($run_user);

                    $user_Fname = $row_user['f_name'];
                    $user_Lname = $row_user['l_name'];
                    $user_image = $row_user['user_image'];

                    $u_e = $_SESSION['user_email'];
                    $cur_user = mysqli_query($con, "select user_id from users where user_email='$u_e'");
                    $cur_user_row = mysqli_fetch_array($cur_user);
                    $cur_user_id = $cur_user_row['user_id'];


                    $get_like = mysqli_query($con, "select * from post_likes where post_id='$post_id' AND user_id='$cur_user_id'");
                    $check = mysqli_num_rows($get_like);
                    if($check == 1) {
                        $isActive=true;
                    }
                    else {
                        $isActive=false;
                    }
                    
                    //Displaying posts from database

                    if($content == '' && strlen($upload_image) >= 1) {
                        echo "
                        
                        <div class='post_container'>

                            <div class='post_info'>

                                <div class='post_user_img'>
                                    <img src=\"users/$user_image\" class='post_ava'>
                                </div>
                                <div class='post_user_info'>
                                    <p><strong><a href='user_profile.php?u_id=$user_id'>$user_Fname $user_Lname</a></strong></p>
                                    <span>$post_date</span>
                                </div>

                            </div>

                            <div class='post_imgAndContent'>
                                <center><img src=\"imagepost/$upload_image\" class='post_img' data-img_name=\"$upload_image\" data-date='$post_date' data-author=\"$user_Fname $user_Lname\" data-user_id='$user_id' data-post_like='$post_like'></center>
                            </div>

                            <div class='comment_btn'>
                                <a href='single.php?post_id=$post_id'><button><img src='assets/img/commentw.svg' class='svg_img_btn'> <span>$post_com</span></button></a>
                            </div>
                            <div class='comment_btn like'>
                                <button class='like' data-post_id='$post_id' data-user_id='$cur_user_id'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 51.997 51.997' style='enable-background:new 0 0 512 512' xml:space='preserve' class='svg_img_btn id"; echo $post_id; echo "'><g><path xmlns='http://www.w3.org/2000/svg' d='M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905  c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478  c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014  C52.216,18.553,51.97,16.611,51.911,16.242z' fill='#ffffff' id='path"; echo $post_id; echo "' data-original='#000000' style='' class='"; if($isActive) echo "liked"; echo "'/><g xmlns='http://www.w3.org/2000/svg'></g></g></svg> <span class='like_span"; echo $post_id; echo "'>$post_like</span></button>
                            </div>
                        
                        </div>

                        ";
                    } 
                    else if(strlen($content) >= 1 && strlen($upload_image) >= 1) {
                        echo "
                        
                        <div class='post_container'>

                            <div class='post_info'>

                                <div class='post_user_img'>
                                    <img src=\"users/$user_image\" class='post_ava'>
                                </div>
                                <div class='post_user_info'>
                                    <p><strong><a href='user_profile.php?u_id=$user_id'>$user_Fname $user_Lname</a></strong></p>

                                    <span>$post_date</span>
                                </div>

                            </div>

                            <div class='post_imgAndContent'>
                                <p>$content</p>
                                <center><img src=\"imagepost/$upload_image\" class='post_img' data-img_name=\"$upload_image\" data-date='$post_date' data-author=\"$user_Fname $user_Lname\" data-user_id='$user_id' data-post_like='$post_like'></center>
                            </div>

                            <div class='comment_btn'>
                                <a href='single.php?post_id=$post_id'><button><img src='assets/img/commentw.svg' class='svg_img_btn'> <span>$post_com</span></button></a>
                            </div>
                            <div class='comment_btn like'>
                                <button class='like' data-post_id='$post_id' data-user_id='$cur_user_id'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 51.997 51.997' style='enable-background:new 0 0 512 512' xml:space='preserve' class='svg_img_btn id"; echo $post_id; echo "'><g><path xmlns='http://www.w3.org/2000/svg' d='M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905  c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478  c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014  C52.216,18.553,51.97,16.611,51.911,16.242z' fill='#ffffff' id='path"; echo $post_id; echo "' data-original='#000000' style='' class='"; if($isActive) echo "liked"; echo "'/><g xmlns='http://www.w3.org/2000/svg'></g></g></svg> <span class='like_span"; echo $post_id; echo "'>$post_like</span></button>
                            </div>
                        
                        </div>

                        ";
                    }
                    else {
                        echo "
                        
                        <div class='post_container'>

                            <div class='post_info'>

                                <div class='post_user_img'>
                                    <img src=\"users/$user_image\" class='post_ava'>
                                </div>
                                <div class='post_user_info'>
                                    <p><strong><a href='user_profile.php?u_id=$user_id'>$user_Fname $user_Lname</a></strong></p>
                                    <span>$post_date</span>
                                </div>

                            </div>

                            <div class='post_imgAndContent'>
                                <p>$content</p>
                            </div>
                            <div class='comment_btn'>
                                <a href='single.php?post_id=$post_id'><button><img src='assets/img/commentw.svg' class='svg_img_btn'> <span>$post_com</span></button></a>
                            </div>
                            <div class='comment_btn like'>
                                <button class='like' data-post_id='$post_id' data-user_id='$cur_user_id'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 51.997 51.997' style='enable-background:new 0 0 512 512' xml:space='preserve' class='svg_img_btn id"; echo $post_id; echo "'><g><path xmlns='http://www.w3.org/2000/svg' d='M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905  c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478  c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014  C52.216,18.553,51.97,16.611,51.911,16.242z' fill='#ffffff' id='path"; echo $post_id; echo "' data-original='#000000' style='' class='"; if($isActive) echo "liked"; echo "'/><g xmlns='http://www.w3.org/2000/svg'></g></g></svg> <span class='like_span"; echo $post_id; echo "'>$post_like</span></button>
                            </div>
                        </div>
                        

                        ";
                    }
                } 
                ?>

            </div>
            <div class='view_modal'>
                <div class='view_modal_content'>
                    <div class='to_center_img_view'>
                        <img id='view_img' src=''>
                    </div>
                    <a href='' id='authorOfPostA'><p class='authorOfPost'></p></a>
                    <p class='pub_date'></p>
                    <p class='post_likeOnImageView'></p>
                </div>
            </div>


        </div>

        <footer>

        </footer>

    </div>

    <div id="go_top">Go Top</div>

    
    <script src="script.js"></script>
    <script>
        $(document).ready(function () {
    
            var inProgress = false;
            var startFrom = 10;

            $(window).scroll(function () {
                if($(window).scrollTop() + $(window).height() >= $(document).height() - 550 && !inProgress) {

                    var cur_user_id = $("img#blah").data("cur_user_id");

                    $.ajax({
                        url: 'get_post_profile_handler.php',
                        method: 'POST',
                        data: {startFrom: startFrom, cur_user_id: cur_user_id},
                        beforeSend: function () {
                            inProgress=true;
                        }
                    }).done(function (result) {
                        result = jQuery.parseJSON(result);
                        if(result.posts.length > 0 && result.user.length > 0) {
                            var size = result.posts.length;

                            for(var i=0; i<size; i++) {
                                if(result.isLiked[i]) {
                                    if(result.posts[i].post_content == null && result.posts[i].upload_image != null) {
                                        $('.content').append("<div class='post_container'><div class='post_info'><div class='post_user_img'><img src=\"users/"+result.user[i].user_image+"\" class='post_ava'></div><div class='post_user_info'><p><strong><a href='user_profile.php?u_id="+result.posts[i].user_id+"'>"+result.user[i].f_name+" "+ result.user[i].l_name +"</a></strong></p><span>"+result.posts[i].post_date+"</span></div></div><div class='post_imgAndContent'><center><img src=\"imagepost/" + result.posts[i].upload_image + "\" class='post_img' data-img_name=\"" + result.posts[i].upload_image + "\" data-date='"+result.posts[i].post_date+"' data-author=\""+result.user[i].f_name + " " +result.user[i].l_name +"\" data-user_id='"+result.posts[i].user_id+"' data-post_like='"+result.posts[i].post_like+"'></center></div><div class='comment_btn'><a href='single.php?post_id="+result.posts[i].post_id+"'><button><img src='assets/img/commentw.svg' class='svg_img_btn'> <span>"+result.posts[i].post_com+"</span></button></a></div><div class='comment_btn like'><button class='like' data-post_id='"+result.posts[i].post_id+"' data-user_id='"+result.cur_user+"'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 51.997 51.997' style='enable-background:new 0 0 512 512' xml:space='preserve' class='svg_img_btn id"+result.posts[i].post_id+"'><g><path xmlns='http://www.w3.org/2000/svg' d='M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905  c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478  c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014  C52.216,18.553,51.97,16.611,51.911,16.242z' fill='#ffffff' id='path"+result.posts[i].post_id+"' data-original='#000000' style='' class='liked'/><g xmlns='http://www.w3.org/2000/svg'></g></g></svg> <span class='like_span"+result.posts[i].post_id+"'>"+result.posts[i].post_like+"</span></button></div><div class='comment_btn'><a href='functions/delete_post.php?post_id="+result.posts[i].post_id+"'><button> <img src='assets/img/trash2.svg' class='svg_img_btn'> </button></a></div></div>");
                                    }
                                    else if(result.posts[i].post_content != null && result.posts[i].upload_image !=null) {
                                        $('.content').append("<div class='post_container'><div class='post_info'><div class='post_user_img'><img src=\"users/"+result.user[i].user_image+"\" class='post_ava'></div><div class='post_user_info'><p><strong><a href='user_profile.php?u_id="+result.posts[i].user_id+"'>"+result.user[i].f_name+" "+ result.user[i].l_name +"</a></strong></p><span>"+result.posts[i].post_date+"</span></div></div><div class='post_imgAndContent'><p>"+ result.posts[i].post_content+"</p><center><img src=\"imagepost/" + result.posts[i].upload_image + "\" class='post_img' data-img_name=\"" + result.posts[i].upload_image + "\" data-date='"+result.posts[i].post_date+"' data-author=\""+result.user[i].f_name + " " +result.user[i].l_name +"\" data-user_id='"+result.posts[i].user_id+"' data-post_like='"+result.posts[i].post_like+"'></center></div><div class='comment_btn'><a href='single.php?post_id="+result.posts[i].post_id+"'><button><img src='assets/img/commentw.svg' class='svg_img_btn'> <span>"+result.posts[i].post_com+"</span></button></a></div><div class='comment_btn like'><button class='like' data-post_id='"+result.posts[i].post_id+"' data-user_id='"+result.cur_user+"'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 51.997 51.997' style='enable-background:new 0 0 512 512' xml:space='preserve' class='svg_img_btn id"+result.posts[i].post_id+"'><g><path xmlns='http://www.w3.org/2000/svg' d='M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905  c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478  c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014  C52.216,18.553,51.97,16.611,51.911,16.242z' fill='#ffffff' id='path"+result.posts[i].post_id+"' data-original='#000000' style='' class='liked'/><g xmlns='http://www.w3.org/2000/svg'></g></g></svg> <span class='like_span"+result.posts[i].post_id+"'>"+result.posts[i].post_like+"</span></button></div><div class='comment_btn'><a href='functions/delete_post.php?post_id="+result.posts[i].post_id+"'><button> <img src='assets/img/trash2.svg' class='svg_img_btn'> </button></a></div></div>");
                                    }
                                    else {
                                        $('.content').append("<div class='post_container'><div class='post_info'><div class='post_user_img'><img src=\"users/"+result.user[i].user_image+"\" class='post_ava'></div><div class='post_user_info'><p><strong><a href='user_profile.php?u_id="+result.posts[i].user_id+"'>"+result.user[i].f_name+" "+ result.user[i].l_name +"</a></strong></p><span>"+result.posts[i].post_date+"</span></div></div><div class='post_imgAndContent'><p>"+ result.posts[i].post_content+"</p></div><div class='comment_btn'><a href='single.php?post_id="+result.posts[i].post_id+"'><button><img src='assets/img/commentw.svg' class='svg_img_btn'> <span>"+result.posts[i].post_com+"</span></button></a></div><div class='comment_btn like'><button class='like' data-post_id='"+result.posts[i].post_id+"' data-user_id='"+result.cur_user+"'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 51.997 51.997' style='enable-background:new 0 0 512 512' xml:space='preserve' class='svg_img_btn id"+result.posts[i].post_id+"'><g><path xmlns='http://www.w3.org/2000/svg' d='M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905  c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478  c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014  C52.216,18.553,51.97,16.611,51.911,16.242z' fill='#ffffff' id='path"+result.posts[i].post_id+"' data-original='#000000' style='' class='liked'/><g xmlns='http://www.w3.org/2000/svg'></g></g></svg> <span class='like_span"+result.posts[i].post_id+"'>"+result.posts[i].post_like+"</span></button></div><div class='comment_btn'><a href='functions/delete_post.php?post_id="+result.posts[i].post_id+"'><button> <img src='assets/img/trash2.svg' class='svg_img_btn'> </button></a></div><div class='comment_btn'><a href='edit_post.php?post_id="+result.posts[i].post_id+"' title='Edit'><button> <img src='assets/img/edit.svg' class='svg_img_btn'> </button></a></div></div>");
                                    }
                                }
                                else {
                                    if(result.posts[i].post_content == null && result.posts[i].upload_image != null) {
                                        $('.content').append("<div class='post_container'><div class='post_info'><div class='post_user_img'><img src=\"users/"+result.user[i].user_image+"\" class='post_ava'></div><div class='post_user_info'><p><strong><a href='user_profile.php?u_id="+result.posts[i].user_id+"'>"+result.user[i].f_name+" "+ result.user[i].l_name +"</a></strong></p><span>"+result.posts[i].post_date+"</span></div></div><div class='post_imgAndContent'><center><img src=\"imagepost/" + result.posts[i].upload_image + "\" class='post_img' data-img_name=\"" + result.posts[i].upload_image + "\" data-date='"+result.posts[i].post_date+"' data-author=\""+result.user[i].f_name + " " +result.user[i].l_name +"\" data-user_id='"+result.posts[i].user_id+"' data-post_like='"+result.posts[i].post_like+"'></center></div><div class='comment_btn'><a href='single.php?post_id="+result.posts[i].post_id+"'><button><img src='assets/img/commentw.svg' class='svg_img_btn'> <span>"+result.posts[i].post_com+"</span></button></a></div><div class='comment_btn like'><button class='like' data-post_id='"+result.posts[i].post_id+"' data-user_id='"+result.cur_user+"'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 51.997 51.997' style='enable-background:new 0 0 512 512' xml:space='preserve' class='svg_img_btn id"+result.posts[i].post_id+"'><g><path xmlns='http://www.w3.org/2000/svg' d='M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905  c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478  c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014  C52.216,18.553,51.97,16.611,51.911,16.242z' fill='#ffffff' id='path"+result.posts[i].post_id+"' data-original='#000000' style='' class=''/><g xmlns='http://www.w3.org/2000/svg'></g></g></svg> <span class='like_span"+result.posts[i].post_id+"'>"+result.posts[i].post_like+"</span></button></div><div class='comment_btn'><a href='functions/delete_post.php?post_id="+result.posts[i].post_id+"'><button> <img src='assets/img/trash2.svg' class='svg_img_btn'> </button></a></div></div>");
                                    }
                                    else if(result.posts[i].post_content != null && result.posts[i].upload_image !=null) {
                                        $('.content').append("<div class='post_container'><div class='post_info'><div class='post_user_img'><img src=\"users/"+result.user[i].user_image+"\" class='post_ava'></div><div class='post_user_info'><p><strong><a href='user_profile.php?u_id="+result.posts[i].user_id+"'>"+result.user[i].f_name+" "+ result.user[i].l_name +"</a></strong></p><span>"+result.posts[i].post_date+"</span></div></div><div class='post_imgAndContent'><p>"+ result.posts[i].post_content+"</p><center><img src=\"imagepost/" + result.posts[i].upload_image + "\" class='post_img' data-img_name=\"" + result.posts[i].upload_image + "\" data-date='"+result.posts[i].post_date+"' data-author=\""+result.user[i].f_name + " " +result.user[i].l_name +"\" data-user_id='"+result.posts[i].user_id+"' data-post_like='"+result.posts[i].post_like+"'></center></div><div class='comment_btn'><a href='single.php?post_id="+result.posts[i].post_id+"'><button><img src='assets/img/commentw.svg' class='svg_img_btn'> <span>"+result.posts[i].post_com+"</span></button></a></div><div class='comment_btn like'><button class='like' data-post_id='"+result.posts[i].post_id+"' data-user_id='"+result.cur_user+"'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 51.997 51.997' style='enable-background:new 0 0 512 512' xml:space='preserve' class='svg_img_btn id"+result.posts[i].post_id+"'><g><path xmlns='http://www.w3.org/2000/svg' d='M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905  c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478  c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014  C52.216,18.553,51.97,16.611,51.911,16.242z' fill='#ffffff' id='path"+result.posts[i].post_id+"' data-original='#000000' style='' class=''/><g xmlns='http://www.w3.org/2000/svg'></g></g></svg> <span class='like_span"+result.posts[i].post_id+"'>"+result.posts[i].post_like+"</span></button></div><div class='comment_btn'><a href='functions/delete_post.php?post_id="+result.posts[i].post_id+"'><button> <img src='assets/img/trash2.svg' class='svg_img_btn'> </button></a></div></div>");
                                    }
                                    else {
                                        $('.content').append("<div class='post_container'><div class='post_info'><div class='post_user_img'><img src=\"users/"+result.user[i].user_image+"\" class='post_ava'></div><div class='post_user_info'><p><strong><a href='user_profile.php?u_id="+result.posts[i].user_id+"'>"+result.user[i].f_name+" "+ result.user[i].l_name +"</a></strong></p><span>"+result.posts[i].post_date+"</span></div></div><div class='post_imgAndContent'><p>"+ result.posts[i].post_content+"</p></div><div class='comment_btn'><a href='single.php?post_id="+result.posts[i].post_id+"'><button><img src='assets/img/commentw.svg' class='svg_img_btn'> <span>"+result.posts[i].post_com+"</span></button></a></div><div class='comment_btn like'><button class='like' data-post_id='"+result.posts[i].post_id+"' data-user_id='"+result.cur_user+"'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 51.997 51.997' style='enable-background:new 0 0 512 512' xml:space='preserve' class='svg_img_btn id"+result.posts[i].post_id+"'><g><path xmlns='http://www.w3.org/2000/svg' d='M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905  c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478  c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014  C52.216,18.553,51.97,16.611,51.911,16.242z' fill='#ffffff' id='path"+result.posts[i].post_id+"' data-original='#000000' style='' class=''/><g xmlns='http://www.w3.org/2000/svg'></g></g></svg> <span class='like_span"+result.posts[i].post_id+"'>"+result.posts[i].post_like+"</span></button></div><div class='comment_btn'><a href='functions/delete_post.php?post_id="+result.posts[i].post_id+"'><button> <img src='assets/img/trash2.svg' class='svg_img_btn'> </button></a></div><div class='comment_btn'><a href='edit_post.php?post_id="+result.posts[i].post_id+"' title='Edit'><button> <img src='assets/img/edit.svg' class='svg_img_btn'> </button></a></div></div>");
                                    }
                                }
                            }
                            startFrom+=10;
                            inProgress=false;
                        }
                    });
                } 
            });
        });
    
        
    </script>
</body>

</html>