<?php
 $dbservername="localhost"; 
 $dbusername="phpUser";
 $dbpassword="USER_1234";
 $dbname="tavola";
 $conn=mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);
 if(mysqli_connect_errno($conn)){  
 echo "errer";
 exit;}
?>