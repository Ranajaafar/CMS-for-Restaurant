<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(feedback & review)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >
   
    <!-- custom css file link  -->
	<link rel="stylesheet" href="includes/style.css">
	<link rel="stylesheet" href="includes/style6.css">

</head>
<body>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
 <?php
   session_start();
   include("includes/connectDB.php");
   
   if(isset($_GET["submit"])){
	   $a=(int)$_GET["hidden"];
	   if($a==1)
	     $sql="UPDATE rating SET nb1=(nb1+1) WHERE ID=1";
	   else if($a==2)
	     	     $sql="UPDATE rating SET nb2=(nb2+1) WHERE ID=1";
       else if($a==3)
		   	     $sql="UPDATE rating SET nb3=(nb3+1) WHERE ID=1";
       else if($a==4)
		   	     $sql="UPDATE rating SET nb4=(nb4+1) WHERE ID=1";
       else 
		   	     $sql="UPDATE rating SET nb5=(nb5+1) WHERE ID=1";  
	   $result=mysqli_query($conn,$sql) or die("bad query :$sql");
	   $_SESSION["SUCCESS"]="true";
       echo ' <script>    window.history.back(); </script>';	
	   
   }
    if(isset($_SESSION['SUCCESS']) && !isset($_GET["submit"])){
	   if($_SESSION['SUCCESS']=="true"){
		?>
		<script>
            Swal.fire(
              'Thank you',
              'we\'ll use your rating to improve our customer support performance',
              'success'
            );

        </script> 
		
   <?php   
		    $_SESSION['SUCCESS']="";
	   }else if($_SESSION['SUCCESS']=="truef"){
		?>
		<script>
            Swal.fire(
              'Thank you',
              'we\'ll use your feedback to improve our customer support performance',
              'success'
            );

        </script> 
		
   <?php   
		    $_SESSION['SUCCESS']="";
	 }
	}
	if(isset($_GET["submit1"])){
		$a=addslashes($_GET["name"]);
		$b=addslashes($_GET["message"]);
		$sql="INSERT INTO feedback (name, commentaire,date) VALUES ('$a','$b',DATE(NOW()))";  
	    mysqli_query($conn,$sql) or die("bad query :$sql");
	    $_SESSION["SUCCESS"]="truef";
		echo ' <script>    window.history.back(); </script>';	

		exit();
   	}

  ?>
  <?php
	 require("includes/header.php");

  ?>
  <div class="p1" >
 <h1 class="heading1">about <span>feedback</span></h1></div> 
 <section class="send"  >
 <div class="star" >
    <div class="container">
	   <h3 class="review-title" > Review  </h3>
      <div class="star-widget">
        <input type="radio" name="rate" id="rate-5">
        <label for="rate-5" onclick="g(5);" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-4">
        <label for="rate-4"  onclick="g(4);" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-3">
        <label for="rate-3" onclick="g(3);" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-2">
        <label for="rate-2" onclick="g(2);" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-1">
        <label for="rate-1"  onclick="g(1);" class="fas fa-star"></label>
        <form  class="a" method="get" action="" >
          <footer  ></footer> 
          <input type="text" name="hidden" style="display:none; width:0;" id="type1" value="" />		  
          <input type="submit"  class="bt" value="POST" name="submit" ></input>
        <!--  </div>  -->
        </form> 
      </div>
    </div>
  </div>
  <div class="feedback" >
    <h3 class="review-title" > feedback  </h3>
    <form  action="" method="get" > 
       <label for="name">Name:</label>
       <input type="text" name="name" id="name" required>
       <label for="message">Message: </label>
       <textarea name="message" cols="30" rows="10" id="message" required ></textarea>
	   <input type="submit" value="POST" name="submit1" ></input>
    </form>
  </div>
</section>  

<section class="feed" >
   <h1 class="title-feed" >customer's feedback </h1>
   <div class="swiper feed-slider">
     <div class="swiper-wrapper" >
	    <?php
		  $sql="select name,commentaire from feedback";
		   $result=mysqli_query($conn,$sql) or die("bad query :$sql");
           if($result){
	            while($row=mysqli_fetch_assoc($result)){  
		
		?>
	    <div class="swiper-slide box">
		  <p><?php echo $row["commentaire"]; ?></p>
		  <h3><?php echo $row["name"]; ?></</h3>
	    </div>
		<?php
				}
		   }
		 mysqli_free_result($result);
		   
		?>
    </div>
   </div> 
</section>

<?php
  $sql="select nb1,nb2,nb3,nb4,nb5 from rating where ID=1";
  $result=mysqli_query($conn,$sql) or die("bad query :$sql");
  if(mysqli_num_rows($result)>0){
	$row=mysqli_fetch_assoc($result);   
	$r=$row['nb1']+2*$row['nb2']+3*$row['nb3']+4*$row['nb4']+5*$row['nb5'];
	$nb_ra=$row['nb1']+$row['nb2']+$row['nb3']+$row['nb4']+$row['nb5'];
	if($nb_ra==0)
		$b=0;
	else
	   $b=$r/$nb_ra;
	$b=number_format($b);
	
  }
  mysqli_free_result($result);
?>

<h1 class="title-feed" >customer's review </h1>
<section class="review-t" >
     <div class="reviews__average-ratings">
        <div class="average-ratings__stars">
          <div class="stars__single">
	         <i class="fas fa-star"  style="
			 <?php
			    if($b>=1)
			      echo 'color:#fd4;';
			 ?>
			 
			" ></i>
		  </div>
		  <div class="stars__single">
		     <i class="fas fa-star" style=" 
			 <?php
			    if($b>=2)
			      echo 'color:#fd4;';
			 ?>
			" ></i>
		  </div>
		  <div class="stars__single">
		     <i class="fas fa-star"  style="
			 <?php
			    if($b>=3)
			      echo 'color:#fd4;';
			 ?>
			 
			 "></i>
		  </div>
		   <div class="stars__single">
		       <i class="fas fa-star" style=" 
			   <?php
			    if($b>=4)
			      echo 'color:#fd4;';
			 ?>
			 " > </i>
		  </div>
		  <div class="stars__single">
		       <i class="fas fa-star"   style="
			   
			   <?php
			    if($b>=5)
			      echo 'color:#fd4;';
			 ?>
			    "></i>
		  </div>
		  <span class="stars__average-rating-score">
             <?php echo $b; ?> out of 5
          </span>
		</div>
	    <div class="average-ratings__total-customers">
          <?php echo $nb_ra;   ?> customer ratings
        </div>
	  </div>
	  <div class="reviews__breakdown">
        <div class="reviews-breakdown__wrapper">
          <div class="reviews__single-star-average">
            <div class="single-star-average__amount">5 star</div>
            <div class="single-star-average__progress-bar">
			<?php 
			     if($nb_ra==0)
					 $f=0;
				 else
			        $f=$row['nb5']*100/$nb_ra;
				 				 $f=number_format($f,2);
			?>
              <progress
                class="progress-bar__data"
                max="100"
                value="<?php echo $f;  ?>"
              ></progress>
            </div>
            <div class="single-star-average__percentage">
			<?php
     			  echo $f.'% ('.$row['nb5'].')';?>
				
			</div>
          </div>
		  <div class="reviews__single-star-average">
            <div class="single-star-average__amount">4 star</div>
            <div class="single-star-average__progress-bar">
			<?php
			  if($nb_ra==0)
					 $f=0;
			  else       
			     $f=$row['nb4']*100/$nb_ra;
			   $f=number_format($f,2);
			?>
              <progress
                class="progress-bar__data"
                max="100"
                value="<?php echo $f;  ?>"
              ></progress>
            </div>
            <div class="single-star-average__percentage">			<?php 
     			  echo  $f.'% ('.$row['nb4'].')';?></div>
          </div>

          <div class="reviews__single-star-average">
            <div class="single-star-average__amount">3 star</div>
            <div class="single-star-average__progress-bar">
			<?php
				if($nb_ra==0)
					 $f=0;
				 else
					$f=$row['nb3']*100/$nb_ra;
				 $f=number_format($f,2);
			
			?>
              <progress
                class="progress-bar__data"
                max="100"
                value="<?php echo $f; ?>"
              ></progress>
            </div>
            <div class="single-star-average__percentage">			<?php 
     			  echo $f.'% ('.$row['nb3'].')';?></div>
          </div>

          <div class="reviews__single-star-average">
            <div class="single-star-average__amount">2 star</div>
            <div class="single-star-average__progress-bar">
			<?php
			    if($nb_ra==0)
					 $f=0;
				 else
			  		  $f=$row['nb2']*100/$nb_ra;
				 $f=number_format($f,2);
			?>
              <progress
                class="progress-bar__data"
                max="100"
                value="<?php echo $f;   ?>"
              ></progress>
            </div>
            <div class="single-star-average__percentage">			<?php 
     			  echo $f.'% ('.$row['nb2'].')'; ?></div>
          </div>

          <div class="reviews__single-star-average">
            <div class="single-star-average__amount">1 star</div>
            <div class="single-star-average__progress-bar">
			<?php
			   if($nb_ra==0)
					 $f=0;
				 else
			  		   $f=$row['nb1']*100/$nb_ra;
				  $f=number_format($f,2);
			
			?>
              <progress
                class="progress-bar__data"
                max="100"
                value="<?php echo $f;  ?>"
              ></progress>
            </div>
            <div class="single-star-average__percentage">
						<?php 
     			  echo $f.'% ('.$row['nb1'].')'; ?></div>
          </div>
        </div>
      </div>

</section>

 <?php     
    require("includes/footer.php");
	mysqli_close($conn);
 ?>
 	 <script>
	    nb=0;
		a=document.getElementById("type1");
        function g(i){
			a.value=i;
		}	
	</script>
 <!-- speciality section ends -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
 <!-- custom js file link -->
 <script src="includes/script1.js"></script>  
</body>
</html>