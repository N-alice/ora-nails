<!-- user profile  -->
<div id="user_profile<?php echo $_SESSION['user']['id']; ?>" class="modal">
    <form class="modal-content animate" action="index.php?page=portal" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('user_profile<?php echo $_SESSION['user']['id']; ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="./images/user.png" alt="user icon" style="width:80px; height: 80px;" class="Profile">
        </div>
        <div class="container">    
            
            <!--   <label for="">Id</label> -->
                <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['user']['id']; ?>">
            <div class="input-group">
                <label>First Name</label>
                <input type="text" name="fname" placeholder="First Name" value="<?php echo $_SESSION['user']['fname']; ?>">
            </div>
            <div class="input-group">
                <label>Last Name</label>
                <input type="text" name="lname" placeholder="Last Name" value="<?php echo $_SESSION['user']['lname']; ?>">
            </div><br>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="utype" value="<?php echo $_SESSION['user']['uname']; ?>" disabled>
            </div>
            <div class="input-group">
                <label>Phone No.: </label>
                <input type="text" name="contact" value="<?php echo $_SESSION['user']['phone_no']; ?>">
            </div>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="edit_user_btn">Edit Profile</button>
            <button type="button" onclick="document.getElementById('user_profile<?php echo $_SESSION['user']['id']; ?>').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>

<!-- Add Branches  -->
<div id="add_branch" class="modal">
    <form class="modal-content animate" action="index.php?page=dashboard" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('add_branch').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="las la-building" style="font-size:64px;"></span>
        </div>
        <div class="container">    
            
            <div class="input-group">
                <label>Branch</label>
                <input type="text" name="branch" placeholder="Branch...">
            </div>
            <div class="input-group">
                <label>Location</label>
                <input type="text" name="location" placeholder="Location...">
            </div>
            <div class="input-group">
                                    <label for="">Staff</label>
                                    <select name="manager" id="">
                                        <option value="" selected disabled> Choose One...</option>
                                        <?php
                                        get_employees();
                                        if(mysqli_num_rows($get_employees_results) > 0){
                                            while($row = mysqli_fetch_array($get_employees_results)){
                                                echo "<option value= ". $row['fname'] .">" .$row['fname'] ." " .$row['lname'] ."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="add_branches_btn">Add Branch</button>
            <button type="button" onclick="document.getElementById('add_branch').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>

<!-- Add Employee  -->
<div id="add_employee" class="modal">
    <form class="modal-content animate" action="index.php?page=dashboard" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('add_employee').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="las la-users" style="font-size:64px;"></span>
        </div>
        <div class="container">   
                    <input type="text" name="fname" id="fname" placeholder=" Employee's first Name">
                    <input type="text" name="lname" id="lname" placeholder=" Employee's last Name">
                    <input type="email" name="email" id="email" placeholder=" Employee's email">
                    <input type="text" name="contact" id="contact" placeholder="+254 722 000000">
                    <select name="gender" id="gender">
                        <option value="" selected disabled>Choose employee's gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <input type="password" name="password" id="password" placeholder="Employee's password">
                    <input type="password" name="password_1" id="password_1" placeholder=" Confirm Employee's password"> 
                    <select name="designation" id="designation">
                    <option value="" disabled selected>Select Designation</option>
                        <?php 
                            get_designations();                            
                            if(mysqli_num_rows($get_designations_results) > 0){
                                while($row = mysqli_fetch_array($get_designations_results)){
                                    echo "<option value=" .$row['id']."> " .$row['designation_name']."</option>";
                                }
                            }
                        ?>
                    </select>
                    <select name="branch" id="branch">
                    <option value="" disabled selected>Select Branch</option>
                        <?php 
                            get_branches();                            
                            if(mysqli_num_rows($get_branches_results) > 0){
                                while($row = mysqli_fetch_array($get_branches_results)){
                                    echo "<option value=" .$row['id']."> " .$row['bname']."</option>";
                                }
                            }
                        ?>
                    </select>
            
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="add_employees_btn">Add Employee</button>
            <button type="button" onclick="document.getElementById('add_employee').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>

<!-- add Designation -->
<div id="add_designation" class="modal">
    <form class="modal-content animate" action="index.php?page=users" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('add_designation').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="las la-user-tag" style="font-size:64px;"></span>
        </div>
        <div class="container">    
            
            <div class="input-group">
                <label>Designation</label>
                <input type="text" name="designation" placeholder="Designation...">
            </div>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="add_designations_btn">Add Designation</button>
            <button type="button" onclick="document.getElementById('add_designation').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>

<!-- Add Role  -->
<div id="add_role" class="modal">
    <form class="modal-content animate" action="index.php?page=users" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('add_role').style.display='none'" class="close" title="Close Modal">&times;</span>
            <span class="las la-user-cog" style="font-size:64px;"></span>
        </div>
        <div class="container">   
                    <select name="email_id" id="id">
                    <option value="" disabled selected>Select Employees</option>
                        <?php 
                            get_employees();                            
                            if(mysqli_num_rows($get_employees_results) > 0){
                                while($row = mysqli_fetch_array($get_employees_results)){
                                    echo "<option value=" .$row['id']."> " .$row['fname'].' '.$row['lname']. ' (' .$row['email']. ')'."</option>";
                                }
                            }
                        ?>
                    </select>
                    <select name="designation" id="designation">
                    <option value="" disabled selected>Select Designation</option>
                        <?php 
                            get_designations();                            
                            if(mysqli_num_rows($get_designations_results) > 0){
                                while($row = mysqli_fetch_array($get_designations_results)){
                                    echo "<option value=" .$row['id']."> " .$row['designation_name']."</option>";
                                }
                            }
                        ?>
                    </select>
            
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" name="update_roles_btn">Update Role</button>
            <button type="button" onclick="document.getElementById('add_role').style.display='none'" class="cancelbtn" >Cancel</button>
        </div>
    </form>
</div>

