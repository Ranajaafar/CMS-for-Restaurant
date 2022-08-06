<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>

<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle5.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
 .sidebar-menu a.active9{
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

/* ADD admin the superadmin can add only admins and the admin can'tsee this page */

if(isset($_POST['add_admin'])){
	
	/* Method Post */
	
	$name=trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
	$pass=$_POST["pass"];
	
	/*  check if the username already exist */
	
	$select_product_name=mysqli_query($connect,"SELECT username FROM `admin` WHERE username='$name'") or die('query failed');
if(mysqli_num_rows($select_product_name)>0){
		 $_SESSION["message"]='username already exist!';		
	}
	else { 
	      /*insert */
	
		$sql="INSERT INTO `admin`(username,password,type) VALUES('$name','$pass','admin');";
		$insert_product=mysqli_query($connect,$sql)or die('query failed');
        $_SESSION["message"]='admin added successfully';
	 }
	echo ' <script> window.history.back(); </script>';	
    exit;
	
}

/* echo message */ 

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{
	 if($_SESSION["message"]=="admin added successfully"){
		  $_SESSION["message1"]=$_SESSION["message"];
          $_SESSION["message"]="";	   
	      header('Location:Adacc.php');
	      exit; 
	 }
	 else{
	     echo '<div class="message" > <span>'.$_SESSION["message"].' </span><i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor:pointer;"></i></div>';
		 $_SESSION["message"]="";
	 } 
  }
}
if(isset($_SESSION["message1"])) {
  if($_SESSION["message1"]==""){
  }else{
     echo '<div class="message" > <span>'.$_SESSION["message1"].' </span><i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor:pointer;"></i></div>';
     $_SESSION["message1"]="";
  }
}





?>
<?php

 /* Delete an admin */
 
if(isset($_GET['delete'])){
	
	$id=$_GET['delete'];

	$sql2="DELETE FROM `admin` WHERE adminid='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed');
	
	header('location:Adacc.php');
	$_SESSION["message"]="Deleted succcefully";

}


	
?>


<!--FORM to  add admin  -->

<section class="addaccount">
<form action="" method="Post" ENCTYPE="multipart/form-data">
<h3>New Admin</h3>
<input type="text" class="box" required placeholder="enter admin username" name="name"/><br/>
<input type="password" class="box" required placeholder="enter admin password" name="pass"/>
<br/>
<input type="submit" value="add admin" style="cursor:pointer;" name="add_admin" class="sub" />
</form>
</section>

<!--  admin  Table and the password in the table invisible -->

<table >
<tr><td><h4>Id</h4></td><td><h4>name</h4></td><td><h4>password</h4></td><td><h4>type</h4></td><td><h4>Actions</h4></td></tr>
<?php
$sql="SELECT * FROM `admin` ORDER by adminid;";
  $result=mysqli_query($connect,$sql) or die("bad query :$sql");
  while($row=mysqli_fetch_array($result)){
   echo '<tr>';
    echo ' <td><h5>'.$row[0].'</h5></td>';
    echo ' <td><h5>'.$row[1].'</h5></td>';
	if($_SESSION['TSadmin'] == 'superAdmin' ){
      echo  '<td></td>';
	}else
       echo ' <td><h5>'.$row[2].'</h5></td>';
    echo ' <td><h5>'.$row[3].'</h5></td>';
    if($row[3]!='superAdmin'){
       echo  '<td>
      <a href="javascript:del('.$row[0].')" class="sub"  >delete</a></td>';
    }
	echo '</tr>';
  }
  ?>
  </table>
  
   <!-- admin total --> 
   
  <div class="total"><h3>
  <?php

  $sql_t="SELECT count(*) as count FROM `admin`;";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;?></h3>
 </div>
 <?php mysqli_close($connect); ?>
</body>
</html>