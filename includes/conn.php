<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'manja';
$connection = mysqli_connect($host, $user, $password,$database)
        or die("failed to connect to database");
if (!$connection) {
    die('Could not connect: ' . mysql_error());
}
?> 
