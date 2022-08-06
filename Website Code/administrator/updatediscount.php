<html>
<head>
  <title>Update</title>
  <link rel="stylesheet" href="css/Astyle4.css">

</head>
<body>

<?php
include("include\Connecting.php");
session_start();
if(!(isset($_SESSION['Sname']))){
header('location:login.php');}

if(isset($_POST['update_discount'])){
	$id=$_POST['update_p_id'];
	$oldcode=$_POST['update_p_code'];
	$discount=trim(filter_var($_POST['discount'], FILTER_SANITIZE_NUMBER_INT ));
	$code=trim(filter_var($_POST["code"], FILTER_SANITIZE_STRING ));
	if($oldcode==$code){
		
	}else{	
		/*if the unicode has change ,check if already exist the new one*/
		
	  $select_product_name=mysqli_query($connect,"SELECT * FROM `discount` WHERE unicode='$code'" ) or die('query failed1');
	  if(mysqli_num_rows($select_product_name)>0){
		$_SESSION["message"]= 'unicode already exist!';
		    echo ' <script>    window.history.back(); </script>';	

		exit;
	  }
		
	}
	/*update */
	
	$mysql1="UPDATE `discount` SET pourcentage='$discount', unicode='$code' WHERE dis_id='$id';";
    mysqli_query($connect,$mysql1) or die('query failed');
    $_SESSION["message"]='Product updated successfully';
    echo ' <script>    window.history.back(); </script>';	
    exit;


}

?>


<?php
/*echo message */

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{	  
	if($_SESSION["message"] == 'unicode already exist!'){
		$_SESSION["message1"]=$_SESSION["message"];
		$_SESSION["message"]="";
		echo '<script>window.location.replace(\''.$_SERVER['PHP_SELF'].'?update='.$_GET['update'].'\');</script>';
		exit;
    }
	echo '<div class="message"> <span>'.$_SESSION["message"].' </span> 
	 </div>';
    $_SESSION["message"]="";

  }
}

if(isset($_SESSION["message1"])) {
  if($_SESSION["message1"]==""){
  }else{
     echo '<div class="message" > <span>'.$_SESSION["message1"].' </span>
	   </div>';
     $_SESSION["message1"]="";
  }
}

if(isset($_GET['update'])){
	$id=$_GET['update'];
	     
$mysql="SELECT * FROM `discount` WHERE dis_id='$id';";
$select=mysqli_query($connect,$mysql) or die('query failed');
if(mysqli_num_rows($select)>0){
	while($fetch_product=mysqli_fetch_assoc($select)){
	
	?>
	
<!--form contain discount data -->

<section class="updateextra">

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" ENCTYPE="multipart/form-data">

<input type="number"  required class="box" value="<?php echo $fetch_product["pourcentage"]; ?>" name="discount" min='1'/>
<input type="text"  required class="box" value="<?php echo $fetch_product["unicode"]; ?>"  name="code" />
<input type="hidden" value="<?php echo $fetch_product['dis_id']; ?>" name="update_p_id" />
<input type="hidden" value="<?php echo $fetch_product['unicode']; ?>" name="update_p_code" />
<input type="submit" value="save update" style="cursor:pointer;" name="update_discount" class="sub" />
<div class="option-btn" onclick="window.history.back();" >GoBack</div>
</form>
</section>
	
	
<?php	
	}
}

}

?>

<?php mysqli_close($connect); ?>
</body>
</html>