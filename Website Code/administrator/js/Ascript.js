
let accountBox=document.querySelector('.account-box');
let navbarb=document.querySelector('.navbar');
let m=document.querySelector('.main');
let message=document.getElementsByClassName('message');

document.querySelector('#menu-btn').onclick = () =>{
   navbarb.classList.toggle('active');
   accountBox.classList.remove('active');
   document.getElementById("main").classList.toggle('active'); 
  document.getElementsByClassName('message').style.display="none";
   
   }


document.querySelector('#user-btn').onclick = () =>{
  accountBox.classList.toggle('active');
  
  }

window.onscroll = () =>{
	//navbarb.classList.remove('active');
	accountBox.classList.remove('active');
}

function del(uid)
    { 
        if (confirm('Are You Sure to Delete this Record?'))
        { 
	     
            window.location.replace("?delete=" +uid ) ;
        }
		
		
    }
	
 

	


function add(){
window.location.replace("Adacc.php");}


