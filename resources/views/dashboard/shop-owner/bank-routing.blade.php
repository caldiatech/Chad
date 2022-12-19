@extends('layouts._front.dashboard_owner')

@section('content')


   {!! Form::open(array('url' => '/dashboard/shop-owner/bank-routing', 'method' => 'post',  'class' => '','id'=>'profile_edit_form')) !!}
    <div class="button-container button-container-top">
    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
    </div>   

    @if (Session::has('success'))
        <div class="uk-alert uk-alert-success uk-margin-large-top">{!!Session::get('success')!!}</div>
    @endif
	@if (Session::has('braintree-error'))
        <div class="uk-alert uk-alert-danger uk-margin-large-top">{!!Session::get('braintree-error')!!}</div>
    @endif 	 
    
	<section id="banking-info" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-briefcase uk-icon-justify"></i> <span class="title-text">Banking Information</span>
    	 <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#banking-info-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="banking-info-panel">
			<div class="uk-grid">
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('bank_name', 'Bank Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('bank_name',$shopOwner->fldShopOwnerBankName,array('id'=>'bank_name','required','class'=>'text')) !!}
        			</div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('account_no', 'Account Number',array('class'=>'lbl' )); !!}
            			{!! Form::text('account_no',$shopOwner->fldShopOwnerBankAccountNumber,array('id'=>'account_no','required','class'=>'text')) !!}
        			</div>
        			<div class="uk-vertical-divider full-width uk-margin"></div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('type_of_account', 'Type Of Account',array('class'=>'lbl' )); !!}
						{!! Form::text('type_of_account',$shopOwner->fldShopOwnerTypeofAccount,array('id'=>'type_of_account','required','class'=>'text')) !!}
    				</div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('routing_no', 'Routing Number',array('class'=>'lbl' )); !!}
						{!! Form::text('routing_no',$shopOwner->fldShopOwnerBankRoutingNumber,array('id'=>'routing_no','required','class'=>'text')) !!}
    				</div>	
        			<div class="uk-vertical-divider full-width uk-margin"></div>						
        			<div class="uk-panel-content address-info-content">

	                    	<div class="uk-grid">
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<h3 class="full-width border-bottom">Banking Address</h3>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_street', 'Street',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_street',$shopOwner->fldShopOwnerBankAddress1,array('id'=>'banking_street','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_city', 'City',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_city',$shopOwner->fldShopOwnerBankCity,array('id'=>'banking_city','class'=>'text')) !!}
	                			</div>	                			
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_state', 'State',array('class'=>'lbl' )); !!}
	                    			<span class="select-wrapper">
										{!! Form::select('banking_state',array('0' => 'Select one')+App\Models\State::displayState(),$shopOwner->fldShopOwnerBankState,array('id'=>'state','data-placeholder'=>'Select State', 'class'=>'required')) !!}
									</span>
	                			</div>
	                			<div class="uk-width-large-1-4  uk-width-1-2 ">
	                				{!! Form::label('banking_zip', 'ZIP',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_zip',$shopOwner->fldShopOwnerBankZIP,array('id'=>'banking_zip','class'=>'text')) !!}
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
    			@if($shopOwner->fldShopOwnerBraintreeCustomerID != "")
    				({{ $shopOwner->fldShopOwnerBraintreeCustomerID }})       			
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
						{!! Form::text('cvv',$shopOwner->fldShopOwnerCVV,array('id'=>'cvv','class'=>'text')) !!}
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
 
@stop

 
@section('extracodes')  
 {{-- */ /* */ /* --}}
	<script>
		$(document).ready(function(){
						
			loadScript("{!!url('_front/plugins/spinner/src/jquery.spinner.js')!!}", function(){        
		        $('.spinner').spinner('changed',function(e, newVal, oldVal){
		          
		        });
		 	});
			
		});
	</script>
@stop
