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
                                <li><a href="{{url('/dnradmin/uploadImages')}}">Upload Images</a></li>
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

        <div class="uk-margin-top uk-grid-width-small-1-2 uk-grid-width-medium-1-2 uk-grid-width-large-1-2 tm-grid-heights" data-uk-grid="{gutter: 25}" style="position: relative; margin-left: -20px; height: 394px;">

            <div id="xcommerce" data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 20px; padding-bottom: 20px; top: 0px; left: 0px; opacity: 1;">

                <div class="uk-panel-box dashbox">
                    <div class="utypes">
                        <h3><i class="ntitle-icon pe-7s-less" data-uk-toggle="{target:'.utypes'}"></i> User Types <small class="smallText">Recently Updated</small></h3>

                        <div class="uk-grid uk-margin-box" data-uk-grid-margin="">
                            <div class="uk-width-medium-1-4">
                                <a class="uk-thumbnail th-box uk-text-center uk-width-1-1" href="{{url('/dnradmin/manager')}}">
                                    <i class="pe-7s-users iconsizelarge"></i>
                                    <div class="uk-thumbnail-caption">Sales Manager</div>
                                </a>
                            </div>

                            <div class="uk-width-medium-1-4">
                                <a class="uk-thumbnail th-box uk-text-center uk-width-1-1" href="{{url('/dnradmin/shop-owner')}}">
                                    <i class="pe-7s-users iconsizelarge"></i>
                                    <div class="uk-thumbnail-caption">Shop Owner</div>
                                </a>
                            </div>
                            <div class="uk-width-medium-1-4">
                                <a class="uk-thumbnail th-box uk-text-center uk-width-1-1" href="{{url('/dnradmin/client')}}">
                                    <i class="pe-7s-users iconsizelarge"></i>
                                    <div class="uk-thumbnail-caption">Clients</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="utypes uk-hidden">
                        <h3><i class="ntitle-icon pe-7s-plus" data-uk-toggle="{target:'.utypes'}"></i> User Types <small class="smallText">Recently Updated</small></h3>
                    </div>
                </div>

            </div>

            <div id="commerce" data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 20px; padding-bottom: 20px; top: 0px; left: 0px; opacity: 1;">

                <div class="uk-panel-box dashbox">
                    <div class="ecommerce">
                        <h3><i class="ntitle-icon pe-7s-less" data-uk-toggle="{target:'.ecommerce'}"></i> E-Commerce <small class="smallText">Recently Updated</small></h3>

                        <div class="uk-grid uk-margin-box" data-uk-grid-margin="">
                            <div class="uk-width-medium-1-4">
                                <a class="uk-thumbnail th-box uk-text-center uk-width-1-1" href="{{url('/dnradmin/category')}}">
                                    <i class="pe-7s-photo iconsizelarge"></i>
                                    <div class="uk-thumbnail-caption">Products</div>
                                </a>
                            </div>
                            <div class="uk-width-medium-1-4">
                                <a class="uk-thumbnail th-box uk-text-center uk-width-1-1" href="{{url('/dnradmin/coupon_code')}}">
                                    <i class="pe-7s-scissors iconsizelarge"></i>
                                    <div class="uk-thumbnail-caption">Coupon Code</div>
                                </a>
                            </div>

                            <div class="uk-width-medium-1-4">
                                <a class="uk-thumbnail th-box uk-text-center uk-width-1-1" href="{{url('/dnradmin/orders')}}">
                                    <i class="pe-7s-cart iconsizelarge"></i>
                                    <div class="uk-thumbnail-caption">Orders</div>
                                </a>
                            </div>
                            <!-- <div class="uk-width-medium-1-4">
                                <a class="uk-thumbnail th-box uk-text-center uk-width-1-1" href="{{url('/dnradmin/uploadImage')}}">
                                    <i class="pe-7s-photo iconsizelarge"></i>
                                    <div class="uk-thumbnail-caption">Upload Image</div>
                                </a>
                            </div> -->
                        </div>
                    </div>

                    <div class="ecommerce uk-hidden">
                        <h3><i class="ntitle-icon pe-7s-plus" data-uk-toggle="{target:'.ecommerce'}"></i> E-Commerce <small class="smallText">Recently Updated</small></h3>
                    </div>
                </div>
            </div>


            <div class="dashpastconfe uk-hidden">
                <h3><i class="ntitle-icon pe-7s-plus" data-uk-toggle="{target:'.dashpastconfe'}"></i> Past Conferences <span class="uk-position-top-right viewall"><a href="{{ url('dnradmin/past-conferences') }}"><i class="custom-right-arrow ntitle-icon"></i>View All Past Conferences</a></span></h3>
            </div>

        </div>
    </div>
</article>





@stop

@section('headercodes')
    {!! Html::style('_admin/assets/css/dashboard.css') !!}

@stop

@section('extracodes')
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    <script>

	</script>

@stop
