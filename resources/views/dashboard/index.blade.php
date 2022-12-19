@extends('layouts._front.dashboard')

@section('content')
    <section id="profile" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-justify"></i> <span class="title-text">Profile</span><a href="#" class="icon-button-wrapper white uk-float-right light"><i class=" icon-image uk-icon-pencil uk-icon-justify"></i> <span class="light">Edit</span></a></h2>
    	<div class="section-content">
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
		    						<div class="uk-width-small-1-2 uk-width-1-1 normal">Contact #</div>
		    						<div class="uk-width-small-1-2 uk-width-1-1">855-235-7234-231</div>
		    						<div class="uk-vertical-divider full-width uk-margin"></div>
		    						<div class="uk-width-small-1-2 uk-width-1-1 normal">Email Address</div>
		    						<div class="uk-width-small-1-2 uk-width-1-1">josephmichael@gmail.com</div>		
								</div>
	    					</div>
	    					
						</div>
	                </div>
	            </div>
	            <div class="uk-width-large-4-10 uk-width-small-1-1 ">
	                <div class="uk-grid uk-panel uk-panel-box normal">
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label  class="table-text">Mobile Alerts</label>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal" data-uk-button-checkbox>	                		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle"> <span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> <span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text">Email Alerts</label>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal" data-uk-button-checkbox>	                		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle"> <span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> <span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text">Promo Code</label>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">PQR952Y0</label>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text">Birthday</label>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">December 1, 1990</label>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text">Username</label>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">JMDOE2016</label>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text">Password</label>
	                	</div>
	                	<div class="uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">&#8226;&#8226;&#8226;&#8226;&#8226;</label>
	                	</div>

	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
    <section id="order-history" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-shopping-bag uk-icon-justify"></i> <span class="title-text">Order History</span><a href="#" class="icon-button-wrapper white uk-float-right light"><i class=" icon-image uk-icon-eye uk-icon-justify"></i> <span class="light">View</span></a></h2>
    	<div class="section-content">
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
            	<div class="uk-vertical-divider full-width "></div>
            	<div class="uk-width-large-1-10 uk-width-medium-2-10 uk-width-1-1 uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Date</span>03/02/2016</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-medium-2-10 uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Payments</span>$92.04</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-medium-2-10 uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text"><span class="mobile-label uk-hidden-large">Delivery Status</span>Tracking #</label>
            	</div>
            	<div class="uk-width-large-2-10 uk-width-medium-4-10 uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Ship To Address</span>725 S Bixel St, Los Angeles, CA 90017, USA</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-medium-2-10 uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Transaction ID</span>CLKN-71239AB-9NC</label>
            	</div>
            	<div class="uk-width-large-3-10 uk-width-medium-4-10 uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Item Details</span>Seaside Mountain View - Classic - 15x25 - Stife Dark Beige - Michael Kenna</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-medium-2-10 uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<img src="{!!url('uploads/products/product-name/thumb.jpg')!!}" alt="Produc t Name" width="39" height="39" />
            	</div>
            	<div class="uk-vertical-divider full-width "></div>


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
