<?php
include '../conn.php';
session_start();


$customer = $_SESSION['customer'];
$cust = "select * from customer where customer_id = '$customer'";
$result = mysqli_query($connection, $cust);

while ($custrow = mysqli_fetch_assoc($result)) {
    $user = $custrow['username'];
}
$_SESSION['username'] = $user;

if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
    
} else {
    header("Location:../../../index.php");
}
$username = $_SESSION['username'];
$userid = $customer;
?>
<html>
    <head>
        <title>Manja Service Management</title>
        <!--Custom CSS-->
        <link rel="stylesheet" type="text/css" href="../css/global.css">
        <!--Bootstrap CSS-->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <!--Script-->
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- Navigation -->
        <nav style="background-color: #17A2B8; border-color:#17A2B8; " class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <a style="color: #fff;" class="navbar-brand" href="#">Manja Service Management</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a class="btn btn-sm"style="background: #2C3E50; margin-right: 4px; margin-bottom: 3px;margin-top: 3px;"href="#">Spares</a></li>
                        <li><a class="btn btn-sm"style="background: #2C3E50; margin-right: 4px; margin-bottom: 3px;margin-top: 3px;"href="#">Car Service</a></li>
                        <li><a class="btn btn-sm"style="background: #2C3E50; margin-right: 4px; margin-bottom: 3px;margin-top: 3px;" href="#">Forum</a></li>                 
                    </ul>
                </div>
            </div>
        </nav>

        <div class="col-sm-2">

            <ul class="nav nav-pills nav-stacked">
                <li style="background: #2C3E50;" class="nav-link btn btn-success"><a href="../../profile.php">Customer Account</a></li>

                <li><div class="dropdown">
                        <button style="width: 100%; background: #2C3E50;background-color: #2C3E50;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">spares Purchased
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li> <a class="dropdown-item" href="customers.php"><i class="fa fa-users"></i> Customers</a></li>
                            <li><a class="dropdown-item" href="employees.php"><i class="fa fa-users"></i> Employees</a> </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Request service
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../employee/calendar_of_events.php">Service Bookings</a></li>
                            <li><a class="dropdown-item" href="../employee/servicerequest.php">Vehicle service request</a></li>                     
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Spare management
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"href="spares.php">Spares</a></li>
                            <li><a class="dropdown-item" href="viewbuyspareparts.php">Spares Orders</a></li>                      
                        </ul>
                    </div>
                </li>

                <li><a style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="nav-link btn btn-success" href="logout.php">Logout</a></li>
            </ul> 

        </div>
        <div class="col-sm-10">
            <div class="container">
                <h4>Latest Discussion</h4>
                <hr>
                <?php              
                $sel = mysqli_query($connection, "SELECT * from category");
                while ($row = mysqli_fetch_assoc($sel)) {
                    extract($row);
                    echo '<div class="panel panel-success">
                    <div class="panel-heading">
                    <h3 class="panel-title">' . $category . '</h3>
                    </div> 
                    <div class="panel-body">
                    <table class="table table-stripped">
                    <tr>
                    <th>Topic title</th>
                    <th>Category</th>
                    <th>Action</th>
                    </tr>';
                    $sel1 = mysqli_query($connection, "SELECT * from tblpost");
                    while ($row1 = mysqli_fetch_assoc($sel1)) {
                        extract($row1);
                        echo '<tr>';
                        echo '<td>' . $title . '</td>';
                        echo '<td>' . $category . '</td>';
                        echo '<td><a href="content.php?post_id=' . $post_Id . '"><button class="btn btn-success">View</button></td>';
                        echo '</tr>';
                    }
                    echo '</table>
                    </div>
                </div>';
                }
                ?>
             
                   
            </div>
        </div>
    </div>


</body>
</html>