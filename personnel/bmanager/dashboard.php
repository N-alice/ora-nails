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
                    <span>Branch</span>
                </div>
                <div>
                    <span class="las la-code-branch"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php count_services(); ?></h1>
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
            <!-- <div class="questions">
                <div class="card">
                    <div class="card-header">
                        <h2>Employees</h2>
                        <button onclick="document.getElementById('add_branch').style.display='block'">Add Branch  <span class="las la-plus"></span></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>S/N</td>
                                        <td>Employees</td>
                                        <td>Location</td>
                                        <td>Branch Manager</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        branch_name();
                                        if(mysqli_num_rows($get_branches_results)>0){
                                            while($row =mysqli_fetch_array($get_branches_results)){
                                        ?>  
                                            <tr>  
                                                <td><?php echo $row['id']; ?></td> 
                                                <td><?php echo $row['bname']; ?></td> 
                                                <td><?php echo $row['location']; ?></td> 
                                                <td><?php echo $row['bmanager']; ?></td> 
                                                
                                                <td><a href="#delete_branch?id=<?php echo $row['id']; ?>" onclick="document.getElementById('delete_branch?id=<?php echo $row['id']; ?>').style.display='block'"><span class="las la-trash"></span></a></td>
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

            </div> -->
            <div class="users">
                <div class="card">
                    <div class="card-header">
                        <h3>Employees</h3>

                        <button onclick="document.getElementById('add_employee').style.display='block'">Add Employees  <span class="las la-plus"></span></button>
                    </div>
                    <div class="card-body">
                        <?php
                            filter_employ();                            
                                if(mysqli_num_rows($filter_employees_results)>0){
                                    while($row=mysqli_fetch_array($filter_employees_results)){
                                    
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
                                    
                                    mysqli_free_result($filter_employees_results);
                                    
                                }
                            
                        ?>
                    </div>
                </div>
            </div>

            <div class="users">
                <div class="card">
                    <div class="card-header">
                        <h3>Reports</h3>
                        <form action="index.php?page=dashboard" method="post">
                            <!-- <a href="../generate_excel.php"><span class="las la-file-export" style="font-size:32px;"></span></a> -->
                           

                            <button name="data_export_btn">Export Report  <span class="las la-file-export" style="font-size:16px;"></span></button>
                        </form>
                        <!-- <button onclick="data_export()">Export Report  <span class="las la-file-export" style="font-size:16px;"></span></button> -->
                        <!-- <a href="../generate_excel.php"><span class="las la-file-export" style="font-size:32px;"></span></a> -->
                        <a href="index.php?download_btn=true"><span class="las la-file-download" style="font-size:32px;"></span></a>
                        <!-- <button type="submit" id="dataExport" name="data_export_btn" value="Export to excel" class="success">Export</button> -->
                    </div>
                    <div class="card-body"> 
                            <div class="user">
                                <div class="info">
                                    <!-- <img src="../../images/user.png" width="30px" height="30px" alt="User"> -->
                                    
                                    <div>  
                                        <h4>

                                        </h4>
                                        <small></small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <!-- <span class="las la-user-circle"></span>
                                    <span class="las la-comment"></span> -->
                                   
                                    <!-- <a href="#tel:<?php $contact ?>" onclick="call()"><span class="las la-phone"></span></a> -->
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        