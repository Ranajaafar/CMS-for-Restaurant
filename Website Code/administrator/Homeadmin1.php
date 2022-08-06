
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>home</title>
<link rel="stylesheet" href="css/Astyle1.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
 .sidebar-menu a.active{
	background:#fff;
	padding-top:1rem;
	padding-bottom:1rem;
	color:var(--main-color);
	border-radius:30px 0px 0px 30px;

}	
.account-box.active{
margin-top:20rem;}
</style>
</head>
<body>
<?php
require("include\dashboard.php");

 

$date=date("Y-m-d");

//today orders nb

$nb_orders="SELECT count(*)as nb FROM `order_info` WHERE odate='$date' ;";
$result=mysqli_query($connect,$nb_orders) or die("bad query 1");
$row=mysqli_fetch_assoc($result);
$nbs_o=$row["nb"];

//today feedabck nb

$nb_feedback="SELECT count(*)as nb1 FROM `feedback` WHERE date='$date' ;";
$result=mysqli_query($connect,$nb_feedback) or die("bad query 2");
$row=mysqli_fetch_assoc($result);
$nbs_f=$row["nb1"];


//today Reservation nb

$nb_res="SELECT count(*)as nb2 FROM `reservation` WHERE Rdate='$date' ;";
$result=mysqli_query($connect,$nb_res) or die("bad query 2");
$row=mysqli_fetch_assoc($result);
$in=$row["nb2"];

//total income nb

$incomeT="SELECT sum(total)as sumt FROM order_info;";
$result1=mysqli_query($connect,$incomeT) or die("bad query 4");
$row1=mysqli_fetch_assoc($result1);
$inT=$row1["sumt"];

//today new item nb

$nb_newitem="SELECT count(*)as nb2 FROM `item` ;";
$result=mysqli_query($connect,$nb_newitem) or die("bad query5 ");
$row=mysqli_fetch_assoc($result);
$nbs_i=$row["nb2"];

// nb of admins nb

$nb_admins="SELECT count(*)as nb3 FROM `admin`;";
$result=mysqli_query($connect,$nb_admins) or die("bad query 6");
$row=mysqli_fetch_assoc($result);
$nbs_a=$row["nb3"];

?>


<!-- cards to show them -->


<main id="main">
<div class="cards">
<div class="card-single">

<!-- card for today feedback -->

<div>
<h1> <?php printf("%s" , $nbs_f); ?></h1>
<span>Today Feedback</span>
</div>
<div><span class="las la-users" id="u"></span>
</div>
</div>


<div class="card-single">

<!-- card for today orders -->

<div>
<h1><?php printf("%s",$nbs_o);  ?></h1>
<span>Today Orders</span>
</div>
<div><span class="las la-shopping-bag"></span>
</div>
</div>



<div class="card-single">

<!-- card for today reservation -->

<div>
<h1><?php printf("%s" , $in); ?></h1>
<span>Today Reservation</span>
</div>
<div><span class="las la-calendar" ></span>
</div>
</div>


<div class="card-single">

<!-- card for nb of item  -->

<div>
<h1><?php printf("%s" , $nbs_i); ?></h1>
<span>Item</span>
</div>
<div><span class="las la-plus cirlce" ></span>
</div>
</div>

<!-- nb of admins and total income for the super administrator only -->

<?php
if($_SESSION['TSadmin'] == 'superAdmin'){
echo "<div class='card-single'>
<div>

<h1> $nbs_a</h1>
<span>admins</span>
</div>
<div><span class='las la-user' ></span>
</div>
</div>";


echo "<div class='card-single'>
<div><h1>$inT $</h1>
<span>Total Income</span>
</div>
<div><span class='las la-wallet' ></span>
</div>
</div>";} ?>

</div>
</main>
<?php mysqli_close($connect); ?>

</body>
</html>