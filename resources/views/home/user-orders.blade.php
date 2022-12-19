@extends('layouts._front.shoppingcart')
@section('content')
{{-- */$active1="";$active2="";$active3="";$active4="class=uk-active";$active5="";/* --}}
  

  <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top"> 
     <div class="uk-container uk-container-center uk-margin-medium-bottom">
        <article id="main" role="main">
            <div class="uk-grid">
                <div class="uk-width-medium-6-10 uk-width-1-1">               
                     <h1 class="uk-h2 text-uppercase">Order History</h1>        
            @if (count($orderData)==0) 
            	<div id="alert alert-error">No Order History Found</div>
            @endif
            
            <div class="uk-accordion"  data-uk-accordion>
            	 {{-- */$octr=0;/* --}}  
                @foreach($orderData as $orderDatas)
                	 {{-- */$octr=$octr+1/* --}} 
				 	<h5 class="uk-accordion-title">
						<!-- Entry Tab -->
						<table width="100%" cellspacing="0" cellpadding="5">
							<tbody>
								<tr>
									<td width="85%">										
										<table width="100%">
											<tbody>
												<tr>
													<td width="15%">Order Number:</td>
													<td width="25%">{{ $orderDatas['order_no'] }}</td>
                                                    <td width="10%">Order Date:</td>
													<td width="30%">{{ date('F d, Y',strtotime($orderDatas['order_date'])) }}</td>
												</tr>
												<tr>
													<td>Shipping and Handling:</td>
													<td id="shipping{{ $octr }}"></td>
                                                    <td>Amount:</td>
													<td  id="amount{{ $octr }}"></td>
												</tr>                                               
											</tbody>
										</table> 
										
									</td>								
								</tr>
							</tbody>
						</table>
                  </h5> 
                   <div class="uk-accordion-content">
							<!-- Entry Content -->
							<div class="uk-overflow-container">
							<table class="uk-table ">
								<thead>
									<tr>
										<td class="item">Product Name</td>										
										<td class="qty">Qty</td>
										<td class="amount">Amount</td>
                                        <td class="amount">Sub Total</td>
									</tr>
								</thead>
								<tbody>
                                	  {{-- */$subtotal=0; $cart = App\Models\Cart::displayCart($orderDatas['order_no']);/* --}}  
                         	                       	
                        	
                             		 @foreach($cart as $carts)
                                        {{-- */
                                                $total =  $carts->quantity * $carts->product_price;
                                                $subtotal = $subtotal + $total;    
                                        /* --}} 
									<tr>
                                    	<td>
                                    		@if($carts->image != "")	
                                    			{!! Html::image('upload/products/'.$carts->product_id.'/_75_'.$carts->image) !!}
                                    		@else
                                    			{!! Html::image('_front/assets/images/no-image.jpg','',array('width'=>'75')) !!}
                                    		@endif	

                                    		<br /><br />{{ $carts->product_name }}</td>         										
										<td>{{ $carts->quantity }}</td>
										<td>$ {{ number_format($carts->product_price,2) }}</td>
                                        <td>$ {{ number_format($total,2) }}</td>
									</tr>
                                  @endforeach							
									<tr>
										<td>
											<strong></strong>
										</td>
										<td colspan="4" class="subtotal">
											<table width="100%">
												<tbody>
													<tr>
														<td>Item(s) Subtotal:</td>
														<td>$ {{ number_format($subtotal,2) }}</td>
													</tr>
                                                    {{-- */ $cartData = App\Models\Cart::displayCheckout($orderDatas['order_no']); /* --}}
                                                    @if($cartData->coupon_code != "") 
                                                    	   {{-- */ $subtotal = $subtotal - $cartData->coupon_price;  /* --}}                                             
                                                            <tr>
                                                                <td>Coupon Code:</td>
                                                                <td>$ {{ number_format($cartData->coupon_price,2) }}</td>
                                                            </tr>
                                                    @endif
                                                    
                                                    @if($cartData->shipping_name != "") 
                                                    	 {{-- */ $subtotal = $subtotal + $cartData->shipping_amount;  /* --}}  
                                                    	 <tr>
                                                                <td>Shipping & Handling:</td>
                                                                <td>{{ $cartData->shipping_name }}  ${{ number_format($cartData->shipping_amount,2) }}</td>
                                                          </tr>
                                                    @endif
                                                 	
                                                    @if($cartData->tax != "") 
                                                    	{{-- */ $subtotal = $subtotal + $cartData->tax;  /* --}}  
                                                        <tr>
                                                            <td>Sales Tax:</td>
                                                            <td>$ {{ number_format($cartData->tax,2) }} </td>
                                                        </tr>
                                                    @endif
                                                   
													<tr class="total">
														<td>Grand Total:</td>
														<td><strong>$ {{ number_format($subtotal,2) }}</strong></td>
													</tr>
                                                    
												</tbody>
											</table>			  										
										</td>
									</tr>
								</tbody>
							</table>
						</div>
							<!-- Entry Content -->
						</div>					
				     <script>
					 		$('#shipping{{ $octr }}').html("( {{ $cartData->shipping_name }} ) $ {{ number_format($cartData->shipping_amount,2) }}");
							$('#amount{{ $octr }}').html("$ {{ number_format($subtotal,2) }}");
					 </script>
				@endforeach

</div>
                      </div>
                      <div class="uk-width-medium-4-10 uk-width-1-1 uk-margin-top">    
                        <div class="box-bordered full-width padding-medium ">   
                             @include('home.includes.sidenav-account')
                        </div>
                       </div>
                </div><!--ukgrid -->      
            </div><!--main --> 
        <article> 
      </div><!--ukcomtainer -->  
</div><!--wid11 -->  

 
@stop

@section('headercodes')
	{!! Html::style('_front/uikit/css/components/accordion.min.css') !!} 
@stop

@section('extracodes')
  {!! Html::script('_front/uikit/js/components/accordion.min.js') !!}
@stop
