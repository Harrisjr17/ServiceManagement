<?php
session_start();
include './includes/conn.php';
include './includes/header.php';
include '../includes/mainmenu.php';
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
                        <li class="breadcrumb-item active" aria-current="page">Order details</li>
                    </ol>
                </nav>
                <?php
                if (isset($_POST['order'])) {
                    $spare = $_SESSION['spare'];
                    $q = $_SESSION['quantity'];
                    $t = $_SESSION['total'];
                    $customer = $_SESSION['customer'];
                    $sql5 = "insert into orders (quantity,customer_id,spare_id,total)values('$q','$customer','$spare','$t')";
                    $result9 = mysqli_query($connection, $sql5);
                    if ($result9) {
                        echo '<script src="../alertjs/all.js"></script>       
                <script>
                    alertify.logPosition("top right");                        
                    alertify.success("Your Order Has been Placed");               
                </script>';
                        $sql1 = "select * from spare where spare_id = '$spare'";
                        $result8 = mysqli_query($connection, $sql1);
                        while ($row3 = mysqli_fetch_assoc($result8)) {
                            $stock = $row3['remaining'];
                            $remain = $row3['stockout'];
                        }
                        $left = $q + $remain;
                        $remainder = $stock - $q;
                        $sql2 = "UPDATE spare SET remaining = '$remainder', stockout = '$left' WHERE spare_id = '$spare'";
                        $result7 = mysqli_query($connection, $sql2);
                    }
                }
                
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        $query = mysqli_query($connection, "select * from spare");
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
                        <div id="printablediv" style="width: 100%;"  class="table-responsive"><br>
                            <table class="datatable-1 table  table-striped table-hover table-dark">
                                <thead>
                                    <tr>                                      
                                        <th></th>
                                        <th>Order Details</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $sql = "select * from spare where spare_id = '$spare'";
                                        $result = mysqli_query($connection, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <?php
                                            $type = $row['spare_type'];
                                            $name = $row['spare_name'];
                                            $image = $row['image'];
                                            ?> 


                                            <td><img style = "width: 200px; height: 200px;" class = "card-img-top" src = "../employee/<?php echo $image; ?>"></td>
                                            <td>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <?php
                                                        $customer = $_SESSION['customer'];
                                                        $cust = "select * from customer where customer_id = '$customer'";
                                                        $custresult = mysqli_query($connection, $cust);
                                                        while ($custrow = mysqli_fetch_assoc($custresult)) {
                                                            $fname = $custrow['firstname'];
                                                            $sname = $custrow['lastname'];
                                                        }
                                                        ?>
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Customer Name</span>
                                                    </div>
                                                    <input type="text" name="type" class="form-control" id="price" disabled=""  value="<?php echo $fname;
                                                    echo $sname;
                                                        ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Order Number</span>
                                                    </div>
                                                    <input type="text" name="type" class="form-control" id="price" disabled=""  value="<?php echo $type; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Spare Type</span>
                                                    </div>
                                                    <input type="text" name="type" class="form-control" id="price" disabled=""  value="<?php echo $type; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Spare Name</span>
                                                    </div>
                                                    <input type="text" name="name" class="form-control" id="price"  disabled="" value="<?php echo $name; ?>">
                                                </div>  
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Number of spares</span>
                                                    </div>
                                                    <input type="number" name="quantity" class="form-control" id="price"disabled="" value="<?php echo $q; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Total Cost</span>
                                                    </div>
                                                    <input type="number" name="quantity" class="form-control" id="price"disabled="" value="<?php echo $t; ?>">
                                                </div>

                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="23" colspan="2" align="center"><a class="btn btn-primary"href='#' onclick="javascript:printDiv('printablediv')" ><strong>Print purchase report..</strong></a></td>
                                    </tr>
                                </tbody>
                            </table>
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
