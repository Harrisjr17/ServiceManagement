<?php
session_start();
include './includes/conn.php';
include './includes/header.php';
include '../includes/mainmenu.php';
$customer = $_SESSION['customer'];

if (isset($_POST['editprofile'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];

    $sql1 = "SELECT * FROM customer where phone='$phone'";
    $result = mysqli_query($connection, $sql1);
    if (mysqli_num_rows($result) > 1) {
        echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.error("Number already exists");               
        </script>';
    } else {
        $sql = "UPDATE customer SET firstname = '$firstname', lastname = '$lastname',username = '$username', phone = '$phone' WHERE customer_id = '$customer'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.success("Profile Updated Successfully");               
        </script>';
        } else {
            echo mysqli_error($connection);
        }
    }
}

if (isset($_POST["submit"])) {
    $customer;
    $other_info = $_POST['other_info'];
    $manufacturer = $_POST['manufacturer'];
    $query1 = "select * from manufacturer where manufacturer_name = '$manufacturer'";
    $res = mysqli_query($connection, $query1);
    while ($row2 = mysqli_fetch_assoc($res)) {
        $manufacturer_id = $row2['manufacturer_id'];
    }
    $yom = htmlentities($_POST['year']);
    $model = htmlentities($_POST['model']);
    $licence_plate = $_POST['licence_plate'];
    $image_dir = "uploads/";
    $image_file = $image_dir . basename($_FILES["fileToUpload"]["name"]);
    $insertOk = 1;
    $imagetype = pathinfo($image_file, PATHINFO_EXTENSION);

    // Check if file exists
    if (file_exists($image_file)) {

        $insertOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {

        $insertOk = 0;
    }

    if ($insertOk == 0) {
        //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image_file)) {
            $insertvehicle = "INSERT INTO vehicle(model,year,image,other_info,licence_plate,customer_id,manufacturer_id) "
                    . "VALUES('$model','$yom','$image_file','$other_info','$licence_plate','$customer','$manufacturer_id') ";
            $result = mysqli_query($connection, $insertvehicle);
            if ($result) {
                echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.success("Vehicle Details Successfully Entered");               
        </script>';
            } else {
                echo mysqli_error($connection);    
            }
        } else {
            echo 'something is wrong';
        }
    }
}

$query = "SELECT * FROM vehicle WHERE customer_id = '$customer'";
$result = mysqli_query($connection, $query);
if($result){
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['vehicle'] = $row['vehicle_id'];
        //echo $_SESSION['vehicle'];   
    }
}

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
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
                <div class="container">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success my-1" data-toggle="modal" data-target="#exampleModalCenter">
                        Edit Profile
                    </button>
                    <?php
                    if (isset($_SESSION['vehicle'])) {
                        ?>

                        <?php
                    } else {
                        ?>
                        <button type="button" class="btn btn-success my-1" data-toggle="modal" data-target="#vehiclemodel">
                            add vehicle
                        </button> 
                        <?php
                    }
                    ?>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    $sql = "SELECT * FROM customer where customer_id = '$customer'";
                                    $res = mysqli_query($connection, $sql);
                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            ?>
                                            <form action="profile.php" method="post">
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Firstname</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="firstname" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['firstname']; ?>"placeholder="Enter your firstname"required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Lastname</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="lastname" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['lastname']; ?>" placeholder="Enter your Lastname"required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="username" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['username']; ?>" placeholder="Enter your Username"required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="email" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['email']; ?>" placeholder="provide your email"readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Phone Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="phone" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['phone']; ?>" placeholder="enter phoneNumber"required="">
                                                    </div>
                                                </div>                                                                                                         
                                                <div class="modal-footer my-1">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="editprofile" class="btn btn-success">Save Changes</button>
                                                </div>
                                            </form>     
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="vehiclemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add your Vehicle Information</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>                                                               
                                <div class="modal-body">
                                    <?php
                                    $sql = "SELECT * FROM customer where customer_id = '$customer'";
                                    $resul = mysqli_query($connection, $sql);
                                    if (mysqli_num_rows($resul) > 0) {
                                        while ($row = mysqli_fetch_assoc($resul)) {
                                            ?>
                                            <form action="profile.php" method="post" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="sel1"> Manufacturer:</label>
                                                    <div class="col-sm-9">
                                                        <select name="manufacturer" class="form-control" id="sel1">
                                                            <?php
                                                            $query = "select * from manufacturer";
                                                            $result1 = mysqli_query($connection, $query);
                                                            if (mysqli_num_rows($result1) > 0) {
                                                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                                                    $manufacturer = $row1['manufacturer_name'];
                                                                    ?>
                                                                    <option value="<?php echo $manufacturer ?>"><?php echo $manufacturer; ?></option>   
                                                                    <?php
                                                                }
                                                            }
                                                            ?>                                                                                                                
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Model</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="model" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Enter the vehicle model"required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">year of make</label>
                                                    <div class="col-sm-9">
                                                        <input type="year" name="year" class="form-control form-control-sm" id="colFormLabelSm" placeholder="year of make"required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">licence Plate</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="licence_plate" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Enter your licence Plate"required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Vehicle Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Other Info</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="other_info" class="form-control form-control-sm" rows="5" id="colFormLabelSm" placeholder="Other Information"></textarea>                                   
                                                    </div>
                                                </div>                                                
                                                <div class="modal-footer my-1">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit"class="btn btn-success" value="Upload Details" name="submit">                                                 
                                                </div>                                               
                                            </form>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <?php
                        $sql = "SELECT * FROM customer where customer_id = '$customer'";
                        $resu = mysqli_query($connection, $sql);
                        if (mysqli_num_rows($resu) > 0) {
                            while ($row = mysqli_fetch_assoc($resu)) {
                                ?>
                                <div class="col-sm-6">
                                    <div class="card text-white btn-success mb-3">
                                        <div class="card-header"><strong>Customer Profile</strong></div>
                                        <div class="card-body">                                          
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Firstname</label>
                                                <div class="col">
                                                    <input type="text" name="firstname" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['firstname']; ?>"readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Lastname</label>
                                                <div class="col">
                                                    <input type="text" name="lastname" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['lastname']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Username</label>
                                                <div class="col">
                                                    <input type="text" name="username" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['username']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                                <div class="col">
                                                    <input type="text" name="email" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['email']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone Number</label>
                                                <div class="col">
                                                    <input type="text" name="phone" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['phone']; ?>" readonly>
                                                </div>
                                            </div>               
                                            <?php
                                        }
                                    }
                                    ?>
                                </div> 
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['vehicle'])) {
                            $sql = "SELECT * FROM vehicle where customer_id = '$customer'";
                            $resu = mysqli_query($connection, $sql);
                            if (mysqli_num_rows($resu) > 0) {
                                while ($row1 = mysqli_fetch_assoc($resu)) {
                                    $id = $row1['manufacturer_id'];
                                    $script = "select * from manufacturer where manufacturer_id = '$id'";
                                    $result = mysqli_query($connection, $script);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $manufacturer = $row['manufacturer_name'];
                                    }
                                    ?>
                                    <div class="col-sm-5">
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-header btn-success">
                                                <strong>Vehicle Details</strong>
                                            </div>
                                            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [80%x215]" src="<?php echo $row1['image']; ?>" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
                                            <div class="card-body">
                                                <h5 class="text-center"><span class="badge badge-secondary">MANUFACTURER</span> <?php echo $manufacturer ?></h5>
                                                <h5 class="text-center"><span class="badge badge-secondary">MODEL</span> <?php echo $row1['model'] ?></h5>
                                                <h5 class="text-center"><span class="badge badge-secondary">YEAR</span> <?php echo $row1['year'] ?></h5>
                                                <h5 class="text-center"><span class="badge badge-secondary">PLATE NUMBER</span> <?php echo $row1['licence_plate'] ?></h5>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary">View Vehicle service info</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-6">
                                                                            <div class="card text-white btn-success mb-3">
                                                                                <div class="card-header"><strong>Vehicle Details</strong></div>
                                                                                <div class="card-body">
                                                                                    <div class="form-group row">                                     
                                                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Manufacturer</label>
                                                                                        <div class="col">
                                                                                            <input type="text" name="manufacturer" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $manufacturer; ?>"readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">                                      
                                                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Model</label>
                                                                                        <div class="col">
                                                                                            <input type="text" name="model" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row1['model']; ?>" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">                                      
                                                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Year</label>
                                                                                        <div class="col">
                                                                                            <input type="text" name="year" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row1['year']; ?>" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">                               
                                                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Image</label>
                                                                                        <div class="col">
                                                                                            <input type="text" name="image" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row1['image']; ?>" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">                                  
                                                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Other Information</label>
                                                                                        <div class="col">
                                                                                            <input type="text" name="other_info" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row1['other_info']; ?>" readonly>
                                                                                        </div>
                                                                                    </div>   
                                                                                    <div class="form-group row">                                  
                                                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Licence Number</label>
                                                                                        <div class="col">
                                                                                            <input type="text" name="licence_number" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row1['licence_plate']; ?>" readonly>
                                                                                        </div>
                                                                                    </div>   
                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                    <?php
                                }
                            }
                        }
                        ?> 
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
