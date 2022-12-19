@extends('layouts._front.dashboard_owner')

@section('content')
 <section id="order-history" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-usd uk-icon-button uk-icon-button-small uk-icon-justify"></i> <span class="title-text">Order History</span><a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#order-history-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content uk-padding-remove uk-table" id="order-history-panel">
			<div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Date</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Payments</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Commission</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">From</label>
            	</div>
            	<div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Transaction ID </label>
            	</div>
            	<div class="uk-width-large-3-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Item Details</label>
            	</div>
            	<div class="uk-width-large-2-10 uk-width-3-10 uk-padding-v-normal uk-th  uk-visible-large">	                		
            		<label  class="table-text">Image</label>
            	</div>
            </div>
       	     @if($cart->isEmpty())
               <div class="uk-alert uk-alert-danger" style="color:#d85030">Order history is empty</div>
            @endif

            	@foreach($cart as $carts)
                  
                  <div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove uk-table-row history-item-0">
                        <div class="uk-width-large-1-10  uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal uk-td uk-row-0">                         
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large">Date</span>{{ date('m/d/Y',strtotime($carts->order_date))}}</label>
                        </div>
                        <div class="uk-width-large-1-10  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-0">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large">Payments</span>${{$carts->product_price != "" ? number_format($carts->product_price,2) : 0.00}}</label>
                        </div>
                        <div class="uk-width-large-1-10  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-0">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large">Commission</span>${{number_format($carts->fldShopOwnerCommissionAmount,2)}}</label>
                        </div>
                        <div class="uk-width-large-1-10  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-0">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large">From</span>{{$carts->fldClientFirstname . ' ' . $carts->fldClientLastname}}</label>
                        </div>
                        <div class="uk-width-large-1-10 uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-0}">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large">Transaction ID</span>{{$carts->order_no}}</label>
                        </div>
                        <div class="uk-width-large-3-10  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-0">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large">Item Details</span>{{ App\Models\Cart::getImageSize($carts->fldCartImageSize) . ', '. $carts->product_name . ', ' . App\Models\Cart::getFrameAttributes($carts->fldCartFrameDesc) . ', '.App\Models\Cart::getPaperInfo($carts->fldCartPaperInfo) . ', ' . App\Models\Cart::getMat($carts->order_no) }}</label>
                        </div>
                        <div class="uk-width-large-2-10  uk-width-small-1-2  pos-rel uk-width-1-1  uk-padding-v-normal uk-td uk-row-0">                           
                              <span class="mobile-label uk-hidden-large">Image</span><img src="{!!url(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.SMALL_IMAGE.$carts->image)!!}" alt="{{ $carts->product_name }}" width="39" height="39" />

                              <div class="uk-width-1-1 action-buttons">                         
                                    <a  href="#view-modal-order-history-0" data-uk-modal onClick="orderRecords('{{ $carts->order_no }}')"><i class="uk-icon-search ion ion-ios-search-strong"></i></a>
                                    
                              </div>
                        </div>
                        <div id="view-modal-order-history-0" class="uk-modal">
                              <div class="uk-modal-dialog">
                                    <a href="" class="uk-modal-close uk-close"></a>
                                    <div class="uk-modal-header"><h1><span id="productCode"></span></h1></div>
                                    
                                    <span id="productDESC"></span>
                                    <div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
                                          
                                          <div class="pos-rel uk-width-medium-1-2  uk-width-1-1    uk-padding-v-normal uk-td">                              
                                                <span class="full-width ">Image</span><img id="productImage" src="" alt="" width="706" height="639" />
                                                 <div class=" full-width uk-margin-small-top">                                                  
                                                  <label for="paid" class="lbl bold black roboto"><span class="uk-icon-thumbs-up"></span> Paid</label>
                                                </div>
                                          </div>
                                          <div class="pos-rel uk-width-medium-1-2  uk-width-1-1    uk-padding-v-normal uk-td">
                                                <div class="full-width uk-padding-v-normal uk-td">                             
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Date</span> <span id="productDate"></span> </label>
                                                </div>
                                                <div class="full-width uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Payments</span><span id="productPayments"></span></label>
                                                </div>
                                                <div class="full-width   uk-padding-v-normal uk-td ">                              
                                                      <label  class="table-text light"><span class="mobile-label uk--large">Commission</span>$<span id="productCommission"></span></label>
                                                </div>
                                                <div class="full-width   uk-padding-v-normal uk-td">                              
                                                      <label  class="table-text light"><span class="mobile-label uk--large">From</span><span id="clientFrom"></span></label>
                                                </div>
                                                <div class="full-width  uk-padding-v-normal uk-td">                            
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Transaction ID</span><span id="transactionID"></span></label>
                                                </div>
                                                <div class="full-width  uk-padding-v-normal uk-td ">                           
                                                      <label  class="full-width table-text light"><span class="mobile-label uk--large">Item Details</span><span id="itemDetails"></span></label>
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

	        </div>
               <div class="uk-row">
                        {!! $cart->render() !!}
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
            }   
	</script>
@stop
