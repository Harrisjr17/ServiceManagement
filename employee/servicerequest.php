<?php
session_start();
include './includes/conn.php';
include 'header.php';
include '../includes/mainmenu.php';

if (isset($_GET['appr'])) {
    echo $_GET['id'];
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
                        <li class="breadcrumb-item">Employee</li>                      
                        <li class="breadcrumb-item active" aria-current="page">Service Requests</li>
                    </ol>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 my-2">
                            <div class="table-responsive">
                                <table class="datatable-1 table table-bordered table-striped table-hover table-dark">
                                    <thead>
                                        <tr>   
<!--                                        <th>Request No</th>-->
                                            <th>Plate No</th>
                                            <th>Manufacturer </th>
                                            <th>Model</th>
                                            <th>Year</th>
                                            <th>Service type</th>
                                            <th>Service Date</th>     
                                            <th>Time</th>
                                            <th>Comments</th>      
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($connection, "select * from service_request");
                                        while ($row = mysqli_fetch_array($query)) {
                                            $service_id = $row['service_id'];
                                            $vehicle_id = $row['vehicle_id'];

                                            $sql = "SELECT * FROM service where service_id = '$service_id'";
                                            $result = mysqli_query($connection, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row3 = mysqli_fetch_assoc($result)) {
                                                    $service = $row3['service_name'];
                                                }
                                            }
                                            $sql = "SELECT * FROM vehicle where vehicle_id = '$vehicle_id'";
                                            $result2 = mysqli_query($connection, $sql);
                                            if (mysqli_num_rows($result2) > 0) {
                                                while ($row1 = mysqli_fetch_assoc($result2)) {
                                                    $plate = $row1['licence_plate'];
                                                    $model = $row1['model'];
                                                    $vehicle = $row1['vehicle_id'];
                                                    $manu = $row1['manufacturer_id'];
                                                    $year = $row1['year'];
                                                }
                                            }
                                            $sql = "SELECT * FROM manufacturer where manufacturer_id = ' $manu'";
                                            $result3 = mysqli_query($connection, $sql);
                                            if (mysqli_num_rows($result3) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($result3)) {
                                                    $manufacturer = $row2['manufacturer_name'];
                                                }
                                            }
                                            ?>									
                                            <tr>                                      
                                            <!--<td><?php echo $row['request_id']; ?></td>-->
                                                <td><?php echo $plate; ?></td>
                                                <td><?php echo $manufacturer; ?></td>
                                                <td><?php echo $model; ?></td>
                                                <td><?php echo $year; ?></td>
                                                <td><?php echo $service; ?></td>
                                                <td> <?php echo $row['service_date']; ?></td>
                                                <td><?php echo $row['time']; ?></td>
                                                <td><?php echo $row['comments']; ?></td>  
                                                
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>                          
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="allocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Mechanic Allocation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        ?>
                                        <form action="servicerequest.php" method="post">
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Manufacturer</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="manufacurer" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $manufacturer; ?>" disabled="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Model</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="model" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $model; ?>" disabled="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Year</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="year" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $year; ?>" disabled="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Licence Plate</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="plate" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $plate; ?>" disabled="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Service Type</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="service" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $service; ?>" disabled="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <!--
                                                <div class="well well-sm">
                                                    <h5></h5>
                                                    <p id="project_title"><img src="image/ajax-loader.gif"> </p>
                                                    <input type="hidden" name="project_id" value="" id="project_id">
                                                    <button class="btn btn-xs btn-primary" title="refresh"><i class="fa fa-refresh"></i></button>
                                                </div>
                                                -->
                                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Mechanic</label>
                                                <?php 
                                                $mech = "select * from mechanic where "
                                                ?>
                                                <div class="col-sm-9">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Please wait while the system allocates a mechanic to a vehicle....</h5>                                                          
                                                            <p class="card-text"id="project_title"><img src="image/ajax-loader.gif"> </p>
                                                            <button class="btn btn-xs btn-primary" title="refresh"><i class="fa fa-refresh"></i></button>                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer my-1">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="allocation" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>     
                                    </div>
                                    <?php
                                    ?>
                                </div>
                            </div>
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
<script>
    $(document).ready(function () {
        $("#login_form1 .well").on('mouseover', function () {
            $.ajax({
                type: 'POST',
                url: 'assign.php',
                data: 'action=yes',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    setTimeout(function () {
                        var project = data[0]['project_name'];
                        var case_ = data[0]['project_case'];
                        var id = data[0]['id'];

                        $("#project_title").html("");
                        $("#project_title").append(project + "<br>" + case_);
                        $("#project_id").val(id);
                    }, 500);
                }
            })
        })
    })
</script>
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
<script src="alertjs/all.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
