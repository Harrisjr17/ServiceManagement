<?php
session_start();
include './includes/conn.php';
include 'header.php';
include '../includes/mainmenu.php';

if(isset($_GET['appr'])){
   echo $_GET['id'];
}

?>

<body
    <div class="col">
        <div class="row">
            <?php
            include '../includes/menubar.php';
            ?>
            <div class="col-sm-10 my-2">                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Employee</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Mechanic allocation</li>
                    </ol>
                </nav>
                <div class="container">
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
<script src="../scripts/datatables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="fa fa-arrow-circle-left mr-1"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="fa fa-arrow-circle-right"></i>');

    });
</script>
<script src="alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
