@extends('layouts._admin.base')

@section('content')


<article>
    <div class="welcomeAdmin">
          
        <nav class="uk-navbar clsboth dashboardfirstrow">

            <ul class="uk-navbar-nav">
                <li class="navtitle">
                    <i class="pe-7s-info ntitle-icon"></i> Welcome Administrator 
                    <small class="smallText">Version 1.0</small>
                </li>
            </ul>

            <div class="uk-navbar-flip">

                <ul class="uk-navbar-nav">
                    <li><span>Quick Access <i class="pe-7s-angle-right"></i></span></li>
                    <li class="uk-parent" data-uk-dropdown>
                        <a>E-Commerce</a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <li><a href="{{url('/dnradmin/category')}}">Products</a></li>
                                <li><a href="{{url('/dnradmin/coupon_code')}}">Coupon Code</a></li>
                                <li><a href="{{url('/dnradmin/orders')}}">Orders</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="{{url('/dnradmin/pages')}}">Page</a></li>
                    <li><a href="{{url('/dnradmin/homeslides')}}">Home Slide</a></li>
                    <li><a href="{{url('/dnradmin/contact')}}">Contact</a></li>
  <!--                    <li class="nav-search"><a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" placeholder="Search" id="search" value="" style="height:20px;"/></a></li> -->
                </ul>
            </div>
        </nav>

        <div class="uk-margin-top uk-grid-width-small-1-2 uk-grid-width-medium-1-2 uk-grid-width-large-1-2 tm-grid-heights" >

           <div class="uk-width-1-1">
            <h1 class="dark-me">Admin page no longer exists.</h1>
           </div>
            
        </div> 
    </div>
</article>

@stop

@section('headercodes')
@stop

@section('extracodes')
@stop