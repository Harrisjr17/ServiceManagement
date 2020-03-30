<div class="col-sm-2">
    <ul class="nav flex-column my-2">
        <?php
        if (isset($_SESSION['customer'])) {
            ?>
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="dashboard.php"><i class="fa fa-user"></i> Dashboard</a>
            </li>
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="profile.php"><i class="fa fa-user"></i> Profile</a>
            </li>
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="viewbuyspareparts.php"><i class="fa fa-car"></i> Spares Purchased</a>
            </li>
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="requestservice.php"><i class="fa fa-car"></i> Request Service</a>
            </li>
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="logout.php"><i class="fa fa-sign-out"></i> Sign Out</a>
            </li>
            <?php
        } else if (isset($_SESSION['employee'])) {
            $sql = "SELECT * FROM service_request where status = 'Null'";
            $result = mysqli_query($connection, $sql);
            $requests = mysqli_num_rows($result);
            ?>
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="empaccount.php">Employee Account</a>
            </li>
            <li class="nav-item my-1">
                <div class="dropdown">
                    <button style="width: 100%;" class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User management
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="customers.php"><i class="fa fa-users"></i> Customers</a>
                        <a class="dropdown-item" href="employees.php"><i class="fa fa-users"></i> Employees</a>                      
                    </div>
                </div>
            </li>
            <li class="nav-item my-1">
                <div class="dropdown">
                    <button style="width: 100%;" class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Service management
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="../employee/calendar_of_events.php">
                            Service requests  <?php
                            if ($requests == 0) {
                                
                            } else {
                                ?>
                                <span class="badge badge-warning">
                                    <?php
                                    echo $requests;
                                }
                                ?>
                            </span>
                        </a>
                        <a class="dropdown-item" href="../employee/servicerequest.php">Service list</a>                    
                    </div>
                </div>
            </li>
            <li class="nav-item my-1">
                <div class="dropdown">
                    <button style="width: 100%;" class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Spare Management
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"href="spares.php">Spares</a>
                        <a class="dropdown-item" href="viewbuyspareparts.php">Spares Orders</a>                 
                    </div>
                </div>
            </li>
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="manufacturer.php"><i class="fa fa-user"></i> Manufacturers</a>
            </li>                   
          
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="services.php">Services </a>
            </li>
           
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="logout.php">Logout</a>
            </li>
            <?php
        } else {
            ?>  
            <li class="nav-item">
                <a class="nav-link btn btn-success btn-sm" href="register.php"><i class="fa fa-sign-in"></i>  Register</a>
            </li>
            <li class="nav-item my-1">
                <a class="nav-link btn btn-success btn-sm" href="login.php"><i class="fa fa-user"></i>  Login</a>
            </li>

            <?php
        }
        ?>
    </ul>
</div>	



