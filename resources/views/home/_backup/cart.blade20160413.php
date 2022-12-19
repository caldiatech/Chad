@extends('layouts._front.shoppingcart')

@section('content')        
   @include("home.includes.shoppingcartnav")

 <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top"> 
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">
    <div class="uk-width-1-1">                     
        {!! Form::open(array('url' => '/shopping-cart/update', 'method' => 'post', 'id' => 'pageform', 'class' => 'row-fluid bill-info')) !!}
       
        <table class="uk-table cart-order-list">
            <thead>
                <tr class="cart-hdr">
                    <th class="hdr-panel5"></th>
                    <th class="hdr-panel1 text-center text-uppercase">Product</th>
                    <th class="hdr-panel2 text-left text-uppercase">Price</th>
                    <th class="hdr-panel3 text-left text-uppercase">QTY</th>
                    <th class="hdr-panel4 text-left text-uppercase">Total</th>
                </tr>
            </thead>
            <tbody>

               
         

            @if ($cart->isEmpty() || ($cart_count == 0)) 
              <tr>
                <td colspan="5" class="uk-text-danger"><div class="uk-width-medium-1-2  uk-text-center uk-margin-medium-top  uk-container-center"><strong>Your Shopping Cart is Empty</strong></div></td>
              </tr>
             @else 
               
                  
              @foreach($cart as $carts) 

                @if(empty($carts->product_price)) $carts->product_price = 0; @endif  
                @if(empty($carts->total)) $carts->total = 0; @endif  

                <tr>
                    <td class="tp5 uk-vertical-align">                                	                         
                         <a href="{{url('shopping-cart/delete/'.$carts->temp_cart_id)}}" class="uk-vertical-align-middle"><i class="fa fa-close"></i></a>        
                    <td class="tp1 uk-vertical-align">
                        <div class="uk-vertical-align-middle">
                        	<div class="pull-left cart-image-holder">
                            @if($carts->image != "") 
                                {!! Html::image(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.SMALL_IMAGE.$carts->image) !!}
                            @else
                                 {!! Html::image('_front/assets/images/no-image-small.jpg') !!}	
                            @endif
                            </div>    
                            <div class="pull-left  cart-text-holder uk-margin-large-left uk-vertical-align">
                                <h3 class="uk-h3 uk-margin-bottom-remove">{{ $carts->product_name }} </h3>
                                <div class="w100 grey">{!! substr($carts->fldProductDescription, 0, 50) !!}</div>
                            </div> 
                        </div>                   	
                    </td>
                    <td class="tp2 uk-vertical-align"><strong>${{ number_format($carts->product_price,2) }}</strong></td>
                    <td class="tp3 uk-vertical-align">
                        <input type="number" class="text number-only" name="qty[]" id="quantity" value="{{$carts->quantity}}" max="10" min="1">                        
                        {!! Form::hidden('cartId[]',$carts->temp_cart_id) !!} 
                    </td>
                    <td class="tp4 uk-vertical-align"><strong>${{ number_format($carts->total,2) }}</strong></td>
                </tr>
            @endforeach 
              
            </tbody>
            <tfoot>
                <tr class="border-top border-bottom">
                    <td colspan="3"> 
                    <div id="coupon_error" style="display:none; margin-bottom:10px;" class="uk-alert uk-alert-danger uk-alert-error">Invalid Coupon code</div>
                    <div id="coupon_error_success" style="display:none; margin-bottom:10px;" class="uk-alert uk-alert-success"><strong>Success!</strong> Coupon code is valid!</div>
                    {!! Form::text('coupon','',array('id'=>'coupon','placeholder'=>'Enter Code','class'=>'text text-small')) !!}  
                    <button type="button" name="coupon_check" class="uk-button  uk-button-primary" onclick="checkCoupon({{ $cart[0]->subtotal }})">APPLY COUPON</button>
                    </td>
                    <td  colspan="2" class="total-cart-price uk-text-right">   {!! Form::submit('UPDATE CART',array('class'=>'uk-button uk-button-primary','name'=>'update'))!!}</td>
                </tr>
            </tfoot>
           @endif
        </table>
  @if ((!$cart->isEmpty()) || ($cart_count > 0))   
        <div class="full-width uk-margin-large-top grand-total-section normal">
            <div class="uk-width-large-1-2 uk-width-1-1 uk-float-right">
                    <h3 class="uk-h2 roboto bold  uk-margin-large-bottom">Cart Total</h3>
                    <div class="uk-grid uk-margin-remove normalize sub-total-div border-bottom border-bottom-small">
                        <div class="uk-width-3-10 uk-padding-remove uk-width-1-1">SUBTOTAL</div>  <div class="uk-width-7-10 uk-width-1-1 bold"><span class="subtotal-val">$ {{ number_format($cart[0]->subtotal,2) }}</span></div>
                    </div>   
                    <div class="uk-grid uk-margin-remove  normalize shipping-div border-bottom border-bottom-small">
                        <div class="uk-width-3-10 uk-padding-remove uk-width-1-1">SHIPPING</div>
                        <div class="uk-width-7-10 uk-width-1-1">
                            <ul class="shipping-list-item list-item option-list uk-margin-remove uk-padding-remove">
                                <li><input type="radio" id="free-shipping" name="shipping" value="free-shipping"><label for="free-shipping">Free Shipping</label></li>
                                <li><input type="radio" id="local-shipping" name="shipping" value="local-shipping"><label for="local-shipping">Local Shipping (Free)</label></li>
                            </ul>
                            <a class="black bold uk-button uk-button-plain">Calculate Shipping</a>
                        </div>
                    </div> 
                    <div class="uk-grid uk-margin-remove  normalize sub-total-div border-bottom border-bottom-small">
                        <div class="uk-width-3-10  uk-padding-remove  uk-width-1-1">TOTAL</div>  <div class="uk-width-7-10 uk-width-1-1 bold total-cart-price payment">$ <span id="Grandtotal">{{ number_format($cart[0]->subtotal,2) }}</span></div>
                    </div>  
                    <div>
                        <div  class="cart-functions uk-margin-medium-top">
                            <div class="btn-group">
                                 {!! Form::hidden('total',$cart[0]->subtotal) !!}
                                {!! Form::submit('Proceed to Checkout',array('class'=>'uk-button uk-button-small uk-button-primary full-width text-uppercase','name'=>'checkout'))!!}                         
                                 
                            </div>
                        </div>
                    </div> 
            </div>
        </div>
        </div>
        @endif
      {!! Form::close() !!}
      </div>		
  </div><!--row -->	
  </div><!--row --> 
  </div><!--row --> 
  </div><!--row --> 

@stop
@section('headercodes')
	<script language="javascript">
		function checkCoupon(total) {

			var code = document.getElementById("coupon").value;
            $(".uk-alert").hide();
            $('#coupon').removeClass('uk-alert-danger');
            if($.trim(code) != ''){
    			$.ajax({	
    				type: "POST",
    				url: "coupon-code/"+code+"/"+total,
    				data: $("#pageform").serialize(),
    				cache: false,
    				success: function(data){	
                       
    					var items = JSON.parse(data);
    					if(items[0] == "error") { 
    						$("#coupon_error").show();	
    						var itemVal = 0;
    						$("#coupon_amount").text(""+parseFloat(itemVal).toFixed(2));
    						$("#Grandtotal").text(""+parseFloat(total).toFixed(2));
    					} else if(items[0] == "Free Shipping") {
    						$("#coupon_error").hide();	
    						var itemVal = 0;
    						$("#coupon_amount").text("Free Shipping"); $("#coupon_error_success").show();
    						$("#Grandtotal").text(""+parseFloat(total).toFixed(2));
    					} else {
    						$("#coupon_error").hide();	$("#coupon_error_success").show();
    						$("#coupon_amount").text(" - "+parseFloat(items[0]).toFixed(2));
    						$("#Grandtotal").text(" "+parseFloat(items[1]).toFixed(2));
    						
    					}
    				}
    		    });	
            }  else{
                $('#coupon').addClass('uk-alert-danger');
            }
			
		}
						
		$('#pageform').find('#coupon').keypress(function(e){
			
		    if ( e.which == 13 ) // Enter key = keycode 13
		    {
				checkCoupon(100);	
        		$('#coupon').focus();  //Use whatever selector necessary to focus the 'next' input
				return false;
		    }
		    
		});
		
		$(document).ready(function() {
		  $(window).keydown(function(event){
			if(event.keyCode == 13) {
			  event.preventDefault();
			  return false;
			}
		  });
		});

		
	
	</script>
@stop