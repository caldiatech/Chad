@extends('layouts._front.dashboard')

@section('content')
    <section id="profile" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-justify"></i> <span class="title-text">Profile</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a> <a href="{{url('dashboard/'.$pages->category.'/edit-profile')}}" class="icon-button-wrapper white uk-float-right light"><i class=" icon-image uk-icon-pencil ion ion-edit uk-icon-justify"></i> <span class="light">Edit</span></a>  </h2>
    	<div class="section-content" id="profile-panel">
			<div class="uk-grid" >
	            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
	                <div class="uk-panel uk-panel-box">
	                    <h3 class="uk-panel-title light uk-h1 light">Joseph Michael Doe</h3>
	                    <div class="uk-panel-content">
	                    	<p><i class="uk-icon-map-marker uk-icon-justify">&nbsp; </i> <span class="uk-margin-small-left">500 West Broadway San Diego, California, USA 92101</span></p>
	    					<p><i class="uk-icon-briefcase uk-icon-justify">&nbsp; </i> <span class="uk-margin-small-left">Professional Photographer</span></p>
	    					<div class="uk-vertical-divider full-width uk-margin"></div>
	    					<div class="full-width uk-margin">
	    						<div class="uk-grid uk-text-14">
		    						<div class="uk-width-small-1-2 max-width-200 uk-width-1-1 normal">Contact #</div>
		    						<div class="uk-width-small-1-2 uk-width-1-1">855-235-7234-231</div>
		    						<div class="uk-vertical-divider full-width uk-margin"></div>
		    						<div class="uk-width-small-1-2 max-width-200 uk-width-1-1 normal">Email Address</div>
		    						<div class="uk-width-small-1-2 uk-width-1-1">josephmichael@gmail.com</div>	
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
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle"> <span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> <span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Email Alerts</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4 uk-width-1-2 uk-padding-v-normal" data-uk-button-checkbox>	                		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle"> <span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> <span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Promo Code</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">PQR952Y0</label>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Birthday</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">December 1, 1990</label>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Username</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">JMDOE2016</label>
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
            	<?php 
            		$history_array = array(
								array(
									'date'=>'03/02/2016', 
									'payments'=>92.04, 
									'delivery_status'=>'Tracking #', 
									'ship_address'=>'725 S Bixel St, Los Angeles, CA 90017, USA',
									'transaction_id'=>'CLKN-71239AB-9NC', 
									'item_details'=>'Seaside Mountain View - Classic - 15x25 - Stife Dark Beige - Michael Kenna',
									'image'=>'thumb1.jpg'),
								
								array(
									'date'=>'02/29/2016', 
									'payments'=>192.04, 
									'delivery_status'=>'', 
									'ship_address'=>'725 S Bixel St, Los Angeles, CA 90017, USA',
									'transaction_id'=>'CLKN-012FJT25-51Q', 
									'item_details'=>'Hilltop View - Landscape - 15x25 - White Dashed - Michael Kenna',
									'image'=>'thumb2.jpg'),
								
								array(
									'date'=>'02/29/2016', 
									'payments'=>192.04, 
									'delivery_status'=>'Tracking #',
									'ship_address'=>'725 S Bixel St, Los Angeles, CA 90017, USA',
									'transaction_id'=>'CLKN-71239AB-9NC', 
									'item_details'=>'Lake View - Portrait - 4x9 - White Dashed - - Michael Kenna',
									'image'=>'thumb3.jpg'),
								
								array(
									'date'=>'02/29/2016', 
									'payments'=>192.04, 
									'delivery_status'=>'Tracking #',
									'ship_address'=>'725 S Bixel St, Los Angeles, CA 90017, USA',
									'transaction_id'=>'CLKN-71239AB-9NC', 
									'item_details'=>'Rivers & Waterfalls View - Landscape - 15x25 - Wood Brown Checkered - - Michael Kenna',
									'image'=>'thumb4.jpg'),
								
								array(
									'date'=>'02/29/2016', 
									'payments'=>192.04, 
									'delivery_status'=>'Tracking #',
									'ship_address'=>'725 S Bixel St, Los Angeles, CA 90017, USA',
									'transaction_id'=>'CLKN-71239AB-9NC', 
									'item_details'=>'Seascape - Landscape - 25x15 - Polished Black -- Michael Kenna',
									'image'=>'thumb5.jpg'),
								
								array(
									'date'=>'02/29/2016', 
									'payments'=>192.04, 
									'delivery_status'=>'Tracking #',
									'ship_address'=>'725 S Bixel St, Los Angeles, CA 90017, USA',
									'transaction_id'=>'CLKN-71239AB-9NC', 
									'item_details'=>'Seaside Mountain View - Landscape - 15x25 - White Dashed - Michael Kenna',
									'image'=>'thumb6.jpg')

								);


            	?>
            	@foreach($history_array as $history_item)
            	<?php settype($history_item, 'object');  ?>
            	<div class="uk-width-large-1-10  uk-width-small-1-2  uk-width-1-1 uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Date</span>{!!$history_item->date!!}</label>
            	</div>
            	<div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Payments</span>${!!$history_item->payments!!}</label>
            	</div>
            	<div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text"><span class="mobile-label uk-hidden-large">Delivery Status</span>@if($history_item->delivery_status != '') <span class="text-underline">{!!$history_item->delivery_status!!}</span> @else <span class="light">Not Yet Shipped</span> @endif</label>
            	</div>
            	<div class="uk-width-large-2-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Ship To Address</span>{!!$history_item->ship_address!!}</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Transaction ID</span>{!!$history_item->transaction_id!!}</label>
            	</div>
            	<div class="uk-width-large-3-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Item Details</span>{!!$history_item->item_details!!}</label>
            	</div>
            	<div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Image</span><img src="{!!url('uploads/products/product-name/'.$history_item->image)!!}" alt="Produc t Name" width="39" height="39" />
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
