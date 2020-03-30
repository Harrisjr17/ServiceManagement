<?php
session_start();
include './includes/conn.php';
if (isset($_SESSION['customer'])) {
    header('Location: customer/');
} else if (isset($_SESSION['employee'])) {
    header('Location: employee/');
} else {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $username = $_POST['email'];
        $sql2 = "select * from employee where email ='$email' or username='$username' and password='$pass'";
        $result1 = mysqli_query($connection, $sql2);

        $sql1 = "SELECT * FROM customer where email ='$email' or username='$username' and password='$pass'";
        $result = mysqli_query($connection, $sql1);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $_SESSION['customer'] = $row['customer_id'];
            }
            header('Location: customer/dashboard.php');
            $_SESSION['msg'] = '<script src="alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.success("Login Success");               
            </script>';
        } elseif (mysqli_num_rows($result1) > 0) {
            while ($row1 = mysqli_fetch_array($result1)) {
                $role = $row1['type'];
                if ($role === mechanic) {
                    $_SESSION['mechanic'] = $row1['employee_id'];
                     header('Location: employee/newservice.php');
                } else{
                    $_SESSION['employee'] = $row1['employee_id'];
                header('Location: employee/dashboard.php');
                }
            }
        } else {
            $_SESSION['msg'] = '<script src="alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.error("Login Failed Invalid Credationals");               
            </script>';
//}
        }
    }
    include './includes/header.php';
    include './includes/mainmenu.php';
    ?>

    <body
        <div class="col">
            <div class="row">
                <?php
                include './includes/menubar.php';
                ?>
                <div class="col-sm-9 my-2">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img style=" height: 400px;" class="d-block w-100" src="images/X6/BMW-X6_2009_800x600_wallpaper_04.jpg" alt="First slide">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2 my-1">
                            </div>
                            <div class="col-sm-8 my-1">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Login to the system below</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Make sure you enter the appropriate information.</h6>

                                        <form action="login.php" method="post">
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Email/Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="provide your email or Username"required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password" class="form-control form-control-sm" id="colFormLabelSm" placeholder="type in password"required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-form-label col-form-label-sm"></div>
                                                <div class="col-sm-6">
                                                    <button type="submit" name="login" class="btn btn-success"><i class="fa fa-sign-in"></i> Login</button> 
                                                    <a class="btn btn-info" href="register.php"><i class="fa fa-user"></i>  Register</a>        
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
        if (!empty($email) && !empty($pass)) {
            echo $_SESSION['msg'];
        }
    }
    ?>
</body>
<script src="alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
