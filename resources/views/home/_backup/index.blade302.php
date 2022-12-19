@extends('layouts._front.home')

@section('content')

  	
  	<div class="full-layout smaller-padd-grid">
	      <div class="uk-width-1-1">
	      	<h2 class="text-uppercase uk-text-center">Our Featured Photos</h2>
	      	<div class="uk-grid">
	      		<div class="uk-width-1-4 first-row">
	      			<img src="{!!url('upload/photos/16/447x397-sample-1.jpg')!!}" alt="image 1 " width="447" height="397" class="w100 hauto" />
	      			<div class="grid-caption transitioned bg-black-trans-style-1">
	      				<h3 class="">Lorem Ipsum Sup Et Elite Dolor</h3>
						<div class="sub-title roboto light-grey uk-margin-small-bottom">Neque Porro Quisquam</div>
						<div class="price">From <span class="bold">$85.99</span></div>
	      			</div>
	      		</div>
	      		<div class="uk-width-1-4">
	      			<img src="{!!url('upload/photos/16/447x397-sample-2.jpg')!!}" alt="image 1 " width="447" height="397" class="w100 hauto" />
	      			<div class="grid-caption transitioned bg-black-trans-style-1">
	      				<h3 class="">Lorem Ipsum Sup Et Elite Dolor</h3>
						<div class="sub-title roboto light-grey uk-margin-small-bottom">Neque Porro Quisquam</div>
						<div class="price">From <span class="bold">$85.99</span></div>
	      			</div>
	      		</div>
	      		<div class="uk-width-1-4">
	      			<img src="{!!url('upload/photos/16/447x397-sample-3.jpg')!!}" alt="image 1 " width="447" height="397" class="w100 hauto" />
	      			<div class="grid-caption transitioned bg-black-trans-style-1">
	      				<h3 class="">Lorem Ipsum Sup Et Elite Dolor</h3>
						<div class="sub-title roboto light-grey uk-margin-small-bottom">Neque Porro Quisquam</div>
						<div class="price">From <span class="bold">$85.99</span></div>
	      			</div>
	      		</div>
	      		<div class="uk-width-1-4 last-row">
	      			<img src="{!!url('upload/photos/16/447x397-sample-4.jpg')!!}" alt="image 1 " width="447" height="397" class="w100 hauto" />
	      			<div class="grid-caption transitioned bg-black-trans-style-1">
	      				<h3 class="">Lorem Ipsum Sup Et Elite Dolor</h3>
						<div class="sub-title roboto light-grey uk-margin-small-bottom">Neque Porro Quisquam</div>
						<div class="price">From <span class="bold">$85.99</span></div>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="uk-width-1-1 uk-text-center uk-margin-medium-bottom uk-margin-medium-top">
	      		<a href="#" class="uk-button fnone uk-button-trans uk-container-center uk-margin-large-top  white uk-margin-large-bottom text-uppercase" class="roboto">View Image Gallery</a>
	      	</div>
	          <?php /* $pages->fldPagesDescription */ ?>	     
      </div>
    </div>

@stop

@section('headercodes')
	<script>
		var url = "{{ url('/') }}";
	</script>
	<!-- {!! Html::script('/public/_front/assets/js/cart.js') !!} !-->
@stop

@section('extracodes')  
 {{-- */ /* */ /* --}}
	<script>
		$('#homeslideshow .uk-slideshow li').css({'opacity':1});
		$(document).ready(function(){
			$('#homeslideshow .uk-slideshow').removeClass('onstart'); 
			loadScript("{!!url('_front/plugins/uikit/js/components/slideshow.min.js')!!}", function(){
			    init_accordion_slideshow();
				var slideshow = UIkit.slideshow($('#homeslideshow'), {  });
				slideshow.on('beforeshow.uk.slideshow', function(){
					console.log("trest"); $('#homeslideshow .uk-slideshow li').removeClass('uk-hidden');
				   init_accordion_slideshow();
				});
			});

		
		
		function init_accordion_slideshow(){
			$( "section.aw-accordion div.slide-acc-item" ).mouseover(function() {
			  $(this).css('width','50%'); $(this).addClass('active');
			  $(this).siblings('div.slide-acc-item').css('width','25%'); $(this).siblings('div.slide-acc-item').removeClass('active');
			});
		}
		
			
		});
	</script>
@stop
