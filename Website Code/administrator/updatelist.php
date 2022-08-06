<html>
<head><title>Update</title>
<link rel="stylesheet" href="css/Astyle3.css">

</head>
<body>

<?php
include("include\Connecting.php");
session_start();

if(!(isset($_SESSION['Sname']))){
header('location:login.php');}

$dir="..\user\uploads";
if(isset($_POST['update_list'])){
	$id=$_POST['update_p_id'];
	$name=trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
	$oldname=$_POST['update_p_name'];
	$oldcat=$_POST['update_p_cat'];
    $cid=trim(filter_var($_POST["cat_id"], FILTER_SANITIZE_NUMBER_INT ));	
    $details=trim(filter_var($_POST["details"], FILTER_SANITIZE_STRING ));


	if($name!=$oldname || $oldcat!=$cid){
	
		/*if the old name and category has change ,check if already exist the new one*/
		
	
	 $sp="SELECT * FROM `item` WHERE pname='$name' AND cat_id='$cid';"; 
	$select_product_name=mysqli_query($connect,$sp) or die('query failed');
	  if(mysqli_num_rows($select_product_name)>0){
       $_SESSION["message"]= 'item already exist!';
	  }}
   /*currency to dollar */
   
if($_POST["Currency"]!='dollar'){
	$c=$_POST["Currency"];
	$sql_c="SELECT equal FROM `currency` where name='$c';";
	$checkcu=mysqli_query($connect,$sql_c) or die('query failed');
	$fetch_c=mysqli_fetch_array($checkcu);
	$equal=$fetch_c[0];
$price=floatval($_POST["price"]);
$price/=$equal;
}
else {$price=floatval($_POST["price"]);}
 $price=number_format($price,2);
     if($_POST["offer"]!=0){
		 $oid=trim(filter_var($_POST["offer"],FILTER_SANITIZE_NUMBER_INT ));
		 /*check offer id */
		 
		 $sql_cid="SELECT * FROM `offer` WHERE offer_id='$oid';";
        $checkid=mysqli_query($connect,$sql_cid) or die('query failed');
        if(mysqli_num_rows($checkid)==0) {
        $_SESSION["message"]='wrong offer id or this offer not exist!';}
	  else{
		  /*update with offer id */
		  
      $sql="UPDATE `item` SET pname='$name', description='$details', price='$price',cat_id='$cid' ,offer_id='$oid' WHERE pid='$id';";
	 $insert_product=mysqli_query($connect,$sql)or die('query failed');
	  $_SESSION["message"]='Product updated successfully';}}
   else{
	   /*offer id null */
	   
	   $sql="UPDATE `item` SET pname='$name', description='$details', price='$price',cat_id='$cid', offer_id=NULL  WHERE pid='$id';";
   $insert_product1=mysqli_query($connect,$sql)or die('query failed1');
   
$_SESSION["message"]='Product updated successfully';}
 echo ' <script>    window.history.back(); </script>';	
    exit;
}
/*echo message */

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{	  	
    if($_SESSION["message"] == 'item already exist!'){
	  echo '<div class="message"> <span>'.$_SESSION["message"].' </span>
	   <i class="fas fa-times" style="cursor:pointer;" onclick="this.parentElement.remove();"></i></div>';
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
	  <i class="fas fa-times" style="cursor:pointer;" onclick="this.parentElement.remove();"></i></div>';
     $_SESSION["message1"]="";
  }
}


?>

<?php
if(isset($_GET['update'])){
	$id=$_GET['update'];
	
	$mysql="SELECT * FROM `item` WHERE pid='$id';";
$select=mysqli_query($connect,$mysql) or die('query failed');
if(mysqli_num_rows($select)>0){
	while($fetch_product=mysqli_fetch_assoc($select)){
	
	?>
	

<section class="updatelist">

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" ENCTYPE="multipart/form-data">

<input type="text" class="box" required value="<?php echo $fetch_product["pname"];?>" name="name"/>

<select name="cat_id" class="box">
 
 <option value ="<?php echo  $fetch_product['cat_id'];?>">
 <?php
   	  $idcat=$fetch_product["cat_id"];
      $sqlcu2="SELECT cat_name FROM `category` WHERE cat_id ='$idcat';";
      $select2=mysqli_query($connect,$sqlcu2) or die('query failed');
	  $rowc=mysqli_fetch_array($select2);
      echo $rowc[0];
 ?>
 </option><?php 
 $sqlcu2="SELECT * FROM `category` WHERE cat_id !='$idcat';";
 $select2=mysqli_query($connect,$sqlcu2) or die('query failed');
 while($rowc=mysqli_fetch_array($select2)){
	  ?>
	 
  <option value="<?php echo $rowc[0]; ?>"><?php echo $rowc[1]; ?></option>
  <?php } ?>
</select>
<select name="offer" class="box" required>
  <option value="0" > enter offer id</option>
  <?php 
    $sqlcu="SELECT * FROM `offer`;";
    $resultc=mysqli_query($connect,$sqlcu) or die("bad query ");
     while($rowc=mysqli_fetch_array($resultc)){
         if($rowc[0]==$fetch_product["offer_id"]){
			 echo '  <option value="'.$rowc[0].'" selected >'.$rowc[1].'</option> ';
		 }else 
	?>
               <option value="<?php echo $rowc[0];?>"><?php echo $rowc[1]; ?></option>
	
	 <?php  } ?>
</select>

<input type="text" class="box" required value="<?php echo $fetch_product["price"];?>"name="price"/>
<input type="hidden" value="<?php echo $fetch_product['pid']; ?>" name="update_p_id" />
<input type="hidden" value="<?php echo $fetch_product['pname']; ?>" name="update_p_name" />
<input type="hidden" value="<?php echo $fetch_product['cat_id']; ?>" name="update_p_cat" />
<select name="Currency" >
<?php 
$sqlcu="SELECT * FROM `currency`;";
  $resultcu=mysqli_query($connect,$sqlcu) or die("bad query ");
  while($rowcu=mysqli_fetch_array($resultcu)){
	  ?>
<option value="<?php echo $rowcu[0];?>"><?php echo $rowcu[1]; ?></option>
  <?php } ?>
</select>
<textarea name="details" class="box" required placeholder="update item details" cols="30" rows="10"><?php echo $fetch_product["description"]; ?></textarea>
<input type="submit" value="save update" style="cursor:pointer;" name="update_list" class="sub" />
<div class="option-btn"  onclick="window.history.back();" >GoBack</div>
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