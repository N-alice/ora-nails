
        <div class="recent-grid" style="grid-template-columns: 100%;!important">
            <div class="questions">
                <div class="card">
                    <div class="card-header">
                        <h2>Appointment History</h2>
                        <!-- <button onclick="document.getElementById('add_designation').style.display='block'">Add Designation  <span class="las la-plus"></span></button> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <p>
                               <a href="index.php?download_btn=true"><span class="las la-file-download" style="font-size:32px;"></span></a> 
                            </p>
                            <div id="target-content">
                                <div id="div1" class="fa"></div>
                                    <span class="fa fa-spinner fa-spin" style="font-size:36px"> </span>
                                </div>
                                <?php
                                    include('../includes/db_connector.php'); 
                                    $limit = 9;
                                    $sql = "SELECT COUNT(id) FROM appointments";  
                                    $rs_result = mysqli_query($conn, $sql);  
                                    $row = mysqli_fetch_row($rs_result);  
                                    $total_records = $row[0];  
                                    $total_pages = ceil($total_records / $limit); 
                                ?>
                                <div class="center">
                                <?php 
                                    if(!empty($total_pages)){
                                        for($i=1; $i<=$total_pages; $i++){
                                                if($i == 1){
                                                    ?>
                                                    
                                                        <div class="pagination active" id="<?php echo $i;?>">
                                                            <a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link" ><?php echo $i;?></a>
                                                        </div>
                                                                        
                                                        <?php 
                                                            }
                                                            else{
                                                        ?>
                                                        <div class="pagination" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></div>
                                                    
                                                
                                                <?php
                                                }
                                        }
                                    }
                                ?>
                            </div> 
                        </div>    
                    </div>
                </div>

            </div>
            
        </div>
       