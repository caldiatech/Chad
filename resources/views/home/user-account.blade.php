@extends('layouts._front.shoppingcart')

@section('content')
   
{{-- */$active1="class=uk-active";$active2="";$active3="";$active4="";$active5="";/* --}}

 <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top"> 
     <div class="uk-container uk-container-center uk-margin-medium-bottom">
        <article id="main" role="main">
            <div class="uk-grid">
                <div class="uk-width-medium-6-10 uk-width-1-1">               
                     <h1 class="uk-h2 text-uppercase">Account Information</h1>
                      @if(Session::has('error')) 
                              <div class="uk-alert uk-alert-error">{!!Session::get('success')!!}</div>
                          @endif
                           @if(Session::has('success')) 
                                 <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
                          @endif
                          
                           {!! Form::open(array('url' => '/user-account', 'method' => 'post',  'class' => 'row-fluid input-100 bill-info')) !!}
                              <div class="uk-grid">
                                <div class = "uk-width-large-1-2  uk-width-small-1-2 uk-margin-top"> 
                                 {!! Form::label('lastname', 'Last Name',array('style'=>'')); !!}
                                 {!! Form::text('lastname',isset($clients->fldClientLastname) ? $clients->fldClientLastname : "",array('id'=>'lastname','required','class'=>'form-control')) !!}
                              </div>
                              <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">                                      
                                 {!! Form::label('firstname', 'First Name',array('style'=>'width:120px')); !!}
                                 {!! Form::text('firstname',isset($clients->fldClientFirstname) ? $clients->fldClientFirstname : "",array('id'=>'firstname','required','class'=>'form-control')) !!}
                             </div>
                              <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                 {!! Form::label('email', 'Email Address',array('style'=>'width:120px')); !!}
                                 {!! Form::text('email',isset($clients->fldClientEmail) ? $clients->fldClientEmail : "",array('id'=>'email','required','class'=>'form-control','type'=>'email')) !!}      
                             </div>
                              <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                               {!! Form::label('username', 'Username',array('style'=>'width:120px')); !!}
                               {!! Form::text('username',isset($clients->fldClientUsername) ? $clients->fldClientUsername : "",array('id'=>'username','required','class'=>'form-control')) !!}
                             </div> 
                              <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                             {!! Form::submit('Update Account Information',array('name'=>'register','class'=>'uk-button uk-button-primary'))!!}  
                              </div> 
                        </div>
                        {!! Form::close() !!} 
                      </div>
                      <div class="uk-width-medium-4-10 uk-width-1-1 uk-margin-top">    
                        <div class="box-bordered full-width padding-medium ">   
                             @include('home.includes.sidenav-account')
                        </div>

                </div><!--ukgrid -->      
            </div><!--main --> 
        <article> 
      </div><!--ukcomtainer -->  
</div><!--wid11 -->  

 
      
@stop

@section('headercodes')
	
@stop