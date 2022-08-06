<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewTavola" content="width=device-width , initial-scale=1.0">
<title>adminLaTavola</title>
<link rel="stylesheet" href="css/istyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body>
<?php
include("include\connecting.php");
?>
<?php

if(isset($_SESSION['Sname'])){
  header('Location:Homeadmin1.php');
}

/*check the name and password if valid */

if(isset($_POST["submit"])){
	$filtername= filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$nameA=mysqli_real_escape_string($connect,$filtername);
	$filterpass=filter_var($_POST["pass"] , FILTER_SANITIZE_STRING);
	$passA=mysqli_real_escape_string($connect,$filterpass);
	
		
  $sql="SELECT * FROM `admin` WHERE username='$nameA' AND password='$passA';";
  $result=mysqli_query($connect,$sql) or die("bad query ");
	if(mysqli_num_rows($result)==1){
		$row=mysqli_fetch_assoc($result);
		
		/*create session for name and type */
		
		$_SESSION['Sname']=$nameA;
		$_SESSION['TSadmin']=$row['type'];
	    echo ' <script>    window.history.back(); </script>';	

}
    else { $msg="incorrect username or password !!";}
}
?>

<!-- form to add username and password -->

<section >
<div class ="form-container">
<h1>login form</h1>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
<div class="control">
   <label for="name">Name</label>
    <input type="text" name="name" class="name"  />
	</div>
	<div class="control">
	<label for="psw">Password</label>
      <input type="password" name="pass"  class="psw"  />
	  </div>
	  <div class="control">
<input type="submit" name="submit" style="cursor:pointer;" value="login" class="btn" /></div>
<div class="msg"><?php if(isset($msg)){ echo $msg;}?></div>
</form>
</div>
</section>
<?php mysqli_close($connect); ?>
</body>
</html>