<?php
session_start();
include './includes/conn.php';
include 'header.php';
include '../includes/mainmenu.php';

if (isset($_GET['del'])) {
    mysqli_query($connection, "delete from service where service_id = '" . $_GET['id'] . "'");

    $_SESSION['msg'] = '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.error("Service Has deleted Successfully");               
        </script>';
}
if (isset($_POST['save_service'])) {
    $name = htmlentities($_POST['servicename']);
    $price = htmlentities($_POST['price']);
    $type = htmlentities($_POST['type']);

    $sql = "SELECT * FROM service where service_name ='$name'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.error("Service already exists");               
        </script>';
    } else {
        $sql1 = "INSERT INTO service (service_name,price, speciaty) VALUES ('$name', '$price', '$type')";

        if (mysqli_query($connection, $sql1)) {
            echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.success("Service Has been added Successfully");               
        </script>';
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
            <div class="col-sm-9 my-2">                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Employee</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Manage Services</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Add New Service
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">New Service</h5>                                        
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="services.php" method="post">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Service Name:</label>
                                                <input type="text" name="servicename" class="form-control" id="servicename">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Service Price:</label>
                                                 <input type="text" name="price" class="form-control">
                                              
                                            </div>
                                            <div class="form-group">
                                                <label for="manufacturer_specialty">Speciaty</label>
                                                <select class="form-control" name="type" id="exampleFormControlSelect1">
                                                    <option value="vehicles">wheel alignment</option>
                                                    <option value="Spares">tire replacement</option>                                                   
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="save_service" class="btn btn-primary">Save services</button>
                                            </div>
                                        </form> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                       
                                    </div>
                                </div>
                            </div>
                        </div>   
                        
                        <div class="col-sm-12 my-2">
                            <div class="table-responsive">
                                <table class="datatable-1 table table-bordered table-striped table-hover table-dark">
                                    <thead>
                                        <tr>                                      
                                            <th>Service ID</th>
                                            <th>NAME </th>
                                            <th>Price</th>
                                            <th>Service TYPE</th>                                        
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($connection, "select * from service");
                                        while ($row = mysqli_fetch_array($query)) {
                                            
                                            ?>									
                                            <tr>                                      
                                                <td><?php echo $row['service_id']; ?></td>
                                                <td><?php echo $row['service_name']; ?></td>
                                                <td> <?php echo $row['price']; ?></td>
                                                <td><?php echo $row['speciaty']; ?></td>                                        
                                                <td>                                                      
                                                    <a title="Remove service" href="services.php?id=<?php echo $row['service_id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><button type="button" class="btn btn-danger btn-sm">delete</button></a>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                        ?>

                                    </tbody>                                  
                                </table>
                            </div>                          r
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
<?php
if (isset($_GET['del'])) {
    echo $_SESSION['msg'];
}
?>
</body>
<script src="../alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
    