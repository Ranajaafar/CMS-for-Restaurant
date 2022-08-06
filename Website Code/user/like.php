<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(like)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	
    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >

    <!-- custom css file link  -->
    <link rel="stylesheet" href="includes/style.css">
	<link rel="stylesheet" href="includes/style3.css">

</head>
<body>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<?php
	session_start();
    include("includes/connectDB.php");
	
    if(isset($_COOKIE['nb1'])){
	  $nb1=$_COOKIE['nb1'];  //nb of like
	}else{
		$nb1=0;
		setcookie('nb1',$nb1,(time()+(60*60*24*3)));
 	}
	
	if(isset($_GET["id"])){
		  $_SESSION["item"]=$_GET["id"];
		  header('Location:item8.php');
	}
	
    if(isset($_COOKIE['nb'])){
		$nb=$_COOKIE['nb'];
	}else{
		$nb=0;
		setcookie('nb',$nb,(time()+(60*60*24*3)));
 	}
	
	require("includes/header.php");
		
    $test="<script>	window.sessionStorage.setItem(\"nb\",".$nb."); </script>";	
    echo $test;

?>
<section class="likeItem"  >
  <div class="p1">
    <h1 class="heading1" >your <span>wishelist</span></h1></div>
<?php 	
  $n=3;
  $rd=0;  
  if($nb1>12){
	$n=(int)($nb1/4);
    $rd=$nb1%4;	
  }
  $j=0;
  $k=0;
  $ligne=0;
  $nbr=$nb1;
  echo '<script> Array_of_like=new Array(0); </script>';			  
  for($i=0;$i<$nb1;$i++,$j++){
	  while(!isset($_COOKIE['like'.$j])){
		   $j++;
     }
	 if($k==0){
        echo '<div class="swiper cat-slider" >';
        echo     '<div class="swiper-wrapper" >'; 
		$d=0;
	 }	 
     $a=$_COOKIE['like'.$j];
	 $sql="select PNAME,DESCRIPTION,price,offer_id,rat_id,cat_id from item where PID=$a";
     $result=mysqli_query($conn,$sql) or die("bad query :$sql");
	  if(mysqli_num_rows($result)==0){
		  setcookie('like'.$j,"",time()-30);
		  $nbr=$nbr-1;
		  setcookie('nb1',$nbr,(time()+(60*60*24*3)));
          mysqli_free_result($result);  
		  continue;
	  }
	  
	  echo '<script> Array_of_like['.$i.']="'.$j.'_'.$a.'"; </script>';

	  $row1=mysqli_fetch_array($result);
      mysqli_free_result($result);  
	  echo '<div class="swiper-slide box" >';
	    if($row1[3]){
			 $sql="select discount from offer where offer_id=".$row1[3];
             $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		     if($row2=mysqli_fetch_array($result1)){
			     echo '<div class="discount"  > -'.$row2[0].'%</div>'; 
			 }
		     mysqli_free_result($result1);  

	    }    
		 echo '<div class="iconslike" >';
			echo '<a  class="fas fa-heart" style="color:rgb(255,25,25);" onclick="g(this,'.$j.','.$a.');" ></a>';
            echo '<a href="'.$_SERVER["PHP_SELF"].'?id='.$a.'" class="fas fa-eye" ></a>';
		 echo '</div>'; 
         $sql="select photo_path from photo where pid=$a";
         $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
	     if($row2=mysqli_fetch_array($result1)){
              echo '<img src="uploads/'.$row2[0].'"  alt="" ></img>';
		 }	
          mysqli_free_result($result1);					  
		  echo '<h3>'.$row1[0].'</h3>';
		 $sql="select nb1,nb2,nb3,nb4,nb5 from rating where id=".$row1[4];
	     $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
	     if($row2=mysqli_fetch_array($result1)){
		   $total=$row2[0]+$row2[1]+$row2[2]+$row2[3]+$row2[4];
		   $max=$row2[0]+$row2[1]*2+$row2[2]*3+$row2[3]*4+$row2[4]*5;
		   if($total!=0)
		     $b=($max/$total);
		   else
			   $b=0;
	       $b=number_format($b); 
	 
	?>
	<div  class="stars" >
		  <i class="fas fa-star"
		  <?php
		    if($b>=1)
				echo 'style="color:gold;"';
		  ?>
		  ></i>
		  <i class="fas fa-star"
		  <?php
		    if($b>=2)
				echo 'style="color:gold;"';
		  ?>
		  ></i>
		  <i class="fas fa-star"
		  <?php
		    if($b>=3)
				echo 'style="color:gold;"';
		  ?>
		  ></i>
		  <i class="fas fa-star"
		  <?php
		    if($b>=4)
				echo 'style="color:gold;"';
		  ?>
		  ></i>
		  <i class="fas fa-star"
		  <?php
		    if($b>=5)
				echo 'style="color:gold;"';
		  ?>></i>
		  <span >(<?php echo $total;    ?> review)</span>
		  
	</div>
	<?php   }
	         mysqli_free_result($result1);					  

	   ?>
	   
		<?php  
		
		if($row1[3]){
			$sql="select discount from offer where offer_id=".$row1[3];
            $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		    if($row2=mysqli_fetch_array($result1)){
		   	      $b=$row1[2]-$row1[2]*$row2[0]/100;
				  $b=$b*$_SESSION['equal'];
				  $row1[2]=$row1[2]*$_SESSION['equal'];
                   echo '<div class="price" > '.$b.' '.$_SESSION['symbole'].' <span>'.$row1[2].' '.$_SESSION['symbole'].' </span>';
						  
	        }
		    mysqli_free_result($result1);					  		 
                            
	    }else{
			$row1[2]=$row1[2]*$_SESSION['equal'];
			 echo '<div class="price" > '.$row1[2].' '.$_SESSION['symbole'];
		} 
		 $sql="select e.name,e.price,e.id_extra from have h,extra e where cat_id=".$row1[5]." and e.id_extra=h.id_extra";
		 $re=0;
         $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		 if(mysqli_num_rows($result1)>0){
			  echo '<select id="menu" ><option selected value="" >chosse extra</option>';
			  while($row2=mysqli_fetch_array($result1)){
			    echo'<option value="'.$row2[2].'" >'.$row2[0].' ('.$row2[1].') </option>';	
              }
			  echo '</select>';
			  $re=1;
         }
		 mysqli_free_result($result1);
         echo '</div>';
		 echo '<div class="quantityl" >';
		   echo '<span>Quantity : </span>';
		   echo '<input type="number" min="1"  value="1" ></input>';
		 echo '</div>';
		 if($re==1)
		      echo '<a  class="btn3" onclick="f1(this,'.$a.');" >add to cart</a>';
	     else
		      echo '<a  class="btn3" onclick="f(this,'.$a.');" >add to cart</a>';		  
			 $b="";
		     $total="";
		     $k2=0;
		     for($k1=0;$k1<$nb;$k1++,$k2++){
				   	while(!isset($_COOKIE['add'.$k2])){
					   $k2++;
				    }
                    $a1=$_COOKIE['add'.$k2];
                    $c=explode(':',$a1); //comme split in javasc
					if((int)$c[0]==$a){
						 if(isset($c[2])){
						     if($total!="")
								   $total=$total."_";
							 $total=$total."add".$k2.':'.$c[1].':'.$c[2];
						 }else{
						    $j1=$k2;
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
					   echo '<span class="esists" style="visibility:visible; display:none;" >'.$x.'</span>';
					  $x='add'.$j1.':'.$b[1];
                }else{
                       $x="";						   
					    echo '<span class="esists" style="visibility:hidden; display:none;" ></span>';
				} 
			     echo '<span style="display:none;" id="user" >'.$x.'</span>';
	
	
		  

      echo '</div>';
	 	 
	 $k++;
	 if($k>=$n){

		 if( $ligne>=$rd || $d==1 ){
			 $k=0;
			 echo '</div>';
			 echo '</div>';
			 $ligne++;
		 }else{

            $d=1;
		 }			
	 }	 
  	 
  }
  if($nb1<12 && ($nb1%3)!==0){
	  	 echo '</div>';
		 echo '</div>';
  }	
  $test="<script>	window.sessionStorage.setItem(\"nb1\",".$nbr."); </script>";	
  echo $test;  
?>
</section>
<?php
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

				  


?>


<?php     
    require("includes/footer.php");
	mysqli_close($conn);
 ?>
<script>
function g(x,y,w){
     nb1=sessionStorage.getItem("nb1");
     let style=window.getComputedStyle(x);
     if((style.color)=="rgb(255, 25, 25)"){
			 x.style.color='rgb(19,15,64)';
			 document.cookie="like"+y+"="+";max-age=-60"; 
		     document.cookie='nb1='+(parseInt(nb1)-1)+";max-age="+(60*60*24*2);;
		     window.sessionStorage.setItem("nb1",(parseInt(nb1)-1));
			
            Array1=new Array();
			j=0;
			for(i=0;i<Array_of_like.length;i++){
				c=Array_of_like[i];
				string=c.split('_');
				if(string[0]!=y){
					Array1[j++]=Array_of_like[i];
					document.cookie='like'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

				}	
			}
			Array_of_like=Array1;
            
    }else{
			 document.cookie="like"+y+"="+w+";max-age="+(60*60*24*2);
             document.cookie='nb1='+(parseInt(nb1)+1)+";max-age="+(60*60*24*2);
	         window.sessionStorage.setItem("nb1",(parseInt(nb1)+1));
			 x.style.color='rgb(255,25,25)';
			 
			 	         
	        for(i=0;i<Array_of_like.length;i++){
		         c=Array_of_like[i];
		         string=c.split('_');
		         document.cookie='like'+string[0]+'='+string[1]+";max-age="+(60*60*24*3);

	        }
	        Array_of_like[Array_of_like.length]=y+"_"+w;


    }   

}
</script>
  <script>

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
<!-- speciality section ends -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link -->
<script src="includes/script1.js"></script>  

</body>
</html>