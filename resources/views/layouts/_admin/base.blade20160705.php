<!doctype html>
<html lang="en" class="no-js">
<head>
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

 
 <title>DNR Admin</title>
</head>

<body>
<figure id="admincontent" class="edge">
 <header>
	<h1>ACM-II Dashboard</h1>
    <small><span>Welcome back {{ $administrator->fullname }}</span> <a href="{{url('/dnradmin/logout')}}">[ Logout ]</a></small>
 </header>

 <section>
    <aside>
        <ul>
	      	<li>            	 
                <a href="{{url('/dnradmin/settings')}}" {{isset($settingsClass) ? $settingsClass : ""}}><img src="{{url('_admin/assets/images/icons/icon_settings.png')}}" alt="Settings">Settings</a>
                <a href="{{url('/dnradmin/pages')}}" {{isset($pageClass) ? $pageClass : ""}}><img src="{{url('_admin/assets/images/icons/icon_page.png')}}" alt="Page">Page</a>
		<a href="{{url('/dnradmin/manager')}}" {{isset($managerClass) ? $managerClass : ""}}><img src="{{url('_admin/assets/images/icons/icon_client.png')}}" alt="Sales Manager">Sales Manager</a>
		<a href="{{url('/dnradmin/sales-rep')}}" {{isset($salesClass) ? $salesClass : ""}}><img src="{{url('_admin/assets/images/icons/icon_client.png')}}" alt="Sales Rep">Sales Rep</a>
                <a href="{{url('/dnradmin/shop-owner')}}" {{isset($shopClass) ? $shopClass : ""}}><img src="{{url('_admin/assets/images/icons/icon_client.png')}}" alt="Shop Owner">Shop Owner</a>	
                <a href="{{url('/dnradmin/client')}}" {{isset($clientClass) ? $clientClass : ""}}><img src="{{url('_admin/assets/images/icons/icon_client.png')}}" alt="Client">Client</a>
                <a href="{{url('/dnradmin/homeslides')}}" {{isset($homeSlideClass) ? $homeSlideClass : "" }}><img src="{{url('_admin/assets/images/icons/icon_home_slides.png')}}" alt="Home Slide">Home Slide</a>                
                <a href="{{url('/dnradmin/contact')}}" {{isset($contactClass) ? $contactClass : "" }}><img src="{{url('_admin/assets/images/icons/icon_contact.png')}}" alt="Contact">Contact</a>
                <a href="{{url('/dnradmin/category')}}" {{isset($productClass) ? $productClass : "" }}><img src="{{url('_admin/assets/images/icons/icon_products.png')}}" alt="Product">Product</a>
                <a href="{{url('/dnradmin/coupon_code')}}" {{isset($couponClass) ? $couponClass : "" }}><img src="{{url('_admin/assets/images/icons/icon_coupon.png')}}" alt="Coupon Code">Coupon Code</a>                
                <a href="{{url('/dnradmin/shipping')}}" {{isset($shippingClass) ? $shippingClass : ""}}><img src="{{url('_admin/assets/images/icons/icon_shipping.png')}}" alt="Shipping">Shipping</a>
                <a href="{{url('/dnradmin/orders')}}" {{isset($orderClass) ? $orderClass : "" }}><img src="{{url('_admin/assets/images/icons/icon_users.png')}}" alt="Order">Order</a>
                <a href="{{url('/dnradmin/logout')}}"><img src="{{url('_admin/assets/images/icons/icon_logout.png')}}" alt="Logout">Logout</a>
                                              
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