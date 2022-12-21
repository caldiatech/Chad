@extends('layouts._front.dashboard')

@section('content')	

   {!! Form::open(array('url' => '/dashboard/customer/settings', 'method' => 'post',  'class' => '','id'=>'profile_edit_form ')) !!}
    <div class="button-container button-container-top">
    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save ',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
    </div>    

    @if (Session::has('success'))
       		<div class="uk-alert uk-alert-success uk-margin-large-top">{!!Session::get('success')!!}</div>
    @endif
	   <section id="profile-settings" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-wrench ion ion-settings uk-icon-justify"></i> <span class="title-text">Settings</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-settings-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="profile-settings-panel">
			<div class="uk-grid" >
	            <div class="uk-width-small-1-1 ">
	                <div class="uk-grid uk-panel uk-panel-box normal">
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label  class="table-text">Mobile Alerts</label>
	                	</div>
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal" data-uk-button-checkbox>	     
	                		<input type="hidden" name="mobile_alerts_value" id="mobile_alerts_value" value={{ $client->fldClientMobileAlerts }}>           		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle {{ $client->fldClientMobileAlerts == 1 ? 'uk-active' : '' }}" name="mobile_alerts" id="mobile_alerts" onClick="mobileAlerts()" type="button"> 
	                			
	                			<span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> 
	                			<span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text">Email Alerts</label>
	                	</div>
	                	<div class="uk-width-large-1-4 uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal" data-uk-button-checkbox>	    
	                		<input type="hidden" name="email_alerts_value" id="email_alerts_value" value="{{ $client->fldClientEmailAlerts }}">	            		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle {{ $client->fldClientEmailAlerts == 1 ? 'uk-active' : '' }}" onClick="emailAlerts()" type="button" name="email_alerts" id="email_alerts" > 
	                				<span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> 
	                				<span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>

	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('username', 'Username',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::text('email',$client->fldClientEmail,array('id'=>'username','class'=>'text')) !!}
	                    	@if($errors->settings->first('email'))
                               <div class="uk-text-danger">{!!$errors->settings->first('email')!!}</div>
                            @endif
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('password', 'Password',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::password('password',array('id'=>'password','class'=>'text')) !!}
	                    	
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('promo_code', 'Promo Code',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::text('promo_code',$client->fldClientPromoCode,array('id'=>'promo_code','class'=>'text','disabled'=>'disabled')) !!}
	                	</div>
	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

 

	    <div class="button-container button-container-bottom">
	    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save ',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
	    </div> 

	  {!! Form::close() !!} 
@stop


@section('headercodes')
  
@stop

 
@section('extracodes')  
 {{-- */ /* */ /* --}}
	<script>
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

	{!! Html::script('_front/assets/js/jquery.min.js') !!}    
    
@stop
