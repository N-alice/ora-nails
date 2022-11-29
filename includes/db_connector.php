<?php
    //$servername = "localhost";
    $db_host    = "localhost";
    $db_uname   = "root";
    $db_pass    = "";
    $db_name    = "spa";

    $conn = mysqli_connect($db_host, $db_uname, $db_pass, $db_name);

    if(!$conn){
        echo "Error Occured: Error =" .mysqli_connect_error();
    }
?>