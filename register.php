<?php
session_start();
include './includes/conn.php';
if (isset($_SESSION['customer'])) {
    header('Location: customer/');
} else if (isset($_SESSION['mechanic'])) {
    header('Location: mechanic/');
} else {
    if (isset($_POST['register'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass = md5($_POST['password']);
        $verify = $_POST['verify'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = '<script src="alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.error("Invalid Email format!!");        
            </script>';
        } else {
            if ($_POST['password'] != $verify) {
                $_SESSION['msg'] = '<script src="alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.error("Passwords Do not Match !!");               
            </script>';
            } else {
                $sql1 = "SELECT * FROM customer where email ='$email' or phone='$phone'";
                $result = mysqli_query($connection, $sql1);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION['msg'] = '<script src="alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.error("Either Email or Password already Exists");               
            </script>';
                } else {

                    $sql = "INSERT INTO customer (firstname,lastname,username,email,phone,password)
            VALUES ('$firstname','$lastname','$username','$email','$phone','$pass')";
                    $res = mysqli_query($connection, $sql);

                    if ($res) {
                        $_SESSION['msg'] = '<script src="alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.success("Registration Successful proceed to Login");               
            </script>';
                    } else {
                        $_SESSION['msg'] = '<script src="alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.error("Registration Failed");               
            </script>';
                    }
                }
            }
        }
    }
    include './includes/header.php';
    include './includes/mainmenu.php';
    ?>

<body>
        <div class="col">
            <div class="row">
                <?php
                include './includes/menubar.php';
                ?>
                <div class="col-sm-9 my-2">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Manja Garage</h1>
                            <p class="lead">we offer you fast and reliable services at good prices.</p>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2 my-1">

                            </div>
                            <div class="col-sm-8 my-1">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Register with Us Below</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Make sure you enter the appropriate information.</h6>

                                        <form action="register.php" method="post">

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Firstname</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="firstname" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Enter your firstname"required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Lastname</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="lastname" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Enter your Lastname"required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="username" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Enter your Username"required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="provide your email"required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Phone Number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="phone" class="form-control form-control-sm" id="colFormLabelSm" placeholder="enter phoneNumber"required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password" class="form-control form-control-sm" id="colFormLabelSm" placeholder="type in password"required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Verify Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="verify" class="form-control form-control-sm" id="colFormLabelSm" placeholder="verify password"required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-form-label col-form-label-sm"></div>
                                                <div class="col-sm-8">
                                                    <button type="submit" name="register" class="btn btn-success">Register</button>     
                                                    <a class="btn btn-info" href="login.php"><i class="fa fa-user"></i>  Login</a>    
                                                </div>
                                          
                                            </div>
                                        </form>                                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 my-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (!empty($firstname) && !empty($firstname) && !empty($lastname) && !empty($phone) && !empty($pass)) {
            echo $_SESSION['msg'];
        }
    }
    ?>
</body>
<script src="alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
