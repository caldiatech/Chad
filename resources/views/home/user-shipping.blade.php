@extends('layouts._front.pages')

@section('content')
   
 {{-- */$active1="";$active2="";$active3="class='active'";$active4="";$active5="";/* --}}

  <div class="uk-grid">
  	  <div class="uk-width-large-3-10 uk-width-medium-3-10 uk-width-small-1" id="user-menu">
      	@include('home.includes.sidenav-account')
      </div>
     <div class="uk-width-large-7-10 uk-width-medium-7-10 uk-width-small-1" id="user-dashboard">
      		<!--<div id="user-menu-mobile" style="display:none">
            	@include('home.includes.sidenav-account-mobile')
            </div> -->
      		<h1>Shipping Information</h1>           
              @if(Session::has('success')) 
                <div class="alert alert-success">{!!Session::get('success')!!}</div>
              @endif

             {!! Form::open(array('url' => '/user-shipping', 'method' => 'post',  'class' => 'row-fluid bill-info')) !!}
              <fieldset class="form-inline">
              	{!! Form::label('lastname', 'Last Name',array('style'=>'width:120px')); !!}
		        {!! Form::text('lastname',isset($shipping->fldClientsShippingLastname) ? $shipping->fldClientsShippingLastname : "",array('id'=>'lastname','required','class'=>'form-control')) !!}
              </fieldset>
              <fieldset class="form-inline">
                 {!! Form::label('firstname', 'First Name',array('style'=>'width:120px')); !!}
                 {!! Form::text('firstname',isset($shipping->fldClientsShippingFirstname) ? $shipping->fldClientsShippingFirstname : "",array('id'=>'firstname','required','class'=>'form-control')) !!}              </fieldset>
              <fieldset class="form-inline">
                 {!! Form::label('address', 'Address',array('style'=>'width:120px')); !!}
		         {!! Form::text('address',isset($shipping->fldClientsShippingAddress) ? $shipping->fldClientsShippingAddress : "",array('id'=>'address','required','class'=>'form-control')) !!}
              </fieldset>
              <fieldset class="form-inline">
                 {!! Form::label('address1', 'Address 2',array('style'=>'width:120px')); !!}
		         {!! Form::text('address1',isset($shipping->fldClientsShippingAddress1) ? $shipping->fldClientsShippingAddress1 : "",array('id'=>'address1','class'=>'form-control')) !!}
              </fieldset>
              <fieldset class="form-inline">
                 {!! Form::label('city', 'City',array('style'=>'width:120px')); !!}
		         {!! Form::text('city',isset($shipping->fldClientsShippingCity) ? $shipping->fldClientsShippingCity : "",array('id'=>'city','required','class'=>'form-control')) !!}
              </fieldset>
              <fieldset class="form-inline">
                 
                 {!! Form::label('state', 'State',array('style'=>'width:120px')); !!}                 
                 {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),isset($shipping->fldClientsShippingState) ? $shipping->fldClientsShippingState : "0",array('data-placeholder'=>'Select State','class'=>'form-control')) !!}                 
             </fieldset>
             <fieldset class="form-inline">
                 {!! Form::label('country', 'Country',array('style'=>'width:120px')); !!}                                      
                 {!! Form::select('country',array('0' => 'Select one')+App\Models\Country::displayCountry(),isset($shipping->fldClientsShippingCountry) ? $shipping->fldClientsShippingCountry : "US",array('id'=>'country','data-placeholder'=>'Select Country','class'=>'form-control')) !!}
            </fieldset>
            <fieldset class="form-inline">
                 {!! Form::label('zip', 'Zip Code',array('style'=>'width:120px')); !!}
		         {!! Form::text('zip',isset($shipping->fldClientsShippingZip) ? $shipping->fldClientsShippingZip : "",array('id'=>'zip','required','class'=>'form-control')) !!}
            </fieldset>
            <fieldset class="form-inline">
                 {!! Form::label('phone', 'Phone Number',array('style'=>'width:120px')); !!}
		         {!! Form::text('phone',isset($shipping->fldClientsShippingPhone) ? $shipping->fldClientsShippingPhone : "",array('id'=>'phone','required','class'=>'form-control')) !!}
            </fieldset>
            <fieldset class="form-inline">
                 {!! Form::label('email', 'Email Address',array('style'=>'width:120px')); !!}
		         {!! Form::email('email',isset($shipping->fldClientsShippingEmail) ? $shipping->fldClientsShippingEmail : "",array('id'=>'email','required','class'=>'form-control')) !!}
            </fieldset>
            {!! Form::hidden('Id',$shipping->fldClientsShippingID) !!}
			{!! Form::submit('Update Shipping Information',array('name'=>'register','class'=>'uk-button uk-button-success'))!!}		
          {!! Form::close() !!}    
      </div>
  </div>	
      


@stop

@section('headercodes')
	
@stop