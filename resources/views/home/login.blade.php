<?php session_start(); ?>
@extends('layouts._front.new_collection.layouts.app')
    
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
                                    @if(!empty($pages->fldPagesDescription))
                                        {!!$pages->fldPagesDescription!!}
                                    @else
                                        <h2>
                                            <span>Welcome to</span>
                                            Clarkin Collection
                                        </h2>
                                    @endif

                                    @if(Session::has('reset-success'))
                                        <div class="text-success"><strong>Success: </strong>Your password has been reset. You can now use your new password to login.</div>
                                    @endif

                                    @if(Session::has('error'))
                                        <div class="text-danger">{!!Session::get('error')!!}</div>
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