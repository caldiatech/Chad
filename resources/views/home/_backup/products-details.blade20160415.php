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
	     {!! Html::image('https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl='.url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage).'&imgHI=8&imgWI=11&maxW=400&maxH=400&t=1.5&r=1.5&b=1.5&l=1.5&m1b=1&mat1=PM918&off=0.375&sku='.$sku.'&frameW='.$frameWidth,'',array('class'=>'frame-style w100 hauto mauto','width'=>'591','height'=>'503','id'=>'mainImage')) !!}
            </div>
        </div>
        <div class="full-width your-total  uk-margin-large-top">
          <div class="uk-grid ">
            <div class="uk-width-large-1-2 uk-width-small-1-1 add-to-cart-section-label  uk-padding-medium-top ">
              <label class="lbl-your-total uk-text-large">YOUR TOTAL: </label> <span class="val-your-total roboto uk-text-bold uk-form-help-inline ">$<span id="total">{{ number_format($product->fldProductPrice,2) }}</span></span>
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
                      {!! Form::button('Add to cart <i class="fa fa-check yellow"></i>',array('class'=>'uk-button full-width uk-form-help-inline uk-button-large uk-button-yellow text-uppercase uk-text-bold uk-margin-small-left','type'=>'button','name'=>'submit','OnClick'=>'addtoCart(0)'))!!}
                    </div>
                  </div>
              </div> 
            </div>

           <div class="full-width uk-margin">
              <a href="#" data-uk-toggle="{target:'#toggle-pice-details'}" data-change-text="<i class='uk-icon-eye uk-icon-justify'></i> Hide Price Details"><i class='uk-icon-eye uk-icon-justify'></i> View Price Details</a>
              <div class="full-width bg-grey uk-margin uk-hidden" id="toggle-pice-details">
                <div class="full-width padding-small border-bottom">Approximate Outside Dimensions: (20" x 18 1/4")</div>
                <div class="full-width padding-small border-bottom">
                  <span class="bold text-uppercase">Paper</span><br/>
                  <span class="light ">PAPER7 Premium Archival Matte Photo Paper (14" x 12 1/4")</span>
                  <span class="uk-float-right ">$12.00</span>
                </div>
                <div class="uk-width-divider-blank uk-margin-small"></div>
                <div class="full-width padding-small bg-white  border-bottom">
                    <span class="bold text-uppercase">Mat</span><br/>
                    <span class="light ">PM918 - Very White - Custom Decorative Mat (18 3/4" x 17")</span>
                    <span class="uk-float-right ">$10.50</span>
                    <div class="full-width padding-small bg-white">
                        <span class="">Opening:</span><br/>
                        <span class="light ">13 3/4" x 12"</span>
                    </div>
                </div>
                <div class="uk-width-divider-blank uk-margin-small"></div><div class="full-width padding-small border-bottom">
                  <span class="bold text-uppercase">Mat</span><br/>
                  <span class="light ">MAT7 Premium Archival Matte Photo Paper (14" x 12 1/4")</span>
                  <span class="uk-float-right ">$12.00</span>
                </div>
                <div class="uk-width-divider-blank uk-margin-small"></div>
                <div class="full-width padding-small bg-white  border-bottom">
                    <span class="bold text-uppercase">Frame</span><br/>
                    <span class="light ">PM918 - Very White - Custom Decorative Mat (18 3/4" x 17")</span>
                    <span class="uk-float-right ">$10.50</span>
                    <div class="full-width padding-small bg-white">
                        <span class="">Opening:</span><br/>
                        <span class="light ">13 3/4" x 12"</span>
                    </div>
                </div>
                <div class="uk-width-divider-blank uk-margin-small"></div>
              </div> <!-- toggle-pice-details -->
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
          <div class="uk-display-inline form-radio-buttons">
                <label for="print_on_paper" class="uk-margin-medium-right uk-margin-small-left"> <input type="radio" id="print_on_paper" name="print_on" class=" custom-toggle" data-custom-toggle="print_on_paper_toggler"  checked> Print On Paper</label>
                <label for="print_on_canvas" class="uk-margin-small-left "> <input type="radio" class="uk-margin-medium-left custom-toggle" data-custom-toggle="print_on_canvas_toggler"  id="print_on_canvas" name="print_on" onChange="return confirm_print_on_canvas()"> Print On Canvas</label>
              </div>
                     

                <div class="print_on_toggler  uk-margin-large-top " >
                  <div class="switcher-content toggle-me  toggle-paper content-paper print_on_paper_toggler" id="print_on_paper_toggler" >                    
                    <h3 class="text-uppercase">Choose Your Art or Photo Paper</h3>
                    <label class="small uk-form-label light full-width grey">Price is Based on Your Image Size</label>
                    <div class="uk-grid w100 uk-margin-remove uk-text-large">
                      <div class="uk-display-inline form-radio-buttons uk-width-1-1 uk-padding-remove">
                        <label class="light full-width" for="photo_paper1">
                          <input type="radio" class="uk-margin-medium-right" id="photo_paper1" name="photo_paper">Economy photo / poster paper <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
                          <div class="uk-float-right">$11.15</div>
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class="uk-display-inline form-radio-buttons uk-width-1-1 uk-padding-remove">
                        <label class="light full-width" for="photo_paper1"><input type="radio" class="uk-margin-medium-right" id="photo_paper1" name="photo_paper">Premium Archival Matte Photo Paper <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
                          <div class="uk-float-right">$12.50</div>
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class=" uk-width-1-1 uk-padding-remove checkbox-wrapper">
              {!! Form::checkbox('white_border', 1, false, ['id'=>"white_border"]); !!}
              <label for="white_border" class="lbl light"><span class="checkbox-style"></span> Add White Border</label>
            </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>


                    </div>
                  </div> <!-- print_on_paper_toggler -->
                  <div class="switcher-content toggle-me  toggle-paper uk-hidden content-canvas print_on_canvas_toggler" id="print_on_canvas_toggler">
                                        
                    <h3 class="text-uppercase">Choose Your Canvas Options</h3>
                    <label class="small uk-form-label bold full-width grey">Canvas Type</label>
                    <div class="uk-grid w100 uk-margin-remove uk-text-large">
                      <div class="uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
                        <label class="light full-width" for="photo_paper1">
                          <input type="radio" class="uk-margin-medium-right" id="photo_canvas1" name="photo_canvas">Gallery Grade Satin Canvas <span class="yellow bold">New</span>  <i class="uk-icon-question uk-float-right fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
                          <div class="uk-float-right">$11.15</div>
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class="uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
                        <label class="light full-width" for="photo_canvas3">
                          <input type="radio" class="uk-margin-medium-right" id="photo_canvas3" name="photo_canvas">Gallery Grade Satin Canvas <span class="yellow bold">New</span>  <i class="uk-icon-question uk-float-right fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
                          <div class="uk-float-right">$12.50</div>
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class="uk-width-large-3-10  line-height-select uk-width-1-1 uk-padding-remove checkbox-wrapper">
                        <label class="light full-width" for="gallery_wrap">
                            <input type="radio" class="uk-margin-medium-right" id="gallery_wrap" name="wrap_options">Gallery Wrap 
                        </label>
                      </div>

                      <div class="uk-width-large-7-10  uk-width-1-1 uk-padding-remove">
                          <div class="uk-grid">
                            <div class="uk-width-4-10 line-height-select">
                              <label class=" light uk-margin-small-right" for="border_options">Border Type:</label>  
                            </div> 
                            <div class="uk-width-6-10">
                              <div class="select-wrapper input-append spinner">
                                <select id="border_options" id="border_options"><option>Mirrored image</option><option>Black</option><option>White</option></select>
                                <div class="add-on"> 
                                  <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                  <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="uk-width-1-1 uk-margin-small">
                        <label class="light full-width" for="gallery_wrp_option1">
                          <input type="radio" class="uk-margin-medium-right" id="gallery_wrp_option1" name="gallery_wrp_options[]">1" Slender Canvas Depth – Floater Frame Options Available
                        </label>
                      </div>
                      <div class="uk-width-1-1">
                          <label class="light full-width" for="gallery_wrp_option2">
                            <input type="radio" class="uk-margin-medium-right" id="gallery_wrp_option2" name="gallery_wrp_options[]">1 1/2" Classic Canvas Depth – Floater Frame Options Available
                        </label>
                      </div>


                      <div class=" uk-width-1-1 uk-padding-remove">
                        <label class=" light full-width" for="border_type">
                            <input type="radio" class="uk-margin-medium-right" id="border_type" name="wrap_options">Framed Stretched Canvas - Best Choice for the Greatest Frame Selection
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                    </div>

                  </div><!-- print_on_canvas_toggler -->
                  <div class="uk-width-divider-blank uk-margin-small"></div>
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
            </div> <!-- print_on_toggler -->
              
              </li> <!-- paper -->
              <li> <!-- MAT -->
                <h3>Choose Your Mats <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="Browse our extensive matting choices and find the perfect fit for your presentation"></i></h3>
                    <div class="uk-grid w100 uk-margin-remove uk-text-large">
                      <div class="uk-width-large-4-10 line-height-select  uk-display-inline form-radio-buttons   uk-width-1-1 uk-padding-remove">
                          <label class=" light uk-margin-small-right" for="matborder_whole">Set Mat Border Width:</label>   
                      </div>

                      <div class="uk-width-large-3-10   uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
                          <div class="select-wrapper wrapper-large input-append spinner">
                            <select id="matborder_whole" id="matborder_whole"><option>1</option><option>2</option><option>3</option></select>
                            <div class="add-on"> 
                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                            </div>
                          </div>
                      </div>

                      <div class="uk-width-large-3-10   uk-display-inline form-radio-buttons   uk-width-1-1 uk-padding-remove"> 
                          <div class="select-wrapper wrapper-large input-append spinner">
                            <select id="matborder_fractions" id="matborder_fractions"><option>1/2</option><option>2/3</option><option>1/3</option></select> "
                            <div class="add-on"> 
                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                            </div>
                          </div>
                      </div>
                    <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class="pricing-box full-width">
                        <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-1-1 uk-width-large-1-3 pricing-box-item uk-padding-remove tm-delayed-animations">
                  <div class="uk-panel uk-panel-box tm-panel-padding-vertical uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-scale-up " data-uk-scrollspy="{cls:'fade', delay:300, repeat: false}">
                    <h4 class="text-uppercase"><label class="uk-form-label light full-width" for="stm">
                                  <input type="radio" class="uk-margin-medium-right" id="stm" name="mat_type">Single Top Mat
                              </label>
                            </h4>
                    
                    <ul class="uk-list uk-list-space fsize-14">
                      <li>
                        <label class="uk-form-label light full-width" for="stm-1">
                                  <input type="radio" class="uk-margin-medium-right" id="stm-1" name="option1[]">Option  1
                              </label>
                            </li>
                      <li>
                        <label class="uk-form-label light full-width" for="stm-2">
                                  <input type="radio" class="uk-margin-medium-right" id="stm-2" name="option1[]">Option  2
                              </label>
                            </li>
                    </ul>
                  </div>
                </div>
                <div class="uk-width-1-1 uk-width-large-1-3 pricing-box-item uk-padding-remove  tm-delayed-animations">
                  <div class="uk-panel uk-panel-box tm-panel-padding-vertical uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-scale-up " data-uk-scrollspy="{cls:'fade', delay:300, repeat: false}">
                    <h4 class="text-uppercase"><label class="uk-form-label light full-width" for="dm">
                                  <input type="radio" class="uk-margin-medium-right" id="dm" name="mat_type">Double Mat
                              </label>
                            </h4>
                    
                    <ul class="uk-list uk-list-space fsize-14">
                      <li>
                        <label class="uk-form-label light full-width" for="dm-1">
                                  <input type="radio" class="uk-margin-medium-right" id="dm-1" name="option2[]">Option  1
                              </label>
                            </li>
                      <li>
                        <label class="uk-form-label light full-width" for="dm-2">
                                  <input type="radio" class="uk-margin-medium-right" id="dm-2" name="option2[]">Option  2
                              </label>
                            </li>
                    </ul>
                  </div>
                </div>
                <div class="uk-width-1-1 uk-width-large-1-3 pricing-box-item uk-padding-remove  tm-delayed-animations">
                  <div class="uk-panel uk-panel-box tm-panel-padding-vertical uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-scale-up " data-uk-scrollspy="{cls:'fade', delay:300, repeat: false}">
                    <h4 class="text-uppercase"><label class="uk-form-label light full-width" for="tm">
                                  <input type="radio" class="uk-margin-medium-right" id="tm" name="mat_type">Triple Mat
                              </label>
                            </h4>
                    
                    <ul class="uk-list uk-list-space fsize-14">
                      <li>
                        <label class="uk-form-label light full-width" for="tm-1">
                                  <input type="radio" class="uk-margin-medium-right" id="tm-1" name="option3[]">Option  1
                              </label>
                            </li>
                      <li>
                        <label class="uk-form-label light full-width" for="tm-2">
                                  <input type="radio" class="uk-margin-medium-right" id="tm-2" name="option3[]">Option  2
                              </label>
                            </li>
                    </ul>
                  </div>
                </div>

              </div>
                      </div> <!-- <div class="pricing-box">  -->
                  </div>

              </li> <!-- mats -->
              <li class="uk-active">

                <div class="product-settings">
                  <h3 class="text-uppercase">Select Size:</h3>                
                  <div class="uk-grid w100 uk-margin-remove uk-text-large">
                    <div class="uk-width-large-1-2  uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
                      <label class="uk-form-label light full-width" for="width">Width:</label>                  
                      <div class="uk-grid uk-padding-small-top w100 uk-margin-remove">
                        <div class="uk-width-large-1-2 uk-width-mdlg-1-1 uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
                            <div class="input-append spinner" data-trigger="spinner" id="customize-spinner">
                              <input type="text" value="0" data-max="1000" data-min="1" data-step="1">
                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-2 uk-width-mdlg-1-1  uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper input-append spinner">
                              <select><option>---</option><option>Inch</option><option>CM</option></select>
                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-large-1-2  uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
                      <label class="uk-form-label light full-width" for="width">Height:</label>                  
                      <div class="uk-grid uk-padding-small-top w100 uk-margin-remove">
                        <div class="uk-width-large-1-2 uk-width-mdlg-1-1 uk-width-small-1-2 uk-width-1-1 uk-padding-remove">
                            <div class="input-append spinner" data-trigger="spinner" id="customize-spinner">
                              <input type="text" value="0" data-max="1000" data-min="1" data-step="1">
                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-2 uk-width-mdlg-1-1 uk-width-small-1-2 uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper input-append spinner">
                              <select><option>---</option><option>Inch</option><option>CM</option></select>
                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="uk-divider full-width uk-margin-large"></div>
                  <h3 class="text-uppercase">Choose Your Frame:</h3>                
                  <div class="uk-grid w100 uk-margin-remove uk-text-large" id="graphikAttribute">
                    <div class="uk-width-1-1 uk-padding-remove">
                      <label class="uk-form-label light full-width" for="width">Browse Frame Choices:</label>                  
                      <div class="uk-grid uk-padding-small-top w100 uk-margin-remove">
                        <div class="uk-width-large-1-4 uk-width-medium-1-2  uk-width-small-1-4  uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper uk-md-large input-append spinner">
                             <select name="color" id="frameColor" onChange="loadColors(this.value)">
                                  <option data-uk-filter="" value="0">Color</option>
                                  @foreach($color as $colors)
                                       <option value="{{ $colors }}" data-uk-filter="{{ $colors }}">{{ $colors }}</option>
                                  @endforeach
                                  
                              </select>                             <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2  uk-width-small-1-4  uk-width-1-1 uk-padding-remove">
                             <div class="select-wrapper uk-md-large input-append spinner">
                              <select name="width" id="frameWidth"  onChange="loadWidth(this.value)">
                                    <option value="0">Width</option>
                                    @foreach($widthValue as $widthValues)
                                       <option value="{{ $widthValues }}">{{ $widthValues }}</option>
                                    @endforeach
                              </select>                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2  uk-width-small-1-4  uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper uk-md-large input-append spinner">
                              <select name="style" id="frameStyle" onChange="loadStyle(this.value)">
                                  <option value="0">Style</option>
                                  @foreach($styleValue as $styleValues)
                                       <option value="{{ $styleValues }}">{{ $styleValues }}</option>
                                  @endforeach
                              </select>                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2  uk-width-small-1-4  uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper uk-md-large input-append spinner">
                              <select name="material" id="frameMaterial" onChange="loadMaterial(this.value)">
                                  <option value="0">Material</option>
                                  @foreach($materialValue as $materialValue)
                                       <option value="{{ $materialValue }}">{{ $materialValue }}</option>
                                  @endforeach
                              </select>                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="full-width uk-margin-medium-top uk-padding-remove"> </div>  
                    
                    <div class="uk-width-6-10 uk-padding-remove">                                       
                      <div class="text-wrapper">
                          <input type="text" value="" class="text" placeholder="Enter SKU" id="txtSKU">
                          <button type="submit" class="append-button uk-text-bold" form="form1" value="Submit" onClick="searchFrame()"><i class="fa uk-icon-search"></i></button>                          
                      </div>
                    </div>
                    <div class="uk-width-4-10  uk-text-right">                                       
                      <button type="button" class="uk-button-primary uk-text-large uk-float-right full-width lato uk-button-large" >Reset</button>
                    </div>

                    <div class="full-width uk-margin-medium-top uk-padding-remove"> </div> 
                    <div class="uk-width-large-1-2  uk-width-medium-1-1 uk-width-small-1-2 uk-width-1-1 uk-padding-medium-remove">
                        <label class=" light uk-margin-small-right" for="sortby">Sort By:</label>   
                        <div class="select-wrapper wrapper-large input-append spinner">
                          <select id="sortby"><option>Best Sellers</option><option>Sale</option><option>Name</option></select>
                          <div class="add-on"> 
                            <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                            <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                          </div>
                        </div>
                    </div>

                    

                     <div class="uk-width-large-1-2 uk-width-medium-1-1 uk-width-small-1-2 uk-width-1-1 uk-padding-remove  uk-text-right"> 
                          <div id="pagination"></div>                        
                    </div>

                  </div>

                 

                  <div class="full-width uk-margin-medium-top uk-padding-remove"> </div> 
                  <div id="frameDisplay"></div>

                  
                </div> <!-- <div class="product-settings"> -->
            </li> <!-- frame -->
            <li>                    
                    <h3 class="text-uppercase">Choose Your Glazing & Backing</h3>
                    <label class="small uk-form-label light full-width grey">Price is Based on Your Image Size</label>
                    <div class="uk-grid w100 uk-margin-remove uk-text-large">
                      <div class=" uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
                        <label class="light full-width" for="options4">
                          <input type="radio" class="uk-margin-medium-right" id="options4" name="options4[]">Premium Heavy-Duty:<br/>
                          <small class="fsize-12 light grey">Heavy-Duty Clear Acrylic & Foamcore Backing</small>

                          <div class="uk-float-right">                        
                              $28.50 <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>                       
                          </div>

                        </label>
                      </div>
                    <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class="uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
                        <label class=" light full-width" for="options4">
                          <input type="radio" class="uk-margin-medium-right" id="options4" name="options4[]">Classic:<br/>
                          <small class="fsize-12 light grey">Clear Acrylic & Foamcore Backing</small>

                          <div class="uk-float-right">                        
                              $28.50 <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>                       
                          </div>

                        </label>
                      </div>
                    <div class="uk-width-divider-blank uk-margin-small"></div>
                    </div>

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
      function changeFrame(sku,frameWidth) {
          var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) }}&imgHI=8&imgWI=11&maxW=400&maxH=400&t=1.5&r=1.5&b=1.5&l=1.5&m1b=1&off=0.375&mat1=PM918&sku="+sku+"&frameW="+frameWidth;
          
          $("#mainImage").attr('src',newSrc);

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
      
        $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

        $.ajax({  
              type: "GET",
              url: "{{ url('frames/attributes/') }}/" +color+"/"+frameWidth+"/"+frameStyle+"/"+frameMaterial ,
              cache: false,
              success: function(){
                $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+color+"/"+frameWidth+"/"+frameStyle+"/"+frameMaterial);
             }         
        });

      }

      function loadWidth(width) {
        var frameColor = $('#frameColor').val();
        var frameStyle = $('#frameStyle').val();
        var frameMaterial = $('#frameMaterial').val();

        $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

        $.ajax({  
              type: "GET",
              url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+width+"/"+frameStyle+"/"+frameMaterial ,
              cache: false,
              success: function(){
                $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+width+"/"+frameStyle+"/"+frameMaterial);
             }         
        });

      }

      function loadStyle(style) {
            var frameColor = $('#frameColor').val();
            var frameWidth = $('#frameWidth').val();
            var frameMaterial = $('#frameMaterial').val();

            $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

            $.ajax({  
                  type: "GET",
                  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+frameWidth+"/"+style+"/"+frameMaterial ,
                  cache: false,
                  success: function(){
                    $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+frameWidth+"/"+style+"/"+frameMaterial);
                 }         
            });
      }

      function loadMaterial(material) {
            var frameColor = $('#frameColor').val();
            var frameWidth = $('#frameWidth').val();
            var frameStyle = $('#frameStyle').val();

            $('#frameDisplay').html('<i class="uk-icon-refresh uk-icon-spin"></i> <span class="uk-text-danger">Please wait! Loading Frames.</span>');

            $.ajax({  
                  type: "GET",
                  url: "{{ url('frames/attributes/') }}/" +frameColor+"/"+frameWidth+"/"+frameStyle+"/"+material ,
                  cache: false,
                  success: function(){
                    $('#frameDisplay').load("{{ url('frames/attributes/') }}/"+frameColor+"/"+frameWidth+"/"+frameStyle+"/"+material);
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