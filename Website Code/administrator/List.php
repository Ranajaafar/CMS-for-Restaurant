<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>
<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle3.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
.sidebar-menu a.active2{
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

if(isset($_POST['add_item'])){
	
	/* using method post to  fill the table item */
	
   $name=trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
   $cid=trim(filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT ));	
   $details=trim(filter_var($_POST["details"], FILTER_SANITIZE_STRING ));

   $date=date("Y-m-d");


 
   /* Check if the item aleardy exist */

    $sp="SELECT * FROM `item` WHERE pname='$name' AND cat_id='$cid';"; 
	$select_product_name=mysqli_query($connect,$sp) or die('query failed');
	if(mysqli_num_rows($select_product_name)>0){
		$_SESSION["message"]= 'Item already exist!';
		
        }
		/* Convert to dollar before adding the currency if it's different than $ */
   else {
	   if(isset($_POST["Currency"])){
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
	   else {$price=floatval($_POST["price"]);}}
	   else{
	   $price=floatval($_POST["price"]);}
	   

/* Check if the offer id inserted and different than null */
  $price=number_format($price,2);
     if($_POST["offer"]!=0){
	     $oid=trim(filter_var($_POST["offer"],FILTER_SANITIZE_NUMBER_INT ));
		 $sql_cid="SELECT * FROM `offer` WHERE offer_id='$oid';";
        $checkid=mysqli_query($connect,$sql_cid) or die('query failed');
        if(mysqli_num_rows($checkid)==0) {
        $_SESSION["message"]='wrong offer id or this offer not exist!';}
		
		/* insert with offer id */
		
		
	  else{
		  
		       $sql="start transaction;";
	$result=mysqli_query($connect,$sql) or die(" query failed1"); 
	
    $sqlr="INSERT INTO  `rating` (nb1,nb2,nb3,nb4,nb5) VALUES (0,0,0,0,0);";
	 $insert_rat=mysqli_query($connect,$sqlr)or die('query failed');
	 $sqlcheckr="SELECT max(id)as maxid FROM `rating`;";
	 $checkr=mysqli_query($connect,$sqlcheckr)or die('query failed');
	 $row=mysqli_fetch_assoc($checkr);
     $rid=$row["maxid"];

      $sql="INSERT INTO `item` (pname,description,price,rat_id,cat_id,offer_id) VALUES('$name','$details','$price','$rid','$cid','$oid');";
	 $insert_product=mysqli_query($connect,$sql)or die('query failed');
	 $_SESSION["message"]='Item added successfully';
	 
	     $sql="commit;";
	$result=mysqli_query($connect,$sql) or die(" query failed1"); 
	
	 
	 }}
	 
	 
	 /* insert without offer id */
	 
   else{
	   
	       $sql="start transaction;";
	     $result=mysqli_query($connect,$sql) or die(" query failed1"); 
	 
       $sqlr="INSERT INTO  `rating` (nb1,nb2,nb3,nb4,nb5) VALUES (0,0,0,0,0);";
	   $insert_rat=mysqli_query($connect,$sqlr)or die('query failed');
	   $sqlcheckr="SELECT max(id)as maxid FROM `rating`;";
	   $checkr=mysqli_query($connect,$sqlcheckr)or die('query failed');
	   $row=mysqli_fetch_assoc($checkr);
       $rid=$row["maxid"];

	   $sql="INSERT INTO `item` (pname,description,price,rat_id,cat_id) VALUES('$name','$details','$price','$rid','$cid');";
      $insert_product1=mysqli_query($connect,$sql)or die('query failed1');
	  
	      $sql="commit;";
	$result=mysqli_query($connect,$sql) or die(" query failed1"); 
	
	
	  $_SESSION["message"]='Item added successfully';}
	   }
	   
	   /* back to the previous page */
	   
    echo ' <script> window.history.back(); </script>';	
    exit;
}


/* echo message */

if(isset($_SESSION["message"])) {
  if($_SESSION["message"]==""){
  }else{
	 if($_SESSION["message"]=="Item already exist!"){
		      echo '<div class="message" > <span>'.$_SESSION["message"].' </span>
			  <i class="fas fa-times" style="cursor:pointer;" onclick="this.parentElement.remove();"></i></div>';
			  $_SESSION["message"]="";
	 }
	 else  {
	   $_SESSION["message1"]=$_SESSION["message"];
       $_SESSION["message"]="";	   
	   header('Location:List.php');
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

/* delete item */

$dir="..\user\uploads";
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	
	$sql="start transaction;";
	$result=mysqli_query($connect,$sql) or die("bad query :$sql");

    /*delete from contain table */
	
   $sql4="DELETE FROM `contain` WHERE pid=$id ;";
   $select_contain=mysqli_query($connect,$sql4) or die('query failed') ;
    
	/*SELECT from rating table */
	
    $sql3="SELECT * FROM `rating` R , `item` I WHERE R.id=I.rat_id AND I.PID='$id';";
    $select_rate=mysqli_query($connect,$sql3) or die('query failed');
    $row=mysqli_fetch_assoc($select_rate);
    $rate_id=$row["id"];


	/* delete from photo table */

    $mysql="SELECT photo_path FROM `photo` WHERE pid='$id';";
	$select_delete_image=mysqli_query($connect,$mysql) or die('query failed');
	while($fetch_delete_image=mysqli_fetch_assoc($select_delete_image)){
	unlink($dir.'/'.$fetch_delete_image['photo_path']);}
	
	$sql2="DELETE FROM `photo` WHERE pid='$id';";
    $select_product_name=mysqli_query($connect,$sql2) or die('query failed');
      
	  /* delete from item table */
	  
    $sql2="DELETE FROM `item` WHERE pid='$id';";
    $select_item_name=mysqli_query($connect,$sql2) or die('query failed');

    /*delete from rating table */
 
    $sql5="DELETE FROM `rating` WHERE id='$rate_id';";
    $select_product_name=mysqli_query($connect,$sql5) or die('query failed');

     $sql="commit;";
	 $result=mysqli_query($connect,$sql) or die("bad query :$sql");
	 
    header('Location:List.php');
	$_SESSION["message"]="Deleted succcefully";
	exit;
}

?>
<!--FORM to  add item  -->

<section class="addProduct">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="Post" ENCTYPE="multipart/from-data">
<h3>New Item</h3>
<input type="text" class="box" required placeholder="enter item name" name="name"/>

<select name="id" class="box" required>
<?php 
$sqlcu="SELECT * FROM `category`;";
  $resultc=mysqli_query($connect,$sqlcu) or die("bad query ");
  while($rowc=mysqli_fetch_array($resultc)){
	  ?>
<option value="<?php echo $rowc[0];?>"><?php echo $rowc[1]; ?></option>
  <?php } ?>
</select>
<select name="offer" class="box" required>
  <option value="0" > enter offer id</option>
  <?php 
    $sqlcu="SELECT * FROM `offer`;";
    $resultc=mysqli_query($connect,$sqlcu) or die("bad query ");
     while($rowc=mysqli_fetch_array($resultc)){

	?>
   <option value="<?php echo $rowc[0];?>"><?php echo $rowc[1]; ?></option>
	
	 <?php  } ?>
</select>

<input type="text" class="box" required placeholder="enter item price" name="price"/>


<!-- currency refere to currency table, can add using any currency exist in the table
but all the prices will be saved in database in dollar -->
<?php
$sqlcu="SELECT * FROM `currency`;";
  $resultcu=mysqli_query($connect,$sqlcu) or die("bad query ");
  if(mysqli_num_rows($resultcu)){
  ?>
<select name="Currency" id="curr" required>

<?php 

  while($rowcu=mysqli_fetch_array($resultcu)){
	  ?>
<option value="<?php echo $rowcu[0];?>"><?php echo $rowcu[1]; ?></option>
  <?php } ?>
</select>
  <?php } ?>
<textarea   required placeholder="enter item details" name="details" cols="30" rows="10"></textarea>

<input type="submit" value="add item" name="add_item"  style="cursor:pointer;" class="sub" />
</form>
</section>


<!-- table for item table -->

<div style="overflow-x:auto;">
<table>
<tr><td><h4>Id</h4></td><td><h4>Name</h4></td><td><h4>Image</h4></td><td><h4>Description</h4></td><td><h4>Price</h4></td>
<td><h4>CategoryID</h4></td><td><h4>offerID</h4></td><td><h4>RateID</h4></td><td><h4>Actions</h4></td></tr>

<?php

$sql="SELECT * FROM `item` ORDER BY cat_id;";
  $result=mysqli_query($connect,$sql) or die("bad query :$sql");
  while($row=mysqli_fetch_array($result)){
 echo '<tr>';
   echo ' <td><h5>'.$row[0].'</h5></td>';
   echo ' <td><h5>'.$row[1].'</h5></td>';
   
   /* for item photos */
 echo '<td><a href="photos.php?photo='.$row[0].'">'.$row[1].'Photos</a></td>'; 
 
  echo ' <td><h5>'.$row[2].'</h5></td>';
  echo ' <td><h5>'.$row[3].'</h5></td>';
  echo ' <td><h5>'.$row[5].'</h5></td>';
  echo ' <td><h5>'.$row[6].'</h5></td>';
    echo ' <td><h5>'.$row[4].'</h5></td>';
	
  /* for updating and deleting*/
  
  echo  '<td><a href="updatelist.php?update='.$row[0].'" class="sub">update</a>
  <a href="javascript:del('.$row[0].')" class="sub"  >delete</a></td>';
  echo '</tr>';}
  ?>
  </table></div>
  <!-- functions on the table item -->
  
  <!-- total number of item -->
<div class="total"><h3>
  <?php
  $sql_t="SELECT count(*) as count FROM `item`;";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
$rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;?></h3>
 </div>

 
 <!-- total number of items for a specific offer -->

 <?php mysqli_close($connect); ?>
</body>
</html>
