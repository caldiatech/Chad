@extends('layouts._front.shoppingcart')

@section('content')
   
 {{-- */$active1="";$active2="class='uk-active'";$active3="";$active4="";$active5="";/* --}}
 <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top"> 
     <div class="uk-container uk-container-center uk-margin-medium-bottom">
        <article id="main" role="main">
            <div class="uk-grid">
                <div class="uk-width-medium-6-10 uk-width-1-1">               
                     <h1 class="uk-h2 text-uppercase">Billing Information</h1>
                      
            @if(Session::has('success')) 
                <div class="alert alert-success">{!!Session::get('success')!!}</div>
              @endif
             {!! Form::open(array('url' => '/user-billing', 'method' => 'post',  'class' => 'row-fluid input-100 bill-info')) !!}
              <fieldset class="form-inline">
                {!! Form::label('lastname', 'Last Name',array('style'=>'width:120px')); !!}
                {!! Form::text('lastname',isset($billing->fldClientsBillingLastname) ? $billing->fldClientsBillingLastname : "",array('id'=>'lastname','required','class'=>'form-control')) !!}
              </fieldset>
              <fieldset class="form-inline">
                 {!! Form::label('firstname', 'First Name',array('style'=>'width:120px')); !!}
                 {!! Form::text('firstname',isset($billing->fldClientsBillingFirstname) ? $billing->fldClientsBillingFirstname : "",array('id'=>'firstname','required','class'=>'form-control')) !!}
               </fieldset>
              <fieldset class="form-inline">
                 {!! Form::label('address', 'Address',array('style'=>'width:120px')); !!}
                 {!! Form::text('address',isset($billing->fldClientsBillingAddress) ? $billing->fldClientsBillingAddress : "",array('id'=>'address','required','class'=>'form-control')) !!}
              </fieldset>
              <fieldset class="form-inline">
                 {!! Form::label('address1', 'Address 2',array('style'=>'width:120px')); !!}
                 {!! Form::text('address1',isset($billing->fldClientsBillingAddress1) ? $billing->fldClientsBillingAddress1 : "",array('id'=>'address1','class'=>'form-control')) !!}
              </fieldset>
              <fieldset class="form-inline">
                 {!! Form::label('city', 'City',array('style'=>'width:120px')); !!}
                 {!! Form::text('city',isset($billing->fldClientsBillingCity) ? $billing->fldClientsBillingCity : "",array('id'=>'city','required','class'=>'form-control')) !!}
              </fieldset>
              <fieldset class="form-inline">
                 
                 {!! Form::label('state', 'State',array('style'=>'width:120px')); !!}                 
                 {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),isset($billing->fldClientsBillingState) ? $billing->fldClientsBillingState : "0",array('data-placeholder'=>'Select State','class'=>'form-control')) !!}                 
             </fieldset>
             <fieldset class="form-inline">
                 {!! Form::label('country', 'Country',array('style'=>'width:120px')); !!}                                      
                 {!! Form::select('country',array('0' => 'Select one')+App\Models\Country::displayCountry(),isset($billing->fldClientsBillingCountry) ? $billing->fldClientsBillingCountry : "US",array('id'=>'country','data-placeholder'=>'Select Country','class'=>'form-control')) !!}
            </fieldset>
            <fieldset class="form-inline">
                 {!! Form::label('zip', 'Zip Code',array('style'=>'width:120px')); !!}
                 {!! Form::text('zip',isset($billing->fldClientsBillingZip) ? $billing->fldClientsBillingZip : "",array('id'=>'zip','required','class'=>'form-control')) !!}
            </fieldset>
            <fieldset class="form-inline">
                 {!! Form::label('phone', 'Phone Number',array('style'=>'width:120px')); !!}
                 {!! Form::text('phone',isset($billing->fldClientsBillingPhone) ? $billing->fldClientsBillingPhone : "",array('id'=>'phone','required','class'=>'form-control')) !!}
            </fieldset>
            <fieldset class="form-inline">
                 {!! Form::label('email', 'Email Address',array('style'=>'width:120px')); !!}
                 {!! Form::email('email',isset($billing->fldClientsBillingEmail) ? $billing->fldClientsBillingEmail : "",array('id'=>'email','required','class'=>'form-control')) !!}
            </fieldset>
            {!! Form::hidden('Id',$billing->fldClientsBillingID) !!}
           {!! Form::submit('Update Billing Information',array('name'=>'register','class'=>'uk-button uk-button-success'))!!}   
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