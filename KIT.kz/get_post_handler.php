<?php
include('includes/db.php');

$startFrom = $_POST['startFrom'];
$cur_user_id = $_POST['cur_user_id'];

$res = mysqli_query($con, "select * from posts ORDER BY post_id DESC LIMIT {$startFrom}, 10");

$posts = array();
$user_data = array();
$isLiked = array();
$c = 0;

while ($row = mysqli_fetch_array($res)) {
    $posts[] = $row;
    $user_id = $row['user_id'];
    $post_id = $row['post_id'];
    $post_date = $row['post_date'];
    $post_date = date("H:i   F j, Y", strtotime($post_date));
    $posts[$c]['post_date'] = $post_date;

    //$posts[$c]['upload_image'] = addslashes($posts[$c]['upload_image']);

    $run_user = mysqli_query($con, "select f_name, l_name, user_image from users where user_id='$user_id' AND posts='yes'");
    while ($row_user = mysqli_fetch_assoc($run_user)) {
        $user_data[] = $row_user;
    }

    $get_like = mysqli_query($con, "select * from post_likes where post_id='$post_id' AND user_id='$cur_user_id'");
    $check = mysqli_num_rows($get_like);
    if($check == 1) {
        $isLiked[] = true;
    }
    else {
        $isLiked[] = false;
    }
    $c++;
}

$out = array(
    'posts' => $posts,
    'user' => $user_data,
    'cur_user' => $cur_user_id,
    'isLiked' => $isLiked
);

echo json_encode($out);