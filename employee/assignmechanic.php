<?php
include './includes/conn.php';
session_start();
if (isset($_GET['id'])) {
    $request_id = $_GET['id'];
}
include 'header.php';
include '../includes/mainmenu.php';
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
                        <li class="breadcrumb-item">Employee</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Mechanic Assigment</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <?php
                            $sql3 = "select * from service_request where request_id = '$request_id'";
                            $result4 = mysqli_query($connection, $sql3);
                            while ($row = mysqli_fetch_assoc($result4)) {
                                $veh = $row['vehicle_id'];
                                $ser = $row['service_id'];
                                $comments = $row['comments'];
                                $sql4 = "select * from vehicle where vehicle_id = '$veh'";
                                $result = mysqli_query($connection, $sql4);
                                while ($row1 = mysqli_fetch_assoc($result)) {

                                    $plate = $row1['licence_plate'];
                                    $model = $row1['model'];
                                }
                                $sql = "select * from service where service_id = '$ser'";
                                $result2 = mysqli_query($connection, $sql);
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    $name = $row2['service_name'];
                                    $speciaty = $row2['speciaty'];
                                }
                            }
                            ?>
                            <div class="card">
                                <div class="card-body">
                                    <form action="calendar_of_events.php" method="post">
                                        <h5<?php echo $plate; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Vehicle Model :<?php echo $model; ?></h6>
                                        <p class="card-text">Service Requered :<?php echo $name; ?>.</p>
                                        <p class="card-text">Problem Description :<?php echo $comments; ?>.</p>
                                        Select Mechanic :<select name="mech" class="form-control form-control-sm">
                                            <?php
                                            $sql3 = "select * from employee where expertize ='$speciaty'";
                                            $result3 = mysqli_query($connection, $sql3);
                                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                                $mech_id = $row3['employee_id'];
                                                $fname = $row3['firstname'];
                                                $lname = $row3['lastname'];
                                                ?> 
                                                <option value="<?php echo $mech_id; ?>"><?php
                                                    echo $fname;
                                                    echo $lname;
                                                    ?></option>
                                                <input type="hidden" name="vehicle" value="<?php echo $veh; ?>">
                                                <input type="hidden" name="service" value="<?php echo $ser; ?>">
                                                <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">
                                                <?php
                                            }
                                            ?>
                                        </select><br>
                                        <div class="form-group">
                                            <button type="submit" name="assign" class="btn btn-success">Assign</button> 
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>

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
