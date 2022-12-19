@extends('layouts._front.home')

@section('content')

  	
  	<div class="full-layout smaller-padd-grid featured-photos-section gallery-style-1">
	      <div class="uk-width-1-1">
	      	<h2 class="text-uppercase uk-text-center">Our Featured Photos</h2>

	      	<div class="uk-grid">
	      		@foreach($product as $products)
			      		<div class="uk-width-medium-1-4 uk-width-small-1-2 first-row">
			      			<div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" data-uk-modal="{target:'#modal-1'}" >
					            <figure class="uk-overlay">                                            
					                {!! Html::image(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.MEDIUM_IMAGE.$products->fldProductImage,'',array('class'=>'w100 hauto pull-left')) !!}                     
					                <figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom"><h3 class="">{{ $products->fldProductName }}</h3>
										<div class="sub-title roboto light-grey uk-margin-small-bottom">{{ $products->fldProductSubTitle }}</div>
										<div class="price fweight-100 light-grey light">From <span class="bold white">${{ number_format($products->fldProductPrice,2) }}</span></div></figcaption>
					                <a class="uk-position-cover" href="{{ url('products/details/'.$products->fldProductSlug) }}"></a>
					            </figure>
					        </div>	      			
			      		</div>
	      		@endforeach	      		
	      	</div>

	      	<div class="uk-width-1-1 uk-text-center uk-margin-medium-bottom uk-margin-medium-top">
	      		<a href="{{ url('image-galleries') }}" class="uk-button fnone uk-button-trans uk-container-center uk-margin-large-top  white uk-margin-large-bottom text-uppercase" class="roboto">View Image Gallery</a>
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
	var first_active = 0; var this_current_slide = 1;
		$('#homeslideshow .uk-slideshow li').css({'opacity':1});
		$(document).ready(function(){
   			loadcssfile('{!!url("public/_front/assets/css/home.css")!!}','css');
			var slidehometotalcount = 3; 
			// $('#homeslideshow').addClass('item-count-'+slidehometotalcount_whole);			 
			 console.log(slidehometotalcount);

			$('#homeslideshow .uk-slideshow').removeClass('onstart'); 
			loadScript("{!!url('_front/plugins/uikit/js/components/slideshow.min.js')!!}", function(){
			    init_accordion_slideshow();
				var slideshow = UIkit.slideshow($('#homeslideshow'), {  });
				slideshow.on('beforeshow.uk.slideshow', function(event, nextslide, currentslide){
					slidehometotalcount = nextslide.attr('data-count');
					console.log("nextslide:"+nextslide.attr('data-count')+' , currentslide:'+currentslide.attr('data-count')); 
					 this_current_slide= nextslide.attr('data-itemno'); console.log(this_current_slide);
				   init_accordion_slideshow();

					$('#homeslideshow .uk-slideshow li').addClass('opacity-1');
				});
			});
			
		
		
		function init_accordion_slideshow(){
			first_active = 0;
			if($(window).innerWidth() >= 640){
				$(".slide-item-"+this_current_slide+" section.aw-accordion div.slide-acc-item" ).each(function() {
					var item_width_active = 50;var item_width_init = 25;
					if(slidehometotalcount == 1){item_width_active = 100; }else if(slidehometotalcount == 2){item_width_active = 50;item_width_init = 50;}	
				    if(first_active==0 || slidehometotalcount == 1){
				    	$(this).css('width',item_width_active+'%'); $(this).addClass('active');}else{$(this).css('width',item_width_init+'%'); $(this).removeClass('active');}
first_active++;
				 	
				});

				$( "section.aw-accordion div.slide-acc-item" ).mouseover(function() {
					var item_width_active = 50;var item_width_init = 25;
					if(slidehometotalcount == 1){item_width_active = 100; }else if(slidehometotalcount == 2){item_width_active = 50;item_width_init = 50;}
				  $(this).css('width',item_width_active+'%'); $(this).addClass('active');
				  $(this).siblings('div.slide-acc-item').css('width',item_width_init+'%'); $(this).siblings('div.slide-acc-item').removeClass('active');
				});
			}else{
				$( ".slide-item-"+this_current_slide+" section.aw-accordion div.slide-acc-item" ).mouseover(function() {
					var item_width_active = 380;var item_width_init = 150;
					if(slidehometotalcount == 1){item_width_active = 380; }else if(slidehometotalcount == 2){item_width_active = 380; item_width_init = 250; }
				  	 if(first_active==0 || slidehometotalcount == 1){$(this).css('height',item_width_active+'px'); $(this).addClass('active');}else{$(this).css('height',item_width_init+'px'); $(this).removeClass('active');}
				  first_active++;
				
				});

				$( "section.aw-accordion div.slide-acc-item" ).mouseover(function() {
					var item_width_active = 380;var item_width_init = 150;
					if(slidehometotalcount == 1){item_width_active = 380; }else if(slidehometotalcount == 2){item_width_active = 380; item_width_init = 250;}
				  $(this).css('height',item_width_active+'px'); $(this).addClass('active');
				  $(this).siblings('div.slide-acc-item').css('height',item_width_init+'px'); $(this).siblings('div.slide-acc-item').removeClass('active');
				});
			}
			
		}

		$(window).resize(function(){
init_accordion_slideshow();
		});
		
			
		});
	</script>
@stop
