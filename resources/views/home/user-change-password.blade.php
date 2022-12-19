@extends('layouts._front.pages')

@section('content')
   
 {{-- */$active1="";$active2="";$active3="";$active4="";$active5="class=uk-active";/* --}}
  <div class="uk-grid">
  	  <div class="uk-width-large-3-10 uk-width-medium-3-10 uk-width-small-1" id="user-menu">
      	@include('home.includes.sidenav-account')
      </div>
       <div class="uk-width-large-7-10 uk-width-medium-7-10 uk-width-small-1" id="user-dashboard">
      		<!--<div id="user-menu-mobile" style="display:none">
            	@include('home.includes.sidenav-account-mobile')
            </div> -->
      		<h1>Change Password</h1>           
             @if(Session::has('success')) 
                <div class="alert alert-success">{!!Session::get('success')!!}</div>
              @endif
             @if(Session::has('error'))
            	<div class="alert alert-danger">{!!Session::get('error')!!}</div>
            @endif
             {!! Form::open(array('url' => '/user-change-password', 'method' => 'post',  'class' => 'row-fluid bill-info')) !!}
              <fieldset class="form-inline">
              	{!! Form::label('password', 'Password',array('style'=>'width:200px')); !!}
		            {!! Form::password('password',array('id'=>'password','required'=>'required','class'=>'form-control')) !!}
              </fieldset>
               <fieldset class="form-inline">
              	{!! Form::label('password1', 'Confirm New Password',array('style'=>'width:200px')); !!}
		            {!! Form::password('password1',array('id'=>'password1','required'=>'required','class'=>'form-control')) !!}
              </fieldset>            
			         {!! Form::submit('Change Password',array('name'=>'register','class'=>'uk-button uk-button-success pull-right'))!!}		
               {!! Form::close() !!}    
      </div>
  </div>	      

@stop

@section('headercodes')
	
@stop