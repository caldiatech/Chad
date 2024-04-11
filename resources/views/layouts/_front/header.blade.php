<header>
    <!-- PRE-ACTIVATED FOR RESPONSIVE LAYOUT -->
    <div class="topnav">
        <div class="container-large">
            <div class="top-nav-right uk-float-right">
		<span> <a href="https://instagram.com/cmclarkinimages"> clarkinimages &nbsp;<i class="uk-icon-instagram"></i></a></span>
                <span class="toplink-account">
                    @if(Session::has('client_id'))
                        <span> <a href="{!! url('dashboard/customer') !!}"> My Account <i class="uk-icon-caret-down"></i></a></span>
                    @elseif(Session::has('manager_id'))
                        <span> <a href="{!! url('dashboard/sales') !!}"> My Account <i class="uk-icon-caret-down"></i></a></span>
                    @elseif(Session::has('shop_owner_id'))
                        <span> <a href="{!! url('dashboard/shop-owner') !!}"> My Account <i class="uk-icon-caret-down"></i></a></span>
                    @else
                        <span class="login"> <a href="{!! url('login') !!}"> Login &nbsp;<i class="uk-icon-user"></i></a></span>
                    @endif
                </span><!--toplink-account -->
                <span><a href="{!! url('shopping-cart') !!}" ><i class="uk-icon-shopping-cart" id="shopping-cart"></i> <span class="cart-text">&nbsp; Cart </span></a><a href="{!! url('shopping-cart') !!}"  class="top-cart-counter-link"> <span id="cartItems" class="top-cart-counter">{{ $cart_count }}</span></a></span>
            </div> <!--topnav right -->
        </div> <!--containter alrger  -->
    </div> <!--topnav -->
    <div class="site-header uk-text-center full-width uk-width-1-1" data-uk-sticky="{top:-89}">
        <div class="container-large">
            <a class="site-logo" href="{!!url('/')!!}">
                  <b class="srt">{!! HTML::image(url('_front/assets/images/logo.png'), 'Clarkin Collections', array('class' => 'site-img','width'=>'542', 'height'=>'57')) !!}</b>
            </a>

            @include("layouts._front.menunav")
        </div>
    </div>

</header>
<span class="stickyscrollup uk-hidden" data-uk-sticky="{top: 0, animation: 'uk-animation-slide-top', media: 20}"><a href="#container" data-uk-smooth-scroll><i class="uk-icon-angle-up ionicons ion-ios-arrow-up "></i></a></span>
{!! Html::style('_front/assets/css/Pe-icon-7-stroke.css') !!}
{!! Html::script('_front/plugins/uikit/js/components/sticky.min.js', array('async' => 'defer')) !!}
{!! Html::script('_front/plugins/uikit/js/core/smooth-scroll.min.js', array('async' => 'defer')) !!}
{!! Html::script('_front/assets/js/pages.js', array('async' => 'defer')) !!}
