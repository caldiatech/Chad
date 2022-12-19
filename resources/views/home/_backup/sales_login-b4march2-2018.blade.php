@extends('layouts._front.template-1')

@section('content')
  <div class="uk-width-1-1">
    <div class="uk-container uk-container-center">
      <article id="main" role="main" class="uk-block uk-text-contrast">
        <div class="uk-grid">
          <div class="uk-width-medium-2-3 uk-width-small-1-1">
            <div class="uk-container">
                <h4 class="uk-text-contrast">Registered Sales Manager</h4>
                <p class="uk-margin-bottom-remove uk-padding-bottom-remove">If you have an account with us, please log in.</p>
                @if(Session::has('sales-reset-success'))
                          <div class="uk-alert uk-alert-success"><strong>Success: </strong>Your password has been reset. You can now use your new password to login.</div>
                @endif

                 @if(Session::has('error'))
                <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
                @endif
                 {!! Form::open(array('url' => '/sales-login', 'method' => 'post',  'class' => 'row-fluid account-login input-100')) !!}
                <div class="formbox">
                    <div class="uk-padding-small-top uk-grid uk-margin-remove">
                        <div class="uk-width-large-1-1  line-height-text uk-width-medium-1-1  uk-width-small-1-1  uk-width-1-1 uk-padding-remove " style="max-width:110px; ">
                         {!! Form::label('email', 'Email Address * ',array('style'=>'')); !!}
                        </div>
                        <div class="uk-width-large-1-1  uk-width-medium-1-1  uk-width-small-1-1  uk-width-1-1 uk-padding-remove">
                          {!! Form::text('email','',array('id'=>'email','required',  'class' => 'form-width-large')) !!}
                @if($errors->login->first('email'))
                 <div class="uk-text-danger">{!!$errors->login->first('email')!!}</div>
              @endif
                        </div>

                    </div>
                    <div class="uk-padding-small-top uk-grid uk-margin-remove">
                        <div class="uk-width-large-1-1 line-height-text  uk-width-medium-1-1  uk-width-small-1-1  uk-width-1-1 uk-padding-remove " style="max-width:110px; ">
                            {!! Form::label('password', 'Password *',array('style'=>'')); !!}
                        </div>
                        <div class="uk-width-large-1-1   uk-width-medium-1-1  uk-width-small-1-1  uk-width-1-1 uk-padding-remove forcewidth">
                            {!! Form::password('password','',array('id'=>'password','required', 'class' => 'form-width-large')) !!}
                @if($errors->login->first('password'))
               <div class="uk-text-danger">{!!$errors->login->first('password')!!}</div>
              @endif
                        </div>


                    </div>
                    <div class="uk-padding-small-top">
                         {!! Form::submit('Login',array('name'=>'login','class'=>'uk-margin-top uk-button uk-button-primary widauto'))!!}
                    </div>
                </div>
                 {!! Form::close() !!}
                <div class="uk-text-contrast">
                    <a href="javascript:void(0)" class="full-width clearauto widauto uk-display-inline-block uk-text-contrast uk-margin-top uk-margin-medium-bottom" data-uk-toggle="{target:'#forgotPass', animation:'uk-animation-slide-left, uk-animation-slide-right'}">I can't access my account, please help.</a>
                @if(Session::has('sales-forgot-success'))
                          <div class="uk-alert full-width uk-alert-success">Your password reset link has been sent to your email on file. Please check your inbox for this email. If you do not receive it please make sure to check your Spam or Junk folders.</div>
                    @endif

                    @if(Session::has('error-forgot'))
                        <div id="forgotPass">
                          <div class="uk-alert full-width  uk-alert-danger"><strong>Error!</strong> {!!Session::get('error-forgot')!!}</div>
                    @else
                        <div id="forgotPass" class="uk-hidden">
                    @endif
                            {!! Form::open(array('url' => '/sales-forgot-password', 'method' => 'post',  'class' => 'form-width-large row-fluid account-login input-100')) !!}
                  <p class="uk-text-danger uk-margin-bottom-remove uk-padding-remove-bottom uk-text-contrast uk-display-block clearauto uk-width-1-1">To reset your password, enter the email address you use to sign in to Clarkin. </p>
                                  <div class="formbox">
                                        <div class="uk-padding-small-top uk-grid uk-margin-remove">
                                            <div class="uk-width-large-1-1  line-height-text uk-width-medium-1-1  uk-width-small-1-1  uk-width-1-1 uk-padding-remove " style="max-width:110px; ">
                                             {!! Form::label('username', 'Email Address  *',array('style'=>'width:75px')); !!}
                                            </div>
                                            <div class="uk-width-large-1-1   uk-width-medium-1-1  uk-width-small-1-1  uk-width-1-1 uk-padding-remove">
                                            {!! Form::text('email','',array('id'=>'username','required',  'class' => 'form-width-large')) !!}
                                            @if($errors->login->first('email'))
                                                <div class="uk-text-danger">{!!$errors->login->first('username')!!}</div>
                                             @endif
                                            </div>

                                        </div>

                                        <div class="uk-padding-small-top">
                                             {!! Form::submit('Forgot Password',array('name'=>'login','class'=>'uk-margin-top uk-button uk-button-primary widauto  uk-margin-large-bottom'))!!}
                                        </div>
                                    </div>
                             {!! Form::close() !!}
                        </div>
                        </div>
                </div>
    <!--                            </div>-->
            </div>
            <div class="uk-width-medium-1-3 uk-width-small-1-1">
                <hr class="uk-article-divider uk-margin-large-bottom divshow">
                <div class=" uk-block box-bordered">
                    <div class="uk-container">
                         <h1 class="uk-h2 text-uppercase">New Sales Manager</h1>
                        <p>By creating an account with our store, you will be able to move through the checkout process faster.</p>
                        {!! Html::link('sales-registration', "Create an Account",array('class'=>'uk-button uk-button-primary')) !!}
                    </div>
                </div>
            </div>
        </div>
      </div>
    </article>
  </div><!--uk-container -->
</div><!--wid11 -->
@stop

@section('headercodes')

@stop