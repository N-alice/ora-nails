<div class="cards">
            <div class="card-single">
                <div>
                    <h1>
                        <?php count_users(); ?>
                    </h1>
                    <span>Clients</span>
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
                    <h1><?php count_employ(); ?></h1>
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
                        <h3>Edit Roles</h3>

                        <button onclick="document.getElementById('add_role').style.display='block'">Add Role  <span class="las la-plus"></span></button>
                    </div>
                    <div class="card-body">
                           
                            <div class="user">
                                <div class="info">
                                    <!-- <img src="./images/user.png" width="30px" height="30px" alt="User"> -->
                                    
                                    <div>  
                                        <h4>
                                            Reports
                                        </h4>
                                        <small>
                                            <form action="index.php?page=users" method="post">
                                                <!-- <a href="../generate_excel.php"><span class="las la-file-export" style="font-size:32px;"></span></a> -->
                                           

                                                <button name="manager_data_export_btn">Export Spreadsheet Report   <span class="las la-file-export" style="font-size:16px;"></span></button>
                                            </form>
                                        </small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <a href="index.php?download_btn=true"><span class="las la-file-download" style="font-size:32px;"></span></a>
                                </div>
                            </div>
                                
                    </div>
                </div>
            </div>
        </div>
        