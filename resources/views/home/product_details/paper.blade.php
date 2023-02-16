<?php
    $printOn = Input::old('print_on');
    $paperChecked="";$canvasChecked="";
    if($printOn == "paper") {
       $paperChecked = "checked='checked'";
    } else if($printOn == "canvas") {       
       $canvasChecked = "checked='checked'";
      // echo "canvaschecked";
    } else {
        $paperChecked = "checked='checked'";
    }
?>
<div class="uk-display-inline form-radio-buttons">
  <label for="print_on_paper" class="uk-margin-medium-right uk-margin-small-left"> 
    <input type="radio" value="paper" id="print_on_paper" name="print_on" class=" custom-toggle" data-custom-toggle="print_on_paper_toggler"  {{$paperChecked}}> 
    Print On Paper
  </label>
  <label for="print_on_canvas" class="uk-margin-small-left "> 
    <input type="radio" value="canvas" class="uk-margin-medium-left custom-toggle" data-custom-toggle="print_on_canvas_toggler"  id="print_on_canvas" name="print_on" {{$canvasChecked}}> 
    Print On Canvas</label>
</div>
<div class="print_on_toggler">
<div class="switcher-content toggle-me  toggle-paper content-paper print_on_paper_toggler" id="print_on_paper_toggler" >                    
<h3 class="text-uppercase">Choose Your Art or Photo Paper</h3>
<? /* <label class="small uk-form-label light full-width grey">Price is Based on Your Image Size</label>*/ ?>
<div class="uk-grid uk-grid-collapse">
@if(isset($graphikPaperAPI))
@if(count($graphikPaperAPI->paper) > 1)   
   @foreach($graphikPaperAPI->paper as $graphikPaperAPIs)  
    <div class="uk-display-inline form-radio-buttons uk-width-1-1">
      <label class="uk-margin-medium-right uk-margin-small-left" for="photo_paper1">
        <input type="radio" class="uk-margin-medium-right" id="photo_paper1" name="photo_paper" value="{{ $graphikPaperAPIs->sku }}" data-sku="{{ $graphikPaperAPIs->sku }}" data-desc="{{ $graphikPaperAPIs->shortDescription }}" data-price="{{ $graphikPaperAPIs->priceData->markUpPrice }}">
        {{ $graphikPaperAPIs->shortDescription }} 
        <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
        <div class="uk-float-right">${{ number_format($graphikPaperAPIs->priceData->markUpPrice,2) }}</div>
      </label>
    </div>
    <div class="uk-width-divider-blank uk-margin-small"></div>
   @endforeach 
@else
     <div class="uk-display-inline form-radio-buttons uk-width-1-1 uk-padding-remove">
      <label class="uk-margin-medium-right uk-margin-small-left" for="photo_paper1">
        <input type="radio" class="uk-margin-medium-right" id="photo_paper1" name="photo_paper" value="{{ $graphikPaperAPI->paper->sku }}" data-sku="{{ $graphikPaperAPI->paper->sku }}" data-desc="{{ $graphikPaperAPI->paper->shortDescription }}" data-price="{{ $graphikPaperAPI->paper->priceData->markUpPrice }}" checked="checked">
        {{ $graphikPaperAPI->paper->shortDescription }}
        <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
        <div class="uk-float-right">${{ number_format($graphikPaperAPI->paper->priceData->markUpPrice,2) }}</div>
      </label>
    </div>
    <div class="uk-width-divider-blank uk-margin-small"></div>
@endif 
@else
     <div class="uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
          <label class="light full-width" for="photo_paper1">
            <input type="radio" class="uk-margin-medium-right" id="photo_paper1" name="photo_paper" value="PAPER7" data-sku="PAPER7" data-desc="Premium Archival Matte Photo Paper" data-price="8.1" checked='checked'>Premium Archival Matte Photo Paper  <i class="uk-icon-question uk-float-right fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
            <div class="uk-float-right">$8.1</div>
          </label>
        </div>
        <div class="uk-width-divider-blank uk-margin-small"></div>  
@endif  
<div class="uk-width-divider-blank uk-margin-small"></div>
  <div class=" uk-width-1-1 uk-padding-remove checkbox-wrapper">
        {!! Form::checkbox('white_border', 1, Input::old('white_border') == 1 ? true : false, ['id'=>"white_border"]); !!}
        <label for="white_border" class="lbl uk-margin-medium-right uk-margin-small-left"><span class="checkbox-style"></span> Add White Border</label>
  </div>
<div class="uk-width-divider-blank uk-margin-small"></div>
</div>
</div> <!-- print_on_paper_toggler -->
<div class="switcher-content toggle-me  toggle-paper uk-hidden content-canvas print_on_canvas_toggler" id="print_on_canvas_toggler">
<h3 class="text-uppercase">Choose Your Canvas Options</h3>
<? /*<label class="small uk-form-label bold full-width grey">Canvas Type</label>*/ ?>
<div class="uk-grid w100 uk-margin-remove uk-text-large">
@if(isset($graphikCanvassAPI))
@if(count($graphikCanvassAPI->canvas) > 1)
    @foreach($graphikCanvassAPI->canvas as $graphikCanvassAPIs)  
        <div class="uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
          <label class="light full-width" for="photo_paper1">
            <input type="radio" class="uk-margin-medium-right" id="photo_canvas1" name="photo_canvas" value="{{ $graphikCanvassAPI->canvas->sku }}" data-sku="{{ $graphikCanvassAPIs->sku }}" data-desc="{{ $graphikCanvassAPIs->shortDescription }}" data-price="{{ $graphikCanvassAPIs->priceData->markUpPrice }}" {{Input::old('photo_canvas') ==  $graphikCanvassAPI->canvas->sku ? "checked='checked" : ""}}>
            {{ $graphikCanvassAPIs->shortDescription }}  <i class="uk-icon-question uk-float-right fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
            <div class="uk-float-right">${{ number_format($graphikCanvassAPIs->priceData->markUpPrice,2) }}</div>
          </label>
        </div>
        <div class="uk-width-divider-blank uk-margin-small"></div>
    @endforeach    
@else
     <div class="uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
          <label class="light full-width" for="photo_paper1">
            <input type="radio" class="uk-margin-medium-right" id="photo_canvas1" name="photo_canvas" value="{{ $graphikCanvassAPI->canvas->sku }}" data-sku="{{ $graphikCanvassAPI->canvas->sku }}" data-desc="{{ $graphikCanvassAPI->canvas->shortDescription }}" data-price="{{ $graphikCanvassAPI->canvas->priceData->markUpPrice }}" {{ Input::old('photo_canvas')==$graphikCanvassAPI->canvas->sku ? "checked='checked'" : "" }}>{{ $graphikCanvassAPI->canvas->shortDescription }}  <i class="uk-icon-question uk-float-right fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
            <div class="uk-float-right">${{ number_format($graphikCanvassAPI->canvas->priceData->markUpPrice,2) }}</div>
          </label>
        </div>
        <div class="uk-width-divider-blank uk-margin-small"></div>
@endif 

@endif
</div>
<div class="uk-width-divider-blank uk-margin-small"></div>
<label class="small uk-form-label bold full-width grey">Canvas Style</label>
<div class="uk-grid w100 uk-margin-remove uk-text-large">
    <div class="uk-width-large-3-10  line-height-select uk-width-1-1 uk-padding-remove checkbox-wrapper">
      <label class="light full-width" for="gallery_wrap">
          <input type="radio" class="uk-margin-medium-right option_default_click" id="gallery_wrap" name="wrap_options" {{ Input::old('wrap_options') == "GW" ? "checked" : "" }} value="GW" checked="">Gallery Wrap 
      </label>
    </div>
    <div class="uk-width-large-7-10  uk-width-1-1 uk-padding-remove">
        <div class="uk-grid">
          <div class="uk-width-4-10 line-height-select">
            <label class=" light uk-margin-small-right" for="border_options">Border Type:</label>  
          </div> 
          <div class="uk-width-6-10">
            <div class="select-wrapper input-append spinner">
              <select id="border_options" name="gw_options">
                  <option value="CI" {{ Input::old('gw_options') == "CI" ? "selected='selected'" : "" }}>Mirrored image</option>
                  <option value="SB" {{ Input::old('gw_options') == "SB" ? "selected='selected'" : "" }}>Black</option>
                  <option value="SW" {{ Input::old('gw_options') == "SW" ? "selected='selected'" : "" }}>White</option>
              </select>
              <div class="add-on"> 
                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="uk-width-divider-blank uk-margin-small"></div>
    <div class="uk-width-large-3-10  line-height-select uk-width-1-1 uk-padding-remove checkbox-wrapper">
      <label class="light full-width" for="gallery_wrap">
          <input type="radio" class="uk-margin-medium-right" id="gallery_wrap" name="wrap_options" value="MW" {{ Input::old('wrap_options') == "MW" ? "checked" : "" }}>Museum Wrap 
      </label>
    </div>
    <div class="uk-width-large-7-10  uk-width-1-1 uk-padding-remove">
        <div class="uk-grid">
          <div class="uk-width-4-10 line-height-select">
            <label class=" light uk-margin-small-right" for="border_options">Border Type:</label>  
          </div> 
          <div class="uk-width-6-10">
            <div class="select-wrapper input-append spinner">
              <select id="border_options" name="mw_options">
                  <option value="CI" {{ Input::old('mw_options') == "CI" ? "selected='selected'" : "" }}>Mirrored image</option>
                  <option value="SB" {{ Input::old('mw_options') == "SB" ? "selected='selected'" : "" }}>Black</option>
                  <option value="SW" {{ Input::old('mw_options') == "SW" ? "selected='selected'" : "" }}>White</option>
              </select>
              <div class="add-on"> 
                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="uk-width-divider-blank uk-margin-small"></div>
    {{-- <div class="line-height-select uk-width-1-1 uk-padding-remove checkbox-wrapper">
      <label class="light full-width" for="gallery_wrap">
          <input type="radio" class="uk-margin-medium-right" id="gallery_wrap" name="wrap_options" value="CSC" {{ Input::old('wrap_options') == "CSC" ? "checked" : "" }}>Customer supplied canvas
      </label>
    </div>
    <div class="uk-width-divider-blank uk-margin-small"></div> --}}
    <div class="line-height-select uk-width-1-1 uk-padding-remove checkbox-wrapper">
      <label class="light full-width" for="gallery_wrap">
          <input type="radio" class="uk-margin-medium-right" id="gallery_wrap" name="wrap_options" value="UC"  {{ Input::old('wrap_options') == "UC" ? "checked" : "" }}>Image only, no stretcher bars
      </label>
    </div>
</div>
</div><!-- print_on_canvas_toggler -->
<div class="uk-width-divider-blank uk-margin-small"></div>
<? /*
<h3 class="text-uppercase full-width uk-padding-remove">Pro Options</h3>
<div class="uk-width-1-1 uk-padding-remove checkbox-wrapper">
{!! Form::checkbox('prop_options[]', 1, false, ['id'=>"prop_option_stamp"]) !!}
<label for="prop_option_stamp" class="lbl light"><span class="checkbox-style"></span>Stamp this Print as a Printer's Proof (Print Only)</label>
<span class="uk-float-right">$0.50</span>
</div>
<div class=" uk-width-1-1 uk-padding-remove checkbox-wrapper">
{!! Form::checkbox('prop_options[]', 2, false, array('id'=>"prop_option_cert")) !!}
<label for="prop_option_cert" class="lbl light"><span class="checkbox-style"></span> Add a Certificate of Authenticity</label>
<span class="uk-float-right">$1.00</span>
</div>
*/ ?>
</div> <!-- print_on_toggler -->
<script>
// $("#paperInfo").hide();
$(document).ready(function(){
  var sku = $("input[type=radio][name=photo_paper]:checked").data('sku');
  var desc = $("input[type=radio][name=photo_paper]:checked").data('desc');
  var price = $("input[type=radio][name=photo_paper]:checked").data('price');
  $("#paperSKU").html(sku);
  $("#paperDESC").html(desc);
  $("#paperPrice").html(price.toFixed(2));
  //compute the price         
  paperPrice = Number(price.toFixed(2));
  framePrice = Number($("#mainImage").data('price') ? $("#mainImage").data('price') : 0);
  mat1Price = Number($("#matDetails1_Price").html() ? $("#matDetails1_Price").html() : 0);
  mat2Price = Number($("#matDetails2_Price").html() ? $("#matDetails2_Price").html() : 0);
  mat3Price = Number($("#matDetails3_Price").html() ? $("#matDetails3_Price").html() : 0);
  mainImagePrice = Number($("#descImagePrice").html() ? $("#descImagePrice").html() : 0);
  totalPrice = Number(framePrice.toFixed(2)) + Number(mainImagePrice.toFixed(2)) + Number(paperPrice.toFixed(2)) + Number(mat1Price.toFixed(2)) + Number(mat2Price.toFixed(2)) + Number(mat3Price.toFixed(2));
  $("#totalPrice").html(totalPrice.toFixed(2));
  $("#paper_info").val(sku + ";" + price + ";" + desc);
  //put the total price to hidden fields for add to cart functionality
  $("#total_price").val(totalPrice.toFixed(2));
  $("#toggle-pice-details2 #grandTotalL").text(totalPrice.toFixed(2));
  // totalPrice = Number($("#mainImage").data('price').toFixed(2)) + Number() + Number();
  // $("#totalPrice").html(totalPrice.toFixed(2));
  // 
  $('input[name="photo_canvas"]').prop('checked', false);
  $('input[name="wrap_options"]').prop('checked', false);
  getPackagePrice();


});
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

var current_frame_size_val = $('input[name="imageSize"]:checked').val();
var current_frame_size_price = $('input.photo-size-selection-option-'+current_frame_size_val).attr('data-frame_cost');
if(typeof current_frame_size_val != 'undefined'){
 var frame = { 'sku' : frameSku, 'priceData' : { 'markUpPrice' : current_frame_size_price }};
updateFrameData(frame)
updateComputations(current_frame_size_val, current_frame_size_price);
}

}
</script>