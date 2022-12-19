@extends('layouts._front.dashboard')

@section('content')


   {!! Form::open(array('url' => '/dashboard/customer/edit-profile', 'method' => 'post',  'class' => '','id'=>'profile_edit_form','files' => true)) !!}
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
                					{!! Form::label('phone', '* Phone Number',array('class'=>'lbl' )); !!}
                					{!! Form::text('phone', $client->fldClientContact, array('id'=>'phone','required','class'=>'text phone_us')) !!}
	    							{{-- Form::text('phone',$client->fldClientContact,array('id'=>'phone','class'=>'text','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) --}}
	    							@if($errors->updateProfile->first('phone'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('phone')!!}</div>
                                    @endif
                				</div>
	    						<div class="uk-width-small-1-2 uk-width-1-1 ">
                					{!! Form::label('email', '* Email Address',array('class'=>'lbl' )); !!}
	    							{!! Form::email('email',$client->fldClientEmail,array('id'=>'email','class'=>'text','required','readonly','style'=>'background-color: #F4EDE8;')) !!}
	    							@if($errors->updateProfile->first('email'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('email')!!}</div>
                                    @endif
                                    @if (Session::has('emailError'))
                                    	 <div class="uk-text-danger">{{Session::get('emailError')}}</div>
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
										{!! Form::select('state',array('' => 'Select one')+App\Models\State::displayState(),isset($client->fldClientState) ? $client->fldClientState : "",array('id'=>'state','data-placeholder'=>'Select State', 'class'=>'required')) !!}
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
					<div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new uk-thumbnail" style="width: 200px; height: 150px;">
                                      @if($client->fldClientImage != "")
                                        {!! Html::image(CUSTOMER_IMAGE_PATH.$client->fldClientID.'/'.MEDIUM_IMAGE.$client->fldClientImage,'',array('style'=>'width: 200px; height: 140px;')) !!}
                                      @endif
                                  </div>
                                  <div class="fileinput-preview fileinput-exists uk-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                  <div>
                                    <span class="uk-button uk-button-default btn-file">
                                      <span class="fileinput-new">Select image</span>
                                      <span class="fileinput-exists">Change</span>
                                      <input type="file" name="image"></span>
                                  </div>


                              <br class="small"><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ PROFILE_IMAGE_WIDTH }}px x {{ PROFILE_IMAGE_HEIGHT }}px</span>

                                @if($errors->updateProfile->first('image') && $errors->updateProfile->first('image')!="validation.img_min_size")
                                    <div class="uk-text-danger">{!!$errors->updateProfile->first('image')!!}</div>
                                @endif
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
										<select class="field" name="birth_month">
											<option value=""></option>
											<option value="1" {{ $birthDate[0] == 1 ? "selected=selected" : "" }}>January</option>
											<option value="2" {{ $birthDate[0] == 2 ? "selected=selected" : "" }}>February</option>
											<option value="3" {{ $birthDate[0] == 3 ? "selected=selected" : "" }}>March</option>
											<option value="4" {{ $birthDate[0] == 4 ? "selected=selected" : "" }}>April</option>
											<option value="5" {{ $birthDate[0] == 5 ? "selected=selected" : "" }}>May</option>
											<option value="6" {{ $birthDate[0] == 6 ? "selected=selected" : "" }}>June</option>
											<option value="7" {{ $birthDate[0] == 7 ? "selected=selected" : "" }}>July</option>
											<option value="8" {{ $birthDate[0] == 8 ? "selected=selected" : "" }}>August</option>
											<option value="9" {{ $birthDate[0] == 9 ? "selected=selected" : "" }}>September</option>
											<option value="10" {{ $birthDate[0] == 10 ? "selected=selected" : "" }}>October</option>
											<option value="11" {{ $birthDate[0] == 11 ? "selected=selected" : "" }}>November</option>
											<option value="12" {{ $birthDate[0] == 12 ? "selected=selected" : "" }}>December</option>
										</select>
									</span>
								</div>
	                			<div class="uk-width-small-1-3 uk-width-1-1">
			                		{!! Form::label('birth_dd', 'Day',array('class'=>'lbl small light' )); !!}
		                			<div class="input-append spinner" data-trigger="spinner">
			                            <input type="text" value="{{ $birthDate[1] }}" name="birth_date" id="birth_dd" data-max="31" data-min="" data-step="1">
			                            <div class="add-on">
			                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
			                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
			                            </div>
			                         </div>
								</div>
	                			<div class="uk-width-small-1-3 uk-width-1-1">
			                		{!! Form::label('birth_yy', 'Year',array('class'=>'lbl small light' )); !!}
			                		@if($birthDate[2] == "0")
			                			<input type="text" value="" name="birth_year" id="birth_yy" class="text">
			                		@else
			                			<div class="input-append  spinner" data-trigger="spinner">
				                            <input type="text" value="{{ $birthDate[2] }}" name="birth_year" id="birth_yy" data-max="{!!date('Y')!!}" data-min="" data-step="1">
				                            <div class="add-on">
				                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
				                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
				                            </div>
				                         </div>
				                    @endif
								</div>
	                		</div>
	                	</div>

	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('username', 'Username',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::text('username',$client->fldClientEmail,array('id'=>'username','class'=>'text','required','readonly','style'=>'background-color: #F4EDE8;')) !!}

	                    	@if($errors->updateProfile->first('username'))
                            	<div class="uk-text-danger">{!!$errors->updateProfile->first('username')!!}</div>
                            @endif
                            @if (Session::has('usernameError'))
                            	<div class="uk-text-danger">{{Session::get('usernameError')}}</div>
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

								@if($errors->updateProfile->first('password'))
                                        <div class="uk-text-danger">{!!$errors->updateProfile->first('password')!!}</div>
                             @endif
	                	</div>

	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	<? /*
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
            			{!! Form::text('bank_name',$client->fldClientBankName,array('id'=>'bank_name','class'=>'text')) !!}
        			</div>
        			<div class="uk-width-large-1-2 uk-width-1-2 ">
        				{!! Form::label('account_no', 'Account Number (43243348798)',array('class'=>'lbl' )); !!}
            			{!! Form::text('account_no',isset($braintreeMerchant->funding['accountNumberLast4']) ? '*******'.$braintreeMerchant->funding['accountNumberLast4'] : "",array('id'=>'account_no','class'=>'text')) !!}
        			</div>
        			<div class="uk-vertical-divider full-width uk-margin"></div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('type_of_account', 'Type Of Account (Savings)',array('class'=>'lbl' )); !!}
						{!! Form::text('type_of_account',$client->fldClientTypeofAccount,array('id'=>'type_of_account','class'=>'text')) !!}
    				</div>
					<div class="uk-width-small-1-2 uk-width-1-1 ">
    					{!! Form::label('routing_no', 'Routing Number (122100024)',array('class'=>'lbl' )); !!}
						{!! Form::text('routing_no',isset($braintreeMerchant->funding['routingNumber']) ? $braintreeMerchant->funding['routingNumber'] : "",array('id'=>'routing_no','class'=>'text')) !!}
    				</div>
        			<div class="uk-vertical-divider full-width uk-margin"></div>

	                    <div class="uk-panel-content address-info-content">

	                    	<div class="uk-grid">
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<h3 class="full-width border-bottom">Banking Address</h3>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_street', ' Street',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_street',$client->fldBankingAddress,array('id'=>'banking_street','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_city', '* City',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_city',$client->fldBankingCity,array('id'=>'banking_city','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('banking_state', '* State',array('class'=>'lbl' )); !!}
	                    			<span class="select-wrapper">
										{!! Form::select('banking_state',array('0' => 'Select one')+App\Models\State::displayState(),$client->fldBankingState,array('id'=>'state','data-placeholder'=>'Select State', 'class'=>'required')) !!}
									</span>
	                			</div>
	                			<div class="uk-width-large-1-4  uk-width-1-2 ">
	                				{!! Form::label('banking_zip', '* ZIP',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('banking_zip',$client->fldBankingZip,array('id'=>'banking_zip','class'=>'text')) !!}
	                			</div>
	                			<div class="uk-vertical-divider full-width uk-margin"></div>

	                		</div>

						</div>

        	</div>
	    </div>
	</section>
	*/ ?>


	<section id="shipping-info" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-briefcase uk-icon-justify"></i> <span class="title-text">Shipping Information</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#shipping-info-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="shipping-info-panel">
	                    <div class="uk-panel-content address-info-content">

	                    	<div class="uk-grid">
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	                			<h3 class="full-width border-bottom">Shipping Address</h3>
	                			<div class="uk-width-large-1-4 uk-width-1-2 ">
	                				{!! Form::label('shipping_address', '* Street',array('class'=>'lbl' )); !!}
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
										{!! Form::select('shipping_state',array('' => 'Select one')+App\Models\State::displayState(),isset($shipping->fldClientsShippingState) ? $shipping->fldClientsShippingState : "",array('id'=>'state','data-placeholder'=>'Select State', 'class'=>'required')) !!}
									</span>
									@if($errors->updateProfile->first('shipping_state'))
                                       		 <div class="uk-text-danger">{!!$errors->updateProfile->first('shipping_state')!!}</div>
                             			@endif
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

	<? /*
	<section id="credit-card-info" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-card ion ion-card uk-icon-justify"></i> <span class="title-text">Credit Card Information</span>
    		 @if($client->fldClientBraintreeCustomerID != "")
    			({{ $client->fldClientBraintreeCustomerID }})
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
						{!! Form::text('cvv',$client->fldClientCVV,array('id'=>'cvv','class'=>'text')) !!}
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
	    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save Profile',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!}
	    </div>

	  {!! Form::close() !!}
@stop


@section('headercodes')
 <script>
 var url ="{{url('')}}";
	</script>
	{!! Html::style('_front/plugins/jasny/css/jasny-bootstrap.min.css') !!}
	{!! Html::style('_front/plugins/password/strength.css') !!}
@stop


@section('extracodes')
 {{-- */ /* */ /* --}}
 	{!! Html::script('_front/assets/js/mask.js') !!}
    {!! Html::script('_front/plugins/password/strength.js') !!}

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
    {!! Html::script('_front/plugins/jasny/js/jasny-bootstrap.min.js') !!}

	<script>
		$(document).ready(function(){

			loadScript("{!!url('_front/plugins/spinner/src/jquery.spinner.js')!!}", function(){
		        $('.spinner').spinner('changed',function(e, newVal, oldVal){

		        });
		 	});

            isphone_valid = 0;
            $('.phone_us').mask('(000) 000-0000',{
              onComplete: function(cep) {
                $('.phone_us').css({'border':'1px solid green'});
                isphone_valid = 1;
              }, onInvalid: function(cep) {
                $('.phone_us').css({'border':'1px solid red'});
                isphone_valid = 0;
              }
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




	</script>


@stop
