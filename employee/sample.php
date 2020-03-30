<?php
session_start();
include './includes/conn.php';

include '../includes/header.php';
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
                        <li class="breadcrumb-item active" aria-current="page">Schedules</li>
                    </ol>
                </nav>               
                <div class="col-sm-12">
                    <div class="row">
                       
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
</html>

