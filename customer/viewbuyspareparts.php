<?php
session_start();
include './includes/conn.php';
include './includes/header.php';
include '../includes/mainmenu.php';

$customer = $_SESSION['customer'];

$sql = "SELECT * FROM service";
$result = mysqli_query($connection, $sql);

$sql1 = "SELECT * FROM vehicle where customer_id = '$customer'";
$result1 = mysqli_query($connection, $sql1);
if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result1)) {
        $vehicle_id = $row['vehicle_id'];
        $plate = $row['licence_plate'];
    }
} else {
    echo "0 results";
}

if (isset($_POST['request'])) {
    $service_id = $_POST['service_id'];
    $request_date = $_POST['request_date'];
    $time = $_POST['time'];
    $comments = $_POST['comments'];

    $sql = "INSERT INTO service_request (vehicle_id, service_id, service_date,time,comments)
    VALUES ('$vehicle_id', '$service_id','$request_date','$time','$comments')";

    if (mysqli_query($connection, $sql)) {
        echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.success("Service Request has been sent");               
        </script>';
    }
}
?>
<body>
    <div class="col">
        <div class="row">
            <?php
            include '../includes/menubar.php';
            ?>
            <div class="col-sm-10 my-2">                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Customer</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Spares Purchased</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="card">
                                    <div class="card-header">
                                        Spares Not Paid
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $sql = "SELECT * FROM orders where customer_id='$customer' and status ='not paid'";
                                        $result = mysqli_query($connection, $sql);
                                        if($result){
                                            $requests = mysqli_num_rows($result);
                                            ?>
                                                <h5 class="card-title">All spares not paid <span class="badge badge-warning"><?php echo $requests; ?></span></h5>

                                                <div class="table-responsive">
                                                    <table class="datatable-1 table table-bordered table-striped table-hover table-dark">
                                                        <thead>
                                                            <tr>   
                                                                <th>order No</th>
                                                                <th>spare Name</th>
                                                                <th>quantity </th>
                                                                <th>orderdate</th>
                                                                <th>Total</th>  
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $query = "select * from orders where customer_id='$customer' and status ='not paid'";
                                                            $result12 = mysqli_query($connection, $query);
                                                            while ($role = mysqli_fetch_assoc($result12)) {
                                                                $part = $role['spare_id'];
                                                                $ps = "select * from spare where spare_id ='$part'";
                                                                $pr = mysqli_query($connection, $ps);
                                                                while ($ro = mysqli_fetch_assoc($pr)) {
                                                                    $par = $ro['spare_name'];
                                                                    $price = $ro['price'];
                                                                    $orderid = $role['order_id'];
                                                                    $quantity = $role['quantity'];
                                                                    $orderdate = $role['orderdate'];
                                                                    $total = $role['total'];
                                                                    ?>									
                                                                    <tr>                                      
                                                                        <td><?php echo $orderid; ?></td>
                                                                        <td><?php echo $par; ?></td>
                                                                        <td><?php echo $price; ?></td>  
                                                                        <td><?php echo $quantity; ?></td>
                                                                        <td><?php echo $orderdate; ?></td>
                                                                        <td><?php echo $total; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                        <?php
                                        }else{
                                           echo " YOU DONT HAVE SPARES THAT ARE NOT PAID FOR";
                                        }
                                       
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="card my-2 ml-2">
                                    <div class="card-header">
                                        Spares Paid
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $sql = "SELECT * FROM orders where customer_id='$customer' and status ='paid'";
                                        $result = mysqli_query($connection, $sql);

                                        if($result){
                                            $requests = mysqli_num_rows($result);
                                            ?>
                                            <h5 class="card-title">All spares paid <span class="badge badge-warning"><?php echo $requests; ?></span></h5>
                                        <div class="table-responsive">
                                            <table class="datatable-1 table table-bordered table-striped table-hover table-dark ">
                                                <thead>
                                                    <tr> 
                                                        <th>order No</th>
                                                        <th>Spare Name</th>
                                                        <th>price</th>
                                                        <th>quantity </th>
                                                        <th>orderdate</th>
                                                        <th>Total</th>  
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "select * from orders where customer_id='$customer' and status ='not paid'";
                                                    $result12 = mysqli_query($connection, $query);
                                                    while ($role = mysqli_fetch_assoc($result12)) {
                                                        $part = $role['spare_id'];
                                                        $ps = "select * from spare where spare_id ='$part'";
                                                        $pr = mysqli_query($connection, $ps);
                                                        while ($ro = mysqli_fetch_assoc($pr)) {
                                                            $par = $ro['spare_name'];
                                                            $price = $ro['price'];
                                                            $orderid = $role['order_id'];
                                                            $quantity = $role['quantity'];
                                                            $orderdate = $role['orderdate'];
                                                            $total = $role['total'];
                                                            ?>									
                                                            <tr>                                      
                                                                <td><?php echo $orderid; ?></td>
                                                                <td><?php echo $par; ?></td>
                                                                <td><?php echo $price; ?></td>  
                                                                <td><?php echo $quantity; ?></td>
                                                                <td><?php echo $orderdate; ?></td>
                                                                <td><?php echo $total; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                            <?php
                                        }else{
                                            echo "You have not Made any Purchase";
                                        }
                                     
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (!empty($email) && !empty($pass)) {
            echo $_SESSION['msg'];
        }
        ?>
</body>
<script src="alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
