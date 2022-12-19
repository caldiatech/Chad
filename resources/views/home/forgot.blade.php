@extends('layouts._front.template-1')

@section('content')


  <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top">
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">

                        <div class="uk-width-medium-4-10 uk-width-1-1 uk-margin-top">
                            <div class="box-bordered padding-medium ">
                                <h4>Forgot Password</h4>
                                 {!! Form::open(array('url' => '/forgot-password', 'method' => 'post',  'class' => 'row-fluid account-login input-100')) !!}
                                <div class="formbox">
                                    <div class="uk-padding-small-top uk-grid uk-margin-remove">
                                        <div class="uk-width-1-1  line-height-text  uk-padding-remove ">
                                         {!! Form::label('username', '* Email Address',array('style'=>'width:75px')); !!}
                                        </div>
                                        <div class="uk-width-1-1  line-height-text  uk-padding-remove">
                                        {!! Form::text('email','',array('id'=>'username','required')) !!}
                                        @if($errors->login->first('email'))
                                            <div class="uk-text-danger">{!!$errors->login->first('username')!!}</div>
                                         @endif
                                        </div>

                                    </div>

                                    <div class="uk-padding-small-top uk-margin-top">
                                         {!! Form::submit('Forgot Password',array('name'=>'login','class'=>'uk-button float-none uk-button-primary'))!!}
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
@stop