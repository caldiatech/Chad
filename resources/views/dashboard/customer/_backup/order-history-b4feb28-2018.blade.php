@extends('layouts._front.dashboard')

@section('content')
 <section id="order-history" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-shopping-bag  icon-stack-parent white uk-icon-justify"><i class="uk-icon-check-circle-o icon-small-append icon-bottom icon-right"></i></i> <span class="title-text">Order History</span><a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#order-history-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content uk-padding-remove uk-table" id="order-history-panel">
			<div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
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
            	<div class="uk-width-large-2-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Item Details</label>
            	</div>
            	<div class="uk-width-large-2-10 uk-width-3-10 uk-padding-v-normal uk-th  uk-visible-large">	                		
            		<label  class="table-text">Image</label>
            	</div>
            </div>
            	<?php             	
				$item_ctr = 0; 
            	?>
            	@foreach($cart as $carts)
            	
            	<div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove uk-table-row history-item-{{$item_ctr}}">
	            	<div class="uk-width-large-1-10  uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal uk-td uk-row-{{$item_ctr}}">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Date</span>{!!date('m/d/Y',strtotime($carts->order_date)) !!}</label>
	            	</div>
	            	<div class="uk-width-large-1-10  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-{{$item_ctr}}">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Payments</span>${!!$carts->product_price != "" ? number_format($carts->product_price,2) : 0.00!!}</label>
	            	</div>
	            	<div class="uk-width-large-1-10  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-{{$item_ctr}}">	                		
	            		<label  class="table-text"><span class="mobile-label uk-hidden-large">Delivery Status</span>
                                         <span class="text-underline">Tracking #</span> 
                                         <span class="light">Not Yet Shipped</span>  
                              </label>
	            	</div>
	            	<div class="uk-width-large-2-10  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-{{$item_ctr}}">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Ship To Address</span>
                                    {!!$carts->fldCartShippingAddress!!}</label>
	            	</div>
	            	<div class="uk-width-large-1-10 uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-{{$item_ctr}}">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Transaction ID</span>{!!$carts->order_no!!}</label>
	            	</div>
	            	<div class="uk-width-large-2-10  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-{{$item_ctr}}">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Item Details</span>{!! $carts->product_name . ' - ' .App\Models\Cart::getImageSize($carts->fldCartImageSize) . ' - '.  App\Models\Cart::getFrameAttributes($carts->fldCartFrameDesc) . ' - '.App\Models\Cart::getPaperInfo($carts->fldCartPaperInfo) . ' - ' . App\Models\Cart::getMat($carts->order_no) !!}</label>
	            	</div>
	            	<div class="uk-width-large-2-10  uk-width-small-1-2  pos-rel uk-width-1-1  uk-padding-v-normal uk-td uk-row-{{$item_ctr}}">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Image</span><img src="{!!url(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.SMALL_IMAGE.$carts->image)!!}" alt="Produc t Name" width="39" height="39" />

		            	<div class="uk-width-1-1 action-buttons">	     
                      <a  href="{{ url('dashboard/customer/order-history/details/'.$carts->order_no) }}"><i class="uk-icon-search ion ion-ios-search-strong"></i></a>
                    <? /*           		
		            		<a  href="#view-modal-order-history-{{$item_ctr}}" data-uk-modal onClick="orderRecords('{{ $carts->order_no }}')"><i class="uk-icon-search ion ion-ios-search-strong"></i></a>
                    */ ?>
                                    <? /*
		            		<a  href="#edit-modal-order-history-{{$item_ctr}}" data-uk-modal><i class="uk-icon-pencil ion ion-edit"></i></a>
                                    
		            		<a href="javascript:void(0)"  onclick="delete_me({{$item_ctr}})"><i class="uk-icon-delete  ion ion-ios-trash"></i></a>
                                    */ ?>
		            	</div>
	            	</div>
                  @endforeach    

                  <div id="view-modal-order-history-0" class="uk-modal">
                              <div class="uk-modal-dialog">
                                    <a href="" class="uk-modal-close uk-close"></a>
                                    <div class="uk-modal-header"><h1>Order # <span id="productCode"></span></h1></div>
                                    
                                    <span id="productDESC"></span>
                                    <div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
                                          
                                          <div class="pos-rel uk-width-medium-1-2  uk-width-1-1    uk-padding-v-normal uk-td">                              
                                                <span class="full-width "></span><img id="productImage" src="" alt="Product Name" width="706" height="639" />
                                                 <div class=" full-width uk-margin-small-top">                                                  
                                                  <label for="paid" class="lbl bold black roboto"><span class="uk-icon-thumbs-up"></span> Paid</label>
                                                </div>
                                          </div>
                                          <div class="pos-rel uk-width-medium-1-2  uk-width-1-1    uk-padding-v-normal uk-td">
                                                <div class="full-width uk-padding-v-normal uk-td">                             
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Date</span>
                                                             <span id="productDate"></span>     
                                                      </label>
                                                </div>
                                                <div class="full-width uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Payments $</span>$<span id="productPrice"></span></label>
                                                </div>
                                                <div class="full-width uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text"><span class="mobile-label uk--large">Delivery Status</span>
                                                            <span class="text-underline">Tracking #</span> 
                                                            <span class="light">Not Yet Shipped</span> 
                                                      </label>
                                                </div>
                                                <div class="full-width   uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Ship To Address</span><span id="orderShipping"></span></label>
                                                </div>
                                                <div class="full-width  uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Transaction ID</span><span id="orderTranID"></span></label>
                                                </div>
                                                <div class="full-width  uk-padding-v-normal uk-td ">                           
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Item Details</span><span id="orderItemDetails"></span></label>
                                                </div>
                                          </div>
                                    </div>

                                     <div class="uk-modal-footer uk-text-right">
                                        <button type="button" class="uk-button uk-modal-close  uk-button-primary">CLOSE</button>
                                    </div>
                              </div>
                         </div> <!-- view-modal-order-history -->


                        <? /*
                        <div id="view-modal-order-history-{{$item_ctr}}" class="uk-modal">
                              <div class="uk-modal-dialog">
                                    <a href="" class="uk-modal-close uk-close"></a>
                                    <div class="uk-modal-header"><h1>Order #000{{$item_ctr}}</h1></div>
                                    
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    <div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
                                          
                                          <div class="pos-rel uk-width-medium-1-2  uk-width-1-1    uk-padding-v-normal uk-td">                              
                                                <span class="full-width ">Image</span><img src="{!!url('uploads/products/product-name/frames/frame-706x639.jpg')!!}" alt="Produc t Name" width="706" height="639" />
                                                 <div class=" full-width uk-margin-small-top">                                                  
                                                  <label for="paid" class="lbl bold black roboto"><span class="uk-icon-thumbs-up"></span> Paid</label>
                                                </div>
                                          </div>
                                          <div class="pos-rel uk-width-medium-1-2  uk-width-1-1    uk-padding-v-normal uk-td">
                                                <div class="full-width uk-padding-v-normal uk-td">                             
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Date</span>{!!$history_item->date!!}</label>
                                                </div>
                                                <div class="full-width uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Payments</span>${!!$history_item->payments!!}</label>
                                                </div>
                                                <div class="full-width uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text"><span class="mobile-label uk--large">Delivery Status</span>@if($history_item->delivery_status != '') {!!$history_item->delivery_status!!} @else <span class="light">Not Yet Shipped</span> @endif</label>
                                                </div>
                                                <div class="full-width   uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Ship To Address</span>{!!$history_item->ship_address!!}</label>
                                                </div>
                                                <div class="full-width  uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Transaction ID</span>{!!$history_item->transaction_id!!}</label>
                                                </div>
                                                <div class="full-width  uk-padding-v-normal uk-td ">                           
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Item Details</span>{!!$history_item->item_details!!}</label>
                                                </div>
                                          </div>
                                    </div>

                                     <div class="uk-modal-footer uk-text-right">
                                        <button type="button" class="uk-button uk-modal-close  uk-button-primary">CLOSE</button>
                                    </div>
                              </div>
                         </div> <!-- view-modal-order-history -->
                        <div id="edit-modal-order-history-{{$item_ctr}}" class="uk-modal">
                              <div class="uk-modal-dialog">
                                    <a href="" class="uk-modal-close uk-close"></a>
                                    <div class="uk-modal-header"><h1>Order #000{{$item_ctr}}</h1></div>
                                    
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    <div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
                                          
                                          <div class="pos-rel uk-width-medium-1-2  uk-width-1-1  uk-padding-v-normal uk-td">                              
                                                <span class="full-width ">Image</span><img src="{!!url('uploads/products/product-name/frames/frame-706x639.jpg')!!}" alt="Produc t Name" width="706" height="639" />
                                                 <div class=" full-width uk-margin-small-top checkbox-wrapper">
                                                  {!! Form::checkbox('order_'.$item_ctr.'_paid', 1, true, ['id'=>'order_'.$item_ctr.'_paid']); !!}
                                                  <label for="order_{{$item_ctr}}_paid" class="lbl light"><span class="checkbox-style"></span> Paid</label>
                                                </div>
                                          </div>
                                          <div class="pos-rel uk-width-medium-1-2  uk-width-1-1    uk-padding-v-normal uk-td">
                                                <div class="full-width uk-padding-v-normal uk-td">                             
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Date</span>{!!$history_item->date!!}</label>
                                                </div>
                                                <div class="full-width uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Payments</span>${!!$history_item->payments!!}</label>
                                                </div>
                                                <div class="full-width uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text"><span class="mobile-label uk--large">Delivery Status</span>@if($history_item->delivery_status != '') {!!$history_item->delivery_status!!} @else <span class="light">Not Yet Shipped</span> @endif</label>
                                                </div>
                                                <div class="full-width   uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Ship To Address</span>{!!$history_item->ship_address!!}</label>
                                                </div>
                                                <div class="full-width  uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Transaction ID</span>{!!$history_item->transaction_id!!}</label>
                                                </div>
                                                <div class="full-width  uk-padding-v-normal uk-td ">                           
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Item Details</span>{!!$history_item->item_details!!}</label>
                                                </div>
                                          </div>
                                    </div>

                                     <div class="uk-modal-footer uk-text-right">
                                        <button type="button" class="uk-button uk-modal-close  uk-button-primary">CLOSE</button>
                                        <button type="button" class="uk-button  uk-button-primary">SAVE</button>
                                    </div>
                              </div>
                         </div> <!-- view-modal-order-history -->
                         */ ?>

            	</div>
            	

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

            function orderRecords(orderNo) {                  
                  $.get( "{{ url('dashboard/customer/orderInfo/') }}/"+orderNo, function( data ) {
                       console.log(data);
                         $("#productCode").html(data.fldCartOrderNo);
                         $("#productDESC").html(data.fldProductDescription);
                        $("#productImage").attr('src',data.imageFrame);
                         $("#productDate").html(data.fldCartOrderDate);
                        $("#productPrice").html(data.fldCartProductPrice);
                        $("#orderShipping").html(data.fldAddress);
                         $("#orderTranID").html(data.fldCartOrderNo);
                         $("#orderItemDetails").html(data.orderDetails);
                  });
            }
	</script>
@stop
