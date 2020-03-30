<?php
session_start();
include './includes/conn.php';
include './includes/header.php';
$customer = $_SESSION['customer'];

if (isset($_POST['editprofile'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];

    $sql1 = "SELECT * FROM customer where phone='$phone'";
    $result = mysqli_query($connection, $sql1);
    if (mysqli_num_rows($result) > 1) {
        $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Cation!</strong> Phone number already Exist in System.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
    } else {
        //$sql = "UPDATE customer SET firstname ,lastname, phone = '$firstname','$lastname','$phone' WHERE customer_id = '$customer'";
        $sql = "UPDATE customer SET firstname = '$firstname', lastname = '$lastname',username = '$username', phone = '$phone' WHERE customer_id = '$customer'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
             $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Profile Updated.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            echo mysqli_error($connection);
        }
    }
}
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
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
                <div class="container">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success my-1" data-toggle="modal" data-target="#exampleModalCenter">
                        Edit Profile
                    </button>
                    <?php
                    if (!empty($firstname)) {
                         echo $_SESSION['msg'];
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
                                    $result = mysqli_query($connection, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
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

                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="container">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <div class="card text-white btn-success mb-3">
                                            <div class="card-header"><strong>Customer Profile</strong></div>
                                            <div class="card-body">
                                                <?php ?>
                                                <div class="form-group row">
                                                    <div class="col-sm-2"></div>
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Firstname</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="firstname" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['firstname']; ?>"readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                      <div class="col-sm-2"></div>
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Lastname</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="lastname" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['lastname']; ?>" readonly>
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                      <div class="col-sm-2"></div>
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Username</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="username" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['username']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                      <div class="col-sm-2"></div>
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="email" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $row['email']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                      <div class="col-sm-2"></div>
                                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Phone Number</label>
                                                    <div class="col-sm-5">
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
