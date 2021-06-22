<?php
include("includes/db.php");

$post_id = intval($_POST['post_id']);
//$like_count = intval($_POST['like_count']);
$user_id = intval($_POST['user_id']);
$error = true;
$message = '';
$isActive=false;

if($post_id) {
    

    $query = mysqli_query($con, "select * from post_likes where post_id='$post_id' AND user_id='$user_id'");
    $check = mysqli_num_rows($query);

    
    if($check==1) {
        $query3 = mysqli_query($con, "select post_like from posts where post_id='$post_id'");
        $row3 = mysqli_fetch_array($query3);
        $like_count = intval($row3["post_like"]);
        $like_count--;
        $inc_like = mysqli_query($con, "update posts set post_like='$like_count' where post_id='$post_id'");
        $query2 = mysqli_query($con, "delete from post_likes where post_id='$post_id' AND user_id='$user_id'");
        $isActive=false;
    }
    else {
        $query3 = mysqli_query($con, "select post_like from posts where post_id='$post_id'");
        $row3 = mysqli_fetch_array($query3);
        $like_count = intval($row3["post_like"]);
        $like_count++;
        $inc_like = mysqli_query($con, "update posts set post_like='$like_count' where post_id='$post_id'");
        $query2 = mysqli_query($con, "insert into post_likes (post_id, user_id) values ($post_id, $user_id)");
        $isActive=true;
    }
    $error=false;
}
else {
    $error=true;
    $message="Post not found, may be it was deleted by author.";
}

$out = array(
	'error' => $error,
	'message' => $message,
	'like_count' => $like_count,
	'isActive' => $isActive
);

header('Content-Type: text/json; charset=utf-8');

echo json_encode($out);
