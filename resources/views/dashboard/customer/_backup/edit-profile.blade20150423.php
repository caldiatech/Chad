@extends('layouts._front.dashboard')

@section('content')
<?php
Form::macro('stateSelect', function($name = "state", $selected = null, $options = array()) {
	$states = array(
		'' => "",
		'AL' => "Alabama",
		'AK' => "Alaska",
		'AZ' => "Arizona",
		'AR' => "Arkansas",
		'CA' => "California",
		'CO' => "Colorado",
		'CT' => "Connecticut",
		'DE' => "Delaware",
		'DC' => "District Of Columbia",
		'FL' => "Florida",
		'GA' => "Georgia",
		'HI' => "Hawaii",
		'ID' => "Idaho",
		'IL' => "Illinois",
		'IN' => "Indiana",
		'IA' => "Iowa",
		'KS' => "Kansas",
		'KY' => "Kentucky",
		'LA' => "Louisiana",
		'ME' => "Maine",
		'MD' => "Maryland",
		'MA' => "Massachusetts",
		'MI' => "Michigan",
		'MN' => "Minnesota",
		'MS' => "Mississippi",
		'MO' => "Missouri",
		'MT' => "Montana",
		'NE' => "Nebraska",
		'NV' => "Nevada",
		'NH' => "New Hampshire",
		'NJ' => "New Jersey",
		'NM' => "New Mexico",
		'NY' => "New York",
		'NC' => "North Carolina",
		'ND' => "North Dakota",
		'OH' => "Ohio",
		'OK' => "Oklahoma",
		'OR' => "Oregon",
		'PA' => "Pennsylvania",
		'RI' => "Rhode Island",
		'SC' => "South Carolina",
		'SD' => "South Dakota",
		'TN' => "Tennessee",
		'TX' => "Texas",
		'UT' => "Utah",
		'VT' => "Vermont",
		'VA' => "Virginia",
		'WA' => "Washington",
		'WV' => "West Virginia",
		'WI' => "Wisconsin",
		'WY' => "Wyoming"
	);

	return Form::select($name, $states, $selected, $options);
});

?>
	

	

   {!! Form::open(array('url' => '/', 'method' => 'post',  'class' => '','id'=>'profile_edit_form', 'onsubmit'=>'return false')) !!}
    <div class="button-container button-container-top">
    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save Profile',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
    </div>    
    <section id="profile" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-justify"></i> <span class="title-text">Profile</span>  <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="profile-panel">
			<div class="uk-grid" >
	            <div class="uk-width-large-1-1 uk-width-small-1-1 ">
	                <div class="uk-panel uk-panel-box">
	                	<div class="uk-grid">
	                			<div class="uk-width-large-1-2 uk-width-1-2 ">
	                				{!! Form::label('firstname', '* First Name',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('firstname',"Joseph Michael 1",array('id'=>'firstname','required','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-large-1-2 uk-width-1-2 ">
	                				{!! Form::label('lastname', '* Last Name',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('lastname',"Doe",array('id'=>'lastname','required','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	    						<div class="uk-width-small-1-2 uk-width-1-1 ">
                					{!! Form::label('phone', '* Contact #',array('class'=>'lbl' )); !!}
	    							{!! Form::text('phone',"855-235-7234-231",array('id'=>'phone','required','class'=>'text')) !!}
                				</div>
	    						<div class="uk-width-small-1-2 uk-width-1-1 ">
                					{!! Form::label('email', '* Email Address',array('class'=>'lbl' )); !!}
	    							{!! Form::email('email',"josephmichael@gmail.com",array('id'=>'email','required','class'=>'text')) !!}
                				</div>	
	                			<div class="uk-vertical-divider full-width uk-margin"></div>						

	                	</div>
	                    
	                    <div class="uk-panel-content address-info-content">

	                    	<div class="uk-grid">
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<h3 class="full-width border-bottom">Address Information</h3>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('street', ' Street',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('street',"500 West Broadway",array('id'=>'street','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('city', '* City',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('city',"San Diego",array('id'=>'city','required','class'=>'text')) !!}
	                			</div>	                			
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('state', '* State',array('class'=>'lbl' )); !!}
	                    			<span class="select-wrapper">
										{!! Form::stateSelect('consumer[billing_state]', "CA", ["class" => "",'required']) !!}
									</span>
	                			</div>
	                			<div class="uk-width-large-1-4  uk-width-1-2 ">
	                				{!! Form::label('zip', '* Zip',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('zip',"92101",array('id'=>'zip','required','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<div class="uk-width-1-2 ">
	                				{!! Form::label('career', 'Career',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('career',"Professional Photographer",array('id'=>'career','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-1-2 ">
	                				{!! Form::label('authorization', 'Authorization',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('authorization',"Professional Photographer",array('id'=>'authorization','class'=>'text')) !!}
	                			</div>

	                		</div>

	    					
	    					
						</div>
	                </div>
	            </div>
	           </div>
	       </div>
	   </section>

	   <section id="profile-settings" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-wrench ion ion-settings uk-icon-justify"></i> <span class="title-text">Profile Settings</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-settings-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="profile-settings-panel">
			<div class="uk-grid" >
	            <div class="uk-width-small-1-1 ">
	                <div class="uk-grid uk-panel uk-panel-box normal">
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label  class="table-text">Mobile Alerts</label>
	                	</div>
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal" data-uk-button-checkbox>	                		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle"> <span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> <span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text">Email Alerts</label>
	                	</div>
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal" data-uk-button-checkbox>	                		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle"> <span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> <span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('promo_code', 'Promo Code',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::text('promo_code',"PQR952Y0",array('id'=>'promo_code','class'=>'text')) !!}
	                	</div>
	                	<div class="uk-width-small-1-1 uk-width-1-1 uk-padding-v-normal">	
	                		<div class="uk-grid"> 
	                			{!! Form::label('birthday', 'Birthday',array('class'=>'lbl table-text light' )); !!}
	                			<div class="uk-width-small-1-3 uk-width-1-1">              		
			                		{!! Form::label('birth_mm', 'Month',array('class'=>'lbl small light' )); !!}
		                			<span class="select-wrapper">
										{!! Form::selectMonth('month', 12, ['class' => 'field']) !!}
									</span>
								</div>
	                			<div class="uk-width-small-1-3 uk-width-1-1">              		
			                		{!! Form::label('birth_dd', 'Day',array('class'=>'lbl small light' )); !!}
		                			<div class="input-append spinner" data-trigger="spinner">
			                            <input type="text" value="0" name="birth_dd" id="birth_dd" data-max="31" data-min="1" data-step="1">
			                            <div class="add-on"> 
			                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
			                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
			                            </div>
			                         </div>
								</div>
	                			<div class="uk-width-small-1-3 uk-width-1-1">              		
			                		{!! Form::label('birth_yy', 'Year',array('class'=>'lbl small light' )); !!}
		                			<div class="input-append  spinner" data-trigger="spinner">
			                            <input type="text" value="{!!date('Y')!!}" name="birth_yy" id="birth_yy" data-max="{!!date('Y')!!}" data-min="1950" data-step="1">
			                            <div class="add-on"> 
			                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
			                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
			                            </div>
			                         </div>
								</div>
	                		</div> 
	                	</div>

	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('username', 'Username',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::text('username',"JMDOE2016",array('id'=>'username','class'=>'text')) !!}
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('password', 'Password',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::password('password',array('id'=>'password','class'=>'text')) !!}
	                	</div>
	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	
	<section id="banking-info" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-briefcase uk-icon-justify"></i> <span class="title-text">Banking Information</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#banking-info-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="banking-info-panel">
			<div class="uk-grid">
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('bank_name', 'Bank Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('bank_name',"",array('id'=>'bank_name','required','class'=>'text')) !!}
        			</div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('account_no', 'Account Number',array('class'=>'lbl' )); !!}
            			{!! Form::text('account_no',"",array('id'=>'account_no','required','class'=>'text')) !!}
        			</div>
        			<div class="uk-vertical-divider full-width uk-margin"></div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('type_of_account', 'Type Of Account',array('class'=>'lbl' )); !!}
						{!! Form::text('type_of_account',"1",array('id'=>'type_of_account','required','class'=>'text')) !!}
    				</div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('routing_no', 'Routing Number',array('class'=>'lbl' )); !!}
						{!! Form::text('routing_no',"",array('id'=>'routing_no','required','class'=>'text')) !!}
    				</div>	
        			<div class="uk-vertical-divider full-width uk-margin"></div>

	                    <div class="uk-panel-content address-info-content">

	                    	<div class="uk-grid">
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<h3 class="full-width border-bottom">Banking Address</h3>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_street', ' Street',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_street',"500 West Broadway",array('id'=>'banking_street','required','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_city', '* City',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_city',"San Diego",array('id'=>'banking_city','required','class'=>'text')) !!}
	                			</div>	                			
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_state', '* State',array('class'=>'lbl' )); !!}
	                    			<span class="select-wrapper">
										{!! Form::stateSelect('consumer[billing_state]', "CA", ["class" => ""]) !!}
									</span>
	                			</div>
	                			<div class="uk-width-large-1-4  uk-width-1-2 ">
	                				{!! Form::label('banking_zip', '* Zip',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_zip',"92101",array('id'=>'banking_zip','required','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-vertical-divider full-width uk-margin"></div>

	                		</div>

	    					
	    					
						</div>						

        	</div>
	    </div> 
	</section> 
	<section id="shipping-info" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-briefcase uk-icon-justify"></i> <span class="title-text">Shipping Information</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#shipping-info-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="shipping-info-panel">
	                    <div class="uk-panel-content address-info-content">

	                    	<div class="uk-grid">
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<h3 class="full-width border-bottom">Shipping Address</h3>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('shipping_street', ' Street',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('shipping_street',"500 West Broadway",array('id'=>'shipping_street','required','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('shipping_city', '* City',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('shipping_city',"San Diego",array('id'=>'shipping_city','required','class'=>'text')) !!}
	                			</div>	                			
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('shipping_state', '* State',array('class'=>'lbl' )); !!}
	                    			<span class="select-wrapper">
										{!! Form::stateSelect('consumer[billing_state]', "CA", ["class" => ""]) !!}
									</span>
	                			</div>
	                			<div class="uk-width-large-1-4  uk-width-1-2 ">
	                				{!! Form::label('shipping_zip', '* Zip',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('shipping_zip',"92101",array('id'=>'shipping_zip','required','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-vertical-divider full-width uk-margin"></div>

	                		</div>

	    					
	    					
						</div>	
        	</div>
	</section> 
	<section id="credit-card-info" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-card ion ion-card uk-icon-justify"></i> <span class="title-text">Credit Card Information</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#credit-card-info-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="credit-card-info-panel">
			<div class="uk-grid">
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('first_name', 'First Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('first_name',"",array('id'=>'first_name','required','class'=>'text')) !!}
        			</div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('last_name', 'Last Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('last_name',"",array('id'=>'last_name','required','class'=>'text')) !!}
        			</div>
        			<div class="uk-vertical-divider full-width uk-margin"></div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('cc_no', 'Credit Card Number',array('class'=>'lbl' )); !!}
            			{!! Form::text('cc_no',"",array('id'=>'cc_no','required','class'=>'text')) !!}
        			</div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('cvv', 'CVV',array('class'=>'lbl' )); !!}
						{!! Form::text('cvv',"1",array('id'=>'cvv','required','class'=>'text')) !!}
    				</div>

        			<div class="uk-vertical-divider full-width uk-margin"></div>
        			<div class="uk-width-1-1">
        				{!! Form::label('cc_exp_mm', 'Expiration Date',array('class'=>'lbl' )); !!}  
        			</div>
        			<div class="uk-width-small-1-3 uk-width-1-1">  
        				          		
                		{!! Form::label('cc_exp_mm', 'Month',array('class'=>'lbl small light' )); !!}
            			<span class="select-wrapper">
							{!! Form::selectMonth('cc_exp_mm', 12, ['class' => 'field']) !!}
						</span>
					</div>
        			<div class="uk-width-small-1-3 uk-width-1-1">              		
                		{!! Form::label('bcc_exp_yy', 'Year',array('class'=>'lbl small light' )); !!}
            			<div class="input-append  spinner" data-trigger="spinner">
                            <input type="text" value="{!!date('Y')!!}" name="bcc_exp_yy" id="bcc_exp_yy" data-max="{!!date('Y')!!}" data-min="1950" data-step="1">
                            <div class="add-on"> 
                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                            </div>
                         </div>
					</div>
					<div class="uk-width-small-1-3 uk-width-1-1 ">
    					{!! Form::label('invite_code', 'Invite Code',array('class'=>'lbl small light' )); !!}
						{!! Form::text('invite_code',"",array('id'=>'invite_code','required','class'=>'text')) !!}
    				</div>	
        			<div class="uk-vertical-divider full-width uk-margin"></div>						

        	</div>
	    </div>
	</section> 

	    <div class="button-container button-container-bottom">
	    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save Profile',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
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
