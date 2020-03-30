<?php
session_start();
include './includes/conn.php';
include 'header.php';
include '../includes/mainmenu.php';
include '../mailer/PHPMailerAutoload.php';
include ( "../nexmo/NexmoMessage.php" );
if (isset($_GET['del'])) {
    $id = $_GET['id'];
    $del = mysqli_query($connection, "delete from customer where customer_id = '$id'");
    if ($del) {
        echo'<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.error("Customer Has been deleted Successfully");               
        </script>';
    } else {
        echo'<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.error("failed");               
        </script>';
    }
}

if (isset($_POST['customer_reg'])) {
    $fname = htmlentities($_POST['firstname']);
    $lname = htmlentities($_POST['lastname']);
    $uname = htmlentities($_POST['username']);
    $email = htmlentities($_POST['email']);
    $gender = htmlentities($_POST['gender']);
    $phone = htmlentities($_POST['phone']);
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $tpass = substr(str_shuffle($chars), 0, 8);
    //echo $tpass;
    $pass = md5($tpass);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = '<script src="../alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.error("Invalid Email format!!");        
            </script>';
    } else {
        $sql1 = "SELECT * FROM customer where email ='$email' or phone='$phone'";
        $result = mysqli_query($connection, $sql1);
        if (mysqli_num_rows($result) > 0) {
            echo'<script src="../alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.error("Either Email or Password already Exists");               
            </script>';
        } else {
            $sql = "INSERT INTO customer (firstname,lastname,username,email,gender,phone,password)
            VALUES ('$fname','$lname','$uname','$email','$gender','$phone','$pass')";
            $res = mysqli_query($connection, $sql);

            if ($res) {
                echo'<script src="../alertjs/all.js"></script>       
            <script>  
                alertify.logPosition("top right");                        
                alertify.success("Customer Registration Successful");               
            </script>';

                $mail = new PHPMailer;
                $companymail = 'manjagarage@gmail.com';
                $mailpass = 'SaSa1234';
                $mail->isSMTP();                                   // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                            // Enable SMTP authentication
                $mail->Username = $companymail;          // SMTP username
                $mail->Password = $mailpass; // SMTP password
                $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                 // TCP port to connect to

                $mail->setFrom($companymail, 'Manja service center ');
                $mail->addReplyTo($companymail, 'Manja service center');
                $mail->addAddress($email);   // Add a recipient
                $mail->isHTML(true);  // Set email format to HTML

                $bodyContent = '<h1>Customer Registration Confimation</h1>';
                $bodyContent .= '<p>dear ' . $fname . ' ' . $lname . ' " Have been Registered to the system. your username is"' . $uname . '" and your password is "' . $tpass . '"</b></p>';
                $bodyContent .= "<p>Thank you for choosing and trusting in Us</b></p>";

                $mail->Subject = 'Customer Registration';
                $mail->Body = $bodyContent;

                if (!$mail->send()) {
                    /*                     * echo 'Message could not be sent.';
                      echo 'Mailer Error: ' . $mail->ErrorInfo; */
                } else {
                    //echo 'Message has been sent';
                    echo'<script src="../alertjs/all.js"></script>       
            <script>  
                alertify.logPosition("top left");                        
                alertify.success("Email sent to "' . $uname . '"  ");               
            </script>';
                }
            } else {
                echo'<script src="../alertjs/all.js"></script>       
            <script>
                alertify.logPosition("top right");                        
                alertify.error("Registration Failed");               
            </script>';
            }
            // Step 1: Declare new NexmoMessage.
            $nexmo_sms = new NexmoMessage('c6b6a3c3', 'xk2ecFLJVxpGbCoh');
            // Step 2: Use sendText( $to, $from, $message ) method to send a message. 
            $info = $nexmo_sms->sendText($phone, 'Manja service center', '(Manja service center) ' . $uname . ' you have been registered to Manja service center your username is '.$uname.' email to login and the following as password ' . $tpass . ' !');
            // Step 3: Display an overview of the message
            // $nexmo_sms->displayOverview($info);
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
            <div class="col-sm-10 my-2">                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Customer</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Manage Customers</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Add New Customer
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title success" id="exampleModalCenterTitle">Add Customer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="customers.php" method="post">
                                            <div class="form-group">                                             
                                                <input type="text" name="firstname" class="form-control" id="firstname"placeholder="Enter Firstname">
                                            </div>
                                            <div class="form-group">                                             
                                                <input type="text" name="lastname" class="form-control" id="lastname"placeholder="Enter Lastname">
                                            </div>
                                            <div class="form-group">                                            
                                                <input type="text" name="username" class="form-control" id="username"placeholder="Enter Username">
                                            </div>
                                            <div class="form-group">                         
                                                <input type="email" name="email" class="form-control" id="email"placeholder="Enter Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="manufacturer_specialty">Gender</label>
                                                <select class="form-control" name="gender" id="exampleFormControlSelect1">
                                                    <option value="male">Male</option>
                                                    <option value="femaile">Female</option>                                                   
                                                </select>
                                            </div>
                                            <div class="form-group">                         
                                                <input type="number" name="phone" class="form-control" id="email"placeholder="Enter phone Number (265)">
                                            </div>                                         
                                            <div class="form-group">
                                                <button type="submit" name="customer_reg" class="btn btn-primary">Save Customer Details</button>
                                            </div>
                                        </form> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="col-sm-12 my-2">
                            <script language="javascript" type="text/javascript">
                            function printDiv(divID) {
                                //Get the HTML of div
                                var divElements = document.getElementById(divID).innerHTML;
                                //Get the HTML of whole page
                                var oldPage = document.body.innerHTML;

                                //Reset the page's HTML with div's HTML only
                                document.body.innerHTML =
                                        "<html><head><title></title></head><body>" +
                                        divElements + "</body>";

                                //Print Page
                                window.print();

                                //Restore orignal HTML
                                document.body.innerHTML = oldPage;
                            }
                        </script>
                            <div id="printablediv" style="width: 100%;" class="table-responsive">
                                <table class="datatable-1 table table-bordered table-striped table-hover table-dark">
                                    <thead>
                                        <tr>                                      
                                           
                                            <th>FIRSTNAME </th>
                                            <th>LASTNAME</th>
                                            <th>USERNAME</th>
                                            <th>EMAIL</th>
                                            <th>PHONENUMBER</th>
                                            <th>DATE REGISTERED</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($connection, "select * from customer");
                                        while ($row = mysqli_fetch_array($query)) {
                                            ?>									
                                            <tr>                                      
                                          
                                                <td><?php echo $row['firstname']; ?></td>
                                                <td> <?php echo $row['lastname']; ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['dateregister']; ?></td>
                                                <td>                                                      
                                                    <a tittle="delete customer" href="customers.php?id=<?php echo $row['customer_id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><button type="button" class="btn btn-danger btn-sm">delete</button></a>
                                                </td>

                                            </tr>
                                            <?php
                                        }
                                        ?>
                                             <tr>
                                        <td height="23" colspan="2" align="center"><a class="btn btn-primary"href='#' onclick="javascript:printDiv('printablediv')" ><strong>Print purchase report..</strong></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
            </div>
        </div>
    </div>
</div>
</div>

</body>
<script src="../alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
