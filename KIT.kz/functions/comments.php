<?php
$get_id = $_GET['post_id'];
$get_com = "select * from comments where post_id='$get_id' ORDER by 1 DESC";
$run_com = mysqli_query($con, $get_com);

while ($row = mysqli_fetch_array($run_com)) { 
    $com = $row['comment'];
    $com_Fname = $row['author_Fname'];
    $com_Lname = $row['author_Lname'];
    $date = $row['date'];
    $date = date("H:i   F j, Y", strtotime($date));

    $user_id_com = $row['user_id_of_com'];

    $get_user = "select * from users where user_id='$user_id_com'";
    $run_user = mysqli_query($con, $get_user);
    $row_im = mysqli_fetch_array($run_user);

    $user_image = $row_im['user_image'];

    echo "
    <div class='post_container comment'>
        <div class='post_user_img comment'> 
            <img src='../users/$user_image' class='post_ava comment'>
        </div>

        <div class='post_info comment'>
            <div class='post_user_info comment'>
                <p><strong><a href='user_profile.php?u_id=$user_id_com'>$com_Fname $com_Lname</a></strong></p>
                <span class='date_comment'>$date</span>
            </div>

            <div class='post_imgAndContent comment'>
                <p>$com</p>
            </div>

        </div>
    
    </div>
    ";
}
?>