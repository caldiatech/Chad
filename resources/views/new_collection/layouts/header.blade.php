        <div class="header-part">
            <div class="header-top">
                <div class="container">
                    <div class="header-top-inner">
                        <ul>
                            <li><a href="#"><img src="{{ asset('_new_collection/assets/images/instagram.svg') }}" alt="">clarkinphotography</a></li>
                            <li><a href="{{ route('newLoginPage')}}"><img src="{{ asset('_new_collection/assets/images/user.svg') }}" alt="">login</a></li>
                            <li><a href="#"><img src="{{ asset('_new_collection/assets/images/bag.svg') }}" alt="">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <div class="header-bottom-inner">
                        <div class="logo">
                            <img src="{{ asset('_new_collection/assets/images/logo.png') }}" alt="">
                        </div>
                        <div class="humbarger-menu humbarger-menu-on">
                            <div class="burger burger-squeeze"><div class="burger-lines"></div></div>
                        </div>
                        <div class="main-menu">
                            <ul>
                                {{-- <li><a href="{{ route('featuredPage')}}">Featured Images</a></li>
                                <li><a href="{{ route('newAboutPage')}}">About</a></li>
                                <li><a href="{{ route('newCollectionPage')}}">Collection</a></li>
                                <li><a href="{{ route('contactPage')}}">Connect</a></li> --}}
                                <li><a href="{{ url('/featured-images')}}">Featured Images</a></li>
                                <li><a href="{{ url('/about')}}">About</a></li>
                                <li><a href="{{ url('/collection')}}">Collection</a></li>
                                <li><a href="{{ route('contactPage')}}">Connect</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="header-part">
    <div class="header-top">
        <div class="container">
            <div class="header-top-inner">
                <ul>
                    <li><a href="https://instagram.com/clarkinphotography">
                        <img src="{{ asset('_new_collection/assets/images/instagram.svg') }}" alt="">clarkinphotography</a>
                    </li>
                    <li>
                        @if(Session::has('client_id'))
                            <a href="{{ url('dashboard/customer') }}">
                                <img src="{{ asset('_new_collection/assets/images/user.svg') }}" alt="">My Account
                            </a>
                        @elseif(Session::has('manager_id'))
                            <a href="{{ url('dashboard/sales') }}">
                                <img src="{{ asset('_new_collection/assets/images/user.svg') }}" alt="">My Account
                            </a>
                        @elseif(Session::has('shop_owner_id'))
                            <a href="{{ url('dashboard/shop-owner') }}">
                                <img src="{{ asset('_new_collection/assets/images/user.svg') }}" alt="">My Account
                            </a>
                        @else
                            <a href="{{ url('login') }}">
                                <img src="{{ asset('_new_collection/assets/images/user.svg') }}" alt="">Login
                            </a>
                        @endif
                    </li>
                    <li>
                        <a href="{{ url('shopping-cart') }}">
                            <img src="{{ asset('_new_collection/assets/images/bag.svg') }}" alt="">Cart
                        </a>
                        <span class="top-cart-counter">{{ $cart_count }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header-bottom-inner">
                <div class="logo">
                    <img src="{{ asset('_new_collection/assets/images/logo.png') }}" alt="Clarkin Collections">
                </div>
                <div class="humbarger-menu humbarger-menu-on">
                    <div class="burger burger-squeeze"><div class="burger-lines"></div></div>
                </div>
                <div class="main-menu">
                    <ul>
                        <li><a href="{{ route('featuredPage')}}">Featured Images</a></li>
                        <li><a href="{{ route('newAboutPage')}}">About</a></li>
                        <li><a href="{{ route('newCollectionPage')}}">Collection</a></li>
                        <li><a href="#">Connect</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
--}}