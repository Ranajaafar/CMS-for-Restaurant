
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>
<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle6.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<script type="text/javascript">
   
    </script>
	<style>
.sidebar-menu a.active6{
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
include("include\dashboard.php");


/*add offer */

if(isset($_POST['add_offer'])){
	$discount=trim(filter_var($_POST['discount'], FILTER_SANITIZE_NUMBER_INT ));
	
	/*check if already exist the discount */
	
	$select_product_name=mysqli_query($connect,"SELECT * FROM `offer` WHERE discount='$discount'") or die('query failed');
	if(mysqli_num_rows($select_product_name)>0){
		$_SESSION["message"]= 'already exist!';		
	}
	else { 
	/*insert */
	
		$sql="INSERT INTO `offer`(discount) VALUES('$discount');";
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
	 if($_SESSION["message"]=="already exist!"){
		      echo '<div class="message" > <span>'.$_SESSION["message"].' </span> <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor:pointer;"></i></div>';
			  $_SESSION["message"]="";
	 }
	 else{
	   $_SESSION["message1"]=$_SESSION["message"];
       $_SESSION["message"]="";	   
	   header('Location:offers.php');
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

/*delete a discount */

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
		
	$sql="start transaction;";
	$result=mysqli_query($connect,$sql) or die("bad query :$sql");
	
     /*make the discount id null for an item if this item already have this  offer */
	 
    $sql2="UPDATE item SET offer_id=null WHERE offer_id='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed');
 
     /*delete from offer table */
	 
	$sql2="DELETE FROM `offer` WHERE offer_id='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed');
   
   	
	$sql="commit;";
	$result=mysqli_query($connect,$sql) or die("bad query :$sql");
     
    header('location:offers.php');
	$_SESSION["message"]="Deleted succcefully";
    exit;
}
	
?>


<!--Form to add an offer -->

<section class="addoffer">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="Post" ENCTYPE="multipart/form-data">
<h3>New offer</h3>
<input type="number"  required class="box" placeholder="enter the discount" name="discount" min='1'/>
<br/><input type="submit" value="add offer" name="add_offer" style="cursor:pointer;" class="sub" />
</form>
</section>

<!--offer table-->
<table >
<tr><td><h4>Id</h4></td><td><h3>discount</h4></td><td><h4>Actions</h4></td></tr>
<?php
$sql="SELECT * FROM `offer` ORDER by offer_id;";
  $result=mysqli_query($connect,$sql) or die("bad query :$sql");
  while($row=mysqli_fetch_array($result)){
 echo '<tr>';
   echo ' <td><h5>'.$row[0].'</h5></td>';
   echo ' <td><h5>'.$row[1].'</h5></td>';
 
  echo  '<td>
  <a href="javascript:del('.$row[0].')" class="sub"  >delete</a>
  </td>';
  echo '</tr>';}
  ?>
  </table>
  <!-- total offer -->
  
  <div class="total"><h3>
  <?php

  $sql_t="SELECT count(*) as count FROM `offer`;";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;?></h3>
 </div>
  <?php mysqli_close($connect); ?>
</body>
</html>
		