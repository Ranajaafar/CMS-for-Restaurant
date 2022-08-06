<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>

<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle7.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

</head>
<body>


<?php
include("include\Connecting.php");
session_start();
if(!(isset($_SESSION['Sname']))){
header('location:login.php');}?>


<section class="placed-orders">
<?php
if( isset($_GET['id1']) ){
$oid=$_GET['id1'];

/* select customer and order information */

  $sql="SELECT * FROM `customer` C,`order_info` O  WHERE O.oid='$oid' AND C.cid=O.cid ;";
  $result=mysqli_query($connect ,$sql) or die( 'query faild 1');
  if(mysqli_num_rows($result) > 0){
	while($fetch_customer = mysqli_fetch_assoc($result)){?>
			  
    <div class="box-container">  <div class="box">
	     <p> order id : <span><?php echo $oid; ?></span> </p>
         <p> user id : <span><?php echo $fetch_customer['cid']; ?></span> </p>
         <p> customer name : <span><?php echo $fetch_customer['cname']; ?></span> </p>
         <p> number : <span><?php echo $fetch_customer['ctel']; ?></span> </p>
         <p> email : <span><?php echo $fetch_customer['cemail']; ?></span> </p>
		 <p> country : <span><?php echo $fetch_customer['country']; ?></span> </p>
         <p> address : <span><?php echo $fetch_customer['oaddress']; ?></span> </p>
		 <p> order : <br/>

		 <?php  
		  $sql1="SELECT quantity,e.name,I.pname FROM `contain` T,`item` I,extra e WHERE T.oid='$oid' AND T.pid=I.pid AND t.extra_id=e.id_extra ;";
          $result1=mysqli_query($connect ,$sql1) or die( 'query failed ');
          if(mysqli_num_rows($result1) > 0){
			  while($fetch_item = mysqli_fetch_assoc($result1)){?>
                   <span style="padding-left:2rem;"><?php echo $fetch_item['pname'].' '; 
				      if($fetch_item['name']!='ex'){
				         echo 'with extra '.$fetch_item['name'].' ';
				      }
					  echo '('.$fetch_item['quantity'].')<br/>';
				   ?></span>
		  <?php }
		  }?>
		  </p>
         <p> total price : <span><?php echo $fetch_customer['total']; ?>$</span> </p>
		 <?php if($fetch_customer['dis_id']!=NULL){
		  $sql1="SELECT pourcentage from discount where dis_id=".$fetch_customer['dis_id'];
          $result1=mysqli_query($connect ,$sql1) or die( 'query failed ');
          $row = mysqli_fetch_assoc($result1); 
			 
			 ?>
		 <p> discount: <span><?php echo $row['pourcentage']; ?></span> </p><?php } ?>
		         
      </div>
      <?php
         }
}}?>
	  </div>

</section>
<?php mysqli_close($connect); ?>
</body>
</html>