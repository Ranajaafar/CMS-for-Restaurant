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
 .sidebar-menu a.active8{
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

/* ADD currency */

if(isset($_POST['add_currency'])){
	$name=trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
	$sym=trim(filter_var($_POST["symbole"], FILTER_SANITIZE_STRING ));
	$equal=floatval($_POST["equal"]);
	
	/*check if the name already exist */
	
	$select_product_name=mysqli_query($connect,"SELECT name FROM `currency` WHERE name='$name'") or die('query failed');
	if(mysqli_num_rows($select_product_name)>0){
		 $_SESSION["message"]='name already exist!';		

	}	
	else {
		/*check if the symbole already exist */
		
		$select_product_name=mysqli_query($connect,"SELECT symbole FROM `currency` WHERE symbole='$sym'") or die('query failed');
	    if(mysqli_num_rows($select_product_name)>0){
		     $_SESSION["message"]='symbol already exist!';
		
        }
		else { 
		
		/*insert */
		
			$sql="INSERT INTO `currency`(name,symbole,equal) VALUES('$name','$sym','$equal');";
		    $insert_product=mysqli_query($connect,$sql)or die('query failed1');
            $_SESSION["message"]='added successfully';
	    }
    }
		     
	echo ' <script> window.history.back(); </script>';	
    exit;
	
}

/*echo message*/

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{
	 if($_SESSION["message"]=="added successfully"){
		  $_SESSION["message1"]=$_SESSION["message"];
          $_SESSION["message"]="";	   
	      header('Location:currency.php');
	      exit; 
	 }
	 else{
	     echo '<div class="message" > <span>'.$_SESSION["message"].' </span>
		 <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor:pointer;"></i></div>';
		 $_SESSION["message"]="";
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
/*Delete currency */

if(isset($_GET['delete'])){
  $name=$_GET['delete'];
  $sql2="DELETE FROM `currency` WHERE name='$name';";
  $select_product_name=mysqli_query($connect,$sql2) or die('query failed');
  
  header('Location:currency.php');
  $_SESSION["message"]="Deleted succcefully";

}

?>

<!-- Form to add currency -->

<section class="addaccount">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="Post" ENCTYPE="multipart/form-data">
<h3>New Currency</h3>
<input type="text" class="box" required placeholder="enter currency name" name="name"/>
<input type="text" class="box" required placeholder="enter currency symbole" name="symbole"/>
<input type="text" class="box" required placeholder="enter currency equivalent to $" name="equal"/>
<br/>
<input type="submit" value="add currency" style="cursor:pointer;" name="add_currency" class="sub" />
</form>
</section>

<!-- Currency table -->

<table >
<td><h4>name</h4></td><td><h4>symbol</h4></td><td><h4>equivalent</h4></td><td><h4>Actions</h4></td></tr>
<?php
 $sql="SELECT * FROM `currency` where name!='dollar' ;";
  $result=mysqli_query($connect,$sql) or die("bad query :$sql");
  while($row=mysqli_fetch_array($result)){
 echo '<tr>';
   echo ' <td><h5>'.$row[0].'</h5></td>';
   echo ' <td><h5>'.$row[1].'</h5></td>';
  echo ' <td><h5>'.$row[2].'</h5></td>';
  
  echo  '<td><a href="updatecurrency.php?update='.$row[0].'" class="sub">update</a>
  <a href="javascript:del(\''.$row[0].'\')" class="sub"  >delete</a></td>';
  echo '</tr>';}
  ?>
  </table>
  
  <!-- currency total nb-->
  
  <div class="total"><h3>
  <?php

  $sql_t="SELECT count(*) as count FROM `currency` where name!='dollar';";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;?></h3>
 </div>
 
 <?php mysqli_close($connect); ?>
 
</body>
</html>