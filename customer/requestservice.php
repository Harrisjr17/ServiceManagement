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
    $vehicle_id;

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
            <div class="col-sm-9 my-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Customer</li>
                        <li class="breadcrumb-item active" aria-current="page">Request for a Service</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header">
                                    Vehicle Details
                                </div>
                                <div class="card-body">
                                    <form action="requestservice.php" method="post">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">vehicle Licence Plate</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="request_date" class="form-control" disabled="" value="<?php echo $plate; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Service Needed</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="service_id">
                                                    <?php
                                                    if (mysqli_num_rows($result) > 0) {
                                                        // output data of each row
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $name = $row['service_name'];
                                                            $id = $row['service_id'];
                                                    ?>
                                                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Service Request date</label>
                                            <div class="col-sm-8">
                                                <input type="date" name="request_date" class="form-control" id="inputEmail3" placeholder="Date">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Time</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="time" class="form-control" id="inputEmail3" placeholder="time">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Comment</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="comments" rows="5" id="comment"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4 col-form-label"></div>
                                            <div class="col-sm-8">
                                                <button type="submit" name="request" class="btn btn-secondary">Submit Request</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
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