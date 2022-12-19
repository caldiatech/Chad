@extends('layouts._front.dashboard')

@section('content')
    <section id="profile" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-justify"></i> <span class="title-text">Profile</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a> <a href="{{url('dashboard/'.$pages->category.'/edit-profile')}}" class="icon-button-wrapper white uk-float-right light"><i class=" icon-image uk-icon-pencil ion ion-edit uk-icon-justify"></i> <span class="light">Edit</span></a>  </h2>
    	<div class="section-content" id="profile-panel">
			<div class="uk-grid" >
	            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
	                <div class="uk-panel uk-panel-box">
	                    <h3 class="uk-panel-title light uk-h1 light">{{ $client->fldClientFirstname }} {{ $client->fldClientLastname }}</h3>
	                    <div class="uk-panel-content">
	                    	<p><i class="uk-icon-map-marker uk-icon-justify">&nbsp; </i> <span class="uk-margin-small-left">{{ $client->fldClientAddress }} {{ $client->fldClientCity }} {{ $client->fldClientCity != '' ? ',' : '' }} {{ $client->fldClientState }} {{ $client->fldClientState != '' ? ',' : '' }} {{ $client->fldClientZip }}</span></p>
	    					<p><i class="uk-icon-briefcase uk-icon-justify">&nbsp; </i> <span class="uk-margin-small-left">{{ $client->fldClientCareer }}</span></p>
	    					<div class="uk-vertical-divider full-width uk-margin"></div>
	    					<div class="full-width uk-margin">
	    						<div class="uk-grid uk-text-14">
		    						<div class="uk-width-small-1-2 max-width-200 uk-width-1-1 normal">Contact #</div>
		    						<div class="uk-width-small-1-2 uk-width-1-1">{{ $client->fldClientContact }}</div>
		    						<div class="uk-vertical-divider full-width uk-margin"></div>
		    						<div class="uk-width-small-1-2 max-width-200 uk-width-1-1 normal">Email Address</div>
		    						<div class="uk-width-small-1-2 uk-width-1-1">{{ $client->fldClientEmail }}</div>	
								</div>
	    					</div>
	    					
						</div>
	                </div>
	            </div>
	            <div class="uk-width-large-4-10 uk-width-small-1-1 ">
	                <div class="uk-grid uk-panel uk-panel-box normal col-2-left-label">
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label  class="table-text">Mobile Alerts</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal" data-uk-button-checkbox>	                		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle {{ $client->fldClientMobileAlerts == 1 ? 'uk-active' : '' }}"> 
	                				<span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> 
	                				<span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Email Alerts</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4 uk-width-1-2 uk-padding-v-normal" data-uk-button-checkbox>	                		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle {{ $client->fldClientEmailAlerts == 1 ? 'uk-active' : '' }}"> 
	                			<span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> 
	                			<span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Promo Code</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">{{ $client->fldClientPromoCode != "" ? $client->fldClientPromoCode : "&nbsp;" }}</label>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Birthday</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">{{ $client->fldClientBirthday == "0000-00-00" || $client->fldClientBirthday=="" ? "&nbsp;" : date('F d, Y',strtotime($client->fldClientBirthday)) }}</label>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Username</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">{{ $client->fldClientEmail }}</label>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Password</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">&#8226;&#8226;&#8226;&#8226;&#8226;</label>
	                	</div>

	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
    <section id="order-history" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-shopping-bag  icon-stack-parent white uk-icon-justify"><i class="uk-icon-check-circle-o icon-small-append icon-bottom icon-right"></i></i> <span class="title-text">Order History</span><a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#order-history-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a> <a href="{{url('dashboard/'.$pages->category.'/order-history')}}" class="icon-button-wrapper white uk-float-right light"><i class=" icon-image uk-icon-eye ion ion-ios-eye-outline uk-icon-justify"></i> <span class="light">View</span></a></h2>
    	<div class="section-content uk-table" id="order-history-panel">
			<div class="uk-grid uk-panel uk-panel-box normal">
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Date</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Payments</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Delivery Status</label>
            	</div>
            	<div class="uk-width-large-2-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Ship To Address </label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Transaction ID </label>
            	</div>
            	<div class="uk-width-large-3-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Item Details</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Image</label>
            	</div>
            	<div class="uk-vertical-divider full-width  uk-visible-large"></div>
            	
            	@foreach($cart as $carts)
            	
            	<div class="uk-width-large-1-10  uk-width-small-1-2  uk-width-1-1 uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Date</span>{!!date('m/d/Y',strtotime($carts->order_date)) !!}</label>
            	</div>
            	<div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Payments</span>${!!$carts->product_price != "" ? number_format($carts->product_price,2) : 0.00!!}</label>
            	</div>
            	<div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text"><span class="mobile-label uk-hidden-large">Delivery Status</span>
            				<span class="text-underline">Tracking #</span> 
            				<span class="light">Not Yet Shipped</span> 
            		</label>
            	</div>
            	<div class="uk-width-large-2-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Ship To Address</span>{!!$carts->fldClientsShippingAddress . ' ' . $carts->fldClientsShippingAddress1 . ', ' . $carts->fldClientsShippingCity . ' ' . $carts->fldClientsShippingState . ' ' . $carts->fldClientsShippingZip!!}</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Transaction ID</span>{!!$carts->order_no!!}</label>
            	</div>
            	<div class="uk-width-large-3-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Item Details</span>{!! App\Models\Cart::getImageSize($carts->fldCartImageSize) . ', '. $carts->product_name . ', ' . App\Models\Cart::getFrameAttributes($carts->fldCartFrameDesc) . ', '.App\Models\Cart::getPaperInfo($carts->fldCartPaperInfo) . ', ' . App\Models\Cart::getMat($carts->order_no) !!}</label>
            	</div>
            	<div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Image</span><img src="{!!url(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.SMALL_IMAGE.$carts->image)!!}" alt="Produc t Name" width="39" height="39" />
            	</div>
            	<div class="uk-vertical-divider full-width "></div>
            	@endforeach

	        </div>
	    </div>
	</section>
@stop


@section('headercodes')
 
@stop

 
@section('extracodes')  
 {{-- */ /* */ /* --}}
	<script>
		$(document).ready(function(){
						
			
		
			
		});
	</script>
@stop
