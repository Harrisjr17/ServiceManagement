<?php
session_start();
include './includes/conn.php';

include './header.php';
include '../includes/mainmenu.php';
?>

<body <div class="col">
    <div class="row">
        <?php
        include '../includes/menubar.php';
        ?>
        <div class="col-sm-9 my-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Employee</li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col my-1">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Statistical-tab" data-toggle="tab" href="#Statistics" role="tab" aria-controls="Statistics" aria-selected="true">Statistical Reports</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="Statistics" role="tabpanel" aria-labelledby="Statistical-tab">
                                <div class="row">
                                    <div class="card my-2">
                                        <div class="card-header">
                                            your Service stats
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Service requests
                                                        </div>
                                                        <div class="card-body">
                                                            <?php
                                                            $sql = "SELECT * FROM service_request";
                                                            $result = mysqli_query($connection, $sql);
                                                            if ($result) {
                                                                $requests = mysqli_num_rows($result);
                                                            ?>
                                                                <h5 class="card-title">All service Requests</h5>
                                                                <h5 class="card-title"> <?php echo $requests; ?></h5>
                                                            <?php
                                                            } else {
                                                                echo '<h5 class="card-title">No service requests</h5>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            services Done
                                                        </div>
                                                        <div class="card-body">
                                                            <?php
                                                            $sql = "SELECT * FROM service_request where status = 'finished'";
                                                            $result = mysqli_query($connection, $sql);
                                                            if($result){
                                                                $requests = mysqli_num_rows($result);
                                                            ?>
                                                            <h5 class="card-title">services done</h5>
                                                            <h5 class="card-title"> <?php echo $requests; ?></h5>
                                                            <?php
                                                            }else{
                                                               echo ' <h5 class="card-title">No service Done</h5>';
                                                            }
                                                            ?>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Featured
                                                        </div>
                                                        <div class="card-body">
                                                            <?php
                                                            $sql = "SELECT * FROM service_track where status = 'pending'";
                                                            $result = mysqli_query($connection, $sql);
                                                            $requests = mysqli_num_rows($result);
                                                            ?>
                                                            <h5 class="card-title">Number of services inprogress</h5>
                                                            <h5 class="card-title"> <?php echo $requests; ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Featured
                                                        </div>
                                                        <div class="card-body">
                                                            <?php
                                                            $sql = "SELECT * FROM service_track where status = 'in process'";
                                                            $result = mysqli_query($connection, $sql);
                                                            $requests = mysqli_num_rows($result);
                                                            ?>
                                                            <h5 class="card-title">Number of services inprogress</h5>
                                                            <h5 class="card-title"> <?php echo $requests; ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card my-2">
                                        <div class="card-header">
                                            Inventory information
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Featured
                                                        </div>
                                                        <div class="card-body">
                                                            <?php
                                                            $sql = "SELECT * FROM spare ";
                                                            $result = mysqli_query($connection, $sql);
                                                            $requests = mysqli_num_rows($result);
                                                            ?>
                                                            <h5 class="card-title">Number of Spares</h5>
                                                            <h5 class="card-title"> <?php echo $requests; ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Featured
                                                        </div>
                                                        <div class="card-body">
                                                            <?php
                                                            $sql = "SELECT * FROM spare where availability = 'available' ";
                                                            $result = mysqli_query($connection, $sql);
                                                            $requests = mysqli_num_rows($result);
                                                            ?>
                                                            <h5 class="card-title">Number of Spares Available</h5>
                                                            <h5 class="card-title"> <?php echo $requests; ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Services available
                                                        </div>
                                                        <div class="card-body">
                                                            <?php
                                                            $sql = "SELECT * FROM service";
                                                            $result = mysqli_query($connection, $sql);
                                                            $requests = mysqli_num_rows($result);
                                                            ?>
                                                            <h5 class="card-title">Number of Spares Available</h5>
                                                            <h5 class="card-title"> <?php echo $requests; ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...2</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...3</div>
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