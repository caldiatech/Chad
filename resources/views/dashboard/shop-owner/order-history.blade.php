@extends('layouts._front.dashboard_owner')

@section('content')
 <section id="order-history" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-usd uk-icon-button uk-icon-button-small uk-icon-justify"></i> <span class="title-text">Order History</span><a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#order-history-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content uk-padding-remove uk-table" id="order-history-panel">
			      <div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Date</label>
            	</div>
                <div class="uk-width-large-2-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">                          
                    <label  class="table-text">Transaction ID </label>
                </div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Cost<?php /* Payments <br><small>Invoice</small> */ ?></label>
            	</div>
                <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">
                    <label  class="table-text">Shipping <br></label>
                </div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Commission</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">From</label>
            	</div>
            	<div class="uk-width-large-2-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Item Details</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th  uk-visible-large">	                		
            		<label  class="table-text">Image</label>
            	</div>
            </div>
       	     
            <?php 
				// Loop all per cart transaction - product details            
              $cart_order_array = $cart_order_total_array = $cart_order_details_array = array();
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

                if(!in_array($carts->product_name, $cart_order_details_array[$cart_order_no])){
                    $cart_order_details_array[$cart_order_no][]     = $carts->product_name .'( '.$carts->quantity.' )'; 
                    $cart_order_details_images[$cart_order_no][]    = '<img src="'.url(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.THUMB_IMAGE.$carts->image).'" alt="'.$carts->product_name.'" /><br>'; 
                }
                // echo 'graphik_cost: '.$carts->graphik_cost;
                // echo 'quantity: '.$carts->quantity.'<br>';
                // echo '<hr>';
              }
            ?>

              @foreach($cart_order_array as $cart_order_no => $cart_order_item)
                <?php 
                  $cart_order_details = '';
                  $cart_order_grand_total = 0;
                  $cart_order_images  = '';
                  $coupon_disc = 0;
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
                        $coupon_disc = $cart_order_item->fldCartCouponCodeCouponPrice;
                      }
                    }

                    $cart_order_grand_total_temp = $cart_order_grand_total_temp - $coupon_disc;
                    $total_tax = $cart_order_item->fldCartTax;
                    $shipping_cost = $cart_order_item->fldCartShippingPrice;
                    $cart_order_grand_total = $cart_order_grand_total_temp;
                  }
                ?>
              
            <div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
              <div class="uk-width-large-1-10  uk-width-small-1-2  uk-width-1-1 uk-padding-v-normal uk-td">                     
                <label  class="table-text light"><span class="mobile-label uk-hidden-large">Date</span>{!! date('m/d/Y',strtotime($cart_order_item->order_date))!!}</label>
              </div>
              <div class="uk-width-large-2-10 uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                      
                <label  class="table-text light"><span class="mobile-label uk-hidden-large">Transaction ID</span>{!!$cart_order_item->order_no!!}</label>
              </div>
              <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                     
                <label  class="table-text light"><span class="mobile-label uk-hidden-large">Payment <br><small>Invoice</small></span>${!! number_format($cart_order_grand_total,2) !!}</label>
              </div>
               <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                     
                <label  class="table-text light"><span class="mobile-label uk-hidden-large">Shipping <br></span>${!! number_format($shipping_cost,2) !!}</label>
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
              <div class="uk-width-large-1-10  uk-width-small-1-2  pos-rel uk-width-1-1  uk-padding-v-normal uk-td uk-row-0">                           
                <span class="mobile-label uk-hidden-large">Image</span>
                    {!! $cart_order_images !!}
                <div class="uk-width-1-1 action-buttons">                         
                      <a  href="#view-modal-order-history-{{$cart_order_item->order_no}}" data-uk-modal data-onClick="orderRecords('{{ $cart_order_item->order_no }}')"><i class="uk-icon-search ion ion-ios-search-strong"></i></a>
                </div>
              </div>
              <div id="view-modal-order-history-{{$cart_order_item->order_no}}" class="uk-modal">
                <div class="uk-modal-dialog">
                  <a href="" class="uk-modal-close uk-close"></a>
                  <div class="uk-modal-header"><h1><span id="productCode"></span></h1></div>                                    
                  <span id="productDESC"></span>
                  <div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
                        
                        <div class="pos-rel uk-width-medium-1-2  uk-width-1-1    uk-padding-v-normal uk-td">                              
                              <span class="full-width ">Image</span>
                              {!! $cart_order_images !!}
                               <div class=" full-width uk-margin-small-top">                                                  
                                <label for="paid" class="lbl bold black roboto"><span class="uk-icon-thumbs-up"></span> Paid</label>
                              </div>
                        </div>
                        <div class="pos-rel uk-width-medium-1-2  uk-width-1-1    uk-padding-v-normal uk-td">
                              <div class="full-width uk-padding-v-normal uk-td">                             
                                    <label  class="full-width table-text light"><span class="mobile-label uk--large">Date</span>
                                        <span id="productDate">{!! date('m/d/Y',strtotime($cart_order_item->order_date))!!}</span> </label>
                              </div>
                              <div class="full-width uk-padding-v-normal uk-td">
                                    <label  class="full-width table-text light"><span class="mobile-label uk--large">Cost</span>
                                        <span id="productPayments">${!! number_format($cart_order_grand_total,2) !!}</span></label>
                              </div>

                              <div class="full-width uk-padding-v-normal uk-td">
                                   	<label  class="full-width table-text light"><span class="mobile-label uk--large">Shipping <?php /* <br><small>CC Processing Fee</small>*/ ?></span>
                                    <span id="productPayments">${!! number_format($shipping_cost,2) !!}</span></label>
                              </div>
                              <div class="full-width uk-padding-v-normal uk-td ">                              
                                    <label  class="table-text light"><span class="mobile-label uk--large">Commission</span>
                                        $<span id="productCommission">{!!number_format($commission_amount,2)!!}</span></label>
                              </div>
                              <div class="full-width uk-padding-v-normal uk-td">                              
                                    <label  class="table-text light"><span class="mobile-label uk--large">From</span>
                                        <span id="clientFrom">{!!$cart_order_item->fldClientFirstname . ' ' . $cart_order_item->fldClientLastname!!}</span></label>
                              </div>
                              <div class="full-width uk-padding-v-normal uk-td">                            
                                    <label  class="full-width table-text light"><span class="mobile-label uk--large">Transaction ID</span>
                                        <span id="transactionID">{!!$cart_order_item->order_no!!}</span></label>
                              </div>
                              <div class="full-width uk-padding-v-normal uk-td ">                           
                                    <label  class="full-width table-text light"><span class="mobile-label uk--large">Item Details</span>
                                        <span id="itemDetails">{!! $cart_order_details !!}</span></label>
                              </div>
                        </div>
                  </div>
                  <div class="uk-modal-footer uk-text-right">
                      <button type="button" class="uk-button uk-modal-close  uk-button-primary">CLOSE</button>
                  </div>
                </div>              
              </div> <!-- view-modal-order-history -->
            </div>
          @endforeach

          @if($cart->isEmpty())
          <div class="uk-width-large-1-1  uk-width-small-1-1   uk-width-1-1  uk-padding-v-normal uk-td">   
            <div class="uk-alert uk-alert-danger">No Record Found</div>     
          </div>  
          @endif

	        </div>
          <div class="uk-row">
            {!! $cart->render() !!}
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
            function delete_me(deleting_id){
                  var confirmdelete = UIkit.modal.confirm('Are you sure?', function(){    
                        $('.history-item-'+deleting_id).addClass('bg-red');
                        //delete query here
                        /* $(ajax) */
                        setTimeout(function(){
                              // hide
                              $('.history-item-'+deleting_id).fadeOut();
                        },300);
                        return true; 
                  }, function(){
                        return false; 
                  }
                  );

            }

            /*function orderRecords(orderNo) {                  
                  $.get( "{{ url('dashboard/shop-owner/orderInfo/') }}/"+orderNo, function( data ) {
                       console.log(data);
                         $("#productCode").html(data.product_name);
                         
                         $("#productImage").attr('src',data.imageFrame);
                         $("#productDate").html(data.fldCartOrderDate);
                         $("#productPayments").html(data.product_price);
                         $("#productCommission").html(data.fldShopOwnerCommissionAmount);
                         $("#transactionID").html(data.order_no);
                         $("#itemDetails").html(data.orderDetails);
                         $("#clientFrom").html(data.fldClientFirstname + ' ' + data.fldClientLastname);
                  });
            }   */
	</script>
@stop
