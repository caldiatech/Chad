<!doctype Html>
<!--[if lte IE 8]><Html class="msie no-js no-svg" lang="en"><![endif]-->
<!--[if gte IE 9]><!-->
<Html class="no-js no-svg" lang="en">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> {{ $pages->fldPagesName != "" ? $pages->fldPagesName : $settings->site_name }} </title>
  @if($pages->fldPagesMetaKeywords != "")
  <meta name="keywords" content="{{ $pages->fldPagesMetaKeywords }}"> @endif @if($pages->fldPagesMetaDescription != "")
  <meta name="description" content="{{ $pages->fldPagesMetaDescription }}"> @endif
  <meta name="description" content="...">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <link href="{!! asset('_front/assets/icons/Icon.png') !!}" rel="apple-touch-icon">
  <link href="{!! asset('_front/assets/icons/favicon.png') !!}" type="image/png" rel="shortcut icon">

  <!-- {!! Html::style('_front/assets/css/bootstrap.min.css') !!}   -->
  {!! Html::style('_front/plugins/uikit/css/uikit.min.css') !!} {!! Html::style('_front/assets/css/core.css')
  !!} {!! Html::style('_front/assets/css/page.css') !!} {!! Html::script('_front/assets/js/jquery-1.9.1.min.js')
  !!} {!! HTML::script('_front/plugins/uikit/js/uikit.min.js') !!}
  <!--[if lt IE 9]>
  {!! Html::script('_front/assets/js/respond.min.js') !!}
  {!! Html::script('_front/assets/js/Html5shiv.js') !!}
<![endif]-->

  @section('headercodes') @show {{ $google->google_analytics != "" ? $google->google_analytics : "" }} {{ $google->google_conversion
  != "" ? $google->google_conversion : "" }}

</head>

<body>
  <div id="container" class="page page-{{$pages->fldPagesSlug}} page-id-{{$pages->fldPagesID}}">
    <!-- HEADER START-->
    <div class="wrap header">
      @include("layouts._front.header")
    </div>


    <div class="grid">
      <?php /*
        @if(empty($pages->fldPagesImage)) <?php $pages->fldPagesImage = 'header-style-1.jpg'; ?> @endif http://54.68.88.28/clarkin/public/uploads/pages/medium/framing-page-background.jpg */ ?>

        <div class="uk-width-1-1 uk-cover-background header-image parallax" data-uk-parallax="{bg: '-200'}" style="background-image:url('uploads/pages/{{$pages->fldPagesImage}}')">
          <?php /* <div class="uk-width-1-1 uk-cover-background header-image parallax"  data-uk-parallax="{bg: '-200'}"  style="background-image:url(' public/_front/assets/images/wallpapers/{{$pages->fldPagesImage}}')"> */ ?>
            <div class="uk-container uk-container-center">
              <h1>{!! $pages->fldPagesTitle == "" ? $pages->fldPagesName : $pages->fldPagesTitle !!}</h1>
            </div>
        </div>

    </div>
    <!-- HEADER END-->

    <!-- CONTENTS START-->
    <div class="wrap content">

      @yield('content')

    </div>
    <!--wrap content -->
    <div class="push"></div>
    <!-- CONTENTS END-->

  </div>
  <!-- #container -->
  <!-- FOOTER START-->
  <div class="wrap footer">
    @include("layouts._front.footer")
  </div>
  <!-- FOOTER END-->
  @section('extracodes') @show @include("layouts._front.nav-mobile") {!! HTML::script(url('_front/plugins/uikit/js/components/grid.min.js'))
  !!}
  <script>
    $(document).ready(function () {

      loadScript("{!!url('_front/plugins/uikit/js/components/parallax.min.js')!!}", function () {
        var parallax = UIkit.parallax($('.parallax'), { /* options */ });
      });



    });
  </script>
</body>

</Html>