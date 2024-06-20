@extends('layouts._front.shoppingcart')

@section('content')
<?php
$discount_amount = $sub_total = $grand_total = 0;
if(Session::has('couponAmount')){
    $discount_amount = Session::get('couponAmount');
}
?>
   @include("home.includes.shoppingcartnav")
 <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top">
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">
    <div class="uk-width-1-1">
        @if (session()->has('message'))
            <div id="" style="padding:15px;" class="uk-alert uk-text-center uk-text-large uk-alert-success uk-margin-large-bottom"><i class="uk-icon uk-icon-check-circle"></i> <strong>Success:</strong> Your shopping cart has been updated.</div><!-- text updated based on QAR -->
        @endif
        {!! Form::open(array('url' => '/shopping-cart/update', 'method' => 'post', 'id' => 'pageform', 'class' => 'row-fluid bill-info')) !!}

        <table class="uk-table cart-order-list">
            <thead>
                <tr class="cart-hdr">
                    <th class="hdr-panel5"></th>
                    <th class="hdr-panel1 uk-text-center text-uppercase">Product</th>
                    <th class="hdr-panel2 text-left text-uppercase">Price</th>
                    <th class="hdr-panel3 text-left text-uppercase">Quantity</th>
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
                <?php
                $image_width=60;
                $image_height = 20;
                if($carts->fldProductIsVertical > 0){
                    $image_width=20;
                    $image_height = 60;
                }
                ?>
                <tr class="tr-{{$carts->fldProductIsVertical}}">
                    <td class="tp5 uk-vertical-align">
                         <a href="{{url('shopping-cart/delete/'.$carts->temp_cart_id)}}" class="uk-vertical-align-middle" onClick="return confirm(&quot;Are you sure you want to remove this product from your shopping cart?\n\nPress OK to delete.\nPress Cancel to go back without deleting the product from your shopping cart.\n&quot;)"><i class="uk-icon-close"></i></a>
                    <td class="tp1 uk-vertical-align">
                        <div class="uk-position-relative uk-display-block uk-width-1-1">
                        	<div class="uk-width-large-4-10 uk-width-medium-1-2 uk-width-1-1 uk-float-left cart-image-holder">
                            @if($carts->fldTempCartFrameInfo != "")
                                {!! Html::image('https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl=https://clarkincollection.com/new/'.PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.SMALL_IMAGE.$carts->image.'&imgHI='.$image_height.'&imgWI='.$image_width.'&maxW=200&maxH=200&m1b=1&off=0.375&sku='.$carts->fldTempCartFrameInfo.'&frameW='.$carts->fldTempCartMatBorderSize) !!}

                                {{-- Html::image('https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl=https://clarkincollection.com/new/'.PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.SMALL_IMAGE.$carts->image.'&imgHI='.$image_height.'&imgWI='.$image_width.'&maxW=200&maxH=200&m1b=1&off=0.375&sku='.$carts->fldTempCartFrameInfo.'&frameW='.$carts->fldTempCartMatBorderSize) --}}
                            @else
                                {!! Html::image(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.SMALL_IMAGE.$carts->image) !!}
                            @endif
                            </div>
                            <div class="uk-width-large-6-10 uk-width-medium-1-2 uk-width-1-1 uk-float-left  cart-text-holder ">
                                <h3 class="uk-h3 uk-margin-bottom-remove"><a href="{{url('products/details/'.$carts->fldProductSlug)}}" title="{{ $carts->product_name }}">{{ $carts->product_name }}</a></h3>
				@if($carts->fldTempCartFrameDesc)
                                <div class="cart-item-more-info"><span class="frame-label uk-text-small">Frame:</span> {{$carts->fldTempCartFrameDesc}}</div>
                @endif
                
               
                    <!-- <div class="cart-item-more-info"><span class="frame-label uk-text-small">Sequnce:</span>123</div>
                    -->
                                <div class="cart-item-more-info"><span class="frame-label uk-text-small">Border Size:</span> {{$carts->fldTempCartImageSize}}</div>
				<!-- @if($carts->fldTempCartLinerDesc)
                                	<div class="cart-item-more-info"><span class="frame-label uk-text-small">Liner:</span> {{ $carts->fldTempCartLinerDesc }} {{-- $carts->fldTempCartLinerSku --}}</div>
				@endif -->
                                @if($carts->printName)
                                	<div class="cart-item-more-info"><span class="frame-label uk-text-small">Print:</span> {{ $carts->printName }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="tp2 uk-vertical-align"><strong>${{ $carts->product_price }}</strong></td>
                    <td class="tp3 uk-vertical-align">

                        <div data-trigger="spinner" class="input-append uk-form-width-mini spinner lighter" style="max-width:100px;">
                            <input type="text" data-step="1" data-min="1" data-max="1000" id="quantity" name="qty[]" value="{{$carts->quantity}}">
                            <div class="add-on">
                              <a data-spin="up" class="spin-up" href="javascript:;"><i class="uk-icon-sort-up"></i></a>
                              <a data-spin="down" class="spin-down" href="javascript:;"><i class="uk-icon-sort-down"></i></a>
                            </div>
                          </div>
                        {!! Form::hidden('cartId[]',$carts->temp_cart_id) !!}
                    </td>
                    <td class="tp4 uk-vertical-align"><strong>${{ number_format($carts->total,2) }}</strong></td>
                </tr>
            @endforeach

            </tbody>
            <tfoot>
                <tr class="border-top border-bottom">
                    <td colspan="3" class="uk-text-right">
                        
                    </td>
                    <td  colspan="2" class="total-cart-price uk-text-right">   
                        <a href="collection">{!! Form::button('Continue Shopping',array('class'=>'uk-button uk-button-grey uk-button-primary','name'=>'continue'))!!}</a> &nbsp; 
                        {!! Form::submit('UPDATE CART',array('class'=>'uk-button uk-button-grey uk-button-primary','name'=>'update'))!!}</td>
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
                    <?php
                    /*
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
                    */
                    ?>

                     <div class="uk-grid uk-margin-remove  normalize sub-total-div border-bottom border-bottom-small" id="coupon_code">
                        <div class="uk-width-3-10  uk-padding-remove  uk-width-1-1">Discount</div>  <div class="uk-width-7-10 uk-width-1-1 bold total-cart-price payment"><span id="coupon_amount">@if($discount_amount > 0) - @endif $ {!!number_format($discount_amount,2)!!}</span></div>
                    </div>

                    <div class="uk-grid uk-margin-remove  normalize sub-total-div border-bottom border-bottom-small" id="">
                        <div class="uk-width-3-10  uk-padding-remove  uk-width-1-1">TOTAL</div>  <div class="uk-width-7-10 uk-width-1-1 bold total-cart-price payment">$ <span id="Grandtotal">{{ number_format($cart[0]->grandtotal,2) }}</span></div>
                    </div>


                    <div>


                        <div  class="cart-functions uk-margin-medium-top">

                        <? // print_r(Session::all()); ?>
                        <!-- INSERT COUPON SECTIO HERE -->
                        
                            <div class="coupon_wrapper">
                                <div id="coupon_error" style="display:none; margin-bottom:10px; max-width: 288px;" class="uk-alert uk-alert-danger uk-alert-error">Invalid Code</div>
                                <div id="coupon_error_success" style="display:none; margin-bottom:10px;  max-width: 288px;" class="uk-alert uk-alert-success"><strong>Success!</strong> Code is valid!</div>
                                <div class="coupon_wrapper--couponbox">
                                     {!! Form::text('coupon','',array('id'=>'coupon','placeholder'=>'Enter Code','class'=>'text text-small coupon-field')) !!}
                                    <button type="button" name="coupon_check" class="uk-button uk-button-grey uk-button-primary" onclick="checkCoupon({{ $cart[0]->subtotal }})">APPLY CODE</button>
                                </div>
                                <br>
                                <strong>Note</strong>: Be sure to click the Apply Code Box to apply your Promo Code.
                            </div>
                            <div class="btn-group">
                                 {!! Form::hidden('total',$cart[0]->subtotal) !!}
                                {!! Form::submit('Proceed to Checkout',array('class'=>'uk-button uk-button-grey uk-button-small uk-button-primary full-width text-uppercase','name'=>'checkout'))!!}

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

<style type="text/css">
.cart-image-holder {
    max-width: 205px;
    text-align: center;
    padding-bottom: 20px;
    padding-right: 10px;
}
tr:nth-child(even) { background: #CCCCCC; }
@media(min-width: 768px){
    .tr-1 .cart-text-holder { padding-top: 10%; }
}
</style>
	<script language="javascript">

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

}
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
    						$("#coupon_amount").text("$ "+parseFloat(itemVal).toFixed(2));
    						$("#Grandtotal").text(""+ formatNumber(parseFloat(total).toFixed(2)));
    					} else if(items[0] == "Free Shipping") {
    						$("#coupon_error").hide();
                            $("#coupon_code").show();

    						var itemVal = 0;
    						$("#coupon_amount").text("Free Shipping"); $("#coupon_error_success").show();
    						$("#Grandtotal").text(""+formatNumber(parseFloat(total).toFixed(2)));
    					} else {
    						$("#coupon_error").hide();	$("#coupon_error_success").show();
                            $("#coupon_code").show();
    						$("#coupon_amount").text(" - $"+parseFloat(items[0]).toFixed(2));
    						$("#Grandtotal").text(" "+formatNumber(parseFloat(items[1]).toFixed(2)));

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
           loadScript("{!!url('_front/plugins/spinner/src/jquery.spinner.js')!!}", function(){  });
		});



	</script>
@stop