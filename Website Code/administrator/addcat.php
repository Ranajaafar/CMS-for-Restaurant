
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>

<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle3.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

</head>
<body>
<?php
include("include\Connecting.php");
session_start();

if(!(isset($_SESSION['Sname']))){
header('location:login.php');}

/* Add extra for a category in have table */

if(isset($_POST['add_extra'])){
		$eid=$_POST['eid'];
		$cid=$_POST['c_id'];
		$_SESSION["cid"]=$cid;
		/* check if the id  extra not exit*/
		
		   /*insert */
        $sql_insert="INSERT INTO `have`(id_extra,cat_id) VALUES ('$eid','$cid');";
	    $insert_excat=mysqli_query($connect,$sql_insert)or die('query failed');
	    $_SESSION["message"]='Product added successfully';
			
	
	   echo ' <script>    window.history.back(); </script>';	
       exit;
}

	
	
?>
<?php

 /*delete an extra for a category from table have */
 
if(isset($_GET['delete1']) && isset($_GET['delete2'])){
	
	$eid=$_GET['delete1'];
	$cid=$_GET['delete2'];
	//header('location:Extra.php');

	$sql2="DELETE FROM `have` WHERE id_extra='$eid' AND cat_id='$cid';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed');
      $_SESSION["message"]='deleted successfully';
	  	   echo ' <script>    window.history.back(); </script>';	
      exit;
}
/*echo message */

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{	  	
		$_SESSION["message1"]=$_SESSION["message"];
		$_SESSION["message"]="";
		echo '<script>window.location.replace(\''.$_SERVER['PHP_SELF'].'?add='.$_SESSION["cid"].'\');</script>';
		exit;
  }
}

if(isset($_SESSION["message1"])) {
  if($_SESSION["message1"]==""){
  }else{
     echo '<div class="message" > <span>'.$_SESSION["message1"].' </span>
	  <i class="fas fa-times" style="cursor:pointer;" onclick="this.parentElement.remove();"></i></div>';
     $_SESSION["message1"]="";
  }
}


?>

<?php 
if(isset($_GET['add'])){
	$cid=$_GET['add'];?>
	
	<!-- FORM TO ADD EXTRA -->
	
<section class="add">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="Post" ENCTYPE="multipart/form-data">
<h3>the Extra correspondent</h3>

<select name="eid" class="box">
<?php 
$sqlcu="SELECT * FROM `extra` where id_extra NOT IN (select e.id_extra from extra e,have h where e.id_extra=h.id_extra and h.cat_id=".$cid.");";
  $resultc=mysqli_query($connect,$sqlcu) or die("bad query ");
  while($rowc=mysqli_fetch_array($resultc)){
	  ?>
<option value="<?php echo $rowc[0];?>"><?php echo $rowc[1]; ?></option>
  <?php } ?>
</select>
<input type="hidden" value="<?php echo $cid; ?>" name="c_id" />
<input type="submit" value="Add" name="add_extra" style="cursor:pointer;" class="sub1" />
<div class="option-btn" onclick="window.history.back();" >GoBack</div>
</form>
</section>

<!-- Have Table -->

<table >
<tr><td><h4>extraID</h4></td><td><h4>extra name</h4></td><td><h4>Actions</h4></td></tr>
<?php
$sql="SELECT * FROM `have` WHERE cat_id='$cid';";
  $result=mysqli_query($connect,$sql) or die("bad query");
  while($row=mysqli_fetch_array($result)){
 echo '<tr>';
 
   echo ' <td><h5>'.$row[0].'</h5></td>';
   $sql1="SELECT name FROM `extra` WHERE id_extra='$row[0]';";
  $result1=mysqli_query($connect,$sql1) or die("bad query");
  
  $fetch=mysqli_fetch_assoc($result1);
  $name=$fetch['name'];
  echo '<td><h5>'.$name.'</h5></td>';
 echo  '<td>
  <a href="addcat.php?add='.$cid.'&delete1='.$row[0].'&delete2='.$row[1].'" class="sub"  >delete</a></td>';
  echo '</tr>';}
} ?>
  </table>
  
  <!-- Total -->
  
   <div class="total"><h3>
  <?php
if(isset($_GET['add'])){
	$cid=$_GET['add'];
  $sql_t="SELECT count(*) as count FROM `have` WHERE cat_id='$cid';";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
echo 'Total: ' .$Total;}?></h3>
 </div>
 
 <?php mysqli_close($connect); ?>
</body>
</html>