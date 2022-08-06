<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(Offer)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	
    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >

    <!-- custom css file link  -->
    <link rel="stylesheet" href="includes/style.css">
	<link rel="stylesheet" href="includes/style_offer.css">

</head>
<body>

<?php
     session_start();
     if(isset($_GET["id"])){
		  $_SESSION["item"]=$_GET["id"];
		  header('Location:item8.php');
	 }	
    include("includes/connectDB.php");
    require("includes/header.php");
?>

<div class="p1" >
 <h1 class="heading1">available <span>offer</span></h1></div> 
 <section class="offer" id="offer">   
   <ul class="list">
   <?php
        $sql="select distinct o.offer_id,discount from offer o,item i where o.offer_id=i.offer_id";
        $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		
		if(mysqli_num_rows($result1)>0){
			      $i=0;
				  while($row1=mysqli_fetch_assoc($result1)){
					   echo '<li class="bt" id="offer'.$i.'" onclick="f(this,'.$i.');" >'.$row1['discount'].'%</li>';
					   $i=$i+1;
					   $array_offer[]=$row1;
					   
				  }
						   
		}else
			exit;
        mysqli_free_result($result1);		
   ?>
   </ul>
  <div id="food-container">
    <div id="food-items" >
	  <?php
	    $i=0;
	    foreach($array_offer as $e){
		  $sql="select pid,pname,price,rat_id from item where offer_id=".$e['offer_id'];
		  $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		
		  if($result1){
			   	 echo '<div class="biryani" id="item'.$i.'" style="display:none;" >';
	                echo '<div class="swiper offer-slider" >';
                         echo '<div class="swiper-wrapper">';
				  while($row1=mysqli_fetch_assoc($result1)){
					       echo '<div id="item-card" class="swiper-slide box" >';
					          echo '<div id="card-top">';
							    $sql="select nb1,nb2,nb3,nb4,nb5 from rating where id=".$row1['rat_id'];
                                $result2=mysqli_query($conn,$sql) or die("bad query :$sql");
		                        if($row2=mysqli_fetch_array($result2)){
								  $total=$row2[0]+$row2[1]+$row2[2]+$row2[3]+$row2[4];
		                          $max=$row2[0]+$row2[1]*2+$row2[2]*3+$row2[3]*4+$row2[4]*5;
		                          if($total!=0)
		                           $b=($max/$total);
		                         else
		                     	   $b=0;
	                             $b=number_format($b,2);
                                echo '<i class="fas fa-star" id="rating">'.$b.'</i>';								 
								}
                                mysqli_free_result($result2);								

					            echo '<a href="'.$_SERVER['PHP_SELF'].'?id='.$row1['pid'].'" ><i class="fas fa-eye" id="view" ></i></a>';
							  echo '</div>';
							  $sql="select photo_path from photo where pid=".$row1['pid'];
                              $result2=mysqli_query($conn,$sql) or die("bad query :$sql");
		                      if($row2=mysqli_fetch_array($result2)){
				                 echo  ' <img src="uploads/'.$row2[0].'" ></img>';
						   
		                       }
                              mysqli_free_result($result2);
                              echo '<p id="item-name" >'.$row1['pname'].' </p>';
                              $total=$row1['price']-$row1['price']*($e['discount']/100);
                               $total=$total*$_SESSION['equal'];
                               $row1['price']=$row1['price']*$_SESSION['equal'];
							   
							  echo '<p id="item-price" >price:'.$total.' '.$_SESSION['symbole'].' <span>'.$row1['price'].' '.$_SESSION['symbole'].'</span></p>';
                          echo '</div>';							  
				  }
						echo '</div>'; 
					echo '</div>';   
				 echo '</div>';   
		}
          $i=$i+1;   
		}
	  
	  
	  ?>
		


	 </div>
	 </div>
 </section>
 
 
<?php     
    require("includes/footer.php");
	mysqli_close($conn);
 ?>
<script>
   dis=document.getElementById("offer0");
   dis.className="bt active";
   dis1=document.getElementById("item0");
   dis1.style.display="initial";
   $prev=0;
   function f(x,y){
	   dis.className="bt";
	   dis1.style.display="none";
	   dis=x;
	   dis.className="bt active";
	   dis1=document.getElementById("item"+y);
	   dis1.style.display="initial";
   }

</script>

<!-- speciality section ends -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link -->
<script src="includes/script1.js"></script>  

</body>
</html>