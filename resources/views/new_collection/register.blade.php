@extends('new_collection.layouts.app')

@section('content')
        <div class="main-part">
            <section class="login-register-part">
                <div class="container">
                    <div class="login-register-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                <div class="login-register-left">
                                    <img src="{{ asset('_new_collection/assets/images/Illustration.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                <div class="login-register-right">
                                    <h2>
                                        <span>Welcome to</span>
                                        Clarkin Collection
                                    </h2>
                                    <div class="social-link">
                                        <a href="#"><img src="{{ asset('_new_collection/assets/images/google.png') }}" alt="">Login with Google</a>
                                        <a href="#"><img src="{{ asset('_new_collection/assets/images/facebook.png') }}" alt="">Login with Facebook</a>
                                    </div>
                                    <div class="or-condition">
                                        <span>OR</span>
                                    </div>
                                    <form class="form" method="post" name="form">
                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/user.png') }}" alt="">
                                            <label class="float-lbl">Full name</label>
                                            <input type="email" name="email" placeholder="John Doe">
                                        </div>
                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/mail-line.png') }}" alt="">
                                            <label class="float-lbl">Email</label>
                                            <input type="email" name="email" placeholder="abc@domain.com">
                                        </div>
                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/lock.png') }}" alt="">
                                            <label class="float-lbl">Password</label>
                                            <input type="password" name="password" placeholder="***********">
                                            <a href="#" class="show-pass"><img src="{{ asset('_new_collection/assets/images/eye.png') }}" alt=""></a>
                                        </div>
                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/lock.png') }}" alt="">
                                            <label class="float-lbl">Confirm password</label>
                                            <input type="password" name="password" placeholder="***********">
                                            <a href="#" class="show-pass"><img src="{{ asset('_new_collection/assets/images/eye.png') }}" alt=""></a>
                                        </div>
                                        <div class="form-field">
                                            <button class="theme-btn">REGISTER</button>
                                        </div>
                                        <p>Already have an account? <a href="#">Login</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection