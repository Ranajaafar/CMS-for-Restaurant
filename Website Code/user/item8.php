<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>la tavola(item)</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	
    <link rel="icon" href="uploads/tavo.png" type="image/x-icon" >

    <!-- custom css file link  -->
    <link rel="stylesheet" href="includes/style.css">
	<link rel="stylesheet" href="includes/style_item.css">

</head>
<body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<?php
    session_start();
	include("includes/connectDB.php");
	if(isset($_GET["submit"])){
	   $a=(int)$_GET["hidden"];
	   $id=(int)$_GET["hiddenid"];
	   if($a==1)
	     $sql="UPDATE rating SET nb1=(nb1+1) WHERE ID=$id";
	   else if($a==2)
	     	     $sql="UPDATE rating SET nb2=(nb2+1) WHERE ID=$id";
       else if($a==3)
		   	     $sql="UPDATE rating SET nb3=(nb3+1) WHERE ID=$id";
       else if($a==4)
		   	     $sql="UPDATE rating SET nb4=(nb4+1) WHERE ID=$id";
       else 
		   	     $sql="UPDATE rating SET nb5=(nb5+1) WHERE ID=$id";  
	   $result=mysqli_query($conn,$sql) or die("bad query :$sql");
	   $_SESSION["SUCCESS"]="true";
       echo ' <script>    window.history.back(); </script>';	
       exit;   
   }
   if(isset($_SESSION['SUCCESS'])){
	   if($_SESSION['SUCCESS']=="true"){
		?>
		<script>
            Swal.fire(
              'Thank you',
              'we\'ll use your rating to improve our customer support performance',
              'success'
            );

        </script> 
		
   <?php   
		    $_SESSION['SUCCESS']="";
	   }
	}
    if(isset($_COOKIE['nb'])){
		$nb=$_COOKIE['nb'];
	}else{
		$nb=0;
		setcookie('nb',$nb,(time()+(60*60*24*3)));
 	}	
    if(isset($_COOKIE['nb1'])){
		$nb1=$_COOKIE['nb1'];
	}else{
		$nb1=0;
	    setcookie('nb1',$nb1,(time()+(60*60*24*3)));
 	}	
	if(isset($_SESSION["item"])){
	   require("includes/header.php");
	   $id=$_SESSION["item"];
	   $sql="select PNAME,DESCRIPTION,price,offer_id,rat_id,cat_id from item where PID=$id";
       $result=mysqli_query($conn,$sql) or die("bad query :$sql");
		if($row1=mysqli_fetch_array($result)){
               	
?>

<section  id="prodetails" class="section-p1">
  <div class="single-pro-image"  >
     <?php
	      $sql="select photo_path from photo where pid=$id";
          $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		   if($result1){
				  $row2=mysqli_fetch_array($result1);
						   
		  }	
    ?>		 
     <img src="uploads/<?php echo $row2[0];  ?>" width="100%" id="MainImg" alt="" ></img>
     <div class="small-img-group" >
	   <?php
	     $ik=0;
	      while($row2=mysqli_fetch_array($result1)){
              echo '<div class="small-img-col" >';
	            echo '<img src="uploads/'.$row2[0].'" alt="" width="100%" onclick="change('.$ik.');" class="small-img" ></img>';
		      echo '</div>';
			  $ik=$ik+1;
		  } 
		?>

	 </div>
  </div>
  <div class="single-pro-details" >
       <?php
      	$j=0;
	    for($i=0;$i<$nb1;$i++,$j++){
			 while(!isset($_COOKIE['like'.$j])){
			   $j++;
		     }
             $a=$_COOKIE['like'.$j];
		     if((int)$a==$id){
		    	   break;
			 }   						   
		}
		 if($i==$nb1){
				 echo '<a  class="fas fa-heart" id="like" style="cursor:pointer;" onclick="g(this,'.$id.');" ></a>';
				 echo '<span  id="heart" style="display:none;" >false:j</span>';
		}else{
			   echo '<a  class="fas fa-heart" id="like" style="color:rgb(255,25,25); cursor:pointer;" onclick="g(this,'.$id.');" ></a>';
			   echo '<span  id="heart" style="display:none;" >true:'.$j.'</span>';
        }  
	  ?>	

    <h4 id="name" ><?php  echo $row1[0];  ?></h4>
	<?php
	   if($row1[3]!=""){
			 $sql="select discount from offer where offer_id=".$row1[3];
             $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		     if($row2=mysqli_fetch_array($result1)){
		             $b=$row1[2]-$row1[2]*$row2[0]/100;
					 $b=($b*$_SESSION['equal']);
					 $row1[2]=$row1[2]*$_SESSION['equal'];
                      echo '<b><div class="price" > '.$b.' '.$_SESSION['symbole'].' <span>'.$row1[2].' '.$_SESSION['symbole'].' </span></div></b>'; 						  
			 }
			 mysqli_free_result($result1);					  		 
                            
	   }else{
		   $row1[2]=$row1[2]*$_SESSION['equal'];
		   echo '<h2 >'.$row1[2].' '.$_SESSION['symbole'].'</h2>';
	   }
	?>
	<?php 
	     $sql="select e.name,e.price,e.id_extra from have h,extra e where cat_id=".$row1[5]." and e.id_extra=h.id_extra";
         $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
		 $i=0;
		 if(mysqli_num_rows($result1)>0){
			    echo '<select id="menu" ><option selected value="" >chosse extra</option>';
				while($row2=mysqli_fetch_array($result1)){
				   echo'<option value="'.$row2[2].'" >'.$row2[0].' ('.$row2[1].') </option>';	
                }
				echo '</select><br/><br/>';
				$i=1;
         }
		 mysqli_free_result($result1);
	?>				  
	<input type="number" value="1" min="1" >
	<?php
	  if($i==1){	
	?>
	   <button class="normal" onclick="f1(this,<?php echo $id; ?>);">Add To cart</button>
	<?php
      }else{
    ?>
	   <button class="normal" onclick="f(this,<?php echo $id; ?>);">Add To cart</button>
	
	<?php
	  }
	   $sql="select nb1,nb2,nb3,nb4,nb5 from rating where id=".$row1[4];
	   $result1=mysqli_query($conn,$sql) or die("bad query :$sql");
	   if($result1){
		   $row2=mysqli_fetch_array($result1);
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
		  ?>
		  ></i>
		  <span >(<?php echo $total;    ?> review)</span>
		  
	</div>
	<?php   }
	   ?>
	<h4>Description</h4>
	<span><?php echo $row1[1]; ?></span>
    	<button class="normal1">Add Review</button>
	<?php
	 					   $j=0;
					   $b="";
					   $total="";
					   for($i=0;$i<$nb;$i++,$j++){
						   while(!isset($_COOKIE['add'.$j])){
							   $j++;
						   }
                           $a=$_COOKIE['add'.$j];
						   $c=explode(':',$a); //comme split in javasc
						   if((int)$c[0]==$id){
							   if(isset($c[2])){
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
						 echo '<span class="esists" style="visibility:visible; display:none;" >'.$x.'</span>';
						 $x='add'.$j1.':'.$b[1];
                       }else{
                         $x="";						   
					     echo '<span class="esists" style="visibility:hidden; display:none;" ></span>';
					   } 
					    echo '<span style="display:none;" id="user" >'.$x.'</span>';
	
	
	?>
  </div>
</section>

<div class="star" >
    <div class="container">
	   <div id="close-form" class="fas fa-times" onclick="remove();"></div>
	   <h3 class="review-title" > Review  </h3>
      <div class="star-widget">
        <input type="radio" name="rate" id="rate-5">
        <label for="rate-5" onclick="review(5);" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-4">
        <label for="rate-4"  onclick="review(4);" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-3">
        <label for="rate-3" onclick="review(3);" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-2">
        <label for="rate-2" onclick="review(2);" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-1">
        <label for="rate-1"  onclick="review(1);" class="fas fa-star"></label>
        <form  class="a" method="get" action="#" >
          <footer ></footer> 
		  <input type="hidden" name="hiddenid" value="<?php echo $row1[4];  ?>" />	
          <input type="text" name="hidden" id="type1" style="display:none;" value="" />		  
          <input type="submit"  class="bt" style="cursor:pointer;" value="POST" name="submit" ></input>
        <!--  </div>  -->
        </form> 
      </div>
    </div>
</div>

<?php
		}
		$test="<script>	window.sessionStorage.setItem(\"nb\",".$nb."); </script>";	
        echo $test;
        $test="<script>	window.sessionStorage.setItem(\"nb1\",".$nb1."); </script>";	
        echo $test;
	    mysqli_free_result($result);
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
	    echo '<span id="like1" style="display:none;" >'.$test.'</span>';  
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
	}else
		exit;


?>
<script>
  var mainImg=document.getElementById("MainImg");
  var small=document.getElementsByClassName("small-img");
  function change(i){
	  k=mainImg.src;
	  mainImg.src=small[i].src;
	  small[i].src=k;
  }
  a=document.getElementById("type1");
  function review(i){
			a.value=i;
  }
  var addRe=document.getElementsByClassName("normal1");
  var star=document.getElementsByClassName("star");
  addRe[0].addEventListener("click",function(){
     star[0].style.display="initial";
  });
  function remove(){
	       star[0].style.display="none";
  }	
</script>
 <script>
 function g(x,y){
   z=x.parentNode;
   a=z.querySelectorAll("#heart");
   b=a[0].innerHTML.split(':'); 
   nb1=sessionStorage.getItem("nb1");
   like=document.querySelectorAll("#like1");   

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
   if(parseInt(b)>0){	    //true mafrud
        d=z.querySelectorAll(".esists");
       let style=window.getComputedStyle(d[0]);
	   		    nb=sessionStorage.getItem("nb");

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
		 //
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
	mysqli_close($conn);
 ?>


</script> 
<!-- speciality section ends -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link -->
<script src="includes/script1.js"></script>  

</body>
</html>