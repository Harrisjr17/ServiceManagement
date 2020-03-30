<?php
session_start();
include './includes/conn.php';
if (strlen($_SESSION['mechanic']) == 0) {
    header('location:../index.php');
} else {
    $oid = intval($_GET['sid']);
    if (isset($_POST['submit2'])) {
        $status = $_POST['status'];
        $remark = $_POST['remark'];

        $sql = mysqli_query($connection, "update service_track set status='$status',comments = '$remark' where id='$oid'");

        echo "<script>alert('Service updated sucessfully...');</script>";

        include ( "../nexmo/NexmoMessage.php" );
        // Step 1: Declare new NexmoMessage.
        $nexmo_sms = new NexmoMessage('c6b6a3c3', 'xk2ecFLJVxpGbCoh');
        // Step 2: Use sendText( $to, $from, $message ) method to send a message. 
        $info = $nexmo_sms->sendText('265881382543', 'Vehicle Service Management', '(Vehicle Service Management) your  Service number is "' . $oid . '"and the status is "' . $status . '"' . $remark . '" !');
        // Step 3: Display an overview of the message
        // $nexmo_sms->displayOverview($info);

        $billing = "select * from service_track where id = '$oid'";
        $billresult = mysqli_query($connection, $billing);
        while ($row1 = mysqli_fetch_assoc($billresult)) {
            $mechanic = $row1['mechanic_id'];
            $lab = "select * from employee where employee_id = '$mechanic'";
            $labres = mysqli_query($connection, $lab);
            while ($row2 = mysqli_fetch_assoc($labres)) {
                $labor_charge = $row2['labour_charge'];
            }
            $service = $row1['service_id'];
            $servic = "select * from service where service_id = '$service'";
            $servicres = mysqli_query($connection, $servic);
            while ($row3 = mysqli_fetch_assoc($servicres)) {
                echo $servicecost = $row3['price'];
            }
            $vehicle = $row1['vehicle_id'];

            $total = $labor_charge + $servicecost;

            $bill = "INSERT INTO billing (totalcost, status, vehicle_id, service_id) VALUES ('$total', 'not paid', '$vehicle', '$service')";
            $save = mysqli_query($connection, $bill);
            if ($save) {
                // Step 1: Declare new NexmoMessage.
                $nexmo_sms = new NexmoMessage('c6b6a3c3', 'xk2ecFLJVxpGbCoh');
                // Step 2: Use sendText( $to, $from, $message ) method to send a message. 
                $info = $nexmo_sms->sendText('265881382543', 'Vehicle Service Management', '(Vehicle Service Management) your  Service bill has totaled "' . $total . '"which include service and labour charges pay when collecting you vehicle "!');
                // Step 3: Display an overview of the message
                // $nexmo_sms->displayOverview($info);
            } else {
                echo mysqli_error($connection);
            }
        }
    }
    ?>
    <script language="javascript" type="text/javascript">
        function f2()
        {
            window.close();
        }
        ser
        function f3()
        {
            window.print();
        }
    </script>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <title>Update Compliant</title>
            <link href="bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <script src="bootstrap/jquery/3.1.1/jquery.min.js   "></script>
            <script src="bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link href="anuj.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            <div>
                <form name="updateticket" id="updateticket" method="post"> 
                    <tabled class="atatable-1 table table-bordered table-striped">
                        <tr height="50">
                            <td colspan="2" class="fontkink2" style="padding-left:0px;"><div class="fontpink2"> <b>Service Update !</b></div></td>
                        </tr>
                        <tr height="30">
                            <td  class="fontkink1"><b>Service Id:</b></td>
                            <td  class="fontkink"><?php echo $oid; ?></td>
                        </tr>
                        <?php
                        $ret = mysqli_query($connection, "SELECT * FROM service_track WHERE id='$oid'");
                        while ($row = mysqli_fetch_assoc($ret)) {
                            ?>
                            <tr height="20">
                                <td class="fontkink1" ><b>At Date:</b></td>
                                <td  class="fontkink"><?php echo $row['vehicle_id']; ?></td>
                            </tr>
                            <tr height="20">
                                <td  class="fontkink1"><b>Status:</b></td>
                                <td  class="fontkink"><?php echo $row['status']; ?></td>
                            </tr>
                            <tr height="20">
                                <td  class="fontkink1"><b>Mechanic Comments:</b></td>
                                <td  class="fontkink"><?php echo $row['comments']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><hr /></td>
                            </tr>
                        <?php } ?>
                        <?php
                        $st = 'Delivered';
                        $rt = mysqli_query($connection, "SELECT * FROM service_track WHERE id='$oid'");
                        while ($num = mysqli_fetch_array($rt)) {
                            $currrentSt = $num['status'];
                        }
                        if ($st == $currrentSt) {
                            ?>
                            <tr><td colspan="2"><b>
                                        Product Delivered </b></td>
                            <?php } else {
                                ?>
                            <tr height="50">
                                <td class="fontkink1">Status: </td>
                                <td  class="fontkink"><span class="fontkink1" >
                                        <select name="status" class="fontkink" required="required" >
                                            <option value="">Select Status</option>
                                            <option value="in Process">In Process</option>
                                            <option value="finished">finished</option>
                                            <option value="stopped">Stopped</option>
                                        </select>
                                    </span></td>
                            </tr>
                            <tr style=''>
                                <td class="fontkink1" >Remark:</td>
                                <td class="fontkink" align="justify" ><span class="fontkink">
                                        <textarea cols="50" rows="7" name="remark"  required="required" ></textarea>
                                    </span></td>
                            </tr>
                            <tr>
                                <td class="fontkink1">&nbsp;</td>
                                <td  >&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="fontkink"></td>
                                <td  class="fontkink"> <input type="submit" name="submit2"  value="update"   size="40" style="cursor: pointer;" /> &nbsp;&nbsp;   
                                    <input name="Submit2" type="submit" class="txtbox4" value="Close this Window " onClick="return f2();" style="cursor: pointer;"/></td>
                            </tr>
                        <?php } ?>
                        </table>
                </form>
            </div>
        </body>
    </html>
<?php } ?>

