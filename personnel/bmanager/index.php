<?php
    include('../includes/functions.php');
    if(!$_SESSION['user']){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <!-- Header -->
<?php include('header.php'); ?>
<body>
<!-- Sidebar -->
    <?php include('sidebar.php'); ?>  
<!-- Header -->
<div class="main-content">
<?php include('topbar.php'); ?> 

    <!-- main content -->
    <main>
    <?php $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; ?>
    <?php include $page.'.php'; ?>

    <!-- If page doesn't exist 404 error  -->
    <?php
    $file = $page.'.php';
        if(file_exists($file)){
            '';
        }else{
            include ('404.php');
        }
    ?> 
    </main>
</div>
</body>
</html>