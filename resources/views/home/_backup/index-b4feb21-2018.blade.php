@extends('layouts._front.home') @section('content')


<div class="full-layout smaller-padd-grid featured-photos-section gallery-style-1">
	<div class="uk-width-1-1">
		<h2 class="text-uppercase uk-text-center">Featured Photos</h2>

		<div class="uk-grid">
			<?php 
				$featured_photos = array(); $featured_photos_horizontal = array();
				foreach($product_horizontal as $product_horizontal_item){
					$featured_photos_horizontal[] = $product_horizontal_item;
				}
				$row_column_counter = 0; $row_counter = 0;
				$count_total_vertical_products = count($product_vertical);
				$total_vertical_products_half = $count_total_vertical_products / 2;
				$vertical_width = 1;
				

			?>
			@foreach($product_vertical as $products)
			<?php 
				if($row_column_counter == 0){
					if(count($featured_photos_horizontal) > 0){
						if(isset($featured_photos_horizontal[$row_counter])){
							$this_product_vertical_item = $featured_photos_horizontal[$row_counter];
							?>
							<div class="uk-width-6-10 photo-{{$row_column_counter}} product-type-{{$this_product_vertical_item->fldProductIsVertical}} first-row">
								<div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" data-uk-modal="{target:'#modal-1'}" style="background-image:url('{{PRODUCT_IMAGE_PATH.$this_product_vertical_item->fldProductSlug.'/'.$this_product_vertical_item->fldProductImage}}')">
									<figure class="uk-overlay">										
										<figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom">
											<h3 class="">{{ $this_product_vertical_item->fldProductName }}</h3>
											<div class="sub-title roboto light-grey uk-margin-small-bottom">{{ $this_product_vertical_item->fldProductSubTitle }}</div>
											<div class="price fweight-100 light-grey light">From
												<span class="bold white">${{ number_format($this_product_vertical_item->fldProductPrice,2) }}</span>
											</div>
										</figcaption>
										<a class="uk-position-cover" href="{{ url('products/details/'.$this_product_vertical_item->fldProductSlug) }}"></a>
									</figure>
								</div>
							</div>
							<?php
						}
					}
					$row_counter++;
				}
			?>
			<div class="uk-width-{{$vertical_width}}-10 product-type-{{$products->fldProductIsVertical}} first-row">
				<div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" data-uk-modal="{target:'#modal-1'}"  style="background-image:url('{{PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.MEDIUM_IMAGE.$products->fldProductImage}}')">
					<figure class="uk-overlay">
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
			<?php 	
				$row_column_counter++;					
			?>
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
<style>
.featured-photos-section figure{
	text-align: center; height:410px;
}
.featured-photos-section figure img{	
    max-height: 158px;
    width: auto;
    margin: auto;
}
.featured-photos-section figure figcaption{
	text-align: left;
}
.featured-photos-section.gallery-style-1 .uk-cover-background {
    margin: auto 5px;
    background-size: cover;
}
.featured-photos-section.gallery-style-1 .uk-grid > *{ margin-bottom: 10px; }
.smaller-padd-grid .uk-grid > .product-type-0 .uk-cover-background.photo-0 {
    margin-left: 10px;
}
.smaller-padd-grid .uk-grid > .product-type-0 .uk-cover-background.photo-{{$row_column_counter}} {
    margin-right: 10px;
}
.uk-width-1-3-10 {
    width: 13.33%;
}

</style>
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