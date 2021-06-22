<?php
$con = mysqli_connect('localhost', 'root', '0tR9RERe8Vp1LrkZ', 'kit_db');

//function for insert_post;

function addImage() {
    if(isset($_POST['add_img'])) {
        global $con; 
        global $user_id;

        $add_img = $_FILES['add_img']['name'];
        $add_img_tmp = $_FILES['add_img']['tmp_name'];
        $random_number = random_int(0, 999999999);

        if(strlen($add_img) >= 1) {
            move_uploaded_file("$add_img_tmp", "albums/$add_img.$random_number");

            $vid_count = mysqli_query($con, "select images_count from users where user_id='$user_id'");
            $vid_count_row = mysqli_fetch_array($vid_count);
            $vid_count = $vid_count_row["images_count"];
            $vid_count++;
            $upd_img_c = mysqli_query($con, "update users set images_count = $vid_count where user_id='$user_id'");
            
            $ins = "insert into images (name, upload_date, author_id) values ('$add_img.$random_number', NOW(), '$user_id')";

            $run = mysqli_query($con, $ins);

            if($run) {
                //echo "<script>alert('Your image added! ')</script>";
                echo "<script>window.open('photos.php?u_id=$user_id', '_self')</script>";
            }
            exit();
        }
    }
}

function getAddedImg() {
    if(isset($_GET['u_id'])) {
        global $con;
        $u_id = $_GET['u_id'];

        $user_com = $_SESSION['user_email'];
        $get_com = "select * from users where user_email='$user_com'";
        $run_com = mysqli_query($con, $get_com);
        $row_com = mysqli_fetch_array($run_com);

        $user_img_id = $row_com['user_id'];

        if($u_id != $user_img_id) {
            echo "<script>alert('ERROR wrong id')</script>";
            echo "<script>window.open('home.php', '_self')</script>";
        } 
        else {
            $get_img = mysqli_query($con, "select * from images where author_id='$u_id'");

            while($row_img = mysqli_fetch_array($get_img)) {
                $img_id = $row_img['id'];
                $name = $row_img['name'];
                $date = $row_img['upload_date'];
                $date = date("H:i   F j, Y", strtotime($date));
                $user = $row_img['author_id'];

                echo "
                <div class='block_img'>
                    <img src='albums/$name' class='img_item' data-img_id='$img_id' data-date='$date' data-user='$user'>
                    
                </div>
                ";
            }
        }
    }
}

function addVideo() {
    if(isset($_POST['add_img'])) {
        global $con; 
        global $user_id;

        $add_img = $_FILES['add_img']['name'];
        $add_img_tmp = $_FILES['add_img']['tmp_name'];
        $random_number = random_int(0, 999999999);

        if(strlen($add_img) >= 1) {
            move_uploaded_file("$add_img_tmp", "videos/$add_img.$random_number");

            $vid_count = mysqli_query($con, "select videos_count from users where user_id='$user_id'");
            $vid_count_row = mysqli_fetch_array($vid_count);
            $vid_count = $vid_count_row["videos_count"];
            $vid_count++;
            $upd_img_c = mysqli_query($con, "update users set videos_count = $vid_count where user_id='$user_id'");
            
            $ins = "insert into videos (name, upload_date, author_id) values ('$add_img.$random_number', NOW(), '$user_id')";

            $run = mysqli_query($con, $ins);

            if($run) {
                //echo "<script>alert('Your video added! ')</script>";
                echo "<script>window.open('videos.php?u_id=$user_id', '_self')</script>";
            }
            exit();
        }
    }
}

function getAddedVideo() {
    if(isset($_GET['u_id'])) {
        global $con;
        $u_id = $_GET['u_id'];

        $user_com = $_SESSION['user_email'];
        $get_com = "select * from users where user_email='$user_com'";
        $run_com = mysqli_query($con, $get_com);
        $row_com = mysqli_fetch_array($run_com);

        $user_img_id = $row_com['user_id'];

        if($u_id != $user_img_id) {
            echo "<script>alert('ERROR wrong id')</script>";
            echo "<script>window.open('home.php', '_self')</script>";
        } 
        else {
            $get_img = mysqli_query($con, "select * from videos where author_id='$u_id'");

            while($row_img = mysqli_fetch_array($get_img)) {
                $img_id = $row_img['id'];
                $name = $row_img['name'];
                $date = $row_img['upload_date'];
                $date = date("H:i   F j, Y", strtotime($date));
                $user = $row_img['author_id'];

                echo "
                <div class='block_img'>
                    <video src='videos/$name' class='img_item' data-img_id='$img_id' data-date='$date' data-user='$user'>
                        Your browser does not support HTML video.
                    </video>
                </div>
                ";
            }
        }
    }
}



function insertPost() {
    if(isset($_POST['sub'])) {
        global $con;
        global $user_id;
        
        $content = htmlentities($_POST["content"]);
        $post_img = $_FILES['post_img']['name'];
        $img_tmp = $_FILES['post_img']['tmp_name'];
        $random_number = random_int(0, 999999999);

        echo '<script>alert("'.$content.'")</script>';

        if(strlen($content) >= 1 && strlen($post_img) >= 1) {
            move_uploaded_file("$img_tmp", "imagepost/$post_img.$random_number");

            $ins = 'insert into posts (user_id, post_content, post_date, upload_image) values ("'.$user_id.'", "'.$content.'", NOW(), "'.$post_img.'.'.$random_number.'")';

            $run = mysqli_query($con, $ins);

            if($run) {
                $get_inc = mysqli_query($con, "select posts_count from users where user_id='$user_id'");
                $posts_count = mysqli_fetch_array($get_inc)["posts_count"];
                $posts_count++;
                mysqli_query($con, "update users set posts_count='$posts_count' where user_id='$user_id'");

                echo "<script>alert('Your post published! ')</script>";
                echo "<script>window.open('home.php', '_self')</script>";

                $upd = "update users set posts='yes' where user_id='$user_id'";
                $run_upd = mysqli_query($con, $upd);
            }
            exit();
        }
        else {
            if($post_img == '' && $content == '') {
                echo "<script>alert('Error, you didn't enter some text or image!')</script>";
                echo "<script>window.open('home.php', '_self')</script>";
            }
            else {
                if($content == '') {
                    move_uploaded_file("$img_tmp", "imagepost/$post_img.$random_number");
            
                    $ins = "insert into posts (user_id, upload_image, post_date) values ('$user_id', '$post_img.$random_number', NOW())";

                    $ins = 'insert into posts (user_id, post_date, upload_image) values ("'.$user_id.'", NOW(), "'.$post_img.'.'.$random_number.'")';

                    $run = mysqli_query($con, $ins);

                    if($run) {
                        $get_inc = mysqli_query($con, "select posts_count from users where user_id='$user_id'");
                        $posts_count = mysqli_fetch_array($get_inc)["posts_count"];
                        $posts_count++;
                        mysqli_query($con, "update users set posts_count='$posts_count' where user_id='$user_id'");

                        echo "<script>alert('Your post published! ')</script>";
                        echo "<script>window.open('home.php', '_self')</script>";

                        $upd = "update users set posts='yes' where user_id='$user_id'";
                        $run_upd = mysqli_query($con, $upd);
                    }
                    exit();
                }
                else {
                    $ins = 'insert into posts (user_id, post_content, post_date) values ("'.$user_id.'", "'.$content.'", NOW())';

                    $run = mysqli_query($con, $ins);

                    if($run) {
                        $get_inc = mysqli_query($con, "select posts_count from users where user_id='$user_id'");
                        $posts_count = mysqli_fetch_array($get_inc)["posts_count"];
                        $posts_count++;
                        mysqli_query($con, "update users set posts_count='$posts_count' where user_id='$user_id'");
                        
                        echo "<script>alert('Your post published! ')</script>";
                        echo "<script>window.open('home.php', '_self')</script>";

                        $upd = "update users set posts='yes' where user_id='$user_id'";
                        $run_upd = mysqli_query($con, $upd);
                    }
                    exit();
                }
            }
        }
    }
}


function getPosts() {
    global $con;
    $per_page = 10; 

    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    else {
        $page = 1;
    }

    $start_from = ($page - 1) * $per_page;
    $get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";
    $run_posts = mysqli_query($con, $get_posts);

    while($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content'];
        $upload_image = $row_posts['upload_image'];
        $post_date = $row_posts['post_date'];
        $post_date = date("H:i   F j, Y", strtotime($post_date));
        $post_like = $row_posts['post_like'];
        $post_com = $row_posts['post_com'];

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
                        <img src='users/$user_image' class='post_ava'>
                    </div>
                    <div class='post_user_info'>
                        <p><strong><a href='user_profile.php?u_id=$user_id'>$user_Fname $user_Lname</a></strong></p>
                        <span>$post_date</span>
                    </div>

                </div>

                <div class='post_imgAndContent'>
                    <center><img src='imagepost/$upload_image' class='post_img' data-img_name='$upload_image' data-date='$post_date' data-author='$user_Fname $user_Lname' data-user_id='$user_id' data-post_like='$post_like'></center>
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
                        <img src='users/$user_image' class='post_ava'>
                    </div>
                    <div class='post_user_info'>
                        <p><strong><a href='user_profile.php?u_id=$user_id'>$user_Fname $user_Lname</a></strong></p>

                        <span>$post_date</span>
                    </div>

                </div>

                <div class='post_imgAndContent'>
                    <p>$content</p>
                    <center><img src='imagepost/$upload_image' class='post_img' data-img_name='$upload_image' data-date='$post_date' data-author='$user_Fname $user_Lname' data-user_id='$user_id' data-post_like='$post_like'></center>
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
                        <img src='users/$user_image' class='post_ava'>
                    </div>
                    <div class='post_user_info'>
                        <p><strong><a href='user_profile.php?u_id=$user_id'>$user_Fname $user_Lname</a></strong></p>
                        <span>$post_date</span>
                    </div>

                </div>

                <div class='post_imgAndContent'>
                    <p>
                        $content
                    </p>
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
    include("pagination.php");
}

function single_post() {
    if(isset($_GET['post_id'])) {
        global $con;

        $get_id = $_GET['post_id'];
        
        $get_posts = "select * from posts where post_id='$get_id'";
        $run_posts = mysqli_query($con, $get_posts);
        $row_posts = mysqli_fetch_array($run_posts);

        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content'];
        $upload_image = $row_posts['upload_image'];
        $post_date = $row_posts['post_date'];
        $post_date = date("H:i   F j, Y", strtotime($post_date));
        $post_com = $row_posts['post_com'];

        $user = "select * from users where user_id='$user_id' AND posts='yes'";
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);

        $user_Fname = $row_user['f_name'];
        $user_Lname = $row_user['l_name'];
        $user_image = $row_user['user_image'];

        $user_com = $_SESSION['user_email'];
        $get_com = "select * from users where user_email='$user_com'";
        $run_com = mysqli_query($con, $get_com);
        $row_com = mysqli_fetch_array($run_com);

        $user_com_id = $row_com['user_id'];
        $user_com_Fname = $row_com['f_name'];
        $user_com_Lname = $row_com['l_name'];

        if(isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
        }
        $get_posts = "select post_id from posts where post_id='$post_id'";
        $run_user = mysqli_query($con, $get_posts);

        $post_id = $_GET['post_id'];

        $post = $_GET['post_id'];
        $get_user = "select * from posts where post_id='$post'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);
        
        $p_id = $row['post_id'];

        if($p_id != $post_id) {
            echo "<script>alert('ERROR')</script>";
            echo "<script>window.open('home.php', '_self')</script>";
        }
        else {
            if($content == '' && strlen($upload_image) >= 1) {
                echo "
                
                <div class='post_container com'>

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
                        <center><img src=\"imagepost/$upload_image\"></center>
                    </div>
                
                </div>

                <hr class='comment_hr'>

                ";
            }
            else if(strlen($content) >= 1 && strlen($upload_image) >= 1) {
                echo "
                
                <div class='post_container com'>

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
                        <center><img src=\"imagepost/$upload_image\"></center>
                    </div>
                
                </div>

                <hr class='comment_hr'>

                ";
            }
            else {
                echo "
                
                <div class='post_container com'>

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
                        <p>
                            $content
                        </p>
                    </div>
                
                </div>

                <hr class='comment_hr'>

                ";
            }

            echo "
            <div class='insert_post comment'>
                <form action='' method='post'>
                    <textarea class='post_textarea' maxlength='1000' id='post_content_text' rows='3' name='comment' autofocus placeholder='&#9998; Write your comment here...'></textarea>
                    
                    <button id='post_btn' class='update_photo comment' name='reply'>&#10148; Comment</button>
                    
                </form>
            </div>
            ";

            include("comments.php");

            if(isset($_POST['reply'])) {
                $comment = htmlentities($_POST['comment']);

                $user_com = $_SESSION['user_email'];
                $get_com = "select * from users where user_email='$user_com'";
                $run_com = mysqli_query($con, $get_com);
                $row_com = mysqli_fetch_array($run_com);

                $user_id_of_com = $row_com['user_id'];

                if($comment == '') {
                    echo "<script>alert('Enter your comment!')</script>";
                    echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                }
                else {
                    $post_com++;
                    $insert = "insert into comments (post_id, user_id, user_id_of_com, comment, author_Fname, author_Lname, date) values ('$post_id', '$user_id', '$user_id_of_com', '$comment', '$user_com_Fname', '$user_com_Lname', NOW())";
                    $run = mysqli_query($con, $insert);
                    $upd_com = "update posts set post_com='$post_com' where post_id='$post_id'";
                    $run_com = mysqli_query($con, $upd_com);

                    echo "<script>alert('Your comment added!')</script>";
                    echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                }
            }
        }

    }
}


function search_user_sidebar() { 
    global $con;

    if(isset($_GET['search_user_btn'])) {
        $search_query = htmlentities($_GET['search_user']);
        $get_user = "select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%'";
    }
    else {
        $get_user = "select * from users ORDER BY `users`.`user_name` ASC";
    }

    $run_user = mysqli_query($con, $get_user);

    while($row_user = mysqli_fetch_array($run_user)) {
        $user_id = $row_user['user_id'];
        $f_name = $row_user['f_name'];
        $l_name = $row_user['l_name'];
        $user_image = $row_user['user_image'];

        echo "
        <div class='post_info friends'>

            <div class='post_user_img'>
                <a href='user_profile.php?u_id=$user_id'><img src='users/$user_image' class='post_ava friends' title='$f_name $l_name'></a>
            </div>
            <div class='post_user_info friends'>
                <p><strong><a href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></strong></p>
            </div>

        </div>
        ";
    }
}

function search_user() {
    global $con;

    if(isset($_GET['search_user_btn'])) {
        $search_query = htmlentities($_GET['search_user']);
        $get_user = "select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%'";
    }
    else {
        $get_user = "select * from users ORDER BY `users`.`user_name` ASC";
    }

    $run_user = mysqli_query($con, $get_user);

    while($row_user = mysqli_fetch_array($run_user)) {
        $user_id = $row_user['user_id'];
        $f_name = $row_user['f_name'];
        $l_name = $row_user['l_name'];
        $user_image = $row_user['user_image'];

        echo "
        <div class='post_info frpage'>

            <div class='post_user_img'>
                <a href='user_profile.php?u_id=$user_id'><img src='users/$user_image' class='post_ava' title='$f_name $l_name'></a>
            </div>
            <div class='post_user_info'>
                <p><strong><a href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></strong></p>
            </div>

        </div>
        ";
    }
}



function search_user_sidebar_msgPage() {
    global $con;

    if(isset($_GET['search_user_btn'])) {
        $search_query = htmlentities($_GET['search_user']);
        $get_user = "select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%'";
    }
    else {
        $get_user = "select * from users";
    }

    $run_user = mysqli_query($con, $get_user);

    while($row_user = mysqli_fetch_array($run_user)) {
        $user_email_t = $_SESSION['user_email'];
        $user_email = $row_user['user_email'];
        if($user_email == $user_email_t) {  //you can not message to yourself 
            continue;
        }

        $user_id = $row_user['user_id'];
        $f_name = $row_user['f_name'];
        $l_name = $row_user['l_name'];
        $user_image = $row_user['user_image'];

        echo "
        <div class='post_info friends'>

            <div class='post_user_img'>
                <a href='messages.php?u_id=$user_id#last_msg'><img src='users/$user_image' class='post_ava friends' title='$f_name $l_name'></a>
            </div>
            <div class='post_user_info friends'>
                <p><strong><a href='messages.php?u_id=$user_id'>$f_name $l_name</a></strong></p>
            </div>

        </div>
        ";
    }
}

?>