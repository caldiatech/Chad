<!doctype html>
<html lang="en" class="no-js">
<head>
  <title>Clarkin Admin</title>
 <meta charset="utf-8">
 <meta name="author" content="">
 <meta name="keywords" content="">
 <meta name="description" content="">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 
 <link rel="shortcut icon" href="favicon.ico" />
 <link media="all" type="text/css" rel="stylesheet" href="{{url('_admin/assets/uikit/css/uikit.docs.min.css')}}">
 <link media="all" type="text/css" rel="stylesheet" href="{{url('_admin/assets/uikit/css/style.css')}}">
 <link media="all" type="text/css" rel="stylesheet" href="{{url('_admin/assets/css/Pe-icon-7-stroke.css')}}">

@section('headercodes')
@show 

</head>

<body class="uk-height-1-1" id="login">
    
<div id=adminaccess class="uk-vertical-align uk-text-center uk-height-1-1">
    <div class="uk-vertical-align-middle" style="width: 550px;">

        @yield('content') 

    </div>
</div>

<!--
<figure id=adminaccess>

 <section>
 	
 </section>
 
</figure>
-->
	
@section('extracodes')
@show 

</body>
     <script src="//cufon.shoqolate.com/js/cufon-yui.js?v=1.09i"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
 <script src="{{url('_admin/assets/js/modernizr.js')}}"></script>
    
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</html>