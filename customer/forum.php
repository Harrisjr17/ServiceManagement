<?php
session_start();
include './includes/conn.php';
include './includes/header.php';
require_once '../classes/post.php';
$customer = $_SESSION['customer'];

include '../includes/mainmenu.php';
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
                        <li class="breadcrumb-item">Customer</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Forum</li>
                    </ol>
                </nav>
                <div class="container">

                    <?php
                    if (!empty($firstname)) {
                        echo $_SESSION['msg'];
                    }
                    ?>
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Forum</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    hold conversations and share their ideas and insights to help understand your vehicle more.
                                </h6>
                                <p class="card-text">.</p>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
