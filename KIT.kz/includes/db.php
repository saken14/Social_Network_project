<?php
$con = mysqli_connect("localhost", 'root', '0tR9RERe8Vp1LrkZ', 'kit_db');

if(!$con) {
    echo ("Not successful");
    echo mysqli_connect_error();
    exit();
}

?>