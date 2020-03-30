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

if (isset($_POST["submit"])) {

    $spare_name = $_POST['spare_name'];
    $spare_description = $_POST['spare_description'];
    $spare_type = $_POST['spare_type'];
    //$availability = $_POST['availability'];
    $price = $_POST['price'];
    $stockin = $_POST['stockin'];
    $manufacturer_id = $_POST['manufacture_id'];
    $target_dir = "upload/";
    $imagefile = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($imagefile, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($imagefile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $imagefile)) {
            $sql = "insert into spare(spare_type,spare_name,spare_description,image,price,stockin,remaining,manufacturer_id) "
                    . "values('$spare_type','$spare_name','$spare_description','$imagefile','$price','$stockin','$stockin','$manufacturer_id')";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.success("Spare Has been added Successfully");               
        </script>';
            } else {
                echo mysqli_errno($connection);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
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
                        <li class="breadcrumb-item active" aria-current="page">Spares Inventory</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">                      
                        <div class="col-sm-12 my-2">
                            <table class="datatable-1 table table-bordered table-striped table-hover table-dark">
                                <thead>
                                    <tr>                                      
                                        <th>Spare Type</th>
                                        <th>Spare Name </th>
                                        <th>Description </th>
                                        <th>Price</th>
                                        <th>Stockin</th>
                                        <th>StockOut</th>    
                                        <th>Remaining</th>     

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($connection, "select * from spare");
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>									
                                        <tr>                                      
                                            <td><?php echo $row['spare_type']; ?></td>
                                            <td><?php echo $row['spare_name']; ?></td>
                                            <td><?php echo $row['spare_description']; ?></td>
                                            <td> <?php echo $row['price']; ?></td>
                                            <td><?php echo $row['stockin']; ?></td>  
                                            <td><?php echo $row['stockout']; ?></td>      
                                            <td><?php echo $row['remaining']; ?></td>      

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

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
