<?php
include('../includes/conn.php');
$get_id = $_GET['id'];
mysqli_query($connection,"delete from service_request where request_id = '$get_id'")or die(mysql_error());
?>
<script>
window.location = 'calendar_of_events.php';
</script>