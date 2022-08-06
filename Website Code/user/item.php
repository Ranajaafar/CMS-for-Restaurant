<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(items)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	
	<!--  aos  css link -->
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	 
    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >
	 
    <!-- custom css file link  -->
    <link rel="stylesheet" href="includes/style.css">
	<link rel="stylesheet" href="includes/style1.css">

</head>
<body>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<?php 
    session_start();
    if(isset($_COOKIE['nb'])){
		$nb=$_COOKIE['nb'];
	}else{
		$nb=0;
		setcookie('nb',$nb,(time()+(60*60*24*3)));
 	}
	
	 if(isset($_GET["id"])){
		  $_SESSION["item"]=$_GET["id"];
		  header('Location:item8.php');
	 }
	 
    if(isset($_COOKIE['nb1'])){
		$nb1=$_COOKIE['nb1'];
	}else{
		$nb1=0;
	    setcookie('nb1',$nb1,(time()+(60*60*24*3)));
 	}
	
    if(isset($_SESSION["PRODUCT"])){
	   include("includes/connectDB.php");
	   $id=$_SESSION["PRODUCT"];

	   $sql="select cat_name from category where cat_id=$id";
       $result=mysqli_query($conn,$sql) or die("bad query :$sql");
	   if(mysqli_num_rows($result)==0){
	      mysqli_close($conn);
	      exit;
	   }
	   $row1=mysqli_fetch_array($result);
	   mysqli_free_result($result);
	   require("includes/header.php");
	  
?>	
<section class="product" >
    <h1 class="heading1" >Product of <span><?php   echo $row1[0]; ?></span></h1>
	    <?php
		   
		  	  $sql="select PID,PNAME,DESCRIPTION,price,offer_id from item where CAT_ID=$id";
              $result=mysqli_query($conn,$sql) or die("bad query :$sql");
		      if($result){
                 while(	$row1=mysqli_fetch_array($result)){
			       echo '<fieldset align=center class="r" >';
					 
			         echo ' <legend>'.$row1[1].'</legend>';
					  $sql="select photo_path from photo where pid=$row1[0]";
                      $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		              if(mysqli_num_rows($result1)>0){
						  	$row2=mysqli_fetch_array($result1);
						    echo ' <img src="uploads/'.$row2[0].'" alt="" align=left id="hg" ></img> '; 
						   
					  }	
                       mysqli_free_result($result1);					  
				       echo '<div class="description">';
                           echo '<h3>Description</h3>';
						   echo '<div>'.$row1[2].'</div>';
						echo '</div>';
					    $j=0;
					    for($i=0;$i<$nb1;$i++,$j++){
						   while(!isset($_COOKIE['like'.$j])){
							   $j++;
						   }
                           $a=$_COOKIE['like'.$j];
						   if((int)$a==$row1[0]){
							   break;
						   }   						   
					   }
					    echo '<div class="icons1" >';
						 if($i==$nb1){
						   echo '<a  class="fas fa-heart" onclick="g(this,'.$row1[0].');" />';
						   echo '<span  id="heart" style="display:none;" >false:j</span>';
					     }else{
							   echo '<a  class="fas fa-heart" style="color:rgb(255,25,25);" onclick="g(this,'.$row1[0].');" />';
							   echo '<span  id="heart" style="display:none;" >true:'.$j.'</span>';
						 }  echo '<a href="'.$_SERVER["PHP_SELF"].'?id='.$row1[0].'" class="fas fa-eye"  id="eye" />';

					    echo '</div>';
 	                  $sql="select * from have h where cat_id=$id ";
                      $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		              if(mysqli_num_rows($result1)==0){
						echo '<a class="btn" id="addToCart" onclick="f(this,'.$row1[0].');"  >add to cart</a>';
					  }else
                    		echo '<a class="btn" id="addToCart" onclick="f1(this,'.$row1[0].');"  >add to cart</a>';
                       mysqli_free_result($result1);	
                       					   
						echo '<div class="quantity">';
						  echo '<span>quantity: </span><br/>';
						  echo '<input type="number" min="1"  value="1" />';
					   echo '</div>';
					   $j=0;
					   $b="";
					   $total="";
					   for($i=0;$i<$nb;$i++,$j++){
						   while(!isset($_COOKIE['add'.$j])){
							   $j++;
						   }
                           $a=$_COOKIE['add'.$j];
						   $c=explode(':',$a); //comme split in javasc
						   if((int)$c[0]==$row1[0]){
							   if(isset($c[2])){
								   //ffff
								   if($total!="")
									   $total=$total."_";
								   $total=$total."add".$j.':'.$c[1].':'.$c[2];
							   }else{
								   $j1=$j;
								   $b=$c;
							   }
							   
						   }
                           						   
					   }
					   if($total!=""){
						  echo '<span class="esists1" style="visibility:visible; display:none;" >'.$total.'</span>';
					   }else{
						   echo '<span class="esists1" style="visibility:hidden; display:none;" >'.$total.'</span>'; 
					   }
                       if($b!=""){	
					     $x="exists ".$b[1]."Qt";
						 echo '<span class="esists" style="visibility:visible;" >'.$x.'</span>';
						 $x='add'.$j1.':'.$b[1];
                       }else{
                         $x="";						   
					     echo '<span class="esists" style="visibility:hidden" ></span>';
					   } 
					    echo '<span style="display:none;" id="user" >'.$x.'</span>';
						if($row1[4]!=""){
							 $sql="select discount from offer where offer_id=".$row1[4];
                             $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		                     if($row2=mysqli_fetch_array($result1)){
		        			      $b=$row1[3]-$row1[3]*$row2[0]/100;
								  $b=$b*$_SESSION['equal'];
							       $row1[3]=$row1[3]*$_SESSION['equal'];
                                  echo '<div class="price" > '.$b.' '.$_SESSION['symbole'].' <span>'.$row1[3].' '.$_SESSION['symbole'].' </span>';
						  
							 }
						    mysqli_free_result($result1);					  		 
                            
						}else{
							  $row1[3]=$row1[3]*$_SESSION['equal'];
							 echo '<div class="price" > '.$row1[3].' '.$_SESSION['symbole'];
						}
			           $sql="select e.name,e.price,e.id_extra from have h,extra e where cat_id=$id and e.id_extra=h.id_extra";
                      $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		              if(mysqli_num_rows($result1)>0){
						    echo '<select id="menu" ><option selected value="" >chosse extra</option>';
						  	while($row2=mysqli_fetch_array($result1)){
							echo'<option value="'.$row2[2].'" >'.$row2[0].' ('.$row2[1].') </option>';	
                            }
							echo '</select>';
                      }
					  mysqli_free_result($result1);
                     echo '</div>';	 
                     echo "</fieldset>"; 
                     					 
			     }		 
	          }
			   $test="<script>	window.sessionStorage.setItem(\"nb\",".$nb."); </script>";	
                echo $test;
                $test="<script>	window.sessionStorage.setItem(\"nb1\",".$nb1."); </script>";	
                echo $test;
			    mysqli_free_result($result);
			  $test="";
			  $j=0;
		      echo '<script> Array_of_cart=new Array(0); </script>';			  
		      for($i=0;$i<$nb;$i++,$j++){
				  while(!isset($_COOKIE['add'.$j])){
					    if($test!=""){
							$test=$test.":";
						}	
						$test=$test.$j;
						$j++;
				  }
			     echo '<script> Array_of_cart['.$i.']="'.$j.'_'.$_COOKIE['add'.$j].'"; </script>';			
				  
			  }	  
	         echo '<span style="display:none;" id="add" >'.$test.'</span>';  
              $test="";
			  $j=0;
		     echo '<script> Array_of_like=new Array(0); </script>';			  
		      for($i=0;$i<$nb1;$i++,$j++){
				  while(!isset($_COOKIE['like'.$j])){
					    if($test!=""){
							$test=$test.":";
						}	
						$test=$test.$j;
						$j++;
				  }
		         echo '<script> Array_of_like['.$i.']="'.$j.'_'.$_COOKIE['like'.$j].'"; </script>';
				  
			  }
	         echo '<span id="like" >'.$test.'</span>';  			  
			 
		 ?>
</section> 
<script src="https://kit.fontawesome.com/71d86ae8e0.js" crossorigin="anonymous"></script>
<?php	
      mysqli_close($conn);
    }
    else{
	  header('Location: index.php');
	  exit;
	}
?>
<!-- header section starts  -->
 <script>
 function g(x,y){
   z=x.parentNode;
   a=z.querySelectorAll("#heart");
   b=a[0].innerHTML.split(':'); 
   nb1=sessionStorage.getItem("nb1");
   like=document.querySelectorAll("#like");   
   if(b[0]=="true"){
	        n=b[1];

	        document.cookie="like"+n+"="+y+";max-age=-60"; 
	        a[0].innerHTML="false:j";   
     	    x.style.color='#130f40';
			if((like[0].innerHTML)==""){
				like[0].innerHTML=n+"";
			}else{	
              like[0].innerHTML=(like[0].innerHTML)+":"+n;
			} 

            document.cookie='nb1='+(parseInt(nb1)-1)+";max-age="+(60*60*24*3);
	        window.sessionStorage.setItem("nb1",(parseInt(nb1)-1));	
			
            Array1=new Array();
			j=0;
			for(i=0;i<Array_of_like.length;i++){
				c=Array_of_like[i];
				string=c.split('_');
				if(string[0]!=n){
					Array1[j++]=Array_of_like[i];
					document.cookie='like'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

				}	
			}
			Array_of_like=Array1;	
			
   }else{
		if(like[0].innerHTML!="")
		{
			   text=((like[0].innerHTML).split(":"));			  
			   r=text[0];
			     str=r.length;
			   if(str==((like[0].innerHTML).length))
				    like[0].innerHTML="";
				else
			      like[0].innerHTML=(like[0].innerHTML).substr(str+1);
			  
		}else
          r=nb1;
	   document.cookie="like"+r+"="+y+";max-age="+(60*60*24*3); 
	   a[0].innerHTML="true:"+r;
	   document.cookie='nb1='+(parseInt(nb1)+1)+";max-age="+(60*60*24*3);
	   window.sessionStorage.setItem("nb1",(parseInt(nb1)+1));
	   x.style.color='rgb(255,25,25)';
	         
	  for(i=0;i<Array_of_like.length;i++){
		c=Array_of_like[i];
		string=c.split('_');
		document.cookie='like'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

	  }
	  Array_of_like[Array_of_like.length]=r+"_"+y;

	  
   }

 }	 

function f(x,w){
	      	 

   z=x.parentNode;
   b1=z.querySelectorAll("input");
   b=(b1[0].value);
   e=z.querySelectorAll("#user");
   if(!parseInt(b)){
	   alert("problem");
	   exit;
   }
   nb=sessionStorage.getItem("nb");

   if(parseInt(b)>0){	    //true mafrud
        d=z.querySelectorAll(".esists");
       let style=window.getComputedStyle(d[0]);

	   if(style.visibility=="hidden"){
            add=document.querySelectorAll("#add");

			if(add[0].innerHTML!="")
			{
		       text=((add[0].innerHTML).split(":"));			  
			   r=text[0];
			   str=r.length;
			   if(str==((add[0].innerHTML).length))
				    add[0].innerHTML="";
				else
			      add[0].innerHTML=(add[0].innerHTML).substr(str+1);
			  
			}else{
              r=nb;	
            }			  
		    document.cookie='add'+r+"="+w+":"+b+";max-age="+(60*60*24*3);
			document.cookie='nb='+(parseInt(nb)+1)+";max-age="+(60*60*24*3);;
		    window.sessionStorage.setItem("nb",(parseInt(nb)+1));
			d[0].style.visibility="visible";
			d[0].innerHTML="exists "+b+"QT";
			e[0].innerHTML="add"+r+":"+b;
			
						
			 for(i=0;i<Array_of_cart.length;i++){
		        c=Array_of_cart[i];
		        string=c.split('_');
		        document.cookie='add'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

	         }
	          Array_of_cart[Array_of_cart.length]=r+"_"+w+":"+b;
	   
			
	   }else{

		    y=e[0].innerHTML.split(":");
			e[0].innerHTML=y[0]+":"+(parseInt(b)+parseInt(y[1]));
			d[0].innerHTML="exists "+(parseInt(b)+parseInt(y[1]))+"QT";
		    document.cookie=y[0]+"="+w+":"+(parseInt(b)+parseInt(y[1]))+";max-age="+(60*60*24*3);
			
		    document.cookie='nb='+(parseInt(nb))+";max-age="+(60*60*24*3);
			n= (y[0].substr(3));
			for(i=0;i<Array_of_cart.length;i++){
				c=Array_of_cart[i];
				string=c.split('_');
				if(string[0]!=n){
					document.cookie='add'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

				}else
                    Array_of_cart[i]=string[0]+"_"+w+":"+(parseInt(b)+parseInt(y[1]));				
			}
	   } 
		Swal.fire({
            position: 'top-end',
             icon: 'success',
            title: 'added to cart successfully',
            showConfirmButton: false,
            timer: 1500
        });
        b1[0].value=1;		
   }else{
	   alert("problem");
	   exit;
   } 	   
	   
}	 
</script>
<script>
 function f1(x,y){
	 z=x.parentNode;
	 w=z.querySelector("#menu");
	 b1=z.querySelectorAll("input");
     b=(b1[0].value);
	 if(!parseInt(b)){
	   alert("problem");
	   exit;
     } 
	 
     if(parseInt(b)>0){	
       if(w.options[w.selectedIndex].value){
		   d=z.querySelectorAll(".esists1");
           let style=window.getComputedStyle(d[0]);
	       if(style.visibility=="hidden"){
			 nb=sessionStorage.getItem("nb");
			 add=document.querySelectorAll("#add");

			 if(add[0].innerHTML!="")
			 {
		       text=((add[0].innerHTML).split(":"));			  
			   r=text[0];
			   str=r.length;
			   if(str==((add[0].innerHTML).length))
				    add[0].innerHTML="";
				else
			      add[0].innerHTML=(add[0].innerHTML).substr(str+1);
			  
			 }else{
               r=nb;	
             }			  
			 document.cookie='add'+r+"="+y+":"+b+":"+w.options[w.selectedIndex].value+";max-age="+(60*60*24*3);
			 document.cookie='nb='+(parseInt(nb)+1)+";max-age="+(60*60*24*3);;
		     window.sessionStorage.setItem("nb",(parseInt(nb)+1));
			 d[0].style.visibility="visible";
			 d[0].innerHTML='add'+r+":"+b+":"+w.options[w.selectedIndex].value;
			 
			  for(i=0;i<Array_of_cart.length;i++){
		        c=Array_of_cart[i];
		        string=c.split('_');
		        document.cookie='add'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

	         }
	         Array_of_cart[Array_of_cart.length]=r+"_"+y+":"+b+":"+w.options[w.selectedIndex].value;
	
		   }else{
			     text=((d[0].innerHTML).split("_"));
				 total=""
				 done=0;
				 for(i=0;i<text.length;i++){
					 text2=text[i].split(":");
				     if(total!=""){
						 total=total+"_";
					 }
					 if(text2[2]==w.options[w.selectedIndex].value)
					 {
                        document.cookie=text2[0]+"="+y+":"+(parseInt(b)+parseInt(text2[1]))+":"+w.options[w.selectedIndex].value+";max-age="+(60*60*24*3);
                        total=total+text2[0]+":"+(parseInt(b)+parseInt(text2[1]))+":"+text2[2];
			            done=1;
						
												
						n= (text2[0].substr(3));
			            for(i=0;i<Array_of_cart.length;i++){
			             	c=Array_of_cart[i];
			            	string=c.split('_');
			            	if(string[0]!=n){
			             		document.cookie='add'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

			            	}else
                                Array_of_cart[i]=string[0]+"_"+y+":"+(parseInt(b)+parseInt(text2[1]))+":"+w.options[w.selectedIndex].value;				
			           }
					       nb=sessionStorage.getItem("nb");
                              document.cookie='nb='+(parseInt(nb))+";max-age="+(60*60*24*3);;

					 }else{

                         total=total+text[i];
					 }						 
				 }
				 if(done==1){
					 
				 }else{
					 nb=sessionStorage.getItem("nb");
			         add=document.querySelectorAll("#add");

			         if(add[0].innerHTML!="")
			         {
		                text=((add[0].innerHTML).split(":"));			  
			            r=text[0];
			            str=r.length;
			            if(str==((add[0].innerHTML).length))
			              	    add[0].innerHTML="";
			        	else
			                add[0].innerHTML=(add[0].innerHTML).substr(str+1);
			  
			          }else{
                           r=nb;	
                       }			  
			           document.cookie='add'+r+"="+y+":"+b+":"+w.options[w.selectedIndex].value+";max-age="+(60*60*24*3);
			           document.cookie='nb='+(parseInt(nb)+1)+";max-age="+(60*60*24*3);;
		               window.sessionStorage.setItem("nb",(parseInt(nb)+1));
					   total=total+"_";
					   total=total+'add'+r+":"+b+":"+w.options[w.selectedIndex].value;
					   
					   	for(i=0;i<Array_of_cart.length;i++){
		                   c=Array_of_cart[i];
		                   string=c.split('_');
		                   document.cookie='add'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

	                   }
	                   Array_of_cart[Array_of_cart.length]=r+"_"+y+":"+b+":"+w.options[w.selectedIndex].value;
		
				 }
				 d[0].innerHTML=total; 

		   }
			Swal.fire({
                       position: 'top-end',
                       icon: 'success',
                       title: 'added to cart successfully',
                       showConfirmButton: false,
                       timer: 1500
            });  
            b1[0].value=1; 
            w.selectedIndex=0;				
	    }else 
		    f(x,y);
    }else{
       alert("problem");
	   exit; 
    }		
 } 

</script>
 <?php
          
    require("includes/footer.php");
 ?>


 <!-- custom js file link -->
<script src="includes/script1.js"></script>  
  
 <!-- aos js link    -->
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 
 <script>
   AOS.init({
      duration:800,
	  delay:300
   });
 </script>
 
 
 </body>
 </html>