<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(contact)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >

    <!-- custom css file link  -->
    
	<link rel="stylesheet" href="includes/style.css">
	<link rel="stylesheet" href="includes/style4.css">

</head>
<body>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<?php
   	session_start();
    if(isset($_POST["send"])){
	   $to= 'rana.jaafar@st.ul.edu.lb';
	   $name=$_POST["name"];
	   $email=$_POST["email"];
	   $text="You Have received an e-mail From $name \n\n". $_POST["messages"];
	   $subject="Mail from website ";
	   $headers="From: ".$email;
      // Check if email is valid and exist
	  if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
		 		   $_SESSION["SUCCESS"]="false"; 
	  }else{
            //email validation api
	    if(mail($to, $subject, $text, $headers)){
		   	$_SESSION["SUCCESS"]="true";
	    } 
        else{ 
		   $_SESSION["SUCCESS"]="false";
	   }
	 }
	echo ' <script>  window.history.back(); </script>';
    exit();	

   }
   //check  if email has been send
    if(isset($_SESSION['SUCCESS'])){
	   if($_SESSION['SUCCESS']=="truee"){
		?>
		<script>
            Swal.fire(
              'you message has been received!',
              'you can check your email!',
              'success'
            );

        </script> 
		
		<?php   
		   $_SESSION['SUCCESS']="";
	   }else if($_SESSION['SUCCESS']=="false"){
		?>
	<script>
		Swal.fire({
            icon: 'error',
             title: 'Oops...',
            text: 'Something went wrong!',
        });
    </script>
   <?php	
		   $_SESSION['SUCCESS']="";
	   }else if($_SESSION['SUCCESS']=="true"){
		    $_SESSION['SUCCESS']="truee";
			header("Location:Contact.php");
       }		   
   } 

?>
 <?php
  include("includes/connectDB.php");  
 require("includes/header.php");
 ?>
 <div class="p1" >
 <h1 class="heading1">contact <span>us</span></h1></div> 
 <section class="contact">
    <div class="contact_form">
	  <div class="carttitle" >
         <h1 class="title" >send us message</h1>
	     <hr/>
	  </div> 
     <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="POST" >
	   <input type="text" name="name" placeholder="enter your name" class="box"   required />
	   <input type="email" name="email" placeholder="enter your email" class="box"   required />
       <textarea name="messages" cols="30" rows="10" class="box" placeholder="enter your message" required ></textarea>
	   <input type="submit" name="send" value="Send message" class="buttn"   />  
	 </form>
	</div> 
 </section> 
 
 <?php      
    require("includes/footer.php");
	mysqli_close($conn);
 ?> 
 <!-- custom js file link -->
 <script src="includes/script1.js"></script>  
</body>
</html>