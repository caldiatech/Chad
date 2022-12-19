@extends('layouts._front.dashboard_owner')

@section('content')
    <section id="profile" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-justify"></i> <span class="title-text">Profile</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a> <a href="{{url('dashboard/'.$pages->category.'/edit-profile')}}" class="icon-button-wrapper white uk-float-right light"><i class=" icon-image uk-icon-pencil ion ion-edit uk-icon-justify"></i> <span class="light">Edit</span></a>  </h2>
    	<div class="section-content" id="profile-panel">
			<div class="uk-grid" >
	            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
	                <div class="uk-panel uk-panel-box">
	                    <h3 class="uk-panel-title light uk-h1 light">{{ $shopOwner->fldShopOwnerFirstname . ' ' . $shopOwner->fldShopOwnerLastname }} </h3>
	                    <div class="uk-panel-content">

	                    @if($shopOwner->fldShopOwnerAddress != "" || $shopOwner->fldShopOwnerCity != "" || $shopOwner->fldShopOwnerState != "" || $shopOwner->fldShopOwnerZip)
	                    	<p><i class="uk-icon-map-marker uk-icon-justify">&nbsp; </i> <span class="uk-margin-small-left">{{ $shopOwner->fldShopOwnerAddress . ' ' . $shopOwner->fldShopOwnerCity . ' ' . $shopOwner->fldShopOwnerState . ' ' . $shopOwner->fldShopOwnerZip }}</span></p>
	                    @endif
	                    

	                    @if($shopOwner->fldShopOwnerProfession != "")
	    					<p><i class="uk-icon-briefcase uk-icon-justify">&nbsp; </i> <span class="uk-margin-small-left">{{ $shopOwner->fldShopOwnerProfession }}</span></p>
	    				@endif
	    					
                        @if($shopOwner->fldShopOwnerBusiness != "")
                            <p>Company: <span class="uk-margin-small-left">{{ $shopOwner->fldShopOwnerBusiness }}</span></p>
                        @endif

	    					<div class="uk-vertical-divider full-width uk-margin"></div>
	    					<div class="full-width uk-margin">
	    						<div class="uk-grid uk-text-14">
		    						<div class="uk-width-small-1-2 max-width-200 uk-width-1-1 normal">Contact #</div>
		    						<div class="uk-width-small-1-2 uk-width-1-1">{{ $shopOwner->fldShopOwnerPhoneNo }}</div>
		    						<div class="uk-vertical-divider full-width uk-margin"></div>
		    						<div class="uk-width-small-1-2 max-width-200 uk-width-1-1 normal">Email Address</div>
		    						<div class="uk-width-small-1-2 uk-width-1-1">{{ $shopOwner->fldShopOwnerEmail }}</div>	
		    						<div class="uk-vertical-divider full-width uk-margin"></div>
		    						<div class="uk-width-small-1-2 max-width-200 uk-width-1-1 normal">Authorization</div>
		    						<div class="uk-width-small-1-2 uk-width-1-1">{{ $shopOwner->fldShopOwnerAuthorization }}</div>		
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
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle {{ $shopOwner->fldShopOwnerMobileAlerts == 1 ? 'uk-active' : '' }}"> <span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> <span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Email Alerts</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4 uk-width-1-2 uk-padding-v-normal" data-uk-button-checkbox>	                		
	                		<button class="uk-button uk-button-primary uk-button-small uk-button-toggle {{ $shopOwner->fldShopOwnerEmailAlerts == 1 ? 'uk-active' : '' }}"> <span class="uk-button-toggle-text text-off">Off</span> <i class="uk-icon-circle">  </i> <span class="uk-button-toggle-text text-on">On</span>
	                		</button>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Promo Code</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">{{ $shopOwner->fldShopOwnerPromoCode }}</label>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Birthday</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">{{ $shopOwner->fldShopOwnerBirthDate == "0000-00-00" || $shopOwner->fldShopOwnerBirthDate=="" ? "&nbsp;" : date('F d, Y',strtotime($shopOwner->fldShopOwnerBirthDate)) }}</label>
	                	</div>
            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">	                		
	                		<label for=""  class="table-text">Username</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">	                		
	                		<label for=""  class="table-text light">{{ $shopOwner->fldShopOwnerEmail }}</label>
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
    	<h2 class="section-header uk-h2"><i class="uk-icon-usd uk-icon-button uk-icon-button-small uk-icon-justify"></i> <span class="title-text">Order History</span><a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#order-history-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a> <a href="{{url('dashboard/'.$pages->category.'/order-history')}}" class="icon-button-wrapper white uk-float-right light"><i class=" icon-image uk-icon-eye ion ion-ios-eye-outline uk-icon-justify"></i> <span class="light">View</span></a></h2>
    	<div class="section-content uk-table" id="order-history-panel">
			<div class="uk-grid uk-panel uk-panel-box normal">
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Date</label>
            	</div>
                <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
                    <label  class="table-text">Transaction ID </label>
                </div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
            		<label  class="table-text">Cost <?php /*<br><small>Invoice</small>*/ ?></label>
            	</div>
                <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
                    <label  class="table-text">Shipping <br></label>
                </div>
                <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
                    <label  class="table-text">Commission</label>
                </div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">From </label>
            	</div>
            	<div class="uk-width-large-2-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Item Details</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Image</label>
            	</div>
            	<div class="uk-vertical-divider full-width  uk-visible-large"></div>
            	
            	<?php 
                // Loop all per cart transaction - product details            
                $cart_order_array = $cart_order_total_array = $cart_order_details_array = array();
                $images = '';
                $order_details = '';
               
            	foreach($cart as $carts){
            		$cart_order_no = $carts->order_no;
            		if(!isset($cart_order_array[$cart_order_no])){
            			$cart_order_array[$cart_order_no] = $carts;
            			$cart_order_total_array[$cart_order_no] = $cart_total_shipping[$cart_order_no] = 0;
            			$cart_order_details_array[$cart_order_no] = array();
            		}
            		$cart_product_price = $cart_order_total_array[$cart_order_no];
            		$cart_product_price  += ($carts->product_price * $carts->quantity);
            		// $cart_order_total_array[$cart_order_no] = $cart_product_price;
                    $cart_order_total_array[$cart_order_no] = $cart_product_price - ($carts->graphik_cost * $carts->quantity);

            		// if(!in_array($carts->product_name, $cart_order_details_array[$cart_order_no])){
              //           $cart_order_details_array[$cart_order_no][] = $carts->product_name .' ( '.$carts->quantity.' )'; 
              //       }
              //       $images .= '<img src="'.url(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.THUMB_IMAGE.$carts->image).'" alt="'.$carts->product_name.'" /><br><br>';

                    if(!in_array($carts->product_name, $cart_order_details_array[$cart_order_no])){
                        $cart_order_details_array[$cart_order_no][]     = $carts->product_name .' ( '.$carts->quantity.' )'; 
                        $cart_order_details_images[$cart_order_no][]    = '<img src="'.url(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.THUMB_IMAGE.$carts->image).'" alt="'.$carts->product_name.'" /><br>'; 
                    }
            	} 
            	?>

            	@foreach($cart_order_array as $cart_order_no => $cart_order_item)
            		<?php 
            			$cart_order_details = '';
            			$cart_order_grand_total = 0;
            			$coupon_disc = 0;
                        $cart_order_images  = '';
                        $commission_amount  = floatval(preg_replace('/[^\d\.]/', '', $cart_order_item->fldShopOwnerCommissionAmount));
            			if(isset($cart_order_details_array[$cart_order_no])){
                            $cart_order_details_item = $cart_order_details_array[$cart_order_no];
                            $cart_product_images = $cart_order_details_images[$cart_order_no];

                                  foreach($cart_order_details_item as $cart_order_details_item_i){
                                    if($cart_order_details != ''){
                                      $cart_order_details .= '<br>';
                                    }
                                    $cart_order_details .= $cart_order_details_item_i;
                                  }

                            foreach($cart_product_images as $order_image){
                                if($cart_order_images != ''){
                                    $cart_order_images .= '<br>';
                                }
                                $cart_order_images .= $order_image;
                            }
                        }

            			if(isset($cart_order_total_array[$cart_order_no]) && ($cart_order_total_array[$cart_order_no] > 0)){
            				$cart_order_grand_total_temp = $cart_order_total_array[$cart_order_no];
            				if(isset($cart_order_item->fldCartCouponCodeCouponPrice)){
            					if($cart_order_item->fldCartCouponCodeCouponPrice > 0){
            						$coupon_disc = floatval($cart_order_item->fldCartCouponCodeCouponPrice);
            					}
            				}
            				$cart_order_grand_total_temp = $cart_order_grand_total_temp - $coupon_disc;
            				$total_tax = $cart_order_item->fldCartTax;
                            $shipping_cost = $cart_order_item->fldCartShippingPrice;
            				// $cart_order_grand_total = floatval($cart_order_grand_total_temp) + floatval($total_tax) + floatval($cart_order_item->fldCartShippingRateShippingAmount);
                            // $cart_order_grand_total = floatval($cart_order_grand_total_temp) + floatval($total_tax) + $cart_total_shipping[$cart_order_no];
                            $cart_order_grand_total = floatval($cart_order_grand_total_temp);
            			}
            		?>
            	
            	<div class="uk-width-large-1-10  uk-width-small-1-2  uk-width-1-1 uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Date</span>{!! date('m/d/Y',strtotime($cart_order_item->order_date))!!}</label>
            	</div>
                <div class="uk-width-large-1-10 uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                          
                    <label  class="table-text light"><span class="mobile-label uk-hidden-large">Transaction ID</span><small>{!!$cart_order_item->order_no!!}</small></label>
                </div>
            	<div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Cost <?php /*<br><small>Invoice</small>*/ ?></span>${!! number_format($cart_order_grand_total,2) !!}</label>
            	</div>
                <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                         
                    <label  class="table-text light"><span class="mobile-label uk-hidden-large">Shipping<br></span>${!! number_format($shipping_cost,2) !!}</label>
                </div>
                <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                         
                    <label  class="table-text light"><span class="mobile-label uk-hidden-large">Commission</span>${!! number_format($commission_amount,2)!!}</label>
                </div>
            	<div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">From</span>{!!$cart_order_item->fldClientFirstname . ' ' . $cart_order_item->fldClientLastname!!}</label>
            	</div>
            	<div class="uk-width-large-2-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Item Details</span>{!! $cart_order_details !!}</label>
            	</div>
            	<div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">	                		
            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Image</span>{!! $cart_order_images !!}
            	</div>
            	<div class="uk-vertical-divider full-width "><hr></div>
               
            	@endforeach
            	@if($cart->isEmpty())
            		<div class="uk-width-large-1-1  uk-width-small-1-1   uk-width-1-1  uk-padding-v-normal uk-td">	 
            			<div class="uk-text-danger">No Record Found</div>     
            		</div>	
            	@endif
	        </div>
	    </div>
	</section>
@stop

@section('headercodes')
@stop
 
@section('extracodes')  
@stop
