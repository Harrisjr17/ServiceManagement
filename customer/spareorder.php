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
$spare = $_GET['id'];
?>
<body>
    <div class="col">
        <div class="row">
            <?php
            include '../includes/menubar.php';
            ?>
            <div class="col-sm-2"></div>
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
                                        <th>Spare and Order Details </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $sql = "select * from spare where spare_id = '$spare'";
                                        $result = mysqli_query($connection, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <?php $type = $row['spare_type']; ?>
                                            <?php $name = $row['spare_name']; ?>
                                            <?php $description = $row['spare_description']; ?>  
                                            <?php $image = $row['image']; ?>  
                                            <?php $price = $row['price']; ?>
                                            <?php $stock = $row['availability']; ?>  
                                            <?php
                                        }
                                        ?>
                                        <td><img style = "width: 200px; height: 200px;" class = "card-img-top" src = "../employee/<?php echo $image; ?>"></td>
                                        <td>
                                            <form action="processorder.php" method="post">
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Spare Type</span>
                                                    </div>
                                                    <input type="text" name="type" class="form-control" id="price" disabled=""  value="<?php echo $type; ?>">
                                                    <input type="hidden" name="spare_id" class="form-control" id="price" value="<?php echo $spare; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Spare Name</span>
                                                    </div>
                                                    <input type="text" name="name" class="form-control" id="price"  disabled="" value="<?php echo $name; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Description</span>
                                                    </div>
                                                    <input type="text" name="description" class="form-control" id="price"  disabled=""  value="<?php echo $description; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Price</span>
                                                    </div>
                                                    <input type="text" name="amount" class="form-control" id="price" value="<?php echo $price ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Availability</span>
                                                    </div>
                                                    <input type="text" name="availability" class="form-control" id="price"  disabled=""  value="<?php echo $stock; ?>">
                                                </div>
                                                <div class="form-group input-group input-group-sm mb-3"> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Number of spares</span>
                                                    </div>
                                                    <input type="number" name="quantity" class="form-control" id="price" required="">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="submit" class="btn btn-primary">Press Order</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
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
