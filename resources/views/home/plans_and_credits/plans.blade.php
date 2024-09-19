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

<style>
.row {
  height: 100%;
  align-items: center;
}

#pricing {
  height: 100%;
  padding: 100px;
  text-align: center;
}

#plans-content {
    text-align: left;
    margin-left: 50px;
}

.card {
  border: 1px solid black;
}

.card-header {
  color: white;
  background-color: black;
}

.pricing-column {
  padding: 3% 2%;
}

.btn-dark {
  background-color: black;
}

.btn-dark:hover {
  background-color: #343a40;
}
  </style>
 @section('headercodes')
 @show 
 
 {{-- {{ $google->google_analytics != "" ? $google->google_analytics : "" }}
 {{ $google->google_conversion != "" ? $google->google_conversion : "" }}
  --}}
</head>
<body>
<div id="container">
  <!-- HEADER START-->
    <div class="wrap header">
        @include("layouts._front.header")
    </div>

    <!-- HEADER END-->
    
    <!-- CONTENTS START-->      
    <div class="wrap content"> 
        <section id="pricing">

             @if(Session::has('success'))
                <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
            @endif
            @if(Session::has('error'))
                <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
            @endif
            <div class="row">
            {!! Form::open(array('url' => '/add/cart', 'method' => 'post', 'class'=>'uk-form')); !!}
                <div class="pricing-column col-lg-4 col-md-6">
                </div>

                <div class="pricing-column col-lg-4 col-md-6">
                    <div class="product-title">
                    {{-- {{$productImage['image_name']}} --}}
                        <input type="hidden" value="credits" name="print_name">
                        <input type="hidden" value="unedited-digital-files" name="unedited_login">
                        {{-- <input type="hidden" value="{{$productImage['id']}}" name="product_id"> --}}
                    </div>
                    <div class="card" style="border-radius: 6px;">
                        <div class="card-header" style="color:white; background-color:#292929; height:35px;">
                            <h3>Credit packs</h3>
                        </div>
                        <h2 style="color:black; font-weight: 800 !important;">$8 / Credit</h2>
                        <div class="card-body" id="plans-content">
                            <div>
                                <input type="radio" value="8" name="image_price"> <label>1 Credit &nbsp;&nbsp; $8</label>
                            </div>
                            <div>
                                <input type="radio" value="14" name="image_price"> <label>2 Credit &nbsp;&nbsp; $14 And Save $2</label>
                            </div>
                            <div>
                                <input type="radio" value="20" name="image_price"> <label>3 Credit &nbsp;&nbsp; $20 And Save $4</label>
                            </div>
                            <div>
                                <input type="radio" value="35" name="image_price"> <label>6 Credit &nbsp;&nbsp; $35 And Save $13</label>
                            </div>
                            <div>
                                <input type="radio" value="65" name="image_price"> <label>12 Credit &nbsp;&nbsp; $65 And Save $31</label>
                            </div>
                            
                        </div>
                            <div class="product-button">
                            {!! Form::button('Continue with purchase',array('name'=>'addtoCart','class'=>'btn btn-lg btn-block', 'style' => 'color:white; background-color:#292929' ,'type' => 'submit'))!!} 
                            </div>
                            {{-- <button class="btn btn-lg btn-block btn-dark" type="button" style="color:white">Continue with purchase</button> --}}
                    </div>
                </div>

                <div class="pricing-column col-lg-4">
                </div>

            {!! Form::close() !!}
            </div>

        </section>
         
    </div><!--wrap content -->
    <div class="push"></div>
    <!-- CONTENTS END-->    
    
    </div><!-- #container -->
<!-- FOOTER START-->
<div class="wrap footer">
    @include("layouts._front.footer")
</div>
<!-- FOOTER END-->


@section('extracodes')
@show 
@include("layouts._front.nav-mobile")
</body>
</Html>



