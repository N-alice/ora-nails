<div class="cards">
            <div class="card-single">
                <div>
                <h1>
                        <?php 
                            branch_name();
                            if(mysqli_num_rows($sql_results)==1){
                                $branch_name = mysqli_fetch_assoc($sql_results);
                                echo $branch_name['bname'];
                            }
                        ?>
                    </h1>
                    <span>Users</span>
                </div>
                <div>
                    <span class="las la-users"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php count_designations(); ?></h1>
                    <span>Designations</span>
                </div>
                <div>
                    <span class="las la-user-tag"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php count_branch_managers(); ?></h1>
                    <span>Branch Managers</span>
                </div>
                <div>
                    <span class="las la-user-alt"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php branch_employees(); ?></h1>
                    <span>Employees</span>
                </div>
                <div>
                    <span class="las la-user-friends"></span>
                </div>
            </div>
        </div>
        <div class="recent-grid">
            <div class="questions">
                <div class="card">
                    <div class="card-header">
                        <h2>Designation</h2>
                        <button onclick="document.getElementById('add_designation').style.display='block'">Add Designation  <span class="las la-plus"></span></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>S/N</td>
                                        <td>Designation Name</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                        get_designations();
                                        if(mysqli_num_rows($get_designations_results)>0){
                                        while($row =mysqli_fetch_array($get_designations_results)){
                                        ?>  
                                            <tr>  
                                                <td><?php echo $row['id']; ?></td> 
                                                <td><?php echo $row['designation_name']; ?></td> 
                                                <td>
                                                    <a href="#edit_designations?id=<?php echo $row['id']; ?>" onclick="document.getElementById('edit_designations?id=<?php echo $row['id']; ?>').style.display='block'"><span class="las la-edit" style="font-size:24px;"></span></a>
                                                    
                                                   <?php include('../../button.php'); ?>
                                                </td>
                                            </tr> 
                                            
                                        <?php 
                                         
                                            }};  
                                        ?> 
                                </tbody>
                            </table>
                        </div>    
                    </div>
                </div>

            </div>
            <div class="users">
                <div class="card">
                    <div class="card-header">
                        <h3>Roles</h3>

                        <button onclick="document.getElementById('add_role').style.display='block'">Edit Role  <span class="las la-plus"></span></button>
                    </div>
                    <div class="card-body">
                        <?php
                            employees();
                            if($employees_results){
                                if(mysqli_num_rows($employees_results)>0){
                                    while($row=mysqli_fetch_array($employees_results)){
                                    
                                ?>   
                            <div class="user">
                                <div class="info">
                                    <!-- <img src="./images/user.png" width="30px" height="30px" alt="User"> -->
                                    
                                    <div>  
                                        <h4>
                                            <?php  echo $row['fname']. ' ' .$row['lname'];; ?>
                                        </h4>
                                        <small><?php echo $row['designation_name']; ?></small>
                                    </div>
                                </div>
                                <div class="contact">
                                <!-- <a href="#edit_roles?id=<?php echo $row['id']; ?>" onclick="document.getElementById('edit_roles?id=<?php echo $row['id']; ?>').style.display='block'"><span class="las la-trash" style="font-size:24px;"></span></a> -->
                                    <!-- <a href="#delete_designations?id=<?php echo $row['id']; ?>" onclick="document.getElementById('delete_designations?id=<?php echo $row['id']; ?>').style.display='block'"><span class="las la-trash" style="font-size:24px;"></span></a> -->
                                   
                                    <!-- <a href="#tel:<?php $contact ?>" onclick="call()"><span class="las la-phone"></span></a> -->
                                </div>
                            </div>
                                <?php 
                                $contact = $row['phone_no'];
                                echo "<script>
                                    function call() {
                                        window.open('tel:$contact');
                                    }
                                </script>";
                                    }
                                    
                                    mysqli_free_result($employees_results);
                                    
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        