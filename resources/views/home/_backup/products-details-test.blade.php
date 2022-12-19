@extends('layouts._front.products')
@section('content')
<div class="uk-container uk-container-center uk-margin-medium-bottom  uk-padding-remove">
  <article id="main" role="main">
    <!--PAGE BREADCRUMB -->
    <div class="uk-breadcrumb-wrapper  uk-margin-top  uk-margin-bottom  uk-width-1-1" >
      <ul class="uk-breadcrumb">
        <li class="product-main-category"><a href="{{url('image-galleries')}}">Image Galleries</a></li>
        <li class="product-parent-category"><a href="{{url('image-galleries/'.$category_details->fldCategorySlug)}}">{!!$category_details->fldCategoryName!!}</a></li>
        <li class="uk-active"><span>{!!$product->fldProductName!!}</span></li>
      </ul>
    </div>
    <!--END PAGE BREADCRUMB -->
    @if(Session::has('error'))
          <div class="uk-alert uk-alert-danger">{{ Session::get('error') }}</div>
    @endif

    {!! Form::open(array('action' => 'TempCartController@addShoppingCart', 'method' => 'post',  'class' => 'uk-form-horizontal uk-form-row')) !!}
    <div class="product-column-wrapper uk-position-relative">
      <div class="uk-grid">
      <!--MAIN CONTENTS-->
      <div class="uk-width-1-1 uk-width-medium-4-10 ">
        <div class="frame-box-container">
            <div class="frame-style-box frame-706x639">
                 <a href="#enlargedImage" class="uk-overlay" data-uk-modal>
                  {!! Html::image(url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage),'',array('class'=>'frame-style w100 hauto mauto','width'=>'706','height'=>'639', 'id'=>'mainImage')) !!}
                  <div class="uk-overlay-panel uk-overlay-icon"></div>
                </a>
            </div>

            <? 
            
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
            ?>
            {!! Form::hidden('image_price',isset($product->fldProductImagePrice) ? number_format($product->fldProductImagePrice,2) : number_format($product->fldProductPrice,2),['id'=>'image_price']) !!}
            {!! Form::hidden('image_size_id',$product->fldProductImageID,['id'=>'image_size_id']) !!}
            {!! Form::hidden('frame_info', null, ['id'=>'frame_info']) !!}
            {!! Form::hidden('frame_price',$framePrice,['id'=>'frame_price']) !!}
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
            {!! Form::hidden('total_price',number_format($product->fldProductImagePrice,2),['id'=>'total_price']) !!}

            <div class="frame-selection" id="frame-selection" style="opacity:0;"> <!-- frame -->
              @include('home.product_details.frame-1')
            </div>
        </div>
        <a href="#toggle-pice-details2" class="floatingPrice" data-uk-offcanvas="{mode:'slide'}"><i class='uk-icon-eye uk-icon-justify'></i> Price Details</a>
      </div>
      <div class="uk-width-1-1 uk-width-medium-6-10 product-details-column">
                {!! Form::hidden('product_id', $product->fldProductID, array('id' => 'product_id1')) !!}
                {!! Form::hidden('product_id1',$product->fldProductID,array('id'=>'product_id1')) !!}
                <h1>{{ $product->fldProductName }}</h1>
                <h2 class="sub-title">{{ $product->fldProductSubTitle}}</h2>
                <div class="product-description grey light ">
                  {!! $product->fldProductDescription!!}
               </div>
                <div class="full-width your-total">
                        <div class="uk-grid ">
                          <div class="uk-width-large-1-2 uk-width-1-1 add-to-cart-section-label">
                            <label class="lbl-your-total uk-text-large">YOUR TOTAL: </label>
                              <span class="val-your-total roboto uk-text-bold uk-form-help-inline ">
                                $<span id="totalPrice">
                                  {!!isset($product->fldProductImagePrice) ? number_format($product->fldProductImagePrice,2) : number_format($product->fldProductPrice,2)!!}
                                </span>
                              </span>
                          </div>
                          <div class="uk-width-large-1-2 add-to-cart-section uk-width-1-1">
                           <div class="uk-form-row">
                                <div class="uk-grid uk-form-horizontal uk-text-right   uk-margin-remove ">
                                  <div class="uk-width-large-5-10 uk-width-medium-4-10 uk-width-small-1-2 uk-width-1-1 uk-padding-remove  uk-float-right">
                                       <div class="input-append uk-form-width-mini spinner" data-trigger="spinner">
                                          <input type="text" value="1" name="qty" data-max="1000" data-min="1" data-step="1" id="text-qty">
                                          <div class="add-on">
                                            <a href="javascript:;" class="spin-up btn-update-qty" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                            <a href="javascript:;" class="spin-down btn-update-qty" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                                          </div>
                                        </div>
                                  </div>
                                  <div class="uk-width-large-5-10 uk-width-medium-6-10 uk-width-small-1-2   uk-width-1-1  uk-padding-remove uk-float-right">
                                     {!! Form::button('Add to cart <i class="uk-icon-check yellow"></i>',array('class'=>'uk-button full-width uk-form-help-inline uk-button-large uk-button-yellow text-uppercase uk-text-bold uk-margin-small-left btn-add-to-cart','type'=>'submit','name'=>'submit'))!!}                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
            <ul class="uk-subnav product-tab-components uk-tab uk-subnav-pill" data-uk-switcher="{connect:'#product-detail-switcher', animation: 'fade',active:1}">
                <li class="print_on_paper_toggler toggle-me" data-tab-id="mats" onclick="hideFrames();"><a href="#">Mats</a></li>
                <li onclick="displayFrames();" data-tab-id="frames" ><a href="#">Frames</a></li>
            </ul>
          <ul id="product-detail-switcher" class="uk-switcher">
            <li> <!-- mats -->
                @include('home.product_details.mats')
            </li>
            <li class="uk-active"> <!-- frame -->
                @include('home.product_details.frame')
            </li>
          </ul>
          <div class="uk-hidden">
           @include('home.product_details.paper')
         </div>
      </div>
      </div>
    </div>
    {!! Form::close() !!}
    <!--END MAIN CONTENTS-->
  </article>  </div>


<!-- This is the modal -->
<div id="enlargedImage" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-lightbox">
        <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
        <img src="{!! url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) !!}" alt="" id="modalImage">
    </div>
</div>

@stop
@section('headercodes')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
@media screen and (max-width: 767px){
  .uk-padding-remove > article{ padding-left: 0; padding-right: 0; } .wrap.content{ padding-top: 0; }
.frame-box-sticky,.frame-box-sticky  .frame-box-container,.frame-box-sticky  .frame-box-container .frame-style-box{ z-index: 9; }
}
</style>
<script>
var frames_array = new Array(), frame_materials = new Array(), sortMeBy = {}, generateSldieshow = {}, getPackagePrice = {};
</script>
@stop
@section('extracodes')
{!! HTML::script('_front/plugins/uikit/js/components/pagination.min.js') !!}
{!! HTML::script('_front/plugins/uikit/js/components/grid.min.js') !!}
{!! HTML::script('_front/plugins/uikit/js/components/slideshow.min.js') !!}
{!! HTML::script('_front/plugins/uikit/js/components/sticky.min.js') !!}
{!! Html::script('_front/assets/js/cart.js') !!}
<script>
var load_only_once = 0, load_mats_only_once = 0;var frames_slider;
var ffilter_array = new Array();
    var image_src = "{{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) }}";
    function load_javascripts(){
      frames_slider = UIkit.slideshow($('#frame_slider'), { });
    }
    $(document).ready(function(){
     /* $.ajax({
      type: "GET",
      url: "{{url('product-api/'.$product->fldProductSlug)}}",
      cache: false,
      success: function(data){
          console.log(data);
        }
      });
*/
      
      loadcssfile("{!!url('_front/plugins/uikit/css/components/tooltip.min.css')!!}",'css');
      loadScript("{!!url('_front/plugins/uikit/js/components/tooltip.min.js')!!}", function(){
      });
      loadScript("{!!url('_front/plugins/uikit/js/components/pagination.min.js')!!}", function(){});

      $.ajax({
        type: "GET",
        url: "{{url('product-api')}}/paper",
        cache: false,
        success: function(data){
            console.log(data);
            var this_data = JSON.parse(data);
          }
      });


      $.ajax({
        type: "GET",
        url: "{{url('product-api')}}/frames",
        cache: false,
        success: function(data){


            var this_data = JSON.parse(data);
            //console.log(this_data);
            $.each(this_data, function(index, value ){
              //console.log('----------------------');
             // console.log(index);
              //console.log(value);
              if(index == 'sku'){
                $('#frame_info').val(value);
              }else if(index == 'frameDesc'){
                $('#frame_desc').val(value);
              }else if(index == 'framePrice'){
                $('#frame_price').val(value);
              }else if(index == 'frameWidth'){
               /* $('#frame_price').val(value);*/
                var get_this_option_val = getFrameWidthSelectionValues(parseInt(value));
                $('#frame_price').val(get_this_option_val);
              }else if(index == 'colorValue'){
                var this_select = document.getElementById("frameColor");
                var this_option;
                $.each(value, function(obj_index, obj_value ){
                  this_option = document.createElement("option");
                  this_option.text = obj_value;
                  this_option.setAttribute('data-uk-filter', obj_value);
                  this_option.value = obj_value;
                  this_select.add(this_option);
                });
              }else if(index == 'styleValue'){                
                var this_select = document.getElementById("frameStyle");
                var this_option;
                $.each(value, function(obj_index, obj_value ){
                  this_option = document.createElement("option");
                  this_option.text = obj_value;
                  this_option.setAttribute('data-uk-filter', obj_value);
                  this_option.value = obj_value;
                  this_select.add(this_option);
                });

              }else if(index == 'widthValue'){
                            
                /*var this_select = document.getElementById("frameStyle");
                var this_option;
                $.each(value, function(obj_index, obj_value ){
                  this_option = document.createElement("option");
                  this_option.text = obj_value;
                  this_option.setAttribute('data-uk-filter', obj_value);
                  this_option.value = obj_value;
                  this_select.add(this_option);
                });
                */
              }else if(index == 'materialValue'){
                var this_select = document.getElementById("frameMaterial");
                var this_option;
                $.each(value, function(obj_index, obj_value ){
                  this_option = document.createElement("option");
                  this_option.text = obj_value;
                  this_option.setAttribute('data-uk-filter', obj_value);
                  this_option.value = obj_value;
                  this_select.add(this_option);
                });
              }else if(index == 'graphikAPI'){

                $('#frameDisplay').show();
                 var slideshow_html_array = new Array();
                 var frame_ss_page = 0, frame_ss_column = 0, slideshowhtml = ''; 
                 var no_result = true;
                 $.each(value, function(obj_index, obj_value ){
                  frames_array[obj_index] = obj_value;
                 // console.log(frame_ss_page);
                  console.log(obj_value);
                  if(frame_ss_column > 6){
                    slideshow_html_array[frame_ss_page] = slideshowhtml;
                    frame_ss_page++, frame_ss_column = 0; slideshowhtml = '';
                  }
                  if(obj_value.sku != undefined){
                    slideshowhtml += '<div class="uk-width-1-3 frame-slider-subitem">';
                    var this_short_desc = obj_value.shortDescription;
                    var this_material = obj_value.material;
                    this_short_desc = this_short_desc.replace(/^"|"$/g, '');
                    slideshowhtml += '<img src="http://image.pictureframes.com/images/angled_corners/'+obj_value.sku+'_l.jpg" width="175" height="175" onClick="changeFrame(\''+obj_value.sku+'\',\''+obj_value.frameWidthValue+'\','+obj_value.priceData.markUpPrice+',\''+this_short_desc+'\')" alt="'+obj_value.shortDescription+'" data-filter="'+obj_value.filterValue+'" data-sku="'+obj_value.sku+'"  data-material="'+this_material+'" />';
                    var this_fcolors = obj_value.colors;
                    var frameWidthValue =  getFrameWidthEquivValues(obj_value.frameWidthValue);
                    var this_style_val = '', color_value = '';
                    if( obj_value.styles != undefined){
                      this_style_val = obj_value.styles.value;
                    }
                          console.log('-------------this_fcolors'); 
                          console.log(this_fcolors); 
                    if($.isArray(this_fcolors)){
                      $.each(this_fcolors, function(color_index, color_obj ){
                          console.log('array'); 
                          color_value = color_obj.value ; 
                          console.log(color_value);                         
                          if(ffilter_array[color_value] == undefined){
                              ffilter_array[color_value] = new Array();
                          }
                          if(ffilter_array[color_value][frameWidthValue] == undefined){
                              ffilter_array[color_value][frameWidthValue] = new Array();
                          }
                          if(ffilter_array[color_value][frameWidthValue][this_style_val] == undefined){
                              ffilter_array[color_value][frameWidthValue][this_style_val] = new Array();
                          }
                          if(ffilter_array[color_value][frameWidthValue][this_style_val][this_material] == undefined){
                              ffilter_array[color_value][frameWidthValue][this_style_val][this_material] = obj_value.shortDescription;
                          }
                        
                        
                      });
                    }else if(this_fcolors.value != undefined){
                      color_value = this_fcolors.value;
                          console.log('object'); 
                          console.log(color_value); 
                      if(ffilter_array[color_value] == undefined){
                          ffilter_array[color_value] = new Array();
                      }
                      if(ffilter_array[color_value][frameWidthValue] == undefined){
                          ffilter_array[color_value][frameWidthValue] = new Array();
                      }
                      if(ffilter_array[color_value][frameWidthValue][this_style_val] == undefined){
                          ffilter_array[color_value][frameWidthValue][this_style_val] = new Array();
                      }
                      if(ffilter_array[color_value][frameWidthValue][this_style_val][this_material] == undefined){
                          ffilter_array[color_value][frameWidthValue][this_style_val][this_material] = obj_value.shortDescription;
                      }
                    }

                    if($.inArray( this_material, frame_materials )){
                      frame_materials.push(this_material);
                    }
                    slideshowhtml += '</div>';
                    frame_ss_column++;
                    no_result = false;
                  }else{
                   // console.log('obj_value sku undefined');
                   // console.log(obj_value);
                  }

                });


          console.log('after loop');
         // console.log(frame_ss_page);
         // console.log(slideshowhtml);
         // console.log(frame_ss_column);

         if(slideshowhtml != '' & frame_ss_column > 0){
         // console.log('slideshow_html_array['+frame_ss_page+']');
         // console.log(slideshowhtml);
          slideshow_html_array[frame_ss_page] = slideshowhtml;
          frame_ss_page++;
         }


                 var fss_html = '';
                 if(no_result == false){

                  fss_html += '<div class="product-frames-slider">';
                    fss_html += '<div class="uk-slidenav-position" id="frame_slider" data-uk-slideshow="{animation: \'scroll\'}">';
                      fss_html += '<ul class="uk-slideshow" >';
                        $.each(slideshow_html_array, function(slideshow_html_array_index, slideshow_html_array_value ){
                          fss_html += '<li class=" frame-slider-item" data-id="'+slideshow_html_array_index+'">';
                            fss_html += '<div class="uk-grid uk-margin-remove" data-uk-grid="{controls: \'#graphikAttribute\'}" id="gridFilter">';
                               //console.log('slideshow_html_array**************');
                               //console.log(slideshow_html_array_index);
                               //console.log(slideshow_html_array_value);
                               fss_html += slideshow_html_array_value;
                            fss_html += '</div>';
                          fss_html += '</li>';
                        });
                      fss_html += '</ul>';
                      fss_html += '<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"><i class="uk-icon-chevron-left"></i></a>';
                      fss_html += '<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"><i class="uk-icon-chevron-right"></i></a>';
                    fss_html += '</div>';
                  fss_html += '</div>';

                  $('#frameDisplay').html(fss_html);
                    setTimeout(function(){
                      //frames_slider = UIkit.slideshow($('#frame_slider'), { height: '231' });
                      loadFrameSlider(frame_ss_page);

                    }, 1000);

                      var this_select = document.getElementById("frameMaterial");
                      var this_option;
                      if(frame_materials.length > 0 && $(this_select).val() != ''){                
                        $.each(frame_materials, function(obj_index, obj_value ){
                          this_option = document.createElement("option");

                          //console.log('obj_value');
                          //console.log(obj_value);
                          if(obj_value != ''){
                            this_option.text = obj_value;
                            this_option.setAttribute('data-uk-filter', obj_value);
                            this_option.value = obj_value;
                            this_select.add(this_option);
                          }else{
                            $(this_select).html('<option value="">No Materials</option>');
                          }
                        });
                      }else{
                        $(this_select).html('<option value="">No Materials</option>');
                      }
                  }else{
                    $('#frameDisplay').html('<div class="uk-alert uk-alert-warning">No result</div>');
                  }

                  console.log('ffilter_array');
                  console.log(ffilter_array);

                 /* slideshowhtml += '<div class="product-frames-slider">';
                  slideshowhtml += '<div class="uk-slidenav-position" id="frame_slider" data-uk-slideshow="{animation: 'scroll'}">';
                  slideshowhtml += '<ul class="uk-slideshow" >';

                  slideshowhtml += '<li class=" frame-slider-item" data-id="'+obj_value.id+'">';
                  slideshowhtml += '<div class="uk-grid uk-margin-remove" data-uk-grid="{controls: \'#graphikAttribute\'}" id="gridFilter">';*/

   
              }
            });
          }
      });

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

      $('#graphikAttribute .select-wrapper select').on('change', function(){
        $('#frameDisplay').html('<div class="uk-alert uk-alert-warning">Loading..</div>');
        generateSldieshow();
      });

      generateSldieshow = function(){
        console.log('generateSldieshow');
        var filter_array_values = new Array();
        $('#graphikAttribute .select-wrapper select').each(function(){
          var this_val = $(this).val();
          var this_id = $(this).attr('id');
          if(this_val != undefined && this_val != ''){
            filter_array_values[this_id] = this_val;
          }
        });
        console.log(filter_array_values);
        /*
        if(filter_array_values['frameWidth'] != undefined){          
          var vargetFrameWidthSelectionValuesVV = getFrameWidthSelectionValuesVV(filter_array_values['frameWidth']);
          $.each(vargetFrameWidthSelectionValuesVV, function(vfwsv_vv_index, vfwsv_vv_value){
            
          });
        }*/
        

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

            if(include_me){    
              something_was_included = true
                        
              if(frame_ss_column > 6){
                slideshow_html_array[frame_ss_page] = slideshowhtml;
                frame_ss_page++, frame_ss_column = 0; slideshowhtml = '';
              }      
              if(obj_value.sku != undefined){
                slideshowhtml += '<div class="uk-width-1-3 frame-slider-subitem">';
                this_short_desc = this_short_desc.replace(/^"|"$/g, '');

                slideshowhtml += '<img src="http://image.pictureframes.com/images/angled_corners/'+obj_value.sku+'_l.jpg" width="175" height="175" onClick="changeFrame(\''+obj_value.sku+'\',\''+obj_value.frameWidthValue+'\','+obj_value.priceData.markUpPrice+',\''+this_short_desc+'\')" alt="'+obj_value.shortDescription+'" data-filter="'+obj_value.filterValue+'" data-sku="'+obj_value.sku+'"  data-material="'+this_material+'" /><div class="uk-cover">'+obj_value.shortDescription+'</div>';
                if($.inArray( this_material, frame_materials )){
                  frame_materials.push(this_material);
                }
                slideshowhtml += '</div>';

              

                frame_ss_column++;
              }
            } //includeme?
          });


         // console.log(slideshowhtml);
         // console.log(frame_ss_column);
         if(slideshowhtml != '' & frame_ss_column > 0){
         // console.log('slideshow_html_array['+frame_ss_page+']');
         // console.log(slideshowhtml);
          slideshow_html_array[frame_ss_page] = slideshowhtml;
          frame_ss_page++;
         }


          var fss_html = '';
           if(something_was_included){

            $('#pagination').css('opacity', 1);
            fss_html += '<div class="product-frames-slider">';
              fss_html += '<div class="uk-slidenav-position" id="frame_slider" data-uk-slideshow="{animation: \'scroll\'}">';
                fss_html += '<ul class="uk-slideshow" >';
                  $.each(slideshow_html_array, function(slideshow_html_array_index, slideshow_html_array_value ){
                    fss_html += '<li class=" frame-slider-item" data-id="'+slideshow_html_array_index+'">';
                      fss_html += '<div class="uk-grid uk-margin-remove" data-uk-grid="{controls: \'#graphikAttribute\'}" id="gridFilter">';
                        
                         fss_html += slideshow_html_array_value;
                      fss_html += '</div>';
                    fss_html += '</li>';
                  });
                fss_html += '</ul>';
                fss_html += '<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"><i class="uk-icon-chevron-left"></i></a>';
                fss_html += '<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"><i class="uk-icon-chevron-right"></i></a>';
              fss_html += '</div>';
            fss_html += '</div>';

            $('#frameDisplay').html(fss_html);
              setTimeout(function(){
                //frames_slider = UIkit.slideshow($('#frame_slider'), { height: '231' });
                loadFrameSlider(frame_ss_page);

              }, 1000);


            }else{
                $('#frameDisplay').html('<div class="uk-alert uk-alert-warning">No frames found..</div>');
                $('#pagination').css('opacity', 0);
            }

      }


      function loadFrameSlider(frame_ss_page){
       

          $("#pagination").html('<ul class="uk-pagination uk-pagination-smaller bg-white uk-text-center" data-uk-pagination="{items:frame_ss_page, itemsOnPage:1}"></ul>');

              frames_slider = UIkit.slideshow($("#frame_slider"), { height: '231', start:0});
              frames_slider.show(0);
           var pagination = UIkit.pagination('.uk-pagination');
                    pagination.options.currentPage = 0;
                    pagination.options.items = frame_ss_page;
                    pagination.init();

           $('[data-uk-pagination]').on('select.uk.pagination', function(e, pageIndex){


              frames_slider = UIkit.slideshow($("#frame_slider"), { height: '231', start:pageIndex});
              frames_slider.show(pageIndex);

            });

            var container  = $('#frame_slider'),
                  slideshows = container.find('[data-uk-slideshow]');

              container.on('beforeshow.uk.slideshow', function(e, next) {
                  console.log(next.index());

                  //var pagination = UIkit.pagination($("#pagination"), { currentPage:next.index()});
                  pagination = UIkit.pagination('.uk-pagination');
                  pagination.options.currentPage = next.index();
                  pagination.options.items = frame_ss_page;
                  pagination.init();
                 // slideshows.not(next.closest('[data-uk-slideshow]')[0]).data('slideshow').show(next.index());
              });


                    
            $('#frame-selection').css('opacity', '1');
            $('#frameDisplay').css('opacity', '1');

      }

      $('[data-uk-switcher]').on('show.uk.switcher', function(event, area){
          load_javascripts();
          console.log('show.uk.switcher');
          //console.log(area);
          console.log($(area[0]));
          var this_current_tab = $(area[0]);
          var this_current_tab_id = this_current_tab.attr('data-tab-id');
          if(this_current_tab_id == 'mats' && load_mats_only_once == 0){
            $.ajax({
              type: "GET",
              url: "{{url('product-api')}}/"+this_current_tab_id,
              cache: false,
              success: function(data){
                  console.log(data);
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


      if(load_only_once == 0){
        /*$('#frameDisplay').load("{{ url('frames/display') }}", function() {
             frames_slider = UIkit.slideshow($('#frame_slider'), { height: '231' });
        });*/
      }
      load_only_once++;

      loadScript("{!!url('_front/plugins/spinner/src/jquery.spinner.js')!!}", function(){
        $('#customize-spinner').spinner('changed',function(e, newVal, oldVal){
            alert(newVal + ' ' + $("#size_height").val())
        });
         $('#customize-spinner-height').spinner('changed',function(e, newVal, oldVal){
              alert(newVal + ' ' + $("#size_width").val())
        });
      });
        load_javascripts();
        $('#frameDetails').hide();

    });

    function displayFrames() {
        //displayLoader();
        $('#frame-selection').show();
        $('#frameDisplay').show();
        $('#frame-selection').css('opacity', '1');
        $('#frameDisplay').css('opacity', '1');
        frames_slider = UIkit.slideshow($('#frame_slider'), { height: '231' });

    }

    function hideFrames() {
        $('#frame-selection').hide();
    }

     function resetme(){
      $('#graphikAttribute input').each(function(){ $(this).val(''); });
      $('#graphikAttribute select').each(function(){ $(this).val(''); });

       displayLoader();
       setTimeout(function(){
         /* $('#frameDisplay').load("{{ url('frames/display') }}", function() {
              
          });*/
          getGraphikFrames();
        },1000);
     }

     function getGraphikFrames(){
      console.log("{{url('frames/display')}}");
      $.ajax({
        type: "GET",
        url: "{{url('frames/display')}}",
        cache: false,
        success: function(data){
            console.log(data);
            $('#frameDisplay').html(data);
           
          }
      }).done(function(data){
            console.log('done');
            console.log(data);
         frames_slider = UIkit.slideshow($('#frame_slider'), { height: '231' });
      });
     }

    function changeFrame(newSku,newFrameWidth,price,frameDesc) {

        console.log('changeFrame');
        //var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) }}&imgHI=8&imgWI=11&maxW=400&maxH=400&t=1.5&r=1.5&b=1.5&l=1.5&m1b=1&off=0.375&mat1=PM918&sku="+newSku+"&frameW="+newFrameWidth;

        $("#mainImage").removeData('sku');
        $("#mainImage").removeData('width');
        $("#mainImage").removeData('price');
        $("#mainImage").removeData('desc');
        $("#mainImage").attr('data-sku',newSku);
        $("#mainImage").attr('data-width',newFrameWidth);
        $("#mainImage").attr('data-price',price);
        $("#mainImage").attr('data-desc',frameDesc);
        //$("#mainImage").attr('src',newSrc);

        generateNewImageFrame();
        // show frame price at the left
        $('#frameDetails').show();
        // remove checkbox on No frame
        $('#chkNoFrame').prop("checked", false);

        var imageURL = document.getElementById("mainImage").getAttribute("src");
        enlargedImageURL = imageURL.replace(RegExp("imgHI=4&imgWI=12&maxW=400&maxH=400", "g"), "imgHI=8&imgWI=24&maxW=800&maxH=800");

        // $("#popUpImage").attr("href", enlargedImageURL);
        $("#modalImage").attr("src", enlargedImageURL);
    }


  //UIkit.grid($("#gridFilter")).filter("AR13");
       function searchFrame() {
     //var searchSKU = $.trim("'"+$('#txtSKU').val()+"'");
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
        $.ajax({
              type: "GET",
              url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+width+"/"+frameStyle+"/"+frameMaterial+"/"+sortByVal,
              cache: false,
              success: function(){
                $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+width+"/"+frameStyle+"/"+frameMaterial+"/"+sortByVal, function() {
                       frames_slider = UIkit.slideshow($('#frame_slider'), { height: '231' });
                 });
             }
        });
      }
      function loadStyle(style) {
            var frameColor = $('#frameColor').val();
            var frameWidth = $('#frameWidth').val();
            var frameMaterial = $('#frameMaterial').val();
             var sortByVal = $('#sortby').val();
            $('#txtSKU').val('');
            displayLoader();
            $.ajax({
                  type: "GET",
                  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+frameWidth+"/"+style+"/"+frameMaterial+"/"+sortByVal,
                  cache: false,
                  success: function(){
                    $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+frameWidth+"/"+style+"/"+frameMaterial+"/"+sortByVal, function() {
                       frames_slider = UIkit.slideshow($('#frame_slider'), { height: '231' });
                    });
                 }
            });
      }
      function loadMaterial(material) {
            var frameColor = $('#frameColor').val();
            var frameWidth = $('#frameWidth').val();
            var frameStyle = $('#frameStyle').val();
            var sortByVal = $('#sortby').val();
            $('#txtSKU').val('');
             displayLoader();
            $.ajax({
                  type: "GET",
                  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+frameWidth+"/"+frameStyle+"/"+material+"/"+sortByVal,
                  cache: false,
                  success: function(){
                    $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+frameWidth+"/"+frameStyle+"/"+material+"/"+sortByVal, function() {
                       frames_slider = UIkit.slideshow($('#frame_slider'), { height: '231' });
                     });
                 }
            });
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
          if(image_width  == "") {
             image_width = {{$product->fldProductImageWidth}};
             image_height = {{$product->fldProductImageHeight}};
          }
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
          console.log('mats_width');
          console.log(mats_width);
          console.log('finishkitSku');
          console.log(finishkitSku);
          $.ajax({
                  type: "POST",
                  url: "{{ action('GraphikDimensionController@getPackagePricing') }}",
                  cache: false,
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: {
                      'mats[]'       : mats,
                      'mat_options[]': mat_options,
                      'mats_width'   : mats_width,
                      'image_width'  : image_width,
                      'image_height' : image_height,
                      'paperSku' : paperSku,
                      'paperType' : paperType,
                      'frameSku' : frameSku,
                      'finishkitSku' : finishkitSku,
                      'productId': productId,
                      'canvasStyle': canvasStyle,
                      'borderStyle': borderStyle
                    },
                  success: function(response){
                    console.log("response");
                    console.log(response);
                    updatePaperData(response);
                    updateFrameData(response.frame);  // update frame on left side
                    updateMatsPrices(response);       // update frame on left side
                    updateFinishkitData(response.finishKit); // update finish kit on left side
                    updateComputations(response.packagePriceData); // update computations
                 }
            });
       }
      function updateFrameData(frame){
        if(frame != null){
          $('#frame_info').val(frame.sku);
          $('#framePrice').text(parseFloat(frame.priceData.markUpPrice).toFixed(2));
        }
      }
      function updateComputations(packagePriceData){
          //var image_price = $('#image_price').val();
          var image_price = ($("#imageSize").children('option:selected').data('price')) ? $("#imageSize").children('option:selected').data('price') : 0;
          $("#descImagePrice").html(parseFloat(image_price).toFixed(2));
          if(packagePriceData != null){
              var merchTotal = parseFloat(packagePriceData.merchandiseTotal) + parseFloat(image_price);
              var grandTotal = parseFloat(packagePriceData.discountTotal) + parseFloat(image_price);
              $("#text-qty").val(1);
              $('#merchandiseTotal').text(parseFloat(merchTotal).toFixed(2));
              $('#feeTotal').text(parseFloat(packagePriceData.feeTotal).toFixed(2));
              $('#promotionTotal').text(parseFloat(packagePriceData.promotionTotal).toFixed(2));
              $('#grandTotalL').text(parseFloat(grandTotal).toFixed(2));
              $('#totalPrice').text(grandTotal.toFixed(2));
          }
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
         console.log(response);
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
      $('#text-qty').change(function () {
          var qty = $(this).val();
          var total = parseFloat($('#grandTotalL').text());
          totalQty = total * qty;
          $('#totalPrice').text(totalQty.toFixed(2));
      });
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
          var total = parseFloat($('#grandTotalL').text());
          totalQty = total * qty;
          $('#totalPrice').text(totalQty.toFixed(2));
      });
      var package_price_discount_total = 0;
      $('#chkNoFrame').click(function() {
            var originalAmount = (package_price_discount_total + {{$product->fldProductImagePrice}});
            // alert('no-frame! Price reset to -> '+originalAmount);
            $('#frameDetails').hide();
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

            $('#totalPrice').text(originalAmount.toFixed(2));
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
      // console.log('decorated: ', array[i]);
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
    </script>    
    <?php } ?>
@endif
<div class="full-width uk-margin">
<? /* <a href="#" data-uk-toggle="{target:'#toggle-pice-details'}" data-change-text="<i class='uk-icon-eye uk-icon-justify'></i> Hide Price Details"><i class='uk-icon-eye uk-icon-justify'></i> View Price Details</a> */ ?>
  @include('home.product_details.price_details')
</div>
@stop