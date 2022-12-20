<input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
        <!-- visibility: visible; margin-left: -10px; -->
            <h2><span  style="visibility: visible; font-size:28px;">Ora</span><span>Manager's Portal</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="index.php?page=dashboard" class="<?php echo $_GET['page'] ==  'dashboard' ? 'active': ''; ?>"><span class="la la-igloo"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="index.php?page=users" class="<?php echo $_GET['page'] == 'users' ? 'active': ''; ?>"><span class="las la-users"></span>
                    <span>Employees & Reports</span></a>
                </li>
                <li>
                    <a href="index.php?page=services" class="<?php echo $_GET['page'] == 'services' ? 'active': ''; ?>"><span class="lab la-servicestack"></span>
                    <span>Services</span></a>
                </li>
                <!--<li>
                    <a href="index.php?page=questions" class="<?php echo $_GET['page'] == 'questions' ? 'active': ''; ?>"><span class="las la-question-circle"></span>
                    <span>Questions</span></a>
                </li>
                <li>
                    <a href="index.php?page=users" class="<?php echo $_GET['page'] == 'users' ? 'active': ''; ?>"><span class="las la-users"></span>
                    <span>Users</span></a>
                </li> -->
                <li>
                    <a href="../logout.php" class="logout"><span class="las la-sign-out-alt"></span>
                    <span>logout</span></a>
                </li>
            </ul>
        </div>
    </div>