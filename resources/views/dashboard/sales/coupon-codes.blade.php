@extends('layouts._front.dashboard_manager')
@section('content')
   {!! Form::open(array('url' => '/', 'method' => 'post',  'class' => '','id'=>'profile_edit_form', 'onsubmit'=>'return false')) !!}
	<section id="profile-settings" class="section">
    	<h2 class="section-header uk-h2"><i class="ion-scissors uk-icon-bordered-dot ion uk-icon-justify"></i> <span class="title-text">Promo Code</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-settings-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content" id="profile-settings-panel">
			<div class="uk-grid" >
	            <div class="uk-width-small-1-1 ">
	                <div class="uk-grid uk-panel uk-panel-box normal">
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">
	                		{!! Form::label('promo_code', 'Promo Code',array('class'=>'lbl table-text light' )); !!}
	                    	{!! Form::text('promo_code',$manager->fldManagerPromoCode,array('id'=>'promo_code','class'=>'text black','disabled'=>'disabled')) !!}
	                	</div>
	                	<!--<div class="uk-width-small-1-2 uk-text-right uk-width-1-1  uk-padding-v-normal">
	                		<label class="lbl grey table-text light"><i class="uk-icon-calendar"></i> remaining.. </label>
	                		{!! Form::label('days_left', $computeDaysLeft. ' days',array('class'=>'lbl grey uk-margin-remove text  light' )); !!}	                		
	                	</div>-->
	                		                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section> 

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
