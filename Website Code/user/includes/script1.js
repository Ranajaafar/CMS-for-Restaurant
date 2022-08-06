let item=document.querySelector('.item');

document.querySelector('#menu-btn').onclick=() =>{
	item.classList.toggle('active');
	menu.classList.remove('fa-times');
    navbar.classList.remove('active');
   //	login.classList.remove('active');
}
/*	
let login=document.querySelector('.login-form');

document.querySelector('#login-btn').onclick=() =>{
	login.classList.toggle('active');
	item.classList.remove('active');
	menu.classList.remove('fa-times');
    navbar.classList.remove('active');

}*/

let menu=document.querySelector('#menu-bar');
let navbar=document.querySelector('.navbar');
menu.onclick=() =>{
	menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
	item.classList.remove('active');
	//login.classList.remove('active');

}	

window.onscroll=() =>{
	menu.classList.remove('fa-times');
    navbar.classList.remove('active');
	item.classList.remove('active');
  //  login.classList.remove('active');	
}	

var swiper = new Swiper(".category-slider", {
    loop:true,
			grabCursor:true,
    spaceBetween: 20,
  /*  autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    } */
    centeredSlides: true,
    breakpoints: {
      0: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2.5,
      },
      1020: {
        slidesPerView: 3.5,
      },
    },
});


var swiper1 = new Swiper(".cat-slider", {
    loop:false,
			grabCursor:true,
    spaceBetween: 20,
  /*  autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    } */
    centeredSlides: false,
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1020: {
        slidesPerView: 3,
      },
    },
});


var swiper1 = new Swiper(".item-slider", {
    loop:false,
	grabCursor:true,
    spaceBetween: 20,
  /*  autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    } */
    centeredSlides: false,
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1020: {
        slidesPerView: 3.5,
      },
    },
});
var swiper1 = new Swiper(".feed-slider", {
    loop:true,
		grabCursor:true,
    spaceBetween: 20,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    centeredSlides: true,
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1020: {
        slidesPerView: 3,
      },
    },
});

var swiper1 = new Swiper(".offer-slider", {
    loop:false,
		grabCursor:true,
    spaceBetween: 20,
   /* autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },*/
    centeredSlides: false,
    breakpoints: {
      0: {
        slidesPerView: 1.5,
      },
      768: {
        slidesPerView: 3,
      },
      1020: {
        slidesPerView: 5,
      },
    },
});
//Cookies.set('','');
//document.write("fd");
/*const cart = document.querySelectorAll("#addToCart");
for(i=0;i<cart.length;i++){
	document.write("esadddf");
   /* cart[i].addEventListener("click",function(){
	}	*/
	
