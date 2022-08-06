<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(home)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<!--  aos  css link -->
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	
	<!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
   
    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >

    <!-- custom css file link  -->
    <link rel="stylesheet" href="includes/style.css">
	<link rel="stylesheet" href="includes/style_home.css">

</head>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<body>
 <?php
    session_start();
		
   if(isset($_GET["id"])){
		$id=$_GET["id"];

		$_SESSION["PRODUCT"]=$id;

        header("Location:item.php");		
   }
   
   if(isset($_GET["id1"])){
		$id=$_GET["id1"];

		$_SESSION["item"]=$id;

        header("Location:item8.php");		
   }
  
  if(isset($_SESSION['succes'])){
     if($_SESSION['succes']=="true"){
?>
		<script>
            Swal.fire(
              'Thank you',
              'Your order has been submit successfully',
              'success'
            );

        </script> 
<?php
		           $_SESSION['succes']="";
	 }else{
		 if(!isset($_SESSION['x'])){
		      echo '<div class="loader-container"><img src="uploads/loader.gif" alt=""></div>'; 
			  $_SESSION['x']="";
		 } 
	 } 
  }else
	  if(!isset($_SESSION['x'])){
	 		echo '<div class="loader-container"><img src="uploads/loader.gif" alt=""></div>'; 
			$_SESSION['x']="";
			
	  }
?>   
 <?php
  include("includes/connectDB.php");
 ?>

 <?php
  require("includes/header.php");
 ?>

<section class="home" id="home">

    <div class="content">
        <h3>food made with love</h3>
        <p>La Tavola Restaurant is the best restaurant offering different kinds of delicious and tasty meals in the middle east.</p>
        <?php echo '<form action="" class="search-form">';
	                   echo '<input type="search" placeholder="search here ..." id="serch-box" required />';
	                   echo '<label for="search-box" class="fas fa-search" ></label>';
	          echo '</form>'; ?>
    </div>
    <div class="image">
        <img src="uploads/la-tavola.png"  alt="">
    </div>
</section>

<section class="About" id="About" data-aos="fade-up" >
    <h1 class="heading"   > <span>About</span> Use</h1>
  
    <div class="steps">

        <div class="box">
            <img src="uploads/step-1.jpg" alt="">
            <h3>choose your favorite food</h3>
        </div>
        <div class="box">
            <img src="uploads/step-2.jpg" alt="">
            <h3>free and fast delivery</h3>
        </div>
        <div class="box">
            <img src="uploads/step-3.jpg" alt="">
            <h3>easy payments methods</h3>
        </div>
        <div class="box">
            <img src="uploads/step-4.jpg" alt="">
            <h3>and finally, enjoy your food</h3>
        </div>
    
    </div>
</section>	

<section class="Category" id="Category" data-aos="fade-up">
    <h1 class="heading"  > Product<span>Category</span></h1>
<?php
  $sql="select * from category";
  $result=mysqli_query($conn,$sql) or die("bad query :$sql");

    echo '<div class="swiper category-slider" >';
       echo     '<div class="swiper-wrapper">';
	while($row=mysqli_fetch_array($result)){
		$id=$row[0];
        echo '<div class="swiper-slide box">';
	      echo '<img src="uploads/'.$row[2].'" alt="" />';
		  echo '<br/><h3>'.$row[1].'</h3><br/><br/>';
		  echo '<div  class="btn1"  onclick="location.href=\''.$_SERVER['PHP_SELF'].'?id='.$id.'\';" >More info</div>';
         echo '</div>';
	}  
//
	     echo '</div>';
	  echo '</div>';
     mysqli_free_result($result);
?>
</section>

<section class=" last_product" id="last_category" data-aos="fade-up">
    <h1 class="heading"  > last<span>item</span></h1>
	  <div id="items" class="items">
        <div class="container pt-5 pb-5">
			     <div class="swiper item-slider" >
                    <div class="swiper-wrapper">
<?php
   $sql="select pid,pname,description,price,offer_id from item order by pid desc limit 10";
   $result=mysqli_query($conn,$sql) or die("bad query :$sql");
   WHILE($row1=mysqli_fetch_array($result)){

?>					
						
                <div class="swiper-slide box col col-md-4">
                    <div class="item mb-4">
                        <div class="item-image">
					        <?php
	                            $sql="select photo_path from photo where pid=".$row1[0];
                                 $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		                        if($row2=mysqli_fetch_array($result1)){
		       				         echo  '<img class="transition" src="uploads/'.$row2[0].'" alt="course detail"> ';  
		                          }
                                 mysqli_free_result($result1);					  
                            ?>		 
                        </div>
                        <div class="item-detail p-4">
                            <h2>
                                <a href="<?php  echo $_SERVER['PHP_SELF'].'?id1='.$row1[0]; ?>"><?php echo $row1[1]; ?></a>
                            </h2>
                            <div class="item-desc">
                                <p><?php echo $row1[2]; ?>.</p>
                            </div>
                            <div class="row">
                                <div class="col-6 item-price">
								
							   <?php
	                             if($row1[4]!=""){
			                         $sql="select discount from offer where offer_id=".$row1[4];
                                     $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		                             if($row2=mysqli_fetch_array($result1)){
		                               $b=$row1[3]-$row1[3]*$row2[0]/100;
									   $b=$b*$_SESSION['equal'];
									   $row1[3]=$row1[3]*$_SESSION['equal'];
                                       echo '<span>'.$b.' '.$_SESSION['symbole'].' <i class="prev" >'.$row1[3].' '.$_SESSION['symbole'].' </i></span>'; 						  
			                         }
			                         mysqli_free_result($result1);					  		 
                            
	                             }else{
                                    $row1[3]=$row1[3]*$_SESSION['equal'];

		                            echo '<span >'.$row1[3].' '.$_SESSION['symbole'].'</span>';
								 }
								 ?>
								
								
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end -->
				
<?php
   }
   
?>

				</div></div>
            </div>
    </div>

</section>	
<script>
   
   function loader(){
  document.querySelector('.loader-container').classList.add('fade-out');
   }

function fadeOut(){
  setInterval(loader, 3000);
}

window.onload = fadeOut();
</script>

 <?php
   require("includes/footer.php");
 ?>

 <!-- aos js link    -->
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 
 <script>
   AOS.init({
      duration:800,
	  delay:300
   });
 </script>
<!-- speciality section ends -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link -->
<script src="includes/script1.js"></script>  
<?php 

mysqli_close($conn); 

?>
</body>
</html>