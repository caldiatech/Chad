
  //! CONTROL THE ALERT INFO LINEN SLIDER
$(document).ready(function(){
  $('body').animate({ "top": "+=100px" }, "slow").delay(4000).animate({"top": "-=100px"}, "slow").end();
  $('.alertinfo').fadeIn(10, function(){
		$(this).delay(4000).fadeOut(10);
	});
});
