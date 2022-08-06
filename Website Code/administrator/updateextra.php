<html>
<head><title>Update</title>
<link rel="stylesheet" href="css/Astyle4.css">

</head>
<body>

<?php
include("include\Connecting.php");

session_start();

if(!(isset($_SESSION['Sname']))){
header('location:login.php');}

if(isset($_POST['update_category'])){
	$id=$_POST["update_p_id"];
	$oldname=$_POST["update_p_name"];
	$name=trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
	if($oldname!=$name){
		
		//*if the old name has change ,check if already exist the new one*/
		
		$select_product_name=mysqli_query($connect,"SELECT name FROM `extra` WHERE name='$name'") or die('query failed');
	    if(mysqli_num_rows($select_product_name)>0){
		    $_SESSION["message"]= 'name already exist!';
		    echo ' <script>    window.history.back(); </script>';	
		    exit;
	    }
	}
	/*currency to dollar */
	
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
	/*update */
	
	$mysql1="UPDATE `extra` SET name='$name' , price=$price WHERE id_extra='$id';";
    mysqli_query($connect,$mysql1) or die('query failed');
	$_SESSION["message"]='extra updated successfully';
	    echo ' <script>    window.history.back(); </script>';	
    exit;

}

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{	  
	if($_SESSION["message"] == 'name already exist!'){
		$_SESSION["message1"]=$_SESSION["message"];
		$_SESSION["message"]="";
		echo '<script>window.location.replace(\''.$_SERVER['PHP_SELF'].'?update='.$_GET['update'].'\');</script>';
		exit;
    }
	echo '<div class="message"> <span>'.$_SESSION["message"].' </span> </div>';
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
?>


<?php
if(isset($_GET['update'])){
	$id=$_GET['update'];
$mysql="SELECT * FROM `extra` WHERE id_extra='$id';";
$select=mysqli_query($connect,$mysql) or die('query failed');
if(mysqli_num_rows($select)>0){
	while($fetch_product=mysqli_fetch_assoc($select)){?>
	
	
	<!-- Form contain extra data -->
<section class="updateextra">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" ENCTYPE="multipart/form-data">
<input type="text" class="box" required value="<?php echo $fetch_product["name"]; ?>" name="name"/>
<input type="text" class="box" required value="<?php echo $fetch_product["price"]; ?>" name="price"/>
<select name="Currency" id="curr">
<?php 
$sqlcu="SELECT * FROM `currency`;";
  $resultcu=mysqli_query($connect,$sqlcu) or die("bad query ");
  while($rowcu=mysqli_fetch_array($resultcu)){
	  ?>
<option value="<?php echo $rowcu[0];?>"><?php echo $rowcu[1]; ?></option>
  <?php } ?>
</select>
<input type="hidden" value="<?php echo $fetch_product['id_extra']; ?>" name="update_p_id" />
<input type="hidden" value="<?php echo $fetch_product['name']; ?>" name="update_p_name" />
<input type="submit" value="save update" style="cursor:pointer;" name="update_category" class="sub" />
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