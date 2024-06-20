@extends('layouts._front.template-1')

@section('content')
    <?php $login_type_text = 'Shop Owner'; ?>
	 <div class="uk-width-1-1">
             <div class="uk-container uk-container-center ">
                <article id="main" role="main"  class="uk-block uk-text-contrast">
                    <div class="uk-grid">
                        <div class=" uk-width-large-7-10 uk-width-medium-1-1 uk-width-1-1">
                            <h1 class="uk-h2 text-uppercase uk-text-contrast">{!! $login_type_text . ' '.$pages->fldPagesName !!}</h1>
                            {!! $pages->fldPagesDescription !!}
                            <div id="billingError" style="display:none;" class="uk-text-danger">Fields mark with * are required</div>
                             @if(Session::has('success'))
                                    <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
                            @endif
                             @if(Session::has('error'))
                                    <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
                            @endif
                            {!! Form::open(array('url' => '/shop-owner-registration', 'method' => 'post',   'class' => 'row-fluid input-100 bill-info','id'=>'shop-owner-registration_form', 'onSubmit'=>'return validateMeForm()')); !!}
                             <div class="uk-grid">
                                <div class = "uk-width-large-1-2  uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('firstname', '* First Name'); !!}
                                    {!! Form::text('firstname',"",array('id'=>'firstname','required','class'=>'form-control')) !!}
                                    @if($errors->shop->first('firstname'))
                                            <div class="uk-text-danger">{!!$errors->shop->first('firstname')!!}</div>
                                    @endif
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('lastname', '* Last Name'); !!}
                                    {!! Form::text('lastname', "",array('id'=>'lastname','required','class'=>'form-control')) !!}
                                    @if($errors->shop->first('lastname'))
                                            <div class="uk-text-danger">{!!$errors->shop->first('lastname')!!}</div>
                                    @endif
                                </div >

                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('business_name', 'Business Name'); !!}
                                    {!! Form::text('business_name', "",array('id'=>'business_name','required','class'=>'form-control')) !!}
                                    @if($errors->shop->first('business_name'))
                                            <div class="uk-text-danger">{!!$errors->shop->first('business_name')!!}</div>
                                    @endif
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">&nbsp;</div >

                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('email', '* Email Address'); !!}
                                    {!! Form::email('email',"",array('id'=>'email','required','class'=>'form-control')) !!}
                                    @if($errors->shop->first('email'))
                                            <div class="uk-text-danger">{!!$errors->shop->first('email')!!}</div>
                                    @endif
                                </div >

                                <div class = "uk-width-large-1-2 uk-width-small-1-2  uk-margin-top" >
                                    {!! Form::label('phone', '* Phone Number'); !!}
                                    {!! Form::text('phone',"",array('id'=>'phone','required','class'=>'form-control phone_us')) !!}
                                    @if($errors->shop->first('phone'))
                                            <div class="uk-text-danger">{!!$errors->shop->first('phone')!!}</div>
                                    @endif
                                </div >

                                <div class = "uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-1 text-wrapper uk-margin-top" >
                                    {!! Form::label('password', '* Password',array( )); !!}
                                    {!! Form::password('password',array('id'=>'password','required', 'class' => 'form-width-large password-fld')) !!}
                                    <table border=0>
                                        <tr>
                                            <td style="padding-right:5px;" class="uk-text-small minsize"> <i class="uk-icon uk-icon-check-circle icon-color" id="passveryweak"></i> at least 8 char</td>
                                            <td style="padding-right:5px;" class="uk-text-small capital"> <i class="uk-icon uk-icon-check-circle icon-color" id="passweak"></i> an uppercase</td>
                                            <td style="padding-right:5px;" class="uk-text-small number"> <i class="uk-icon uk-icon-check-circle icon-color" id="passmedium"></i> a number</td>
                                            <td style="padding-right:5px;" class="uk-text-small special"> <i class="uk-icon uk-icon-check-circle icon-color" id="passstrong"></i> special char</td>
                                        </tr>
                                    </table>
                                     @if($errors->shop->first('password'))
                                            <div class="uk-text-danger">{!!$errors->shop->first('password')!!}</div>
                                    @endif
                                </div >

                                 <div class = "uk-width-large-1-2 uk-width-small-1-2  uk-margin-top" >
                                    {!! Form::label('password_confirmation', '* Retype Password'); !!}
                                    {!! Form::password('password_confirmation',array('id'=>'password_confirmation','required', 'class' => 'form-width-large password-fld')) !!}

                                    @if($errors->shop->first('password_confirmation'))
                                            <div class="uk-text-danger">{!!$errors->shop->first('password_confirmation')!!}</div>
                                    @endif

                                </div>
                                <div class = "uk-width-large-1-2 uk-width-small-1-2  uk-margin-top" >
                                    {!! Form::label('invite_code', '* Invite Code'); !!}
                                    {!! Form::text('invite_code','',array('id'=>'invite_code','required','class'=>'form-control')) !!}
                                    @if($errors->shop->first('invite_code'))
                                            <div class="uk-text-danger">{!!$errors->shop->first('invite_code')!!}</div>
                                    @endif
                                </div >

                                <div class = "uk-width-1-1 uk-margin-large-top">
                                  <div class="uk-text-success pos-rel uk-width-1-1 full-width please-wait uk-hidden ">Please Wait...</div>
                                 <input type="hidden" name="client_type" value="2">
                                 {!! Form::submit('Register',array('name'=>'register','class'=>'uk-button uk-button-primary uk-display-inline-block widauto'))!!}
                                </div>

                            </div><!--row -->
                            {!! Form::close() !!}
                        </div><!--uk 6 -10 -->
                        <div class=" uk-width-large-3-10 uk-width-medium-1-2   uk-width-1-1 uk-margin-large-top">
                            <div class="box-bordered padding-medium ">
                                <h4>Registered {!!$login_type_text!!}</h4>  
                                {!!$pages->fldPagesDescription!!}
                                 {!! Html::link('shop-owner-login', "Login",array('class'=>'uk-button uk-button-primary')) !!}
                            </div>
                        </div>

                    </div><!--ukgrid -->
                </div><!--main -->
            </div><!--ukcomtainer -->
        </div><!--wid11 -->

@stop


@section('headercodes')
     {!! Html::style('_front/plugins/password/strength.css') !!}
@stop
@section('extracodes')

    {!! Html::script('_front/assets/js/mask.js') !!}
    {!! Html::script('_front/plugins/password/strength.js') !!}

    <script>

    var form_id = 'shop-owner-registration_form'; var isphone_valid = 0;
    function validateMeForm(){

    var requireds_flds_empty = 0;
    $('form#'+form_id).find('.required').each(function(event){
        console.log($(this).id);
        if($.trim($(this).val()) == ''){
            $(this).css({'border':'1px solid red'});
            requireds_flds_empty = 1;
            return false;
        }
    });



    var isvalid = 0;  var first_password ; var pwd_confirm ;

        first_password = $('#'+form_id+' #password').val();
        pwd_confirm = $('#'+form_id+' #password_confirmation').val();
        $('form#'+form_id+' .password-errors').each(function(){
            $(this).html(""); $(this).removeClass('uk-hidden');
        });

        if(($.trim(first_password) == '') || ($.trim(pwd_confirm) == '')){

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
        } else{
            if($('#'+form_id+' .strength_meter [data-meter]').hasClass('pw-strong')){
                isvalid = true;
                if(first_password == pwd_confirm){
                    isvalid = true;
                }else{
                    $('form#'+form_id+' .password-confirm-errors').html("Passwords do not match.");
                    $('form#'+form_id+' .password-errors').removeClass('uk-hidden');
                    isvalid = false;
                }
            }else{ isvalid = false;
                $('form#'+form_id+' .password-fld-errors').html("Password Weak.");
                $('form#'+form_id+' .password-errors').removeClass('uk-hidden'); }

        }


    if(isvalid == false){
        requireds_flds_empty = 1;
    }

  @if(isset($errors))
  @else
    if(isphone_valid == 0){
        requireds_flds_empty = 1;
         $('form#'+form_id+' .mask-error').html("Phone Invalid");
         $('form#'+form_id+' .mask-error').removeClass('uk-hidden');
                $('.phone_us').css({'border':'1px solid red'});
         return false;
    }else{
         $('form#'+form_id+' .mask-error').html("");
         $('form#'+form_id+' .mask-error').addClass('uk-hidden');
                $('.phone_us').css({'border':'1px solid green'});
    }
 @endif

    if(requireds_flds_empty){
        return false;
    }else{
        $('form#'+form_id+' .please-wait').removeClass('uk-hidden');
        $('form#'+form_id).find('.required').each(function(event){
            if($.trim($(this).val()) != ''){
                $(this).css({'border':'1px solid green'});
            }
        });
        $('form#'+form_id).submit();
        return false;
    }

}

      $(document).ready(function($) {

            isphone_valid = 0;
            $('.phone_us').mask('(000) 000-0000',{
              onComplete: function(cep) {
                $('.phone_us').css({'border':'1px solid green'});
                isphone_valid = 1;
              }, onInvalid: function(cep) {
                $('.phone_us').css({'border':'1px solid red'});
                isphone_valid = 0;
              }
            });
          $('#password').strength({
              strengthClass: 'strength required',
              strengthMeterClass: 'strength_meter',
              strengthButtonClass: 'button_strength',
              strengthButtonText: 'Show Password',
              strengthButtonTextToggle: 'Hide Password'
          });


      });


    </script>

@stop