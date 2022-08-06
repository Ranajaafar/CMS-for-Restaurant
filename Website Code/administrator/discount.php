
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>
<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle4.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<script type="text/javascript">
   
</script>
<style>
  .sidebar-menu a.active7{
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
//session_start();

/* Add discount */

if(isset($_POST['add_dis'])){
	$discount=trim(filter_var($_POST['discount'], FILTER_SANITIZE_NUMBER_INT ));
	$code=trim(filter_var($_POST["code"], FILTER_SANITIZE_STRING ));
	
	/* check if th unicode already exist */
	
	$select_product_name=mysqli_query($connect,"SELECT * FROM `discount` WHERE unicode='$code'") or die('query failed1');
	if(mysqli_num_rows($select_product_name)>0){
            $_SESSION["message"]= 'unicode already exist!';		
    }
	else {
		/* insert */
		
		$sql="INSERT INTO `discount`(pourcentage,unicode) VALUES('$discount','$code');";
		$insert_product=mysqli_query($connect,$sql)or die('query failed');
        $_SESSION["message"]= 'added successfully!';		
			 
    }
	     
	echo ' <script> window.history.back(); </script>';	
    exit;
	
}
/*echo message */


if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{
	 if($_SESSION["message"]=="unicode already exist!"){
		      echo '<div class="message" > <span>'.$_SESSION["message"].' </span> <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor:pointer;"></i></div>';
			  $_SESSION["message"]="";
	 }
	 else{
	   $_SESSION["message1"]=$_SESSION["message"];
       $_SESSION["message"]="";	   
	   header('Location:discount.php');
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
 
 /*delete discount */
 
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	
	$sql="start transaction;";
	$result=mysqli_query($connect,$sql) or die("bad query :$sql");
     
	 /* update discount id to null in order table */
	 
	$sql2="UPDATE order_info SET dis_id=null WHERE dis_id='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed');
	
     /*delete from table discount */
	 
	$sql2="DELETE FROM `discount` WHERE dis_id='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed');
	
	 $sql="commit;";
	 $result=mysqli_query($connect,$sql) or die("bad query :$sql");
	 
    header('Location:discount.php');
	$_SESSION["message"]="Deleted succcefully";
	exit;
     
}
	
?>

<!-- FORM to add discount -->

<section class="addExtra">
<form action="" method="Post" ENCTYPE="multipart/form-data">
<h3>New discount</h3>
<input type="number"  required class="box" placeholder="enter the discount" name="discount" min='1'/>
<input type="text"  required class="box" placeholder="enter the unicode" name="code" />
<input type="submit" value="add discount" style="cursor:pointer;" name="add_dis" class="sub" />
</form>
</section>

<!--discount table -->

<table >
<tr><td><h4>Id</h4></td><td><h3>discount</h4></td><td><h4>Unicode</h4></td><td><h4>Actions</h4></td></tr>
<?php
$sql="SELECT * FROM `discount` ORDER by dis_id;";
  $result=mysqli_query($connect,$sql) or die("bad query :$sql");
  while($row=mysqli_fetch_array($result)){
 echo '<tr>';
   echo ' <td><h5>'.$row[0].'</h5></td>';
   echo ' <td><h5>'.$row[1].'</h5></td>';
    echo ' <td><h5>'.$row[2].'</h5></td>';
  echo  '<td><a href="updatediscount.php?update='.$row[0].'" class="sub">update</a>
  <a href="javascript:del('.$row[0].')" class="sub"  >delete</a>
  </td>';
  echo '</tr>';}
  ?>
  </table>
  <!--discount total -->
  <div class="total"><h3>
  <?php

  $sql_t="SELECT count(*) as count FROM `discount`;";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;?></h3>
 </div>
  <?php mysqli_close($connect); ?>
</body>
</html>
		