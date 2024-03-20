<?php $dashboard_name = strtoupper($pages->category); ?>
<!doctype Html>
<!--[if lte IE 8]><Html class="msie no-js no-svg" lang="en"><![endif]-->
<!--[if gte IE 9]><!--><Html class="no-js no-svg" lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title class="text-capitalize">{{$dashboard_name}} {{ $pages->fldPagesTitle != "" ? $pages->fldPagesTitle : " Dashboard " }} | {{ $settings->site_name }} CC</title>
<meta name="description" content="Dashboard">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="{!! asset('_front/assets/icons/Icon.png') !!}" rel="apple-touch-icon">
<link href="{!! asset('_front/assets/icons/favicon.png') !!}" type="image/png" rel="shortcut icon">

 {!! Html::style('_front/plugins/uikit/css/uikit.min.css') !!} 
 {!! Html::style('_front/assets/css/dashboard-core.css') !!}  
 {!! Html::script('_front/assets/js/jquery-1.9.1.min.js') !!}
 {!! HTML::script('_front/plugins/uikit/js/uikit.min.js') !!}
<!--[if lt IE 9]>
  {!! Html::script('_front/assets/js/respond.min.js') !!}
  {!! Html::script('_front/assets/js/Html5shiv.js') !!}
<![endif]-->

 @section('headercodes')
 @show 
 <? /*
 {{ $google->google_analytics != "" ? $google->google_analytics : "" }}
 {{ $google->google_conversion != "" ? $google->google_conversion : "" }}
  */
 ?>

</head>
<body>
<div id="container">
	  <!-- HEADER START-->
    <div class="wrap header">
      <button class="uk-button uk-medium-visible uk-button-offcanvas " data-uk-offcanvas="{target:'#offcanvas-dashboard'}"> <i class="uk-icon-bars uk-margin-medium-right"></i> Menu</button>
      <button data-uk-toggle="{target:'#offcanvas-dashboard', cls:'uk-active'}" class="uk-button uk-toggle-offcanvas uk-large-visible"> <i class="uk-icon-bars uk-margin-medium-right"></i> Menu</button>
      <div class="top-right uk-float-right">
        <div class="uk-button-dropdown" data-uk-dropdown>
            <a href="javascript:void(0)" class="uk-button"> 
              <span class="encircled">
                @if($manager->fldManagerImage  != "")
                {!! HTML::image(url(MANAGER_IMAGE_PATH.$manager->fldManagerID.'/'.THUMB_IMAGE.$manager->fldManagerImage),  isset($manager) ? $manager->fldManagerFirstname . ' ' . $manager->fldManagerLastname : "" , array('class' => 'dashbaord-profile','width'=>'39', 'height'=>'39','style'=>'height:39px !important')) !!}

              </span> 
              @endif
              <span class="profile-name">{{ isset($manager) ? $manager->fldManagerFirstname . ' ' . $manager->fldManagerLastname  : ""}}</span> <i class="uk-icon-angle-down"></i></a>
            <div class="uk-dropdown uk-dropdown-small uk-padding-remove">

                <ul class="uk-nav uk-nav-dropdown">
                    <li class="profile-hide "><a class="profile-name" href="{{url('dashboard/'.$pages->category.'/profile')}}" > <i class="uk-icon-user uk-icon-justify"></i> {{ isset($manager) ? $manager->fldManagerFirstname . ' ' . $manager->fldManagerLastname : ""  }}</a></li>
                    <li><a href="{{url('dashboard/sales/edit-profile')}}" class="@if($pages->slug == 'edit-profile') uk-active @endif"> <i class="uk-icon-pencil ion ion-edit uk-icon-justify"></i> Edit Profile</a></li>
                    <li><a href="{{url('dashboard/sales/settings')}}" class="@if($pages->slug == 'settings') uk-active @endif"> <i class="uk-icon-wrench ion ion-settings uk-icon-justify"></i> Settings</a></li>
                    <li><a href="{{url('dashboard/sales/logout')}}" class=""> <i class="uk-icon-sign-out uk-icon-justify"></i> Log Out</a></li>
                </ul>
            </div>

        </div>
      </div>
    </div>
    <!-- HEADER END-->
    <!-- CONTENTS START-->
    <div class="wrap content">
        <article id="main" role="main">
          <div class="uk-breadcrumb-wrapper">
            <ul class="uk-breadcrumb uk-margin-remove">
                <li class="uk-active">
		     @if($pages->category == "sales")
                    @if($pages->fldPagesTitle == "Dashboard")
                      <span>Dashboard</span>
                    @else
                       <span><a href="{{ url('dashboard/sales') }}">Dashboard</a></span>
                       <span>/ {{ $pages->fldPagesTitle }}</span>
                    
                    @endif
                  @else
                       <span>Dashboard</span>
                  @endif  
		</li>
            </ul>
          </div>
          <div class="uk-grid uk-margin-remove">
            <h1 class="uk-h1 text-uppercase uk-margin-remove   uk-width-medium-8-10   uk-width-small-1-1 uk-padding-remove">{!! $pages->fldPagesTitle !!}</h1>
            <div class="uk-float-right uk-padding-v-normal article-right-menu  uk-text-right   uk-width-medium-2-10   uk-width-small-1-1 ">
              <a href="{{url('dashboard/'.$pages->category.'/settings')}}"><i class="uk-icon-wrench ion ion-settings uk-icon-justify"></i> <span class="icon-text uk-padding-small-right">Settings</span></a>
            </div>
          </div>
          @yield('content')
        </article>
		</div>
    <div class="push"></div>
    <!-- CONTENTS END-->

</div><!--#container -->
<!-- FOOTER START-->
<footer>
<div class="wrap footer">
    <div class="footer-right">
      <a class="dashboard-site-logo" href="">{!! HTML::image(url('_front/assets/images/clarkin-collections-logo-black.png'), 'Clarkin Collections', array('class' => 'site-img','width'=>'177', 'height'=>'43')) !!}</a>
    </div>
</div>
{!! HTML::script('_front/assets/js/plugins-dashboard.js') !!}
<script>
$(document).ready(function(){
    loadcssfile('https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700|Lato:400,300,700','css');
    loadcssfile('{{url("public/_front/assets/fonts/ionicons-2.0.1/css/ionicons.min.css")}}','css');

});
</script>
</footer>
<!-- FOOTER END-->


@section('extracodes')

@show 
<div id="offcanvas-dashboard" class="uk-offcanvas uk-active uk-offcanvas-dashboard">
    
    <div class="uk-offcanvas-bar">
      <div class="offcanvas-header">
        <a class="dashboard-site-logo full-width uk-text-center" href="">{!! HTML::image(url('_front/assets/images/logo-clarkin-white.png'), 'Clarkin Collections', array('class' => 'dashboard-site-logo mauto hauto w100 uk-margin-large-top uk-margin-large-bottom uk-text-center','width'=>'156', 'height'=>'133','style'=>'max-width:156px')) !!}
        </a>
      </div>
      <ul class="uk-nav uk-nav-offcanvas  uk-nav-parent-icon">
        @include("dashboard.".$pages->category.".includes.menunav")
      </ul>  
    </div>
</div>
</body>
</Html>