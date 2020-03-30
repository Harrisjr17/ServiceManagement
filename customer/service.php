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
                        <li class="breadcrumb-item active" aria-current="page">Services</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">
                        <?php
                        $query = mysqli_query($connection, "select * from service");
                        while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <?php $name = $row['service_name']; ?>
                            <?php $price = $row['price']; ?>
                            <?php $speciaty = $row['speciaty']; ?>  
                             
                            <div class = "col-sm-6">
                                <div class = "card">                                                                    
                                    <div class = "card-body">
                                        <h5 class = "card-title">Spare name :<?php echo $name; ?></h5>
                                      
                                        <p class="card-text">Spare description : <?php echo $speciaty; ?></p>
                                        <p class="card-text">Price : <?php echo $price; ?></p>
                                        <a href="requestservice.php" class="btn btn-primary">Book service</a>
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
