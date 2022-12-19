@extends('layouts._front.dashboard_manager')

@section('content')

   {!! Form::open(array('url' => '/dashboard/sales/sales-rep/edit/'.$salesRep->fldManagerID, 'method' => 'post',  'class' => '','id'=>'profile_edit_form','files' => true)) !!}
    <div class="button-container button-container-top">
    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save Sales Rep',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
    </div>    
    @if (Session::has('success'))
       		<div class="uk-alert uk-alert-success uk-margin-large-top">{!!Session::get('success')!!}</div>
    @endif
	

    <section id="profile" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-justify"></i> <span class="title-text">Sales Rep</span>  <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="profile-panel">
			<div class="uk-grid" >
	            <div class="uk-width-large-1-1 uk-width-small-1-1 ">
	                <div class="uk-panel uk-panel-box">
	                	<div class="uk-grid">
	                			<div class="uk-width-large-1-2 uk-width-1-2 ">
	                				{!! Form::label('firstname', '* First Name',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('firstname',$salesRep->fldManagerFirstname,array('id'=>'firstname','required','class'=>'text')) !!}
	                    			@if($errors->salesrep->first('firstname'))
                                        <div class="uk-text-danger">{!!$errors->salesrep->first('firstname')!!}</div>
                                    @endif
	                			</div>
	                			<div class="uk-width-large-1-2 uk-width-1-2 ">
	                				{!! Form::label('lastname', '* Last Name',array('class'=>'lbl' )); !!}
	                    			{!! Form::text('lastname',$salesRep->fldManagerLastname,array('id'=>'lastname','required','class'=>'text')) !!}
	                    			@if($errors->salesrep->first('lastname'))
                                        <div class="uk-text-danger">{!!$errors->salesrep->first('lastname')!!}</div>
                                    @endif
	                			</div>
	                			<div class="uk-vertical-divider full-width uk-margin"></div>
	    						<div class="uk-width-small-1-2 uk-width-1-1 ">
                					{!! Form::label('phone', '* Contact #',array('class'=>'lbl' )); !!}
	    							{!! Form::text('phone',$salesRep->fldManagerPhoneNo,array('id'=>'phone','required','class'=>'text phone_us')) !!}
	    							@if($errors->salesrep->first('phone'))
                                        <div class="uk-text-danger">{!!$errors->salesrep->first('phone')!!}</div>
                                    @endif
                				</div>
	    						<div class="uk-width-small-1-2 uk-width-1-1 ">
                					{!! Form::label('email', '* Email Address',array('class'=>'lbl' )); !!}
	    							{!! Form::email('email',$salesRep->fldManagerEmail,array('id'=>'email','required','class'=>'text')) !!}
	    							@if($errors->salesrep->first('email'))
                                        <div class="uk-text-danger">{!!$errors->salesrep->first('email')!!}</div>
                                    @endif
                				</div>	
                				<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
				                		{!! Form::label('password123', '* Password',array('class'=>'lbl table-text light' )); !!}
				                    	{!! Form::password('password',array('id'=>'password_fld','class'=>'text')) !!}
				                    
				                			<table border=0>
		                                        <tr>
		                                            <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passveryweak"></i> at least 8 char</td>
		                                            <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passweak"></i> an uppercase</td>
		                                            <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passmedium"></i> a number</td>
		                                            <td style="padding-right:5px;" class="uk-text-small"> <i class="uk-icon uk-icon-check-circle icon-color" id="passstrong"></i> special char</td>
		                                        </tr>  
		                                    </table>
		                                    @if($errors->salesrep->first('password'))
		                                        <div class="uk-text-danger">{!!$errors->salesrep->first('password')!!}</div>
		                                    @endif	  	

				                	</div>

				                	
	                			<div class="uk-vertical-divider full-width uk-margin"></div>						

	                	</div>
	                    
	                   
	                </div>
	            </div>
	           </div>
	       </div>
	   </section>


	    <div class="button-container button-container-bottom">
	    	{!! Form::button(' <i class="uk-icon-save uk-icon-justify"></i> Save Sales Rep',array('class'=>'uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary ','type'=>'submit','name'=>'submit'))!!} 
	    </div> 

	  {!! Form::close() !!} 
@stop


@section('headercodes')
    {!! Html::style('_front/plugins/password/strength.css') !!}           
 	<script>
 		var url ="{{url('')}}";
	</script>	
	
@stop

 
@section('extracodes')  
 {{-- */ /* */ /* --}}
 	 {!! Html::script('_front/assets/js/mask.js','') !!} 	  
    {!! Html::script('_front/plugins/password/strength.js','') !!}
    
    <script>
      $(document).ready(function($) {
  
          $('#password_fld').strength({
              strengthClass: 'strength',
              strengthMeterClass: 'strength_meter',
              strengthButtonClass: 'button_strength',
              strengthButtonText: 'Show Password',
              strengthButtonTextToggle: 'Hide Password'
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


    </script>    

	
@stop
