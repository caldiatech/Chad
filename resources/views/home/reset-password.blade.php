<?php session_start(); ?>
@extends('layouts._front.new_collection.layouts.resetpasswordapp')
    
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
                                    @endif
                                    <h2>New Password</h2>                                    

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
                                        {!! Form::open(array('url' => '/new-password', 'method' => 'post',  'class' => 'row-fluid account-login input-100')) !!}
                                            <div class="form-field text-wrapper">
                                                <img class="form-icon" src="{{ asset('_new_collection/assets/images/lock.png') }}" alt="">                                             
                                                {!! Form::label('password', 'Password *',array('class'=>'float-lbl')) !!}                                                
                                                {!! Form::password('password',array('id'=>'password','required'=>'required','class'=>'form-control password-fld', 'placeholder'=>'***********')) !!}
                                                <!-- <div id="passwordError" class="uk-hidden mt-2 text-danger"></div>   -->
                                                <!-- <div class="text-danger password-errors password-fld-errors  uk-hidden"></div> -->
                                                <table border=0>
                                                    <tr class="border-0">
                                                        <td style="padding-right:5px;" class="uk-text-small minsize"> <img src="{{ asset('_new_collection/assets/images/checkicon.png') }}" alt="" id="passveryweak"><span> at least 8 char</span></td>
                                                        <td style="padding-right:5px;" class="uk-text-small capital"> <img src="{{ asset('_new_collection/assets/images/checkicon.png') }}" alt="" id="passweak"> <span> an uppercase</span></td>
                                                        <td style="padding-right:5px;" class="uk-text-small number"> <img src="{{ asset('_new_collection/assets/images/checkicon.png') }}" alt="" id="passmedium"><span> a number</span></td>
                                                        <td style="padding-right:5px;" class="uk-text-small special"> <img src="{{ asset('_new_collection/assets/images/checkicon.png') }}" alt="" id="passstrong"><span> special char</span></td>
                                                    </tr>
                                                </table>
                                                @if ($errors->resetpassword->first('password'))
                                                    <div class="text-danger">
                                                        {{ $errors->resetpassword->first('password') }}
                                                    </div>
                                                @endif
                                            </div>                                  
                                            <div class="form-field">
                                                <img class="form-icon" src="{{ asset('_new_collection/assets/images/lock.png') }}" alt="">                                                
                                                {!! Form::label('password_confirmation', 'Confirm Password *',array('class'=>'float-lbl')) !!}                                                
                                                {!! Form::password('password_confirmation',array('id'=>'password_confirmation','required','class'=>'form-control password-confirm-fld', 'placeholder'=>'***********')) !!}                                                                                            
                                                @if ($errors->resetpassword->first('password_confirmation'))
                                                    <div class="text-danger">
                                                        {{ $errors->resetpassword->first('password_confirmation') }}
                                                    </div>
                                                @endif
                                            </div>                                           
                                            <div class="form-field form-field-flex">
                                                <input type="hidden" name="client_id" value="{{ $clients->fldClientID }}">
                                                <input type="hidden" name="hash" value="{{ $clients->fldClientHashSecurity }}">
                                                {!! Form::submit('Submit',array('name'=>'submit','class'=>'theme-btn'))!!}
                                            </div> 
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

@section('headercodes')  
   <style>
        .strength_meter{
            margin-top: 7px;
            height: 23px;
            width: 197px;
            /* background: silver; */
        
        }

        .strength_meter div{
            height: 23px;
            width: 100%;
            height: auto;
            color: black;
            font-weight: 500;
            line-height: 23px;
            margin-top: 15px;
        }

        .pw-veryweak p span{
            color: red;
        border-color: #F04040!important
        }

        .pw-weak p span{
        color: orange;
        border-color: #FF853C!important;
        }

        .pw-medium p span{
        color: aquamarine;
        border-color: #FC0!important;
        }

        .pw-strong p span{
        color: green;
        border-color: #8DFF1C!important;
        }
   </style>
@stop
@section('extracodes')

    {!! Html::script('_front/assets/js/jquery.min.js') !!}
    <script src="{{ asset('_new_collection/assets/js/strength.js') }}" type="text/javascript"></script>

    <script>
      $(document).ready(function($) {

          $('#password').strength({
              strengthClass: 'strength',
              strengthMeterClass: 'strength_meter',
              strengthButtonClass: 'button_strength',
              strengthButtonText: 'Show Password',
              strengthButtonTextToggle: 'Hide Password'
          });


      });
      
      //password Strength
    //   document.addEventListener('DOMContentLoaded', function () {
    //         const passwordInput = document.getElementById('password');
    //         const passwordError = document.getElementById('passwordError');

    //         passwordInput.addEventListener('input', function () {
    //             const password = passwordInput.value;
    //             const minLength = password.length >= 8;
    //             const hasUppercase = /[A-Z]/.test(password);
    //             const hasNumber = /\d/.test(password);
    //             const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    //             if (minLength && hasUppercase && hasNumber && hasSpecialChar) {
    //                 passwordError.classList.add('uk-hidden');
    //                 passwordError.textContent = '';
    //             } else {
    //                 passwordError.classList.remove('uk-hidden');
    //                 passwordError.textContent = 'Password must be at least 8 characters long, contain an uppercase letter, a number, and a special character.';
    //             }
    //         });
    //     });

    </script>
@stop