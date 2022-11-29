<?php
  
    // Get the user id 
    $id = $_REQUEST['id'];
    // $id = "3";
    
    // Database connection
    include('db_connector.php'); 
    
        
        // Get corresponding first name and 
        // last name for that user id    
        $query = mysqli_query($conn, "SELECT * FROM employees WHERE branch='$id'");
    
        $data = [];

        while($row = mysqli_fetch_array($query)){
            $data[] = [
                'id' => $row['id'],
                'fname' => $row['fname']
            ];
        }

    
    // Send in JSON encoded form
    $myJSON = json_encode($data);
    echo $myJSON;
?>