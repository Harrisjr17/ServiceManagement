<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manja Garage service Management</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="touse/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="bootstrap4/css/style.css">
        <script src="touse/js/popper.min.js"></script>
        <script src="touse/jquery/3.3.1/jquery.min.js"></script>
        <script src="touse/js/bootstrap.min.js"></script>
        <script src="alertjs/all.js"></script>
        <!--
                <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
                <script src="bootstrap/jquery/3.3.1/jquery.min.js"></script>    
                <script src="bootstrap/js/popper.min.js"></script>
                <script src="bootstrap/bootstrap.min.js"></script>-->
    </head>
    <?php
    include './includes/conn.php';
    ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-info">
        <a class="navbar-brand" href="../index.php">Manja Service Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav">
                <li  class="nav-item">
                    <a style="color: #fff;" class="nav-link btn btn-success btn-small mr-1 my-1" href="sparestore.php">Spares</a>
                </li>
                <li  class="nav-item">
                    <a style="color: #fff;" class="nav-link btn btn-success btn-small mt-1 mr-1" href="#">Car Service</a>
                </li> 
                <li class="nav-item">
                    <a style="color: #fff;" class="nav-link btn btn-success btn-small mt-1" href="customer/forum/pages/home.php">Forum</a>
                </li> 
            </ul>      
        </div>
    </nav>
    <body
        <div class="col">
            <div class="row">
                <?php
                include './includes/menubar.php';
                ?>
                <div class="col-sm-9 my-2">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img style="height: 400px;" class="d-block w-100" src="images/Toyota.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img style="height: 400px;" class="d-block w-100" src="images/Volkswagen.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img  style="height: 400px;"     class="d-block w-100" src="images/X6/BMW-X6_UK_Version_2009_800x600_wallpaper_01.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm my-1">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Spares</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Get long lasting quality spares</h6>                                  
                                        <img class="d-block w-100" src="images/spareparts.jpg" alt="First slide">  
                                        <a href="sparestore.php" class="btn btn-dark my-2">Click here to view Spares</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm my-1">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Spares</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Get long lasting quality spares</h6>                                  
                                        <img class="d-block w-100" src="images/spareparts.jpg" alt="First slide">    
                                        <a href="sparestore.php" class="btn btn-dark my-2">Click here to view Spares</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm my-1">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Spares</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Get long lasting quality spares</h6>                                  
                                        <img class="d-block w-100" src="images/spareparts.jpg" alt="First slide">    
                                        <a href="sparestore.php" class="btn btn-dark my-2">Click here to view Spares</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</html>
