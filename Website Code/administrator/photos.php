

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>
<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle3.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<script src="js/Ascript.js"></script>
</head>
<body>
<?php
include("include\Connecting.php");
session_start();

if(!(isset($_SESSION['Sname']))){
header('location:login.php');}
$dir="..\user\uploads";

/*add photos for an item */

if(isset($_POST['add_category'])){
	$pid=$_POST['p_id'];
	  $_SESSION["photo"]=$pid;
	
	$image=$_FILES["image"]["name"];
	$image_size=$_FILES['image']['size'];
	$image_tmp_name=$_FILES['image']['tmp_name'];
	 $image_folter=$dir."/".$image; 
	 if(isset($image)){
		 
		 /*if already exist for a category */
		 
		  $sql="SELECT * FROM `category` WHERE cat_photo='$image';";
 $select=mysqli_query($connect,$sql) or die('query failed');
	 if(mysqli_num_rows($select)>0){
		
		$_SESSION["message"]='image already exist for a category!';
	 }
	 else{
		 
		 /*if already exist in photo table */
		 
	$select_product_name=mysqli_query($connect,"SELECT photo_path FROM `photo` WHERE photo_path='$image'") or die('query failed');
	if(mysqli_num_rows($select_product_name)>0){
		$_SESSION["message"]= 'image already exist!';
		
		}
	else {
		/*insert photo */
		$sql="INSERT INTO `photo`(photo_path,pid) VALUES('$image','$pid');";
		$insert_product=mysqli_query($connect,$sql)or die('query failed');
     
	  if($insert_product){
		     if($image_size>2000000){
			       $_SESSION["message"]='image size is too large!';}
				   /*to upload folder */
			 else {
				 if(is_uploaded_file($_FILES['image']['tmp_name']))
				     { move_uploaded_file($_FILES['image']['tmp_name'],$dir.'/'.$_FILES['image']['name']);
					      $_SESSION["message"]='Product added successfully';
						  }
						 
						 
						 }
}}}}
echo ' <script>window.history.back(); </script>';	
    exit;
}



/*delete photo */

$dir="..\user\uploads";
if(isset($_GET['delete'])){
	$id=$_GET['delete'];

	
	/*unlink it from upload folder */
	
	$mysql="SELECT photo_path FROM `photo` WHERE id_photo='$id';";
	$select_delete_image=mysqli_query($connect,$mysql) or die('query failed');
	$fetch_delete_image=mysqli_fetch_assoc($select_delete_image);
	unlink($dir.'/'.$fetch_delete_image['photo_path']);
	

	/*delete it from photo table */
	
	$sql2="DELETE FROM `photo` WHERE id_photo='$id';";
$select_product_name=mysqli_query($connect,$sql2) or die('query failed');


$_SESSION["message"]="Deleted successfully";

}

/*echo message */

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{	  	
    if($_SESSION["message"] == 'image already exist for a category!'){
	  echo '<div class="message"> <span>'.$_SESSION["message"].' </span>
	   <i class="fas fa-times" style="cursor:pointer;" onclick="this.parentElement.remove();"></i></div>';
      $_SESSION["message"]="";
    }else{
		$_SESSION["message1"]=$_SESSION["message"];
		$_SESSION["message"]="";
		echo '<script>window.location.replace(\''.$_SERVER['PHP_SELF'].'?photo='.$_SESSION["photo"].'\');</script>';
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


<!--Form to add photo -->
<?php
if(isset($_GET['photo'])){
	$pid=$_GET['photo'];?>
<section class="add">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="Post" ENCTYPE="multipart/form-data">
<h3>New image</h3>
<input type="hidden" value="<?php echo $pid; ?>" name="p_id" />
<input type="file" accept=".jpg,.jpeg,.png" required class="box" name="image" title="choose image"/>
<input type="submit" value="Add Image" style="cursor:pointer;" name="add_category" class="sub1" />
<div class="option-btn"  onclick="window.history.back();" >GoBack</div>
</form>
</section>

<!-- photo table -->
<table >
<tr><td><h4>Id</h4></td><td><h3>Image</h4></td><td><h4>PhotoPath </h4></td><td><h4>Actions</h4></td></tr>

 <?php     
$sql="SELECT * FROM `photo` WHERE pid='$pid' ;";
$result=mysqli_query($connect,$sql) or die("bad query");

	while($row=mysqli_fetch_array($result)){
 echo '<tr>';
   echo ' <td><h5>'.$row[0].'</h5></td>';
   echo ' <td><h5>'.$row[1].'</h5></td>';
  echo '<td><img src="..\user\uploads/'.$row[1].'" width="80px" height="80px" alt=""/></td>';
  echo  '<td>
  <a href="javascript:del('.$row[0].')" class="sub"  >delete</a>
  </td>';
echo '</tr>';}}
  ?>
  </table>
  <!--total photo for this item -->
<div class="total"><h3>
  <?php
  if(isset($_GET['photo'])){
  $pid=$_GET['photo'];
  $sql_t="SELECT count(*) as count FROM `photo` WHERE pid='$pid';";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;}?></h3>
 </div>
 
  
<?php mysqli_close($connect); ?>
  
</body>
</html>
		
