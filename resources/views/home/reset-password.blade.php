@extends('layouts._front.template-1')

@section('content')

  <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top">
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">

                        <div class="uk-width-medium-5-10 uk-width-1-1 uk-margin-top">
                            <div class="box-bordered padding-medium ">
                                <h4>New Password</h4>
                                {!! (isset($pages->fldPagesDescription)) ? $pages->fldPagesDescription: '' !!}
                                 @if(Session::has('error'))
                                    <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
                                 @endif
                                 {!! Form::open(array('url' => '/new-password', 'method' => 'post',  'class' => 'row-fluid account-login input-100')) !!}
                                <div class="formbox">
                                    <div class="uk-padding-small-top uk-grid uk-margin-remove">
                                        <div class="uk-width-1-1  line-height-text  uk-width-1-1 uk-padding-remove ">
                                         {!! Form::label('password', '* Password',array('style'=>'width:75px')); !!}
                                        </div>
                                        <div class="uk-width-1-1 uk-padding-remove">
                                        {!! Form::password('password','',array('id'=>'password','required')) !!}
                                        <table>
                                            <tr>
                                                <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passveryweak"></i> at least 8 char</td>
                                                <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passweak"></i> an uppercase</td>
                                                <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passmedium"></i> a number</td>
                                                <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passstrong"></i> special char</td>
                                            </tr>
                                        </table>
                                        @if($errors->resetpassword->first('password'))
                                            <div class="uk-text-danger">{!!$errors->resetpassword->first('password')!!}</div>
                                         @endif
                                        </div>

                                    </div>
                                    <div class="uk-padding-small-top uk-grid uk-margin-remove">
                                        <div class="uk-width-1-1  line-height-text uk-padding-remove ">
                                            {!! Form::label('password_confirmation', '* Confirm Password',array('style'=>'width:75px')); !!}
                                        </div>
                                        <div class="uk-width-1-1 uk-padding-remove">
                                            {!! Form::password('password_confirmation','',array('id'=>'password','required')) !!}

                                        </div>


                                    </div>
                                    <div class="uk-padding-small-top uk-margin-top">
					 <input type="hidden" name="client_id" value="{{ $clients->fldClientID }}">
					 <input type="hidden" name="hash" value="{{ $clients->fldClientHashSecurity }}">
                                         {!! Form::submit('Submit',array('name'=>'submit','class'=>'uk-button uk-button-primary'))!!}
                                    </div>
                                </div>
                                 {!! Form::close() !!}

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

    {!! Html::script('_front/assets/js/jquery.min.js') !!}
    {!! Html::script('_front/plugins/password/strength.js') !!}

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


    </script>
@stop