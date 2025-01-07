<!doctype html>
<html  class="no-js no-svg" lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{!! asset('_front/assets/icons/Icon.png') !!}" rel="apple-touch-icon">
    <link href="{!! asset('_front/assets/icons/favicon.png') !!}" type="image/png" rel="shortcut icon">
    
    @if(isset($pages->fldPagesMetaKeywords) && $pages->fldPagesMetaKeywords != "")
      <meta name="keywords" content="{{ $pages->fldPagesMetaKeywords }}">
    @endif

    @if(isset($pages->fldPagesMetaDescription) && $pages->fldPagesMetaDescription != "")
      <meta name="description" content="{{ $pages->fldPagesMetaDescription }}">
    @endif

    @if(request()->is('featured-images') && isset($category_details->fldCategoryName) && $category_details->fldCategoryName != "")
      <title>{!! $category_details->fldCategoryName !!}</title>
    @elseif(request()->is('collection') && isset($category_details->fldCategoryName) && $category_details->fldCategoryName != "")
        <title>{!! $category_details->fldCategoryName !!}</title>
    @elseif(request()->is('login') && isset($pages) &&  $pages->fldPagesName != "")
        <title>{!! $pages->fldPagesName !!}</title>
    @elseif(isset($pages->fldPagesMetaTitle) && $pages->fldPagesName != "")
        <title>{{ $pages->fldPagesMetaTitle != "" ? $pages->fldPagesMetaTitle : $pages->fldPagesName . ' | ' . SITENAME }}</title>
    @else
        <title>{{ $settings->site_name }}</title>
    @endif

    <link href="{{ asset('_new_collection/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/owl.theme.default.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('_new_collection/assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('_front/assets/icons/Icon.png') }}" rel="apple-touch-icon">

    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.24.3/css/uikit.min.css" integrity="sha512-BjGOyprHlya/wCYnK0WJ70UXIKjgkEjQalzciPBoXfYfUXupeyo/WtwxbtQvoZVVxHs0rNmMKIXkK6djsBSf3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
    
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.24.3/js/uikit.min.js" integrity="sha512-XfQkPK2dgO3nWqAhRHJgkd4d0SqLzUhwGGBVaF6q4q7K7ctgE72Fuu8nV/1wkhTksi/Tc26EJ0wZjMGaGC8dCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

    @section('headercodes')
    @show 
    <?php 
      if(!isset($cart_count)){
        $cart_count = 0;
      }
    ?>
  </head>
  <body>

    <header>
        @include('layouts._front.new_collection.layouts.header')        
    </header>

    <main>
        @yield('content')
    </main>
    
    <footer>
    @include('layouts._front.new_collection.layouts.footer')
    </footer>
    
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
  </body>
</html>
