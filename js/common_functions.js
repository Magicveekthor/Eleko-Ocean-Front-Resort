(function ($) {

	"use strict";
	
	// Preload
	$(window).on('load', function () { // makes sure the whole site is loaded
		$('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
		$('#preloader').addClass('loaded');
		$('.animate_hero').addClass('is-transitioned');
	})

	//Header Reveal On Scroll
	$("header.reveal_header").headroom({
	    "offset": 50,
	    "tolerance": 5,
	    "classes": {
	        "initial": "animated",
	        "pinned": "slideDown",
	        "unpinned": "slideUp"
	    }
	});

	// Sticky Header
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 1) {
			$('.fixed_header').addClass("sticky");
		} else {
			$('.fixed_header').removeClass("sticky");
		}
	});
	$(window).scroll();

	// Scroll animation
	scrollCue.init({
	    percentage : 0.85
	});

	// Opacity mask
	$('.opacity-mask').each(function(){
		$(this).css('background-color', $(this).attr('data-opacity-mask'));
	});

	// Data Background
	$('.background-image').each(function(){
		$(this).css('background-image', $(this).attr('data-background'));
	});

	// Button scroll to
    $('a[href^="#"].btn_scrollto').on('click', function (e) {
			e.preventDefault();
			var target = this.hash;
			var $target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top -60
			}, 300, 'swing', function () {
				window.location.hash = target;
		});
	});

	// Pinned content
	const pinnedImages = document.querySelectorAll('.pinned-image');
	pinnedImages.forEach(pinnedImage => {
	    const container = pinnedImage.querySelector('.pinned-image__container');
	    const image = container.querySelector('img');
	    const overlay = container.querySelector('.pinned-image__container-overlay');
	    const content = pinnedImage.querySelector('.pinned_over_content');
	    const tl = gsap.timeline({paused: true});
	    tl.to(container, {
	        scale: 1.05,
	    }, 0);
	    tl.from(content, {
	        autoAlpha: 0,
	    }, 0);
	    tl.from(overlay, {
	        autoAlpha: 0,
	    }, 0);
	    const trigger = ScrollTrigger.create({
	        animation: tl,
	        trigger: pinnedImage,
	        start: "top center",
	        markers: false,
	        pin: false,
	        scrub: false,
	    });
	});

	// Video Play on scroll
	var $win = $(window);
	var $sectionvideo = $('#section_video video');
    var elementTop, elementBottom, viewportTop, viewportBottom;

    function isScrolledIntoView(elem) {
      elementTop = $(elem).offset().top;
      elementBottom = elementTop + $(elem).outerHeight();
      viewportTop = $win.scrollTop();
      viewportBottom = viewportTop + $win.height();
      return (elementBottom > viewportTop && elementTop < viewportBottom);
    }
    
    if($sectionvideo.length){

      var loadVideo;

      $sectionvideo.each(function(){
        $(this).attr('webkit-playsinline', '');
        $(this).attr('playsinline', '');
        $(this).attr('muted', 'muted');

        $(this).attr('id','loadvideo');
        loadVideo = document.getElementById('loadvideo');
        loadVideo.load();
      });

      $win.scroll(function () { // video to play when is on viewport 
      
        $sectionvideo.each(function(){
          if (isScrolledIntoView(this) == true) {
              $(this)[0].play();
          } else {
              $(this)[0].pause();
          }
        });
      
      });
    }
	
	// Menu sidebar panel v1
	$('.open_close_nav_panel').on("click", function () {
		$('.nav_panel').toggleClass('show');
		$('.layer').toggleClass('layer-is-visible');
	});

	$(".sidebar-navigation nav li a").on('click', function(){		
		var parentLevel = $(this).parents('ul').length -1;
		var currentMenu = $(this).closest('ul');
		var currentListItem = $(this).parent('li');
		var parentMenu = $('.level-' + parentLevel);
		var subMenu = $(this).next('ul');
		if(currentListItem.hasClass('back')) {
			// back button hit	
			currentMenu.removeClass('active');
			parentMenu.removeClass('hidden');
		} else if (currentListItem.children('ul').length > 0) {
			// menu item has children - expand the menu
			subMenu.toggleClass('active');
			currentMenu.addClass('hidden');
		}
	});

	// Menu sidebar panel v2
	$('.open_close_menu').on("click", function () {
		$('.main-menu').toggleClass('show');
		$('.layer').toggleClass('layer-is-visible');
	});

	// Menu overaly paner panel
	$('.menu_open').on("click", function () {
		$('.hamburger').toggleClass('is-active');
		$('.panel_menu').toggleClass('active');
		$('body').toggleClass('no_scroll');
		$('header').toggleClass('header_color');
	});
	
	// Menu hover images
	$(".wrapper_menu ul li a").each(function() {
	    $(this).on("mouseover", function() {
	        $(".wrapper_menu").addClass("hover");
	        $(".container-item").removeClass("active");
	        $(this).parent().addClass("active");
	    }).on("mouseleave", function() {
	        $(".wrapper_menu").removeClass("hover");
	    });
	});

	// Menu v4 + submenu
	$('a.show-submenu').on("click", function () {
		$(this).toggleClass("show_normal");
	});

	// Carousel items 1
	$('.carousel_item_1').owlCarousel({
	    center: true,
	    items:1,
	    loop:false, 
	    addClassActive: true,
	    margin:0,
	    autoplay:false,
	    autoplayTimeout:3000,
		autoplayHoverPause:true,
		animateOut: 'fadeOut',
	    responsive:{
	    	0:{
	            dots:true
	        },
	        991:{
	            dots:true
	        }
	    }
	});

	// Carousel items centererd generals
	$('.carousel_item_centered').owlCarousel({    
	    loop:true,
	    margin:5,
	    nav:true,
	    dots:false,
	    center:true,
	    navText: ["<i class='bi bi-arrow-left-short'></i>","<i class='bi bi-arrow-right-short'></i>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:2
	        }
	    }
	});

	// Carousel items centered rooms
	$('.carousel_item_centered_rooms').owlCarousel({    
	    loop:true,
	    margin:5,
	    nav:true,
	    dots:false,
	    center:true,
	    navText: ["<i class='bi bi-arrow-left-short'></i>","<i class='bi bi-arrow-right-short'></i>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        991:{
	            items:2
	        }
	    }
	});


	// Carousel items 3
	$('.carousel_item_3').owlCarousel({    
	    loop:false,
	    margin:15,
	    nav:true,
	    dots:false,
	    center:false,
	    navText: ["<i class='bi bi-arrow-left-short'></i>","<i class='bi bi-arrow-right-short'></i>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:3
	        }
	    }
	});

	// Carousel testimonials
	$('.carousel_testimonials').owlCarousel({
	 	items:1,
	    loop:true,
		autoplay:false,
	    animateIn: 'flipInX',
		margin:40,
    	stagePadding:30,
	    smartSpeed:300,
	    autoHeight:true,
	    dots:true,
		responsiveClass:true,
	    responsive:{
	        600:{
	            items:1
	        },
			 1000:{
	            items:1,
				nav:false
	        }
	    }
	});

	// Sticky titles
	$('.fixed_title').theiaStickySidebar({
		minWidth: 991,
		additionalMarginTop: 120
	});

	// Jquery select
	$('.custom_select select').niceSelect();

	// Footer reveal 
	if ($(window).width() >= 1024) {
		$('footer.revealed').footerReveal({
		shadow: false,
		opacity:0.6,
		zIndex: 1
	});
	};

	// Links footer hover effect
    $(".footer_links > ul > li").hover(function() {
	  $(this).siblings().stop().fadeTo(300, 0.6);
	  $(this).parent().siblings().stop().fadeTo(300, 0.3); 
	}, function() { // Mouse out
	  $(this).siblings().stop().fadeTo(300, 1);
	  $(this).parent().siblings().stop().fadeTo(300, 1);
	});

	// Categories hover images/videos
	$(".cat_nav_hover ul li a").each(function() {
	    $(this).on("mouseover", function() {
	        $(".cat_nav_hover").addClass("hover");
	        $(".container-item").removeClass("active");
	        $(this).parent().addClass("active");
	    }).on("mouseleave", function() {
	        $(".cat_nav_hover").removeClass("hover");
	    });
	});

	//Scroll back to top
	var progressPath = document.querySelector('.progress-wrap path');
	var pathLength = progressPath.getTotalLength();
	progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
	progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
	progressPath.style.strokeDashoffset = pathLength;
	progressPath.getBoundingClientRect();
	progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
	var updateProgress = function() {
	    var scroll = $(window).scrollTop();
	    var height = $(document).height() - $(window).height();
	    var progress = pathLength - (scroll * pathLength / height);
	    progressPath.style.strokeDashoffset = progress;
	}
	updateProgress();
	$(window).scroll(updateProgress);
	var offset = 50;
	var duration = 550;
	$(window).on('scroll', function() {
	    if (jQuery(this).scrollTop() > offset) {
	        jQuery('.progress-wrap').addClass('active-progress');
	    } else {
	        jQuery('.progress-wrap').removeClass('active-progress');
	    }
	});
	$('.progress-wrap').on('click', function(event) {
	    event.preventDefault();
	    jQuery('html, body').animate({ scrollTop: 0 }, duration);
	    return false;
	});	




	$(document).ready(function() {
    // Toggle dropdown on profile image click
    $("#profileBtn").on("click", function(e) {
        e.stopPropagation(); // Prevent click from closing it immediately
        $("#profileMenu").toggleClass("show");
    });

    // Close dropdown when clicking anywhere else
    $(document).on("click", function() {
        $("#profileMenu").removeClass("show");
    });

});

})(jQuery);

function alert(type, msg, position='body') {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show alert-container" role="alert" id="autoDismissAlert" style="z-index: 10000;">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `; 
    if(position=='body') {
        document.body.append(element);
        // element.classList.add('alert-container');
    } else {
        document.getElementById(position).appendChild(element);
    }

    // Automatically close after 2 seceonds
    setTimeout(() => {
        let alertEl = element.querySelector('.alert');
        if(alertEl) {
            let bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
            bsAlert.close();
        }
    }, 5000);
}



// LOGIN FUNCTION
let login_form = document.getElementById('login-form');

login_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();
    data.append('email_mob', login_form.elements['email_mob'].value);
    data.append('password', login_form.elements['password'].value);
    data.append('login','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php", true);

    xhr.onload = function(){
        let res = this.responseText.trim();
        if(res == 'inv_email_mob'){
            alert('error', "Invalid Email Address or Mobile Number");
        } else if(res == 'not_verified'){
            alert('error', "Email Address is not verified!");
        } else if(res == 'inactive'){
            alert('error', "Account Suspended! Please contact admin");
        } else if(res == 'invalid_pass'){
            alert('error', "Incorrect Password!");
        } else if(res == '1'){ 
            document.getElementById('loginModal').classList.remove('active');
			let fileurl = window.location.href.split('/').pop().split('?').shift();
			if(fileurl == 'room-details.php') {
				window.location = window.location.href;
			} else {
            	window.location = window.location.pathname;
			}
        } else {
            console.log("Unexpected response:", res);
        }
    }
    xhr.send(data);
});



// FORGOT PASSWORD FUNCTION
let forgot_form = document.getElementById('forgot-form');
let forgotBtn = document.getElementById('forgotSubmitBtn');
let btnText = forgotBtn.querySelector('.btn-text');
let btnSpinner = forgotBtn.querySelector('.spinner');

forgot_form.addEventListener('submit', (e) => {
    e.preventDefault();

    // Disable button + show spinner
    forgotBtn.disabled = true;
    btnText.style.display = "none";
    btnSpinner.style.display = "inline-block";

    let data = new FormData();
    data.append('email', forgot_form.elements['email'].value);
    data.append('forgot_password','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php", true);

    xhr.onload = function(){

        // Re-enable button + hide spinner
        forgotBtn.disabled = false;
        btnText.style.display = "inline";
        btnSpinner.style.display = "none";

        if(this.responseText == 'inv_email'){
            alert('error', "Invalid Email Address");
        } else if(this.responseText == 'not_verified'){
            alert('error', "Email Address is not verified! Please contact admin");
        } else if(this.responseText == 'inactive'){
            alert('error', "Account Suspended! Please contact admin");
        } else if(this.responseText == 'mail_failed'){
            alert('error', "Cannot send mail. Server Down!");
        } else if(this.responseText == 'upd_failed'){
            alert('error', "Account recovery failed. Server Down!");
        } else {
            // Hide custom modal
            document.getElementById('loginModal').classList.remove('active');
            alert('success', "Reset link sent to your email!");
            forgot_form.reset();
        }
    }
    xhr.send(data);
});