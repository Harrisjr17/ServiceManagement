<?php
include('cheader.php');
session_start();
include './includes/conn.php';

?>
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
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php
if (isset($_POST['assign'])) {
    $m = $_POST['mech'];
    $v = $_POST['vehicle'];
    $s = $_POST['service'];
    $r = $_POST['request_id'];
    
    $sql = "INSERT INTO mechanicallocation (vehicle_id, mechanic_id) VALUES ('$v', '$m') ";
    $result = mysqli_query($connection, $sql);
    if($result){
       
         $assign = "UPDATE employee SET assigned = '1' WHERE employee_id = '$m'";
         $execute = mysqli_query($connection, $assign);
         if($execute){

             $track = "INSERT INTO service_track (status, comments,mechanic_id,vehicle_id, service_id) VALUES ('pending','Null',$m,'$v', '$s')";
             $tr1 = mysqli_query($connection, $track);
             if($tr1){
                 $delete = "UPDATE service_request SET assigned = '1' WHERE request_id = '$r'";
                 $resultd = mysqli_query($connection, $delete);
             }
               echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.success("mechanic has been Assigned successfully");               
        </script>';
         }
    }
    
}
?>
<div class="col-sm-12">
    <div class="col-sm-2">
        <ul class="nav nav-pills nav-stacked">
            <li style="background: #2C3E50;" class="nav-link btn btn-success" href="empaccount.php">Employee Account</a></li>
            <li><div class="dropdown">
                    <button style="width: 100%; background: #2C3E50;background-color: #2C3E50;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">User management
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item" href="customers.php"><i class="fa fa-users"></i> Customers</a></li>
                        <li><a class="dropdown-item" href="employees.php"><i class="fa fa-users"></i> Employees</a> </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <button style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Service Management
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

            <li><a style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="nav-link btn btn-success" href="manufacturer.php"><i class="fa fa-user"></i> Manufacturers</a></li>
            <li><a style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="nav-link btn btn-success " href="services.php">Services </a></li>
            <li><a style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="nav-link btn btn-success" href="logout.php">Logout</a></li>
        </ul> 
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h3>Service Schedule</h3></div>
            <div class="panel-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <?php include('add_class_event.php'); ?>
    </div>
</div>

<?php include('scripts.php'); ?>
<?php include('admin_calendar_script.php'); ?>
</body>

</html>