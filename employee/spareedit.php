<?php
session_start();
include './includes/conn.php';
include 'header.php';
include '../includes/mainmenu.php';

$_SESSION['spare'] = $_GET['id'];
$spar = $_SESSION['spare'];

if (isset($_POST["submit"])) {
    $spar = $_POST['service'];
    $spare_name = $_POST['spare_name'];
    $spare_description = $_POST['spare_description'];
    $spare_type = $_POST['spare_type'];
    $price = $_POST['price']; 
    $availability = $_POST['availability'];   
    $sql = "UPDATE spare SET spare_name ='$spare_name',spare_description = '$spare_description', "
            . "spare_type ='$spare_type',price ='$price',availability = '$availability'"
            . "WHERE spare_id = '$spar'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.success("Spare Has been Updated Successfully");               
        </script>';
    } else {
        echo mysqli_errno($connection);
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
                        <li class="breadcrumb-item">Employee</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Manage Spares</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <?php
                            $sql1 = "select * from spare where spare_id = '$spar'";
                            $result1 = mysqli_query($connection, $sql1);
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $sname = $row1['spare_name'];
                                $sdescription = $row1['spare_description'];
                                $stype = $row1['spare_type'];
                                $pr = $row1['price'];
                                $st = $row1['stockin'];
                                $availability = $row1['availability'];
                                ?>
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Spare</h5>                                                                                 
                                        </div>
                                        <div class="modal-body">                                       
                                            <form action="spareedit.php" method="post" enctype="multipart/form-data">
                                                <div class="form-group input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">spare type</span>
                                                    </div>
                                                    <input type="text" name="spare_type" class="form-control" id="spare_type" value="<?php echo $stype; ?>">
                                                   <input type="hidden" name="service" value="<?php echo $spar; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">spare Name</span>
                                                    </div>
                                                    <input type="text" name="spare_name" class="form-control" id="spare_name"  value="<?php echo $sname; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Availability</span>
                                                    </div>
                                                    <input type="text" name="availability" class="form-control" id="spare_name"  value="<?php echo $availability; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Description</span>
                                                    </div>
                                                    <textarea name="spare_description" required="" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $sdescription; ?></textarea>                                             
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Price</span>
                                                    </div>
                                                    <input type="text" name="price" class="form-control" id="price"  value="<?php echo $pr; ?>">
                                                </div>
                                                                                                                         
                                                <div class="form-group input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Manufacturer</span>
                                                    </div>
                                                    <select class="form-control" name="manufacture_id" id="exampleFormControlSelect1">
                                                        <?php
                                                        $manufacturer = "select * from manufacturer where type = 'spares'";
                                                        $manures = mysqli_query($connection, $manufacturer);
                                                        while ($row = mysqli_fetch_assoc($manures)) {
                                                            $manu_id = $row['manufacturer_id'];
                                                            $manu_name = $row['manufacturer_name'];
                                                            ?>
                                                            <option value="<?php echo $manu_id; ?>"><?php echo $manu_name; ?></option>
                                                            <?php
                                                        }
                                                        ?>                                                                                                  
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="submit" class="btn btn-primary">Update Spare</button>
                                                </div>
                                            </form>                                    
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
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
