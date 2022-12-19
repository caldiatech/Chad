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
 {{ HTML::style('_admin/assets/css/core.css') }}  
 {{ HTML::script('http://cufon.shoqolate.com/js/cufon-yui.js?v=1.09i','') }}
 {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js','') }}
 {{ HTML::script('_admin/assets/js/modernizr.js','') }}

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