<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(Checkout)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >

	<!--  aos  css link -->
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="includes/checkout.css">
</head>
<body>
 <?php
  session_start();
  if(!isset($_COOKIE['nb'])){
   header('Location:index.php');
   exit;
  }
  $nb=$_COOKIE['nb']; 
  if($nb==0){
    header('Location:index.php');
    exit; 
  }  
  include("includes/connectDB.php");
  if(isset($_SESSION['TOTAL'])){
     if($_SESSION['TOTAL']==""){
	      header('Location:cart.php');
          exit; 
	 }
  }else{
	      header('Location:cart.php');
          exit;
  }  
  if(isset($_POST["placeOrder"])){
     $sql="start transaction;";
	 $result=mysqli_query($conn,$sql) or die("bad query :$sql");
     $sql="INSERT INTO `tavola`.`customer` (`cname`, `ctel`, `cemail`, `country`) VALUES ('".$_POST["Fname"]." ".$_POST["Lname"]."', '".$_POST["phone"]."', '".$_POST["email"]."', '".$_POST["country"]."');";
	 $result=mysqli_query($conn,$sql) or die("bad query :$sql");
	 $sql="select max(cid) from customer";
	 $result=mysqli_query($conn,$sql) or die("bad query :$sql");
     $row=mysqli_fetch_array($result);
	 if(isset($_SESSION["unicode"])){
	    // exit;
		$sql="select dis_id from discount where unicode='".$_SESSION["unicode"]."'";
        $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		if($row2=mysqli_fetch_array($result1)){
			 $sql="INSERT INTO `tavola`.`order_info` (`oaddress`, `odate`, `dis_id`, `cid`,`total`) VALUES ('".$_POST["address"]."', DATE(NOW()) ,'".$row2[0]."', '".$row[0]."',".$_SESSION['TOTAL'].");"; 
	    }else{
			$sql="INSERT INTO `tavola`.`order_info` (`oaddress`, `odate`, `cid`,`total`) VALUES ('".$_POST["address"]."', DATE(NOW()),'".$row[0]."',".$_SESSION['TOTAL'].");";		
	    }
	}else
	 $sql="INSERT INTO `tavola`.`order_info` (`oaddress`, `odate`, `cid`,`total`) VALUES ('".$_POST["address"]."', DATE(NOW()),'".$row[0]."',".$_SESSION['TOTAL'].");";		
	 $result=mysqli_query($conn,$sql) or die("bad query :$sql");
	 $sql="select max(oid) from order_info";
	 $result=mysqli_query($conn,$sql) or die("bad query :$sql");
     $row=mysqli_fetch_array($result);	 
	 $j=0;
	 for($i=0;$i<$nb;$i++,$j++){
			while(!isset($_COOKIE['add'.$j])){
				   $j++;
			}
            $a=$_COOKIE['add'.$j];
		    $c=explode(':',$a); //comme split in javasc
			if(isset($c[2])){
					$sql="INSERT INTO contain VALUES(".$row[0].",".$c[0].",".$c[2].",".$c[1].");";							  
			}else{
				$sql="INSERT INTO contain VALUES(".$row[0].",".$c[0].",1,".$c[1].");";			
			}
            $result=mysqli_query($conn,$sql) or die("bad query :$sql");
            setcookie("add".$j,"",time()-30);
							   
                           						   
	}
    $sql="commit;";
	$result=mysqli_query($conn,$sql) or die("bad query :$sql");
	setcookie("nb",0,time()+(60*60*24*3));
	$_SESSION['succes']='true';
	$name=$_POST["Fname"]." ".$_POST["Lname"];
	$email=$_POST["email"];
	$text="You Have received an e-mail From $name \n\n"."you order has been received";
	$subject="Mail from website";
	$headers="From: ".$email;
    $to= 'rana.jaafar@st.ul.edu.lb';

      // Check if email is valid and exist
	 if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
	 }else{
            //email validation api
	    if(mail($to, $subject, $text, $headers)){

	    } 
        else{ 
		
	    }
	 }
   // header('Location:index.php');
	echo ' <script>    window.history.back(); </script>';	
    exit;
  }
  if(isset($_SESSION['succes'])){
     if($_SESSION['succes']=="true"){
	       header('Location:index.php');
            $_SESSION["TOTAL"]="";		   
            exit;		   
	 }
  }
  //mysqli_close($conn); 
 ?>
     					

</body>
</html>
<div class="container d-flex justify-content-center ">      
        <div class="col-md-8 col-sm-11 ">
             <h1 class="bllingDetails  ">Billing Details</h1>
            <form method="post"  action="<?php  echo $_SERVER['PHP_SELF']; ?>" id=form>

                 <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-sm-3">  
                            <label class="form-label"><b>Name<div id="etoile" >*</div></b></label>
                        </div>
                        <div class="col-4">
                            <input name="Fname" type="text" class="form-control" placeholder="First name" aria-label="First name" required>
                        </div>
                        <div class="col-4">
                            <input name="Lname" type="text" class="form-control" placeholder="Last name" aria-label="Last name" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-sm-3">  
                             <label class="form-label"><b>Country<div id="etoile" >*</div></b></label>
                        </div>
                        <div class="col-4">
                            <select name="country" class="form-select" aria-label="Default select example">
                                <option selected>Lebanon</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-sm-3">  
                             <label for="inputAddress" class="form-label"><b>Address<div id="etoile" >*</div></b></label>
                        </div>
                        <div class="col">
                             <input type="text" name="address" class="form-control" id="inputAddress" required >
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row ">
                        <div class="col-md-4 col-sm-3">  
                          <label for="exampleInputEmail" class="form-label"><b>Email address<div id="etoile" >*</div></b></label>
                        </div>
                        <div class="col">
                             <input name="email" type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" >
                             <div id="emailHelp" class="form-text">We'll inform you about the tracking informations via Email or mobile number.</div>
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-sm-3">  
                             <label class="form-label"><b>Mobile Number<div id="etoile" >*</div></b></label>
                        </div>
                        <div class="col-4">
                             <input  name="phone" type="text" class="form-control" id="inputAddress" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                      <p class="cond">Your personal data will be used to process your order and support your experience throughout this website.</p>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    <label class="form-check-label" for="exampleCheck1">I have read and agree to the website <b>terms and conditions *</b></label>
                </div>

                <input type="submit" class="btn btn-primary" name="placeOrder" value="Place Order" />
            </form>
        </div>
</div>