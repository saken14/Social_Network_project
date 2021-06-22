<?php
$con = mysqli_connect('localhost', 'root', '0tR9RERe8Vp1LrkZ', 'kit_db');

$error = true;

if(isset($_POST['id_img'])) {
    $id_img = $_POST['id_img'];
    $id_auth = $_POST['id_auth'];

    $img_count = mysqli_query($con, "select images_count from users where user_id='$id_auth'");
    $img_count_row = mysqli_fetch_array($img_count);
    $img_count = $img_count_row["images_count"];
    $img_count--;
    $upd_img_c = mysqli_query($con, "update users set images_count = $img_count where user_id='$id_auth'");

    $delete_img = "delete from images where id='$id_img'";
    $run_delete = mysqli_query($con, $delete_img);

    if($run_delete) {
        $error = false;
    }
}

$out = array(
    'error' => $error
);

echo json_encode($out);