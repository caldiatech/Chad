@extends('layouts._front.dashboard')

@section('content')
      	

   {!! Form::open(array('url' => '/dashboard/customer/edit-profile', 'method' => 'post',  'class' => '','id'=>'profile_edit_form')) !!}
    <div class="button-container button-container-top">
    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save Profile',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 


    </div>    
    	@if (Session::has('success'))
       		<div class="uk-alert uk-alert-success uk-margin-large-top">{!!Session::get('success')!!}</div>
    	@endif
	@if (Session::has('braintree-error'))
       		<div class="uk-alert uk-alert-danger uk-margin-large-top">{!!Session::get('braintree-error')!!}</div>
    	@endif 	 	
    <section id="profile" class="section">
    	
    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-justify"></i> <span class="title-text">Profile</span>  <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="profile-panel">
			<div class="uk-grid" >
	            <div class="uk-width-large-1-1 uk-width-small-1-1 ">
	                <div class="uk-panel uk-panel-box">
	                	<div class="uk-grid">
	                			<div class="uk-width-large-1-2 uk-width-1-2 ">
	                				{!! Form::label('firstname', '* First Name',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('firstname',$client->fldClientFirstname,array('id'=>'firstname','class'=>'text')) !!}
	                    			@if($errors->updateProfile->first('firstname'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('firstname')!!}</div>
                                    @endif
	                			</div>
	                			<div class="uk-width-large-1-2 uk-width-1-2 ">
	                				{!! Form::label('lastname', '* Last Name',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('lastname',$client->fldClientLastname,array('id'=>'lastname','class'=>'text')) !!}
	                    			@if($errors->updateProfile->first('lastname'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('lastname')!!}</div>
                                    @endif
	                			</div>
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	    						<div class="uk-width-small-1-2 uk-width-1-1 ">
                					{!! Form::label('phone', '* Contact #',array('class'=>'lbl' )); !!}
	    							{!! Form::text('phone',$client->fldClientContact,array('id'=>'phone','class'=>'text')) !!}
	    							@if($errors->updateProfile->first('phone'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('phone')!!}</div>
                                    @endif
                				</div>
	    						<div class="uk-width-small-1-2 uk-width-1-1 ">
                					{!! Form::label('email', '* Email Address',array('class'=>'lbl' )); !!}
	    							{!! Form::email('email',$client->fldClientEmail,array('id'=>'email','class'=>'text')) !!}
	    							@if($errors->updateProfile->first('email'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('email')!!}</div>
                                    @endif
                				</div>	
	                			<div class="uk-vertical-divider full-width uk-margin"></div>						

	                	</div>
	                    
	                    <div class="uk-panel-content address-info-content">

	                    	<div class="uk-grid">
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<h3 class="full-width border-bottom">Address Information</h3>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('address', ' * Street',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('address',$client->fldClientAddress,array('id'=>'address','class'=>'text')) !!}
	                    			@if($errors->updateProfile->first('address'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('address')!!}</div>
                                    @endif
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('city', '* City',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('city',$client->fldClientCity,array('id'=>'city','class'=>'text')) !!}
	                    			@if($errors->updateProfile->first('city'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('city')!!}</div>
                                    @endif
	                			</div>	                			
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('state', '* State',array('class'=>'lbl' )); !!}
	                    			<span class="select-wrapper">										
										{!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),isset($client->fldClientState) ? $client->fldClientState : "0",array('id'=>'state','data-placeholder'=>'Select State', 'class'=>'required')) !!}
									</span>
									@if($errors->updateProfile->first('state'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('state')!!}</div>
                                    @endif
	                			</div>
	                			<div class="uk-width-large-1-4  uk-width-1-2 ">
	                				{!! Form::label('zip', '* ZIP',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('zip',$client->fldClientZip,array('id'=>'zip','class'=>'text')) !!}
	                    			@if($errors->updateProfile->first('zip'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('zip')!!}</div>
                                    @endif
	                			</div>
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<div class="uk-width-1-2 ">
	                				{!! Form::label('career', 'Career',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('career',$client->fldClientCareer,array('id'=>'career','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-1-2 ">
	                				{!! Form::label('authorization', 'Authorization',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('authorization',$client->fldClientAuthorization,array('id'=>'authorization','class'=>'text')) !!}
	                			</div>

	                		</div>

	    					
	    					
						</div>
	                </div>
	            </div>
	           </div>
	       </div>
	   </section>
	   <section id="profile-image" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-camera-retro uk-icon-justify"></i> <span class="title-text">Profile Image</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-image-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="profile-image-panel">
			<div class="uk-grid" >	            
    			<div class="uk-width-large-1-4  uk-width-1-2">
					<div class="margin-top-large padding-v-small full-width padding-h-small add-a-photo">
						<i class="ionicons ion-ios-person cover"></i>
						<div id="mulitplefileuploader" class="pull-left uk-button  uk-button-primary " style="color:#ffffff">
							<i class="uk-icon-plus"></i> <span class="upload-text">Add a photo</span>
						</div>			
					</div>
					{!! Form::label('profileimgdimension', '2MB | .png, .jpg, .gif',array('class'=>'full-width small uk-text-small fsize-14 grey' )); !!}
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
	                		<input type="hidden" name="mobile_alerts_value" id="mobile_alerts_value" value={{ $client->fldClientMobileAlerts }}>	

	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle {{ $client->fldClientMobileAlerts == 1 ? 'uk-active' : '' }}" name="mobile_alerts" id="mobile_alerts" type="button" onClick="mobileAlerts()"> 
	                			<span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> 
	                			<span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text">Email Alerts</label>
	                	</div>
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal" data-uk-button-checkbox>	     <input type="hidden" name="email_alerts_value" id="email_alerts_value" value="{{ $client->fldClientEmailAlerts }}">	           		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle {{ $client->fldClientEmailAlerts == 1 ? 'uk-active' : '' }}" name="email_alerts" id="email_alerts" type="button" onClick="emailAlerts()"> 
	                			<span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> 
	                			<span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
	                	<? /* Note: no need to include the promo code on edit profile because it is auto generated
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('promo_code', 'Promo Code',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::text('promo_code',$client->fldClientPromoCode,array('id'=>'promo_code','class'=>'text')) !!}
	                	</div>
	                	*/ ?>
	                	<div class="uk-width-small-1-1 uk-width-1-1 uk-padding-v-normal">	
	                		<div class="uk-grid"> 
	                			{!! Form::label('birthday', 'Birthday',array('class'=>'lbl table-text light' )); !!}
	                			<div class="uk-width-small-1-3 uk-width-1-1">              		
			                		{!! Form::label('birth_mm', 'Month',array('class'=>'lbl small light' )); !!}
		                			<span class="select-wrapper">
										{!! Form::selectMonth('birth_month', $birthDate[0],  ['class' => 'field']) !!}
									</span>
								</div>
	                			<div class="uk-width-small-1-3 uk-width-1-1">              		
			                		{!! Form::label('birth_dd', 'Day',array('class'=>'lbl small light' )); !!}
		                			<div class="input-append spinner" data-trigger="spinner">
			                            <input type="text" value="{{ $birthDate[1] }}" name="birth_date" id="birth_dd" data-max="31" data-min="1" data-step="1">
			                            <div class="add-on"> 
			                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
			                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
			                            </div>
			                         </div>
								</div>
	                			<div class="uk-width-small-1-3 uk-width-1-1">              		
			                		{!! Form::label('birth_yy', 'Year',array('class'=>'lbl small light' )); !!}
		                			<div class="input-append  spinner" data-trigger="spinner">
			                            <input type="text" value="{{ $birthDate[2] }}" name="birth_year" id="birth_yy" data-max="{!!date('Y')!!}" data-min="1950" data-step="1">
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
	                    	{!! Form::text('username',$client->fldClientEmail,array('id'=>'username','class'=>'text')) !!}
	                    	@if($errors->updateProfile->first('username'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('username')!!}</div>
                             @endif
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
    	<h2 class="section-header uk-h2"><i class="uk-icon-briefcase uk-icon-justify"></i> <span class="title-text">Banking Information</span>
    		@if($client->fldClientBraintreeMerchantID != "")
    			({{ $client->fldClientBraintreeMerchantID }})
    		@endif
    	 <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#banking-info-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="banking-info-panel">
			<div class="uk-grid">
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('bank_name', 'Bank Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('bank_name',"",array('id'=>'bank_name','class'=>'text')) !!}
        			</div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('account_no', 'Account Number (43243348798)',array('class'=>'lbl' )); !!}
            			{!! Form::text('account_no',"",array('id'=>'account_no','class'=>'text')) !!}
        			</div>
        			<div class="uk-vertical-divider full-width uk-margin"></div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('type_of_account', 'Type Of Account (Savings)',array('class'=>'lbl' )); !!}
						{!! Form::text('type_of_account',"",array('id'=>'type_of_account','class'=>'text')) !!}
    				</div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('routing_no', 'Routing Number (122100024)',array('class'=>'lbl' )); !!}
						{!! Form::text('routing_no',"",array('id'=>'routing_no','class'=>'text')) !!}
    				</div>	
        			<div class="uk-vertical-divider full-width uk-margin"></div>

	                    <div class="uk-panel-content address-info-content">

	                    	<div class="uk-grid">
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<h3 class="full-width border-bottom">Banking Address</h3>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_street', ' Street',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_street',"",array('id'=>'banking_street','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_city', '* City',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_city',"",array('id'=>'banking_city','class'=>'text')) !!}
	                			</div>	                			
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_state', '* State',array('class'=>'lbl' )); !!}
	                    			<span class="select-wrapper">										
										{!! Form::select('banking_state',array('0' => 'Select one')+App\Models\State::displayState(),0,array('id'=>'state','data-placeholder'=>'Select State', 'class'=>'required')) !!}
									</span>
	                			</div>
	                			<div class="uk-width-large-1-4  uk-width-1-2 ">
	                				{!! Form::label('banking_zip', '* ZIP',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_zip',"",array('id'=>'banking_zip','class'=>'text')) !!}
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
	                				{!! Form::label('shipping_address', ' Street',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('shipping_address',isset($shipping->fldClientsShippingAddress) ? $shipping->fldClientsShippingAddress : "",array('id'=>'shipping_street','class'=>'text')) !!}
	                    			@if($errors->updateProfile->first('shipping_address'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('shipping_address')!!}</div>
                             		@endif
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('shipping_city', '* City',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('shipping_city',isset($shipping->fldClientsShippingCity) ?  $shipping->fldClientsShippingCity : "",array('id'=>'shipping_city','class'=>'text')) !!}
	                    			@if($errors->updateProfile->first('shipping_city'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('shipping_city')!!}</div>
                             		@endif
	                			</div>	                			
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('shipping_state', '* State',array('class'=>'lbl' )); !!}
	                    			<span class="select-wrapper">
										{!! Form::select('shipping_state',array('0' => 'Select one')+App\Models\State::displayState(),isset($shipping->fldClientsShippingState) ? $shipping->fldClientsShippingState : "0",array('id'=>'state','data-placeholder'=>'Select State', 'class'=>'required')) !!}
										@if($errors->updateProfile->first('shipping_state'))
                                       		 <div class="uk-text-danger">{!!$errors->updateProfile->first('shipping_state')!!}</div>
                             			@endif
									</span>
	                			</div>
	                			<div class="uk-width-large-1-4  uk-width-1-2 ">
	                				{!! Form::label('shipping_zip', '* ZIP',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('shipping_zip',isset($shipping->fldClientsShippingCity) ? $shipping->fldClientsShippingZip : "",array('id'=>'shipping_zip','class'=>'text')) !!}
	                    				@if($errors->updateProfile->first('shipping_zip'))
                                       		 <div class="uk-text-danger">{!!$errors->updateProfile->first('shipping_zip')!!}</div>
                             			@endif
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
        				{!! Form::label('cc_firstname', 'First Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('cc_firstname',"",array('id'=>'cc_firstname','class'=>'text')) !!}
        			</div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('cc_lastname', 'Last Name',array('class'=>'lbl' )); !!}
            			{!! Form::text('cc_lastname',"",array('id'=>'cc_lastname','class'=>'text')) !!}
        			</div>
        			<div class="uk-vertical-divider full-width uk-margin"></div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('cc_no', 'Credit Card Number (378282246310005)',array('class'=>'lbl' )); !!}
            			{!! Form::text('cc_no',"",array('id'=>'cc_no','class'=>'text')) !!}
        			</div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('cvv', 'CVV (1234)',array('class'=>'lbl' )); !!}
						{!! Form::text('cvv',"1",array('id'=>'cvv','class'=>'text')) !!}
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
						{!! Form::text('invite_code',"",array('id'=>'invite_code','class'=>'text')) !!}
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
 <script>
 var url ="{{url('')}}";
	</script>
@stop

 
@section('extracodes')  
 {{-- */ /* */ /* --}}
	<script>
		$(document).ready(function(){
						
			loadScript("{!!url('_front/plugins/spinner/src/jquery.spinner.js')!!}", function(){        
		        $('.spinner').spinner('changed',function(e, newVal, oldVal){
		          
		        });
		 	});

			loadScript("{!!url('_front/plugins/upload/jquery.uploadfile.min.js')!!}", function(){    
				load_uploaded_images();
				var uploadObj = $("#mulitplefileuploader").uploadFile({ 
					url: "{{url('_front/plugins/upload/upload.php')}}",
					multiple:false,
					dragDrop:false,
					maxFileCount:1,
					fileName: "myfile",
					allowedTypes:"jpg,png,gif",
					showPreview:true,
					showAbort:false,
					showDone:false,
					showStatusAfterSuccess:false,
					showFileCounter:false,
					showQueueDiv:false,
					dynamicFormData: function()
					{
						var data = { owner:"16", dashboard:'{{$pages->category}}'}

						return data;
					},	
					onSuccess:function(files,data,xhr)
					{

						load_uploaded_images();

					}
				});
			});			
			
		});

		function mobileAlerts() {
			var mobileValue;
			if($("#mobile_alerts").hasClass("uk-active")) {
				mobileValue = 0;
			} else {
				mobileValue = 1;
			}

			$("#mobile_alerts_value").val(mobileValue);
		}

		function emailAlerts() {
			var emailValue;
			if($("#email_alerts").hasClass("uk-active")) {
				emailValue = 0;
			} else {
				emailValue = 1;
			}

			$("#email_alerts_value").val(emailValue);	
		}

		function load_uploaded_images(){
		 $.ajax({
			cache: false,
			url: "{{ url('_front/plugins/upload/load.php?owner=16')}}&dashboard={{$pages->category}}",
			dataType: "json",
		
			success: function(data) 
			{
			
				//showoldupload
				var imagesctr = 0; var primary_class = 'primary-image';
				for(var i=0;i<data.length;i++)
				{
					imagesctr++;
					var image_name = data[i]["name"];				
						var primary_class = '';
					
						if(imagesctr >= 1){ 
							$('.add-a-photo').addClass('has-image');
							$('.add-a-photo').css({'background-image':"url(' public/"+data[i]["path"]+"/"+data[i]["name"]+"')"});
							$('.add-a-photo .ajax-file-upload .upload-text').html('Change Photo');

						}
					
				}
			}
		 });
		
		}
	
	</script>
@stop
