<?php
session_start();
include './includes/conn.php';
include 'header.php';
include '../includes/mainmenu.php';
$mech_id = $_SESSION['mechanic'];
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
<script language="javascript" type="text/javascript">
    var popUpWin = 0;
    function popUpWindow(URLStr, left, top, width, height)
    {
        if (popUpWin)
        {
            if (!popUpWin.closed)
                popUpWin.close();
        }
        popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
    }

</script>
<body>
    <div class="col">
        <div class="row">
            <?php
            include '../includes/menubar.php';
            ?>
            <div class="col-sm-9 my-2">                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Mechanic</li>                      
                        <li class="breadcrumb-item active" aria-current="page">New Jobs</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">
                        <!-- Modal -->
                        <div class="modal fade" id="addspare" tabindex="-1" role="dialog" aria-labelledby="addspare" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Spare</h5>                                        
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">                                       
                                        <form action="spares.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">spare type</span>
                                                </div>
                                                <input type="text" name="spare_type" class="form-control" id="spare_type" required="">
                                            </div>
                                            <div class="form-group input-group input-group-sm mb-3"> 
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">spare Name</span>
                                                </div>
                                                <input type="text" name="spare_name" class="form-control" id="spare_name" required="">
                                            </div>
                                            <div class="form-group input-group input-group-sm mb-3"> 
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Description</span>
                                                </div>
                                                <textarea name="spare_description" required="" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>                                             
                                            </div>
                                            <div class="form-group input-group input-group-sm mb-3">                                             
                                                <input type="file" name="fileToUpload" id="fileToUpload">                                              
                                            </div>
                                            <div class="form-group input-group input-group-sm mb-3"> 
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Price</span>
                                                </div>
                                                <input type="text" name="price" class="form-control" id="price" required="">
                                            </div>
                                            <div class="form-group input-group input-group-sm mb-3"> 
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Stock In  </span>
                                                </div>
                                                <input type="text" name="stockin" class="form-control" id="stockin" required="">
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
                                                <button type="submit" name="submit" class="btn btn-primary">Add Spare</button>
                                            </div>
                                        </form>                                    
                                    </div>
                                    <div class="modal-footer">                                                                
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                       
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="col-sm-12 my-2">
                            <table class="datatable-1 table table-bordered table-striped table-hover table-dark">
                                <thead>
                                    <tr>                                      

                                        <th>Vehicle Plate</th>
                                        <th>Service type</th>      
                                        <th>Service status</th>      
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($connection, "select * from service_track where mechanic_id ='$mech_id' and status = 'pending'");
                                    if($query){
                                        while ($row1 = mysqli_fetch_assoc($query)) {
                                            $service_id = $row1['service_id'];
                                            $id = $row1['id'];
                                            $vehic = $row1['vehicle_id'];
                                            $query3 = mysqli_query($connection, "select * from vehicle where vehicle_id = '$vehic'");
                                            while ($vehicle_row = mysqli_fetch_assoc($query3)) {
                                                $registration = $vehicle_row['licence_plate'];
                                            }
                                            $service = "select * from service where service_id = '$service_id'";
                                            $serviceresult = mysqli_query($connection, $service);
                                            while ($row2 = mysqli_fetch_array($serviceresult)) {
                                                $service = $row2['service_name'];
                                            }
                                            echo $service_id;
                                            ?>	
                                            <tr>   
                                                <td> <?php echo $registration; ?></td>
                                                <td><?php echo $service; ?></td>         
                                                <td><?php echo $row1['status']; ?></td>
                                                <td>   <a href="javascript:void(0);" onClick="popUpWindow('trackupdate.php?sid=<?php echo $id; ?>');" title="Update order"><button type="button" class="btn btn-primary btn-xs">Service Update</button></a>
                                        </td>
                                            </tr>
                                            <?php
                                        }
                                    
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
