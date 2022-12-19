@extends('layouts._front.shoppingcart')

@section('content')
	 <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top"> 
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">
                        <div class="uk-width-medium-6-10 uk-width-1-1">               
                            <h1 class="uk-h2 text-uppercase">{{ $pages->fldPagesName }}</h1>
                            {!! $pages->fldPagesDescription !!}                      
                            <div id="billingError" style="display:none;" class="uk-text-danger">Fields mark with * are required</div>
                            {!! Form::open(array('url' => '/registration', 'method' => 'post',  'class' => 'row-fluid input-100 bill-info')); !!}      
                             <div class="uk-grid">
                                <div class = "uk-width-large-1-2  uk-width-small-1-2 uk-margin-top">                    
                                    {!! Form::label('firstname', '* First Name',array( )); !!}
                                    {!! Form::text('firstname',isset($billing->fldClientsBillingFirstname) ? $billing->fldClientsBillingFirstname : "",array('id'=>'firstname','required','class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('lastname', '* Last Name',array( )); !!}
                                    {!! Form::text('lastname',isset($billing->fldClientsBillingLastname) ? $billing->fldClientsBillingLastname : "",array('id'=>'lastname','required','class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-1-1 uk-margin-top">
                                    {!! Form::label('company', 'Company',array()); !!}
                                    {!! Form::text('lastname',isset($billing->fldClientsBillingLastname) ? $billing->fldClientsBillingLastname : "",array('id'=>'lastname','required','class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('email', '* Email Address',array( )); !!}
                                    {!! Form::email('email',isset($billing->fldClientsBillingEmail) ? $billing->fldClientsBillingEmail : "",array('id'=>'email','required','class'=>'form-control')) !!}
                                </div >
                           
                                <div class = "uk-width-large-1-2 uk-width-small-1-2  uk-margin-top" >
                                    {!! Form::label('phone', '* Phone Number',array( )); !!}
                                    {!! Form::text('phone',isset($billing->fldClientsBillingPhone) ? $billing->fldClientsBillingPhone : "",array('id'=>'phone','required','class'=>'form-control')) !!}
                                </div >

                                <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!! Form::label('country', '* Country'); !!}                                      
                                    {!! Form::select('country',array('0' => 'Select one')+App\Models\Country::displayCountry(),isset($billing->fldClientsBillingCountry) ? $billing->fldClientsBillingCountry : "US",array('id'=>'country','data-placeholder'=>'Select Country','class'=>'form-control')) !!}
                                </div >

                                 <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!! Form::label('address', '* Address',array( )); !!}
                                    {!! Form::text('address',isset($billing->fldClientsBillingAddress) ? $billing->fldClientsBillingAddress : "",array('id'=>'address','required','class'=>'form-control','placeholder'=>'Street Address')) !!}
                                </div >
                                 <div class = "uk-width-small-1-1 uk-margin-top">                                   
                                    {!! Form::text('address',isset($billing->fldClientsBillingAddress) ? $billing->fldClientsBillingAddress : "",array('id'=>'address2','class'=>'form-control','placeholder'=>'Apartment, suite, unit, ect. (optional)')) !!}
                                </div >
                                <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!! Form::label('city', '* City',array( )); !!}
                                    {!! Form::text('city',isset($billing->fldClientsBillingCity) ? $billing->fldClientsBillingCity : "",array('id'=>'city','required', 'class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('state', '* State'); !!}
                                    <span id="billingstateus">                                      
                                    {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),isset($billing->fldClientsBillingState) ? $billing->fldClientsBillingState : "0",array('onchange' => 'checkTax(this.value)', 'id'=>'state','data-placeholder'=>'Select State', 'class'=>'form-control')) !!}
                                    </span>
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('zip', '* Zip Code',array( )); !!}
                                    {!! Form::text('zip',isset($billing->fldClientsBillingZip) ? $billing->fldClientsBillingZip : "",array('id'=>'zip','required','class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-1-1 uk-margin-large-top">
                                 {!! Form::submit('Register',array('name'=>'register','class'=>'uk-button uk-button-primary'))!!}
                                </div>                                
                            </div><!--row -->   
                            {!! Form::close() !!}                     
                        </div><!--uk 6 -10 -->
                        <div class="uk-width-medium-4-10 uk-width-1-1 uk-margin-top">    
                            <div class="box-bordered padding-medium ">        
                                <h4>Registered Customers</h4>
                                <p>If you already have an account with us, please log in.</p>
                                 {!! Html::link('login', "Login",array('class'=>'uk-button uk-button-primary')) !!}
                            </div>
                        </div>
        
                    </div><!--ukgrid -->      
                </div><!--main -->  
            </div><!--ukcomtainer -->  
        </div><!--wid11 -->  
      
@stop

@section('headercodes')
	
@stop