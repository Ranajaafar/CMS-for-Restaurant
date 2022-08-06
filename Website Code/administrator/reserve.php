<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>

<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle7.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
.sidebar-menu a.active10{
	background:#fff;
	padding-top:1rem;
	padding-bottom:1rem;
	color:var(--main-color);
	border-radius:30px 0px 0px 30px;

}
</style>
</head>
<body>
<?php
require("include\dashboard.php");


/* echo message */

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{
	 if($_SESSION["message"]=="Deleted succcefully"){
		      echo '<div class="message" > <span>'.$_SESSION["message"].' </span>
			  <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor:pointer;"></i></div>';
			  $_SESSION["message"]="";
	 }
	 else{
	   $_SESSION["message1"]=$_SESSION["message"];
       $_SESSION["message"]="";	   
	   header('Location:reserve.php');
	   exit;
	 }

    
 		 
  }
}
if(isset($_SESSION["message1"])) {
  if($_SESSION["message1"]==""){
  }else{
     echo '<div class="message" > <span>'.$_SESSION["message1"].' </span>
	 <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor:pointer;"></i></div>';
     $_SESSION["message1"]="";
  }
}
 

 
?>
<?php
/* delete reservation */

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	
	header('location:reserve.php');

	$sql2="DELETE FROM `reservation` WHERE Rid='$id';";
$select_item_name=mysqli_query($connect,$sql2) or die('query failed');
$_SESSION["message"]="Deleted succcefully";

}?>



<!-- reservation table -->

<div style="overflow-x:auto;">
<table>
<tr>
<td><h4>ReservationID</h4></td><td><h4>Firstname</h4></td><td><h4>Lastname</h4></td><td><h4>Phone number</h4></td><td><h4>Guest number</h4></td><td><h4>Date</h4></td><td><h4>Time</h4></td>
<td><h4>Actions</h4></td></tr>
<?php
$date=date("Y-m-d");

$sql="SELECT * FROM `reservation` ORDER by Rdate;";
$result=mysqli_query($connect ,$sql) or die( 'query failed ');
      if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_array($result)){?>
         <tr>
        <td><h5><?php echo $row[0]; ?></h5></td>
       <td><h5><?php echo $row[1]; ?></h5></td>
        <td><h5><?php echo $row[2]; ?></h5></td>
	     <td><h5><?php echo $row[3]; ?></h5></td>
		  <td><h5><?php echo $row[4]; ?></h5></td>
		   <td><h5><?php echo $row[5]; ?></h5></td>
		   <td><h5><?php echo $row[6]; ?></h5></td>
		   <!-- for delete -->
           <td>
		   
  <a href="javascript:del('<?php echo $row[0]; ?>')" class="sub"  >delete</a>
  </td>
  

	  </tr><?php }}
  ?>
	  </table></div>
	  
	  <!-- total reservation  number  --> 
	  
<div class="total"><h3>
  <?php
  $sql_t="SELECT count(*) as count FROM `reservation`;";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;?></h3>
 </div> 
 
 <!-- total number of reservation for a specific Date-->
 
 <div class="total2"><h3>Get total number of reservation for a specific Date</h3></div>
 <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="Post" ENCTYPE="multipart/from-data">
 <input type="date" class="box2"   name="ad" min="0" />
 
 <input type="submit" value="Get total" name="go" class="sub2" />
 <div class="total"><h3> <?php
  if(isset($_POST["ad"]) && isset($_POST["go"])){
	  $address=trim(filter_var($_POST["ad"], FILTER_SANITIZE_STRING));
  $sql_c="SELECT count(*)as countA FROM `reservation` WHERE Rdate='$address';";
  $total1=mysqli_query($connect,$sql_c) or die("bad query ");
$rowc=mysqli_fetch_assoc($total1);
  $cTotal=$rowc["countA"];
 $_SESSION["total"]="Total: ";
  $_SESSION["value"]="$cTotal";
  
    echo ' <script> window.history.back(); </script>';	
    exit;
}


/* echo message */

if(isset($_SESSION["total"]) && isset($_SESSION["value"])) {
  if($_SESSION["total"]==""){
  }else{
	 if($_SESSION["total"]=="Total: "){
		   echo $_SESSION["total"].$_SESSION["value"];
			  $_SESSION["total"]="";
			  $_SESSION["value"]="";
			   
}}}
  ?></h3>
 </div>
 
 <!-- total number of reservation  for a specific Time -->
 
 <div class="total2"><h3>Get total number of reservation in  a specific Time</h3></div>
 <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="Post" ENCTYPE="multipart/from-data">
 <select name="time" class="box2">
    
    <option value="13">1:00 PM</option>
    <option value="14">2:00 PM</option>
    <option value="15">3:00 PM</option>
    <option value="16">4:00 PM</option>
    <option value="17">5:00 PM</option>
    <option value="18">6:00 PM</option>
    <option value="19">7:00 PM</option>
    <option value="20">8:00 PM</option>
    <option value="21">9:00 PM</option>
	<option value="22">10:00 PM</option>
	<option value="23">11:00 PM</option>
	
  </select>
 
 <input type="submit" value="Get total" name="go2" class="sub2" />
 <div class="total"><h3> <?php
  if(isset($_POST["time"]) && isset($_POST["go2"])){
	  $date=$_POST['time'];
  $sql_c="SELECT count(*)as countd FROM `reservation` WHERE time='$date';";
  $total1=mysqli_query($connect,$sql_c) or die("bad query ");
$rowc=mysqli_fetch_assoc($total1);
  $cTotal=$rowc["countd"];
  $_SESSION["total1"]="Total: ";
  $_SESSION["value"]="$cTotal";
  
    echo ' <script> window.history.back(); </script>';	
    exit;
}


/* echo message */

if(isset($_SESSION["total1"]) && isset($_SESSION["value"])) {
  if($_SESSION["total1"]==""){
  }else{
	 if($_SESSION["total1"]=="Total: "){
		   echo $_SESSION["total1"].$_SESSION["value"];
			  $_SESSION["total1"]="";
			  $_SESSION["value"]="";
			   
}}}
  ?></h3>
 </div>
 
<?php mysqli_close($connect); ?>
 

</body>
</html>