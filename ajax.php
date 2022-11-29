<?php
    include('./includes/functions.php'); 
    $limit = 10;  
    if (isset($_GET["page"])) { 
        $page  = $_GET["page"]; 
    }else {
        $page=1; 
    };  
    $start_from = ($page-1) * $limit;  
    
    $logged_in_user_id = $_SESSION['user']['id'];
    $sql = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id 
    INNER JOIN users ON users.id=appointments.user_id
    INNER JOIN employees ON employees.id=appointments.agent WHERE users.id='$logged_in_user_id' ORDER BY appointments.id ASC LIMIT $start_from, $limit";  
    
    $rs_result = mysqli_query($conn, $sql);  
    
?>
<!-- <table class="table table-bordered table-striped">   WHERE users.id='$logged_in_user_id' -->
<table width="100%" id="myTable">
    <thead>  
        <tr>  
            <td><span class="las la-sort-amount-down" style="font-size:32px;" onclick="sortTable()"></span></td>
            <td>Client</td>
            <td>Agent</td>
            <td>Name</td>
            <td>Service</td>
            <td>Appointment Day</td>
            <td>Special Request</td>
            <td>Status</td>
            
        </tr>  
    </thead>  
    <tbody>  
    <?php  
    $x = 1;
    if(mysqli_num_rows($rs_result) > 0){
    while ($row = mysqli_fetch_array($rs_result)) { 
    ?>  
        <tr>  
            <td><?php echo $x++; ?></td> 
            <td><?php echo $row["fullname"]; ?></td> 
            <td><?php echo $row["fname"].' ' .$row["lname"]; ?></td> 
            <td><?php echo $row["first_name"].' ' .$row["last_name"]; ?></td> 
            <td><?php echo $row["serve_name"]; ?></td> 
            <td><?php echo $row["appointment_date"]; ?></td> 
            <td><?php echo $row["speciality"]; ?></td> 
            <td><?php echo $row["status"]; ?></td> 
           
        </tr>  
    <?php  
    }};  
    ?>  
    </tbody>  
</table>  
