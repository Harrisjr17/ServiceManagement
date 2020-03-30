<?php
session_start();
include './includes/conn.php';

include './header.php';
include '../includes/mainmenu.php';
echo $mech = $_SESSION['mechanic'];
?>

<body
    <div class="col">
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
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ex</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
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
                                                                <h5 class="card-title">Special title treatment</h5>
                                                                <h5 class="card-title">Special title treatment</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-3">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Number of services Done
                                                            </div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">Special title treatment</h5>
                                                                <h5 class="card-title">Special title treatment</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-3">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Featured
                                                            </div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">Special title treatment</h5>
                                                                <h5 class="card-title">Special title treatment</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-3">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Featured
                                                            </div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">Special title treatment</h5>
                                                                <h5 class="card-title">Special title treatment</h5>
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
