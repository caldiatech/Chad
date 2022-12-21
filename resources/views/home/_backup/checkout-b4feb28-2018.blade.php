@extends('layouts._front.checkout')

@section('content')
   @include("home.includes.shoppingcartnav")

  <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top">
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">
                        <div  id="checkout-page"  class="uk-width-1-1">
                            <? /*
                            <div class="full-width roboto black">
                                <p><strong class="text-uppercase">Returning Customer?</strong> <a href="{{url('login')}}" class="black">Click here to login</a></p>
                                <p><strong class="text-uppercase">Have a Coupon?</strong> <a href="{{url('shopping-cart')}}" class="black">Click here to enter your code</a></p>
                            </div>
                            */ ?>

        {!! Html::flash_msg_front() !!}
        {!! Form::open(array('url' => '/checkout', 'method' => 'post',  'class' => 'row-fluid full-width uk-margin-large-top input-100 bill-info uk-form','id'=>'page_form')) !!}

            <div class="uk-grid">
                <div class="uk-width-large-6-10 uk-width-1-1 uk-margin-large-bottom">


                    <ul id="tabContent" class="uk-switcher uk-margin">
                        <? /************Billing****************/ ?>
                        <li id="billingContent">
                            <h1 class="uk-h2 text-uppercase">Billing Address</h1>
                           <? /*<div id="billingError" style="display:none;" class="uk-text-danger">Fields mark with * are required</div>*/ ?>
                            <div class="uk-grid">
                                <div class = "uk-width-large-1-2  uk-width-small-1-2 uk-margin-top">
                                    {!! HTML::decode(Form::label('firstname', 'First Name <span class="red required">*</span>',array( ))); !!}
                                    {!! Form::text('firstname',isset($billing->fldClientsBillingFirstname) ? $billing->fldClientsBillingFirstname : $client->fldClientFirstname,array('id'=>'firstname','required','class'=>'form-control')) !!}
                                    <div id="billingFirstnameError" style="display:none;" class="uk-text-danger">Please enter your first name</div>
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!!  HTML::decode(Form::label('lastname', 'Last Name <span class="red required">*</span>',array( ))); !!}
                                    {!! Form::text('lastname',isset($billing->fldClientsBillingLastname) ? $billing->fldClientsBillingLastname : $client->fldClientLastname,array('id'=>'lastname','required','class'=>'form-control')) !!}
                                    <div id="billingLastnameError" style="display:none;" class="uk-text-danger">Please enter your last name</div>
                                </div >

                                <div class = "uk-width-large-1-1 uk-width-small-1-1 uk-margin-top">
                                    {!!  HTML::decode(Form::label('company', 'Company ',array( ))); !!}
                                    {!! Form::text('company',isset($billing->fldClientsBillingCompany) ? $billing->fldClientsBillingCompany : "",array('id'=>'company','class'=>'form-control')) !!}
                                </div >

                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!!  HTML::decode(Form::label('email', 'Email Address <span class="red required">*</span>',array( ))); !!}
                                    {!! Form::email('email',isset($billing->fldClientsBillingEmail) ? $billing->fldClientsBillingEmail : $client->fldClientEmail,array('id'=>'email','required email','class'=>'form-control')) !!}
                                    <div id="billingEmailError" style="display:none;" class="uk-text-danger">Invalid email address</div>
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2  uk-margin-top" >
                                    {!!  HTML::decode(Form::label('phone', 'Phone Number <span class="red required">*</span>',array( ))); !!}
                                    {!! Form::text('phone',isset($billing->fldClientsBillingPhone) ? $billing->fldClientsBillingPhone : $client->fldClientContact,array('id'=>'phone','required','class'=>'form-control phone_us')) !!}
                                    <div class="uk-text-danger  mask-error  uk-hidden"></div>
                                    <div id="billingPhoneError" style="display:none;" class="uk-text-danger">Invalid phone number</div>
                                    <div id="billingPhoneReqError" style="display:none;" class="uk-text-danger">Please enter your phone number</div>
                                </div >
                                <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!!  HTML::decode(Form::label('country', 'Country <span class="red required">*</span>')); !!}
                                    {!! Form::select('country',array('0' => 'Select one')+App\Models\Country::displayCountry(),isset($billing->fldClientsBillingCountry) ? $billing->fldClientsBillingCountry : "US",array('id'=>'country','data-placeholder'=>'Select Country','class'=>'form-control')) !!}
                                    <div id="billingCountryError" style="display:none;" class="uk-text-danger">Please select your country</div>
                                </div >
                                 <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!!  HTML::decode(Form::label('address', 'Address <span class="red required">*</span>',array( ))); !!}
                                    {!! Form::text('address',isset($billing->fldClientsBillingAddress) ? $billing->fldClientsBillingAddress : "",array('id'=>'address','required','class'=>'form-control','placeholder'=>'Street Address')) !!}
                                    <div id="billingAddressError" style="display:none;" class="uk-text-danger">Please enter your address</div>
                                </div >
                                 <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!! Form::text('address1',isset($billing->fldClientsBillingAddress1) ? $billing->fldClientsBillingAddress1 : "",array('id'=>'address2','class'=>'form-control','placeholder'=>'Apartment, suite, unit, ect. (optional)')) !!}

                                </div >
                                <div class = "uk-width-small-1-1 uk-margin-top">
                                    {!!  HTML::decode(Form::label('city', 'City <span class="red required">*</span>',array( ))); !!}
                                    {!! Form::text('city',isset($billing->fldClientsBillingCity) ? $billing->fldClientsBillingCity : "",array('id'=>'city','required', 'class'=>'form-control')) !!}
                                    <div id="billingCityError" style="display:none;" class="uk-text-danger">Please enter your city</div>
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!!  HTML::decode(Form::label('state', 'State <span class="red required">*</span>',array('id'=>'stateBillingText'))); !!}
                                    <span id="billingstateus">
                                    {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),isset($billing->fldClientsBillingState) ? $billing->fldClientsBillingState : "0",array('onchange' => 'checkTax(this.value)', 'id'=>'state','data-placeholder'=>'Select State', 'class'=>'form-control')) !!}
                                    </span>
                                    <div id="billingStateError" style="display:none;" class="uk-text-danger">Please select your state</div>
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!!  HTML::decode(Form::label('zip', 'Zip Code <span class="red required">*</span>',array( ))); !!}
                                    {!! Form::text('zip',isset($billing->fldClientsBillingZip) ? $billing->fldClientsBillingZip : "",array('id'=>'zip','required','class'=>'form-control')) !!}
                                    <div id="billingZipError" style="display:none;" class="uk-text-danger">Please enter your zip code</div>
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
                            <? /*<div id="shippingError" style="display:none;" class="text-danger">Fields mark with * are required</div> */ ?>
                                <div class="uk-grid">
                                    <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-margin-top">
                                        {!!  HTML::decode(Form::label('shipping_firstname', 'First Name <span class="red required">*</span>',array( ))); !!}
                                        {!! Form::text('shipping_firstname',isset($shipping->fldClientsShippingFirstname) ? $shipping->fldClientsShippingFirstname : $client->fldClientFirstname,array('id'=>'shipping_firstname','required','class'=>'form-control')) !!}
                                        <div id="shippingFirstnameError" style="display:none;" class="uk-text-danger">Please enter your first name</div>

                                    </div>
                                    <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-margin-top">
                                        {!!  HTML::decode(Form::label('shipping_lastname', 'Last Name <span class="red required">*</span>',array( ))); !!}
                                        {!! Form::text('shipping_lastname',isset($shipping->fldClientsShippingLastname) ? $shipping->fldClientsShippingLastname : $client->fldClientLastname,array('id'=>'shipping_lastname','class'=>'form-control')) !!}

                                        <div id="shippingLastnameError" style="display:none;" class="uk-text-danger">Please enter your last name</div>
                                    </div>
                                       <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-margin-top">
                                       {!!  HTML::decode(Form::label('shipping_email', 'Email Address <span class="red required">*</span>',array( ))); !!}
                                       {!! Form::text('shipping_email',isset($shipping->fldClientsShippingEmail) ? $shipping->fldClientsShippingEmail : $client->fldClientEmail,array('id'=>'shipping_email','class'=>'form-control')) !!}
                                         <div id="shippingEmailReqError" style="display:none;" class="uk-text-danger">Please enter email address</div>
                                        <div id="shippingEmailError" style="display:none;" class="uk-text-danger">Invalid email address</div>
                                    </div>
                                 <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-margin-top">
                                        {!!  HTML::decode(Form::label('shipping_phone', 'Phone Number <span class="red required">*</span>',array( ))); !!}
                                        {!! Form::text('shipping_phone',isset($shipping->fldClientsShippingPhone) ? $shipping->fldClientsShippingPhone : $client->fldClientContact,array('id'=>'shipping_phone','required','class'=>'form-control phone_us')) !!}
                                         <div id="shippingPhoneReqError" style="display:none;" class="uk-text-danger">Please enter phone number</div>
                                         <div id="shippingPhoneError" style="display:none;" class="uk-text-danger">Invalid phone number</div>

                                    </div>
                                     <div class = "uk-width-small-1-1 uk-margin-top">
                                       {!!  HTML::decode(Form::label('shipping_country', 'Country <span class="red required">*</span>')); !!}
                                       {!! Form::select('shipping_country',array('0' => 'Select one')+App\Models\Country::displayCountry(),isset($shipping->fldClientsShippingCountry) ? $shipping->fldClientsShippingCountry : 'US',array('id'=>'shipping_country','data-placeholder'=>'Select Country','class'=>'form-control')) !!}

                                       <div id="shippingCountryError" style="display:none;" class="uk-text-danger">Please select your country</div>

                                   </div>
                                     <div class = "uk-width-small-1-1 uk-margin-top">
                                       {!!  HTML::decode(Form::label('shipping_address', 'Address <span class="red required">*</span>',array( ))); !!}
                                       {!! Form::text('shipping_address',isset($shipping->fldClientsShippingAddress) ? $shipping->fldClientsShippingAddress : "",array('id'=>'shipping_address','required','class'=>'form-control')) !!}
                                       <div id="shippingAddressError" style="display:none;" class="uk-text-danger">Please enter your address</div>
                                    </div>
                                     <div class = " uk-width-small-1-1 uk-margin-top">
                                       {!! Form::text('shipping_address1',isset($shipping->fldClientsShippingAddress1) ? $shipping->fldClientsShippingAddress1 : "",array('id'=>'shipping_address1','class'=>'form-control','placeholder'=>'Apartment, suite, unit, ect. (optional)')) !!}
                                    </div>
                                     <div class = "uk-width-1-1 uk-margin-top">
                                        {!!  HTML::decode(Form::label('shipping_city', 'City <span class="red required">*</span>',array( ))); !!}
                                        {!! Form::text('shipping_city',isset($shipping->fldClientsShippingCity) ? $shipping->fldClientsShippingCity : "",array('id'=>'shipping_city','required','class'=>'form-control required')) !!}

                                        <div id="shippingCityError" style="display:none;" class="uk-text-danger">Please enter your city</div>

                                    </div>
                                    <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-margin-top">
                                        {!!  HTML::decode(Form::label('shipping_state', 'State <span class="red required">*</span>',array('id'=>'stateShippingText'))); !!}
                                        <span id="shippingstateus">
                                        {!! Form::select('shipping_state',array('' => 'Select one')+App\Models\State::displayState(),isset($shipping->fldClientsShippingState) ? $shipping->fldClientsShippingState : "0",array('id'=>'shipping_state','data-placeholder'=>'Select State','class'=>'form-control required', 'required')) !!}
                                        </span>

                                        <div id="shippingStateError" style="display:none;" class="uk-text-danger">Please select your state</div>

                                    </div>
                                     <div class = "uk-width-medium-1-2 uk-width-small-1-1  uk-margin-top">
                                       {!!  HTML::decode(Form::label('shipping_zip', 'Zip Code <span class="red required">*</span>',array( ))); !!}
                                       {!! Form::text('shipping_zip',isset($shipping->fldClientsShippingZip) ? $shipping->fldClientsShippingZip : "",array('id'=>'shipping_zip','required','class'=>'form-control required')) !!}

                                       <div id="shippingZipError" style="display:none;" class="uk-text-danger">Please enter your zip code</div>
                                    </div>
                              </div><!--row -->
                        </li>
                        <? /************End Shipping Addres****************/ ?>

                        <? /************Shipping METHOD****************/ ?>

                            <li id="shippingMethodContent">
                                <h2>Shipping Method</h2>
                                Please fill out your select your shipping method.<hr />
                               <div id="shippingRateError" style="display:none;" class="uk-alert uk-alert-danger">Please select shipping method.</div>
                                <div id="shipping_rate">{!! Html::image('_front/assets/images/ajax-loader.gif') !!}</div>
                            </li>
                        <? /************Shipping METHOD****************/ ?>



                        <? /************Payment Method****************/ ?>
                        <li id="paymentContent">
                                <h2>Payment Method</h2>
                                Please fill out your select your payment method.<hr />
                                @include('home.braintree_cc')
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
                                            <div class="grey ">{!! $carts->fldTempCartFrameDesc !!}</div>
                                            <div class="grey ">{!! $carts->fldTempCartImageSize !!}</div>
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
                            @else
                            <tr class="border-top">
                                <td colspan="2"><strong>Tax</strong></td>
                                <td class="uk-text-right roboto"><strong><span id="taxvaluedisplay"></span></strong></td>
                            </tr>
                            @endif

                            @if($cart[0]->freeshipping == "no" || !Session::has('couponCode'))
                             <tr class="border-top">
                                <td colspan="2"><strong>Shipping</strong> <small class="smaller"> <span id="shipping_name_value"></span> </small> </td>
                                <td class="uk-text-right roboto"><strong><span id="shipping_price_value"></span></strong></td>
                            </tr>
                            @endif

                            @if(Session::has('couponCode'))
                            <tr class="border-top">
                                <td colspan="2">Discount <small>( {!! Session::get('couponCode').' | '.Session::get('couponSource').'-'.Session::get('couponSourceID') !!} )</small></td>
                                <td class="uk-text-right roboto"><span id="coupon_amount">- <strong>@if(empty($cart[0]->coupon_amount))<?php $cart[0]->coupon_amount=0; ?> @endif $ {!! number_format($cart[0]->coupon_amount,2) !!}</span></strong></td>
                            </tr>
                            @endif
                             <tr class="border-top">
                                <td colspan="2"><strong>ORDER TOTAL</strong></td>
                                <td class="uk-text-right roboto">
                                 <strong><span id="Grandtotal">
                                    @if(empty($cart[0]->grandtotal))
                                        <?php $cart[0]->grandtotal=0; ?>
                                    @endif
                                    $ {!! number_format($cart[0]->grandtotal,2) !!}
                                  </span></strong>

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
                            <ul class="uk-tab" data-uk-tab="{connect:'#tabContent'}">
                                <li class="uk-active" id="billing"><a href="javascript:void(0)" class="uk-button uk-button-primary full-width uk-margin-small-bottom ">Next</a></li>
                                <li class="please-show" id="shipping"><a href="javascript:void(0)" class="uk-button uk-button-primary full-width uk-margin-small-bottom ">Next</a></li>
                                 <li class="" id="shippingMethod"><a href="javascript:void(0)" class="uk-button uk-button-primary full-width uk-margin-small-bottom ">Next</a></li>
                                <li class="" id="payment"><a href="javascript:void(0)" class="uk-button uk-button-primary full-width uk-margin-small-bottom ">Next</a></li>
                            </ul>
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

    var tab_array_click_counter = 0, required_filled = false;
    $('[data-uk-tab]').on('change.uk.tab', function(event, area){
        console.log("Tab switched to ");
        console.log(area.attr("id"));
        var this_tab_id = area.attr("id");
        $('.next-btns .uk-tab > li').each(function(){
            $(this).removeClass('please-show');
        });
        displayNext(this_tab_id);
    });

    $('input#sameas').on('change', function(){
        if(this.checked)
        {
            $('.next-btns .uk-tab > li#shippingMethod').addClass('please-show');
            $('.next-btns .uk-tab > li#shipping').removeClass('please-show'); isTheSame();
        }else{
            $('.next-btns .uk-tab > li#shipping').addClass('please-show');
            $('.next-btns .uk-tab > li#shippingMethod').removeClass('please-show'); isNotTheSame();
        }
    });

    var tabTimer;
   function displayNext(this_tab_id) {
        tabText = this_tab_id;
        clearTimeout(tabTimer);
        $('#checkoutButton').hide();
        $('.next-btns').removeClass('place-an-order');
        if(tabText == "billing") {
            if($("#sameas").is(':checked'))
            {
                $('.next-btns .uk-tab > li#shippingMethod a').text("Next");
                $('.next-btns .uk-tab > li#shippingMethod').addClass('please-show');
                $('.next-btns .uk-tab > li#shipping').removeClass('please-show');
            }else{
                $('.next-btns .uk-tab > li#shipping a').text("Next");
                $('.next-btns .uk-tab > li#shipping').addClass('please-show');
                $('.next-btns .uk-tab > li#shippingMethod').removeClass('please-show');
            }
        }else
        if(tabText == "shipping") {
            //alert($("#sameas").attr("checked"));
            console.log(checkBillingFields());
            if(checkBillingFields()==0) {
                $('.next-btns .uk-tab > li#shippingMethod a').text("Next");
                $('.next-btns .uk-tab > li#shippingMethod').addClass('please-show');
            }
            $('.next-btns .uk-tab > li#billing a').text("Back");
            $('.next-btns .uk-tab > li#billing').addClass('please-show');
            checkBillingForm(checkBillingFields());

        } else if(tabText == "shippingMethod") {
            if(checkShippingFields()==0) {
                $('.next-btns .uk-tab > li#payment a').text("Next");
                $('.next-btns .uk-tab > li#payment').addClass('please-show');

                if($('#sameas').is(':checked'))
                {
                    $('.next-btns .uk-tab > li#billing a').text("Back");
                    $('.next-btns .uk-tab > li#billing').addClass('please-show');
                }else{
                    $('.next-btns .uk-tab > li#shipping a').text("Back");
                    $('.next-btns .uk-tab > li#shipping').addClass('please-show');
                }

            }else{
               tabTimer = setTimeout(function(){
                    $('.next-btns .uk-tab > li#shipping').trigger('click');
                },100);
            }

        } else if(tabText == "payment") {

            var isSelected = false;

            if($('input[name="shipping_rate_value"]').is(':checked'))
               {
                    isSelected = true;
               }
               if(!isSelected) {
                $("#shippingRateError").show();
                tabTimer = setTimeout(function(){
                $('.next-btns .uk-tab > li#shippingMethod').trigger('click');
                },100);
               } else {
                    /*$("#payment,#paymentContent").attr('class','uk-active');
                    $("#shippingMethod,#shippingMethodContent").removeAttr('class','uk-active');
                    $("#shippingMethod").attr('class','uk-disabled');
                    $("#checkoutButton").show();
                    $("#back").show();
                    $("#next").hide();*/
                  // $('.next-btns .uk-tab > li#payment').addClass('please-show');
                $('.next-btns .uk-tab > li#shippingMethod a').text("Back");
                $('.next-btns .uk-tab > li#shippingMethod').addClass('please-show');
                $('#checkoutButton').show();
                $('.next-btns').addClass('place-an-order');
              }
        }

    }
    function checkBillingForm(no_error){
        console.log(no_error);
        if(no_error==0) {
                $("#billingError").hide();
                $("#shipping_country").find('option').removeAttr("selected");
               // $("#back").show();
            }else{
                    //return to billing tab
                tabTimer = setTimeout(function(){
                    $('.next-btns .uk-tab > li#billing').trigger('click');
                },100);
            }
    }

    function isTheSame(){
        console.log('isTheSame');
                    document.getElementById('shipping_firstname').value = document.getElementById('firstname').value;
                    document.getElementById('shipping_lastname').value = document.getElementById('lastname').value;
                    document.getElementById('shipping_address').value = document.getElementById('address').value;
                    document.getElementById('shipping_city').value = document.getElementById('city').value;
                    document.getElementById('shipping_zip').value = document.getElementById('zip').value;
                    document.getElementById('shipping_phone').value = document.getElementById('phone').value;
                    document.getElementById('shipping_email').value = document.getElementById('email').value;
                   // $("#shipping_state option[value='"+document.getElementById('state').value+"']").attr("selected","selected");
                    //$("#shipping_country option[value='"+document.getElementById('country').value+"']").attr("selected","selected");
                    if(document.getElementById('country').value != "US") {
                            $('#stateShippingText').html('State/Province');
                            $('#stateBillingText').html('State/Province');
                            $('#shippingstateus').html('<input type="text" name="shipping_state" id="shipping_state" class="form-control textfield_width">');

                            document.getElementById('shipping_state').value = document.getElementById('state').value;

                    } else {
                        //$("#shipping_state option[value='"+document.getElementById('state').value+"']").attr("selected","selected");
                        $('#stateShippingText').html('State');
                         $("#shippingstateus").html('{!! Form::select("shipping_state",array("0" => "Select one")+App\Models\State::displayState(), "0",array("id"=>"shipping_state","data-placeholder"=>"Select State","class"=>"form-control textfield_width")) !!}');

                        $('[name=shipping_state]').val( document.getElementById('state').value );
                        //console.log("US");
                    }

                    $("#shipping_country option[value='"+document.getElementById('country').value+"']").attr("selected","selected");
                    $("#shipping_country").val(document.getElementById('country').value);

                    // $("#shippingMethod").attr('class','active');
                    // $("#shippingMethod").tab('show');
                    // $("#shippingTab a").removeAttr('data-toggle');
                    //$("#shippingMethod,#shippingMethodContent").attr('class','uk-active');

                    //$("#billing,#billingContent").removeAttr('class','uk-active');
                    //$("#billing").attr('class','uk-disabled');

                    if(document.getElementById('shipping_zip').value != "") {
                        city = document.getElementById('shipping_city').value;
                        state = document.getElementById('shipping_state').value;
                        state = state.replace(" ","%20");
                        zip = document.getElementById('shipping_zip').value;
                        zip = zip.replace(" ","%20");
                        country = document.getElementById('shipping_country').value;
                        city=city.replace(/ /g,"_");

            //console.log('shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);


            <? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
                        var total = document.getElementById("total").value;

                        generateShipping();


             <? } else { ?>
                            $('#shippingRateDisplay').hide();
                        <? } ?>

                    } /*shipping zip */


    }
    /*is th same */

    function isNotTheSame(){
        console.log('isNotTheSame');

        @if(isset($shipping->firstname))
        document.getElementById('shipping_firstname').value = "{{$shipping->firstname}}";
        @endif
        @if(isset($shipping->lastname))
        document.getElementById('shipping_lastname').value = "<?=stripslashes(isset($shipping->firstname)?$shipping->firstname:'')?>";
        @endif
        @if(isset($shipping->address))
        document.getElementById('shipping_address').value = "<?=stripslashes(isset($shipping->address)?$shipping->address:'')?>";
        @endif
        @if(isset($shipping->city))
        document.getElementById('shipping_city').value = "<?=stripslashes(isset($shipping->city)?$shipping->city:'')?>";
        @endif
        @if(isset($shipping->zip))
        document.getElementById('shipping_zip').value = "<?=isset($shipping->zip)?$shipping->zip:'';?>";
        @endif
        @if(isset($shipping->phone))
        document.getElementById('shipping_phone').value = "<?=isset($shipping->phone)?$shipping->phone:'';?>";
        @endif
        @if(isset($shipping->email))
        document.getElementById('shipping_email').value = "<?=isset($shipping->email)?$shipping->email:'';?>";
        @endif

        $("#shipping_country option[value='"+document.getElementById('country').value+"']").attr("selected","selected");
        $("#shipping_country").val(document.getElementById('country').value);



                    /*$("#shipping,#shippingContent").attr('class','uk-active');
                    $("#billing,#billingContent").removeAttr('class','uk-active');
                    $("#billing").attr('class','uk-disabled');*/
                    //$("#shipping").tab('show');

                    if(document.getElementById('shipping_zip').value != "") {
                        city = document.getElementById('shipping_city').value;
                        state = document.getElementById('shipping_state').value;
                        state = state.replace(" ","%20");
                        zip = document.getElementById('shipping_zip').value;
                        zip = zip.replace(" ","%20");
                        country = document.getElementById('shipping_country').value;
                        city=city.replace(/ /g,"_");

                        /*$("#payment,#paymentContent").attr('class','uk-active');
                        $("#billing,#billingContent").removeAttr('class','uk-active');
                        $("#billing").attr('class','uk-disabled');*/
                        //$("#back").show();
                       // $("#next").hide();
                    }

    }
    function validateEmail($email) {
      var emailReg = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return ( $email.length > 0 && emailReg.test( $email ));
    }

    function validatePhone(txtPhone) {
       var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
       return filter.test(txtPhone) ? true : false;
    }

    function checkBillingFields() {
        requiredFields=0;
        if($("#firstname").val()=="") {
            $("#billingFirstnameError").show();
            requiredFields=1;
        } else {
            $("#billingFirstnameError").hide();
        }
        if($("#lastname").val()=="") {
            $("#billingLastnameError").show();
            requiredFields=1;
        } else {
             $("#billingLastnameError").hide();
        }
        if($("#address").val()=="") {
            $("#billingAddressError").show();
            requiredFields=1;
        } else {
            $("#billingAddressError").hide();
        }

        if( !validateEmail($("#email").val())) {
            $("#billingEmailError").show();
            requiredFields=1;
        } else {
            $("#billingEmailError").hide();
        }

        if($("#city").val()=="") {
            $("#billingCityError").show();
            requiredFields=1;
        } else {
             $("#billingCityError").hide();
        }
        if($("#state").val()=="0" || $("#state").val()=="") {
             $("#billingStateError").show();
             requiredFields=1;
        } else {
             $("#billingStateError").hide();
        }
        if($("#country").val()=="0") {
             $("#billingCountryError").show();
             requiredFields=1;
        } else {
             $("#billingCountryError").hide();
        }
        if($("#zip").val()=="") {
             $("#billingZipError").show();
             requiredFields=1;
        } else {
            $("#billingZipError").hide();
        }

        if($("#phone").val() == ""){
            $("#billingPhoneReqError").show();
            $("#billingPhoneError").hide();
            requiredFields=1;
        }else if(!validatePhone($("#phone").val())) {
            $("#billingPhoneError").show();
            $("#billingPhoneReqError").hide();
            requiredFields=1;
        } else {
            $("#billingPhoneReqError").hide();
            $("#billingPhoneError").hide();
        }



        if(requiredFields==1) {
            $("#billingError").show();
        }
        return requiredFields;

    }

    function checkShippingFields() {
        if(!$('#sameas').is(':checked')){
            $('#shippingContent input').each(function(){
                var this_shippng_fld = $(this);
                console.log(this_shippng_fld.attr('id'));
                var this_shippng_fld_val = document.getElementById(this_shippng_fld.attr('id')).value;
                this_shippng_fld.val(this_shippng_fld_val);
            });
        }

        requiredFields=0;
        if($("#shipping_firstname").val()=="") {
            requiredFields=1;
            $("#shippingFirstnameError").show();
        } else {
            $("#shippingFirstnameError").hide();
        }

        if($("#shipping_lastname").val()=="") {
            requiredFields=1;
            $("#shippingLastnameError").show();
        } else {
            $("#shippingLastnameError").hide();
        }

        if($("#shipping_address").val()=="") {
            requiredFields=1;
            $("#shippingAddressError").show();
        } else {
            $("#shippingAddressError").hide();
        }
        if($("#shipping_email").val() != '') {
            if( !validateEmail($("#shipping_email").val())) {
                $("#shippingEmailError").show();
                requiredFields=1;
            } else {
                $("#shippingEmailError").hide();
            }
            $("#shippingEmailReqError").hide();
        }else{
            $("#shippingEmailReqError").show();
            $("#shippingEmailError").hide();
        }

        if($("#shipping_city").val()=="") {
            requiredFields=1;
            $("#shippingCityError").show();
        } else {
            $("#shippingCityError").hide();
        }

        if($("#shipping_state").val()=="0") {
            requiredFields=1;
            $("#shippingStateError").show();
        } else {
            $("#shippingStateError").hide();
        }

        if($("#shipping_zip").val()=="") {
            requiredFields=1;
            $("#shippingZipError").show();
        } else {
            $("#shippingZipError").hide();
        }
        if($("#shipping_phone").val() != ''){
            if(!validatePhone($("#shipping_phone").val())) {
                $("#shippingPhoneError").show();
                requiredFields=1;
            } else {
                $("#shippingPhoneError").hide();
            }
            $("#shippingPhoneReqError").hide();
        }else{
            $("#shippingPhoneReqError").show();
            $("#shippingPhoneError").hide();
        }


        if($("#shipping_country").val()=="0") {
            requiredFields=1;
            $("#shippingCountryError").show();
        } else {
            $("#shippingCountryError").hide();
        }


        if(requiredFields==1) {
            $("#shippingError").show();
        }
        return requiredFields;

    }

    function displayPrevious() {
        /*
        $("#shippingRateError").hide();

        tabText = $('.uk-tab .uk-active').attr('id');
        $('#tabContent li').each(function(){
            var this_uktab_li = $(this);
            if(this_uktab_li.attr('id') != tabText){
                this_uktab_li.removeClass('uk-active');
            }
        });
        $("#next").show();
        $("#checkoutButton").hide();
        if(tabText == "shipping") {
            $("#billing,#billingContent").attr('class','uk-active');
            $("#shipping,#shippingContent").removeAttr('class','uk-active');
            $("#shipping").attr('class','uk-disabled');
            $("#back").hide();
        } else if(tabText == "shippingMethod") {
             $("#shipping,#shippingContent").attr('class','uk-active');
             $("#shippingMethod,#shippingMethodContent").removeAttr('class','uk-active');
             $("#shippingMethod").attr('class','uk-disabled');
             $("#back").show();
             $("#next").show();
        } else if(tabText == "payment") {
            //$("#shipping,#shippingContent").attr('class','uk-active');
            $("#shippingMethod,#shippingMethodContent").attr('class','uk-active');
            $("#payment,#paymentContent").removeAttr('class','uk-active');
            $("#payment").attr('class','uk-disabled');
            $("#back").show();
            $("#next").show();
        }
        */
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

                        generateShipping();
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

                if(zip != "" && state != '' && state != '0') {

                    <?  if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>

                    var total = document.getElementById("total").value;

                         generateShipping();
                    <? } else { ?>
                        $('#shippingRateDisplay').hide();
                    <? } ?>
                }
            }

        }


        function generateShipping() {
                shipping_address = document.getElementById('shipping_address').value;
                city = document.getElementById('shipping_city').value;
                state = document.getElementById('shipping_state').value;
                zip = document.getElementById('shipping_zip').value;
                country = document.getElementById('shipping_country').value;
                city=city.replace(/ /g,"_");
                state=state.replace(/ /g,"_");
                zip=zip.replace(/ /g,"_");
                shipping_address=shipping_address.replace(/ /g,"%20");
                shipping_address=shipping_address.replace(/#|@|$/gi,"");

                 $('#shipping_rate').show();
                 $('#shipping_rate').load('shipping-display-new/'+shipping_address+"/"+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->subtotal?>);
                $('#shippingRateDisplay').show();

        }

        function checkTax(state) {


            $.ajax({
                type: "GET",
                url: "compute-tax/"+state+"/"+<?=$cart[0]->grandtotal?>,
                cache: false,
                success: function(data){
                    var items = JSON.parse(data);
                    $("#tax").text("+ $ "+parseFloat(items[0]).toFixed(2));
                    $("#Grandtotal").text("$ "+Number(parseFloat(items[1]).toFixed(2)).toLocaleString('en'));
                    $("#taxvalue").val(parseFloat(items[0]).toFixed(2));
                    $("#total").val(parseFloat(items[1]).toFixed(2));
                    $('#taxvaluedisplay').html('$ '+parseFloat(items[0]).toFixed(2));
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
                    generateShipping();
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
                       generateShipping();
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
                    $('#stateShippingText').html('State/Province <span class="red required">*</span>');
                } else {
                    //$('#shippingstateus').load("loadState.php");
                    //$('#stateShippingText').Html('State');
                    $('#stateShippingText').html('State <span class="red required">*</span>');
                    $("#shippingstateus").html('{!! Form::select("shipping_state",array("0" => "Select one")+App\Models\State::displayState(), "0",array("id"=>"shipping_state","data-placeholder"=>"Select State","class"=>"form-control textfield_width")) !!}');

                    <? if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
                        //$('#shipping_rate').load('spin.php');
                        generateShipping();
                    <? } else { ?>
                        $('#shippingRateDisplay').hide();
                    <? } ?>
                }



        });

        $('#country').change(function() {
            console.log("Country : "+ document.getElementById('country').value);

            if(document.getElementById('country').value != "US") {
                $('#billingstateus').html('<input type=text name=state id=state>');
                $('#shippingstateus').html('<input type=text name=shipping_state id=shipping_state>');
                $('#stateBillingText').html('State/Province <span class="red required">*</span>');
                $('#stateShippingText').html('State/Province <span class="red required">*</span>');
                $("#shipping_country option[value='"+document.getElementById('country').value+"']").attr("selected","selected");
                    state="";
                    checkTax(state);
            } else {
                $("#shipping_country option[value='"+document.getElementById('country').value+"']").attr("selected","selected");


                $('#billingstateus').html('{!! Form::select("state",array("0" => "Select one")+App\Models\State::displayState(), '0',array("onchange" => "checkTax(this.value)", "id"=>"state","data-placeholder"=>"Select State", "class"=>"form-control textfield_width")) !!}');

                $('#stateBillingText').html('State <span class="red required">*</span>');
                $('#stateShippingText').html('State <span class="red required">*</span>');
                $("#shippingstateus").html('{!! Form::select("shipping_state",array("0" => "Select one")+App\Models\State::displayState(), "0",array("id"=>"shipping_state","data-placeholder"=>"Select State","class"=>"form-control textfield_width")) !!}');


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
                       generateShipping();
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
  {!! Html::script('_front/assets/js/mask.js') !!}
  <script>
    $(document).ready(function($) {

            isphone_valid = 0;
            $('.phone_us').mask('(000) 000-0000',{
              onComplete: function(cep) {
                //$('.phone_us').css({'border':'1px solid green'});
                isphone_valid = 1;
              }, onInvalid: function(cep) {
                $('.phone_us').css({'border':'1px solid red'});
                isphone_valid = 0;
              }
            });
      });
  </script>
@stop