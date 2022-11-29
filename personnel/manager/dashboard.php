<div class="cards">
            <div class="card-single">
                <div>
                    <h1>
                        <?php 
                            get_branches(); 
                            $rowCount = mysqli_num_rows($get_branches_results);
                            echo($rowCount);                            
                        ?>
                    </h1>
                    <span>Branches</span>
                </div>
                <div>
                    <span class="las la-code-branch"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php count_users(); ?></h1>
                    <span>Services</span>
                </div>
                <div>
                    <span class="lab la-servicestack"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php count_users(); ?></h1>
                    <span>Appointments</span>
                </div>
                <div>
                    <span class="las la-calendar-check"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php count_employ(); ?></h1>
                    <span>Employees</span>
                </div>
                <div>
                    <span class="las la-users"></span>
                </div>
            </div>
        </div>
        <div class="recent-grid">
            <div class="questions">
                <div class="card">
                    <div class="card-header">
                        <h2>Branches</h2>
                        <button onclick="document.getElementById('add_branch').style.display='block'">Add Branch  <span class="las la-plus"></span></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>S/N</td>
                                        <td>Branch</td>
                                        <td>Location</td>
                                        <td>Branch Manager</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $u=1;
                                        $get_branches = "SELECT br.id as id,br.bname,br.location, emp.fname,emp.lname FROM `branches` br inner join employees as emp on emp.id = br.bmanager;";
                                        $get_branches_results = mysqli_query($conn, $get_branches);
                                        if(mysqli_num_rows($get_branches_results)>0){
                                            while($row =mysqli_fetch_array($get_branches_results)){
                                        ?>  
                                            <tr>  
                                                
                                                <td><?php echo $u++; ?></td> 
                                                <td><?php echo $row['bname']; ?></td> 
                                                <td><?php echo $row['location']; ?></td> 
                                                <td><?php echo $row['fname']. ' '. $row['lname']; ?></td> 
                                                <td><a href="#delete_branch?id=<?php echo $row['id']; ?>" onclick="document.getElementById('delete_branch?id=<?php echo $row['id']; ?>').style.display='block'"><span class="las la-trash" style="font-size:24px;"></span></a>
                                                <?php include('../../button.php'); ?>
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
                        <h3>Employees</h3>

                        <button onclick="document.getElementById('add_employee').style.display='block'">Add Employees  <span class="las la-plus"></span></button>
                    </div>
                    <div class="card-body">
                        <?php
                            // count_employ();
                            if($count_employees_results){
                                if(mysqli_num_rows($count_employees_results)>0){
                                    while($row=mysqli_fetch_array($count_employees_results)){
                                    
                                ?>   
                            <div class="user">
                                <div class="info">
                                    <img src="../../images/user.png" width="30px" height="30px" alt="User">
                                    
                                    <div>  
                                        <h4>
                                            <?php  echo $row['fname']; ?>
                                        </h4>
                                        <small><?php echo $row['lname']; ?></small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="las la-user-circle"></span>
                                    <span class="las la-comment"></span>
                                   
                                    <a href="#tel:<?php $contact ?>" onclick="call()"><span class="las la-phone"></span></a>
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
                                    
                                    mysqli_free_result($count_employees_results);
                                    
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        