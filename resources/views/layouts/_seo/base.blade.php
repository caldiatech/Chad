<!doctype html>
<html lang="en" class="no-js">
<head>
 <meta charset="utf-8">
 <meta name="author" content="">
 <meta name="keywords" content="">
 <meta name="description" content="">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 
 <link rel="shortcut icon" href="favicon.ico" />
 
 {{ HTML::style('_admin/assets/css/core.css') }}  
 {{ HTML::script('//cufon.shoqolate.com/js/cufon-yui.js?v=1.09i','') }}
 {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js','') }}
 {{ HTML::script('_admin/assets/js/modernizr.js','') }}

 @section('headercodes')
 @show 

 
 <title>DNR Admin</title>
</head>

<body>
<figure id="admincontent" class="edge">
 <header>
	<h1><!-- ACM-II Dashboard --> </h1>
 </header>

 <section>
    <aside>
        <ul>
	      	<li>
            	{{ HTML::image_link('/dnrseo/dashboard','_admin/assets/images/icons/icon_dashboard.png','Dashboard','Dashboard') }}
                
                
                {{ HTML::image_link('/dnrseo/pages','_admin/assets/images/icons/icon_page.png','Page Management','Page Management') }}
                
                 {{ HTML::image_link('/dnrseo/google','_admin/assets/images/icons/icon_page.png','Google Code','Google Code') }}
                 
                 {{ HTML::image_link('/dnrseo/footer','_admin/assets/images/icons/icon_page.png','Footer Management','Footer Management') }}
                
                
                {{ HTML::image_link('/dnrseo/logout','_admin/assets/images/icons/icon_users.png','Logout','Logout') }}                
    	</ul>
  	</aside>
 	 @yield('content')  
 </section>
 
 <footer>
 	
 </footer>
</figure>

  @section('extracodes')
  	
  @show 

</body>
</html>