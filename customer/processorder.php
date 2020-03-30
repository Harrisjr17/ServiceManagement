<?php
session_start();
include './includes/conn.php';
include './includes/header.php';
include '../includes/mainmenu.php';
$customer = $_SESSION['customer'];

if (!isset($customer)) {
    header("Location: ../login.php");
} else {
    
}
if (isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $spare = $_POST['spare_id'];
    $price = $_POST['amount'];
    $spareq = $quantity * $price;
    $spareq;
}
?>

<body>
    <div class="col">
        <div class="row">
            <?php
            include '../includes/menubar.php';
            ?>

            <div class="col-sm-6 my-2">                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Customer</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Spare information</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">                   
                        <div class="table-responsive">
                            <table class="datatable-1 table  table-striped table-hover table-dark">
                                <thead>
                                    <tr>                                      
                                        <th></th>
                                        <th>Confirm your Order</th>

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
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Price</span>
                                                    </div>
                                                    <input type="text" name="amount" class="form-control" id="price" disabled=""  value="<?php echo $price ?>">
                                                </div>

                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Number of spares</span>
                                                    </div>
                                                    <input type="number" name="quantity" class="form-control" id="price"disabled="" value="<?php echo $quantity; ?>">
                                                </div>

                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 my-2">
                <div class="row">
                    <div class="container">
                        <div class="card text-center">
                            <div class="card-header">
                                Finalize your Order
                            </div>
                            <div class="card-body">
                                <form action="finalorder.php" method="post">
                                    <h5 class="card-title"><?php echo $name; ?></h5>
                                    <p class="card-text">quantity selected :<span class="badge badge-warning"><?php echo $quantity; ?></span></p>
                                    <p class="card-text">Spare Price :<span class="badge badge-warning"><?php echo $price; ?></span></p>
                                    <p class="card-text">Total Cost :<span class="badge badge-warning"><?php echo $spareq; ?></span></p>
                                    <input type="hidden" name="quantity" class="form-control" disabled="" value="<?php echo $quantity ?>">
                                    <input type="hidden" name="spare" class="form-control" disabled="" value="<?php echo $spare ?>">
                                    <input type="hidden" name="total" class="form-control" disabled="" value="<?php echo $spareq ?>">
                                    <?php
                                    $_SESSION['spare'] = $spare;
                                    $_SESSION['quantity'] = $quantity;
                                    $_SESSION['total'] = $spareq;
                                    ?>
                                    <button type="submit" name="order" class="btn btn-primary">Press Order</button>

                                </form>

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
        ?>
</body>
<script src="alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>

