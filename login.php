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
            <!-- <label for="remember_me">
                <input type="checkbox" id="remember_me" name="remember_me" checked="checked"> <p class="message" style="margin: 0;">Remember me</p> 
            </label> -->
            <button type="submit" name="login_btn">Login</button>
            <p class="message">Not registered? <a href="register.php">Register your Account</a></p>
            <p class="message">Forgot Password? <a href="forgot_password.php">Reset</a></p>
        </form>
        <p class="message">Personnel? <a href="./personnel/login.php">Login</a></p>
    </div>
</div>
<?php
    if(isset($_COOKIE['email']) and isset($_COOKIE['password'])){
        $email = $_COOKIE['email'];
        $password = $_COOKIE['password'];
        echo "<script>
                document.getElementById('email').value = '$email';
                document.getElementById('password').value = '$password';
            </script>";
}
?>
</body>
</html>