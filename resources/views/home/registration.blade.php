@extends('layouts._front.new_collection.layouts.app')

@section('content')
    <?php $login_type_text = 'Customer'; ?>
    <div class="main-part">
        <section class="login-register-part">
            <div class="container">
                <div class="login-register-inner">
                    <div class="row">
                        <!-- Image Section -->
                        <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                            <div class="login-register-left">
                                <img src="{{ asset('_new_collection/assets/images/Illustration.png') }}" alt="">
                            </div>
                        </div>

                        <!-- Registration Form Section -->
                        <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                            <div class="login-register-right">
                                <h2><span>Welcome to</span> Clarkin Collection</h2>

                                <!-- Social Login Links -->
                                {{-- <div class="social-link">
                                    <a href="#"><img src="{{ asset('_new_collection/assets/images/google.png') }}" alt="">Login with Google</a>
                                    <a href="#"><img src="{{ asset('_new_collection/assets/images/facebook.png') }}" alt="">Login with Facebook</a>
                                </div>

                                <div class="or-condition">
                                    <span>OR</span>
                                </div> --}}
                                @if(Session::has('error'))
                                    <div class="text-danger">{{ Session::get('error') }}</div>
                                @endif
                                <!-- Registration Form -->
                                <div class="my-4">
                                    {!! Form::open(['url' => '/registration', 'method' => 'post', 'class' => 'form', 'id' => 'registration_form', 'onSubmit' => 'return validateMeForm()']) !!}
                                        <!-- Name Field -->
                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/user.png') }}" alt="">
                                            {!! Form::label('firstname', 'First Name *', ['class' => 'float-lbl']) !!}
                                            {!! Form::text('firstname', '', ['id' => 'firstname', 'required', 'class' => 'form-control char-only', 'placeholder' => 'John']) !!}
                                        </div>

                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/user.png') }}" alt="">
                                            {!! Form::label('lastname', 'Last Name *', ['class' => 'float-lbl']) !!}
                                            {!! Form::text('lastname', '', ['id' => 'lastname', 'required', 'class' => 'form-control char-only', 'placeholder' => 'Doe']) !!}
                                        </div>

                                        <!-- Email Field -->
                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/mail-line.png') }}" alt="">
                                            {!! Form::label('email', 'Email *', ['class' => 'float-lbl']) !!}
                                            {!! Form::email('email', '', ['id' => 'email', 'required', 'class' => 'form-control', 'placeholder' => 'abc@domain.com']) !!}
                                        </div>

                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/phone.png') }}" alt="" style="width : 24px;">
                                            {!! Form::label('phone', 'Phone Number *', ['class' => 'float-lbl']) !!}
                                            {!! Form::text('phone', '', ['id' => 'phone', 'required', 'class' => 'form-control char-only phone_us', 'placeholder' => '(123) 456-7891']) !!}                                       
                                        </div>

                                        <!-- Password Field -->
                                        <div class="form-field text-wrapper">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/lock.png') }}" alt="">
                                            {!! Form::label('password', 'Password *', ['class' => 'float-lbl']) !!}
                                            {!! Form::password('password', ['id' => 'password', 'required' => 'required', 'class' => 'form-control password-fld', 'placeholder' => '***********']) !!}
                                            <!-- <a href="#" class="show-pass"><img src="{{ asset('_new_collection/assets/images/eye.png') }}" alt=""></a> -->
                                            <table border=0>
                                                <tr class="border-0">
                                                    <td style="padding-right:5px;" class="uk-text-small minsize"> <img src="{{ asset('_new_collection/assets/images/checkicon.png') }}" alt="" id="passveryweak"><span> at least 8 char</span></td>
                                                    <td style="padding-right:5px;" class="uk-text-small capital"> <img src="{{ asset('_new_collection/assets/images/checkicon.png') }}" alt="" id="passweak"> <span> an uppercase</span></td>
                                                    <td style="padding-right:5px;" class="uk-text-small number"> <img src="{{ asset('_new_collection/assets/images/checkicon.png') }}" alt="" id="passmedium"><span> a number</span></td>
                                                    <td style="padding-right:5px;" class="uk-text-small special"> <img src="{{ asset('_new_collection/assets/images/checkicon.png') }}" alt="" id="passstrong"><span> special char</span></td>
                                                </tr>
                                            </table>
                                                <!-- <div id="passwordError" class="uk-hidden mt-2 text-danger"></div>                                                                                  -->
                                                <div class="text-danger password-errors password-fld-errors uk-hidden"></div>
                                        </div>

                                        <!-- Password Confirmation Field -->
                                        <div class="form-field">
                                            <img class="form-icon" src="{{ asset('_new_collection/assets/images/lock.png') }}" alt="">
                                            {!! Form::label('password_confirmation', 'Confirm Password *', ['class' => 'float-lbl']) !!}
                                            {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'required' => 'required', 'class' => 'form-control password-confirm-fld', 'placeholder' => '***********']) !!}
                                            <!-- <a href="#" class="show-pass"><img src="{{ asset('_new_collection/assets/images/eye.png') }}" alt=""></a> -->                                        
                                            <div class="text-danger password-confirm-errors password-errors  uk-hidden"></div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-field">
                                            <button class="theme-btn" name='register' type="submit">REGISTER</button>
                                           
                                        </div>

                                        <p>Already have an account? <a href="{{ url('login') }}">Login</a></p>
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
    {!! Html::script('_front/assets/js/mask.js') !!}
    {{--{!! Html::script('_front/plugins/password/strength.js') !!}--}}
    <script src="{{ asset('_new_collection/assets/js/strength.js') }}" type="text/javascript"></script>
    <script>
        var form_id = 'registration_form'; 
        // var isphone_valid = 0;

        function validateMeForm() {
            var requireds_flds_empty = 0;
            // Validate fields
            $('form#'+form_id).find('.required').each(function(event) {
                if ($.trim($(this).val()) == '') {
                    $(this).css({'border':'1px solid red'});
                    requireds_flds_empty = 1;
                    return false;
                }
            });

            var isvalid = 0;
            var first_password = $('#'+form_id+' #password').val();
            var pwd_confirm = $('#'+form_id+' #password_confirmation').val();

            $('form#'+form_id+' .password-errors').each(function(){
                $(this).html(""); $(this).removeClass('uk-hidden');
            });

            if (($.trim(first_password) == '') || ($.trim(pwd_confirm) == '')) {
                // Password validation error

                if($.trim(first_password) == ''){
                    $('form#'+form_id+' .password-fld-errors').html("Please Type Password.");
                }
                if($.trim(pwd_confirm) == ''){
                    $('form#'+form_id+' .password-confirm-errors').html("Please ReType Password.");
                }

                $('form#'+form_id+' .password-errors').each(function(){
                    $(this).removeClass('uk-hidden');
                });

                isvalid = false;
                return false;
            } else if ($('#'+form_id+' .strength_meter [data-meter]').hasClass('pw-strong')) {
                if (first_password == pwd_confirm) {
                    isvalid = true;
                } else {
                    isvalid = false;
                    $('.password-confirm-errors').html("Passwords do not match.");
                }
            } else {
                isvalid = false;
                $('.password-fld-errors').html("Password Weak.");
            }

            if(isvalid == false){
                requireds_flds_empty = 1;
            }

            if (requireds_flds_empty) {
                return false;

            } else {
                $('.please-wait').removeClass('uk-hidden');
                $('form#'+form_id).submit();
            }
        }

        $(document).ready(function($) {
            // Phone validation
            $('.phone_us').mask('(000) 000-0000', {
                onComplete: function(cep) {
                    isphone_valid = 1;
                }, 
                onInvalid: function(cep) {
                    isphone_valid = 0;
                }
            });

            // Password strength meter
            $('#password').strength({
                strengthClass: 'strength',
                strengthMeterClass: 'strength_meter',
                strengthButtonClass: 'button_strength',
                strengthButtonText: 'Show Password',
                strengthButtonTextToggle: 'Hide Password'
            });
        });
    </script>
@endsection
