<header>
    <!-- PRE-ACTIVATED FOR RESPONSIVE LAYOUT -->  
    <div class="topnav">
        <div class="container-large">
            <div class="top-nav-right uk-float-right">
                <span class="toplink-account">
                    @if(Session::has('client_id'))  
                        <span> <a href="{!! url('dashboard/customer') !!}"> My Account <i class="uk-icon-caret-down"></i></a></span>
                    @else
                        <span class="login"> <a href="{!! url('login') !!}"> Log In <i class="uk-icon-user"></i></a></span>     
                    @endif
                </span><!--toplink-account -->
                <span><a href="{!! url('shopping-cart') !!}" ><i class="uk-icon-shopping-cart" id="shopping-cart"></i> <span class="cart-text">Cart</span></a><a href="{!! url('shopping-cart') !!}"  class="top-cart-counter-link"> <span id="cartItems" class="top-cart-counter">{{ $cart_count }}</span></a></span>
            </div> <!--topnav right -->  
    </div> <!--containter alrger  -->
    </div> <!--topnav -->   
    <div class="site-header uk-text-center full-width">
    <div class="container-large">   
        <a class="site-logo" href="{!!url()!!}">
              <b class="srt">{!! HTML::image(url('_front/assets/images/logo.png'), 'Clarkin Collections', array('class' => 'site-img','width'=>'542', 'height'=>'57')) !!}</b>
        </a>

        @include("layouts._front.menunav")
    </div>
</div>

</header>
