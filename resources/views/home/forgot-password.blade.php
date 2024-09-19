@extends('layouts._front.new_collection.layouts.app')

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
                                    <h2 class="mb-4" >Forgot Password</h2>
                                    @if(Session::has('forgot-success'))
                                        <div class="uk-alert full-width uk-alert-success mb-3">Your password reset link has been sent to your email on file. Please check your inbox for this email. If you do not receive it please make sure to check your Spam or Junk folders.</div>
                                    @endif

                                    @if(Session::has('error-forgot'))
                                        <div id="forgotPass">
                                        <div class="uk-alert  full-width  uk-alert-danger mb-3"><strong>Error!</strong> {!!Session::get('error-forgot')!!}</div>
                                    @else
                                        <div id="forgotPass" class="uk-hidden">
                                    @endif

                                    {!! Form::open(array('url' => '/forgot-password', 'method' => 'post',  'class' => 'account-login input-100')) !!}
                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/mail-line.png') }}" alt="">
                                            <label class="float-lbl">Email</label>
                                            <input type="email" name="email" id="username" placeholder="abc@domain.com" required>
                                        </div>                                                                                
                                        <div class="form-field">
                                            <button type="submit" name="login" class="theme-btn">Forgot Password</button>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection