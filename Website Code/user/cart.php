<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(cart)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
       
	   <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >

	<!--  aos  css link -->
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="includes/style.css">
    <link rel="stylesheet" href="includes/style_cart.css">	

</head>
<body>
<?php

   session_start();
   include("includes/connectDB.php");
   if(isset($_POST['submit'])){
	  $TEXT=$_POST['text'];
	  $sql="select pourcentage from discount where unicode='".$TEXT."'";
	  $result2=mysqli_query($conn,$sql) or die("bad query :$sql");
      if($row1=mysqli_fetch_array($result2)){
		  $_SESSION["unicode"]=$TEXT;
		  
	  }
	  echo ' <script>    window.history.back(); </script>';	
  }
?>
 <?php

 ?>

 <?php
  if(isset($_GET["id"])){
		  $_SESSION["item"]=$_GET["id"];
		  header('Location:item8.php');
  }
  
  require("includes/header.php");
 ?>
 <div class="p1" >
 <h1 class="heading1">your <span>cart</span></h1></div> 
 <?php
    if(isset($_COOKIE['nb'])){
		$nb=$_COOKIE['nb'];
		$nbr=$nb;
		if($nb>0){
			  echo '<script> Array_of_cart=new Array(0); </script>';

		
  ?>		
	 <section id="cart-container" class="container" >
   <table  id="tab" >
         <thead>
		    <tr>
			  <td width="100">remove</td><td width="130">Image</td><td width="250" >product</td><td>extra</td><td width="280" >price</td><td width="110">quantity</td><td>total</td>
			</tr>
		  
		 </thead>
		 <tbody>
		 <?php
		 	$j=0;
			$cart_total=0;
	        for($i=0;$i<$nb;$i++,$j++){
			  while(!isset($_COOKIE['add'.$j])){
			      $j++;
		      }
			  $a=$_COOKIE['add'.$j];
			  $c=explode(':',$a); //comme split in javasc
			  $sql="select pname,price,offer_id from item where pid=".$c[0];
			  $result2=mysqli_query($conn,$sql) or die("bad query :$sql");
              if($row1=mysqli_fetch_array($result2)){
		        	 echo '<script> Array_of_cart['.$i.']="'.$j.'_'.$_COOKIE['add'.$j].'"; </script>';			


		  ?>
   		     <tr class="ligne" >
			   <td width="110" ><i class="fas fa-trash-alt" onclick="f(this,<?php   echo $j; ?>);" ></i></td>
			    <?php
	                $sql="select photo_path from photo where pid=".$c[0];
                    $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		            if($row2=mysqli_fetch_array($result1)){
                         echo '<td><a href="'.$_SERVER["PHP_SELF"].'?id='.$c[0].'" ><img src="uploads/'.$row2[0].'" alt="" width="50px" height="50px"></img></a></td>';
						   
		            }else
						 echo '<td><img  alt="" width="50px" height="50px"></img></td>';
                    mysqli_free_result($result1);					  		 					
                ?>
			   
			   
			   
			   
			   <td><?php echo $row1[0]; ?></td>
			   <?php
			       if(isset($c[2])){
					  $sql="select name,price from extra where id_extra=".$c[2];
                      $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		              if($row2=mysqli_fetch_array($result1)){
                         echo '<td width="110" >'.$row2[0].'</td>';
		              }
					  
					  
                      mysqli_free_result($result1);					  		 					  
			       }else{
					 echo '<td>no extra</td>';
			       }
                   $sql="select discount from offer where offer_id=".$row1[2];
				   if($row1[2]!=""){
				     $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
					 if($row3=mysqli_fetch_array($result1)){
						
						$b=$row1[1]-$row1[1]*($row3[0]/100);
						$btotal=$b*$_SESSION['equal'];
						$row1[1]=$row1[1]*$_SESSION['equal'];
			            $btotal=number_format($btotal,2);						  
			            $btota2=number_format($row1[1],2);						  
						echo '<td>'.$btotal.' '.$_SESSION['symbole'].' <span id="span" >'.$btota2.' '.$_SESSION['symbole'].'</span>';
						if(isset($c[2])){
						  $btotal=$row2[1]*$_SESSION['equal'];	
				          $btotal=number_format($btotal,2);						  						  
					      echo ' ('.$btotal.' '.$_SESSION['symbole'].')';
						  $b=$b+$row2[1];
				        }
						echo '</td>';
		             }
                     mysqli_free_result($result1);					  		 					

				 }else{
					  $b=$row1[1];
					  $btotal=$b*$_SESSION['equal'];
					  
                      echo '<td>'.$btotal.' '.$_SESSION['symbole'];
					  if(isset($c[2])){
						  $btotal=$row2[1]*$_SESSION['equal'];
				          $btotal=number_format($btotal,2);						  
					      echo ' ('.$btotal.' '.$_SESSION['symbole'].')';
						  $b=$b+$row2[1];
				      }
					  echo '</td>';
				 }					   
                 echo '<td>'.$c[1].'</td>';
				 $total=$b*$c[1];
				 $cart_total=$cart_total+$total;
				 $total=$total*$_SESSION['equal'];
				 $total=number_format($total,2);
				 echo '<td>'.$total.' '.$_SESSION['symbole'].'</td>';
			   ?>
			   
			   </tr>
		 
          <?php	
              }else{
				 setcookie('add'.$j,"",(time()-300000)); 
				 $nbr=$nbr-1;
				 setcookie('nb',$nbr,(time()+(60*60*24*3)));

			  }
              mysqli_free_result($result2);					  		 					  				  							   
			}
                           						      						   
		
		 
		 ?>

		 </tbody>
   </table>
 </section>
 
<section id="cart_add" class="section-p1">
  <div id="coupon">
    <h3>apply coupon</h3>
	<div>
	 <form action="" method="post" id="form" >
	  <input type="text" placeholder="enter your coupon" value="" name="text" required />
	  <input type="submit" class="normal1" name="submit" value="Apply" />
	 </form>
	 </div> 
  </div>
  <div id="subtotal" >
    <h3>cart Totals</h3>
	<table>
	  <tr>
	    <td>cart subtotal</td><td><?php 
         $cart_total1=$cart_total*$_SESSION['equal'];
		 $cart_total1=number_format($cart_total1,2);

		echo $cart_total1.' '.$_SESSION['symbole']; ?></td>
	  </tr>
	  <tr>
	    <td>shipping</td><td>free</td>
	  </tr>
	  <?php
	    if(isset($_SESSION["unicode"])){
			  $sql="select pourcentage from discount where unicode='".$_SESSION["unicode"]."'";
              $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		      if($row2=mysqli_fetch_array($result1)){
				       echo '<tr>';
                         echo '<td>pourcentage</td>';					   
                         echo '<td>'.$row2[0].'</td>';
                       echo '</tr>';
					   $b=$cart_total-$cart_total*($row2[0]/100);
					   
		      }else{
                $b=$cart_total;				
			  }
              mysqli_free_result($result1);					  		 					

		}else
			$b=$cart_total;
	  
	  ?>
	  <tr>
	    <td><strong>total</strong></td><td><strong><?php 
		        $b1=number_format($b,2);

			   $_SESSION["TOTAL"]=$b1;

               $b=$b*$_SESSION['equal'];
		       $b=number_format($b,2);

		echo $b.' '.$_SESSION['symbole']; ?></strong></td>
	  </tr>
	</table>
	<button class="normal" onclick="window.location='checkout.php';">Proceed to checkout</button>
  </div>
</section> 	
		
		
		
		
		
		
		
		
		
		
		
  <?php
		}  
	}else{
		$nbr=0;
	    setcookie('nb',$nbr,(time()+(60*60*24*3)));

 	}
    $test="<script>	window.sessionStorage.setItem(\"nb\",".$nbr."); </script>";	
    echo $test;
 
 ?>
<script>

function f(x,y){
	   z=x.parentNode;
	   z=z.parentNode;
	   z.style.display="none";
	   document.cookie="add"+y+"="+""+";max-age=-60"; 
	   nb=sessionStorage.getItem("nb");
       document.cookie='nb='+(parseInt(nb)-1)+";max-age="+(60*60*24*3);
	   window.sessionStorage.setItem("nb",(parseInt(nb)-1));
	   
	   Array1=new Array();
	   j=0;
	    for(i=0;i<Array_of_cart.length;i++){
				c=Array_of_cart[i];
				string=c.split('_');
				if(string[0]!=y){
					Array1[j++]=Array_of_cart[i];
					document.cookie='add'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

				}	
	    }
	    Array_of_cart=Array1;
}

</script>
 <!-- speciality section ends -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link -->
<script src="includes/script1.js"></script>  
<?php 
mysqli_close($conn); 
   require("includes/footer.php");



?>
</body>
</html>