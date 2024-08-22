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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.24.3/css/uikit.min.css" integrity="sha512-BjGOyprHlya/wCYnK0WJ70UXIKjgkEjQalzciPBoXfYfUXupeyo/WtwxbtQvoZVVxHs0rNmMKIXkK6djsBSf3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.24.3/js/uikit.min.js" integrity="sha512-XfQkPK2dgO3nWqAhRHJgkd4d0SqLzUhwGGBVaF6q4q7K7ctgE72Fuu8nV/1wkhTksi/Tc26EJ0wZjMGaGC8dCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
