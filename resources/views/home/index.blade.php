<?php session_start(); ?>
@extends('layouts._front.home') @section('content')


<div class="full-layout smaller-padd-grid featured-photos-section gallery-style-1 test">
	<div class="uk-width-1-1">
		<h2 class="text-uppercase uk-text-center">{!!$pages->fldPagesSubTitle!!}</h2>

		<div class="uk-grid">
			<?php
				$row_column_counter = 0; $row_counter = 0;
				$product_counter = count($product);

				//dd($product);

				function check_numeric($said_number){
					$said_number_to_numeric = 0;
					if(is_numeric($said_number)){
						$said_number_to_numeric = $said_number;
					}else{
						$said_number_to_numeric = 0;
					}
					return $said_number_to_numeric;
				}

			?>
			@if($product_counter > 0)
				@foreach($product as $products)
				<?php
				$fldProductPrice = $products->fldProductPrice;
				$lowest_price = $highest_price = 0;
				$fldProductID = $products->fldProductID;
				if(isset($product_array_highest_prices[$fldProductID])){
					$highest_price = $product_array_highest_prices[$fldProductID];
				}
				if(isset($product_array_lowest_prices[$fldProductID])){
					$lowest_price = $product_array_lowest_prices[$fldProductID];
				}
				if(isset($product_array_prices[$fldProductID])){
					$fldProductPrice = $product_array_prices[$fldProductID];
				}
				?>
				<div class="uk-width-large-1-4 uk-width-1-2 product-type-{{$products->fldProductIsVertical}} product-id-{{$products->fldProductID}} first-row">
					<div class="uk-overlay-hover   uk-scrollspy-inview uk-animation-fade" data-uk-modal="{target:'#modal-1'}" >
						<figure class="uk-overlay uk-cover-background " data-src="{{PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.LARGE_IMAGE.$products->fldProductImage}}" style="background-image:url('{{PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.MEDIUM_IMAGE.$products->fldProductImage}}')">
							<img src="{{url('_front/assets/images/ajax-loader.gif')}}" class="w100 uk-width-1-1" width="350" height="350"/>
							<figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom">
								<h3 class="">{{ $products->fldProductName }}</h3>
								<div class="sub-title roboto light-grey uk-margin-small-bottom">{{ $products->fldProductSubTitle }}</div>
								<div class="price fweight-100 light-grey light">From
									@if( ($lowest_price > 0 && $highest_price > 0) && ($lowest_price != $highest_price))
										<span class="bold white">${{ number_format(check_numeric($lowest_price),2) }}</span>
										<span class="price fweight-100 light-grey light">To</span>
										<span class="bold white">${{ number_format(check_numeric($highest_price),2) }}</span>
									@else
										<span class="bold white">${{ number_format(check_numeric($fldProductPrice),2) }}</span>
									@endif
								</div>
							</figcaption>
							<a class="uk-position-cover" href="{{ url('products/details/'.$products->fldProductSlug) }}"></a>
						</figure>
					</div>
				</div>
				<?php
					$row_column_counter++;
				?>
				@endforeach
			@endif

		</div>

		<div class="uk-width-1-1 uk-text-center uk-margin-medium-bottom uk-margin-medium-top">
			<a href="{{ $pages->fldPagesButtonLinks }}" class="uk-button fnone uk-button-trans uk-container-center uk-margin-large-top  white uk-margin-large-bottom text-uppercase"
			  class="roboto">{!!$pages->fldPagesButton!!}</a>
		</div>
		<?php /* $pages->fldPagesDescription */ ?>
	</div>
</div>

@stop @section('headercodes')
<style>
.featured-photos-section figure{
	text-align: center;
}
.featured-photos-section figure img{
    width: 100%; height: auto;
    margin: auto; opacity: 0;
}
.featured-photos-section figure figcaption{
	text-align: left;
}
.featured-photos-section.gallery-style-1 .uk-cover-background {
    margin: auto 5px;
    background-size: contain; background-repeat: no-repeat; background-color:#191919;
}
.featured-photos-section.gallery-style-1 .uk-grid > * { margin-bottom: 10px; }


</style>
<script>
	var url = "{{ url('/') }}";
</script>
 {!! Html::script('/public/_front/assets/js/cart.js') !!}
@stop @section('extracodes') {{-- */ /* */ /* --}}
<script>

	var first_active = 0;
	var this_current_slide = 1;
	var array_remove_class = [16, 33, 66, 83];
	$('#homeslideshow .uk-slideshow li').css({
		'opacity': 1
	});
	jQuery(document).ready(function () {
		loadcssfile('{!!url("_front/assets/css/home.css")!!}', 'css');
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
					// $(".slide-item-"+this_current_slide+" section.aw-accordion div.slide-acc-item" ).each(function() {
					// 	this_slid_cc_item = $(this);
					//     for(var removeclass = 0; removeclass <  array_remove_class.length; removeclass++){
					// 		this_slid_cc_item.removeClass('left-'+array_remove_class[removeclass]);
					// 	}
					// 	this_slid_cc_item.addClass('transform-none');
					// });
				}
			});


			// ADDITIONAL JS FOR SAFARI
			$('ul.uk-dotnav').find('li').on('click', function (){
				$(this).siblings().removeClass('uk-active');
				$(this).addClass('uk-active');
				var index = $(this).index();
				$('ul.uk-slideshow').find('li:eq('+index+')').siblings().removeClass('show-this');
				$('ul.uk-slideshow').find('li:eq('+index+')').addClass('show-this');
			});

			$('ul.uk-slideshow').find('li').on('click', function (){
				$(this).siblings().removeClass('show-this');
				$(this).addClass('show-this');
				var index = $(this).index();
				$('ul.uk-dotnav').find('li:eq('+index+')').siblings().removeClass('uk-active');
				$('ul.uk-dotnav').find('li:eq('+index+')').addClass('uk-active');
			});

		}
		$(window).resize(function () {
			init_accordion_slideshow();
		});

	});
</script>

@stop