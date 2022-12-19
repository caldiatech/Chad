<!doctype html>
<html lang="en" class="no-js">
<head>
  <title>DNR Admin</title>
 <meta charset="utf-8">
 <meta name="author" content="">
 <meta name="keywords" content="">
 <meta name="description" content="">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 
 <link rel="shortcut icon" href="favicon.ico" />

 <link media="all" type="text/css" rel="stylesheet" href="{{url('_admin/assets/css/core.css')}}">
 <script src="//cufon.shoqolate.com/js/cufon-yui.js?v=1.09i"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
 <script src="{{url('_admin/assets/js/modernizr.js')}}"></script>
 

@section('headercodes')
@show 

</head>

<body>

<figure id=adminaccess>

 <section>
 	 @yield('content')  
 </section>
 
</figure>
	
@section('extracodes')
@show 

</body>
</html>