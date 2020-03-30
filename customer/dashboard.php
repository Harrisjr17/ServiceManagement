<?php
session_start();
include './includes/conn.php';
include './includes/header.php';
include '../includes/mainmenu.php';
$customer = $_SESSION['customer'];
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
                                                                Spares by cutomer
                                                            </div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">Number of Spares</h5>
                                                                <h5 class="card-title">24</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-3">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Number of spare Orders
                                                            </div>
                                                            <div class="card-body">
                                                            <h5 class="card-title">Number of Spares</h5>
                                                                <?php
                                                                $sql98 = "SELECT * FROM orders where customer_id = '$customer'";
                                                                $result65 = mysqli_query($connection, $sql98);
                                                                if($result65){
                                                                    $requests = mysqli_num_rows($result65);
                                                                
                                                                    if($requests >= 0){
                                                                        ?>
                                                                        
                                                                    <h5 class="card-title"> <?php echo $requests; ?></h5>
                                                                    <?php

                                                                    }else{
                                                                        ?>
                                                                        <h5 class="card-title"> <?php echo "You have not made any orders"; ?></h5>
                                                                        <?php

                                                                    }
                                                                }else{
                                                                    echo "You have not made any orders";
                                                                }
                                                                
                                                                ?>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-3">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Number of service requests by you
                                                            </div>
                                                             <div class="card-body">
                                                                <?php
                                                                $sql = "SELECT * FROM service_request where vehicle_id = '3' and status ='approved'";
                                                                $result = mysqli_query($connection, $sql);
                                                                if($result){
                                                                    $requests = mysqli_num_rows($result);
                                                                    ?>
                                                                    <h5 class="card-title">Number of Spares</h5>
                                                                    <h5 class="card-title"> <?php echo $requests; ?></h5>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                 <h5 class="card-title">You Have not made any service requests</h5>
                                                                
                                                                <?php
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
