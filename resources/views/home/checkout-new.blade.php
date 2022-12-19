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
                            	<div class="row-fluid" id="checkout">
                                    <div class="col-md-8" >
                                        <ul class="nav nav-tabs">
                                            <li class="active" id="billingTab"><a href="#billing" data-toggle="tab"><i class="fa fa-map-marker"></i>Billing Address</a></li>
                                            <li id="shippingTab"><a href="#shipping" data-toggle="tab"><i class="fa fa-envelope-o"></i>Shipping Address</a></li>
                                            <li id="shippingMethodTab"><a href="#method" data-toggle="tab"><i class="fa fa-truck"></i>Shipping Method</a></li>
                                            <li id="paymentMethodTab"><a href="#payment" data-toggle="tab"><i class="fa fa-money"></i>Payment Method</a></li>						
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="billing">
                                            
                                                <h2>Billing Address</h2>
                                                Please fill out your Billing information below.<hr />
                                                <div id="billingError" style="display:none;" class="text-danger">Fields mark with * are required</div>
                                                
                                                <table class="table">
                                                    <tr>
                                                        <td style="width:50%">                    
                                                            {{ Form::label('firstname', '* First Name',array('style'=>'width:120px')); }}
					                                        {{ Form::text('firstname',isset($billing->firstname) ? $billing->firstname : "",array('id'=>'firstname','required')) }}
                                                        </td>
                                                        <td>
                                                            {{ Form::label('lastname', '* Last Name',array('style'=>'width:120px')); }}
							                                {{ Form::text('lastname',isset($billing->lastname) ? $billing->lastname : "",array('id'=>'lastname','required')) }}
                                                        </td>
                                                        <td>
                                                            {{ Form::label('email', '* Email Address',array('style'=>'width:120px')); }}
							                                {{ Form::email('email',isset($billing->email) ? $billing->email : "",array('id'=>'email','required')) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td >
                                                            {{ Form::label('phone', '* Phone Number',array('style'=>'width:120px')); }}
							                                {{ Form::text('phone',isset($billing->phone) ? $billing->phone : "",array('id'=>'phone','required')) }}
                                                        </td>
                                                         <td >
                                                            {{ Form::label('address', '* Address',array('style'=>'width:120px')); }}
							                                {{ Form::text('address',isset($billing->address) ? $billing->address : "",array('id'=>'address','required')) }}
                                                        </td>
                                                        <td>
                                                            {{ Form::label('city', '* City',array('style'=>'width:120px')); }}
							                                {{ Form::text('city',isset($billing->city) ? $billing->city : "",array('id'=>'city','required')) }}
                                                        </td>
                                                        
                                                    </tr>
                                                   
                                                    <tr>
                                                        
                                                        <td>
                                                            {{ Form::label('country', '* Country'); }}                                      
                                       						{{ Form::select('country',array('0' => 'Select one')+CountryManagement::displayCountry(),isset($billing->country) ? $billing->country : "US",array('id'=>'country','data-placeholder'=>'Select Country')) }}
                                                        </td>
                                                        <td>
                                                            {{ Form::label('state', '* State'); }}
                                                            <span id="billingstateus">                                      
                                                            {{ Form::select('state',array('0' => 'Select one')+StateManagement::displayState(),isset($billing->state) ? $billing->state : "0",array('onchange' => 'checkTax(this.value)', 'id'=>'state','data-placeholder'=>'Select State')) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            {{ Form::label('zip', '* Zip Code',array('style'=>'width:120px')); }}
		                               						{{ Form::text('zip',isset($billing->zip) ? $billing->zip : "",array('id'=>'zip','required')) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"> <label class="checkbox">
                                                        <input type="checkbox" name="sameas" id="sameas"> Click here if your shipping information is the same as your billing information
                                                        </label></td>
                                                    </tr>
                                                </table>
                                        
                                            </div>
                                            <div class="tab-pane" id="shipping">
                                            
                                                <h2>Shipping Address</h2>
                                                Please fill out your Shipping information below.<hr />
                                                <div id="shippingError" style="display:none;" class="text-danger">Fields mark with * are required</div>
                                                <table class="table">
                                                    <tr>
                                                        <td style="width:50%">
                                                            {{ Form::label('shipping_firstname', '* First Name',array('style'=>'width:120px')); }}
		                                					{{ Form::text('shipping_firstname',isset($shipping->firstname) ? $shipping->firstname : "",array('id'=>'shipping_firstname','required')) }}                                       
                                                        </td>
                                                        <td>
                                                            {{ Form::label('shipping_lastname', '* Last Name',array('style'=>'width:120px')); }}
		                              						{{ Form::text('shipping_lastname',isset($shipping->lastname) ? $shipping->lastname : "",array('id'=>'shipping_lastname')) }}                        
                                                        </td>
                                                           <td>
                                                           {{ Form::label('shipping_email', '* Email Address',array('style'=>'width:120px')); }}
		                               					   {{ Form::text('shipping_email',isset($shipping->email) ? $shipping->email : "",array('id'=>'shipping_email')) }}                                         
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                     
                                                        <td >
                                                            {{ Form::label('shipping_phone', '* Phone Number',array('style'=>'width:120px')); }}
		                                					{{ Form::text('shipping_phone',isset($shipping->phone) ? $shipping->phone : "",array('id'=>'shipping_phone','required')) }} 
                                                        </td>
                                                        <td >
                                                           {{ Form::label('shipping_address', '* Address',array('style'=>'width:120px')); }}
		                                				   {{ Form::text('shipping_address',isset($shipping->address) ? $shipping->address : "",array('id'=>'shipping_address','required')) }} 
                                                        </td>
                                                        <td>
                                                            {{ Form::label('shipping_city', '* City',array('style'=>'width:120px')); }}
		                                					{{ Form::text('shipping_city',isset($shipping->city) ? $shipping->city : "",array('id'=>'shipping_city','required')) }} 
                                                        </td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        
                                                        <td>
                                                           {{ Form::label('shipping_country', '* Country'); }}                                      
                                       					   {{ Form::select('shipping_country',array('0' => 'Select one')+CountryManagement::displayCountry(),isset($shipping->country) ? $shipping->country : 'US',array('id'=>'shipping_country','data-placeholder'=>'Select Country')) }}    
                                                        </td>
                                                        <td>
                                                            {{ Form::label('shipping_state', '* State'); }}
                                                            <span id="shippingstateus">                                      
                                                            {{ Form::select('shipping_state',array('0' => 'Select one')+StateManagement::displayState(),isset($shipping->state) ? $shipping->state : "0",array('id'=>'shipping_state','data-placeholder'=>'Select State')) }}
                                                            </span> 
                                                        </td>
                                                        <td>
                                                           {{ Form::label('shipping_zip', '* Zip Code',array('style'=>'width:120px')); }}
		                               					   {{ Form::text('shipping_zip',isset($shipping->zip) ? $shipping->zip : "",array('id'=>'shipping_zip','required')) }}                                        
                                                        </td>
                                                    </tr>
                                                </table>
                                            
                                            </div>
                                            <div class="tab-pane" id="method">
                                                                                            
                                                <h2>Shipping Method <small>(Shipping Weight: {{ $cart[0]->weight }} lbs.)</small></h2>  
                                                Please select your shipping method.<hr />                          
    	                       					<div id="shipping_rate">{{ HTML::image('_front/assets/images/ajax-loader.gif') }}</div>
                                            
                                            </div>
                                            <div class="tab-pane" id="payment">
                                                                                                                                        
                                                
                                                <h2>Payment Method</h2>
                                                Please fill out your select your payment method.<hr />
                                                @include('home.payment')                
                                                
                                            
                                            </div>
                                        </div>
                                        <div class="next-btns top10">
                                            <a href="javascript:void(0)" class="btn btn-primary" onClick="displayPrevious()" id="back" style="display:none;"><i class="fa fa-chevron-left"></i> Back</a>	
                                            <a href="javascript:void(0)" class="btn btn-success pull-right" onClick="displayNext()" id="next">Continue <i class="fa fa-chevron-right"></i></a>
                                            <button type="submit" class="btn btn-success pull-right" name="submit" value="Pay Now" id="checkoutButton" style="display:none;">Purchase <i class="fa fa-shopping-cart"></i></button>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="order-total">
                                            <h2>Order Total</h2>                                            
                                            <table class="table">
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td class="text-right">$<span id="subtotal">{{ number_format($cart[0]->subtotal,2) }}</span></td>
                                                </tr>
                                               
                                                {{ Form::hidden('freeshipping',$coupon_code->freeshipping) }} 
                                                @if($coupon_code->freeshipping == 'yes')
                                                    {{ Form::hidden('shipping_rate_value','0') }}                                 	
                                                @endif                       
                                                
                                                <tr>
                                                    <td>Tax</td>                   
                                                    <td class="text-right"><span id="tax"> $ {{ number_format($coupon_code->tax,2) }}</span></td>
                                                </tr>
                                                @if($cart[0]->freeshipping == "no" || !Session::has('couponCode'))
                                                 <tr>
                                                    <td>Shipping ( <span id="shipping_name_value"></span> ) </td>                   
                                                    <td class="text-right"><span id="shipping_price_value"></span></td>
                                                </tr>
                                                @endif
                                                
                                                @if(Session::has('couponCode'))	
                                                <tr>
                                                    <td>Discount <small>( {{ Session::get('couponCode') }} )</small></td>
                                                    <td class="text-right"><span id="coupon_amount">$ {{ number_format($cart[0]->coupon_amount,2) }}</span></td>
                                                </tr>
                                                @endif
                                                
                                             
                                                 <tr>
                                                    <td><strong>Grand Total</strong></td>                   
                                                    <td class="text-right"><span id="Grandtotal">$ {{ number_format($cart[0]->grandtotal,2) }}</span></td>
                                                </tr>	
                                                
                                                {{ Form::hidden('coupon_code',Session::get('couponCode')) }} 
                                                {{ Form::hidden('coupon_price',$cart[0]->coupon_amount) }} 
                                                {{ Form::hidden('total',number_format($cart[0]->grandtotal,2),array('id'=>'total')) }} 
                                                {{ Form::hidden('tax',$tax,array('id'=>'taxvalue')) }} 
                                            </table>
                                           
                                            
                                        </div>
                                        
                                        

                                    </div>     
                                    
                                                          
	                   {{ Form::close() }} 
                       
                    </section>
                </div>
                <div class="col-md-12 top5">
                	<table class="table table-bordered cart-order-list">
                        <thead>
                            <tr class="cart-hdr">
                                
                                <th class="hdr-panel1">Item Name</th>
                                <th class="hdr-panel2">Price</th>
                                <th class="hdr-panel3">QTY</th>
                                <th class="hdr-panel4">Item Total</th>
                            </tr>
                        </thead>
                        <tbody>                           
                              @foreach($cart as $carts)                                
                                <tr>
                                    
										 
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
                                        {{ $carts->quantity }} 

                                    </td>
                                    <td class="tp4"> {{ number_format($carts->total,2) }}</td>
                                </tr>
                            @endforeach 
                                
                       
                        </tbody>
                       
                    </table>
                </div>
      </div>		
  </div>	
      


<script language="javascript">
	$(function (e) {
		$('#myTab a:first').tab('show');		 		
		$(this).tab('show');		
	})
	
	function displayNext() {
		tabText = $('.nav-tabs .active').text();
		
		if(tabText == "Billing Address") {
			//alert($("#sameas").attr("checked"));
			if(checkBillingFields()==0) { 
				$("#billingError").hide();
				if($("#sameas").is(':checked')) {	
					
					document.getElementById('shipping_firstname').value = document.getElementById('firstname').value;
					document.getElementById('shipping_lastname').value = document.getElementById('lastname').value;
					document.getElementById('shipping_address').value = document.getElementById('address').value;
					document.getElementById('shipping_city').value = document.getElementById('city').value;								
					document.getElementById('shipping_zip').value = document.getElementById('zip').value;
					document.getElementById('shipping_phone').value = document.getElementById('phone').value;
					document.getElementById('shipping_email').value = document.getElementById('email').value;
					$("#shipping_state option[value='"+document.getElementById('state').value+"']").attr("selected","selected");
					$("#shipping_country option[value='"+document.getElementById('country').value+"']").attr("selected","selected");									
					
					$("#shippingMethodTab a").attr('data-toggle','tab');
					$("#shippingMethodTab a").tab('show');
					$("#shippingTab a").removeAttr('data-toggle');
					
					if(document.getElementById('shipping_zip').value != "") { 
						city = document.getElementById('shipping_city').value;
						state = document.getElementById('shipping_state').value;
						state = state.replace(" ","%20");
						zip = document.getElementById('shipping_zip').value;
						zip = zip.replace(" ","%20");
						country = document.getElementById('shipping_country').value;
						city=city.replace(/ /g,"_");
	
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
					document.getElementById('shipping_firstname').value = "{{ $shipping->firstname }}";
					document.getElementById('shipping_lastname').value = "{{ $shipping->lastname }}";
					document.getElementById('shipping_address').value = "{{ $shipping->address }}";

					document.getElementById('shipping_city').value = "{{ $shipping->city }}";								
					document.getElementById('shipping_zip').value = "{{ $shipping->zip }}";
					document.getElementById('shipping_phone').value = "{{ $shipping->phone }}";
					document.getElementById('shipping_email').value = "{{ $shipping->email }}";
															
					$("#shippingTab a").attr('data-toggle','tab');
					$("#shippingTab a").tab('show');
					
					if(document.getElementById('shipping_zip').value != "") { 
						city = document.getElementById('shipping_city').value;
						state = document.getElementById('shipping_state').value;
						state = state.replace(" ","%20");
						zip = document.getElementById('shipping_zip').value;
						zip = zip.replace(" ","%20");
						country = document.getElementById('shipping_country').value;
						city=city.replace(/ /g,"_");
						
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
				$("#back").show();
			}
		} else if(tabText == "Shipping Address") {
			if(checkShippingFields()==0) {
				$("#shippingError").hide();
				$("#shippingMethodTab a").attr('data-toggle','tab');
				$("#shippingMethodTab a").tab('show');
				$("#back").show();
			}
		} else if(tabText == "Shipping Method") {
						
			var isSelected = false;
            var value = '';						
            if($('input[name="shipping_rate_value"]:checked').val())
               {
            	    isSelected = true;
                	value = $(this).attr('value');
						
               }                        					
               if(!isSelected) {
				 $("#shippingRateError").show();
	 		   } else {
				 $("#paymentMethodTab a").attr('data-toggle','tab');
			 	 $("#paymentMethodTab a").tab('show');
			 	 $("#next").hide();
			 	 $("#checkoutButton").show();
				 $("#back").show();
			   }
		}
		
	}
	
	function checkBillingFields() {
		requiredFields=0;
		if($("#firstname").val()=="") {requiredFields=1;}
		if($("#lastname").val()=="") {requiredFields=1;}
		if($("#address").val()=="") {requiredFields=1;}
		if($("#email").val()=="") {requiredFields=1;}
		if($("#city").val()=="") {requiredFields=1;}
		if($("#state").val()=="") {requiredFields=1;}
		if($("#zip").val()=="") {requiredFields=1;}
		if($("#phone").val()=="") {requiredFields=1;}
		if($("#country").val()=="") {requiredFields=1;}
		if($("#state").val()=="") {requiredFields=1;}
		
		if(requiredFields==1) {
			$("#billingError").show();
		}
		return requiredFields;
			
	}
	
	function checkShippingFields() {
		requiredFields=0;
		if($("#shipping_firstname").val()=="") {requiredFields=1;}
		if($("#shipping_lastname").val()=="") {requiredFields=1;}
		if($("#shipping_address").val()=="") {requiredFields=1;}
		if($("#shipping_email").val()=="") {requiredFields=1;}
		if($("#shipping_city").val()=="") {requiredFields=1;}
		if($("#shipping_state").val()=="") {requiredFields=1;}
		if($("#shipping_zip").val()=="") {requiredFields=1;}
		if($("#shipping_phone").val()=="") {requiredFields=1;}
		if($("#shipping_country").val()=="") {requiredFields=1;}
		if($("#shipping_state").val()=="") {requiredFields=1;}
		
		if(requiredFields==1) {
			$("#shippingError").show();
		}
		return requiredFields;
			
	}
	
	function displayPrevious() {

		$("#shippingRateError").hide();
		
		tabText = $('.nav-tabs .active').text();
		$("#next").show();
		$("#checkoutButton").hide();
		if(tabText == "Shipping Address") {
			$("#billingTab a").tab('show');
			$("#back").hide();
		} else if(tabText == "Shipping Method") {	
			if($("#sameas").attr("checked")=="checked") {		
				$("#billingTab a").tab('show');
				$("#shippingTab a").removeAttr('data-toggle');
			} else {
				$("#shippingTab a").tab('show');
			}
		} else if(tabText == "Payment Method") {			
			$("#shippingMethodTab a").tab('show');			
		}
	}
	
	$("#shippingTab a,#shippingMethodTab a,#paymentMethodTab a").removeAttr('data-toggle');
	
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