<?php
    //start sessions
    session_start();

    // Connect to DB
    include('db_connector.php');

    error_reporting(0);

    // Declare Variables
    $errors = array();

    //REGISTER USER

    // Declare register button
    if(isset($_POST['register_btn'])){
        register();
    }
    function register(){
        // variables
        
        global $conn, $errors;

        if(isset($_POST['register_btn'])){
            $fname      = ucfirst($_POST['fname']);
            $lname      = ucfirst($_POST['lname']);
            $email      = strtolower($_POST['email']);
            $uname      = substr($_POST['fname'], 0, 1). '.' .$_POST['lname'];
            $contact    = ($_POST['contact']);
            $password   = $_POST['password'];
            $password_1   = $_POST['password_1'];
            $utype  = 'user';
        }
        // check if fields have been inserted
        if(empty($fname)){
            array_push($errors, 'First Name cannot be blank!');
        }
        if(empty($lname)){
            array_push($errors, 'Last Name cannot be blank!');
        }
        if(empty($email)){
            array_push($errors, 'Email cannot be left blank');
        }
        if(empty($contact)){
            array_push($errors, 'Phone Number is blank');
        }
        if(empty($password)){
            array_push($errors, 'Password is blank');
        }
        if(empty($password_1)){
            array_push($errors, 'Confirm Password is blank');
        }
        // check if passwords are similar
        if(!$password == $password_1){
            array_push($errors, 'Password Mismatch!');
        }
        // Encrypt password if no error & register
        if(count($errors) == 0){
            $password = md5($password);
        
            $sql = "INSERT INTO users (first_name, last_name, email, uname, utype, phone_no, password ) VALUES ('$fname', '$lname', '$email', '$uname', '$utype', '$contact', '$password')";
            $result = mysqli_query($conn, $sql);
            
            header('location:index.php?page=login');
        }else{
            array_push($errors, 'Failed to insert User');
        }
    }

    function display_errors(){
        global $errors;

        if(count($errors) > 0){
            echo '<div class="error">';
            foreach($errors as $error){
                echo $error;
            }
            echo '</div>';
        }
    }

    if(isset($_POST['login_btn'])){
        login();
    }
    function login(){

        global $conn, $errors;

        if(isset($_POST['login_btn'])){

            $email = $_POST['email'];
            $password = $_POST['password'];

            // check if details have been entered
            if(empty($email)){
                array_push($errors, "Email is required!");
            }
            if(empty($password)){
                array_push($errors, "Password is required!");
            }
            // if no error encrypt & login
            if(count($errors) == 0){
                $password = md5($password);

                $log_sql = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
                
                $log_results = mysqli_query($conn, $log_sql);

               if(mysqli_num_rows($log_results) == 1){
                 // check if user is found
                    $logged_in_user = mysqli_fetch_assoc($log_results);
                    session_start();
                     $_SESSION['email'] = $logged_in_user;
                     
                    // Check if admin or staff
                    if($logged_in_user['utype']== "admin"){
                        $_SESSION['user'] = $logged_in_user;
                        // login
                        header('location: ./admin/index.php?page=dashboard');

                    }
                    if($logged_in_user['utype']== "user"){
                        $_SESSION['user']= $logged_in_user;
                        // login user
                        header('location: index.php?page=portal');
                    }
                
                } else{
                    array_push($errors, 'Username or Password is incorrect!');
                }
            }
        }
    }
    // logout
    function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['email']);
        session_destroy();
        setcookie('email', $email, time()-1);
        setcookie('password', $password, time()-1);
        header("location: login.php");
    }
    // CRUD Create - create audit
    if(isset($_POST['create_audit_btn'])){
        create_audit();
    }
    function create_audit(){
        global $conn, $errors;

        if(isset($_POST['create_audit_btn'])){

            $audit_type = $_POST['audit_type'];

            if(empty($audit_type)){
                array_push($errors, "Enter Audit type");
            }
            if(count($errors) == 0){
                
                $audit_sql = "INSERT INTO audits (audit_type) VALUES ('$audit_type')";

                $audit_results = mysqli_query($conn, $audit_sql);
                header('location: audits.php');
            }else{
                array_push($errors, 'Audit Type not inserted');
            }
        }
    }
     // CRUD Create - create questions
    if(isset($_POST['create_questions_btn'])){
        create_questions();
    }
    function create_questions(){
        global $conn, $errors;

        if(isset($_POST['create_questions_btn'])){

            $audit_id = $_POST['audit_id'];
            $question = $_POST['question'];

            if(empty($audit_id)){
                array_push($errors, "Audit type not selected");
            }
            if(empty($question)){
                array_push($errors, "Enter Question");
            }
            if(count($errors) == 0){
                
                $question_sql = "INSERT INTO questions(audit_id, questions) VALUES ('$audit_id', '$question')";

                $question_results = mysqli_query($conn, $question_sql);
                header('location: questions.php');
            }else{
                array_push($errors, "Question not inserted");
            }
        }
    }
    //fetch data - audit
    function get_designations(){
        global $conn, $get_designations_results;

        $get_designations = "SELECT * FROM designations";
        $get_designations_results = mysqli_query($conn, $get_designations);
            
    }
   
    //fetch data - users
    function get_users(){
        global $conn, $get_users_results;

        $get_users = "SELECT * FROM users";
        $get_users_results = mysqli_query($conn, $get_users);
            
    }
    function get_appointments(){
        global $conn, $get_appointments_results, $get_appointments;

        $get_appointments = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id 
        INNER JOIN branches ON branches.id=appointments.branches_id INNER JOIN employees ON employees.id=appointments.agent";
        $get_appointments_results = mysqli_query($conn, $get_appointments);
            
    }
    //pending appointments
    function get_pending_appointments(){
        global $conn, $get_pending_appointments_results;

        $get_pending_appointments = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id
        INNER JOIN employees ON employees.id=appointments.agent ORDER BY appointments.status='pending' DESC";
        $get_pending_appointments_results = mysqli_query($conn, $get_pending_appointments);
        
            
    }
    //fetch data - employees
    function get_employees(){
        global $conn, $get_employees_results;

        $get_employees = "SELECT * FROM employees";
        $get_employees_results = mysqli_query($conn, $get_employees);
            
    }
    
     // CRUD Read - read audit
    if(isset($_POST['audit_view_btn'])){
        audit_view();
    }
    function audit_view(){
        global $conn, $errors, $audit_view_results, $row1;

        if(isset($_GET['id'])){
            $id =$_GET['id'];

            $audit_view_sql = "SELECT * FROM audits WHERE id='?'";
            $audit_view_results = mysqli_query($conn, $audit_view_sql);
           
            // mysqli_free_result($audit_view_results);
        
        }
    }

    // DELETE
    if(isset($_POST['delete_role_btn'])){
        delete_role();
    }
    function delete_role(){
        global $conn, $errors;

        if(isset($_POST['delete_role_btn'])){

            $id = $_POST['id'];

                
                $delete_role_sql = "DELETE FROM designations WHERE id= '$id'";

                $delete_role_results = mysqli_query($conn, $delete_role_sql);
                header('location: index.php?page=users');
        }else{
                array_push($errors, 'Role not selected');
            }
    }
    // DELETE Service
    if(isset($_POST['delete_services_btn'])){
        delete_services();
    }
    function delete_services(){
        global $conn, $errors;

        if(isset($_POST['delete_services_btn'])){

            $id = $_POST['id'];

                
                $delete_services_sql = "DELETE FROM services WHERE id= '$id'";

                $delete_services_results = mysqli_query($conn, $delete_services_sql);
                header('location: index.php?page=services');
        }else{
                array_push($errors, 'Service not selected');
            }
    }
    
     // UPDATE
     if(isset($_POST['update_roles_btn'])){
        update_roles();
    }
    function update_roles(){
        global $conn, $errors;

        if(isset($_POST['update_roles_btn'])){

            $email_id = $_POST['email_id'];
            $designation = $_POST['designation'];

                
                $update_roles_sql = "UPDATE employees SET designation='$designation' WHERE id= '$email_id'";

                $update_roles_results = mysqli_query($conn, $update_roles_sql);
                // header('location: audits.php');
        }else{
                array_push($errors, 'Role not updated');
            }
    }

    //Designations
    if(isset($_POST['update_designations_btn'])){
        update_designations();
    }
    function update_designations(){
        global $conn, $errors;

        if(isset($_POST['update_designations_btn'])){

            $id = $_POST['id'];
            $designation = $_POST['designation'];

                
                $update_roles_sql = "UPDATE designations SET designation_name='$designation' WHERE id= '$id'";

                $update_roles_results = mysqli_query($conn, $update_roles_sql);
                // header('location: audits.php');
        }else{
                array_push($errors, 'Designation not updated');
            }
    }
    
    //New Branches
    if(isset($_POST['add_branches_btn'])){
        add_branches();
    }
    function add_branches(){
        global $conn, $errors;
        if (isset($_POST['add_branches_btn'])) {
        
            $branch =  ($_POST['branch']);
            $location =  ($_POST['location']);
            $manager =  ($_POST['manager']);
        }
        if(empty($branch)){
            array_push($errors, 'Branch is blank');
        }
        if(empty($location)){
            array_push($errors, 'Location is blank');
        }
        // check if passwords are similar
        if(empty($manager)){
            array_push($errors, 'Manager not inputed');
        }
        // Encrypt password if no error & register
        if(count($errors) == 0){
        
                $query = "INSERT INTO branches (bname, location, bmanager) VALUES('$branch', '$location', '$manager')";
                mysqli_query($conn, $query);
                
                //echo"<script>alert('Department Added Successfully!');</script>";
                echo("<script>window.location = 'index.php?page=dashboard;</script>");
            }
    }
    // Add designation
    //New Branches
    if(isset($_POST['add_designations_btn'])){
        add_designations();
    }
    function add_designations(){
        global $conn, $errors;
        if (isset($_POST['add_designations_btn'])) {
        
            $designation =  ($_POST['designation']);
        }
        if(empty($designation)){
            array_push($errors, 'Designation is blank');
        }
        // Encrypt password if no error & register
        if(count($errors) == 0){
        
                $query = "INSERT INTO designations (designation_name) VALUES('$designation')";
                mysqli_query($conn, $query);
                
                //echo"<script>alert('Department Added Successfully!');</script>";
                echo("<script>window.location = 'index.php?page=users;</script>");
            }
    }
     //fetch data - branch
     function get_branches(){
        global $conn, $get_branches_results;

        $get_branches = "SELECT * FROM branches";
        $get_branches_results = mysqli_query($conn, $get_branches);
            
    }
    function count_branch_managers(){
        global $conn;

        $count_branch_managers_sql = "SELECT 'bmanager' FROM branches";
        if ($count_branch_managers_results = mysqli_query($conn, $count_branch_managers_sql)){
            $rowCount = mysqli_num_rows($count_branch_managers_results);
            printf($rowCount);

            mysqli_free_result($count_branch_managers_results);
        }
    }
    
    //fetch data - services
    function get_services(){
        global $conn, $get_services_results;

        $get_services = "SELECT * FROM services";
        $get_services_results = mysqli_query($conn, $get_services);
            
    }
    //Update - services
    if(isset($_POST['update_services_btn'])){
        update_services();
    }
    function update_services(){
        global $conn, $update_services_results;

        $id = ($_POST['id']);
        $service = ($_POST['service']);

        if(isset($_POST['update_services_btn'])){
            $update_services = "UPDATE services SET serve_name='$service' WHERE id= '$id'";
            $update_services_results = mysqli_query($conn, $update_services);
        }
            
    }
    if(isset($_POST['update_appointment_btn'])){
        update_appointment();
    }
    function update_appointment(){
        global $conn, $errors;

        if(isset($_POST['update_appointment_btn'])){

            $app_id = $_POST['app_id'];
            $action = $_POST['action'];

                
                $update_appointment_sql = "UPDATE appointments SET status='$action' WHERE id= '$app_id'";

                $update_appointment_results = mysqli_query($conn, $update_appointment_sql);
                // header('location: audits.php');
                echo "successful";
        }else{
                array_push($errors, 'Appointment not updated');
            }
    }
    if(isset($_POST['update_bookings_btn'])){
        update_bookings();
    }
    function update_bookings(){
        global $conn, $errors;

        if(isset($_POST['update_bookings_btn'])){

            $app_id = $_POST['app_id'];
            $schedule = $_POST['scheduled']. ' '. $_POST['schedule_time'];
            $action = $_POST['action'];

                
                $update_bookings_sql = "UPDATE appointments SET status='$action' , appointment_date='$schedule' WHERE id= '$app_id'";

                $update_bookings_results = mysqli_query($conn, $update_bookings_sql);
                // header('location: portal.php');
                var_dump($update_bookings_sql);
                echo "successful";
        }else{
                array_push($errors, 'Appointment not updated');
            }
    }

    //Add - services
    if(isset($_POST['add_services_btn'])){
        add_services();
    }
    function add_services(){
        global $conn, $add_services_results;

        if(isset($_POST['add_services_btn'])){
            $service = ($_POST['service']);

            var_dump($_POST);
            $add_services_sql = "INSERT INTO services (serve_name) VALUES ('$service')";
            $add_services_results = mysqli_query($conn, $add_services_sql);
        }
            
    }
    function count_users(){
        global $conn;

        $count_users_sql = "SELECT * FROM users";
        if ($count_users_results = mysqli_query($conn, $count_users_sql)){
            $rowCount = mysqli_num_rows($count_users_results);
            printf($rowCount);

            mysqli_free_result($count_users_results);
        }
    }
    function count_designations(){
        global $conn, $count_designations_results;

        $count_designations_sql = "SELECT * FROM designations";
        if ($count_designations_results = mysqli_query($conn, $count_designations_sql)){
            $rowCount = mysqli_num_rows($count_designations_results);
            printf($rowCount);

            // mysqli_free_result($count_employees_results);
        }
    }
    function count_employ(){
        global $conn, $count_employees_results;

        $count_employees_sql = "SELECT * FROM employees";
        if ($count_employees_results = mysqli_query($conn, $count_employees_sql)){
            $rowCount = mysqli_num_rows($count_employees_results);
            printf($rowCount);

            // mysqli_free_result($count_employees_results);
        }
    }
    function employees(){
        global $conn, $employees_results;

        $employees_sql = "SELECT * FROM employees INNER JOIN designations ON designations.id=employees.designation";
        $employees_results = mysqli_query($conn, $employees_sql);
         
    }
    function count_branches(){
        global $conn;

        $count_branches_sql = "SELECT * FROM branches";
        if ($count_branches_results = mysqli_query($conn, $count_branches_sql)){
            $rowCount = mysqli_num_rows($count_branches_results);
            printf($rowCount);

            mysqli_free_result($count_branches_results);
        }
    }

    //New Branches
    if(isset($_POST['add_employees_btn'])){
        add_employees();
    }
    function add_employees(){
        global $conn, $errors;
        if (isset($_POST['add_employees_btn'])) {
            
                $fname      = ucfirst($_POST['fname']);
                $lname      = ucfirst($_POST['lname']);
                $email      = strtolower($_POST['email']);
                $uname      = substr($_POST['fname'], 0, 1). '.' .$_POST['lname'];
                $contact    = ($_POST['contact']);
                $password   = $_POST['password'];
                $password_1   = $_POST['password_1'];
                $designation    = ($_POST['designation']);
                $branch   = $_POST['branch'];
                $gender   = $_POST['gender'];
            }
            // check if fields have been inserted
            if(empty($fname)){
                array_push($errors, 'First Name cannot be blank!');
            }
            if(empty($lname)){
                array_push($errors, 'Last Name cannot be blank!');
            }
            if(empty($email)){
                array_push($errors, 'Email cannot be left blank');
            }
            if(empty($contact)){
                array_push($errors, 'Phone Number is blank');
            }
            if(empty($password)){
                array_push($errors, 'Password is blank');
            }
            if(empty($password_1)){
                array_push($errors, 'Confirm Password is blank');
            }
            // check if passwords are similar
            if(!$password == $password_1){
                array_push($errors, 'Password Mismatch!');
            }
            // Encrypt password if no error & register
            if(count($errors) == 0){
                $password = md5($password);
            
                $sql = "INSERT INTO employees (fname, lname, email, uname, designation, phone_no, password, branch, gender ) VALUES ('$fname', '$lname', '$email', '$uname', '$designation', '$contact', '$password','$branch', '$gender')";
                // var_dump($sql);
                $result = mysqli_query($conn, $sql);
                
                //echo"<script>alert('Department Added Successfully!');</script>";
                echo("<script>window.location = 'index.php?page=dashboard;</script>");
            }
    }

    if(isset($_POST['book_appointment_btn'])){
        book_appointment();
    }
    function book_appointment(){
        global $conn, $errors;

        if(isset($_POST['book_appointment_btn'])){

            $user_id = $_SESSION['user']['id'];  
            $service = $_POST['service'];
            $agent = $_POST['agent'];
            $fullname = $_POST['fullname'];
            $schedule = $_POST['scheduled'].' '.$_POST['schedule_time'];
            $speciality = $_POST['speciality'];
            $status = $_POST['status'];
            $branch = $_POST['branch'];
        }
        if(empty($service)){
            array_push($errors, "Select Service");
        }
        if(empty($schedule)){
            array_push($errors, "Select the date of appointment");
        }
        if(empty($branch)){
            array_push($errors, "Select Branch ");
        }
        if(empty($agent)){
            array_push($errors, "Select Staff ");
        }
        
            $sql_get = "SELECT * FROM appointments WHERE agent='$agent' AND appointment_date='$schedule' LIMIT 1";
            $sql_get_results = mysqli_query($conn, $sql_get);

            if(mysqli_num_rows($sql_get_results) ==1){
                $existing_appointmemt = mysqli_fetch_assoc($sql_get_results);
                array_push($errors, 'Staff is already booked for that slot! Kindly select another time. ');
            }
        if(count($errors)== 0){

            $book_appointment_sql = "INSERT INTO appointments (agent, fullname, user_id, service_id, branches_id, appointment_date, speciality, status) VALUES('$agent', '$fullname', '$user_id', '$service', '$branch', '$schedule', '$speciality', '$status')";
            $book_appointment_results = mysqli_query($conn, $book_appointment_sql);
            // var_dump($book_appointment_sql);
            // echo("<script>window.location = './user_portal/index.php?page=portal;</script>");
        }else{
            array_push($errors, " Error occured!");
        }
    }
    if(isset($_POST['edit_myusers_btn'])){
        edit_myusers();
    }
    function edit_myusers(){
        global $conn, $errors;

        if(isset($_POST['edit_myusers_btn'])){

            $id = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname      = substr($_POST['fname'], 0, 1). '.' .$_POST['lname'];
            $contact = $_POST['contact'];

            $edit_myuser_sql = "UPDATE users SET first_name='$fname', last_name= '$lname', uname='$uname', phone_no='$contact' WHERE id='$id'";
            $edit_myuser_results = mysqli_query($conn, $edit_myuser_sql);
            // var_dump($edit_myuser_sql);

        }else{
            array_push($errors, "Error occured!");
        }
    }

    // Password Reset
    if(isset($_POST['reset_user__password_btn'])){
        reset_user_password();
    }
    function reset_user_password(){
        global $conn, $errors;

        if(isset($_POST['reset_user__password_btn'])){

            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_1 = $_POST['password_1'];

            if(empty($email)){
                array_push($errors, 'Email is blank');
            }
            if(empty($password)){
                array_push($errors, 'Password is blank');
            }
            if(empty($password_1)){
                array_push($errors, 'Confirm Password is blank');
            }
            // check if passwords are similar
            if(!$password == $password_1){
                array_push($errors, 'Password Mismatch!');
            }


            // Encrypt password if no error & register
            if(count($errors) == 0){
                $password = md5($password);
            
                $sql = "UPDATE users SET password='$password' WHERE email='$email'";
                $result = mysqli_query($conn, $sql);
                // var_dump($sql);
                // header('location:index.php?page=login');
            }else{
                array_push($errors, 'Failed to Change Password!');
            }
        }
    }
?>