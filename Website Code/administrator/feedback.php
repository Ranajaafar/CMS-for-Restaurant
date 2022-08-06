<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>

<link rel="stylesheet" href="css/Astyle1.css">
<link rel="stylesheet" href="css/Astyle8.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
.sidebar-menu a.active5{
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


<section class="placed-feedback">

   <h1 class="title">the lastest 10 feedbacks</h1>

   <div class="box-container">


<?php

/*select the lastest 10 feedback from feedback table */


$sql=" SELECT * FROM `feedback` ORDER BY id_comm DESC LIMIT 10 ;";
$result=mysqli_query($connect ,$sql) or die( 'query failed ');
      if(mysqli_num_rows($result) > 0){
         while($fetch_orders = mysqli_fetch_assoc($result)){
      ?>
      <div class="box">
         <p> id : <span><?php echo $fetch_orders['id_comm']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> <span><?php echo $fetch_orders['commentaire']; ?></span> </p>
         <p> date: <span><?php echo $fetch_orders['date']; ?></span> </p>
         
        
      </div>
      <?php
         }
      }?>
	  </div>

</section>

<?php mysqli_close($connect); ?>
  
</body>
</html>