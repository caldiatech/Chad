@extends('layouts._front.dashboard')

@section('content')
    <section id="profile" class="section">

        @if (Session::has('success'))
            <div class="uk-alert uk-alert-success uk-margin-large-top">{!!Session::get('success')!!}</div>
        @endif

    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-justify"></i> <span class="title-text">Profile</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a> <a href="{{url('dashboard/'.$pages->category.'/edit-profile')}}" class="icon-button-wrapper white uk-float-right light"><i class=" icon-image uk-icon-pencil ion ion-edit uk-icon-justify"></i> <span class="light">Edit</span></a>  </h2>
    	<div class="section-content" id="profile-panel">
			<div class="uk-grid" >
	            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
	                <div class="uk-panel uk-panel-box">
	                    <h3 class="uk-panel-title light uk-h1 light">{{ $client->fldClientFirstname }} {{ $client->fldClientLastname }}</h3>
	                    <div class="uk-panel-content">
	                      @if($client->fldClientAddress != "" || $client->fldClientCity != "" ||
	                          $client->fldClientState != "" || $client->fldClientZip)

	                    	<p><i class="uk-icon-map-marker uk-icon-justify">&nbsp; </i> <span class="uk-margin-small-left">{{ $client->fldClientAddress }} {{ $client->fldClientCity }} {{ $client->fldClientCity != '' ? ',' : '' }} {{ $client->fldClientState }} {{ $client->fldClientState != '' ? ',' : '' }} {{ $client->fldClientZip }}</span></p>
	                    @endif

	                    @if($client->fldClientCareer != "")
	    					<p><i class="uk-icon-briefcase uk-icon-justify">&nbsp; </i> <span class="uk-margin-small-left">{{ $client->fldClientCareer }}</span></p>
	    				@endif

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

            			<? /* <div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">
	                		<label for=""  class="table-text">Promo Code</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">
	                		<label for=""  class="table-text light">{{ $client->fldClientPromoCode != "" ? $client->fldClientPromoCode : "&nbsp;" }}</label>
	                	</div> */ ?>

            			<div class="uk-vertical-divider full-width uk-visible-large uk-visible-small"></div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal col-lbl">
	                		<label for=""  class="table-text">Birthday</label>
	                	</div>
	                	<div class="uk-width-large-1-2 uk-width-medium-1-4  uk-width-1-2  uk-padding-v-normal">
	                		<label for=""  class="table-text light">{{ $client->fldClientBirthday == "0000-00-00" || $client->fldClientBirthday=="" ? "- - / - - / - - &nbsp;" : date('F d, Y',strtotime($client->fldClientBirthday)) }}</label>
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
                    <label  class="table-text">Transaction ID </label>
                </div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
            		<label  class="table-text">Payment <br><small>Invoice</small></label>
            	</div>

                <? /*
                <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
                    <label  class="table-text">Payment <br><small>Invoice</small></label>
                </div>
                <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
                    <label  class="table-text">Shipping <br><small>Processing Fee</small></label>
                </div>
                */ ?>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
            		<label  class="table-text">Delivery Status</label>
            	</div>
            	<div class="uk-width-large-2-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
            		<label  class="table-text">Ship To Address </label>
            	</div>
            	<div class="uk-width-large-3-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
            		<label  class="table-text">Item Details</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
            		<label  class="table-text">Image</label>
            	</div>
            	<div class="uk-vertical-divider full-width  uk-visible-large"></div>

                <?php // echo '<pre>'; print_r($cart); die(); ?>
            	@foreach($cart as $order)
            		<?php
                    $images = '';

                    $order_rows = \App\Models\Cart::where('fldCartOrderNo','=',$order->fldCartOrderNo)->get();


                    // Total Paid
                    // (product_price * quantity) + tax - discount
                    // base for commission = (product_price * quantity) - shipping - discount

                    $total_tax      = $order->fldCartTax;
                    $total_coupon   = $order->fldCartCouponCodeCouponPrice;
                    // $total_shipping = $order->fldCartShippingRateShippingAmount;

                    $products->name[$order->fldCartID]   = array();
                    $products->price[$order->fldCartID]  = array();
                    $products->image[$order->fldCartID]  = array();
                    $products->slug[$order->fldCartID]   = array();
                    $products->name_quantity[$order->fldCartID]   = array();

                    $subtotal_per_cart = 0;

                    foreach ($order_rows as $key => $item) {

                        $shipping_cost = $item->fldCartShippingPrice; // To be added one time only after loop
                        // dd($item);
                        // $subtotal_per_line = ($item->fldCartProductPrice + $item->fldCartShippingPrice) * $item->fldCartQuantity;
                        $subtotal_per_line = $item->fldCartProductPrice * $item->fldCartQuantity;
                        $subtotal_per_cart += $subtotal_per_line;

                        array_push($products->name[$order->fldCartID], $item->fldCartProductName);
                        array_push($products->name_quantity[$order->fldCartID], $item->fldCartProductName.' ( '.$item->fldCartQuantity.' )');

                        $product = \App\Models\Product::find($item->fldCartProductID);

                        if (!empty($product)) {
                            array_push($products->slug[$order->fldCartID], $product->fldProductSlug);
                            // array_push($products->price[$order->fldCartID], $subtotal_per_line);
                            array_push($products->image[$order->fldCartID], $product->fldProductImage);
                            $images .= '<img src="'.url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.THUMB_IMAGE.$product->fldProductImage).'" alt="'.$product->fldProductName.'" /><br><br>';
                        }

                    }

                    if (!empty($products->name[$order->fldCartID])) {
                        $total_per_cart = $subtotal_per_cart - $total_coupon + $shipping_cost + $total_tax;

                        // $slugs = (count($products->slug[$order->fldCartID]) > 1)? '': $products->slug[$order->fldCartID][0];
                        // $images = (count($products->image[$order->fldCartID]) > 1)? 'Multiple': $products->image[$order->fldCartID][0];
                        $product_name = implode('<br>', $products->name[$order->fldCartID]);
                        $product_name_quantity = implode('<br>', $products->name_quantity[$order->fldCartID]);
                    }
            		?>


                    @if (!empty($products->name[$order->fldCartID]))
                        <div class="uk-width-large-1-10  uk-width-small-1-2  uk-width-1-1 uk-padding-v-normal uk-td">
                            <label  class="table-text light"><span class="mobile-label uk-hidden-large">Date</span>
                                <small>{!!date('m/d/Y',strtotime($order->fldCartOrderDate)) !!}</small></label>
                        </div>
                        <div class="uk-width-large-1-10 uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">
                            <label  class="table-text light"><span class="mobile-label uk-hidden-large">Transaction ID</span>
                                <small>{!!$order->fldCartOrderNo!!}</small></label>
                        </div>
                        <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">
                            <label  class="table-text light"><span class="mobile-label uk-hidden-large">Payments <br><small>Invoice</small></span>
                                $ {!!number_format($total_per_cart,2)!!}</label>
                        </div>
                        <? /*
                        <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">
                            <label  class="table-text light"><span class="mobile-label uk-hidden-large">Shipping <br><small>Processing Fee</small></span>
                                $ {!!number_format($order->fldCartShippingPrice,2)!!}</label>
                        </div>
                        */ ?>
                        <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">
                            <label  class="table-text"><span class="mobile-label uk-hidden-large">Delivery Status</span>
                                    <span class="text-underline">Tracking #</span><br>
                                    <span class="light">Not Yet Shipped</span>
                            </label>
                        </div>
                        <div class="uk-width-large-2-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">
                            <label  class="table-text light"><span class="mobile-label uk-hidden-large">Ship To Address</span>
                                {!!$order->fldCartShippingAddress!!}</label>
                        </div>
                        <div class="uk-width-large-3-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">
                            <label  class="table-text light"><span class="mobile-label uk-hidden-large">Item Details</span>
                            {!! $product_name_quantity !!}</label>
                        </div>
                        <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">
                            <label  class="table-text light"><span class="mobile-label uk-hidden-large">Image</span>
                            {!! $images !!}
                        </div>
                    @endif

                	<div class="uk-vertical-divider full-width"><hr></div>
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
