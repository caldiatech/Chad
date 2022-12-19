@extends('layouts._front.home') @section('content')


<div class="full-layout smaller-padd-grid featured-photos-section gallery-style-1">
	<div class="uk-width-1-1">
		<h2 class="text-uppercase uk-text-center">Featured Photos</h2>

		<div class="uk-grid">
			@foreach($product as $products)
			<div class="uk-width-medium-1-4 uk-width-small-1-2 first-row">
				<div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" data-uk-modal="{target:'#modal-1'}">
					<figure class="uk-overlay">
						{!! Html::image(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.MEDIUM_IMAGE.$products->fldProductImage,$products->fldProductName,array('class'=>'w100
						hauto pull-left')) !!}
						<figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom">
							<h3 class="">{{ $products->fldProductName }}</h3>
							<div class="sub-title roboto light-grey uk-margin-small-bottom">{{ $products->fldProductSubTitle }}</div>
							<div class="price fweight-100 light-grey light">From
								<span class="bold white">${{ number_format($products->fldProductPrice,2) }}</span>
							</div>
						</figcaption>
						<a class="uk-position-cover" href="{{ url('products/details/'.$products->fldProductSlug) }}"></a>
					</figure>
				</div>
			</div>
			@endforeach
		</div>

		<div class="uk-width-1-1 uk-text-center uk-margin-medium-bottom uk-margin-medium-top">
			<a href="{{ url('collection') }}" class="uk-button fnone uk-button-trans uk-container-center uk-margin-large-top  white uk-margin-large-bottom text-uppercase"
			  class="roboto">View Collection</a>
		</div>
		<?php /* $pages->fldPagesDescription */ ?>
	</div>
</div>

@stop @section('headercodes')
<script>
	var url = "{{ url('/') }}";
</script>
<!-- {!! Html::script('/public/_front/assets/js/cart.js') !!} !-->
@stop @section('extracodes') {{-- */ /* */ /* --}}
<script>
	var first_active = 0;
	var this_current_slide = 1;
	var array_remove_class = [16, 33, 66, 83];
	$('#homeslideshow .uk-slideshow li').css({
		'opacity': 1
	});
	$(document).ready(function () {
		loadcssfile('{!!url("public/_front/assets/css/home.css")!!}', 'css');
		var slidehometotalcount = 3;
		console.log(slidehometotalcount);

		$('#homeslideshow .uk-slideshow').removeClass('onstart');
		loadScript("{!!url('_front/plugins/uikit/js/components/slideshow.min.js')!!}", function () {
			init_accordion_slideshow();
			var slideshow = UIkit.slideshow($('#homeslideshow'), {});
			slideshow.on('beforeshow.uk.slideshow', function (event, nextslide, currentslide) {
				slidehometotalcount = nextslide.attr('data-count');
				console.log("nextslide:" + nextslide.attr('data-count') + ' , currentslide:' + currentslide.attr('data-count'));
				this_current_slide = nextslide.attr('data-itemno');
				console.log(this_current_slide);
				init_accordion_slideshow();

				$('#homeslideshow .uk-slideshow li').addClass('opacity-1');
			});
		});


		function init_accordion_slideshow() {
			first_active = 0;
			$(".slide-item-" + this_current_slide + " section.aw-accordion div.slide-acc-item").each(function () {
				var item_width_active = 33.33;
				var item_width_init = 33.33;
				var this_slid_cc_item = $(this);
				if (slidehometotalcount == 1) {
					item_width_active = 100;
				} else if (slidehometotalcount == 2) {
					item_width_active = 50;
					item_width_init = 50;
				}

				for (var removeclass = 0; removeclass < array_remove_class.length; removeclass++) {
					this_slid_cc_item.removeClass('left-' + array_remove_class[removeclass]);
				}
				first_active++;

			});

			$("section.aw-accordion div.slide-acc-item").on({
				mouseenter: function () {

					var item_width_active = 50;
					var item_width_init = 25;
					var this_slide_hover = $(this);
					if (slidehometotalcount == 1) {
						item_width_active = 100;
					} else if (slidehometotalcount == 2) {
						item_width_active = 50;
						item_width_init = 50;
					}

					$(".slide-item-" + this_current_slide + " section.aw-accordion div.slide-acc-item").each(function () {
						this_slid_cc_item = $(this);
						for (var removeclass = 0; removeclass < array_remove_class.length; removeclass++) {
							this_slid_cc_item.removeClass('left-' + array_remove_class[removeclass]);
						}
					});

					$(this).addClass('active');
					$(this).siblings('div.slide-acc-item').removeClass('active');
					if (this_slide_hover.hasClass('slide-1')) {
						$('section.aw-accordion div.slide-acc-item.slide-2').addClass('left-66');
						$('section.aw-accordion div.slide-acc-item.slide-3').addClass('left-83');
					} else if (this_slide_hover.hasClass('slide-2')) {
						this_slide_hover.addClass('left-16');
						$('section.aw-accordion div.slide-acc-item.slide-3').addClass('left-83');
					} else if (this_slide_hover.hasClass('slide-3')) {
						this_slide_hover.addClass('left-33');
						$('section.aw-accordion div.slide-acc-item.slide-2').addClass('left-16');
					}

				},
				mouseleave: function () {
					/*$(".slide-item-"+this_current_slide+" section.aw-accordion div.slide-acc-item" ).each(function() {	
						this_slid_cc_item = $(this);					
					    for(var removeclass = 0; removeclass <  array_remove_class.length; removeclass++){
							this_slid_cc_item.removeClass('left-'+array_remove_class[removeclass]);							
						}
						this_slid_cc_item.addClass('transform-none');					 	
					});*/
				}
			});

		}
		$(window).resize(function () {
			init_accordion_slideshow();
		});

	});
</script>
@stop