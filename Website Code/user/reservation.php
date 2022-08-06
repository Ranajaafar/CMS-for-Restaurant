
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(Reservation)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >

    <!-- custom css file link  -->
    <link rel="stylesheet" href="includes/style.css">
	<link rel="stylesheet" href="includes/style_reservation.css">

</head>
<body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<?php
	include("includes/connectDB.php");
	session_start();
   if(isset($_POST["reserve"])){
	   $fname= trim(filter_var($_POST["fname"], FILTER_SANITIZE_STRING));
	   $lname= trim(filter_var($_POST["lname"], FILTER_SANITIZE_STRING));
	   $phone= trim(filter_var($_POST["phone"], FILTER_SANITIZE_STRING));
	
	   if (preg_match('/^\d{8}$/', $phone)){
           
    
         $guest= trim(filter_var($_POST["count"], FILTER_SANITIZE_NUMBER_INT ));
         $dater= $_POST["date"];
	
	     $rtime= $_POST["time"];
	     /*check if already exist */
	     $sqlcheck="SELECT * FROM `reservation` WHERE firstname='$fname' AND Lastname='$lname' AND phonenumber='$phone' AND guestnb='$guest' AND Rdate='$dater' AND time='$rtime';";
	     $resultcheck=mysqli_query($conn,$sqlcheck) or die("bad query");
	     if(mysqli_num_rows($resultcheck)==0){
	
		         /* chosen time + 1 hour */
	          $rtime_plus1=$rtime+1;
	 
	          /*chosen time - 1 hour */
	 
	           $rtime_minus1=$rtime-1;
	 
	          /* one week from now */
	  
	         $weekfromnow=date("Y-m-d", strtotime("+1 week"));
	
	         /* nb of table from database */
	
	         $sql="SELECT tablenb,chairnb FROM `restaurant_info`; ";
	         $result=mysqli_query($conn,$sql) or die("bad query");
	         $row=mysqli_fetch_assoc($result);
             $totalnb=$row["tablenb"];
             $nbC=$row["chairnb"];

	         /*check if today is friday */
	  
	         $date=date("Y-m-d");
	         $day= date('w', strtotime($dater));
	         if($day==5 && $rtime==13){
		          //friday
	            $_SESSION["message"]="Sorry, You can't book at this time";
	         }else{
                if($dater>=$date && $dater<=$weekfromnow){
                    $j=0;
                    $i1=0;
                    do{
	                     $j+=$nbC;
                         $i1++;
                    }while($j<$guest);
		           $sql="SELECT * from `reservation` WHERE Rdate='$dater';";
		           $result=mysqli_query($conn,$sql) or die("bad query 1");

	               if(mysqli_num_rows($result)>0){
                      //  echo "true";
						
						
						$sqlt="SELECT guestnb as sumcount from `reservation` WHERE time='$rtime_minus1'  AND Rdate='$dater' ;";
		                $result1=mysqli_query($conn,$sqlt) or die("bad query 2");
						$nbs=0;
						while(($row=mysqli_fetch_assoc($result1))){
							$n=$row['sumcount'];
							$j=0;
                            $i=0;
                            do{
	                            $j+=$nbC;
                            	$i++;
                            }while($j<$n);
							$nbs+=$i;		
						}
												//	echo $nbs."<br/>";

	                    if($nbs<=($totalnb-$i1)){
					       $sqlt1="SELECT guestnb as sumcount1 from `reservation`  WHERE time= '$rtime' AND Rdate='$dater';";
					       $result2=mysqli_query($conn,$sqlt1) or die("bad query 3");
						   $nbst1=0;
						   while(($row=mysqli_fetch_assoc($result2))){
							  $n=$row['sumcount1'];
							 // echo $n;
							  $j=0;
                              $i=0;
                              do{
	                             $j+=$nbC;
                            	 $i++;
                             }while($j<$n);
							 $nbst1+=$i;
						   }
						//    echo $nbst1."<br/>";

				           if($nbst1<=($totalnb-$i1)){
					            $sqlt2="SELECT guestnb as sumcount2 from `reservation`  WHERE time= '$rtime_plus1'  AND Rdate='$dater';";
					            $result3=mysqli_query($conn,$sqlt2) or die("bad query 4");
						        $nbst2=0;
						        while(($row=mysqli_fetch_assoc($result3))){
							         $n=$row['sumcount2'];
							         $j=0;
                                     $i=0;
                                     do{
	                                   $j+=$nbC;
                            	       $i++;
                                     }while($j<$n);
							         $nbst2+=$i;
						        }
														//	 echo $nbst2;

					            if($nbst2<=($totalnb-$i1)){

					               $sqlI="INSERT INTO `reservation` (firstname,Lastname,phonenumber,guestnb,Rdate,time) VALUES ('$fname','$lname','$phone','$guest','$dater' ,'$rtime');";
				                    $insert=mysqli_query($conn,$sqlI) or die("bad query 5");
				                    $_SESSION["message"]="Reservation booked succcefully";
			                    }
			                     else{
			                         $_SESSION["message"]="Sorry, You can't book at this time";}
				            }
				             else{
					            $_SESSION["message"]="Sorry, You can't book at this time";}
				        }
				         else {
			               $_SESSION["message"]="Sorry, You can't book at this time";}
				  }
			       else{
					     echo $totalnb;
						 if($i1<=$totalnb){
				           $sqlI="INSERT INTO `reservation` (firstname,Lastname,phonenumber,guestnb,Rdate,time) VALUES ('$fname','$lname','$phone','$guest','$dater' ,'$rtime');";
				           $insert=mysqli_query($conn,$sqlI) or die("bad query 6");
				           $_SESSION["message"]="Reservation booked succcefully";
						 }else{
			                $_SESSION["message"]="Sorry, You can't book at this time";}
 
                    }
			 }
              else{
	             $_SESSION["message"]="Only, You can book between one week from now";
 
               }


            }
     }
   }
  	echo ' <script> window.history.back(); </script>';	
    exit;
 
  }
 
 
 
 if(isset($_SESSION['message'])){
	 if($_SESSION["message"]==""){}
	 else {
	   if($_SESSION['message']=="Sorry, You can't book at this time" || $_SESSION['message']=="Only, You can book between one week from now"
	   ){
		?>
		<script>
            Swal.fire(
              {
            icon: 'error',
             title: 'Oops...',
            text: 'Sorry, You can\'t book at this time!\n AND Only, You can book between one week from now',
        }
            );

        </script> 
		



		
 <?php
     $_SESSION["message"]="";
 }
  else{
	 if ($_SESSION['message']=="Reservation booked succcefully")
	   $_SESSION["messagesu"]=$_SESSION["message"];
       $_SESSION["message"]="";	   
	   header('Location:reservation.php');
	   exit;
	 }

    
 		 
  }
}


 if(isset($_SESSION["messagesu"])) {
  if($_SESSION["messagesu"]==""){
  }else{
		?>
		<script>
            Swal.fire(
             'Reservation booked succcefully!',
        
            );

        </script> 
		
 <?php
 $_SESSION['messagesu']="";
	 }
	 }

  	require("includes/header.php");

 
 ?>
 
	
	


  <div class="p1" >
 <h1 class="heading1">About <span>Reservation</span></h1></div> 

<div class="container center" >
    <div class="card">
        <div class="row">
            <form class="col s12" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                <div class="row">
                    <div class="input-field col s6">
					 
                        <input name="fname" type="text" required  class="validate" value="" size="1.1rem" placeholder="First Name" >
                       
                    </div>
                    <div class="input-field col s6">
					
                        <input id="last_name" name="lname"  type="text" required class="validate" value="" placeholder="Last Name">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
					
                        <input id="phone" name="phone" type="tel" required class="validate" value="" placeholder="Phone number 8 digits" >
                        
                    </div>
                    <div class="input-field col s6">
					   
                        <input id="count" name="count" type="number" required  class="validate" value="" min="1" Placeholder="Number of Guest">
                     
                    </div>
                </div>
                <div class="row ">
                    <div class="input-field col s6 d1">
					 
                        <input name="date" id="date" type="date" required class="validate" value="">
                       <label for="date">Date</label>
                    </div>
                    <div class="input-field col s6 d1">
					    
                        <select name="time" id="from">
    
    <option value="13">1:00 PM</option>
    <option value="14">2:00 PM</option>
    <option value="15">3:00 PM</option>
    <option value="16">4:00 PM</option>
    <option value="17">5:00 PM</option>
    <option value="18">6:00 PM</option>
    <option value="19">7:00 PM</option>
    <option value="20">8:00 PM</option>
    <option value="21">9:00 PM</option>
	<option value="22">10:00 PM</option>
	<option value="23">11:00 PM</option>
	
  </select>
                      <label for="time">Time</label>
                    </div>
                </div>
                <button class="waves-effect waves-light btn" name="reserve" type="submit">Reserve</button>
            </form>
        </div>
    </div>
</div>

<?php     
   require("includes/footer.php");
	mysqli_close($conn);
 ?>


</script> 
<!-- speciality section ends -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link -->
<script src="includes/script1.js"></script>  

</body>
</html>