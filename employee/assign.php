<?php

include './includes/conn.php';
session_start();

if (isset($_POST['assign'])) {

    $m = $_POST['mech'];
    $v = $_POST['vehicle'];
    
    $sql = "INSERT INTO mechanicallocation (vehicle_id, mechanic_id) VALUES ('$v', '$m') ";
    $result = mysqli_query($connection, $sql);
    if($result){
         echo '<script src="../alertjs/all.js"></script>       
        <script>
            alertify.logPosition("top right");                        
            alertify.success("mechanic has been Assigned successfully");               
        </script>';
         $assign = "UPDATE employee SET assigned = '1' WHERE employee_i = '$m'";
         $execute = mysqli_query($connection, $assign);
    }
    
}
?>