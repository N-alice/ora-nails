<?php
    include('../includes/db_connector.php'); 
    $limit = 10;  
    if (isset($_GET["page"])) { 
        $page  = $_GET["page"]; 
    }else {
        $page=1; 
    };  
    $start_from = ($page-1) * $limit;  
    $u= 1;
    $sql = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id 
    INNER JOIN users ON users.id=appointments.user_id 
    INNER JOIN employees ON employees.id=appointments.agent ORDER BY appointments.id ASC LIMIT $start_from, $limit";  
    
    $rs_result = mysqli_query($conn, $sql);  
    
?>
<!-- <table class="table table-bordered table-striped">   -->
<table width="100%" id="myTable">
    <thead>  
        <tr>  
            <td><span class="las la-sort-amount-down" style="font-size:32px;" onclick="sortTable()"></span></td>
            <td>Name</td>
            <td>Agent</td>
            <td>Service</td>
            <td>Appointment Day</td>
            <td>Special Request</td>
            <td>Status</td>
            
        </tr>  
    </thead>  
    <tbody>  
    <?php  
    if(mysqli_num_rows($rs_result) > 0){
    while ($row = mysqli_fetch_array($rs_result)) { 
    ?>  
        <tr>  
            <td><?php echo $u++ ?></td>
            <td><?php echo $row["first_name"].' '.$row['last_name']; ?></td> 
            <td><?php echo $row["fname"].' ' .$row["lname"]; ?></td> 
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
