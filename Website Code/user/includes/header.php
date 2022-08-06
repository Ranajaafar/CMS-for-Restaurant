<?php
if(!isset($_SESSION['symbole'])){
	
	$_SESSION['symbole']="$";
    $_SESSION['equal']="1";

}
if(isset($_GET['symbole'])){
 $_SESSION['symbole']=$_GET['symbole'];
 $_SESSION['equal']=$_GET['equal'];
 echo '<script>window.location.replace(\''.$_SERVER['PHP_SELF'].'\');</script>';

}


 echo '<header>';
    echo '<a href="index.php" class="logo"><div ><img src="uploads/tavola.jpg" /></div><span>Tavola</span></a>';
    echo '<div id="menu-bar" class="fas fa-hamburger"></div>';
    echo '<nav class="navbar">';
     echo '<a  href="index.php" id="home_header" >home</a>';
    // echo '<a   onclick="window.location.replace(\'index.php#Category\');" >menu</a>';
     echo '<a  href="about.php"  " id="about_header" >about</a>';
     echo '<a  href="feedback.php" id="feedback_header" >feedback & review</a>';
     echo '<a  href="contact.php" id="contact_header" >contact</a>';
     echo '<a  href="reservation.php" id="reservation_header" >reservation</a>';
	 echo '<a  href="offer.php" id="offer_header" >offer</a>';
    echo '</nav>';
	echo '<div class="icons">';
	   echo' <div class="fas fa-heart" id="herar-btn" onclick="location.href=\'like.php\';"></div>';
	   echo' <div class="fas fa-shopping-cart" id="cart-btn" onclick="location.href=\'cart.php\';" ></div>';
	   echo'<div class="fas fa-angle-down" id="menu-btn"></div>';
	//   echo'<div class="fas fa-user" id="login-btn"></div>';

	echo '</div>';
	/*echo '<form action="" class="search-form">';fas fa-utensils
	   echo '<input type="search" placeholder="search here ..." id="serch-box"/>';
	   echo '<label for="search-box" class="fas fa-search" ></label>';
	echo '</form>';*/
	$sql="select * from currency";
	echo '<div class="item">';
	$result=mysqli_query($conn,$sql) or die("bad query :$sql");
	if(mysqli_num_rows($result)){
		while($row=mysqli_fetch_array($result)){
		    echo '<div class="box" onclick="window.location.replace(\''.$_SERVER['PHP_SELF'].'?symbole='.$row[1].'&equal='.$row[2].'\'); " ><span class="iconify"  >'.$row[0].'</span></div>';	
		}
		
	}
// this.style.color=\'rgb(255,0,64)\';	 window.location.replace(\'index.php#Category\'); this.style.textDecoration=\'underline\';
	mysqli_free_result($result);   
	echo '</div>';
/*	echo '<form action="" class="login-form">';
	   echo '<h3>login now</h3>';
	   echo '<input type="text" placeholder="your email" class="box" />';
	   echo '<input type="password" placeholder="your password" class="box" />';
	   echo '<input type="submit" value="login now" class="btn"/>';
	echo '</form>';*/
 echo '</header>';



?>
<script>
function aa(d){
	//alert("jhh");
	//d.style.width='300px';
	//d.style.color='rgb(255,0,64)';
	//alert("kk");
	d.class="active";
//	alert(d.class);
}

</script>