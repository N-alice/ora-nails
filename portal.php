<div class="cards">
            <div class="card-single">
                <div>
                    <h1>
                        <?php count_branches(); ?>
                    </h1>
                    <span>Branches</span>
                </div>
                <div>
                    <span class="las la-code-branch"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php count_appointments(); ?></h1>
                    <span>Pending Appointments</span>
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
        </div>
        <div class="recent-grid">
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
                                        <td>Client</td>
                                        <td>Agent</td>
                                        <td>Name</td>
                                        <td>Service</td>
                                        <td>Service Price</td>
                                        <td>Appointment Day</td>
                                        <td>Special Request</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>  
                                </thead>  
                                <tbody>  
                                    <?php  
                                    $logged_in_user_id = $_SESSION['user']['id']; 
                                    $x = 1;
                                    $get_pending_appointments = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id
                                    INNER JOIN users ON users.id=appointments.user_id INNER JOIN branches ON branches.id=appointments.branches_id
                                    INNER JOIN employees ON employees.id=appointments.agent WHERE users.id='$logged_in_user_id' ";
                                    $get_pending_appointments_results = mysqli_query($conn, $get_pending_appointments);
                                    if(mysqli_num_rows($get_pending_appointments_results) > 0){
                                    while ($row = mysqli_fetch_array($get_pending_appointments_results)) { 
                                    ?>  
                                        <tr>  
                                            
                                            <td><?php echo $x++; ?></td> 
                                            <!-- <td><?php echo $row["Id"]; ?></td>  -->
                                            <td><?php echo $row["bname"]; ?></td> 
                                            <td><?php echo $row["fname"].' ' .$row["lname"]; ?></td> 
                                            <td><?php echo $row["first_name"].' ' .$row["last_name"]; ?></td> 
                                            <td><?php echo $row["serve_name"]; ?></td> 
                                            <td><?php echo $row["price"]; ?></td> 
                                            <td><?php echo $row["appointment_date"]; ?></td> 
                                            <td><?php echo $row["speciality"]; ?></td>
                                            <td><?php echo $row["status"]; ?></td>
                                            <td><a href="#edit_bookings?id=<?php echo $row['Id']; ?>" onclick="document.getElementById('edit_bookings?id=<?php echo $row['Id']; ?>').style.display='block'"><span class="las la-edit" style="font-size:24px;"></span></a>
                                                    
                                                    <?php include('appointments.php'); ?>
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
                        <h3>Schedule Appointments</h3>

                        <!-- <button onclick="document.getElementById('add_role').style.display='block'">Book <span class="las la-plus"></span></button> -->
                    </div>
                    <?php 
                        echo display_errors();
		            ?>
                    <div class="card-body">
                         
                            <div class="user">
                            <form class="modal-content animate" action="index.php?page=portal" method="post">
                                <div class="imgcontainer">
                                    <!-- <span onclick="document.getElementById('add_designation').style.display='none'" class="close" title="Close Modal">&times;</span> -->
                                    <span class="lab la-servicestack" style="font-size:64px;"></span>
                                </div>
                                <div class="container">    
                                    <!-- <h2>Services</h2> -->
                                    <!-- <div class="input-group">
                                        <label for="">Your Name</label>
                                        <input type="text" name="fullname" id="" hidden>
                                    </div> -->
                                    <div class="input-group">
                                        <label>Services</label>
                                        <select name="service">
                                            <option value="" selected disabled>Choose one...</option>
                                            <?php
                                                get_services();
                                                if(mysqli_num_rows($get_services_results) > 0){
                                                    while($row= mysqli_fetch_array($get_services_results)){
                                                       echo "<option value=".$row['id'] .">" .$row['serve_name'] ."</option>"; 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="">Branch</label>
                                        <select name="branch" id="branch" onChange=GetDetail(this.value)>
                                            <option value="" disabled selected> Choose One...</option>
                                            <?php
                                            get_branches();
                                            if(mysqli_num_rows($get_branches_results) > 0){
                                                while($row = mysqli_fetch_array($get_branches_results)){
                                                    echo "<option value= ". $row['id'] .">" .$row['bname'] ."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>     
                                                      
                                    <div class="input-group">
                                        <label for="">Staff</label>
                                        <select name="agent" id="first_name">
                                            <option value="" disabled selected>Select Staff</option>
                                        </select>                                        
                                    </div> 
                                    <div class="input-group">
                                        <label for="">Date</label>
                                        <input type="text" name="scheduled" id="schedule">
                                    </div>
                                   
                                    <div class="input-group">
                                        <label for="">Time</label>
                                        <input type="time" name="schedule_time" id="">
                                    </div>
                                    <div class="input-group">
                                        <label for="">Special Request</label>
                                        <textarea name="speciality" id="" cols="30" rows="10"></textarea>
                                        <!-- <input type="text" name="speciality" id=""> -->
                                    </div>
                                    <div class="input-group">
                                        <!-- <label for="">Status</label> -->
                                        <input type="hidden" name="status" id="" value="pending">
                                    </div>
                                </div>
                                <div class="container" style="background-color:#f1f1f1">
                                    <button type="submit" name="book_appointment_btn">Book</button>
                                    <!-- <button type="button" onclick="document.getElementById('add_designation').style.display='none'" class="cancelbtn" >Cancel</button> -->
                                </div>
                            </form>
                            </div>
                               
                    </div>
                </div>
            </div>
        </div>
       