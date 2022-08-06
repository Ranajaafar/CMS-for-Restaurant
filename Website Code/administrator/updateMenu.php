<html>
<head><title>Update</title>
<link rel="stylesheet" href="css/Astyle2.css">

</head>
<body>


<?php
include("include\Connecting.php");
session_start();
if(!(isset($_SESSION['Sname']))){
header('location:login.php');}
$dir="..\user\uploads";
if(isset($_POST['update_category'])){
	
	/*update menu*/
	
	$id=$_POST['update_p_id'];
	$oldname=$_POST['update_p_id'];
	$name=trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
	if($oldname!=$name){
		/*if the old name has change ,check if already exist the new one*/
		
	   $select_product_name=mysqli_query($connect,"SELECT cat_name FROM `category` WHERE cat_name='$name'") or die('query failed');
	   if(mysqli_num_rows($select_product_name)>0){
	   $_SESSION["message"]= 'Category already exist!';}
	   
	   else{
		   /*update */
		   
	   $mysql1="UPDATE `category` SET cat_name='$name' WHERE cat_id='$id';";
	   mysqli_query($connect,$mysql1) or die('query failed');
	   $_SESSION["message"]='Product updated successfully';}}
       $image=$_FILES["image"]["name"];
	   $image_size=$_FILES['image']['size'];
	   $image_tmp_name=$_FILES['image']['tmp_name'];
	   $image_folter=$dir."/".$image; 
	   $oldimg=$_POST['update_p_image'];
	   if($image!=$oldimg){
		   /*if the old photo has change ,check if already exist the new one*/
		   
		   $select_product_name=mysqli_query($connect,"SELECT cat_photo FROM `category` WHERE cat_photo='$image'") or die('query failed');
	      if(mysqli_num_rows($select_product_name)>0){
	       $_SESSION["message"]= 'Category photo already exist!';}
		   else{
	 if(!empty($image)){
		if($image_size>2000000){
			       $_SESSION["message"]='image size is too large!';}
			 else {
			 $s="UPDATE `category` SET cat_photo='$image' WHERE cat_id='$id';";
			 /*to upload folder  */
				 mysqli_query($connect,$s) or die('query failed');
				 if(is_uploaded_file($_FILES['image']['tmp_name']))
				     { move_uploaded_file($_FILES['image']['tmp_name'],$dir.'/'.$_FILES['image']['name']);
				           unlink($dir.'/'.$oldimg);
					      $_SESSION["message"]='Product updated successfully';
			 }}
	}}
	
	

}
	 echo ' <script>    window.history.back(); </script>';	
    exit;
}
/*echo message */

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{	  	
    if($_SESSION["message"] == 'Category already exist!'){
	  echo '<div class="message"> <span>'.$_SESSION["message"].' </span>
	   <i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
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
	  <i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
     $_SESSION["message1"]="";
  }
}

?>

<?php
if(isset($_GET['update'])){
	$id=$_GET['update'];
$mysql="SELECT * FROM `category` WHERE cat_id='$id';";
$select=mysqli_query($connect,$mysql) or die('query failed');
if(mysqli_num_rows($select)>0){
	while($fetch_product=mysqli_fetch_assoc($select)){?>
	
	
	<!--Form for category data -->
<section class="updateCategory">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" ENCTYPE="multipart/form-data">

<input type="text" class="box"  value="<?php echo $fetch_product['cat_name']; ?>" name="name"/>
<img src="..\user\uploads/<?php echo $fetch_product['cat_photo']; ?>" class="image" alt="" width="180px" height="200px"/>
<br/><?php echo $fetch_product['cat_photo']; ?>
<input type="hidden" value="<?php echo $fetch_product['cat_photo']; ?>" name="update_p_image" />
<input type="hidden" value="<?php echo $fetch_product['cat_name']; ?>" name="update_p_name" />
<input type="hidden" value="<?php echo $fetch_product['cat_id']; ?>" name="update_p_id" />
<input type="file" accept=".jpg ,.jpeg,.png"  class="box" name="image" title="choose image"/>
<input type="submit" value="save update" name="update_category" class="sub" />
<div class="option-btn" onclick="window.history.back();" >GoBack</div>
</form>
</section>
	
<?php
}}}?>
<?php mysqli_close($connect); ?>

</body>
</html>