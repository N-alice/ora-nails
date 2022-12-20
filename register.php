<?php
    include('./includes/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="./css/responsive.css">
    <script src="./js/script.js"></script>
    <title>Register</title>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form class="login-form" action="register.php" method="post">
            <img src="./images/logo.jfif" width="100px" height="80px" alt="Ora Nail Spot">                
                    <?php display_errors(); ?>
                    <input type="text" name="fname" id="fname" placeholder=" Insert Your first Name">
                    <!-- <p id="test"></p> -->
                    <input type="text" name="lname" id="lname" placeholder=" Insert Your last Name">
                    <input type="email" name="email" id="email" placeholder=" Insert Your email">
                    <input type="text" name="contact" id="contact" placeholder="+254 722 000000">
                    <input type="password" name="password" id="password" placeholder=" Insert Your password">
                    <input type="password" name="password_1" id="password_1" placeholder=" Confirm your password">
                    
                    <button type="submit" name="register_btn">Submit</button>
                <p class="message">Already registered? <a href="login.php">Sign In</a></p>                
            </form>
        </div>
    </div>
</body>
</html>