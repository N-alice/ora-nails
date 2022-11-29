<div class="recent-grid">
            <div class="questions">
                <div class="card">
                    <div class="card-header">
                        <h2>Services</h2>
                        <!-- <button>Add Services  <span class="las la-plus"></span></button> -->
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form class="modal-content animate" action="index.php?page=services" method="post">
                                <div class="imgcontainer">
                                    <!-- <span onclick="document.getElementById('add_designation').style.display='none'" class="close" title="Close Modal">&times;</span> -->
                                    <span class="lab la-servicestack" style="font-size:64px;"></span>
                                </div>
                                <div class="container">    
                                    <!-- <h2>Services</h2> -->
                                    <div class="input-group">
                                        <label>Services</label>
                                        <input type="text" name="service" placeholder="Services offered...">
                                    </div>
                                    <div class="input-group">
                                        <label>Price</label>
                                        <input type="text" name="price" placeholder="Service price...">
                                    </div>
                                </div>
                                <div class="container" style="background-color:#f1f1f1">
                                    <button type="submit" name="add_services_btn">Add Services</button>
                                    <!-- <button type="button" onclick="document.getElementById('add_designation').style.display='none'" class="cancelbtn" >Cancel</button> -->
                                </div>
                            </form>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="users">
                <div class="card">
                    <div class="card-header">
                        <h3>Services</h3>

                        <!-- <button onclick="document.getElementById('add_employee').style.display='block'">Add Employees  <span class="las la-plus"></span></button> -->
                    </div>
                    <div class="card-body">
                        <?php
                            get_services();
                            if($get_services_results){
                                if(mysqli_num_rows($get_services_results)>0){
                                    while($row=mysqli_fetch_array($get_services_results)){
                                    
                                ?>   
                            <div class="user">
                                <div class="info">
                                    <!-- <img src="./images/user.png" width="30px" height="30px" alt="User"> -->
                                    <i class="las la-spa" style="font-size:32px;"></i>
                                    
                                    <div>  
                                        <h4>
                                            <?php  echo $row['serve_name']; ?>
                                        </h4>
                                        <!-- <small><?php echo $row['id']; ?></small> -->
                                    </div>
                                </div>
                                <div class="contact">
                                    <a href="#edit_services?id=<?php echo $row['id']; ?>" onclick="document.getElementById('edit_services?id=<?php echo $row['id']; ?>').style.display='block'"><span class="las la-edit" style="font-size:24px;"></span></a> 
                                    <a href="#delete_services?id=<?php echo $row['id']; ?>" onclick="document.getElementById('delete_services?id=<?php echo $row['id']; ?>').style.display='block'"><span class="las la-trash" style="font-size:24px;"></span></a> 
                                    <?php include('../../button.php'); ?>
                                </div>
                            </div>
                                <?php 
                                    }
                                    
                                    mysqli_free_result($get_services_results);
                                    
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
    </div>
                