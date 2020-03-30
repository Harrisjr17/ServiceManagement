<?php
session_start();
include './includes/conn.php';
include 'header.php';
include '../includes/mainmenu.php';

if (isset($_GET['del'])) {
    mysqli_query($connection, "delete from manufacturer where manufacturer_id = '" . $_GET['id'] . "'");

    $_SESSION['msg'] = '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.error("Manufacturer Has deleted Successfully");               
        </script>';
}
if (isset($_POST['save_manufacturer'])) {
    $name = htmlentities($_POST['manufacturer_name']);
    $description = htmlentities($_POST['description']);
    $type = htmlentities($_POST['type']);

    $sql = "SELECT * FROM manufacturer where manufacturer_name ='$name'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.error("Manufacturer already exists");               
        </script>';
    } else {
        $sql1 = "INSERT INTO manufacturer (manufacturer_name, description, type) VALUES ('$name', '$description', '$type')";

        if (mysqli_query($connection, $sql1)) {
            echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.success("Manufacturer Has been added Successfully");               
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
                        <li class="breadcrumb-item active" aria-current="page">Manage Manufacturers</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Add New Manufacturer
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Manufacturer</h5>                                        
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="manufacturer.php" method="post">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Manufacturer Name:</label>
                                                <input type="text" name="manufacturer_name" class="form-control" id="manufacturer_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Description:</label>
                                                <textarea class="form-control" name="description" rows="5" id="message-text"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="manufacturer_specialty">Manufacturer Type</label>
                                                <select class="form-control" name="type" id="exampleFormControlSelect1">
                                                    <option value="vehicles">Vehicles</option>
                                                    <option value="Spares">Spares</option>                                                   
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="save_manufacturer" class="btn btn-primary">Save Manufacturer</button>
                                            </div>
                                        </form> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                       
                                    </div>
                                </div>
                            </div>
                        </div>   
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
                        <div id="printablediv" style="width: 100%;" class="col-sm-12 my-2">
                            <div class="table-responsive">
                            <table class="datatable-1 table table-bordered table-striped table-hover table-dark">
                                <thead>
                                    <tr>                                      
                                        <th>MANUFACTURER ID</th>
                                        <th>NAME </th>
                                        <th>DESCRIPTION</th>
                                        <th>TYPE</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($connection, "select * from manufacturer");
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>									
                                        <tr>                                      
                                            <td><?php echo $row['manufacturer_id']; ?></td>
                                            <td><?php echo $row['manufacturer_name']; ?></td>
                                            <td> <?php echo $row['description']; ?></td>
                                            <td><?php echo $row['type']; ?></td>                                        
                                            <td>                                                      
                                                <a  tittle="Remove Products" href="manufacturer.php?id=<?php echo $row['manufacturer_id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><button type="button" class="btn btn-danger btn-sm">delete</button></a>
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
