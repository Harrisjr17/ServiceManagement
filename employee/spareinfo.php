<?php
session_start();
include './includes/conn.php';
include 'header.php';
include '../includes/mainmenu.php';

if (isset($_GET['del'])) {
    mysqli_query($connection, "delete from spare where spare_id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.error("Spare Has deleted Successfully");               
        </script>';
}

$spare_id = $_GET['id'];
$query = mysqli_query($connection, "select * from spare where spare_id ='$spare_id'");
while ($row = mysqli_fetch_array($query)) {
    ?>									
    <?php $type = $row['spare_type']; ?>
    <?php $name = $row['spare_name']; ?>
    <?php $description = $row['spare_description']; ?>  
    <?php $image = $row['image']; ?>  
    <?php $price = $row['price']; ?>
    <?php $stock = $row['stockin']; ?>  


    <?php
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
                        <li class="breadcrumb-item">Employee</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Spare Details</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <div class="card">
                                <img style="width: 200px; height: 200px;" class="card-img-top" src="<?php echo $image; ?>">
                                <div class="card-body">
                                    <h5 class="card-title">Spare name :<?php echo $name; ?></h5>
                                    <p class="card-text">Spare Type : <?php echo $type; ?></p>
                                    <p class="card-text">Spare description : <?php echo $description; ?></p>
                                    <p class="card-text">Price : <?php echo $price; ?></p>
                                    <a href="spares.php" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

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
<script src="../alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
