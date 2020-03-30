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
                        <li class="breadcrumb-item active" aria-current="page">Spare Store</li>
                    </ol>
                </nav>
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
                            <div class = "col-sm-3">
                                <div class = "card">
                                    <img style = "width: 200px; height: 200px;" class = "card-img-top" src = "../employee/<?php echo $image; ?>">
                                    <div class = "card-body">
                                        <h5 class = "card-title">Spare name :<?php echo $name; ?></h5>
                                        <p class="card-text">Spare Type : <?php echo $type; ?></p>
                                        <p class="card-text">Spare description : <?php echo $description; ?></p>
                                        <p class="card-text">Price : <?php echo $price; ?></p>
                                        <a href="spareorder.php?id=<?php echo $row['spare_id'] ?>" class="btn btn-primary">Purchase</a>
                                    </div>
                                </div>
                            </div>
                            <?php
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
