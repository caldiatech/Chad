<?php session_start(); ?>
@extends('layouts._front.new_collection.layouts.app')
    <style type="text/css">
        .g-recaptcha {
    display: block !important;
    visibility: visible !important;
    height: auto !important;
    width: auto !important;
}
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

@section('content')
       <div class="main-part">
            <section class="login-register-part">
                <div class="container">
                    <div class="login-register-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                <div class="login-register-left">
                                    <?php
                                        $bgloginregister_style = '';

                                        if(!empty($pages->fldPagesImage) && $pages->fldPagesImage != ''){
                                        $bgloginregister_style = url('uploads/pages/'.$pages->fldPagesImage);
                                        }
                                    ?>
                                    <img src="{{ asset('_new_collection/assets/images/Illustration.png') }}" alt="">
                                    {{-- <img src="{{$bgloginregister_style}}" alt=""> --}}
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                <div class="login-register-right">
                                    <h2>
                                        <span>Welcome to</span>
                                        Clarkin Collection
                                    </h2>
                                    {{--@if(!empty($pages->fldPagesDescription))
                                        {!!$pages->fldPagesDescription!!}
                                    @endif--}}

                                    @if(Session::has('reset-success'))
                                        <div class="text-success"><strong>Success: </strong>Your password has been reset. You can now use your new password to login.</div>
                                    @endif

                                    @if(Session::has('error'))
                                        <div class="text-danger">{!!Session::get('error')!!}</div>
                                    @endif

                                    @if(Session::has('forgot-success'))
                                        <div class="text-success"><strong>Success: </strong>Your reset password link has been send in mail.</div>
                                    @endif
                                    @if ($errors->has('captcha'))
    <div class="alert alert-danger">
        {{ $errors->first('captcha') }}
    </div>
@endif
                                    {{--<div class="social-link">
                                        <a href="#"><img src="{{ asset('_new_collection/assets/images/google.png') }}" alt="">Login with Google</a>
                                        <a href="#"><img src="{{ asset('_new_collection/assets/images/facebook.png') }}" alt="">Login with Facebook</a>
                                    </div>
                                    <div class="or-condition">
                                        <span>OR</span>
                                    </div>--}}                                   
                                    <div class="my-4">
                                        {!! Form::open(array('url' => '/login', 'method' => 'post',  'class' => 'row-fluid account-login input-100')) !!}
                                            <div class="form-field">
                                                <img class="form-icon" src="{{ asset('_new_collection/assets/images/mail-line.png') }}" alt="">
                                                <label class="float-lbl">Email *</label>
                                                <input type="email" name="email" placeholder="abc@domain.com" required>
                                            </div>
                                            <div class="form-field">
                                                <img class="form-icon" src="{{ asset('_new_collection/assets/images/lock.png') }}" alt="">
                                                <label class="float-lbl">Password *</label>
                                                <input type="password" name="password" placeholder="***********" required>
                                                <!-- <a href="#" class="show-pass"><img src="{{ asset('_new_collection/assets/images/eye.png') }}" alt=""></a> -->
                                            </div>
                                                    <div class="g-recaptcha" data-sitekey="6LdB66MqAAAAAEJaIIxgEzYBFJ8aVL3ghIiO_U2v"></div>

                                            <div class="form-field form-field-flex">
                                                <!-- <div class="check-group">
                                                    <label class="lbl-check">Remember me
                                                        <input type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div> -->
                                                <div class="forgot-pass">
                                                    <a href="{{ url('/forgot-password')}}">Forgot Password?</a>
                                                </div>
                                            </div>
                                            <div class="form-field">
                                                <button type="submit" name="login" class="theme-btn">LOGIN</button>
                                            </div>
                                            <p>
                                                Don’t have an account? 
                                                <a href="{{ url('/registration') }}">Register</a>
                                            </p>
                                            @if($cart_count > 0)
                                                <p>
                                                    {!! Html::link('guest-checkout', "Checkout as Guest",array('class'=>'uk-button uk-button-primary')) !!}
                                                </p>  
                                            @endif                                                                       
                                        {!! Form::close() !!}
                                    </div>
                                </div>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection
    <script src="{{ asset('_new_collection/assets/js/jquery-3.5.1.slim.min.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function () {
        $('#login-form').on('submit', function (e) {
            e.preventDefault(); // Prevent form submission

            var recaptchaResponse = grecaptcha.getResponse();

            if (recaptchaResponse.length === 0) {
                alert("Please complete the reCAPTCHA.");
                return false; // Stop the form submission
            }

            // If reCAPTCHA is completed, proceed with the form submission
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize() + '&g-recaptcha-response=' + recaptchaResponse,
                success: function (response) {
                    // Handle successful login
                    console.log(response);
                },
                error: function (xhr) {
                    // Handle validation or server error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>