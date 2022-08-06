<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>

<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle7.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
.sidebar-menu a.active4{
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
?>
<!-- select from database order for today -->

<div style="overflow-x:auto;">
<table>
<tr>
<td><h4>  Order ID  </h4></td><td><h4> Address  </h4></td><td><h4>  Date  </h4></td><td><h4>  Total amount($)  </h4></td>
<td><h4>  Customer ID  </h4></td><td><h4>  Customer name  </h4></td><td><h4>  </h4></td></tr>
<?php
$date=date("Y-m-d");

$sql="SELECT * FROM `order_info` where odate= DATE(NOW()) ORDER by oid;";
$result=mysqli_query($connect ,$sql) or die( 'query failed ');
      if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_array($result)){?>
         <tr>
        <td><h5><?php echo $row[0]; ?></h5></td>
       <td><h5><?php echo $row[1]; ?></h5></td>
        <td><h5><?php echo $row[2]; ?></h5></td>
	     <td><h5><?php echo $row[3]; ?></h5></td>
		  <td><h5><?php echo $row[5]; ?></h5></td>
<?php		  $sql1="SELECT cname FROM `customer` where cid=".$row[5]."";;
         $result1=mysqli_query($connect ,$sql1) or die( 'query failed '); 
         $row1 = mysqli_fetch_array($result1)
		 ?>
		  <td><h5><?php echo $row1[0]; ?></h5></td>

		     <td><h5><a href="infos.php<?php echo '?id1='.$row[0]; ?>" ><span class="las la-eye"></span></a></h5></td>
  

	  </tr><?php }}
  ?>
	  </table></div>
	  
	  <!-- total orders-->
	  
<div class="total"><h3>
  <?php
  $sql_t="SELECT count(*) as count FROM `order_info` where odate= DATE(NOW());";
  $total=mysqli_query($connect,$sql_t) or die("bad query ");
  $rowt=mysqli_fetch_assoc($total);
  $Total=$rowt["count"];
  echo 'Total: ' .$Total;?></h3>
 </div> 
<?php mysqli_close($connect); ?>
</body>
</html>