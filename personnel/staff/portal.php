        <div class="recent-grid" style="grid-template-columns: 100%;!important">
            <div class="questions">
                <div class="card">
                    <div class="card-header">
                        <h2>Upcoming Appointments</h2>
                        <!-- <button onclick="document.getElementById('add_designation').style.display='block'">Add Designation  <span class="las la-plus"></span></button> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <thead>  
                                    <tr>  
                                        <td><span class="las la-sort-amount-down" style="font-size:32px;" onclick="sortTable()"></span></td>
                                        <td>Name</td>
                                        <td>Agent</td>
                                        <td>Service</td>
                                        <td>Appointment Day</td>
                                        <td>Special Request</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>  
                                </thead>  
                                <tbody>  
                                    <?php  
                                    
                                    get_pending_appointments();
                                    $u=1;
                                    if(mysqli_num_rows($get_pending_appointments_results) > 0){
                                    while ($row = mysqli_fetch_array($get_pending_appointments_results)) { 
                                    ?>  
                                        <tr>  
                                            <td><?php echo $u++ ?></td>
                                            <td><?php echo $row["first_name"].' '.$row['last_name']; ?></td> 
                                            <td><?php echo $row["fname"].' ' .$row["lname"]; ?></td> 
                                            <td><?php echo $row["serve_name"]; ?></td> 
                                            <td><?php echo $row["appointment_date"]; ?></td> 
                                            <td><?php echo $row["speciality"]; ?></td>
                                            <td><?php echo $row["status"]; ?></td> 
                                            <!-- <td><a href="#edit_appointment?id=<?php echo $row['Id']; ?>" onclick="document.getElementById('edit_appointment?id=<?php echo $row['Id']; ?>').style.display='block'"><span class="las la-edit" style="font-size:24px;"></span></a></td> -->
                                            <td><a href="#edit_app?id=<?php echo $row['Id']; ?>" onclick="document.getElementById('edit_app?id=<?php echo $row['Id']; ?>').style.display='block'"><span class="las la-edit" style="font-size:24px;"></span></a>
                                                    
                                                    <?php include('../appointment.php'); ?>
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
            
        </div>