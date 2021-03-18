<?php 
$server = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'library';
$connect = mysqli_connect($server, $username, $password, $dbname);
mysqli_select_db($connect,$dbname);
?>