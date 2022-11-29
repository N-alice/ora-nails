<?php
    include('./includes/functions.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/responsive.css">
    <script src="./js/script.js"></script>
    <title>Login</title>
  
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="login-form" action="login.php" method="post">
            <img src="./images/logo.jfif" width="100px" height="80px" alt="Ora Nail Spot">
            <?php display_errors(); ?>
            <input type="email" name="email" id="email" placeholder="Enter Email">
            
            <input type="password" name="password" id="password" placeholder="Enter password">
            <input type="password" name="password_1" id="password" placeholder="Confirm password">
           
            <button type="submit" name="reset_user__password_btn">Reset</button>
            <!-- <p class="message">Forgot Password? <a href="register.php">Register your Account</a></p> -->
        </form>
    </div>
</div>

</body>
</html>