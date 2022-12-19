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
      {!! Form::open(array('url' => '/shopping-cart/new', 'method' => 'post',  'class' => 'uk-form-horizontal uk-form-row')) !!} 
    <div class="uk-grid uk-margin-remove">
       
      <!--MAIN CONTENTS-->     
      <div class="uk-width-medium-1-2 uk-width-small-1-1  uk-padding-remove">
        <div class="frame-box-container">
            <div class="frame-style-box frame-706x639">
	 	
            <? /* {!! Html::image(url(PRODUCT_IMAGE_PATH.'product-name/frames/frame-706x639.jpg'),'',array('class'=>'frame-style w100 hauto mauto','width'=>'706','height'=>'639')) !!} */ ?>
	     {!! Html::image('https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl='.url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage).'&imgHI='.$product->fldProductImageHeight.'&imgWI='.$product->fldProductImageWidth.'&maxW=400&maxH=400&t=1.5&r=1.5&b=1.5&l=1.5&m1b=1&mat1=PM918&off=0.375&sku='.$sku.'&frameW='.$frameWidth,'',array('class'=>'frame-style w100 hauto mauto','width'=>'591','height'=>'503','id'=>'mainImage','data-sku'=>$sku,'data-width'=>$frameWidth,'data-price'=>$framePrice,'data-desc'=>$frameDesc)) !!}
            </div>
        </div>
        <div class="full-width your-total  uk-margin-large-top">
          <div class="uk-grid ">
            <div class="uk-width-large-1-2 uk-width-small-1-1 add-to-cart-section-label  uk-padding-medium-top ">
              <label class="lbl-your-total uk-text-large">YOUR TOTAL: </label> <span class="val-your-total roboto uk-text-bold uk-form-help-inline ">$<span id="totalPrice">{{ number_format($product->fldProductImagePrice+$framePrice,2) }}</span></span>
            </div>
            <div class="uk-width-large-1-2 add-to-cart-section   uk-width-1-1">       
             <div class="uk-form-row">
                  <div class="uk-grid uk-form-horizontal uk-text-right">
                    <div class="uk-width-large-5-10 uk-width-4-10 uk-float-right">
                         <div class="input-append uk-form-width-mini spinner" data-trigger="spinner">
                            <input type="text" value="0" name="qty" id="qty" data-max="1000" data-min="1" data-step="1">
                            <div class="add-on"> 
                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                            </div>
                          </div>
                            
                    </div>
                    <div class="uk-width-large-5-10 uk-width-6-10 uk-padding-remove uk-float-right">
                       {!! Form::button('Add to cart <i class="uk-icon-check yellow"></i>',array('class'=>'uk-button full-width uk-form-help-inline uk-button-large uk-button-yellow text-uppercase uk-text-bold uk-margin-small-left','type'=>'submit','name'=>'submit'))!!}                    </div>
                  </div>
              </div> 
            </div>

           <div class="full-width uk-margin">
              <a href="#" data-uk-toggle="{target:'#toggle-pice-details'}" data-change-text="<i class='uk-icon-eye uk-icon-justify'></i> Hide Price Details"><i class='uk-icon-eye uk-icon-justify'></i> View Price Details</a>
              @include('home.product_details.price_details')    
            </div>

          </div>
        </div>
      </div>
      <div class="uk-width-medium-1-2 uk-width-small-1-1">
                {!! Form::hidden('product_id', $product->fldProductID, array('id' => 'product_id1')) !!}  
                {!! Form::hidden('product_id1',$product->fldProductID,array('id'=>'product_id1')) !!}
                <h1>{{ $product->fldProductName }}</h1>
                <h2 class="sub-title">{{ $product->fldProductSubTitle}}</h2>
                <div class="product-description grey light ">
                  {!! $product->fldProductDescription!!}
               </div>
               <ul class="uk-subnav product-tab-components uk-tab uk-subnav-pill" data-uk-switcher="{connect:'#product-detail-switcher', animation: 'fade'}">
                    <li><a href="#" class="toggle-paper toggle-me print_on_paper_toggler toggle-canvas">Paper</a><a href="#" class="toggle-paper toggle-me  uk-hidden print_on_canvas_toggler toggle-canvas">Canvas</a></li>
                    <li class="print_on_paper_toggler toggle-me "><a href="#">Mats</a></li>
                    <li class="uk-active"><a href="#">Frames</a></li>
                    <li class="print_on_paper_toggler toggle-me "><a href="#">Glazing</a></li>
                </ul>

          <ul id="product-detail-switcher" class="uk-switcher">
            <li>
                @include('home.product_details.paper')              
            </li> <!-- paper -->
            <li> <!-- MAT -->
                @include('home.product_details.mats') 
            </li> <!-- mats -->
            <li class="uk-active">
                @include('home.product_details.frame')                 
            </li> <!-- frame -->
            <li>                    
                @include('home.product_details.glazing')     
            </li> <!-- glazing -->
          </ul>

<?php /*
                    <h5>Shipping Weight: {{ $product->fldProductWeight }} lbs.</h5>	
                    <h2><span class="text-danger">${{ number_format($product->fldProductOldPrice,2) }}</s> ${{ number_format($product->fldProductPrice,2) }}</h2>
                      <div id="row">
                         @if(count($productOptions)>0)
    							           @foreach($productOptions as $options)
                                    {{$options['option_name']}} : <select name="options[]" data-id="{{$options['option_id']}}">
                                        @if(isset($options['assets']))
                                          @foreach($options['assets'] as $assets)
                                              <option value="{{$assets['assets_id']}}">{{$assets['assets_name']}}</option>
                                          @endforeach    
                                        @endif
                                    </select><br />
                                @endforeach
                          @endif 
                        </div>  
                        
                <div class="row pricing">
                    Quantity : <br />
                   
                    
                    {!! Form::submit('Checkout',array('class'=>'uk-button  uk-button-success','type'=>'submit','name'=>'checkout')) !!}                          
                </div>
                <div class="row pricing uk-margin-top">                            
                    
                    {!! Form::submit('Continue Shopping',array('class'=>'uk-button uk-button-primary','type'=>'continue','name'=>'continue'))!!}
                </div>
                {!! Form::close() !!}
                
                </div>
                <div class="uk-grid">            
                    <div class="uk-width-1-1 uk-margin-top uk-margin-left">
                    <h3>Product Description</h3>
                    {!! $product->fldProductDescription !!}
                    </div>
				        </div>

 */?>


    	</div>    
    </div>
    {!! Form::close() !!}
    <!--END MAIN CONTENTS-->

  </article>  </div>  

@stop

@section('headercodes')
 
@stop
@section('extracodes')  <script>
 
    $(document).ready(function(){ 

      loadScript("{!!url('_front/plugins/spinner/src/jquery.spinner.js')!!}", function(){        
        $('#customize-spinner').spinner('changed',function(e, newVal, oldVal){
            alert(newVal + ' ' + $("#size_height").val())
        });

         $('#customize-spinner-height').spinner('changed',function(e, newVal, oldVal){
              alert(newVal + ' ' + $("#size_width").val())
        });   
      });

      load_javascripts();
       
        cancel_confirm_print_on_canvas();     
    });

    function load_javascripts(){
      loadScript("{!!url('_front/plugins/uikit/js/components/slideshow.min.js')!!}", function(){
          var frames_slider = UIkit.slideshow($('#frame_slider'), { });
      });

      loadcssfile("{!!url('_front/plugins/uikit/css/components/tooltip.min.css')!!}",'css');
      loadScript("{!!url('_front/plugins/uikit/js/components/tooltip.min.js')!!}", function(){  
      });
    }
  </script>
  {!! HTML::script('_front/plugins/uikit/js/components/pagination.min.js') !!}
  {!! HTML::script('_front/plugins/uikit/js/components/grid.min.js') !!}
  {!! Html::script('_front/assets/js/cart.js') !!}
  <script>
     
	
      function changeFrame(newSku,newFrameWidth,price,frameDesc) {

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
	 
         
      }
      
	//UIkit.grid($("#gridFilter")).filter("AR13");


     
       function searchFrame() {
	   //var searchSKU = $.trim("'"+$('#txtSKU').val()+"'");
           var search =   $('#txtSKU').val();
           //UIkit.grid($("#gridFilter")).filter($('#txtSKU').val());

           $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

            $.ajax({  
                  type: "GET",
                  url: "{{ url('frames/search_sku/') }}/" +search ,
                  cache: false,
                  success: function(){
                    $('#frameDisplay').load("{{ url('frames/search_sku/') }}/"+search);
                 }         
            });
       }	
	
     

      $('#frameDisplay').load("{{ url('frames/display') }}", function() {
         
             frames_slider = UIkit.slideshow($('#frame_slider'), { /* options */ });
           
      });



    	function loadColors(color) {
        //get the selected value of width, styles and material
        var frameWidth = $('#frameWidth').val();
        var frameStyle = $('#frameStyle').val();
        var frameMaterial = $('#frameMaterial').val();
        var sortBy = $('#sortby').val();
      
        $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

        $.ajax({  
              type: "GET",
              url: "{{ url('frames/attributes/') }}/" +color+"/"+frameWidth+"/"+frameStyle+"/"+frameMaterial+"/"+sortBy,
              cache: false,
              success: function(){
                $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+color+"/"+frameWidth+"/"+frameStyle+"/"+frameMaterial+"/"+sortBy);
             }         
        });

      }

      function loadWidth(width) {
        var frameColor = $('#frameColor').val();
        var frameStyle = $('#frameStyle').val();
        var frameMaterial = $('#frameMaterial').val();
        var sortBy = $('#sortby').val();

        $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

        $.ajax({  
              type: "GET",
              url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+width+"/"+frameStyle+"/"+frameMaterial+"/"+sortBy,
              cache: false,
              success: function(){
                $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+width+"/"+frameStyle+"/"+frameMaterial+"/"+sortBy);
             }         
        });

      }

      function loadStyle(style) {
            var frameColor = $('#frameColor').val();
            var frameWidth = $('#frameWidth').val();
            var frameMaterial = $('#frameMaterial').val();
             var sortBy = $('#sortby').val();


            $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

            $.ajax({  
                  type: "GET",
                  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+frameWidth+"/"+style+"/"+frameMaterial+"/"+sortBy,
                  cache: false,
                  success: function(){
                    $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+frameWidth+"/"+style+"/"+frameMaterial+"/"+sortBy);
                 }         
            });
      }

      function loadMaterial(material) {
            var frameColor = $('#frameColor').val();
            var frameWidth = $('#frameWidth').val();
            var frameStyle = $('#frameStyle').val();
             var sortBy = $('#sortby').val();

            $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

            $.ajax({  
                  type: "GET",
                  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+frameWidth+"/"+frameStyle+"/"+material+"/"+sortBy,
                  cache: false,
                  success: function(){
                    $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+frameWidth+"/"+frameStyle+"/"+material+"/"+sortBy);
                 }         
            });
      }

 
       function loadSort(sortBy) {
          var frameColor = $('#frameColor').val();
          var frameWidth = $('#frameWidth').val();
          var frameStyle = $('#frameStyle').val();
          var frameMaterial = $('#frameMaterial').val();

          $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

            $.ajax({  
                  type: "GET",
                  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+frameWidth+"/"+frameStyle+"/"+frameMaterial+"/"+sortBy,
                  cache: false,
                  success: function(){
                    $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+frameWidth+"/"+frameStyle+"/"+frameMaterial+"/"+sortBy);
                 }         
            });
      }	

      function confirm_print_on_canvas(){
        UIkit.modal.confirm('Your selection is not compatible with parts currently in your package. <br/>Click OK to continue.', function(event){ 
          
        }, function(){
          cancel_confirm_print_on_canvas();
        });
    }
    function cancel_confirm_print_on_canvas(){
      $('input#print_on_canvas').removeAttr('checked');
      $('input#print_on_paper').prop( "checked", true);
      $('.toggle-me').each(function(){
              if($(this).hasClass('print_on_paper_toggler')){
                  $(this).addClass('uk-active-toggle'); $(this).removeClass('uk-hidden');
              }else{
                   $(this).addClass('uk-hidden');
              }               
          });
       }

    $('[data-uk-switcher]').on('show.uk.switcher', function(event, area){
        console.log("Switcher switched to ", area); load_javascripts();
    });
  </script> 
@stop