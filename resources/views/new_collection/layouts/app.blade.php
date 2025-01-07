<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clarkin Collection</title>
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

    <header>
        @include('new_collection.layouts.header')
    </header>

    <main>
        @yield('content')
    </main>
    
    <footer>
        @include('new_collection.layouts.footer')
    </footer>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('_new_collection/assets/js/jquery-3.5.1.slim.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/aos.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/slick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('_new_collection/assets/js/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>
  </body>
</html>
