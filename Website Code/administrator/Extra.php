<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>

<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle4.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
 .sidebar-menu a.active3{
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

if(isset($_POST['add_extra'])){
	$name=trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
	$select_product_name=mysqli_query($connect,"SELECT name FROM `extra` WHERE name='$name'") or die('query failed');
	if(mysqli_num_rows($select_product_name)>0){
	    $_SESSION["message"]="name already exist!";
    }
    else{
	  if($_POST["Currency"]!='dollar'){
	    $c=$_POST["Currency"];
	    $c=trim(filter_var($c, FILTER_SANITIZE_STRING));
	    $sql_c="SELECT equal FROM `currency` where name='$c';";
	    $checkcu=mysqli_query($connect,$sql_c) or die('query failed');
	    $fetch_c=mysqli_fetch_array($checkcu);
	    $equal=$fetch_c[0];
        $price=floatval($_POST["price"]);
        $price/=$equal;
     }
     else {$price=floatval($_POST["price"]);}
	$price=number_format($price,2);
	$sql="INSERT INTO `extra`(name,price) VALUES('$name','$price');";
	$insert_product=mysqli_query($connect,$sql)or die('query failed');
    $_SESSION["message"]="Extra added successfully";

  }
  	     
	echo ' <script> window.history.back(); </script>';	
    exit;
	
}


if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{
	 if($_SESSION["message"]=="name already exist!"){
		      echo '<div class="message" > <span>'.$_SESSION["message"].' </span> <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor:pointer;"></i></div>';
			  $_SESSION["message"]="";
	 }
	 else{
	   $_SESSION["message1"]=$_SESSION["message"];
       $_SESSION["message"]="";	   
	   header('Location:Extra.php');
	  
	   exit;
	 } 
  }
}
if(isset($_SESSION["message1"])) {
  if($_SESSION["message1"]==""){
  }else{
	 echo '<div class="message" > <span>'.$_SESSION["message1"].' </span> <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor:pointer;"></i></div>';
     $_SESSION["message1"]="";
  }
}
?>
<?php

if(isset($_GET['delete'])){
	
	$id=$_GET['delete'];
		
	$sql="start transaction;";
	$result=mysqli_query($connect,$sql) or die("bad query :$sql");
	
    $sql2="DELETE FROM `contain` WHERE extra_id='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed1');
	
    $sql2="DELETE FROM `have` WHERE id_extra='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed2');
	
	$sql2="DELETE FROM `extra` WHERE id_extra='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed2');
		
	$sql="commit;";
	$result=mysqli_query($connect,$sql) or die("bad query :$sql");
	
	
    header('location:Extra.php');
	 $_SESSION["message"]="Deleted succcefully";
    exit;
}


	
?>
<!--Form to add extra -->
<section class="addExtra">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="Post" ENCTYPE="multipart/form-data">
<h3>New Extra</h3>
<input type="text" class="box" required placeholder="enter extra name" name="name"/>
<input type="text" class="box1" required placeholder="enter extra price" name="price"/>
<select name="Currency" id="curr">
<?php 
$sqlcu="SELECT * FROM `currency`;";
  $resultcu=mysqli_query($connect,$sqlcu) or die("bad query ");
  while($rowcu=mysqli_fetch_array($resultcu)){
	  ?>
<option value="<?php echo $rowcu[0];?>"><?php echo $rowcu[1]; ?></option>
  <?php } ?>
</select>

<input type="submit" value="add extra" style="cursor:pointer;" name="add_extra" class="sub" />
</form>
</section>

<!--extra table -->

<table >
<tr><td><h4>Id</h4></td><td><h4>name</h4></td><td><h4>Price</h4></td><td><h4>Actions</h4></td></tr>
<?php
$sql="SELECT * FROM `extra` WHERE id_extra> 1 ORDER by id_extra;";
  $result=mysqli_query($connect,$sql) or die("bad query");
  while($row=mysqli_fetch_array($result)){
 echo '<tr>';
   echo ' <td><h5>'.$row[0].'</h5></td>';
   echo ' <td><h5>'.$row[1].'</h5></td>';
  echo ' <td><h5>'.$row[2].'</h5></td>';
 
  echo  '<td><a href="updateextra.php?update='.$row[0].'" class="sub">update</a>
  <a href="javascript:del('.$row[0].')" class="sub"  >delete</a></td>';
  echo '</tr>';}
  ?>
  </table>
  
   <!--total extra -->
   
   <div class="total"><h3>
  <?php

  $sql_t="SELECT count(*) as count FROM `extra` WHERE id_extra > 1;";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;?></h3>
 </div>
 <?php mysqli_close($connect); ?>
</body>
</html>



