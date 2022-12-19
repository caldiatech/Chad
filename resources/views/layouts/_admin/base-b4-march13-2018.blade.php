<!doctype html>
<html lang="en" class="no-js">
<head>
 <meta charset="utf-8">
 <meta name="author" content="">
 <meta name="keywords" content="">
 <meta name="description" content="">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 
 <link rel="shortcut icon" href="favicon.ico" />
    
 {!! Html::style('_admin/assets/uikit/css/uikit.docs.min.css') !!}  
 {!! Html::style('_admin/assets/uikit/css/style.css') !!}  
 {!! Html::style('_admin/assets/css/Pe-icon-7-stroke.css') !!}  
 {!! Html::style('_admin/assets/css/responsive.css') !!}    
 {!! Html::style('_admin/assets/css/dashboard.css') !!}
 <!-- {!! Html::style('_admin/assets/css/core.css') !!} -->
 
 @section('headercodes')
 @show 
 
 <title>Clarkin Admin Control Panel</title>
</head>

<body>
    
    <nav class="uk-navbar position-fixed">

        <a href="#" class="uk-navbar-toggle uk-margin-left" data-uk-offcanvas="{target:'#dnr-menu'}"></a>
        
        <div class="uk-navbar-left">
            <span class="c-name"><a href="{{url('/')}}" target="_blank" class="p-name" title="Clarkin">Clarkin</a></span>
        </div> 

        <div id="topmenu" class="uk-navbar-flip uk-margin-large-right">
            Hi, Admin! Welcome <i class="pe-7s-user usericon"></i> 
            <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                <a class="white"><i class="pe-7s-angle-down usericon"></i></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li class="uk-hidden"><a href="{{url('/')}}" target="_blank" class="p-liname" title="Clarkin"><i class="pe-7s-link paddright"></i> Clarkin</a></li>
                        <li class="uk-nav-divider uk-hidden"></li>
                        <li><a href="{{url('/dnradmin/settings')}}" title="Settings"><i class="pe-7s-tools paddright"></i> Settings</a></li>
                        <li><a href="{{url('/dnradmin/logout')}}" title="Logout"><i class="pe-7s-power paddright"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </nav>
    
    <nav class="d-menu">
        <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav="">
            <li><div href="" class="pad-5"><img class="uk-border-circle" src="{{url('_admin/assets/images/clarking-adminlogo.png')}}" alt="Crossings Logo" data-uk-tooltip="{pos:'right'}" title="Clarkin Control Panel"></div></li> 
            <li><a href="{{url('/dnradmin/dashboard')}}" data-uk-tooltip="{pos:'right'}" title="Dashboard"><i class="pe-7s-home"></i></a></li>
            <li><a href="{{url('/dnradmin/pages')}}" data-uk-tooltip="{pos:'right'}" title="Pages"><i class="pe-7s-copy-file"></i></a></li>
            <li><a href="{{url('/dnradmin/homeslides')}}" data-uk-tooltip="{pos:'right'}" title="Home Slide"><i class="pe-7s-display2"></i></a></li>    
            <li><a href="{{url('/dnradmin/contact')}}" data-uk-tooltip="{pos:'right'}" title="Contact"><i class="pe-7s-mail-open-file"></i></a></li>                        

            <li class="uk-nav-divider"></li>
            <li class="hlbg"><a href="{{url('/dnradmin/manager')}}" data-uk-tooltip="{pos:'right'}" title="Sales Manager"><i class="pe-7s-users"></i></a></li>
            <li class="hlbg"><a href="{{url('/dnradmin/sales-rep')}}" data-uk-tooltip="{pos:'right'}" title="Sales Rep"><i class="pe-7s-users"></i></a></li>
            <li class="hlbg"><a href="{{url('/dnradmin/shop-owner')}}" data-uk-tooltip="{pos:'right'}" title="Shop Owner"><i class="pe-7s-users"></i></a></li>
            <li class="hlbg"><a href="{{url('/dnradmin/client')}}" data-uk-tooltip="{pos:'right'}" title="Client"><i class="pe-7s-users"></i></a></li>

            <li class="uk-nav-divider"></li>
            <li class="uk-nav-header"><i class="pe-7s-menu" data-uk-tooltip="{pos:'right'}" title="Ecommerce"></i></a></li>
            <li class="hlbg"><a href="{{url('/dnradmin/category')}}" data-uk-tooltip="{pos:'right'}" title="Product"><i class="pe-7s-photo"></i></a></li>
            <li class="hlbg"><a href="{{url('/dnradmin/coupon_code')}}" data-uk-tooltip="{pos:'right'}" title="Coupon Code"><i class="pe-7s-scissors"></i></a></li>
            <li class="hlbg"><a href="{{url('/dnradmin/state')}}" data-uk-tooltip="{pos:'right'}" title="Tax"><i class="pe-7s-cash"></i></a></li>
            <? /* <li class="hlbg"><a href="{{url('/dnradmin/shipping')}}" data-uk-tooltip="{pos:'right'}" title="Shipping"><i class="pe-7s-plane"></i></a></li> */ ?>
            <li class="hlbg"><a href="{{url('/dnradmin/orders')}}" data-uk-tooltip="{pos:'right'}" title="Order"><i class="pe-7s-cart"></i></a></li>
            <li class="hlbg"><a href="{{url('/dnradmin/commissions')}}" data-uk-tooltip="{pos:'right'}" title="Commissions"><i class="pe-7s-wallet"></i></a></li>
        </ul>
    </nav>
    
    
<figure id="admincontent" class="edge">
 <header>
    <h1>{!! $pageTitle !!}</h1>
 </header>

 <section>
     @yield('content')  
 </section>

</figure>

<footer>
    <div class="uk-container poweredby">
        <div class="uk-grid uk-grid-match" data-uk-grid-margin="">
            <div class="uk-width-medium-1-1 uk-row-first">
                <div class="uk-panel">
                    <p>Powered by <a href="http://dogandrooster.com/" target="_blank">Dog &amp; Rooster, Inc.</a></p>
                </div>
            </div>
        </div>
    </div>
 </footer>
    
    <!-- menu offcanvas -->
    <div id="dnr-menu" class="uk-offcanvas">
        <div class="uk-offcanvas-bar" style="left: 50px">
            <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>
                <li><div class="pad-5 cpanel">Control Panel</div></li> 
                <li><a href="{{url('/dnradmin/dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('/dnradmin/pages')}}">Pages</a></li>        
                <li><a href="{{url('/dnradmin/homeslides')}}">Home Slide</a></li>              
                <li><a href="{{url('/dnradmin/contact')}}">Contact</a></li>

                <li class="uk-nav-divider"></li>
                <li class="hlbg"><a href="{{url('/dnradmin/manager')}}">Sales Manager</a></li>        
                <li class="hlbg"><a href="{{url('/dnradmin/sales-rep')}}">Sales Rep</a></li> 
                <li class="hlbg"><a href="{{url('/dnradmin/shop-owner')}}">Shop Owner</a></li>        
                <li class="hlbg"><a href="{{url('/dnradmin/client')}}">Client</a></li>        

                <li class="uk-nav-divider"></li>
                <li class="uk-nav-header">Ecommerce</li>
                <li class="hlbg"><a href="{{url('/dnradmin/category')}}">Product</a></li>
                <li class="hlbg"><a href="{{url('/dnradmin/coupon_code')}}">Coupon Code</a></li>
                <li class="hlbg"><a href="{{url('/dnradmin/state')}}">Tax</a></li>
                <? /* <li class="hlbg"><a href="{{url('/dnradmin/shipping')}}">Shipping</a></li> */ ?>
                <li class="hlbg"><a href="{{url('/dnradmin/orders')}}">Order</a></li>
                <li class="hlbg"><a href="{{url('/dnradmin/commissions')}}" class="fix-lineh">Commissions</a></li>
            </ul>
        </div>
    </div>


</body>
    
 {!! Html::script('_admin/assets/uikit/jquery.js') !!}
 {!! Html::script('_admin/assets/uikit/uikit.min.js') !!}
 {!! Html::script('_admin/assets/uikit/dc.js') !!}
 {!! Html::script('_admin/assets/uikit/components/slideshow.min.js') !!}
 {!! Html::script('_admin/assets/uikit/components/slideshow-fx.min.js') !!}  
 {!! Html::script('_admin/assets/uikit/components/offcanvas.min.js') !!}  
 {!! Html::script('_admin/assets/uikit/components/lightbox.min.js') !!}  
 {!! Html::script('_admin/assets/uikit/components/grid.min.js') !!} 
 {!! Html::script('_admin/assets/uikit/components/tooltip.min.js') !!} 

@section('extracodes')
    
@show 
    
</html>