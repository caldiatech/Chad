(function($){
	'use strict'

	$(document).ready(function(){

		$('.humbarger-menu').on('click',function(){
	        $(this).parent().find('.main-menu').toggleClass('active');
	        $(this).find('.burger').toggleClass('open');
	        $('body').toggleClass('hidden-body');
    	});

    	$('.slider-for').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  arrows: false,
		  fade: true,
		  asNavFor: '.slider-nav'
		});

		$('.slider-nav').slick({
		  slidesToShow: 4,
		  slidesToScroll: 1,
		  asNavFor: '.slider-for',
		  dots: false,
		  arrows: false,
		  centerMode: true,
		  focusOnSelect: true,
		  centerPadding: '0',
		});

		$('.parent-container').magnificPopup({
		  delegate: 'a', 
		  type: 'image',
		  	gallery:{
				enabled:true
			}
		});
		
	});
  
	if ($('.owl-carousel').length) {

	    $('.owl-carousel').each(function () {
	      var owl = $('.owl-carousel');
	      var loop_owl = ($(this).data('loop'))?$(this).data('loop'):false;
	      $(this).owlCarousel({
	        autoplayTimeout: $(this).data('autotime'),
	        smartSpeed: $(this).data('speed'),
	        autoplay: $(this).data('autoplay'),
	        items: $(this).data('carousel-items'),
	        nav: $(this).data('nav'),
	        dots: $(this).data('dots'),
	        loop: loop_owl,
	        margin: $(this).data('margin'),

	        responsive: {
	          0: {
	            items: $(this).data('mobile'),
	          },
	          480: {
	            items: $(this).data('large-mobile'),
	          },
	          768: {
	            items: $(this).data('tablet')
	          },
	          992: {
	            items: $(this).data('items')
	          }
	        }
	      });
	    });
  	}

  	$(window).on('load',function(){
   //  	setTimeout(() => {
	  //     	AOS.init({
	  //     		duration: 1000
	  //     	});
	  //   	}, 500);

   //  	$('#status').fadeOut(); 
			// $('#preloader').delay(350).fadeOut('slow');
			// $('body').delay(350).css({'overflow':'visible'});

	 });

  	// $(window).on('scroll', function() {
   //    	var height = $(window).scrollTop();
			// 	if (height > 300) {
			// 		$('.bottom-top-arrow').fadeIn().addClass('open');
			// 	} else {
			// 		$('.bottom-top-arrow').fadeOut().removeClass('open');
			// 	}
  	// });

  	// $(".bottom-top-arrow").click(function(event) {
   //      event.preventDefault();
   //      $("html, body").animate({ scrollTop: 0 }, "slow");
   //      return false;
   //  });

})(jQuery);