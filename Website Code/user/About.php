<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(About)</title>
    <!-- slider link -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	
	<!--  aos  css link -->
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >
	 
    <!-- custom css file link  -->   
	<link rel="stylesheet" href="includes/style.css">
	<link rel="stylesheet" href="includes/style5.css">

</head>
<body>
 <?php
  session_start();
  include("includes/connectDB.php");
  include("includes/header.php");
 ?>
 <div class="p1" >
 <h1 class="heading1">about <span>me</span></h1></div> 
 <section class="contact">
   <h1 class="heading">get in touch</h3>
   <div class="icons-container1">
     <div class="icons1" data-aos="zoom-in">
	  <i class="fas fa-clock"></i>
	  <h3>opening hours :</h3>
	  <p>friday [13:30-23:00]</h3>
	  <p>saturday to thursday [12:30-23:00]</p>
	 </div>
     <div class="icons1" data-aos="zoom-in">
	  <i class="fas fa-phone"></i>
	  <h3>phone :</h3>
	  <p> +961 81985959</p>
	 </div>
	 <div class="icons1" data-aos="zoom-in">
	  <i class="fas fa-envelope"></i>
	  <h3>email :</h3>
	  <p>info@latavola-lb.com</p>
	 </div>
	 <div class="icons1" data-aos="zoom-in">
	  <i class="fas fa-map"></i>
	  <h3>address :</h3>
	  <p> Beirut - Salim Slam Street </p>
	 </div>
   </div>
 
 </section>
 
 <section class="about-area" >
    <div class="row">
	   <div class="about-image" >
	     <img src="uploads/tavo.png" alt="About Us" class="img-fluid" />
	   </div>  
      <div class="content">
	    <h2 class="a">
	      <span>LET ME</span><br/>
	      <span>INTRODUCE</span><br/>
	      <span>MYSELF</span><br/>
	    </h2>
	   <p class="para">La Tavola Restaurant is the best restaurant offering different kinds of delicious and tasty meals in the middle east</p>
     </div>  
   </div>
 </section> 
 
 </section>
<section class="about" >
 <div class="flex">
  <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.3135067393255!2d35.49827218530548!3d33.88157883415289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f113c0065525d%3A0x1e452cef4cd8803e!2sLa%20Tavola!5e0!3m2!1sar!2slb!4v1616100637874!5m2!1sar!2slb"  allowfullscreen="" loading="lazy">
    </iframe>
  </div>
  <div class="image">
    <img src="uploads/res-tavoa.png" alt="" />
  </div>
 </div>
</section>

 <?php
    require("includes/footer.php");
	mysqli_close($conn);
 ?>
 
 <!-- aos js link    -->
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 
 <script>
   AOS.init({
      duration:800,
	  delay:300
   });
 </script>
 
 <!-- custom js file link -->
 <script src="includes/script1.js"></script>  
</body>
</html>