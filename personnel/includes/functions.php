<?php
    //start sessions
    session_start();
    error_reporting(0);

    // Connect to DB
    include('db_connector.php');

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

                $log_sql = "SELECT * FROM employees WHERE email='$email' AND password='$password' LIMIT 1";
                
                $log_results = mysqli_query($conn, $log_sql);

               if(mysqli_num_rows($log_results) == 1){
                 // check if user is found
                    $logged_in_user = mysqli_fetch_assoc($log_results);

                    // Check if manager or staff
                    if($logged_in_user['utype']== "manager"){
                        $_SESSION['user'] = $logged_in_user;
                        // login
                        header('location: ./manager/index.php?page=dashboard');

                    }
                    if($logged_in_user['utype']== "staff"){
                        $_SESSION['user']= $logged_in_user;
                        // login user
                        header('location: ./staff/index.php?page=portal');
                    }
                    if($logged_in_user['utype']== "bmanager"){
                        $_SESSION['user']= $logged_in_user;
                        // login user
                        header('location: ./bmanager/index.php?page=dashboard');
                    }
                        
                }else{
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
        global $conn, $get_appointments_results;

        $get_appointments = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id INNER JOIN
        employees ON employees.id=appointments.agent";
        $get_appointments_results = mysqli_query($conn, $get_appointments);
            
    }
    //pending appointments
    function get_pending_appointments(){
        global $conn, $get_pending_appointments_results;

        $get_pending_appointments = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id
        INNER JOIN users ON users.id=appointments.user_id
        INNER JOIN employees ON employees.id=appointments.agent ORDER BY appointments.status='pending' DESC";
        $get_pending_appointments_results = mysqli_query($conn, $get_pending_appointments);
        
            
    }
    //fetch data - employees
    function get_employees(){
        global $conn, $get_employees_results;

        $get_employees = "SELECT * FROM employees";
        $get_employees_results = mysqli_query($conn, $get_employees);
            
    }
    function branch_employees(){
        global $conn;
        $logged_in_branch = $_SESSION['user']['branch'];
        $branch_employees_sql = "SELECT * FROM employees where branch='".$logged_in_branch."'";
        if ($branch_employees_results = mysqli_query($conn, $branch_employees_sql)){
            $rowCount = mysqli_num_rows($branch_employees_results);
            printf($rowCount);

            mysqli_free_result($branch_employees_results);
        }
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
    // Delete Branches
    if(isset($_POST['delete_branch_btn'])){
        delete_branch();
    }
    function delete_branch(){
        global $conn, $errors;

        if(isset($_POST['delete_branch_btn'])){

            $id = $_POST['id'];

                
                $delete_branch_sql = "DELETE FROM branches WHERE id= '$id'";
                
                $delete_branch_results = mysqli_query($conn, $delete_branch_sql);
                header('location: index.php?page=dashboard');
        }else{
                array_push($errors, 'Branch not selected');
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
        $price = ($_POST['price']);

        if(isset($_POST['update_services_btn'])){
            $update_services = "UPDATE services SET serve_name='$service', price='$price' WHERE id= '$id'";
            var_dump($update_services);
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

    //Add - services
    if(isset($_POST['add_services_btn'])){
        add_services();
    }
    function add_services(){
        global $conn, $add_services_results;

        if(isset($_POST['add_services_btn'])){
            $service = ($_POST['service']);
            $price = ($_POST['price']);

            // var_dump($_POST);
            $add_services_sql = "INSERT INTO services (serve_name, price) VALUES ('$service','$price')";
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

        $logged_in_branch = $_SESSION['user']['branch'];
        $employees_sql = "SELECT * FROM employees INNER JOIN designations ON designations.id=employees.designation WHERE employees.branch='".$logged_in_branch."'";
        $employees_results = mysqli_query($conn, $employees_sql);
        //  var_dump($employees_sql);
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
                // $branch   = $_POST['branch'];
                $branch = $_SESSION['user']['branch'];
                $gender   = $_POST['gender'];
                $utype    = $_POST['utype'];
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
            if(empty($utype)){
                array_push($errors, 'User type is blank');
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
            
                $sql = "INSERT INTO employees (fname, lname, email, uname, designation, phone_no, password, branch, gender, utype) VALUES ('$fname', '$lname', '$email', '$uname', '$designation', '$contact', '$password','$branch', '$gender', '$utype')";
                var_dump($sql);
                $result = mysqli_query($conn, $sql);
                
                //echo"<script>alert('Department Added Successfully!');</script>";
                // echo("<script>window.location = 'index.php?page=dashboard;</script>");
            }
    }

    if(isset($_POST['book_appointment_btn'])){
        book_appointment();
    }
    function book_appointment(){
        global $conn, $errors;

        if(isset($_POST['book_appointment_btn'])){

            $service = $_POST['service'];
            $agent = $_POST['agent'];
            $fullname = $_POST['fullname'];
            $schedule = $_POST['schedule'];
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
        if(count($errors)== 0){
            $book_appointment_sql = "INSERT INTO appointments (agent, fullname, service_id, appointment_date, speciality, status) VALUES('$agent', '$fullname', '$service', '$schedule', '$speciality', '$status')";
            $book_appointment_results = mysqli_query($conn, $book_appointment_sql);
            
            // echo("<script>window.location = './user_portal/index.php?page=portal;</script>");
        }else{
            array_push($errors, "Error occured!");
        }
    }

    function branch_name(){
        global $conn, $errors, $sql_results, $branch_name_results;
        $logged_in_user_branch = $_SESSION['user']['id'];
        

        // $branch_name_sql = "SELECT * FROM branches INNER JOIN employees ON branches.bmanager=['user']['uname']";
        // $branch_name_results = mysqli_query($conn, $branch_name_sql);

        $sql = "SELECT bname FROM `employees`INNER JOIN branches ON branches.id=employees.branch WHERE employees.id='".$logged_in_user_branch."'";
        $sql_results = mysqli_query($conn, $sql);
        // var_dump($sql);
    }
    function filter_employ(){
        global $conn, $filter_employees_results;

        $logged_in_user_branch = $_SESSION['user']['branch'];
        $filter_employees_sql = "SELECT * FROM `employees`INNER JOIN branches ON branches.id=employees.branch WHERE employees.branch='".$logged_in_user_branch."'";
        // $filter_employees_sql = "SELECT * FROM employees WHERE branch = '".$logged_in_user_branch."'";
        if ($filter_employees_results = mysqli_query($conn, $filter_employees_sql)){
            $rowCount = mysqli_num_rows($filter_employees_results);
            // printf($rowCount);

            // mysqli_free_result($filter_employees_results);
        }
    }
    //download
    function download(){
        global $conn;

        require('fpdf184/fpdf.php');
        // require('./fpdf184/wordwrap.php');
        // Image($link='../images/logo.jfif');

        //Connect to database
        // include('cfg.php');
        //Create new pdf file
        $pdf = new FPDF();

        //Disable automatic page break
        $pdf->SetAutoPageBreak(false);

        //Add first page
        $pdf->AddPage('L');

        //Set pdf size
        $pdf->SetDisplayMode('default');
        // $pdf = new FPDF('P','mm','a3');
        //set initial y axis position per page
        $y_axis = 25;
        // $pdf->Image('../images/logo.jfif', 10,1,25,20);


        //print column titles
        //$pdf->SetFillColor(224,235,255);
        //$pdf->SetTextColor(0);
        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(.3);
        // $pdf->WordWrapper($text, 10);
        $pdf->SetFont('Times','',12);
        $pdf->SetY($y_axis);
        $pdf->SetX(25);
        $pdf->Cell(30,9,'First Name',1,0,'C',1);
        $pdf->Cell(30,9,'Last Name',1,0,'C',1);
        $pdf->Cell(40,9,'Agent Name',1,0,'C',1);
        $pdf->Cell(50,9,'Service',1,0,'C',1);
        $pdf->Cell(50,9,'Appointment Date',1,0,'C',1);
        $pdf->Cell(30,9,'Special Request',1,0,'C',1);
        $pdf->Cell(40,9,'Status',1,0,'C',1);

        //Select the products you want to show in your PDF file
        // include("fetchCandidates.php");

        $sql = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id 
        INNER JOIN users ON users.id=appointments.user_id 
        INNER JOIN employees ON employees.id=appointments.agent";
        $result = mysqli_query($conn, $sql);

        //initialize counter
        $i = 0;

        //Set maximum rows per page
        $max = 25;

        //Set Row Height
        $row_height = 6;

        $y_axis = $y_axis + $row_height;

        if (mysqli_num_rows($result) > 0){
            //outut data of each row
        }
        while($row = mysqli_fetch_assoc($result))
        {
            //If the current row is the last one, create new page & print column title
            if($i ==$max){
                $pdf->AddPage('L');

                //Set pdf size
                $pdf->SetDisplayMode('default');
                // $pdf = new FPDF('P','mm','a3');
                //set initial y axis position per page
                $y_axis = 25;
                // $pdf->Image('../images/logo.jfif', 10,1,25,20);
                // $header = ('11 Degrees Booking List');
                // $pdf-> "11 Degrees Booking List";
                //print column titles
                //$pdf->SetFillColor(224,235,255);
                //$pdf->SetTextColor(0);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetDrawColor(0,0,0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Times','',12);
                //print column titles for the current page
                $pdf->SetY($y_axis);
                $pdf->SetX(25);
                $pdf->Cell(30,9,'First Name',1,0,'C',1);
                $pdf->Cell(30,9,'Last Name',1,0,'C',1);
                $pdf->Cell(40,9,'Agent Name',1,0,'C',1);
                $pdf->Cell(50,9,'Service',1,0,'C',1);
                $pdf->Cell(50,9,'Appointment Date',1,0,'C',1);
                $pdf->Cell(30,9,'Special Request',1,0,'C',1);
                $pdf->Cell(40,9,'Status',1,0,'C',1);

                //Go to next row
                $y_axis = $y_axis + $row_height;

                //Set $i variable to 0 (first row)
                $i=0;
            }
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $agent_name = $row['fname']. ' '.$row['lname'];
            $serve_name = $row['serve_name'];
            $appointment_date = $row['appointment_date'];
            $speciality = $row['speciality'];
            $status = $row['status'];

            $pdf->SetY($y_axis);
            $pdf->SetX(25);
            $pdf->Cell(30,9,$first_name,1,0,'C',1);
            $pdf->Cell(30,9,$last_name,1,0,'C',1);
            $pdf->Cell(40,9,$agent_name,1,0,'C',1);
            $pdf->Cell(50,9,$serve_name,1,0,'C',1);
            $pdf->Cell(50,9,$appointment_date,1,0,'C',1);
            $pdf->Cell(30,9,$speciality,1,0,'C',1);
            $pdf->Cell(40,9,$status,1,0,'C',1);

            //Go to next row
            $y_axis = $y_axis + $row_height;
            $i =$i + 1;
        }
        mysqli_close($conn);


        //Send file
        $pdf->Output();
    }
    if(isset($_GET['download_btn'])){
        download();
    }

    // Data export

    if(isset($_POST['data_export_btn'])){
        data_export();
    }
    function data_export(){
        global $conn, $errors, $data_export_results;

        if(isset($_POST['data_export_btn'])){
            
            // $start_date = $_POST['start_date'];
            // $end_date = $_POST['end_date'];
            $logged_in_branch = $_SESSION['user']['branch'];

            
            $data_export_sql = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id 
            INNER JOIN users ON users.id=appointments.user_id INNER JOIN employees ON employees.id=appointments.agent
            WHERE appointments.branches_id='".$logged_in_branch."'";
            $data_export_results = mysqli_query($conn, $data_export_sql);

            $export = array();
            while($exp = mysqli_fetch_assoc($data_export_results)){
                $export[] = $exp;
            }
            $fileName = "Appointment_export_".date('Ymd') . ".xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            $showColumn = false;

            if(!empty($export)){
                foreach($export as $exportInfo) {
                    if(!$showColumn) {
                        echo implode("\t", array_keys($exportInfo)) . "\n";
                        $showColumn = true;
                    }
                    echo implode("\t", array_values($exportInfo)) . "\n";
                }
            }
            exit;
        }
    }
    
    if(isset($_POST['edit_user_btn'])){
        edit_user();
    }
    function edit_user(){
        global $conn, $errors;

        if(isset($_POST['edit_user_btn'])){

            $id = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname      = substr($_POST['fname'], 0, 1). '.' .$_POST['lname'];
            $contact = $_POST['contact'];

            $edit_user_sql = "UPDATE employees SET fname='$fname', lname= '$lname', uname='$uname', phone_no='$contact' WHERE id='$id'";
            $edit_user_results = mysqli_query($conn, $edit_user_sql);
            // var_dump($edit_user_sql);

        }else{
            array_push($errors, "Error occured!");
        }
    }

    // Password Reset
    if(isset($_POST['reset_password_btn'])){
        reset_password();
    }
    function reset_password(){
        global $conn, $errors;

        if(isset($_POST['reset_password_btn'])){

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
            
                $sql = "UPDATE employees SET password='$password' WHERE email='$email'";
                $result = mysqli_query($conn, $sql);
                // var_dump($sql);
                // header('location:index.php?page=login');
            }else{
                array_push($errors, 'Failed to Change Password!');
            }
        }
    }

        // Data export

        if(isset($_POST['manager_data_export_btn'])){
            manager_data_export();
        }
        function manager_data_export(){
            global $conn, $errors, $data_export_results1;
    
            if(isset($_POST['manager_data_export_btn'])){
                
                // $start_date = $_POST['start_date'];
                // $end_date = $_POST['end_date'];
                // $logged_in_branch = $_SESSION['user']['branch'];
                $y=1;
                
                $data_export_sql1 = "SELECT * FROM appointments INNER JOIN services ON services.id=appointments.service_id 
                INNER JOIN users ON users.id=appointments.user_id INNER JOIN employees ON employees.id=appointments.agent";
                $data_export_results1 = mysqli_query($conn, $data_export_sql1);
                
    
                $export1 = array();
                while($exp1 = mysqli_fetch_assoc($data_export_results1)){
                    $export1[] = $exp1;
                }
                $fileName1 = "Comprehensive_export_".date('Ymd') .  ".xls";
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"$fileName1\"");
                $showColumn = false;
    
                if(!empty($export1)){
                    foreach($export1 as $exportInfo) {
                        if(!$showColumn) {
                            echo implode("\t", array_keys($exportInfo)) . "\n";
                            $showColumn = true;
                        }
                        echo implode("\t", array_values($exportInfo)) . "\n";
                    }
                }
                exit;
            }
        }
?>