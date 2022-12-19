@extends('layouts._front.shoppingcart')

@section('content')
   @include("home.includes.shoppingcartnav")
   
  <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top"> 
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">
                        <div  id="checkout-page"  class="uk-width-1-1"> 
                            <div class="full-width roboto black">
                                <p><strong class="text-uppercase">Returning Customer?</strong> <a href="{{url('login')}}" class="black">Click here to login</a></p>
                                <p><strong class="text-uppercase">Have a Coupon?</strong> <a href="{{url('shopping-cart')}}" class="black">Click here to enter your code</a></p>
                            </div>
                        
        {!! Form::open(array('url' => '/checkout', 'method' => 'post',  'class' => 'row-fluid full-width uk-margin-large-top input-100 bill-info','id'=>'page_form')) !!}      

            <div class="uk-grid">
                <div class="uk-width-large-6-10 uk-width-1-1 uk-margin-large-bottom">                                             
                    <ul class="uk-tab uk-hidden" data-uk-tab="{connect:'#tabContent'}">
                        <li class="uk-active" id="billing"><a href="javascript:void(0)"><i class="uk-icon-map-marker"></i> Billing Address</a></li>
                        <li class="uk-disabled" id="shipping"><a href="javascript:void(0)"><i class="uk-icon-envelope"></i> Shipping Address</a></li>
                        <li class="uk-disabled" id="shippingMethod"><a href="javascript:void(0)"><i class="uk-icon-truck"></i> Shipping Method</a></li>
                        <li class="uk-disabled" id="payment"><a href="javascript:void(0)"><i class="uk-icon-money"></i> Payment Method</a></li>                     
                    </ul>
                    <ul id="tabContent" class="uk-switcher uk-margin">
                        <? /************Billing****************/ ?>    
                        <li id="billingContent">
                            <h1 class="uk-h2 text-uppercase">Billing Address</h1>
                            <div id="billingError" style="display:none;" class="uk-text-danger">Fields mark with * are required</div>
                            <div class="uk-grid">
                                <div class = "uk-width-large-1-2  uk-width-small-1-2 uk-margin-top">                    
                                    {!! Form::label('firstname', '* First Name',array( )); !!}
                                    {!! Form::text('firstname',isset($billing->fldClientsBillingFirstname) ? $billing->fldClientsBillingFirstname : "",array('id'=>'firstname','required','class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('lastname', '* Last Name',array( )); !!}
                                    {!! Form::text('lastname',isset($billing->fldClientsBillingLastname) ? $billing->fldClientsBillingLastname : "",array('id'=>'lastname','required','class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-1-1 uk-margin-top">
                                    {!! Form::label('company', 'Company',array()); !!}
                                    {!! Form::text('lastname',isset($billing->fldClientsBillingLastname) ? $billing->fldClientsBillingLastname : "",array('id'=>'lastname','required','class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('email', '* Email Address',array( )); !!}
                                    {!! Form::email('email',isset($billing->fldClientsBillingEmail) ? $billing->fldClientsBillingEmail : "",array('id'=>'email','required','class'=>'form-control')) !!}
                                </div >
                           
                                <div class = "uk-width-large-1-2 uk-width-small-1-2  uk-margin-top" >
                                    {!! Form::label('phone', '* Phone Number',array( )); !!}
                                    {!! Form::text('phone',isset($billing->fldClientsBillingPhone) ? $billing->fldClientsBillingPhone : "",array('id'=>'phone','required','class'=>'form-control')) !!}
                                </div >

                                <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!! Form::label('country', '* Country'); !!}                                      
                                    {!! Form::select('country',array('0' => 'Select one')+App\Models\Country::displayCountry(),isset($billing->fldClientsBillingCountry) ? $billing->fldClientsBillingCountry : "US",array('id'=>'country','data-placeholder'=>'Select Country','class'=>'form-control')) !!}
                                </div >

                                 <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!! Form::label('address', '* Address',array( )); !!}
                                    {!! Form::text('address',isset($billing->fldClientsBillingAddress) ? $billing->fldClientsBillingAddress : "",array('id'=>'address','required','class'=>'form-control','placeholder'=>'Street Address')) !!}
                                </div >
                                 <div class = "uk-width-small-1-1 uk-margin-top">                                   
                                    {!! Form::text('address',isset($billing->fldClientsBillingAddress) ? $billing->fldClientsBillingAddress : "",array('id'=>'address2','class'=>'form-control','placeholder'=>'Apartment, suite, unit, ect. (optional)')) !!}
                                </div >
                                <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!! Form::label('city', '* City',array( )); !!}
                                    {!! Form::text('city',isset($billing->fldClientsBillingCity) ? $billing->fldClientsBillingCity : "",array('id'=>'city','required', 'class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('state', '* State'); !!}
                                    <span id="billingstateus">                                      
                                    {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),isset($billing->fldClientsBillingState) ? $billing->fldClientsBillingState : "0",array('onchange' => 'checkTax(this.value)', 'id'=>'state','data-placeholder'=>'Select State', 'class'=>'form-control')) !!}
                                    </span>
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('zip', '* Zip Code',array( )); !!}
                                    {!! Form::text('zip',isset($billing->fldClientsBillingZip) ? $billing->fldClientsBillingZip : "",array('id'=>'zip','required','class'=>'form-control')) !!}
                                </div >
                            </div><!--row -->
                            <div class="uk-grid">
                                <div class="uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1">
                                    <label for="sameas" class="bold checkbox">
                                        <input type="checkbox" name="sameas" id="sameas"> Shipping Address Same As Billing 
                                    </label>
                                </div>
                            </div >
                        </li>
                        <? /************END Billing****************/ ?> 
                        <? /************Shipping Addres****************/ ?>  
                        <li id="shippingContent">
                            <h2>Shipping Address</h2>
                            Please fill out your Shipping information below.<hr />
                            <div id="shippingError" style="display:none;" class="text-danger">Fields mark with * are required</div>
                                <div class="uk-grid">
                                    <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-margin-top">  
                                        {!! Form::label('shipping_firstname', '* First Name',array( )); !!}
                                        {!! Form::text('shipping_firstname',isset($shipping->fldClientsShippingFirstname) ? $shipping->fldClientsShippingFirstname : "",array('id'=>'shipping_firstname','required','class'=>'form-control')) !!}                                       
                                    </div>
                                    <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-margin-top">
                                        {!! Form::label('shipping_lastname', '* Last Name',array( )); !!}
                                        {!! Form::text('shipping_lastname',isset($shipping->fldClientsShippingLastname) ? $shipping->fldClientsShippingLastname : "",array('id'=>'shipping_lastname','class'=>'form-control')) !!}                        
                                    </div>
                                       <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-margin-top">
                                       {!! Form::label('shipping_email', '* Email Address',array( )); !!}
                                       {!! Form::text('shipping_email',isset($shipping->fldClientsShippingEmail) ? $shipping->fldClientsShippingEmail : "",array('id'=>'shipping_email','class'=>'form-control')) !!}                                         
                                    </div>
                                 <div class = "uk-width-medium-1-2 uk-width-small-1-1uk-margin-top">
                                        {!! Form::label('shipping_phone', '* Phone Number',array( )); !!}
                                        {!! Form::text('shipping_phone',isset($shipping->fldClientsShippingPhone) ? $shipping->fldClientsShippingPhone : "",array('id'=>'shipping_phone','required','class'=>'form-control')) !!} 
                                    </div>
                                     <div class = "uk-width-small-1-1 uk-margin-top">
                                       {!! Form::label('shipping_country', '* Country'); !!}                                      
                                       {!! Form::select('shipping_country',array('0' => 'Select one')+App\Models\Country::displayCountry(),isset($shipping->fldClientsShippingCountry) ? $shipping->fldClientsShippingCountry : 'US',array('id'=>'shipping_country','data-placeholder'=>'Select Country','class'=>'form-control')) !!}    
                                   </div>
                                     <div class = "uk-width-small-1-1 uk-margin-top">
                                       {!! Form::label('shipping_address', '* Address',array( )); !!}
                                       {!! Form::text('shipping_address',isset($shipping->fldClientsShippingAddress) ? $shipping->fldClientsShippingAddress : "",array('id'=>'shipping_address','required','class'=>'form-control')) !!} 
                                    </div>
                                     <div class = " uk-width-small-1-1 uk-margin-top">                                      
                                       {!! Form::text('shipping_address2',isset($shipping->fldClientsShippingAddress2) ? $shipping->fldClientsShippingAddress2 : "",array('id'=>'shipping_address2','class'=>'form-control')) !!} 
                                    </div>
                                     <div class = "uk-width-1-1 uk-margin-top">
                                        {!! Form::label('shipping_city', '* City',array( )); !!}
                                        {!! Form::text('shipping_city',isset($shipping->fldClientsShippingCity) ? $shipping->fldClientsShippingCity : "",array('id'=>'shipping_city','required','class'=>'form-control')) !!} 
                                    </div>
                                    <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-margin-top">
                                        {!! Form::label('shipping_state', '* State'); !!}
                                        <span id="shippingstateus">                                      
                                        {!! Form::select('shipping_state',array('0' => 'Select one')+App\Models\State::displayState(),isset($shipping->fldClientsShippingState) ? $shipping->fldClientsShippingState : "0",array('id'=>'shipping_state','data-placeholder'=>'Select State','class'=>'form-control')) !!}
                                        </span> 
                                    </div>
                                     <div class = "uk-width-medium-1-2 uk-width-small-1-1  uk-margin-top">
                                       {!! Form::label('shipping_zip', '* Zip Code',array( )); !!}
                                       {!! Form::text('shipping_zip',isset($shipping->fldClientsShippingZip) ? $shipping->fldClientsShippingZip : "",array('id'=>'shipping_zip','required','class'=>'form-control')) !!}                                        
                                    </div>
                              </div><!--row -->
                        </li>
                        <? /************End Shipping Addres****************/ ?>  
                        <? /************Shipping Method****************/ ?>  
                        <li id="shippingMethodContent">
                            @if(empty($cart[0]->weight)) <?php $cart[0]->weight = 0; ?> @endif
                            <h2>Shipping Method <small>(Shipping Weight: {!! $cart[0]->weight !!} lbs.)</small></h2>  
                                Please select your shipping method.<hr />                          
                                <div id="shipping_rate">{!! Html::image('_front/assets/images/ajax-loader.gif') !!}</div>
                        </li>
                        <? /************END Shipping Method****************/ ?>
                        <? /************Payment Method****************/ ?>  
                        <li id="paymentContent">
                                <h2>Payment Method</h2>
                                Please fill out your select your payment method.<hr />
                                @include('home.payment') 
                        </li>
                        <?   /************END Payment Method****************/ ?>  
                    </ul> 

                
                </div><!-- 3/4 -->
                <div class="uk-width-large-4-10 uk-width-medium-7-10  uk-width-small-1-1">
                    <div class="order-total box-bordered padding-medium  uk-text-left">
                        <h2>Order Total</h2>                                            
                        <table class="uk-table uk-table-small">
                            <tr class="border-bottom">
                                <td colspan="2"><strong>PRODUCT</strong></td>
                                <td class="uk-text-right"><strong>TOTAL</strong></td>
                            </tr>

                             @foreach($cart as $carts)                                
                                <tr class="roboto">
                                    <td colspan="2">
                                    
                                        <div class="full-width">    
                                            <h4 class="uk-margin-remove">{!! $carts->product_name !!} ( {!! $carts->quantity !!} )</h4>
                                            <div class="grey ">{!! substr(strip_tags($carts->fldProductDescription), 0, 10) !!}</div>
                                        </div>                      
                                    </td>
                                    <td class="uk-text-right"><strong>$ @if(empty($carts->total)) <?php $carts->total=0; ?> @endif
                                        {!! number_format($carts->total,2) !!}</strong>
                                    </td>
                                </tr>
                             @endforeach  

                            <tr class="border-top">
                                <td colspan="2"><strong>CART SUBTOTAL</strong></td>
                                <td class="uk-text-right roboto"><strong>$<span id="subtotal">@if(empty($cart[0]->subtotal)) <?php  $cart[0]->subtotal=0; ?> @endif {!! number_format($cart[0]->subtotal,2) !!}</span> @if(empty($coupon_code)) <?php settype($coupon_code,'object'); ?> @endif  </strong>
                            
                            @if(empty($coupon_code->freeshipping)) <?php $coupon_code->freeshipping='yes'; ?>  @endif 

                                
                                {!! Form::hidden('freeshipping',$coupon_code->freeshipping) !!} 
                                @if($coupon_code->freeshipping == 'yes')
                                    {!! Form::hidden('shipping_rate_value','0') !!}                                     
                                @endif </td>
                            </tr>
                                                
                            @if(!empty($coupon_code->tax))
                            <tr class="border-top">
                                <td colspan="2">Tax</td>                   
                                <td class="uk-text-right roboto"><strong><span id="tax">@if(empty($coupon_code->tax)) <?php $coupon_code->tax=0; ?> @endif  $ {!! number_format($coupon_code->tax,2) !!}</span></strong></td>
                            </tr>
                            @endif 

                            @if($cart[0]->freeshipping == "no" || !Session::has('couponCode'))
                             <tr class="border-top">
                                <td colspan="2"><strong>Shipping</strong> ( <span id="shipping_name_value"></span> ) </td>                   
                                <td class="uk-text-right roboto"><strong><span id="shipping_price_value"></span></strong></td>
                            </tr>
                            @endif
                            
                            @if(Session::has('couponCode')) 
                            <tr class="border-top">
                                <td colspan="2">Discount <small>( {!! Session::get('couponCode') !!} )</small></td>
                                <td class="uk-text-right roboto"><span id="coupon_amount"><strong>@if(empty($cart[0]->coupon_amount))<?php $cart[0]->coupon_amount=0; ?> @endif $ {!! $cart[0]->coupon_amount !!}</span></strong></td>
                            </tr>
                            @endif                     
                             <tr class="border-top">
                                <td colspan="2"><strong>ORDER TOTAL</strong></td>                   
                                <td class="uk-text-right roboto"><strong><span id="Grandtotal">@if(empty($cart[0]->grandtotal))<?php $cart[0]->grandtotal=0; ?> @endif $ {!! number_format($cart[0]->grandtotal,2) !!}</span></strong>
                                @if(empty(Session::get('couponCode')))<?php Session::get('couponCode',''); ?>@endif
                                {!! Form::hidden('coupon_code',Session::get('couponCode')) !!} 
                                {!! Form::hidden('coupon_price',$cart[0]->coupon_amount) !!} 
                                
                                {!! Form::hidden('total',number_format($cart[0]->grandtotal,2),array('id'=>'total')) !!} 

                                {!! Form::hidden('shipping_rate_val','',array('id'=>'shipping_rate_val')) !!} 
                                {!! Form::hidden('tax',$tax,array('id'=>'taxvalue')) !!} 
                                </td>
                            </tr> 
                            <tr class="border-top">
                                <td colspan="3" class="">
                                    <label for="paywithcreditcard" class="full-width uk-padding-medium-top"><input type="radio" checked="checked" name="paywithcreditcard" id="paywithcreditcard" value="paywithcreditcard" /> <strong>Debit/Credit Card</strong> {!! Html::image('_front/assets/images/credit-card-image.jpg','pay with credit card', array('width'=>'135','height'=>"26", 'class'=>'')) !!}</label>
                                    <div class="full-width uk-padding-medium-right uk-padding-medium-left grey fsize-12">Lorem ipsum dolor sit amet, convallis facilisi purus, pellentesque sed in aliquam, cras dolores class dignissim.</div>
                                </td>
                             </tr>  
                        </table>
                    </div>
                    <div class="next-btns uk-margin-top">
                        <a href="javascript:void(0)" class="uk-button uk-button-primary full-width uk-margin-small-bottom " onClick="displayPrevious()" id="back" style="display:none;"><i class="fa fa-chevron-left"></i> Back</a> 
                        <a href="javascript:void(0)" class="uk-button uk-button-primary full-width" onClick="displayNext()" id="next">PLACE ORDER</a>
                        <button type="submit" class="uk-button uk-button-primary full-width" name="submit" value="Pay Now" id="checkoutButton" style="display:none;">PLACE ORDER</button>
                    </div>

                </div> <!-- 1/4 -->
            </div><!--uk-grid -->
            
            {!! Form::close() !!} 
                </div> <!-- <div  id="checkout" -->
            </div> <!-- <div class="uk-grid"> -->
        </div> <!-- <article id="main" role="main"> -->
    </div> <!-- <div class="uk-container uk-container-center uk-margin-medium-bottom"> -->
</div> <!-- <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top">  -->


<script language="javascript">
    

   function displayNext() {
        tabText = $('.uk-tab .uk-active').attr('id');
        
        if(tabText == "billing") {
            //alert($("#sameas").attr("checked"));
            //alert(checkBillingFields);
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
                    
                    // $("#shippingMethod").attr('class','active');
                    // $("#shippingMethod").tab('show');
                    // $("#shippingTab a").removeAttr('data-toggle');
                    $("#shippingMethod,#shippingMethodContent").attr('class','uk-active');                                                    
                    $("#billing,#billingContent").removeAttr('class','uk-active');
                    $("#billing").attr('class','uk-disabled');
                    
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
          

                    document.getElementById('shipping_firstname').value = "<?=stripslashes(isset($shipping->lastname)?$shipping->lastname:'')?>";
              document.getElementById('shipping_lastname').value = "<?=stripslashes(isset($shipping->firstname)?$shipping->firstname:'')?>";
                document.getElementById('shipping_address').value = "<?=stripslashes(isset($shipping->address)?$shipping->address:'')?>";
                document.getElementById('shipping_city').value = "<?=stripslashes(isset($shipping->city)?$shipping->city:'')?>";                              
                document.getElementById('shipping_zip').value = "<?=isset($shipping->zip)?$shipping->zip:'';?>";
                document.getElementById('shipping_phone').value = "<?=isset($shipping->phone)?$shipping->phone:'';?>";
                document.getElementById('shipping_email').value = "<?=isset($shipping->email)?$shipping->email:'';?>";

                                                            
                    $("#shipping,#shippingContent").attr('class','uk-active');                                                    
                    $("#billing,#billingContent").removeAttr('class','uk-active');
                    $("#billing").attr('class','uk-disabled');
                    //$("#shipping").tab('show');
                    
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

        } else if(tabText == "shipping") {
            
            if(checkShippingFields()==0) {

                $("#shippingMethod,#shippingMethodContent").attr('class','uk-active');                                                    
                $("#shipping,#shippingContent").removeAttr('class','uk-active');
                $("#shipping").attr('class','uk-disabled');
                $("#back").show();
            }
        } else if(tabText == "shippingMethod") {
                        
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
                 $("#payment,#paymentContent").attr('class','uk-active');                                                    
                 $("#shippingMethod,#shippingMethodContent").removeAttr('class','uk-active');
                 $("#shippingMethod").attr('class','uk-disabled');
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
        
        tabText = $('.uk-tab .uk-active').attr('id');
        $("#next").show();
        $("#checkoutButton").hide();
        if(tabText == "shipping") {         
            $("#billing,#billingContent").attr('class','uk-active');                                                    
            $("#shipping,#shippingContent").removeAttr('class','uk-active');
            $("#shipping").attr('class','uk-disabled');
        } else if(tabText == "shippingMethod") {    
            if($("#sameas").attr("checked")=="checked") {       
                $("#billing,#billingContent").attr('class','uk-active');                                                    
                $("#shippingMethod,#shippingMethodContent").removeAttr('class','uk-active');
                $("#shippingMethod").attr('class','uk-disabled');
            } else {
                $("#shipping,#shippingContent").attr('class','uk-active');                                                    
                $("#shippingMethod,#shippingMethodContent").removeAttr('class','uk-active');
                $("#shippingMethod").attr('class','uk-disabled');
            }
        } else if(tabText == "payment") {           
            $("#shippingMethod,#shippingMethodContent").attr('class','uk-active');                                                    
            $("#payment,#paymentContent").removeAttr('class','uk-active');
            $("#payment").attr('class','uk-disabled');      
        }
    }
    
    $("#shippingTab a,#methodTab a,#paymentTab a").removeAttr('data-toggle');
    
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
                    <? }  ?>
                }
                 
                                
                
            } else {
              
              document.getElementById('shipping_firstname').value = "<?=stripslashes(isset($shipping->lastname)?$shipping->lastname:'')?>";
              document.getElementById('shipping_lastname').value = "<?=stripslashes(isset($shipping->firstname)?$shipping->firstname:'')?>";
                document.getElementById('shipping_address').value = "<?=stripslashes(isset($shipping->address)?$shipping->address:'')?>";
                document.getElementById('shipping_address1').value = "<?=stripslashes(isset($shipping->address1)?$shipping->address1:'')?>";
                document.getElementById('shipping_city').value = "<?=stripslashes(isset($shipping->city)?$shipping->city:'')?>";                              
                document.getElementById('shipping_zip').value = "<?=isset($shipping->zip)?$shipping->zip:'';?>";
                document.getElementById('shipping_phone').value = "<?=isset($shipping->phone)?$shipping->phone:'';?>";
                document.getElementById('shipping_email').value = "<?=isset($shipping->email)?$shipping->email:'';?>";
                city = document.getElementById('shipping_city').value;
                state = document.getElementById('shipping_state').value;
                zip = document.getElementById('shipping_zip').value;
                country = document.getElementById('shipping_country').value;
                city=city.replace(/ /g,"_");
               
                if(zip != "") { 
                    
                    <?  if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
                
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
                    //$('#shipping_rate').load('spin.php');
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
                        //$('#shipping_rate').load('spin.php');
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
                    $('#shippingstateus').Html('<input type=text name=shipping_state id=shipping_state>');      
                    $('#stateShippingText').Html('State/Province');         
                } else {        
                    //$('#shippingstateus').load("loadState.php");
                    //$('#stateShippingText').Html('State');        
                    <? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
                        //$('#shipping_rate').load('spin.php');
                    $('#shipping_rate').load('shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);
                        $('#shippingRateDisplay').show();
                    <? } else { ?>
                        $('#shippingRateDisplay').hide();   
                    <? } ?>
                }
                
                
                
        });
        
        $('#billing_country').change(function() {               
            if(document.getElementById('billing_country').value != "US") {
                $('#billingstateus').Html('<input type=text name=state id=state>');
                $('#shippingstateus').Html('<input type=text name=shipping_state id=shipping_state>');
                $('#stateBillingText').Html('State/Province');
                $('#stateShippingText').Html('State/Province');
                $("#shipping_country option[value='"+document.getElementById('billing_country').value+"']").attr("selected","selected");
                    state="";
                    checkTax(state);
            } else {
                $("#shipping_country option[value='"+document.getElementById('billing_country').value+"']").attr("selected","selected");
                //$('#billingstateus').load("loadState.php");
                //$('#stateBillingText').Html('State');
                ////$('#shippingstateus').load("loadShipping.php");
                //$('#stateShippingText').Html('State');                
                
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
               
                if(stateTax != "" && stateTax != 0) { checkTax(stateTax); }
                
                
                if(zip != "") { 
                    
                    <? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
                        $('#shipping_rate').show();
                        //$('#shipping_rate').load('spin');
                        $('#shipping_rate').load('shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);
                        $('#shippingRateDisplay').show();
                    <? } else { ?>
                            $('#shippingRateDisplay').hide();   
                    <? } ?>
                }
            
   });
   
 
        
</script>
@stop

@section('headercodes') 
{!! Html::style('_front/uikit/css/components/accordion.min.css') !!} 
@stop

@section('extracodes')
  {!! Html::script('_front/uikit/js/components/accordion.min.js') !!}
@stop