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

</head>
<body>
<div id="container">
	<!-- HEADER START-->
    <div class="wrap header">
		    @include("layouts._front.header")
    </div>
    <!-- HEADER END-->

    <!-- CONTENTS START-->


    <div class="wrap content uk-block  bgloginregister white ">



        <span class="bgtrans"></span>
            @yield('content')

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
<script type="text/javascript">
$(document).ready(function(){
    setpageminheight();
    function setpageminheight(){
        var wheight = $(window).height();
        var temp_wh =wheight-510;
        $('.wrap.content.uk-block.bgloginregister').css('min-height',temp_wh+'px');
    }
    $(window).resize(function(){
        setpageminheight();
    });

});

</script>
@include("layouts._front.nav-mobile")

</body>
</Html>

