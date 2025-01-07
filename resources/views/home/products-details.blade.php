@extends('layouts._front.new_collection.layouts.detailsapp')
    
@section('content')

<?php

  $product_option_class = new \App\Models\ProductOptions;
  function fractionized($first_fraction){
	$first_fraction_explode = explode('/', $first_fraction);
	if(isset($first_fraction_explode[0]) && isset($first_fraction_explode[1])){
	  if($first_fraction_explode[0] > 0 && $first_fraction_explode[1] > 0){
		$first_fraction = '<sup>'.$first_fraction_explode[0].'</sup>&frasl;<sub>'.$first_fraction_explode[1].'</sub>';
	  }elseif($first_fraction_explode[0] > 0){
		$first_fraction = $first_fraction_explode[0];
	  }elseif($first_fraction_explode[1] > 0){
		$first_fraction = $first_fraction_explode[1];
	  }
	}
	if($first_fraction == '0'){
	  $first_fraction = '';
	}
	return $first_fraction;
  }
  $fldProductIsVertical = 0; $main_img_width = 706;
  if($product->fldProductIsVertical > 0){
	$fldProductIsVertical = 1;
  }


  $get_static_frames = config('constants.frames');
  $get_static_frames_count = count($get_static_frames);

  function stringify_items($array_temp){
	$stringifyied_string = '';
	if(count($array_temp) > 0){
	  if(isset($array_temp['value'])){
		$stringifyied_string = $array_temp['value'];
	  }else{
		foreach($array_temp as $array_temp_item){
			if($stringifyied_string != ''){
			  $stringifyied_string .= ',';
			}
			if(isset($array_temp_item['value'])){
			  $stringifyied_string .= $array_temp_item['value'];
			}else if($array_temp_item == 'value'){
			  $stringifyied_string .= $array_temp_item;
			}
		}
	  }
	}
	return $stringifyied_string;
  }

  function check_numeric($said_number){
	$said_number_to_numeric = 0;
	if(is_numeric($said_number)){
	  $said_number_to_numeric = $said_number;
	}else{
	  $said_number_to_numeric = 0;
	}
	return $said_number_to_numeric;
  }

  function get_expensive_costs(){
	return config('constants.expensive_item_costs');
  }


?>

        <div class="main-part">
            <section class="banner-part" style="background: url('{{ asset('_new_collection/assets/images/banner1.png') }}') no-repeat center center; background-size:cover;">
                <div class="container">
					<div class="banner-inner">
						<h2 class="text-uppercase">Featured Detail</h2>
                    </div>
                </div>
            </section>
			<section class="bread-crumb-part">
                <div class="container">
                    <div class="bread-crumb-inner">
                        <ul>
                            <li><a href="{{ url('collection') }}">Collection</a></li>
                            @if(!empty($category_details))<li><a href="{{ url('collection/'.$category_details->fldCategorySlug) }}">{!! $category_details->fldCategoryName !!}</h2></a></li>@endif
                            <li class="active"><a href="#">{!!$product->fldProductName!!}</a></li>
                        </ul>
                    </div>
                </div>
				{{--@if(Session::has('error'))
					<div class="uk-alert uk-alert-danger">{{ Session::get('error') }}</div>
				@endif--}}
            </section>

			{!! Form::open(array('action' => 'TempCartController@addShoppingCart', 'method' => 'post')) !!}
				<section class="feature-detail-part">
					<div class="container">
						<div class="feature-detail-inner">
							<div class="row">							
								<div class="col-md-5 col-sm-12 col-xs-12">
									<div class="feature-detail-left parent-container">
										<div class="slider slider-for">											
											<div class="item-slider-for">
												<a href="{!! url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage) !!}"><img src="{!! url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage) !!}" alt="" id="modalImage"  onload="on_render_finish();"></a>
											</div>
											{{--<div class="item-slider-for">
												<a href="{{ asset('_new_collection/assets/images/slider5.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider5.jpg') }}" alt=""></a>
											</div>
											<div class="item-slider-for">
												<a href="{{ asset('_new_collection/assets/images/slider6.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider6.jpg') }}" alt=""></a>
											</div>
											<div class="item-slider-for">
												<a href="{{ asset('_new_collection/assets/images/slider7.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider7.jpg') }}" alt=""></a>
											</div>
											<div class="item-slider-for">
												<a href="{{ asset('_new_collection/assets/images/slider4.png') }}"><img src="{{ asset('_new_collection/assets/images/slider4.png') }}" alt=""></a>
											</div>
											<div class="item-slider-for">
												<a href="{{ asset('_new_collection/assets/images/slider5.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider5.jpg') }}" alt=""></a>
											</div>
											<div class="item-slider-for">
												<a href="{{ asset('_new_collection/assets/images/slider6.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider6.jpg') }}" alt=""></a>
											</div>
											<div class="item-slider-for">
												<a href="{{ asset('_new_collection/assets/images/slider7.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider7.jpg') }}" alt=""></a>
											</div>--}}
										</div>
										{{--<div class="slider slider-nav">
											<div class="item-slider-nav">
												<img src="{{ asset('_new_collection/assets/images/thumb1.png') }}" alt="">
											</div>
											<div class="item-slider-nav">
												<img src="{{ asset('_new_collection/assets/images/thumb2.png') }}" alt="">
											</div>
											<div class="item-slider-nav">
												<img src="{{ asset('_new_collection/assets/images/thumb3.png') }}" alt="">
											</div>
											<div class="item-slider-nav">
												<img src="{{ asset('_new_collection/assets/images/thumb4.png') }}" alt="">
											</div>
											<div class="item-slider-nav">
												<img src="{{ asset('_new_collection/assets/images/thumb1.png') }}" alt="">
											</div>
											<div class="item-slider-nav">
												<img src="{{ asset('_new_collection/assets/images/thumb2.png') }}" alt="">
											</div>
											<div class="item-slider-nav">
												<img src="{{ asset('_new_collection/assets/images/thumb3.png') }}" alt="">
											</div>
											<div class="item-slider-nav">
												<img src="{{ asset('_new_collection/assets/images/thumb4.png') }}" alt="">
											</div>
										</div>--}}
									</div>
								</div>
								<?php
									// $graphikAPI = \App\Models\GraphikDimension::displayAll(6); // for all frames
									// print_r($graphikAPI);

									// echo "<pre>";
									// // print_r($graphikAPI);
									// print_r($graphikAPI->frame);
									// echo "</pre>";
									// die();

									//$color = GraphikDimension::getColor($graphikAPI->frame);
									// list($frameDesc,$frameWidth,$sku,$graphikAPI,$colorValue, $styleValue,$widthValue,$materialValue,$framePrice) = \App\Models\GraphikDimension::getGraphikAttribute($graphikAPI->frame);
									$framePrice = 0;
									$fldProductImagePrice = $fldProductPrice = check_numeric($product->fldProductImagePrice);
								?>
								{!! Form::hidden('image_price',isset($fldProductImagePrice) ? number_format($fldProductImagePrice,2) : number_format($fldProductPrice,2),['id'=>'image_price']) !!}
								{!! Form::hidden('image_size_id',$product->fldProductImageID,['id'=>'image_size_id']) !!}
								{!! Form::hidden('frame_info', null, ['id'=>'frame_info']) !!}
								{!! Form::hidden('frame_border_size', null, ['id'=>'frame_border_size']) !!}
								{!! Form::hidden('frame_price',$framePrice,['id'=>'frame_price']) !!}
								{!! Form::hidden('frame_width',1.5,['id'=>'frame_width']) !!}
								{!! Form::hidden('frame_desc', '',['id'=>'frame_desc']) !!}
								{!! Form::hidden('paper_info', null, ['id'=>'paper_info']) !!}
								{!! Form::hidden('mat1_info','',['id'=>'mat1_info']) !!}
								{!! Form::hidden('mat2_info','',['id'=>'mat2_info']) !!}
								{!! Form::hidden('mat3_info','',['id'=>'mat3_info']) !!}
								{!! Form::hidden('mat1_options','',['id'=>'mat1_options']) !!}
								{!! Form::hidden('mat2_options','',['id'=>'mat2_options']) !!}
								{!! Form::hidden('mat3_options','',['id'=>'mat3_options']) !!}
								{!! Form::hidden('finishkit','',['id'=>'hdn-finishkit']) !!}
								{!! Form::hidden('finishkit_desc','',['id'=>'hdn-finishkit_desc']) !!}
								{!! Form::hidden('product_id1',$product->fldProductID,['id'=>'product_id']) !!}

								{!! Form::hidden('shipprocfee','',['id'=>'shipprocfee']) !!}

								{{--ROI--}}
								{!! Form::hidden('print_fee','',['id'=>'print_fee']) !!}
								{!! Form::hidden('print_name','',['id'=>'print_name']) !!}
								{{--ROI--}}
								{{-- Don Pablo  --}}
								{!! Form::hidden('print_id_add_cart','',['id'=>'print_id_add_cart']) !!}
								{{--  Don Pablo  --}}

								{!! Form::hidden('total_price',number_format($fldProductImagePrice,2),['id'=>'total_price']) !!}
									
								<div class="col-md-7 col-sm-12 col-xs-12">
									<div class="feature-detail-right">
										<div class="feature-detail-right-inner">
											{!! Form::hidden('product_id', $product->fldProductID, array('id' => 'product_id1')) !!}
											{!! Form::hidden('product_id1',$product->fldProductID,array('id'=>'product_id1')) !!}

											<h2>{{ $product->fldProductName }}</h2>
											<h4>YOUR TOTAL: $ <span id="original_price"></span> <span id="totalPrice">Loading..</span></h4>
											<div class="add-btn-wrap">
												<div class="input-append spinner" data-trigger="spinner">
													<input type="text" value="1" name="qty" data-max="1000" data-min="1" data-step="1" id="text-qty">
													<div class="add-on">
														<a href="javascript:;" class="spin-up btn-update-qty" data-spin="up"><img src="{{ asset('_new_collection/assets/images/up-arrow.png') }}" alt=""></a>
														<a href="javascript:;" class="spin-down btn-update-qty" data-spin="down"><img src="{{ asset('_new_collection/assets/images/down-arrow.png') }}" alt=""></a>
													</div>
												</div>
												{!! Form::button('Add to cart ',array('class'=>'btn-add-to-cart','type'=>'submit','name'=>'submit'))!!}
											</div>

											<div class="product-container">
												@if (count($productOption) > 0)								
													@include('home.product_details.frame')								
												@else
													NO AVAILABLE SIZES - NO DATA FOUND
													<script type="text/javascript">
														$("#frame-selection").hide();
														$("#add-to-cart").hide();
														$("#totalPrice").hide();
														$("#original_price").text('{{number_format($fldProductPrice,2)}}');
														
													</script>
												@endif
											</div>
										</div>
									</div>
								</div>							
							</div>
							@if(!empty($product->ProductFeaturedPagImagee))
							<div class="row" style="margin-top: -15%;">
								<div class="col-md-5 col-sm-12 col-xs-12">
									<div class="feature-detail-left parent-container">
											<div class="slider slider-for">											
												<div class="item-slider-for">
													<a href="{!! url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->ProductFeaturedPagImagee) !!}"><img src="{!! url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->ProductFeaturedPagImagee) !!}" alt="" id="modalImage"  onload="on_render_finish();"></a>
												</div>
											</div>
									</div>
								</div>
							</div>
							@endif
						</div>
						
						{{--<div class="uk-hidden">
							@include('home.product_details.paper')
							<input type="hidden" id="is_prod_vertical" value="{{$product->fldProductIsVertical}}">
							<input type="hidden" id="count_product_option" value="{{count($productOption)}}">
						</div>--}}
					</div>
				</section>
			{!! Form::close() !!}
        </div>
@endsection
@section('headercodes')
<meta name="csrf-token" content="{{ csrf_token() }}">
{!! Html::style('_front/plugins/swiper-4.1.6/dist/css/swiper.min.css') !!}
<style>
@media screen and (max-width: 767px){
  .wrap.content{ padding-top: 0; }
}
</style>
<script>
var frames_array = new Array(), frame_materials = new Array(), sortMeBy = {}, generateSldieshow = {}, getPackagePrice = {};
function on_render_finish(){
  $('.frame-style-box').removeClass('rendering-img');
}

{{-- function checkImageHeight(img) {
    if (img.height >= 1500) {
        img.style.height = 'auto';
    } else {
        img.style.height = '430px'; // Ensure height is not set if greater than 430px
    }
  } --}}
  function checkImageHeight(img) {
    if (img.height >= 1500) {
        img.style.height = 'auto';
    } 

    if (img.width > img.height) {
		document.querySelector('.uk-modal-dialog').style.maxWidth = '100%';
		document.querySelector('.uk-modal-dialog').style.width = '100%'
    }
}


</script>
@stop
@section('extracodes')
{!! HTML::script('_front/plugins/uikit/js/components/grid.min.js') !!}
{!! HTML::script('https://clarkincollection.com/public/_front/assets/swiper.min.js') !!}
{!! Html::script('_front/assets/js/cart.js') !!}
<script>
var load_only_once = 0, load_mats_only_once = 0;
var photo_size_counter_clicked = 0, get_all_photo_sizes_counter = 0, linerw = 2;
var v_frame_desc = '',
  v_frame_desc = '',
  v_frame_sku = '',
  v_frame_liner = '',
  v_frame_width = '',
  v_frame_style = '',
  v_frame_color = '',
  v_frame_is_cheap = '';
var image_src = "{{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage) }}";
function load_javascripts(){

}
	var client_frame_array = new Array('BWL2', 'GO4', 'GO6', 'PEC6', 'RSP3', 'SA9', 'WVL2', 'WVL3', 'WVL4', 'WVL5');
	$(document).ready(function(){
		// var qt=	$('#text-qty').val();
		// var pr = $("#image_price").val().replace(',' , '');
		// var tt = qt * pr;
		// console.log(tt);
		// $('#totalPrice').text(tt.toFixed(2));
	 	 //frames_slider = UIkit.slideshow($('#frame_slider'), { });

		clicked_photo_option();
		if($('#count_product_option').val() > 0){
		loadFrameSlider(2);
		}

	  //getGraphikFrames();
	  function getFrameWidthSelectionValues(this_value){
		if(this_value != undefined){
		  $('#frameWidth option').each(function(){
			var myString = $(this).val();
			var myArray = myString.split('-'); //explode
			if(myArray.length > 0){

			  var first_option = myArray[0];
			  var second_option = myArray[1];
			  if(this_value >= first_option && this_value <= second_option){
				return myString;
			  }
			}
		  });
		}
	  }
	  function getFrameWidthEquivValues(this_value){
		var equiv_number = '';
		if(this_value != undefined){
		  if(this_value <= 1){
			equiv_number = '0-1';
		  }else if(this_value <= 2){
			equiv_number = '1-2';
		  }else if(this_value <= 3){
			equiv_number = '2-3';
		  }else if(this_value > 3){
			equiv_number = '3-10';
		  }
		  return equiv_number;
		}
	  }
	  function getFrameWidthSelectionValuesVV(this_option_value){
		if(this_option_value != undefined){
			var myArray = this_option_value.split('-'); //explode
			if(myArray.length > 0){
			  return myArray;
			}
		}
	  }

	  /*$('.radio-option-wrapper .photo-size-selection-option').on('change', function(){
		//$('#frameDisplay').html('<div class="uk-alert uk-alert-warning">Loading..</div>');
		generateSldieshow();
	  });*/



	  function set_frame_slider_h(){
		  var get_image_h = $('#frame_slider .frame-slider-subitem img#frameimg-0').innerHeight();
		  var get_frameslider_h = $('#frame_slider .uk-slideshow').innerHeight();
		  // console.log('set_frame_slider_h');
		  // console.log(get_frameslider_h);
		  // console.log(get_image_h);
		  // console.log((get_frameslider_h < get_image_h));
		  if(get_frameslider_h < get_image_h){
			// console.log('#frame_slider .uk-slideshow set height '+get_image_h);
			$('#frame_slider .uk-slideshow').css('height',get_image_h+'px !important');
			//$('#frame_slider .uk-slideshow .frame-slider-item').css('height',get_image_h+'px !important');
		  }else{
			// console.log('#frame_slider .uk-slideshow set height '+get_image_h);
		  }
	  }



	  generateSldieshow = function(){
		// console.log('generateSldieshow');
		var filter_array_values = new Array();
		var search_sku = $('#txtSKU').val();
		$('#graphikAttribute .select-wrapper select').each(function(){
		  var this_val = $(this).val();
		  var this_id = $(this).attr('id');
		  if(this_val != undefined && this_val != ''){
			filter_array_values[this_id] = this_val;
		  }
		});
		// console.log(filter_array_values);

		var slideshow_html_array = new Array();
		var frame_ss_page = 0, frame_ss_column = 0, slideshowhtml = '', include_me = false, something_was_included = false;


		 $.each(frames_array, function(obj_index, obj_value ){

			include_me = false;
			var this_short_desc = obj_value.shortDescription;
			var this_material = obj_value.material;
			var this_filterValue = obj_value.filterValue;
			var vargetFrameWidthSelectionValuesVV = '';
			if(obj_value.frameWidthValue != undefined){
			  vargetFrameWidthSelectionValuesVV = getFrameWidthEquivValues(obj_value.frameWidthValue);
			}


			if(vargetFrameWidthSelectionValuesVV == filter_array_values['frameWidth']){
			  include_me = true;
			}

			if(this_filterValue.indexOf(filter_array_values['frameColor']) !== -1){
			  include_me = true;
			}else
			if(this_filterValue.indexOf(filter_array_values['frameStyle']) !== -1){
			  include_me = true;
			}
			if(search_sku != ''){
			  // console.log(obj_value.sku);
			  // console.log(search_sku);
			  if(obj_value.sku == search_sku){
				include_me = true;
			  }else{
				include_me = false;
			  }
			}

			if(include_me){
			  something_was_included = true

			  if(frame_ss_column > 6){
				slideshow_html_array[frame_ss_page] = slideshowhtml;
				frame_ss_page++, frame_ss_column = 0; slideshowhtml = '';
			  }
			  if(obj_value.sku != undefined){
				slideshowhtml += '<div class="uk-width-1-3 frame-slider-subitem">';
				this_short_desc = this_short_desc.replace(/^"|"$/g, '');

				slideshowhtml += '<img src="http://image.pictureframes.com/images/angled_corners/'+obj_value.sku+'_l.jpg" width="175" height="175" onClick="changeFrame(\''+obj_value.sku+'\',\''+obj_value.frameWidthValue+'\','+obj_value.priceData.markUpPrice+',\''+this_short_desc+'\')" alt="'+obj_value.shortDescription+'" data-filter="'+obj_value.filterValue+'" data-sku="'+obj_value.sku+'"  data-material="'+this_material+'" /><div class="uk-cover uk-hidden">'+obj_value.shortDescription+'</div>';
				if($.inArray( this_material, frame_materials )){
				  frame_materials.push(this_material);
				}
				slideshowhtml += '</div>';



				frame_ss_column++;
			  }
			} //includeme?
		  });


		 // // console.log(slideshowhtml);
		 // // console.log(frame_ss_column);
		 if(slideshowhtml != '' & frame_ss_column > 0){
		 // // console.log('slideshow_html_array['+frame_ss_page+']');
		 // // console.log(slideshowhtml);
		  slideshow_html_array[frame_ss_page] = slideshowhtml;
		  frame_ss_page++;
		 }


	  }


	  function loadFrameSlider(frame_ss_page){

		  var swiper = new Swiper('.swiper-container', {
			slidesPerView: 3,
			spaceBetween: 6,
			loop:true,
			pagination: {
			  el: '.swiper-pagination',
			  clickable: true,
			},
			navigation: {
			  nextEl: '.swiper-button-next',
			  prevEl: '.swiper-button-prev',
			},
			on: {
			  init: function () {
				// console.log('swiper initialized');
				$('#frame-selection').css('opacity',1);
			  },
			},
		  });
	  }



	  $('[data-uk-switcher]').on('show.uk.switcher', function(event, area){
		  load_javascripts();
		  // console.log('show.uk.switcher');
		  //// console.log(area);
		  // console.log($(area[0]));
		  var this_current_tab = $(area[0]);
		  var this_current_tab_id = this_current_tab.attr('data-tab-id');
		  if(this_current_tab_id == 'mats' && load_mats_only_once == 0){
			$.ajax({
			  type: "GET",
			  url: "{{url('product-api')}}/"+this_current_tab_id,
			  cache: false,
			  success: function(data){
				  // console.log(data);
				  var this_data = JSON.parse(data);
				  load_mats_only_once = 1;
				  $('div#matcolor.uk-modal .modal-html').html(this_data);
				}
			});
		  }else if(this_current_tab_id == 'frames'){

			$('#frame-selection').css('opacity', '1');
			$('#frameDisplay').css('opacity', '1');

		  }
	  });


	  load_only_once++;

		function loadScript(src, callback) {
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = src;
			script.onload = callback;
			document.head.appendChild(script);
		}

		loadScript("{!! url('_front/plugins/spinner/src/jquery.spinner.js') !!}", function() {
			// Initialize the spinner when the script is loaded
			$('#customize-spinner').spinner('changed', function(e, newVal, oldVal) {
				alert(newVal + ' ' + $("#size_height").val());
			});
			$('#customize-spinner-height').spinner('changed', function(e, newVal, oldVal) {
				alert(newVal + ' ' + $("#size_width").val());
			});
		});

		load_javascripts();
	   // $('#frameDetails').hide();

	});

	function displayFrames() {

	}

	function hideFrames() {
	   // $('#frame-selection').hide();
	}

	function resetme(){
	  $('#graphikAttribute input').each(function(){ $(this).val(''); });
	  $('#graphikAttribute select').each(function(){ $(this).val(''); });

	   displayLoader();
	   setTimeout(function(){
		 /* $('#frameDisplay').load("{{ url('frames/display') }}", function() {

		  });*/
		  //getGraphikFrames();
		},1000);
	}

	function getGraphikFrames(){
	  // console.log("{{url('frames/display')}}");
	  $.ajax({
		type: "GET",
		url: "{{url('frames/display')}}",
		cache: false,
		success: function(data){
			// console.log(data);
			$('#frameDisplay').html(data);

		  }
	  }).done(function(data){
		  // console.log('done');
		  // console.log(data);
		  //frames_slider = UIkit.slideshow($('#frame_slider'), { start:0 });
	  });
	 }

	function changeFrame(newSku,newFrameWidth,price,frameDesc) {

		$('#frame_selection').val(newSku);
		//$('#frame_selection').trigger('change');
		$('#toggle-frame-details').removeClass('uk-hidden');

		generateNewImageFrame();
		$('#div_prod_loading').removeAttr('style');
	$('#h2_prod_loading').attr('hidden','hidden');
		// console.log('#toggle-frame-detail removeClass ukhidden');

	}
	var clicked_photo_option = function(){
		var photo_size_counter_clicked_temp = window.photo_size_counter_clicked;
		var get_all_photo_sizes = document.querySelectorAll('.photo-size-selection-option');
		var get_all_photo_sizes_counter_temp = get_all_photo_sizes.length;
		window.get_all_photo_sizes_counter  = get_all_photo_sizes_counter_temp;
		var photo_size_counter_clicked_temp_ = photo_size_counter_clicked_temp;
		// console.log('trigger clicked');
		// console.log('get_all_photo_sizes['+photo_size_counter_clicked_temp_+']');
		// console.log(get_all_photo_sizes[photo_size_counter_clicked_temp_]);
		photo_size_counter_clicked_temp++;
		window.photo_size_counter_clicked = photo_size_counter_clicked_temp;
		$(get_all_photo_sizes[photo_size_counter_clicked_temp_]).trigger('click');

		/*$('.photo-size-selection-option').each(function(){

		  var this_radio_option = $(this);
		  var this_radio_option_val = this_radio_option.val();
		  setTimeout(function(){
			this_radio_option.trigger('click');
			//this_radio_option.prop("checked", true);
			//generateNewImageFrame();
			photo_size_timer+=3000;
			// console.log(this_radio_option);
			// console.log('treigger click');
			// console.log(photo_size_timer);
		  }, photo_size_timer);
		});*/

	}

	function searchFrame() {
		var search =   $('#txtSKU').val();
		 //UIkit.grid($("#gridFilter")).filter($('#txtSKU').val());
		displayLoader();
		 /* $.ajax({
				type: "GET",
				url: "{{ url('frames/search_sku/') }}/" +search ,
				cache: false,
				success: function(){
				  $('#frameDisplay').load("{{ url('frames/search_sku/') }}/"+search, function() {
					 frames_slider = UIkit.slideshow($('#frame_slider'), { height: '50' });
					 $("#frameLoader").hide();
				  });
			   }
		  });*/
	  setTimeout(function(){
		 generateSldieshow();
	  },1000);

	}

	  function loadColors(color) {
		//get the selected value of width, styles and material
		var frameWidth = $('#frameWidth').val();
		var frameStyle = $('#frameStyle').val();
		var frameMaterial = $('#frameMaterial').val();
		var sortByVal = $('#sortby').val();
		$('#txtSKU').val('');
		displayLoader();
		/*$.ajax({
			  type: "GET",
			  url: "{{ url('frames/attributes/') }}/" +color+"/"+frameWidth+"/"+frameStyle+"/"+frameMaterial+"/"+sortBy,
			  cache: false,
			  success: function(){
				$('#frameDisplay').load("{{ url('frames/attributes/') }}/"+color+"/"+frameWidth+"/"+frameStyle+"/"+frameMaterial+"/"+sortBy, function() {
					   frames_slider = UIkit.slideshow($('#frame_slider'), { height: '231' });
				 });
			 }
		});*/
		/*$.each(){

		}*/
	  }
	  function displayLoader() {
		 $('#frameDisplay').html('<div class="uk-alert uk-alert-warning uk-margin-top"><i class="uk-icon-spinner uk-icon-spin"></i> <strong>Please wait!</strong> Loading available frames.</div>');
	  }
	  function loadWidth(width) {
		var frameColor = $('#frameColor').val();
		var frameStyle = $('#frameStyle').val();
		var frameMaterial = $('#frameMaterial').val();
		var sortByVal = $('#sortby').val();
		$('#txtSKU').val('');
		displayLoader();
		/* $.ajax({
			  type: "GET",
			  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+width+"/"+frameStyle+"/"+frameMaterial+"/"+sortByVal,
			  cache: false,
			  success: function(){
				$('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+width+"/"+frameStyle+"/"+frameMaterial+"/"+sortByVal, function() {
					   frames_slider = UIkit.slideshow($('#frame_slider'), { start:0});
				 });
			 }
		});*/
	  }
	  function loadStyle(style) {
			var frameColor = $('#frameColor').val();
			var frameWidth = $('#frameWidth').val();
			var frameMaterial = $('#frameMaterial').val();
			 var sortByVal = $('#sortby').val();
			$('#txtSKU').val('');
			displayLoader();
			/*$.ajax({
				  type: "GET",
				  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+frameWidth+"/"+style+"/"+frameMaterial+"/"+sortByVal,
				  cache: false,
				  success: function(){
					$('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+frameWidth+"/"+style+"/"+frameMaterial+"/"+sortByVal, function() {
					   frames_slider = UIkit.slideshow($('#frame_slider'), { start:0 });
					});
				 }
			});*/
	  }
	  function loadMaterial(material) {
			var frameColor = $('#frameColor').val();
			var frameWidth = $('#frameWidth').val();
			var frameStyle = $('#frameStyle').val();
			var sortByVal = $('#sortby').val();
			$('#txtSKU').val('');
			 displayLoader();
		   /* $.ajax({
				  type: "GET",
				  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+frameWidth+"/"+frameStyle+"/"+material+"/"+sortByVal,
				  cache: false,
				  success: function(){
					$('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+frameWidth+"/"+frameStyle+"/"+material+"/"+sortByVal, function() {
					   frames_slider = UIkit.slideshow($('#frame_slider'), {start:0 });
					 });
				 }
			});*/
	  }
	  function loadSort(sortByField) {

		$('#txtSKU').val('');
		displayLoader();

		window.sortMeBy(frames_array, (item) => [item.shortDescription]);
		generateSldieshow();

	  }
	  function confirm_print_on_canvas() {
		  UIkit.modal.confirm('Your selection is not compatible with parts currently in your package. <br/>Click OK to continue.', function(event){
		  }, function(){
			cancel_confirm_print_on_canvas();
		  });
	  }
	  function cancel_confirm_print_on_canvas(){
	   <?php $printOn = Input::old('print_on'); ?>
		@if($printOn == "paper")
		  $('input#print_on_canvas').removeAttr('checked');
		  $('input#print_on_paper').prop( "checked", true);
		@elseif($printOn == "canvas")
		   $('input#print_on_paper').removeAttr('checked');
		   $('input#print_on_canvas').prop( "checked", true);
		@else
		   $('input#print_on_canvas').removeAttr('checked');
		  $('input#print_on_paper').prop( "checked", true);
		@endif
			$('.toggle-me').each(function(){

			   @if($printOn == "paper" || $printOn == "")
				  if($(this).hasClass('print_on_paper_toggler')){
					  $(this).addClass('uk-active-toggle'); $(this).removeClass('uk-hidden');
				  }else{
					   $(this).addClass('uk-hidden');
				  }
				@else
				  if($(this).hasClass('print_on_canvas_toggler')){
					  $(this).addClass('uk-active-toggle'); $(this).removeClass('uk-hidden');
				  }else{
					   $(this).addClass('uk-hidden');
				  }
				@endif
			  });
	   }
	   /**
		* get package price in api
		* @return {[type]} [description]
		*/

	   getPackagePrice = function () {

		  paperSku  = $('#paperSKU').html();
		  paperType = $("input[name='print_on']:checked").val();
		  canvasStyle = $("input[name='wrap_options']:checked").val();
		  borderStyle = getBorderStyle();
		  frameSku  = $('#frame_info').val();
		  productId = $('#product_id').val();
		  image_width = $('#descImageWidth').text();
		  image_height = $('#descImageHeight').text();

		  mats_width = $( "#matborder_whole" ).val() + $( "#matborder_fractions" ).val();
		  finishkitSku = $('#hdn-finishkit').val();
		  mats = [];
		  mat_options = [];
		  if($('input[name="mat_type"]').is(':checked')){
			  no_of_mats =  $('input[name="mat_type"]:checked').val();
			  no = 1;
			  error = false;
			  for(no=1; no <= no_of_mats; no++){
				  if($('#mat'+no+"_info").val()){
					  m = $('#mat'+no+"_info").val();
					  selected = m.split(";");
					  mats.push(selected[0]);
					  mat_options[no] = [];
					  if(no > 1){
						mat_options[no].push($('select[name="offset'+no+'"]').val());
					  }
					  $.each($('input[name="option'+no+'[]"]:checked'), function(){
						  mat_options[no].push($(this).val());
					  });
				  }
			  }
		  }
		  // console.log('mats_width');
		  // console.log(mats_width);
		  // console.log('finishkitSku');
		  // console.log(finishkitSku);
		  var current_frame_size_val = $('input[name="imageSize"]:checked').val();
		  // console.log('current_frame_size_val');
		  // console.log(current_frame_size_val);
		  // console.log('input.photo-size-selection-option-'+current_frame_size_val);
		  var current_frame_size_price = $('input.photo-size-selection-option-'+current_frame_size_val).attr('data-frame_cost');
		  // console.log('current_frame_size_price');
		  // console.log(current_frame_size_price);

		  // console.log("(typeof current_frame_size_val != 'undefined')");
		  // console.log((typeof current_frame_size_val != 'undefined'));
		  if(typeof current_frame_size_val != 'undefined'){
			 var frame = { 'sku' : frameSku, 'priceData' : { 'markUpPrice' : current_frame_size_price }};
			updateFrameData(frame)
			updateComputations(current_frame_size_val, current_frame_size_price);
		  }

	   }

	  function updateFrameData(frame){
		if(frame != null){
		  $('#frame_info').val(frame.sku);
		  $('#framePrice').text(parseFloat(frame.priceData.markUpPrice).toFixed(2));
		}
	  }

	function updateComputations(current_frame_size_val, current_frame_size_price){
	  //var image_price = $('#image_price').val();

	  	var image_price = parseFloat(current_frame_size_price);
	  	// alert(image_price);
		/*ROI*/
        var print_price = $('.prints_selection').find(':selected').data('price');
        var grafikCostPrintOnly = $("defaultcost").val();
	  	// alert(print_price);
	  	// alert(grafikCostPrintOnly);

        if(print_price){
            // var grand_t = (image_price+print_price).toFixed(2);
            var grand_t = image_price.toFixed(2);
        }else{
            var grand_t = image_price.toFixed(2);
        }
	  	// alert(grand_t);
		/*ROI*/

		var image_price_tofixed = image_price.toFixed(2);

	  $("#descImagePrice").html(image_price_tofixed);
	  $("#image_price").val(image_price_tofixed);

	  $('#grandTotalL').text(grand_t);
	  //console.log('here');


	  $('#totalPrice').text(grand_t);
	  // $('#totalPrice').text(807);
	  $('#merchandiseTotal').text(0.00);
	  $('#feeTotal').text(0.00);
	  $('#promotionTotal').text(0.00);
	  /*bry*/
	  //$('.price-start-'+current_frame_size_val).text(image_price_tofixed);

	  //$('.price-start-'+photo_size_selected_val).text(grandTotal.toFixed(2));

	  // console.log(window.photo_size_counter_clicked + ' < = '+ window.get_all_photo_sizes_counter);
	  // Commented 05-03-2021
	//   if(window.photo_size_counter_clicked <= window.get_all_photo_sizes_counter ){
	// 	clicked_photo_option();
	//   }
	}

	function updateMatsPrices(response){
		  var a = 1;
		  if(response.mats != null) {
			  no_of_mats = $('input[name="mat_type"]:checked').val();
			  if(no_of_mats == 1){
				response.mats = [];
				response.mats[0] = response.mat1;
			  }
			  $.each(response.mats, function(i, mat){
				  $("#matDetails"+a+"_Price").html(parseFloat(mat.priceData.wholesalePrice).toFixed(2));
					if(mat.VGrooved == "true"){
					  $('#VGroove1').text(parseFloat(response.VGroove.priceData.wholesalePrice).toFixed(2));
					}
					if(mat.raised == "true"){
					  switch(a){
						case 1:
						  $('#raisedMat1').text(parseFloat(response.raisedMat1.priceData.wholesalePrice).toFixed(2));
						break;
						case 2:
						  $('#raisedMat2').text(parseFloat(response.raisedMat2.priceData.wholesalePrice).toFixed(2));
						break;
						case 3:
						  $('#raisedMat3').text(parseFloat(response.raisedMat3.priceData.wholesalePrice).toFixed(2));
						break;
						default:
						break;
					  }
					}
					if(mat.reverseBevelCut == "true"){
					  switch(a){
						case 1:
						  $('#reverseBevelCut1').text(parseFloat(response.reverseBevelCut1.priceData.wholesalePrice).toFixed(2));
						break;
						case 2:
						  $('#reverseBevelCut2').text(parseFloat(response.reverseBevelCut2.priceData.wholesalePrice).toFixed(2));
						break;
						case 3:
						  $('#reverseBevelCut3').text(parseFloat(response.reverseBevelCut3.priceData.wholesalePrice).toFixed(2));
						break;
						default:
						break;
					  }
					}
				  a++;
			  });
		  }
	  }
	  function updateFinishkitData(finishkit){
		  if(finishkit != null){
			  $('#FKName').text(finishkit.shortDescription);
			  $('#FKPrice').text(parseFloat(finishkit.priceData.markUpPrice).toFixed(2));
			  //$('#FKPrice').text(parseFloat(finishkit.priceData.staticPrice).toFixed(2));
		  }
	  }
	  function getBorderStyle() {
		  paperType = $("input[name='print_on']:checked").val();
		  canvasStyle = $("input[name='wrap_options']:checked").val();
		  if(paperType != 'canvas')
			return null;
		  switch(canvasStyle){
			case 'GW':
			  return $('select[name="gw_options"]').val();
			break;
			case 'MW':
			  return $('select[name="mw_options"]').val();
			break;
			default:
			  return null;
			break;
		  }
	  }
	  function updatePaperData(response) {
		// console.log(response);
		if(response.substrate != null){
		   $('#paperSKU').text(response.substrate.sku);
			$('#paperPrice').text(parseFloat(response.substrate.priceData.wholesalePrice).toFixed(2));
		}
		if(response.stretcherBar != null){
			$('.canvasStretcher').show();
			$('#stretcherSKU').text(response.stretcherBar.sku);
			$('#stretcherPrice').text(parseFloat(response.stretcherBar.priceData.wholesalePrice).toFixed(2));
		}else{
			$('.canvasStretcher').hide();
			$('#stretcherSKU').text("");
			$('#stretcherPrice').text("");
		}
	  }
	  // update quantities
	  $('.frame_selection').on('change', function(){
		var this_frame_selection_val = $(this).val();
		var this_frame_selection_option = $('#option_'+this_frame_selection_val);
		var newSku = this_frame_selection_val,
		frameWidth = this_frame_selection_option.data('width'),
		price = this_frame_selection_option.data('price'),
		frameDesc = this_frame_selection_option.data('title');

		changeFrame(newSku, frameWidth, price, frameDesc);


	  });

	  //ROI CHANGES
	  $('.prints_selection').on('change', function(){
          var total = parseFloat($('#grandTotalL').text());
		  var print_price = $(this).find(':selected').data('price');
		  var print_name = $(this).find(':selected').data('text');
          var print_id_add_cart = $("input[name='OptionsFrames']:checked").val();

		  $('#print_fee').val(print_price);
		  $('#print_name').val(print_name);
          $('#print_id_add_cart').val(print_id_add_cart);
		  if(print_price){
              totalQty = total + print_price;
		  }else{
              totalQty = total;
		  }
          $('#totalPrice').text(totalQty.toFixed(2));
          // $('#totalPrice').text(939);

		  //MARK CHANGES
		  updateTotalPrice();
		//   console.log($(this).prop('selectedIndex'));

		  if ($(this).prop('selectedIndex') != 0) {
			$('.frame-print-lbl').removeClass('uk-hidden');
			$('.frame-print-text').removeClass('uk-hidden');
			$('.frame-print-text').text(print_name);
		  } else {
			$('.frame-print-lbl').addClass('uk-hidden');
			$('.frame-print-text').addClass('uk-hidden');
			$('.frame-print-text').text('');
		  }

		  //MARK CHANGES
	  });
      //ROI CHANGES

	  $('#text-qty').change(function () {
		  var qty = $(this).val();
		  var total = parseFloat($('#grandTotalL').text());
		  var print_price = $('.prints_selection').find(':selected').data('price');

          //ROI CHAtotalNGES
		  if(print_price){
              totalQty = (total + print_price) * qty;
		  }else{
              totalQty = total * qty;
		  }
          //ROI CHANGES
//console.log('here');

		  $('#totalPrice').text(totalQty.toFixed(2));
		  // $('#totalPrice').text(975);

		  //MARK CHANGES
		  updateTotalPrice();
		  //MARK CHANGES
	  });

	  //MARK CHANGES
	  $('#text-qty').blur(function() {
		$(this).trigger('change');
	  });

	  function updateTotalPrice() {

			var qty = $('#text-qty').val();

			var print_price = $('.prints_selection').find(':selected').data('price') ? Number($('.prints_selection').find(':selected').data('price')) : 0;
			var price = parseFloat($("input[name='imageSize']:checked").attr('data-frame_cost'));
			
			if(isNaN(price))
			{
				price = $("#image_price").val().replace(',' , '');
			}
			if($('.OptionsFrames').find(':selected'))
			{
				print_price = 0;
			$('#print_fee').val(print_price);
			}
			console.log("price : ", price);
			totalPrice = (price + print_price) * qty;

			console.log("total price : ",totalPrice,price,print_price,qty);

			$("#totalPrice").text(totalPrice.toFixed(2));
			// $("#totalPrice").text(996);
		}
	  //MARK CHANGES

	  $('.btn-update-qty').click(function() {
		  var dir = $(this).data('spin');
		  var qty = parseInt($('#text-qty').val());
		  if(dir == "up"){
			qty++;
		  }
		  else{
			qty--;
			if(qty < 1)
			  qty = 1;
		  }

		  //MARK CHANGES
		  $('#text-qty').val(qty);

		  updateTotalPrice();

		  return false;
		  //MARK CHANGES
		  var total = parseFloat($('#grandTotalL').text());

          var print_price = $('.prints_selection').find(':selected').data('price');

          //ROI CHANGES
          if(print_price){
              totalQty = (total + print_price) * qty;
          }else{
              totalQty = total * qty;
          }
          //ROI CHANGES

		  $('#totalPrice').text(totalQty.toFixed(2));
		  // $('#totalPrice').text(1033);
	  });

	  var package_price_discount_total = 0;
	  $('#chkNoFrame').click(function() {

			// alert('no-frame! Price reset to -> ');

			// if( image_price < 1){
			//     image_price = 0;
			// }

			// var originalAmount = (package_price_discount_total + image_price);
			var originalAmount = (package_price_discount_total + $('image_price').val());
		   // $('#frameDetails').hide();
			$('#frame_info').val('');
			$('#frame_price').val('');
			$('#frame_desc').val('');
			// remove mats
			// $('#chkNoMats').click();
			// removed the image
			$("#mainImage").removeAttr('data-sku');
			$("#mainImage").removeAttr('data-width');
			$("#mainImage").removeAttr('data-price');
			$("#mainImage").removeAttr('data-desc');
			$('#mainImage').attr('src', image_src);
			$('#enlargedImage .uk-modal-dialog img').attr('src', image_src);

			// $("#popUpImage").removeAttr('data-sku');
			// $("#popUpImage").removeAttr('data-width');
			// $("#popUpImage").removeAttr('data-price');
			// $("#popUpImage").removeAttr('data-desc');
			// $('#popUpImage').attr('src', image_src);

          var print_price = $('.prints_selection').find(':selected').data('price');

			  //ROI CHANGES
			  if(print_price){
                  originalAmount = originalAmount + print_price;
			  }else{
                  originalAmount = originalAmount;
			  }
			  //ROI CHANGES

			$('#totalPrice').text(originalAmount.toFixed(2));
			// $('#totalPrice').text(1078);
			// getPackagePrice();
	  });
	  $('#chkNoMats').click(function() {
		  $('#mat1_info').val('');
		  $('#mat2_info').val('');
		  $('#mat3_info').val('');
		  $('#mat1_options').val('');
		  $('#mat2_options').val('');
		  $('#mat3_options').val('');
		  $('#matDetails1').hide();
		  $('#matDetails2').hide();
		  $('#matDetails3').hide();
		  $("input[name='mat_type']").prop('checked', false);
		  $("input[name='option1[]']").prop('checked', false);
		  $("input[name='option2[]']").prop('checked', false);
		  $("input[name='option3[]']").prop('checked', false);
		  $('#mat1').data('sku', '').attr('src', "{{url('_front/assets/images/nomat.jpg')}}");
		  $('#mat2').data('sku', '').attr('src', "{{url('_front/assets/images/nomat.jpg')}}");
		  $('#mat3').data('sku', '').attr('src', "{{url('_front/assets/images/nomat.jpg')}}");
		  // removed the image src
		  generateNewImageFrame();
		  getPackagePrice();
		  $('#div_prod_loading').removeAttr('style');
	$('#h2_prod_loading').attr('hidden','hidden');
	  });

window.sortMeBy = (function(){
  const accent = 'ÂâÀàÁáÄäÃãÅåÊêÈèÉéËëÎîÌìÍíÏïÔôÒòÓóÖöÕõÛûÙùÚúÜüÑñÝýÿ';
  const normal = 'AaAaAaAaAaAaEeEeEeEeIiIiIiIiOoOoOoOoOoUuUuUuUuNnYyy';
  const DESC = /^desc:\s*/i;

  // Converts the accented characters to its equivalent with no accent
  function ignoreAccent(text) {
	var length = accent.length;
	for (var i = 0; i < length; i += 1) {
	  text = text.replace(accent.charAt(i), normal.charAt(i));
	}
	// ignores case sensitive
	return text.toUpperCase();
  }

  // Compares each element and defines the sorting order
  function comparer(prev, next) {
	var asc = 1;
	if (typeof prev === 'string') {
	  if (DESC.test(prev)) asc = -1;
	  prev = ignoreAccent(prev);
	  next = ignoreAccent(next);
	}
	if (prev === next) return 0;
	return (prev > next ? 1 : -1) * asc;
  }

  // Compares each decorated element
  function sortItems(aprev, anext) {
	var i, ordered;
	for (i in aprev) { // eslint-disable-line
	  ordered = comparer(aprev[i], anext[i]);
	  if (ordered) return ordered;
	}
	return 0;
  }

  // Defines the default sort order (ASC)
  function defaultSort(prev, next) {
	if (typeof prev === 'string') {
	  prev = ignoreAccent(prev);
	  next = ignoreAccent(next);
	}
	if (prev === next) return 0;
	return (prev > next ? 1 : -1);
  }

  /**
   * Sorts an array and allows multiple sorting criteria.
   *
   * @param  {Array} array: the collection to sort
   * @param  {Function} parser: transforms each item and specifies the sorting order
   * @return {Array}
   */
  return function sortBy(array, parser) {
	var i, item;
	var arrLength = array.length;
	if (typeof parser === 'undefined') {
	  return array.sort(defaultSort);
	}
	// Schwartzian transform (decorate-sort-undecorate)
	for (i = arrLength; i;) {
	  item = array[i -= 1];
	  // decorate the array
	  array[i] = [].concat(parser.call(null, item, i), item);
	  // // console.log('decorated: ', array[i]);
	}
	// sort the array
	array.sort(sortItems);
	// undecorate the array
	for (i = arrLength; i;) {
	  item = array[i -= 1];
	  array[i] = item[item.length - 1];
	}
	return array;
  }

}());



  function generateNewImageFrame() {

	 //alert('width: '+ $("#imageSize").children('option:selected').data('width'));
	$('.frame-style-box').addClass('rendering-img');
	var selected_photo_size_val = $("input[name='imageSize']:checked").val();
	console.log('selected_photo_size_val');
	console.log(selected_photo_size_val);
	var selected_photo_size_option = $('.photo-size-selection-option-'+selected_photo_size_val);
	console.log('selected_photo_size_option');
	console.log(selected_photo_size_option);

	var imageWidth = ( selected_photo_size_option.data('width') ) ? selected_photo_size_option.data('width') : 8;
	var imageWidthFraction = (selected_photo_size_option.data('widthfraction')) ? selected_photo_size_option.data('widthfraction') : .0;
	var newImageWidth = imageWidth + imageWidthFraction;
	var imageHeight = (selected_photo_size_option.data('height')) ? selected_photo_size_option.data('height') : 11;
	var imageHeightFraction = (selected_photo_size_option.data('heightfraction')) ? selected_photo_size_option.data('heightfraction') : 11;
	var newImageHeight = imageHeight + imageHeightFraction;
	$('#frame_border_size').val(selected_photo_size_option.data('frame_border_size'));
	$('#frameSize').text(imageWidth+' x '+imageHeight);
	var additional_cost = selected_photo_size_option.data('addtnl_cost');
	var original_size_price =  selected_photo_size_option.data('price');

	var shipProcFee = ( selected_photo_size_option.data('shipping') ) ? selected_photo_size_option.data('shipping') : 0;
	$("#shipprocfee").val(shipProcFee);

	//change the frame information on product details page
	var el_frame_selection = $('#frame_selection');
	// var el_frame_selection_val =el_frame_selection.val();
	// var elo_frame_selection = $('#frame_selection > option#option_'+el_frame_selection_val);
	// v_frame_desc = elo_frame_selection.data('title');
	// v_frame_width = elo_frame_selection.data('width');
	//v_frame_sku = el_frame_selection_val;
	// v_frame_style = elo_frame_selection.data('style');
	// v_frame_color = elo_frame_selection.data('color');
	// v_frame_is_cheap = elo_frame_selection.data('is_cheap');
	data_liner = selected_photo_size_option.data('liner');
	var liner_color_code = $("#liner_color_code").val();
	console.log(liner_color_code);
	console.log('bef: '+data_liner);
	if (data_liner === undefined) {
		data_liner = "LN3BK";
	} else {
		data_liner = data_liner.slice(0, -2).concat(liner_color_code);
	}
	console.log('aft: '+data_liner);
	$('#liner').val(data_liner);


	linerw = 1;
	if(imageWidth >= 40 && imageWidth <= 59){
	  linerw = 2;
	}else if(imageWidth >= 60 && imageWidth <= 79){
	  linerw = 3;
	}else if(imageWidth > 80){
	  linerw = 3;
	}
	console.log('imgwidth: '+imageWidth);
	console.log('linerw: '+linerw);

	// console.log('el_frame_selection_val');
	// console.log(el_frame_selection_val);
	console.log('v_frame_is_cheap');
	console.log(v_frame_is_cheap);
	console.log('additional_cost');
	console.log(additional_cost);
	if(v_frame_is_cheap == 0){
	  if(additional_cost > 0){
		//original_size_price += additional_cost;
	  }
	}
	console.log('original_size_price');
	console.log(original_size_price);
	console.log('-------------------------');
	selected_photo_size_option.attr('data-frame_cost',original_size_price);
	//$("#frameName").html(v_frame_desc);
	$("#descImageWidth").text(imageWidth);
	$("#descImageHeight").text(imageHeight);

	var is_prod_vertical_var = $('#is_prod_vertical').val();


	var print_id = "{{!empty($_GET['print_id']) && isset($_GET['print_id']) ? $_GET['print_id'] : '0' }}";
	var replace_width = "imgHI="+imageHeight+"&imgWI="+imageWidth+'&maxW=800&maxH=800';


	// console.log('is vertical: '+is_prod_vertical_var);

	 var defaultcost = selected_photo_size_option.data('defaultlocost');
	//var defaultcost = (v_frame_is_cheap==1)? selected_photo_size_option.data('defaultlocost'): selected_photo_size_option.data('defaulthicost');
	$('#defaultcost').val(defaultcost);
	var frame_sequence = selected_photo_size_option.data('sequence');
	$('#frame_sequence').val(frame_sequence);
	console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
	console.log('v_frame_is_cheap: '+v_frame_is_cheap);
	console.log('defaultcost: '+defaultcost);
	//patrick added
	$('#div_prod_loading').removeAttr('style');
	$('#h2_prod_loading').attr('hidden','hidden');


	var dateNow = new Date(); // for now
	// var hourNow = dateNow.getHours(); // => 9
	// var minuteNow = dateNow.getMinutes(); // =>  30
	// var secondNow = dateNow.getSeconds();
	var dateString = dateNow.toISOString();
	// if(is_prod_vertical_var == 1){
	//   replace_width = "imgHI="+imageWidth+"&imgWI="+imageHeight+'&maxW=800&maxH=800';
	// }

	// var imgSrc = "http://54.68.88.28/clarkin/public/uploads/products/majesty-ii/majesty-1.jpg&time=456";
	// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl="+imgSrc+"&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2=LN3BK&frameW="+v_frame_width+"&frame2W="+linerw;
	// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage) }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2=LN3BK&frameW="+v_frame_width+"&frame2W="+linerw;

	// LATEST
	// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ 'http://www.clarkincollection.com/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2=LN3BK&frameW="+v_frame_width+"&frame2W="+linerw;

	// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ 'http://www.clarkincollection.com/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2="+data_liner+"&frameW="+v_frame_width+"&frame2W="+linerw;


//var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{'http://54.68.88.28/clarkin123/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2="+data_liner+"&frameW="+v_frame_width+"&frame2W="+linerw;

// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{'http://44.238.169.246/clarkin123/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2="+data_liner+"&frameW="+v_frame_width+"&frame2W="+linerw;

var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{'https://clarkincollection.com/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2="+data_liner+"&frameW="+v_frame_width+"&frame2W="+linerw;


	console.log(newSrc);

	update_all_size_option_prices(v_frame_is_cheap);


	//for add to cart functionality
	//$("#frame_price").val($("#mainImage").data('price').toFixed(2));
	$("#frame_info").val(v_frame_sku);
	$("#frame_width").val(v_frame_width);
	//$("#frame_desc").val($("#mainImage").data('desc'));
	//$("#frame_desc").val(v_frame_desc);
	$("#mainImage").attr('src',newSrc);
	$('#enlargedImage .uk-modal-dialog img').attr('src', image_src);
	$("#text-qty").val(1);
	//$('.frame-description-text').html(v_frame_desc);
	$('.frame-sku-text').html(v_frame_sku);
	$('.frame-color-text').html(v_frame_color);
	$('.frame-style-text').html(v_frame_style);
	$('.photo-size-text').html($('.photo-size-selection-option-lbl-'+selected_photo_size_val).html());
	// console.log('v_frame_style');
	// console.log(v_frame_style);
	if(v_frame_style != ''){
	  $('.frame-style-lbl').removeClass('uk-hidden');
	  $('.frame-style-text').removeClass('uk-hidden');
	}else{
	  $('.frame-style-lbl').addClass('uk-hidden');
	  $('.frame-style-text').addClass('uk-hidden');
	}
	$('.frame-width-text').html(v_frame_width);


	getPackagePrice();
  }





  function generateNewImagePrint() {

	// alert('width: '+ $("#imageSize").children('option:selected').data('width'));
	$('.frame-style-box').addClass('rendering-img');
	var selected_photo_size_val = $("input[name='imageSize']:checked").val();
	console.log('selected_photo_size_val');
	console.log(selected_photo_size_val);
	var selected_photo_size_option = $('.photo-size-selection-option-'+selected_photo_size_val);
	console.log('selected_photo_size_option');
	console.log(selected_photo_size_option);

	var imageWidth = ( selected_photo_size_option.data('width') ) ? selected_photo_size_option.data('width') : 8;
	var imageWidthFraction = (selected_photo_size_option.data('widthfraction')) ? selected_photo_size_option.data('widthfraction') : .0;
	var newImageWidth = imageWidth + imageWidthFraction;
	var imageHeight = (selected_photo_size_option.data('height')) ? selected_photo_size_option.data('height') : 11;
	var imageHeightFraction = (selected_photo_size_option.data('heightfraction')) ? selected_photo_size_option.data('heightfraction') : 11;
	var newImageHeight = imageHeight + imageHeightFraction;
	$('#frame_border_size').val(selected_photo_size_option.data('frame_border_size'));
	$('#frameSize').text(imageWidth+' x '+imageHeight);
	var additional_cost = selected_photo_size_option.data('addtnl_cost');
	var original_size_price =  selected_photo_size_option.data('price');

	var shipProcFee = ( selected_photo_size_option.data('shipping') ) ? selected_photo_size_option.data('shipping') : 0;
	$("#shipprocfee").val(shipProcFee);

	//change the frame information on product details page
	var el_frame_selection = $('#frame_selection');
	// var el_frame_selection_val =el_frame_selection.val();
	// var elo_frame_selection = $('#frame_selection > option#option_'+el_frame_selection_val);
	// v_frame_desc = elo_frame_selection.data('title');
	// v_frame_width = elo_frame_selection.data('width');
	//v_frame_sku = el_frame_selection_val;
	// v_frame_style = elo_frame_selection.data('style');
	// v_frame_color = elo_frame_selection.data('color');
	// v_frame_is_cheap = elo_frame_selection.data('is_cheap');
	data_liner = selected_photo_size_option.data('liner');
	var liner_color_code = $("#liner_color_code").val();
	console.log(liner_color_code);
	console.log('bef: '+data_liner);
	if (data_liner === undefined) {
		data_liner = "LN3BK";
	} else {
		data_liner = data_liner.slice(0, -2).concat(liner_color_code);
	}
	console.log('aft: '+data_liner);
	$('#liner').val(data_liner);


	linerw = 1;
	if(imageWidth >= 40 && imageWidth <= 59){
	  linerw = 2;
	}else if(imageWidth >= 60 && imageWidth <= 79){
	  linerw = 3;
	}else if(imageWidth > 80){
	  linerw = 3;
	}
	console.log('imgwidth: '+imageWidth);
	console.log('linerw: '+linerw);

	// console.log('el_frame_selection_val');
	// console.log(el_frame_selection_val);
	console.log('v_frame_is_cheap');
	console.log(v_frame_is_cheap);
	console.log('additional_cost');
	console.log(additional_cost);
	if(v_frame_is_cheap == 0){
	  if(additional_cost > 0){
		original_size_price += additional_cost;
	  }
	}
	console.log('original_size_price');
	console.log(original_size_price);
	console.log('-------------------------');
	selected_photo_size_option.attr('data-frame_cost',original_size_price);
	//$("#frameName").html(v_frame_desc);
	$("#descImageWidth").text(imageWidth);
	$("#descImageHeight").text(imageHeight);

	var is_prod_vertical_var = $('#is_prod_vertical').val();
	var replace_width = "imgHI=298&imgWI=706&maxW=800&maxH=800";


	// console.log('is vertical: '+is_prod_vertical_var);

	//first version
	 var defaultcost = selected_photo_size_option.data('defaultlocost');

	// Second version
	// var defaultcost = (v_frame_is_cheap==1)? selected_photo_size_option.data('defaultlocost'): selected_photo_size_option.data('defaulthicost');


	$('#defaultcost').val(defaultcost);
	var frame_sequence = selected_photo_size_option.data('sequence');
	$('#frame_sequence').val(frame_sequence);
	console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
	console.log('v_frame_is_cheap: '+v_frame_is_cheap);
	console.log('defaultcost: '+defaultcost);


	var dateNow = new Date(); // for now
	// var hourNow = dateNow.getHours(); // => 9
	// var minuteNow = dateNow.getMinutes(); // =>  30
	// var secondNow = dateNow.getSeconds();
	var dateString = dateNow.toISOString();
	// if(is_prod_vertical_var == 1){
	//   replace_width = "imgHI="+imageWidth+"&imgWI="+imageHeight+'&maxW=800&maxH=800';
	// }

	// var imgSrc = "http://54.68.88.28/clarkin/public/uploads/products/majesty-ii/majesty-1.jpg&time=456";
	// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl="+imgSrc+"&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2=LN3BK&frameW="+v_frame_width+"&frame2W="+linerw;
	// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage) }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2=LN3BK&frameW="+v_frame_width+"&frame2W="+linerw;

	// LATEST
	// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ 'http://www.clarkincollection.com/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2=LN3BK&frameW="+v_frame_width+"&frame2W="+linerw;

	// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ 'http://www.clarkincollection.com/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2="+data_liner+"&frameW="+v_frame_width+"&frame2W="+linerw;
	//var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{'http://54.68.88.28/clarkin123/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2="+data_liner+"&frameW="+v_frame_width+"&frame2W="+linerw;

// var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{'http://44.238.169.246/clarkin123/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2="+data_liner+"&frameW="+v_frame_width+"&frame2W="+linerw;

var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{'https://clarkincollection.com/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}";
//var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{'https://clarkincollection.com/'.PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.$product->fldProductImage }}&"+replace_width+"&m1b=1&off=0.375&sku="+v_frame_sku+"&sku2="+data_liner+"&frameW="+v_frame_width+"&frame2W="+linerw;

	console.log(newSrc);

	update_all_size_option_prices(v_frame_is_cheap);


	//for add to cart functionality
	//$("#frame_price").val($("#mainImage").data('price').toFixed(2));
	$("#frame_info").val(v_frame_sku);
	$("#frame_width").val(v_frame_width);
	//$("#frame_desc").val($("#mainImage").data('desc'));
	//$("#frame_desc").val(v_frame_desc);
	$("#mainImage").attr('src',newSrc);
	$('#enlargedImage .uk-modal-dialog img').attr('src', image_src);
	$("#text-qty").val(1);
	$('.frame-description-text').html(v_frame_desc);
	$('.frame-sku-text').html(v_frame_sku);
	$('.frame-color-text').html(v_frame_color);
	$('.frame-style-text').html(v_frame_style);
	$('.photo-size-text').html($('.photo-size-selection-option-lbl-'+selected_photo_size_val).html());
	// console.log('v_frame_style');
	// console.log(v_frame_style);
	if(v_frame_style != ''){
	  $('.frame-style-lbl').removeClass('uk-hidden');
	  $('.frame-style-text').removeClass('uk-hidden');
	}else{
	  $('.frame-style-lbl').addClass('uk-hidden');
	  $('.frame-style-text').addClass('uk-hidden');
	}
	$('.frame-width-text').html(v_frame_width);


	getPackagePrice();
  }

  function update_all_size_option_prices(p_frame_is_cheap){
	var el_photo_size_option,
	f_photo_size_option_val = 0,
	f_photo_size_option_price = 0,
	f_photo_size_option_addtlprice = 0;
	$('.photo-size-selection-option').each(function(){
	  f_photo_size_option_val = 0,
	  f_photo_size_option_price = 0,
	  f_photo_size_option_addtlprice = 0;
	  el_photo_size_option = $(this);
	  f_photo_size_option_val = el_photo_size_option.val();
	  

	  f_photo_size_option_price = parseFloat(el_photo_size_option.data('price'));
	//   console.log("orignal price  " +  f_photo_size_option_price);
	//   if(p_frame_is_cheap == 0){
	// 	f_photo_size_option_addtlprice = parseFloat(el_photo_size_option.data('addtnl_cost'));
	//   }
	  f_photo_size_option_price += f_photo_size_option_addtlprice;
	//   console.log("price  " +  f_photo_size_option_price);
	  //$('.price-start-'+f_photo_size_option_val).html(parseFloat(f_photo_size_option_price).toFixed(2));
	  $('.price-start-'+ f_photo_size_option_val).html(parseFloat(f_photo_size_option_price).toFixed(2));
	//   console.log('starts: ' + f_photo_size_option_val);
	//   console.log('new: ' + f_photo_size_option_price);
	  console.log('EL: ' + $('.price-start-'+f_photo_size_option_val).html());
	});
  }


	function generateLiner(obj) {
		// Update wordings on bottom page
		// Get + Update image
		var datatext = obj.options[obj.selectedIndex].getAttribute("data-text");
		var datacode = obj.options[obj.selectedIndex].getAttribute("data-code");
		// alert(datatext);
		$('.frame-liner-text').text(datatext);

		var oldSrc = $("#mainImage").attr('src');
		// alert($("#mainImage").attr('src'));

		var previousLiner = $("#liner").val();
		console.log(previousLiner);
		var datacode = obj.options[obj.selectedIndex].getAttribute("data-code");
		console.log('datacode '+datacode);
		var newLiner = previousLiner.slice(0, -2).concat(datacode);
		console.log('newLiner '+newLiner);
		$('#liner').val(newLiner);

		$('#liner_color_code').val(datacode);

		console.log(oldSrc);
		var newSrc = oldSrc.replace(/(sku2=).*?(&)/,'$1' + newLiner + '$2');
		console.log(newSrc);
		$("#mainImage").attr("src",newSrc);
		$('#enlargedImage .uk-modal-dialog img').attr('src', image_src);
	}

  </script>

  @if(Input::old('frame_desc'))
  <?php
	$frameInfo = explode(';', Input::old('frame_desc'));
	$frame = Input::old('frame_info');
	if($frame != "") {
  ?>
	<script>
		changeFrame('{{$frame}}','{{$frameInfo[0]}}','0','{{$frameInfo[1]}}');
		generateNewImageFrame();
		$('#div_prod_loading').removeAttr('style');
	$('#h2_prod_loading').attr('hidden','hidden');
	</script>
	<?php } ?>
	@endif

{{--<div class="full-width">
<?php /* <a href="#" data-uk-toggle="{target:'#toggle-pice-details'}" data-change-text="<i class='uk-icon-eye uk-icon-justify'></i> Hide Price Details"><i class='uk-icon-eye uk-icon-justify'></i> View Price Details</a> */ ?>
  @include('home.product_details.price_details')
</div>--}}
@stop