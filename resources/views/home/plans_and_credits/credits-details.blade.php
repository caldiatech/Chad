<!doctype Html>
<!--[if lte IE 8]><Html class="msie no-js no-svg" lang="en"><![endif]-->
<!--[if gte IE 9]><!--><Html class="no-js no-svg" lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title> {!! $pages->fldPagesTitle !!} </title>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="{!! asset('_front/assets/icons/Icon.png') !!}" rel="apple-touch-icon">
<link href="{!! asset('_front/assets/icons/favicon.png') !!}" type="image/png" rel="shortcut icon">

  {!! Html::style('_front/assets/css/bootstrap.min.css') !!} 
  {!! Html::style('_front/plugins/uikit/css/uikit.min.css') !!} 
  {!! Html::style('_front/assets/css/core.css') !!}  
  {!! Html::style('_front/assets/css/page.css') !!}  
  {!! Html::script('_front/assets/js/jquery-1.9.1.min.js') !!}
  {!! HTML::script('_front/plugins/uikit/js/uikit.min.js') !!}
<!--[if lt IE 9]>
  {!! Html::script('_front/assets/js/respond.min.js') !!}
  {!! Html::script('_front/assets/js/Html5shiv.js') !!}
<![endif]-->

@section('headercodes')
@show 
</head>
<body>
    <div id="container">
    <!-- HEADER START-->
        <div class="wrap header">
            @include("layouts._front.header")
        </div>
        <div class="uk-container uk-container-center uk-margin-medium-bottom  uk-padding-remove product-detail-wrapper">

        <div id="div_prod_loading">
            <!-- <h1 style="position: absolute; top: 40%; left: 50%; transform: translateX(-50%) translateY(-50%); background-color: #fff; opacity: 100;" id="h2_prod_loading">Please wait..</h1> -->
            <article id="main" role="main">
                <!--PAGE BREADCRUMB -->
                <div class="uk-breadcrumb-wrapper  uk-margin-bottom  uk-width-1-1" >
                <ul class="uk-breadcrumb">
                    <li class="product-main-category"><a href="{{url('/unedited-digital-files')}}">Collection</a></li>

                    {{-- @if(!empty($category_details))<li class="product-parent-category"><a href="{{url('collection/'.$category_details->fldCategorySlug)}}">{!!$category_details->fldCategoryName!!}</a></li>@endif --}}
                    <li class="uk-active"><span>{!!$product->image_name!!}</span></li>
                </ul>
                </div>
                <!--END PAGE BREADCRUMB -->
                @if(Session::has('error'))
                    <div class="uk-alert uk-alert-danger">{{ Session::get('error') }}</div>
                @endif

                {!! Form::open(array('action' => 'TempCartController@addShoppingCartForUneditable', 'method' => 'post',  'class' => 'uk-form-horizontal uk-form-row')) !!}
                <div class="product-column-wrapper uk-position-relative">
                    <div class="uk-grid">
                    <!--MAIN CONTENTS-->
                        <div class="uk-width-1-1 uk-width-small-5-10 uk-width-large-4-10 ">
                            <div class="frame-box-container">
                                <div class="frame-style-box frame-706x639">
                                    <a href="#enlargedImage" class="uk-overlay" data-uk-modal="{center:true}">
                                    <img src="{!! url(CUSTOM_IMAGE_PATH.$product->thumbnail_image) !!}" alt="" id="modalImage"  onload="on_render_finish();">
                                    <div class="uk-overlay-panel uk-overlay-icon"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $framePrice = 0;
                        {{-- $fldProductImagePrice = $fldProductPrice = check_numeric($product->fldProductImagePrice); --}}
                        ?>
                        {!! Form::hidden('image_price',$product->price_range ,['id'=>'image_price']) !!}
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

                        {!! Form::hidden('total_price',$product->price_range,['id'=>'total_price']) !!}
                        
                        <div class="uk-width-1-1 uk-width-small-5-10  uk-width-large-6-10   product-details-column">
                        {!! Form::hidden('product_id', $product->id, array('id' => 'product_id1')) !!}
                        {!! Form::hidden('product_id1',$product->id,array('id'=>'product_id1')) !!}

                        <p style="font-size: 32px;">{{ $product->image_name }}</p>
                        <div class="full-width your-total">

                        <div class="uk-grid">
                            <div class="uk-width-large-1-2 uk-width-1-1 add-to-cart-section-label">
                            <label class="lbl-your-total uk-text-large">CREDITS: </label>
                            <span class="val-your-total roboto uk-text-bold uk-form-help-inline ">
                                {{-- $ <span id="original_price"></span> <span id="totalPrice">{{ isset($product->fldProductImagePrice) ? number_format($fldProductImagePrice,2) : number_format($fldProductPrice,2)  }}</span> --}}
                                 <span id="original_price"></span> <span id="totalPrice">{{ $product->price_range }}</span>
                            </span>
                            </div>

                            <div class="uk-width-large-1-2 add-to-cart-section uk-width-1-1">
                                <div class="uk-form-row">
                                    <div class="uk-grid uk-form-horizontal uk-text-right uk-margin-remove " id="add-to-cart">
                                        <div class="uk-width-7-10 add-to-cart-button-wrapper uk-padding-small-left uk-float-right ">
                                        {!! Form::button('Add to cart <i class="uk-icon-check yellow"></i>',array('class'=>'uk-button full-width uk-form-help-inline uk-margin-remove uk-button-large uk-button-dark text-uppercase uk-text-bold uk-margin-small-left btn-add-to-cart','type'=>'submit','name'=>'submit'))!!}                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                </article>
            </div>
        </div>


        <div class="wrap footer">
        @include("layouts._front.footer")
        </div>
    </div>
</body>
</html>