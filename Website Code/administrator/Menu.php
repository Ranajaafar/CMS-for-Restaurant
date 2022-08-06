
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>
<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle2.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<script type="text/javascript"></script>
<style>
.sidebar-menu a.active1{
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

/* Add a new category to table category */


require("include\dashboard.php");


$dir="..\user\uploads";
if(isset($_POST['add_category'])){
	
	 /* using method post to  fill category table */
	
	$name=trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
	$image=$_FILES["image"]["name"];
	$image_size=$_FILES['image']['size'];
	$image_tmp_name=$_FILES['image']['tmp_name'];
	 $image_folter=$dir."/".$image; 
	 
	 if(isset($image)){
		 
		 /*check if category already exist */
		 
	$select_product_name=mysqli_query($connect,"SELECT cat_name FROM `category` WHERE cat_name='$name' OR cat_photo='$image'") or die('query failed');
	if(mysqli_num_rows($select_product_name)>0){
		$_SESSION["message"]= 'Category name or image already exist!';
		
		}
	else {
		/*insert */
		
		$sql="INSERT INTO `category`(cat_name,cat_photo) VALUES('$name','$image');";
		$insert_product=mysqli_query($connect,$sql)or die('query failed');
     
	  if($insert_product){
		  
		  /*check size of image*/
		  
		     if($image_size>2000000){
			       $_SESSION["message"]='image size is too large!';}
			 else {
				 /* move image to file upload */
				 if(is_uploaded_file($_FILES['image']['tmp_name']))
				     { move_uploaded_file($_FILES['image']['tmp_name'],$dir.'/'.$_FILES['image']['name']);
					      $_SESSION["message"]='Category added successfully';
						  }
						 
						 
						 }
	 }}}
	 
	 /* back to the previous page */
	 
	 echo ' <script> window.history.back(); </script>';	
    exit;
}

/* echo message */

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{
	 if($_SESSION["message"]=="Category already exist!"){
		      echo '<div class="message" > <span>'.$_SESSION["message"].' </span>
			  <i class="fas fa-times" style="cursor:pointer;" onclick="this.parentElement.remove();"></i></div>';
			  $_SESSION["message"]="";
	 }
	 else{
	   $_SESSION["message1"]=$_SESSION["message"];
       $_SESSION["message"]="";	   
	   header('Location:Menu.php');
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

/* delete category*/

$dir="..\user\uploads";
if(isset($_GET['delete'])){
	$id=$_GET['delete'];

    $sql="start transaction;";
	$result=mysqli_query($connect,$sql) or die(" query failed1"); 
	
	/*delete from photo table */
	
     $sql1="SELECT P.id_photo,P.pid,P.photo_path  FROM `photo` P, `item` I WHERE I.cat_id='$id' AND P.pid=I.pid  ;";
    $select_delete_image=mysqli_query($connect,$sql1) or die('query failed2');
	while($fetch_delete_image=mysqli_fetch_row($select_delete_image)){
	   unlink($dir.'/'.$fetch_delete_image[2]);
	   $p=$fetch_delete_image[0];
	   echo $p."<br/>";
	   $sql2="DELETE FROM `photo` WHERE id_photo='$p';";
	
	  $select_delete=mysqli_query($connect,$sql2) or die('query failed3'); }
	
	/*unlink category photo from the folder */
	
	$mysql="SELECT cat_photo FROM `category` WHERE cat_id='$id';";
	$select_delete_image=mysqli_query($connect,$mysql) or die('query failed4');
	$fetch_delete_image=mysqli_fetch_assoc($select_delete_image);
	unlink($dir.'/'.$fetch_delete_image['cat_photo']);
	
	
	
	
	/*delete from contain table*/
	
	$sql41="SELECT * FROM `contain` O , `item` I ,`category` C WHERE C.cat_id='$id'
     AND C.cat_id=I.cat_id AND O.pid=I.pid;";
    $select_rate1=mysqli_query($connect,$sql41) or die('query failed5');
    while($row1=mysqli_fetch_assoc($select_rate1)){
    $pid=$row1["pid"];
	
    $sql4="DELETE FROM `contain` WHERE pid=$pid ;";
    $select_contain=mysqli_query($connect,$sql4) or die('query failed6') ;
   }

/* delete from rating table */

    $sql3="SELECT * FROM `rating` R , `item` I ,`category` C WHERE C.cat_id='$id'
    AND C.cat_id=I.cat_id AND R.id=I.rat_id ;";
    $select_rate=mysqli_query($connect,$sql3) or die('query failed7');
   

	/* delete from item table*/
	
    $sqlitem="DELETE FROM `item` WHERE cat_id='$id';";
    $select_product_name2=mysqli_query($connect,$sqlitem) or die('query failed8');
	
	 while($row=mysqli_fetch_row($select_rate)){
    $rate_id=$row[0];

    $sql5="DELETE FROM `rating` WHERE id='$rate_id';";
    $select_product_name=mysqli_query($connect,$sql5) or die('query failed9');
 }
     /*delete from have table*/
	 
     $sqldel="DELETE FROM `have` WHERE cat_id='$id';";
     $select_product_name3=mysqli_query($connect,$sqldel) or die('query failed11');

    /*delete from category table*/
	
   $sql2="DELETE FROM `category` WHERE cat_id='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed12');


 
	 $sql="commit;";
	 $result=mysqli_query($connect,$sql) or die("bad query :$sql");
	 
    header('Location:Menu.php');
	$_SESSION["message"]="Deleted succcefully";
	exit;

}

?>


<!--FORM to  add Category  -->


<section class="addCategory">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="Post" ENCTYPE="multipart/form-data">
<h3>New Category</h3>
<input type="text" class="box" required placeholder="enter category name" name="name"/>
<input type="file" accept=".jpg,.jpeg,.png" required class="box" name="image" title="choose image"/>
<input type="submit" value="add category" name="add_category" style="cursor:pointer;" class="sub" />
</form>
</section>

<!--  Category Table -->

 
<table >
<tr><td><h4>Id</h4></td><td><h3>Name</h4></td><td><h4>Image</h4></td><td><h4>Add Extra</h4></td><td><h4>Actions</h4></td></tr>
<?php

$sql="SELECT * FROM `category` ORDER by cat_id;";
  $result=mysqli_query($connect,$sql) or die("bad query ");
  while($row=mysqli_fetch_array($result)){
 echo '<tr>';
   echo ' <td><h5>'.$row[0].'</h5></td>';
   echo ' <td><h5>'.$row[1].'</h5></td>';
  echo '<td><img src="..\user\uploads/'.$row[2].'" width="80px" height="80px" alt=""/></td>';
   echo '<td><h5><a href="addcat.php?add='.$row[0].'">add</a></h5></td>';
   
    /* for updating and deleting*/
	 
  echo  '<td><a href="updateMenu.php?update='.$row[0].'" class="sub">update</a>
  <a href="javascript:del('.$row[0].')" class="sub"  >delete</a>
  </td>';
  echo '</tr>';}
  ?>
  </table>
  
  <!-- Category total -->
  
  
  <div class="total"><h3>
  <?php

  $sql_t="SELECT count(*) as count FROM `category`;";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;?>
 </h3></div>
<?php mysqli_close($connect); ?>
</body>
</html>
		