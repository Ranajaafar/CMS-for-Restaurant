
<?php
include("Connecting.php");
session_start();

if(!(isset($_SESSION['Sname']))){
header('location:login.php');}

?>

<header>
<h2><label for="nav-toggle">
<span class="las la-bars" id="menu-btn" style="cursor:pointer;" ></span>
</label>
Dashboard</h2>
<div class="search-wrapper">
<span class="las la-search"></span>
<input type="search" placeholder="Search here"  />
</div>
<div class="fas fa-user" id="user-btn" style="cursor:pointer;" ></div>
</header>
<nav class="navbar">
<div class="sidebar" >
<a href="#" class="logo"><div ><img src="css/images/tavola.jpg" /></div><span><h2>LaTavola</h2></span></a>
<div class="sidebar-menu">
<ul>
<li><a href="Homeadmin1" class="active"><span class="las la-igloo"></span><span>Dashboard</span></a></li>
<li><a href="Menu.php" class="active1"><span class="las la-list"></span><span>Menu</span></a></li>
<li><a href="List.php" class="active2"><span class="las la-clipboard-list"></span><span>List of items</span></a></li>
<li><a href="Extra.php" class="active3"><span class="la la-plus"></span><span>Extras</span></a></li>
<li><a href="Orders.php" class="active4" ><span class="las la-shopping-bag"></span><span>Orders</span></a></li>
<li><a href="reserve.php" class="active10" ><span class="las la-calendar" ></span><span>Reservation</span></a></li>
<li><a href="feedback.php" class="active5"><span class="las la-comment"></span><span>feedbacks</span></a></li>
<li><a href="offers.php" class="active6"><span class="las la-gift"></span><span>offers</span></a></li>
<li><a href="discount.php" class="active7"><span class="las la-percent "></span><span>discount</span></a></li>
<li><a href="currency.php" class="active8"><span class="las la-money-bill-wave-alt"></span><span>Currency</span></a></li>
<?php  
if($_SESSION['TSadmin'] == 'superAdmin'|| $_SESSION['TSadmin']=='super Admin' || $_SESSION['TSadmin']=='superadmin'|| $_SESSION['TSadmin']=='super admin'){?>
<li><a href="Adacc.php" class="active9"><span class="las la-users" ></span><span>Accounts</span></a></li>
<?php }?>
</ul>
</div>
</div>
</nav>
<div class="account-box">
<p><span>

 <?php 
 
if(isset($_SESSION['Sname'])){
  echo $_SESSION['Sname']."</br>".$_SESSION['TSadmin'];
        if($_SESSION['TSadmin']=='superAdmin'){
echo '  <span class="las la-user-plus" onclick="add();"  style="cursor:pointer;"></span>';}}
?>

<script src="js/Ascript.js"></script></span></p>


<a href="../logout.php" class="btn">logout</a></div>
</div>

