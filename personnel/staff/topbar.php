<!-- Header -->

<header>
        <h2>
            <label for="nav-toggle">
                <span class="las la-bars"></span>
            </label>
            Dashboard
        </h2>

        <div class="search-wrapper">
            <span class="las la-search"></span>
            <input type="search" placeholder="Search here...">
        </div>
        <div class="user-wrapper">
            <img src="../../images/user.png" width="40px" height="40px" alt="User Profile">
            <div>
            <a href="#user_profile?id=<?php echo $_SESSION['user']['id']; ?>" onclick="document.getElementById('user_profile<?php echo $_SESSION['user']['id']; ?>').style.display='block'">
                <!-- <h4>John Doe</h4> -->
                <h4><?php echo $_SESSION['user']['uname']; ?></h4>
            </a>
            <?php include('../modal.php'); ?>    
                <small><?php echo "".date("d/m/Y") ."<br>" ?></small>
            </div>
        </div>
    </header>
<!-- /header -->