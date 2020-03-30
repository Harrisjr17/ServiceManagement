<div class="row-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">New service Requests</div>
        <div class="panel-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>service</th>
                        <th>date</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql1 = "select * from service_request where status = 'Null'";
                    $result1 = mysqli_query($connection, $sql1);
                    while ($row1 = mysqli_fetch_array($result1)) {
                        $req = $row1['request_id'];
                        $serid = $row1['service_id'];
                        $serdate = $row1['service_date'];

                        $sql = "SELECT * from service where service_id = '$serid'";
                        $result = mysqli_query($connection, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $sername = $row['service_name'];
                            }
                            ?><br>

                        <tr>
                            <td><?php echo $sername; ?></td>
                            <td><?php echo $serdate; ?></td>
                            <td>
                                <a  class="btn btn-primary btn-sm" href="calendar_of_events.php<?php echo '?request_id=' . $req; ?>">approve</a>
                                <a  class="btn btn-danger btn-sm" href="delete_event.php<?php echo '?id=' . $req; ?>">Deny</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>  
    </div>
</div>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">approved service Requests</div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($_GET['request_id'])) {
                        $r_id = $_GET['request_id'];
                        $update = "UPDATE service_request SET status = 'approved' WHERE request_id= '$r_id'";
                        $result2 = mysqli_query($connection, $update);
                        if ($result) {
                        echo '<script src="../alertjs/all.js"></script>       
                              <script>
                                  alertify.logPosition("top right");                        
                                  alertify.success("Service request Approved");               
                              </script>';
                              }
                    }
                    ?>
                    <tbody>
                        </div>
                        <?php
                        $sql1 = "select * from service_request where status = 'approved' and assigned ='0'";
                        $result1 = mysqli_query($connection, $sql1);
                        while ($row4 = mysqli_fetch_array($result1)) {
                            $request_id = $row4['request_id'];
                            $serid = $row4['service_id'];
                            $serdate = $row4['service_date'];

                            $sql = "SELECT * from service where service_id = '$serid'";
                            $result = mysqli_query($connection, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $sername = $row['service_name'];
                                }
                                ?>                              
                                <tr id="del<?php echo $request_id; ?>">
                                    <td><?php echo $sername ?> </td>
                                    <td><?php echo $serdate; ?>                      
                                    </td>                                    
                                    <td width="40">
                                        <a  class="btn btn-danger btn-sm" href="delete_event.php<?php echo '?id=' . $request_id; ?>">delete</a>
                                        <a  class="btn btn-success btn-sm" href="assignmechanic.php<?php echo '?id=' . $request_id; ?>">Assign Mechanic</a>
                                    </td>                                      
                                </tr>
                                <?php
                            } else {
                                echo 'no data currently';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

