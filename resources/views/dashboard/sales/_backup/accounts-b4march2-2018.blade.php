@extends('layouts._front.dashboard_manager')

@section('content')


   {!! Form::open(array('url' => '/dashboard/sales/accounts', 'method' => 'post',  'class' => '','id'=>'profile_edit_form')) !!}
    <div class="button-container button-container-top">
    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
    </div>    
    
    @if (Session::has('success'))
       		<div class="uk-alert uk-alert-success uk-margin-large-top">{!!Session::get('success')!!}</div>
    	@endif
	@if (Session::has('braintree-error'))
       		<div class="uk-alert uk-alert-danger uk-margin-large-top">{!!Session::get('braintree-error')!!}</div>
    @endif 	 	

	   <section id="profile-settings" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-wrench ion ion-settings uk-icon-justify"></i> <span class="title-text">Account Settings</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-settings-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="profile-settings-panel">
			<div class="uk-grid" >
	            <div class="uk-width-small-1-1 ">
	                <div class="uk-grid uk-panel uk-panel-box normal">

	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('email', 'Username',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::text('email',$manager->fldManagerEmail,array('id'=>'email','class'=>'text','readonly','style'=>'background-color: #F5F4F3;')) !!}
	                    	@if($errors->accounts->first('email'))
                                <div class="uk-text-danger">{!!$errors->accounts->first('email')!!}</div>
                            @endif
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('password', 'Password',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::password('password',array('id'=>'password','class'=>'text')) !!}

	                    	<table border=0>
                                <tr>
                                    <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passveryweak"></i> at least 8 char</td>
                                    <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passweak"></i> an uppercase</td>
                                    <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passmedium"></i> a number</td>
                                    <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passstrong"></i> special char</td>
                                </tr>  
                            </table>
								
								@if($errors->accounts->first('password'))
                                        <div class="uk-text-danger">{!!$errors->accounts->first('password')!!}</div>
                                 @endif		
	                	</div>
	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	<section id="banking-info" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-briefcase uk-icon-justify"></i> <span class="title-text">Banking Information</span>
    	 <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#banking-info-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="banking-info-panel">
			<div class="uk-grid">
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('bank_name', 'Bank Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('bank_name',$manager->fldManagerBankName,array('id'=>'bank_name','class'=>'text')) !!}
        			</div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('account_no', 'Account Number',array('class'=>'lbl' )); !!}
            			{!! Form::text('account_no',$manager->fldManagerBankAccountNumber,array('id'=>'account_no','class'=>'text')) !!}
        			</div>
        			<div class="uk-vertical-divider full-width uk-margin"></div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('type_of_account', 'Type Of Account',array('class'=>'lbl' )); !!}
						{!! Form::text('type_of_account',$manager->fldManagerTypeofAccount,array('id'=>'type_of_account','class'=>'text')) !!}
    				</div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('routing_no', 'Routing Number',array('class'=>'lbl' )); !!}
						{!! Form::text('routing_no',$manager->fldManagerBankRoutingNumber,array('id'=>'routing_no','class'=>'text')) !!}
    				</div>	
        			<div class="uk-vertical-divider full-width uk-margin"></div>

	                    <div class="uk-panel-content address-info-content">

	                    	<div class="uk-grid">
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<h3 class="full-width border-bottom">Banking Address</h3>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_street', 'Street',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_street',$manager->fldManagerBankAddress1,array('id'=>'banking_street','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_city', 'City',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_city',$manager->fldManagerBankCity,array('id'=>'banking_city','class'=>'text')) !!}
	                			</div>	                			
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_state', 'State',array('class'=>'lbl' )); !!}
	                    			<span class="select-wrapper">
										{!! Form::select('banking_state',array('0' => 'Select one')+App\Models\State::displayState(),$manager->fldManagerBankState,array('id'=>'state','data-placeholder'=>'Select State', 'class'=>'required')) !!}
									</span>
	                			</div>
	                			<div class="uk-width-large-1-4  uk-width-1-2 ">
	                				{!! Form::label('banking_zip', 'ZIP',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_zip',$manager->fldManagerBankZIP,array('id'=>'banking_zip','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-vertical-divider full-width uk-margin"></div>

	                		</div>

	    					
	    					
						</div>							

        	</div>
	    </div> 
	</section> 

	<? /*
	<section id="credit-card-info" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-card ion ion-card uk-icon-justify"></i> <span class="title-text">Credit Card Information</span>
    		 @if($manager->fldManagerBraintreeCustomerID != "")
    			({{ $manager->fldManagerBraintreeCustomerID }})
    		@endif	
    	 <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#credit-card-info-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="credit-card-info-panel">
			<div class="uk-grid">
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('cc_firstname', 'First Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('cc_firstname',isset($braintreeClient->firstName) ? $braintreeClient->firstName : "",array('id'=>'cc_firstname','class'=>'text')) !!}
        			</div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('cc_lastname', 'Last Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('cc_lastname',isset($braintreeClient->lastName) ? $braintreeClient->lastName : "",array('id'=>'cc_lastname','class'=>'text')) !!}
        			</div>
        			<div class="uk-vertical-divider full-width uk-margin"></div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('cc_no', 'Credit Card Number (378282246310005)',array('class'=>'lbl' )); !!}
            			{!! Form::text('cc_no',isset($braintreeClient->creditCards{0}->maskedNumber) ? $braintreeClient->creditCards{0}->maskedNumber : "",array('id'=>'cc_no','class'=>'text')) !!}
        			</div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('cvv', 'CVV (1234)',array('class'=>'lbl' )); !!}
						{!! Form::text('cvv',$manager->fldManagerCVV,array('id'=>'cvv','class'=>'text')) !!}
    				</div>

        			<div class="uk-vertical-divider full-width uk-margin"></div>
        			<div class="uk-width-1-1">
        				{!! Form::label('cc_exp_mm', 'Expiration Date',array('class'=>'lbl' )); !!}  
        			</div>
        			<div class="uk-width-small-1-3 uk-width-1-1">  
        				          		
                		{!! Form::label('cc_exp_mm', 'Month',array('class'=>'lbl small light' )); !!}
            			<span class="select-wrapper">
							{!! Form::selectMonth('cc_exp_mm', isset($braintreeClient->creditCards{0}->expirationMonth) ? $braintreeClient->creditCards{0}->expirationMonth : 12, ['class' => 'field']) !!}
						</span>
					</div>
        			<div class="uk-width-small-1-3 uk-width-1-1">              		
                		{!! Form::label('bcc_exp_yy', 'Year',array('class'=>'lbl small light' )); !!}
            			<div class="input-append  spinner" data-trigger="spinner">
                            <input type="text" value="{!! isset($braintreeClient->creditCards{0}->expirationYear) ? $braintreeClient->creditCards{0}->expirationYear : date('Y') !!}" name="bcc_exp_yy" id="bcc_exp_yy" data-max="{!!date('Y')!!}" data-min="1950" data-step="1">
                            <div class="add-on"> 
                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                            </div>
                         </div>
					</div>
					<div class="uk-width-small-1-3 uk-width-1-1 ">
    					{!! Form::label('invite_code', 'Invite Code',array('class'=>'lbl small light' )); !!}
						{!! Form::text('invite_code',"",array('id'=>'invite_code','class'=>'text')) !!}
    				</div>	
        			<div class="uk-vertical-divider full-width uk-margin"></div>						

        	</div>
	    </div>
	</section> 
	*/ ?>

	    <div class="button-container button-container-bottom">
	    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
	    </div> 

	  {!! Form::close() !!} 
@stop


@section('headercodes')
 {!! Html::style('_front/plugins/password/strength.css') !!}    
@stop

 
@section('extracodes')  
 {{-- */ /* */ /* --}}
 	{!! Html::script('_front/plugins/password/strength.js','') !!}
    
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
     
	<script>
		$(document).ready(function(){
						
			loadScript("{!!url('_front/plugins/spinner/src/jquery.spinner.js')!!}", function(){        
		        $('.spinner').spinner('changed',function(e, newVal, oldVal){
		          
		        });
		 	});
			
		});
	</script>
@stop
