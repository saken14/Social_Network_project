<?php
$con = mysqli_connect('localhost', 'root', '0tR9RERe8Vp1LrkZ', 'kit_db');

if(isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $get_id = mysqli_query($con, "select user_id from posts where post_id='$post_id'");
    $user_idd = mysqli_fetch_array($get_id)["user_id"];

    $get_user = "select posts_count from users where user_id='$user_idd'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);
    $posts_count = intval($row['posts_count']);
    $posts_count--;


    $delete_post = "delete from posts where post_id='$post_id'";

    $run_delete = mysqli_query($con, $delete_post);
    $run_delete_likes = mysqli_query($con, "delete from post_likes where post_id='$post_id'");
    $run_delete_comments = mysqli_query($con, "delete from comments where post_id='$post_id'");
    $decrement_posts_count = mysqli_query($con, "update users set posts_count='$posts_count' where user_id='$user_idd'");

    if($run_delete && $run_delete_likes && $run_delete_comments && $decrement_posts_count) {
        echo "<script>alert('A post have been deleted.')</script>";
        /* echo "<script>window.open('../home.php', '_self')</script>"; */
        echo "<script>window.open('../profile.php?u_id=$user_idd', '_self')</script>";
    }
}
?>