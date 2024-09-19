    <div class="footer-part" style="background: url('{{ asset('_new_collection/assets/images/footer-bg.png') }}') no-repeat center center; background-size:cover;">
        <div class="container">
            <div class="footer-inner">
                <a href="{!!url('/')!!}"><img src="{{ asset('_new_collection/assets/images/logo-clarkin.png') }}" alt=""></a>
                <ul>
                    {{-- <li><a href="{{ route('newAboutPage') }}">About</a></li> --}}
                    <li><a href="{{ url('/about') }}">About</a></li>
                    {{-- <li><a href="{{ route('newCollectionPage') }}">Collection</a></li> --}}
                    <li><a href="{{ url('/collection') }}">Collection</a></li>
                    {{-- <li><a href="{{ route('privacyPolicyPage') }}">Privacy Policy</a></li> --}}
                    <li><a href="{{ url('/privacy-policy')}}">Privacy Policy</a></li>
                    {{-- <li><a href="{{ route('newShippingPage') }}">Shipping</a></li> --}}
                    <li><a href="{{ url('/shipping-page') }}">Shipping</a></li>
                    {{-- <li><a href="{{ route('termsUsePage') }}">Terms of Use</a></li> --}}
                    <li><a href="{{ url('/terms-and-conditions') }}">Terms of Use</a></li>                        
                    {{-- li><a href="{{ route('contactPage') }}">Contact Us</a></li> --}}
                    <li><a href="{{ url('/connect') }}">Connect</a></li>
                </ul>
                <span>copyright @2024 Clarkin</span>
            </div>
        </div>
    </div>