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
    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
    </div>    
    
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
