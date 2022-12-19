@extends('layouts._front.pages')

@section('content')
   
  <div class="row top15">    	  	 	      
      <div class="col-xs-5 col-sm-offset-1 col-sm-11 col-md-offset-1 col-md-11">
      		 <ul class="breadcrumb">
                    <li>{{ HTML::link('/','Home') }} <span class="divider"></span></li>
                    <li class="active">Checkout</li>                    
             </ul>       
             <h3>Checkout</h3>
            	 <div>
                    <section class="clearfix">
                        
                        {{ Form::open(array('url' => '/checkout', 'method' => 'post',  'class' => 'row-fluid bill-info','id'=>'page_form')); }}                        
                            <div class="row">
                                <div class="col-xs-7 col-sm-6 col-md-6">
                                    <h4>Billing Information</h4>                                  
                                    <fieldset class="form-inline">
                                    	{{ Form::label('firstname', 'First Name',array('style'=>'width:120px')); }}
                                        {{ Form::text('firstname',isset($billing->firstname) ? $billing->firstname : "",array('id'=>'firstname','required','class'=>'form-control')) }}                                        
                                    </fieldset>
                                      <fieldset class="form-inline">
                                    	{{ Form::label('lastname', 'Last Name',array('style'=>'width:120px')); }}
		                                {{ Form::text('lastname',isset($billing->lastname) ? $billing->lastname : "",array('id'=>'lastname','required','class'=>'form-control')) }}
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('address', 'Address',array('style'=>'width:120px')); }}
		                                {{ Form::text('address',isset($billing->address) ? $billing->address : "",array('id'=>'address','required','class'=>'form-control')) }}
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('address1', 'Address 2',array('style'=>'width:120px')); }}
		                                {{ Form::text('address1',isset($billing->address1) ? $billing->address1 : "",array('id'=>'address1','class'=>'form-control')) }}
                                    </fieldset>
                                    <fieldset class="form-inline">
                                        {{ Form::label('city', 'City',array('style'=>'width:120px')); }}
		                                {{ Form::text('city',isset($billing->city) ? $billing->city : "",array('id'=>'city','required','class'=>'form-control')) }}
                                    </fieldset>
                                    <fieldset class="form-inline">
                                        <!--<label for="state" style="width:120px"><span id="stateBillingText">State</span></label>-->
                                        {{ Form::label('state', 'State'); }}
                                        <span id="billingstateus">                                      
                                        {{ Form::select('state',array('0' => 'Select one')+StateManagement::displayState(),isset($billing->state) ? $billing->state : "0",array('onchange' => 'checkTax(this.value)', 'id'=>'state','data-placeholder'=>'Select State','class'=>'form-control')) }}
                                        </span>
                                    </fieldset>
                                    <fieldset class="form-inline">
                                        {{ Form::label('country', 'Country'); }}                                      
                                        {{ Form::select('country',array('0' => 'Select one')+CountryManagement::displayCountry(),isset($billing->country) ? $billing->country : "US",array('id'=>'country','data-placeholder'=>'Select Country','class'=>'form-control')) }}
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('zip', 'Zip Code',array('style'=>'width:120px')); }}
		                                {{ Form::text('zip',isset($billing->zip) ? $billing->zip : "",array('id'=>'zip','required','class'=>'form-control')) }}
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('phone', 'Phone Number',array('style'=>'width:120px')); }}
		                                {{ Form::text('phone',isset($billing->phone) ? $billing->phone : "",array('id'=>'phone','required','class'=>'form-control')) }}
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('email', 'Email Address',array('style'=>'width:120px')); }}
		                                {{ Form::email('email',isset($billing->email) ? $billing->email : "",array('id'=>'email','required','class'=>'form-control')) }}
                                    </fieldset>
                                    <fieldset>                                    	
                                        <label class="checkbox" style="font-size:smaller">
                                            <input type="checkbox" name="chkShip" id="chkShip" value="yes" onclick="chkClickInfo()"> Click here if your shipping information is the same as your billing information
                                        </label>
                                    </fieldset>
                                </div>
                                <div class="col-xs-4 col-sm-6 col-md-6">
                                    <h4>Shipping Information</h4>
                                    
                                    <fieldset class="form-inline">
                                    	{{ Form::label('shipping_firstname', 'First Name',array('style'=>'width:120px')); }}
		                                {{ Form::text('shipping_firstname',isset($shipping->firstname) ? $shipping->firstname : "",array('id'=>'shipping_firstname','required','class'=>'form-control')) }}                                       
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('shipping_lastname', 'Last Name',array('style'=>'width:120px')); }}
		                                {{ Form::text('shipping_lastname',isset($shipping->lastname) ? $shipping->lastname : "",array('id'=>'shipping_lastname','required','class'=>'form-control')) }}                                        
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('shipping_address', 'Address',array('style'=>'width:120px')); }}
		                                {{ Form::text('shipping_address',isset($shipping->address) ? $shipping->address : "",array('id'=>'shipping_address','required','class'=>'form-control')) }} 
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('shipping_address1', 'Address 2',array('style'=>'width:120px')); }}
		                                {{ Form::text('shipping_address1',isset($shipping->address1) ? $shipping->address1 : "",array('id'=>'shipping_address1','class'=>'form-control')) }}                                         
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('shipping_city', 'City',array('style'=>'width:120px')); }}
		                                {{ Form::text('shipping_city',isset($shipping->city) ? $shipping->city : "",array('id'=>'shipping_city','required','class'=>'form-control')) }} 
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	<!--<label for="shipping_state" style="width:120px"><span id="stateShippingText">State</span></label>-->
                                    	{{ Form::label('shipping_state', 'State'); }}
                                        <span id="shippingstateus">                                      
                                        {{ Form::select('shipping_state',array('0' => 'Select one')+StateManagement::displayState(),isset($shipping->state) ? $shipping->state : "0",array('id'=>'shipping_state','data-placeholder'=>'Select State','class'=>'form-control')) }}
                                        </span>                                                                               
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('shipping_country', 'Country'); }}                                      
                                        {{ Form::select('shipping_country',array('0' => 'Select one')+CountryManagement::displayCountry(),isset($shipping->country) ? $shipping->country : 'US',array('id'=>'shipping_country','data-placeholder'=>'Select Country','class'=>'form-control')) }}                                       
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('shipping_zip', 'Zip Code',array('style'=>'width:120px')); }}
		                                {{ Form::text('shipping_zip',isset($shipping->zip) ? $shipping->zip : "",array('id'=>'shipping_zip','required','class'=>'form-control')) }}                                        
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('shipping_phone', 'Phone Number',array('style'=>'width:120px')); }}
		                                {{ Form::text('shipping_phone',isset($shipping->phone) ? $shipping->phone : "",array('id'=>'shipping_phone','required','class'=>'form-control')) }} 
                                    </fieldset>
                                    <fieldset class="form-inline">
                                    	{{ Form::label('shipping_email', 'Email Address',array('style'=>'width:120px')); }}
		                                {{ Form::text('shipping_email',isset($shipping->email) ? $shipping->email : "",array('id'=>'shipping_email','required','class'=>'form-control')) }}                                         
                                    </fieldset>                                   
                                </div>
                            </div>
                        
            
                        <div id="shippingRateDisplay" class="row">
                        	<div class="col-md-12">
	                            <h4>Shipping Rate <small>(Shipping Weight: {{ $cart[0]->weight }} lbs.)</small></h4>                            
    	                       <div id="shipping_rate">{{ HTML::image('_front/assets/images/ajax-loader.gif') }}</div>
                            </div>    
                        </div>    
            
                        <fieldset>
                            <legend><h4>Payment Method</h4></legend>
                                    @include('home.payment')                
                            </fieldset>
                                           
                    <table class="table table-bordered cart-order-list">
                        <thead>
                            <tr class="cart-hdr">
                                <th class="hdr-panel5"> <i class="icon-trash icon-white"></i> </th>
                                <th class="hdr-panel1">Item Name</th>
                                <th class="hdr-panel2">Price</th>
                                <th class="hdr-panel3">QTY</th>
                                <th class="hdr-panel4">Item Total</th>
                            </tr>
                        </thead>
                        <tbody>                           
                              @foreach($cart as $carts)                                
                                <tr>
                                    <td class="tp5">                                    	
										 {{ HTML::image_link_delete('shopping-cart/delete/'.$carts->temp_cart_id,'_admin/assets/images/icons/page_delete.png') }}          
                                    <td class="tp1">
                                    @if($carts->image != "") 
	                                    {{ HTML::image('upload/products/'.$carts->product_id.'/_75_'.$carts->image) }}
                                    @else
                                    	{{ HTML::image('_front/assets/images/no-image-small.jpg') }}
                                    @endif    
                                    
                                    <br />{{ $carts->product_name }}                    	
                                    </td>
                                    <td class="tp2">{{ number_format($carts->product_price,2) }}</td>
                                    <td class="tp3">
                                        {{ Form::text('qty[]',$carts->quantity) }} 
                                        {{ Form::hidden('cartId[]',$carts->temp_cart_id) }} 
                                    </td>
                                    <td class="tp4"> {{ number_format($carts->total,2) }}</td>
                                </tr>
                            @endforeach 
                                
                       
                        </tbody>
                        <tfoot>
                            <tr class="cart-ftr">
                                <td colspan="4" align="right">Sub Total</td>
                                <td class="total-cart-price">{{ number_format($cart[0]->subtotal,2) }}</td>
                            </tr>   
                           	 
                                {{ Form::hidden('freeshipping',$coupon_code->freeshipping) }} 
                                @if($coupon_code->freeshipping == 'yes')
                                	{{ Form::hidden('shipping_rate_value','0') }}                                 	
                                @endif
                                <tr>
                                    <td colspan="4" align="right"><strong>Tax </strong></td>                   
                                    <td class="total-cart-price"><span id="tax"> $ {{ number_format($coupon_code->tax,2) }}</span></td>
                                </tr>
                               	@if($cart[0]->freeshipping == "no" || !Session::has('couponCode'))
                                 <tr>
                                    <td colspan="4" align="right"><strong>Shipping ( <span id="shipping_name_value"></span> ) </strong></td>                   
                                    <td class="total-cart-price"><span id="shipping_price_value"></span></td>
                                </tr>
                                @endif
                                                             
                            	@if(Session::has('couponCode'))	
                                <tr>
                                    <td colspan="2" align="right">Discount Code <br> <small></small></td>
                                    <td colspan="2"> 
                                               {{ Session::get('couponCode') }}               
                                    </td>
                                    <td class="total-cart-price"><span id="coupon_amount">$ {{ number_format($cart[0]->coupon_amount,2) }}</span></td>
                            	</tr>
                            	@endif

                                {{ Form::hidden('coupon_code',Session::get('couponCode')) }} 
                                {{ Form::hidden('coupon_price',$cart[0]->coupon_amount) }} 
                                {{ Form::hidden('total',number_format($cart[0]->grandtotal,2),array('id'=>'total')) }} 
                                {{ Form::hidden('tax',$tax,array('id'=>'taxvalue')) }} 

                            <tr>
                                <td colspan="4" align="right"><strong>Grand Total</strong></td>                   
                                <td class="total-cart-price payment"><span id="Grandtotal">$ {{ number_format($cart[0]->grandtotal,2) }}</span></td>
                            </tr>	
                            <tr>
                                <td colspan="5" class="cart-functions">
                                		{{ Form::hidden('client_id',Session::get('client_id')) }} 

                                    <div class="btn-group">
                               
                                        {{ Form::submit('Purchase',array('name'=>'submit_bill','class'=>'btn btn-small btn-warning','id'=>'submit_bill'))}}
                                    </div>
                                </td>
                            </tr>    		
                        </tfoot>
                    </table>
                   {{ Form::close() }} 
                    </section>
                </div>
                
      </div>		
  </div>	
      


<script language="javascript">
	city = document.getElementById('shipping_city').value;
	state = document.getElementById('shipping_state').value;
	state = state.replace(" ","%20");
	zip = document.getElementById('shipping_zip').value;
	zip = zip.replace(" ","%20");
	country = document.getElementById('shipping_country').value;
	city=city.replace(/ /g,"_");
	
	function chkClickInfo() {
			
			if($("#chkShip").is(':checked')) {				

				document.getElementById('shipping_firstname').value = document.getElementById('firstname').value;
				document.getElementById('shipping_lastname').value = document.getElementById('lastname').value;
				document.getElementById('shipping_address').value = document.getElementById('address').value;
				document.getElementById('shipping_address1').value = document.getElementById('address1').value;
				document.getElementById('shipping_city').value = document.getElementById('city').value;								
				document.getElementById('shipping_zip').value = document.getElementById('zip').value;
				document.getElementById('shipping_phone').value = document.getElementById('phone').value;
				document.getElementById('shipping_email').value = document.getElementById('email').value;
				$("#shipping_state option[value='"+document.getElementById('state').value+"']").attr("selected","selected");
				$("#shipping_country option[value='"+document.getElementById('country').value+"']").attr("selected","selected");
				city = document.getElementById('shipping_city').value;
				state = document.getElementById('shipping_state').value;
				zip = document.getElementById('shipping_zip').value;
				country = document.getElementById('shipping_country').value;
				city=city.replace(/ /g,"_");
				
				if(zip != "") { 
					
					<? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
				
					var total = document.getElementById("total").value;
					
					$('#shipping_rate').show();					
					$('#shipping_rate').load('shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);
					//display the shipping rate	
					$('#shippingRateDisplay').show();	
					<? } else { ?>
						$('#shippingRateDisplay').hide();	
					<? } ?>
				}
								
				
			} else {
				document.getElementById('shipping_firstname').value = "<?=stripslashes($shipping->lastname)?>";
				document.getElementById('shipping_lastname').value = "<?=stripslashes($shipping->firstname)?>";
				document.getElementById('shipping_address').value = "<?=stripslashes($shipping->address)?>";
				document.getElementById('shipping_address1').value = "<?=stripslashes($shipping->address1)?>";
				document.getElementById('shipping_city').value = "<?=stripslashes($shipping->city)?>";								
				document.getElementById('shipping_zip').value = "<?=$shipping->zip?>";
				document.getElementById('shipping_phone').value = "<?=$shipping->phone?>";
				document.getElementById('shipping_email').value = "<?=$shipping->email?>";
				city = document.getElementById('shipping_city').value;
				state = document.getElementById('shipping_state').value;
				zip = document.getElementById('shipping_zip').value;
				country = document.getElementById('shipping_country').value;
				city=city.replace(/ /g,"_");
				
				if(zip != "") { 
					
					<? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
				
					var total = document.getElementById("total").value;
					
					$('#shipping_rate').show();					
					$('#shipping_rate').load('shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);
					//display the shipping rate	
					$('#shippingRateDisplay').show();	
					<? } else { ?>
						$('#shippingRateDisplay').hide();	
					<? } ?>
				}	
			}
		}
		
		function checkTax(state) {	


			$.ajax({	
				type: "GET",				
				url: "compute-tax/"+state+"/"+<?=$cart[0]->grandtotal?>,			
				cache: false,
				success: function(data){	
					var items = JSON.parse(data);									
					$("#tax").text("+ $ "+parseFloat(items[0]).toFixed(2));					
					$("#Grandtotal").text("$ "+parseFloat(items[1]).toFixed(2));
					$("#taxvalue").val(parseFloat(items[0]).toFixed(2));
					$("#total").val(parseFloat(items[1]).toFixed(2));
				}
			});	
		}
		
		if(document.getElementById('shipping_zip').value == "") {
			$('#shippingRateDisplay').hide();
		}
		
		 $(document).ready(function() {
				
		
		$('#shipping_zip').blur(function() {				
				
				city = document.getElementById('shipping_city').value;
				state = document.getElementById('shipping_state').value;
				state = state.replace(" ","%20");
				zip = document.getElementById('shipping_zip').value;
				zip  = zip.replace(" ","%20");
				country = document.getElementById('shipping_country').value;
				city=city.replace(/ /g,"_");	
				
				<? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
					$('#shipping_rate').show();
					$('#shipping_rate').load('spin.php');
					$('#shipping_rate').load('shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);
					$('#shippingRateDisplay').show();
				<? } else { ?>
						$('#shippingRateDisplay').hide();	
					<? } ?>
				
		});
		
				
		$('#shipping_state').change(function() {				
				
				city = document.getElementById('shipping_city').value;
				state = document.getElementById('shipping_state').value;
				state = state.replace(" ","%20");
				zip = document.getElementById('shipping_zip').value;
				country = document.getElementById('shipping_country').value;
				zip  = zip.replace(" ","%20");
				city=city.replace(/ /g,"_");	
				
				if(document.getElementById('shipping_country').value == "US") {
					<? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
						$('#shipping_rate').load('spin.php');
						$('#shipping_rate').load('shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);
						$('#shippingRateDisplay').show();	
					<? } else { ?>
						$('#shippingRateDisplay').hide();	
					<? } ?>
				}
		});
		
		$('#shipping_country').change(function() {				
				
				city = document.getElementById('shipping_city').value;
				state = document.getElementById('shipping_state').value;
				state = state.replace(" ","%20");
				zip = document.getElementById('shipping_zip').value;
				zip  = zip.replace(" ","%20");
				country = document.getElementById('shipping_country').value;
				city=city.replace(/ /g,"_");	
				
				
				if(document.getElementById('shipping_country').value != "US") {
					$('#shippingstateus').html('<input type=text name=shipping_state id=shipping_state>');		
					$('#stateShippingText').html('State/Province');			
				} else {		
					$('#shippingstateus').load("loadState.php");
					$('#stateShippingText').html('State');		
					<? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
						$('#shipping_rate').load('spin.php');
					$('#shipping_rate').load('shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);
						$('#shippingRateDisplay').show();
					<? } else { ?>
						$('#shippingRateDisplay').hide();	
					<? } ?>
				}
				
				
				
		});
		
		$('#billing_country').change(function() {				
			if(document.getElementById('billing_country').value != "US") {
				$('#billingstateus').html('<input type=text name=state id=state>');
				$('#shippingstateus').html('<input type=text name=shipping_state id=shipping_state>');
				$('#stateBillingText').html('State/Province');
				$('#stateShippingText').html('State/Province');
				$("#shipping_country option[value='"+document.getElementById('billing_country').value+"']").attr("selected","selected");
					state="";
					checkTax(state);
			} else {
				$("#shipping_country option[value='"+document.getElementById('billing_country').value+"']").attr("selected","selected");
				$('#billingstateus').load("loadState.php");
				$('#stateBillingText').html('State');
				$('#shippingstateus').load("loadShipping.php");
				$('#stateShippingText').html('State');				
				
			}
			
		});
		
				city = document.getElementById('shipping_city').value;
				state = document.getElementById('shipping_state').value;
				state = state.replace(" ","%20");
				zip = document.getElementById('shipping_zip').value;
				zip  = zip.replace(" ","%20");
				country = document.getElementById('shipping_country').value;
				city=city.replace(/ /g,"_");	
				state_billing = document.getElementById('state').value;
				
				if(state_billing != "") {stateTax = state_billing; } else {state_billing = state;}
				
				if(stateTax != "") { checkTax(stateTax); }
				
				
				if(zip != "") { 
					
					<? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
						$('#shipping_rate').show();
						$('#shipping_rate').load('spin.php');
						$('#shipping_rate').load('shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);
						$('#shippingRateDisplay').show();
					<? } else { ?>
							$('#shippingRateDisplay').hide();	
					<? } ?>
				}
			
   });
   
    $(document).ready(function() {
				$("#subcont, #subcont2").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
	});
		
</script>
@stop

@section('headercodes')	
{{ HTML::script('_front/assets/js/jquery.mCustomScrollbar.concat.min.js') }}
@stop