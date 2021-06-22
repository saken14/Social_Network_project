<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIT</title>
	<meta name="keywords" content="KIT, Keep in Touch, social network">
	<meta name="description" content="KIT (Keep in Touch) is a social network developed by students of IITU">
    <link rel="shortcut icon" href="assets/img/icon2.png" type="image/x-icon">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="main">

        <div class="description">
            <img src="assets/img/k.jpg" alt="KIT">
            <p>Keep in Touch is the largest social network in the world and the company of the same name Keep in Touch, Inc., which owns it. It was founded on February 4, 2021 by Saken Satenov and his roommates Talgat Kuanysh while studying at IITU.</p>
            <br><br>
            <p>Initially, the website was called In Touch and was available only for students of IITU University, then registration was opened for other universities in Almaty, and then for students of any educational institutions in Kazakhstan with an email address in the .edu domain.</p>
        </div>

        <div class="box">
            <h2>Sign up</h2>

            <form action="" method="POST">
                <div class="inpB">
                    <input type="text" placeholder="" name="first_name" required="required">
                    <label for="">First name</label>
                </div>
                <div class="inpB">
                    <input type="text" placeholder="" name="last_name" required="required">
                    <label for="">Last name</label>
                </div>
                <div class="inpB">
                    <input type="email" placeholder="" name="u_email" required="required">
                    <label for="">Email address</label>
                </div>
                <div class="inpB">
                    <input type="password" placeholder="" name="u_pass" id="password" required="required">
                    <label for="">Password</label>
                </div>

                <div class="show_pass">
                    <label onclick="showPassword()">Show password</label> 
                </div>

                <div class="inpB">
                    <select name="u_city" required="required">
                        <option disabled hidden selected>Select your city</option>
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

                <div class="inpB">
                    <select name="u_gender" required="required">
                        <option disabled hidden selected>Select your gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Not specified</option>
                    </select>
                </div>

                <div class="inpB">
                    <input type="date" placeholder="" name="u_birthday" required="required">
                    <label id="date_label">Date</label>
                </div>

                <button class="btn" id="signup" name="sign_up">Sign up</button>

                <?php include("insert_user.php"); ?>
                
            </form> 

            <center><p>Already have an account? <a href="login.php">Log in</a></p></center>
            
        </div>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>