<!doctype Html>
<!--[if lte IE 8]><Html class="msie no-js no-svg" lang="en"><![endif]-->
<!--[if gte IE 9]><!--><Html class="no-js no-svg" lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title> @if(isset($pages)) {{ $pages->fldPagesName != "" ? $pages->fldPagesName : $settings->site_name }} @else My Account @endif  </title>
<meta name="description" content="...">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="{!! asset('_front/assets/icons/Icon.png') !!}" rel="apple-touch-icon">
<link href="{!! asset('_front/assets/icons/favicon.png') !!}" type="image/png" rel="shortcut icon">

 <!-- {!! Html::style('_front/assets/css/bootstrap.min.css') !!}   -->
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

 {{ $google->google_analytics != "" ? $google->google_analytics : "" }}
 {{ $google->google_conversion != "" ? $google->google_conversion : "" }}

    <!-- New css -->
    <link href="{{ asset('_new_collection/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/owl.theme.default.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/magnific-popup.css') }}" rel="stylesheet">
</head>
<body>
<div id="container">
	<!-- HEADER START-->
    {{--<div class="wrap header">
		    @include("layouts._front.header")
    </div>--}}
    <header>
        @include('layouts._front.new_collection.layouts.header')        
    </header>
    <!-- HEADER END-->

    <!-- CONTENTS START-->

    <?php
    $bgloginregister_style = '';

    if(!empty($pages->fldPagesImage) && $pages->fldPagesImage != ''){
       $bgloginregister_style = "background-image:url('".url('uploads/pages/'.$pages->fldPagesImage)."')";
    }
    ?>
    <div class="wrap content uk-block  bgloginregister white " data-style="{{$bgloginregister_style}}" style="{!!$bgloginregister_style!!}">
        <span class="bgtrans"  ></span>
            @yield('content')

    </div><!--wrap content -->
    <div class="push"></div>
    <!-- CONTENTS END-->

</div><!-- #container -->
<!-- FOOTER START-->
{{--<div class="wrap footer">
    @include("layouts._front.footer")
</div>--}}
<footer>
    @include('layouts._front.new_collection.layouts.footer')
  </footer>
<!-- FOOTER END-->

    <!-- New JS -->
    <script src="{{ asset('_new_collection/assets/js/jquery-3.5.1.slim.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/aos.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/slick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>
    
@section('extracodes')
@show
<script type="text/javascript">


</script>
@include("layouts._front.nav-mobile")

</body>
</Html>

