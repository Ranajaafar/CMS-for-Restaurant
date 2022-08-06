<?php
$servername="localhost";
$username="phpAdmin";
$pass="ADMIN_1234";
$dbname="tavola";
$connect=mysqli_connect($servername,$username,$pass,$dbname);
if(mysqli_connect_errno($connect)){
	echo "error";
exit;}
?>