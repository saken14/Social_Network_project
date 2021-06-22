<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_email'])) {
    header("location: index.php");
} 

$old_email = $user_email;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile</title>
    <meta name="keywords" content="KIT, Keep in Touch, social network">
    <meta name="description" content="KIT (Keep in Touch) is a social network developed by students of IITU">
    <link rel="shortcut icon" href="assets/img/icon2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main">
        <?php include("includes/header.php"); ?>

        <div class="site_content">
            <?php include("aside_for_profile.php"); ?>

            <div class="content"> 
                <center><h2>Edit account</h2></center>
                <hr><br>
                <div class='edit_container'>
                    <form action='' id='f' method='post' enctype='multipart/form-data'>
                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>First name: </label>
                        </div>

                        <div class='input_container'>
                            <input type='text' name='f_name' required value='<?php echo $first_name; ?>'>
                        </div>
                    </div>

                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>Last name: </label>
                        </div>

                        <div class='input_container'>
                            <input type='text' name='l_name' required value='<?php echo $last_name; ?>'>
                        </div>
                    </div>

                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>Description: </label>
                        </div>

                        <div class='input_container'>
                            <textarea type='text' maxlength='150' name='describe_user' required='required'><?php echo $describe_user; ?></textarea>
                        </div>
                    </div>

                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>Relationship: </label>
                        </div>

                        <div class='input_container'>
                            <select name="relationship" required="required">
                                <option hidden selected><?php echo $relationship_status; ?></option>
                                <option>Not specified</option>
                                <option>Not married</option>
                                <option>Married</option>
                                <option>Divorced</option>
                                <option>Engaged</option>
                                <option>Single</option>
                                <option>It's complicated</option>
                                <option>Actively looking</option>
                            </select>
                        </div>
                    </div>

                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>Password: </label>
                        </div>

                        <div class='input_container'>
                            <input type='password' id='pass_edit' name='u_pass' required value='<?php echo $user_pass; ?>'>
                            <p onclick="showPasswordEdit()">Show password</p>
                        </div>
                    </div>

                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>Email: </label>
                        </div>

                        <div class='input_container'>
                            <input type='text' name='u_email' required value='<?php echo $user_email; $old_email = $user_email;?>'>
                        </div>
                    </div>

                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>City: </label>
                        </div>

                        <div class='input_container'>
                            <select name="u_city" required="required">
                                <option hidden selected><?php echo $user_city; ?></option>
                                <option>Almaty</option>
                                <option>Nur-Sultan
                                    (Astana)</option>
                                <option>Shymkent</option>
                                <option>Aktobe</option>
                                <option>Karaganda</option>
                                <option>Taraz
                                    (Zhambyl)</option>
                                <option>Pavlodar</option>
                                <option>Ust-Kamenogorsk</option>
                                <option>Atyrau</option>
                                <option>Semei</option>
                                <option>Kostanay</option>
                                <option>Kyzylorda</option>
                                <option>Aktau</option>
                                <option>Turkestan</option>
                                <option>Kokshetau</option>
                                <option>Taldykorgan</option>
                                <option>Kentau</option>
                                <option>Zhetysai</option>
                            </select>
                        </div>
                    </div>

                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>Gender: </label>
                        </div>

                        <div class='input_container'>
                            <select name="u_gender" required="required">
                                <option hidden selected><?php echo $user_gender; ?></option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Not specified</option>
                            </select>
                        </div>
                    </div>

                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>Birthday: </label>
                        </div>

                        <div class='input_container'>
                            <input type='date' name='u_birthday' required value='<?php echo $user_birthday_e; ?>'>
                        </div>
                    </div>

                    <div class='edit_container_inner'>
                        <div class='label_container'>
                            <label>Forgotten password: </label>
                        </div>

                        <div class='input_container'>
                            <button type='button' id='recover_btn'>Turn on</button>

                            <div class='modal'>
                                <div class='modal_content'>
                                    <span class='close'>&#10006;</span>

                                    <form action="recovery.php?u_id='<?php echo $user_id; ?>'" method='post'>
                                    <div class='edit_container_inner modal_i'>
                                        <div class='label_container modal_i'>
                                            <label>What is your school best friend name?  </label>
                                        </div>

                                        <div class='input_container modal_i'>
                                            <input type='text' name='content' placeholder='Name...' autocomplete='off'>
                                        </div>
                                        <input type='submit' class='edit_save' id='edit_save' name='sub' value='Submit'>
                                    </div>
                                    </form>

                                    <h5>We will ask this question if you forgot your password.</h5><br>

                                    <?php
                                    if(isset($_POST['sub'])) {
                                        $bfn = htmlentities($_POST['content']);
                                        $bfn = trim($bfn);

                                        if($bfn == '') {
                                            echo "<script>alert('Please enter a name of your best friend!')</script>";
                                            echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
                                            exit();
                                        }
                                        else {
                                            $update = "update users set recovery_acc='$bfn' where user_id='$user_id'";
                                            $run = mysqli_query($con, $update);
                                            if($run) {
                                                echo "<script>alert('Saved a name of your best friend!')</script>";
                                                echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
                                            }
                                            else {
                                                echo "<script>alert('Error occurred while updating a data!')</script>";
                                                echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
                                            }
                                        }
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type='submit' form='f' class='edit_save' name='save' value='Save'>

                    </form>
                </div>

            </div>
        </div>

        <footer>

        </footer>

    </div>

    <div id="go_top">Go Top</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function showPasswordEdit() {
            var n = document.getElementById("pass_edit");
            if(n.type === "password") {
                n.type = "text";
            }
            else {
                n.type = "password";
            }
        }



        var modal = document.querySelector(".modal");
        var btn = document.getElementById("recover_btn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
        modal.style.display = "block";
        }
        span.onclick = function() {
        modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script src="script.js"></script>
</body>

</html>

<?php
if(isset($_POST['save'])) {
    $f_name = htmlentities($_POST['f_name']);
    $l_name = htmlentities($_POST['l_name']);
    $describe_user = htmlentities($_POST['describe_user']);
    $relationship = htmlentities($_POST['relationship']);
    $u_pass = htmlentities($_POST['u_pass']);
    $u_email = htmlentities($_POST['u_email']);
    $u_city = htmlentities($_POST['u_city']);
    $u_gender = htmlentities($_POST['u_gender']);
    $u_birthday = htmlentities($_POST['u_birthday']);

    $update = "update users set f_name='$f_name', l_name='$l_name', describe_user='$describe_user', relationship='$relationship', user_pass='$u_pass', user_email='$u_email', user_city='$u_city', user_gender='$u_gender', user_birthday='$u_birthday' where user_id='$user_id'";

    $run = mysqli_query($con, $update);

    if($run) {
        if($old_email != $u_email) {
            echo "<script>alert($old_email)</script>";
            echo "<script>alert('Saved! After changing email, you must re-login!')</script>";
            echo "<script>setTimeout(window.open('index.php', '_self'), 3000); </script>";
        }
        else {
            echo "<script>alert('Saved!')</script>";
            echo "<script>setTimeout(window.open('edit_profile.php?u_id=$user_id', '_self'), 3000); </script>";
        }
        echo "<script>alert('Saved!')</script>";
        echo "<script>setTimeout(window.open('edit_profile.php?u_id=$user_id', '_self'), 3000); </script>";
    }
    else {
        echo "<script>alert('Error occurred while updating a data! 222')</script>";
        echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
    }
}
?>