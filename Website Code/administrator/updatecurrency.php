<html>
<head><title>Update</title>
<link rel="stylesheet" href="css/Astyle5.css">

</head>
<body>

<?php
include("include\Connecting.php");
session_start();
if(!(isset($_SESSION['Sname']))){
header('location:login.php');}

if(isset($_POST['update_currency'])){
	
	
	$name=trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
	$sym=trim(filter_var($_POST["symbole"], FILTER_SANITIZE_STRING ));
	$equal=floatval($_POST["equal"]);
	$oldname=$_POST["oldname"];
	$oldsym=$_POST["oldsym"];
    if( $name != $oldname ){
		/*if the old name has change ,check if already exist the new one*/
		
	  $select_product_name=mysqli_query($connect,"SELECT name FROM `currency` WHERE name='$name'") or die('query failed');
	  if(mysqli_num_rows($select_product_name)>0){
		  $_SESSION["message"]='name already exist!';
	      echo ' <script>    window.history.back(); </script>';	
		  exit;
      }
	}
    if(	$sym!=$oldsym ){
		/*if the symbole has change ,check if already exist the new one*/
		
	  $select_product_name=mysqli_query($connect,"SELECT symbole FROM `currency` WHERE symbole='$sym'") or die('query failed');
	  if(mysqli_num_rows($select_product_name)>0){
		 $_SESSION["message"]='symbol already exist!';
	      echo ' <script>    window.history.back(); </script>';	
		  exit;

      }
	}
 /*update */
 
	$mysql1="UPDATE `currency` SET name='$name', symbole='$sym', equal='$equal'  WHERE name='$oldname';";
    mysqli_query($connect,$mysql1) or die('query failed');
    $_SESSION["message"]='currency updated successfully';
    echo ' <script>    window.history.back(); </script>';	
    exit;
}
/*echo message */

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{	  	
    if($_SESSION["message"] == 'currency updated successfully'){
	  echo '<div class="message"> <span>'.$_SESSION["message"].' </span>
	   </div>';
      $_SESSION["message"]="";
    }else{
		$_SESSION["message1"]=$_SESSION["message"];
		$_SESSION["message"]="";
		echo '<script>window.location.replace(\''.$_SERVER['PHP_SELF'].'?update='.$_GET['update'].'\');</script>';
		exit;
	}
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


?>


<?php
if(isset($_GET['update'])){
	$name=$_GET['update'];
	
	$mysql="SELECT * FROM `currency` WHERE name='$name';";
$select=mysqli_query($connect,$mysql) or die('query failed');
if(mysqli_num_rows($select)>0){
	while($fetch_product=mysqli_fetch_assoc($select)){
	
	?>
	
<!-- put the currency data -->
<section class="updatecurrency">

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" ENCTYPE="multipart/form-data">

<input type="text" class="box"  value="<?php echo $fetch_product['name']; ?>" name="name"/>
<input type="text" class="box"  value="<?php echo $fetch_product['symbole']; ?>" name="symbole"/>
<input type="text" class="box"  value="<?php echo $fetch_product['equal']; ?>" name="equal"/>
<input type="hidden" value="<?php echo $fetch_product['name'];?>" name="oldname" />
<input type="hidden" value="<?php echo $fetch_product['symbole'];?>" name="oldsym" />

<input type="submit" value="save update" style="cursor:pointer;" name="update_currency" class="sub" />
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