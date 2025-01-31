@extends('layouts._front.checkout')

@section('content')
   @include("home.includes.shoppingcartnav")

   <?php 
   $client_id = 0;
   if(isset($billing->fldClientsBillingEmail)){
    $client_id = $billing->fldClientID;
   }

  function check_numeric($said_number){
    $said_number_to_numeric = 0;
    if(is_numeric($said_number)){
      $said_number_to_numeric = $said_number;
    }else{
      $said_number_to_numeric = 0;
    }
    return $said_number_to_numeric;
  }


  $clientid = Session::has('client_id') ? Session::get('client_id') : Session::getId();

    $orderdate = date('Y-m-d');
    $shipping_sequence = \DB::connection('mysql')->select('

            SELECT sum(fldShippingFee) as total_shipping FROM tblShippingFee AS a
                LEFT JOIN tblTempCart AS b ON
                b.frame_sequence = a.fldShippingSequence
                WHERE b.fldTempCartClientID = "'.$clientid.'" AND b.fldTempCartOrderDate = "'.$orderdate.'"

    ');

    $shipping_sequence_check = \DB::connection('mysql')->select('

    SELECT * FROM tblShippingFee AS a
        LEFT JOIN tblTempCart AS b ON
        b.frame_sequence = a.fldShippingSequence
        WHERE b.fldTempCartClientID = "'.$clientid.'" AND b.fldTempCartOrderDate = "'.$orderdate.'"

    ');

    //$shippingFrameSequence = \DB::connection('mysql')->select('
    //    SELECT frame_sequence FROM tblTempCart WHERE fldTempCartClientID = "'.$clientid.'" AND fldTempCartOrderDate = "'.$orderdate.'"
    //');

    $shippingFrameSequence = \App\Models\TempCart::where('fldTempCartClientID',$clientid)->where('fldTempCartOrderDate',$orderdate)->get();

    //if(count($shipping_sequence_check) > 1 ) {
    //  $total_shipping_seq_cost = $shipping_sequence[0]->total_shipping + 60;
    //} else {
    //  $total_shipping_seq_cost = $shipping_sequence[0]->total_shipping;
    //}

    if(count($shipping_sequence_check) > 1 ) {
        // $total_shipping_seq_cost = $shipping_sequence[0]->total_shipping + 60;
        $total_shipping_seq_cost = $shipping_sequence[0]->total_shipping + 30;
        //dd($shipping_sequence[0]->total_shipping);
    } else {
        $total_shipping_seq_cost = $shipping_sequence[0]->total_shipping;
        //dd($shipping_sequence[0]->total_shipping);
    }

    
    $total_quantity = 0;
    $shipping_cost = 0;
    $shipping_cost_total = 0;
    $counter = 0;
    // loop get shipping
    // if first row, shipping fee + additional quantity
    // if 2nd row, get quantity * 60
    // Changed +$60 to +$30 for additional pieces // Edited Nov12 2021
    foreach ($cart as $cart_item) {
        $total_quantity += $cart_item->quantity;

        $shipping_sequence_fee = \DB::connection('mysql')->select('SELECT fldShippingFee FROM tblShippingFee WHERE fldShippingSequence = "'.$cart_item->frame_sequence.'" ');
     //echo "<pre>";print_r($shipping_sequence_fee);exit;

        if ($counter > 0) {
            // $shipping_cost_total += ($cart_item->quantity > 1)? (($cart_item->quantity)*60) : 60;
            $shipping_cost_total += ($cart_item->quantity > 1)? (($cart_item->quantity)*30) : 30;
        } else {
            // $shipping_cost_total = ($cart_item->quantity > 1)? $shipping_sequence_fee[0]->fldShippingFee + (($cart_item->quantity - 1)*60) : $shipping_sequence_fee[0]->fldShippingFee;
            if($shipping_sequence_fee){
                $shipping_cost_total = ($cart_item->quantity > 1)? $shipping_sequence_fee[0]->fldShippingFee + (($cart_item->quantity - 1)*30) : $shipping_sequence_fee[0]->fldShippingFee;
            }else{
                $shipping_cost_total = 0;
            
            }
        }

        $counter++;
        // echo 'shipping_cost_total: '.$shipping_cost_total;
        // echo '<br>';
    }

    // echo 'count_cart: '.$total_quantity;
    // echo '<br>';

    $total_shipping_seq_cost = $shipping_cost_total;

    // echo 'total_shipping_seq_cost: '.$total_shipping_seq_cost;
    // echo '<br>';
    
    //$arr = array( json_encode( $shippingFrameSequence ) );
    //echo implode(",",$arr);


    $ship1 = 0;
    $ship2 = 0;
    $ship3 = 0;
    $ship4 = 0;
    $ship5 = 0;
    $ship6 = 0;
    $ship7 = 0;
    $ship8 = 0;

    $shipArray1 = array();
    $shipArray2 = array();
    $shipArray3 = array();
    $shipArray4 = array();
    $shipArray5 = array();
    $shipArray6 = array();
    $shipArray7 = array();
    $shipArray8 = array();

    foreach ( $shippingFrameSequence as $field ) {
        if ( $field->frame_sequence == 1 ) {
            $one = \App\Models\Product::where('fldProductID',$field->fldTempCartProductID)->first();
            $ship1 = !empty($one) && $one->shipping_proc_fee1 ? $one->shipping_proc_fee1 : 0;
            $shipArray1[] = $ship1;
            //echo "Fee : ".$ship1."<br>";
            //echo "Sequence : ".$field->frame_sequence."<br><br>";
        } else if (  $field->frame_sequence == 2  ){
            $two = \App\Models\Product::where('fldProductID',$field->fldTempCartProductID)->first();
            $ship2 = !empty($two) && $two->shipping_proc_fee2 ? $two->shipping_proc_fee2 : 0;
            $shipArray2[] = $ship2;
            //echo "Fee : ".$ship2."<br>";
            //echo "Sequence : ".$field->frame_sequence."<br><br>";
        } else if (  $field->frame_sequence == 3  ){
            $three = \App\Models\Product::where('fldProductID',$field->fldTempCartProductID)->first();
            $ship3 = !empty($three) && $three->shipping_proc_fee3 ? $three->shipping_proc_fee3 : 0;
            $shipArray3[] = $ship3;
            //echo "Fee : ".$ship3."<br>";
            //echo "Sequence : ".$field->frame_sequence."<br><br>";
        } else if (  $field->frame_sequence == 4  ){
            $four = \App\Models\Product::where('fldProductID',$field->fldTempCartProductID)->first();
            $ship4 = !empty($four) && $four->shipping_proc_fee4 ? $four->shipping_proc_fee4 : 0;
            $shipArray4[] = $ship4;
            //echo "Fee : ".$ship4."<br>";
            //echo "Sequence : ".$field->frame_sequence."<br><br>";
        } else if (  $field->frame_sequence == 5  ){
            $five = \App\Models\Product::where('fldProductID',$field->fldTempCartProductID)->first();
            $ship5 = !empty($five) && $five->shipping_proc_fee5 ? $five->shipping_proc_fee5 : 0;
            $shipArray5[] = $ship5;
            //echo "Fee : ".$ship5."<br>";
            //echo "Sequence : ".$field->frame_sequence."<br><br>";
        } else if (  $field->frame_sequence == 6  ){
            $six = \App\Models\Product::where('fldProductID',$field->fldTempCartProductID)->first();
            $ship6 = !empty($six) && $six->shipping_proc_fee6 ? $six->shipping_proc_fee6 : 0;
            $shipArray6[] = $ship6;
            //echo "Fee : ".$ship6."<br>";
            //echo "Sequence : ".$field->frame_sequence."<br><br>";
        } else if (  $field->frame_sequence == 7  ){
            $seven = \App\Models\Product::where('fldProductID',$field->fldTempCartProductID)->first();
            $ship7 = !empty($seven) && $seven->shipping_proc_fee7 ? $seven->shipping_proc_fee7 : 0;
            $shipArray7[] = $ship7;
            //echo "Fee : ".$ship7."<br>";
            //echo "Sequence : ".$field->frame_sequence."<br><br>";
        } else if (  $field->frame_sequence == 8  ){
            $eight = \App\Models\Product::where('fldProductID',$field->fldTempCartProductID)->first();
            $ship8 = !empty($eight) && $eight->shipping_proc_fee8 ? $eight->shipping_proc_fee8 : 0;
            $shipArray8[] = $ship8;
            //echo "Fee : ".$ship8."<br>";
            //echo "Sequence : ".$field->frame_sequence."<br><br>";
        }
    }

    $count_shipping_item = count($shippingFrameSequence);
    $minus_shipping_item = $count_shipping_item - 1;
    // $added_cost = $count_shipping_item > 1 ? 60 * $minus_shipping_item : 0;
    $added_cost = $count_shipping_item > 1 ? 30 * $minus_shipping_item : 0;

    //$getMaxShip1 = $ship1;
    //$getMaxShip2 = $ship2;
    //$getMaxShip3 = $ship3;
    //$getMaxShip4 = $ship4;
    //$getMaxShip5 = $ship5;
    //$getMaxShip6 = $ship6;
    //$getMaxShip7 = $ship7;
    //$getMaxShip8 = $ship8;

    $getMaxShip1 = !empty($shipArray1) && count($shipArray1) > 1 ? max( $shipArray1 ) : $ship1;
    $getMaxShip2 = !empty($shipArray2) && count($shipArray2) > 1 ? max( $shipArray2 ) : $ship2;
    $getMaxShip3 = !empty($shipArray3) && count($shipArray3) > 1 ? max( $shipArray3 ) : $ship3;
    $getMaxShip4 = !empty($shipArray4) && count($shipArray4) > 1 ? max( $shipArray4 ) : $ship4;
    $getMaxShip5 = !empty($shipArray5) && count($shipArray5) > 1 ? max( $shipArray5 ) : $ship5;
    $getMaxShip6 = !empty($shipArray6) && count($shipArray6) > 1 ? max( $shipArray6 ) : $ship6;
    $getMaxShip7 = !empty($shipArray7) && count($shipArray7) > 1 ? max( $shipArray7 ) : $ship7;
    $getMaxShip8 = !empty($shipArray8) && count($shipArray8) > 1 ? max( $shipArray8 ) : $ship8;
    
    //dd($shipArray1);

    $get_max = 
    max( 
        $getMaxShip1, $getMaxShip2, $getMaxShip3,
        $getMaxShip4, $getMaxShip5, $getMaxShip6,
        $getMaxShip7, $getMaxShip8
    );

    // $final_shipping_cost = $get_max + $added_cost;
    $final_shipping_cost = 0;

    //echo "Final Shipping Cost : " . $final_shipping_cost."<br>";
    //echo "Get Max : " . $get_max."<br>";
    //echo "Added Cost : " . $added_cost."<br>";


    //echo "COUNT: ".$minus_shipping_item."<br>";
    //echo "ADDED COST: ".$added_cost."<br>";
    //echo "MAX: ".$get_max."<br>";
    //echo "MAX 2: ".$getMaxShip1. " - " .$getMaxShip2. " - " .$getMaxShip3. " - " .$getMaxShip4. " - " .$getMaxShip5. " - " .$getMaxShip6. " - " .$getMaxShip7. " - " .$getMaxShip8."<br>";
    //echo "FINAL COST: ".$final_shipping_cost."<br>";


    //$datass = !empty($shipArray1) && count($shipArray1) > 1 ? max($shipArray1) : 0;
    //echo $datass;

  ?>
  <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top">
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">
                        <div  id="checkout-page"  class="uk-width-1-1">

        {!! Html::flash_msg_front() !!}
        {!! Form::open(array('url' => '/checkout', 'method' => 'post',  'class' => 'row-fluid full-width uk-margin-large-top input-100 bill-info uk-form','id'=>'page_form')) !!}

            <div class="uk-grid">
                <div class="uk-width-large-1-2 uk-width-1-1 uk-margin-large-bottom">


                    <ul id="tabContent" class="uk-switcher uk-margin">
                        <?php /************Billing****************/ ?>
                        <li id="billingContent">
                            <h1 class="uk-h2 text-uppercase">Billing Address</h1>
                           <?php /*<div id="billingError" style="display:none;" class="uk-text-danger">Fields mark with * are required</div>*/ ?>
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
                                    {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),isset($billing->fldClientsBillingState) ? $billing->fldClientsBillingState : "0",array('id'=>'state','data-placeholder'=>'Select State', 'class'=>'form-control')) !!}
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
                        <?php /************END Billing****************/ ?>

                        <?php /************Shipping Addres****************/ ?>
                        <li id="shippingContent">
                            <h2>Shipping Address</h2>
                            Please fill out your Shipping information below.<hr />
                            <?php /*<div id="shippingError" style="display:none;" class="text-danger">Fields mark with * are required</div> */ ?>
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
                                       {!! Form::select('shipping_country',array('0' => 'Select Country')+App\Models\Country::displayCountry(),isset($shipping->fldClientsShippingCountry) ? $shipping->fldClientsShippingCountry : "US",array('id'=>'shipping_country','class'=>'form-control')) !!}
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
                                        {!! Form::select('shipping_state',array('' => 'Select State')+App\Models\State::displayState(),isset($shipping->fldClientsShippingState) ? $shipping->fldClientsShippingState : "0",array('onchange' => 'checkTax(this.value)','id'=>'shipping_state','class'=>'form-control required','required')) !!}
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
                        <?php /************End Shipping Addres****************/ ?>

                        <?php /************Shipping METHOD****************/ ?>
                            <li id="shippingMethodContent">
                                <h2>Shipping Method</h2>
                                Please fill out your select your shipping method.<hr />
                               <div id="shippingRateError" style="display:none;" class="uk-alert uk-alert-danger">Please select shipping method.</div>
                                <div id="shipping_rate">{!! Html::image('_front/assets/images/ajax-loader.gif') !!}</div>
                            </li>
                        <?php /************Shipping METHOD****************/ ?>


                        <?php /************Payment Method****************/ ?>
                        <li id="paymentContent">
                                <h2>Payment Method</h2>
                                Please fill out your select your payment method.<hr />
                                @include('home.braintree_cc')
                        </li>
                        <?php   /************END Payment Method****************/ ?>

                    </ul>


                </div><!-- 3/4 -->
                <?php 
                    $finalizing = $discount_amount = $taxpercent = 0;
                    $tax_total = is_numeric($finalizing) ? $finalizing : 0.00;

                    $sub_total = $cart[0]->subtotal;
                    $discount_total = $cart[0]->grandtotal;
                    if(Session::has('couponCode')){
                        $discount_total = $coupon_code->total;
                        //$discount_amount = $coupon_code->total;
                    }
                    $grand_total = $discount_total;

                ?>
                <div class="uk-width-large-1-2 uk-width-small-1-1">
                    <div class="order-total box-bordered padding-medium  uk-text-left">
                        <h2>Order Total</h2>
                        <table class="uk-table uk-table-small">
                            <tr class="border-bottom">
                                <td colspan="2"><strong>PRODUCT</strong></td>
                                <td class="uk-text-right"><strong>TOTAL</strong></td>
                            </tr>  
                            <?php $shipping_total = $shipping_per_item = $without_shipping_total = 0; ?>
                             @foreach($cart as $carts)
                                <?php 
                                $subtotal_per_item = $carts->total;
                                $shipping_per_item = $carts->fldTempCartShippingPrice * $carts->quantity;
                                $subtotal_per_item_without_shipping = $subtotal_per_item; // client already separated the shipping cost
                                $shipping_total += $shipping_per_item;
                                $without_shipping_total += $subtotal_per_item_without_shipping;
                                ?>
                                <tr class="roboto">
                                    <td colspan="2">

                                        <div class="full-width">
                                            <h4 class="uk-margin-remove">{!! $carts->product_name !!} ( {!! $carts->quantity !!} )</h4>
					                            <p>{!! $carts->printName !!}</p>
                                            <div class="grey ">{!! $carts->fldTempCartFrameDesc !!}</div>
                                            <div class="grey ">{!! $carts->fldTempCartImageSize !!}</div>
                                        </div>
                                    </td>
                                    <td class="uk-text-right">
                                        <strong>$ @if(empty($carts->total)) <?php $carts->total=0; ?> @endif
                                        {!! number_format($subtotal_per_item_without_shipping,2) !!}</strong>
                                    </td>
                                </tr>
                             @endforeach                            
                            <tr class="border-top">
                                <td colspan="2"><strong>CART SUBTOTAL</strong></td>
                                <td class="uk-text-right roboto"><strong>$<span id="subtotal">
                                    {{ number_format($without_shipping_total,2) }}
                                    @if(empty($coupon_code)) <?php settype($coupon_code,'object'); ?> @endif  </strong>

                                @if(empty($coupon_code->freeshipping)) <?php $coupon_code->freeshipping='yes'; ?>  @endif
                                {!! Form::hidden('freeshipping',$coupon_code->freeshipping) !!}
                                @if($coupon_code->freeshipping == 'yes')
                                    {!! Form::hidden('shipping_rate_value','0') !!}
                                @endif </td>
                            </tr>

                            @if(Session::has('couponCode'))
                            <tr class="border-top">
                                <td colspan="2"><strong>Discount</strong> <small>( {!! Session::get('couponCode').' | '.Session::get('couponSource').'-'.Session::get('couponSourceID') !!} )</small></td>
                                <td class="uk-text-right roboto"><span id="coupon_amount">- <strong>
                                    @if(Session::has('couponAmount'))
                                        $ {!! number_format(Session::get('couponAmount'),2) !!}
                                    @elseif(empty($cart[0]->coupon_amount))
                                       $ {!! number_format($coupon_code->coupon_amount,2) !!} 
                                    @else
                                     $ {!! number_format($cart[0]->coupon_amount,2) !!}
                                    @endif</span></strong></td>
                            </tr>
                            @endif

                            <tr class="border-top">
                                <td valign="top"><strong>Shipping</strong></td>
                                <?php /* <td class="uk-text-right roboto"><strong><span>{!!number_format(check_numeric($shipping_total),2)!!}</span></strong></td> */ ?>
                                <td colspan="2" class="uk-text-right roboto">
                                    <!--
                                    <small>
                                    <span class="shipping-selection" id="shipping-selection">
                                    <?php $checked = $defaultShippingAmount = $defaultShippingCode = ""; ?>

                                    @if (!empty($shipping_options) && isset($shipping_options->shippingData->shippingCostDatas))
                                        <?php
                                         /* 
                                        <input type="radio" name="shipping_option" value="{!!number_format(check_numeric($shipping_options->shippingData->oneDayCost),2)!!}"> &nbsp; 
                                        <span>1 day <strong>$ {!!number_format(check_numeric($shipping_options->shippingData->oneDayCost),2)!!}</strong></span><br>

                                        <input type="radio" name="shipping_option" value="{!!number_format(check_numeric($shipping_options->shippingData->overNight),2)!!}"> &nbsp; 
                                        <span>Overnight <strong>$ {!!number_format(check_numeric($shipping_options->shippingData->overNight),2)!!}</strong></span><br>

                                        <input type="radio" name="shipping_option" value="{!!number_format(check_numeric($shipping_options->shippingData->secondDayCost),2)!!}"> &nbsp; 
                                        <span>Second day <strong>$ {!!number_format(check_numeric($shipping_options->shippingData->secondDayCost),2)!!}</strong></span><br> 
                                        */
                                         ?>

                                                @if (count($shipping_options->shippingData->shippingCostDatas) > 1)
                                                            <?php // print_r($shipping_options->shippingData->shippingCostDatas); echo count($shipping_options->shippingData->shippingCostDatas); die('297'); ?>
                                                            @foreach($shipping_options->shippingData->shippingCostDatas as $shipping)
                                                            <?php 
                                                            // $checked = ($shipping->methodCode=='STANDARD')? 'checked="checked"': "";
                                                            if ($shipping->methodCode=='STANDARD' || $shipping->methodCode=="USPS") {
                                                                $checked = 'checked="checked"';
                                                                $defaultShippingAmount = $shipping->price;
                                                                $defaultShippingCode = $shipping->methodCode;
                                                            } else {
                                                                $checked = '';
                                                            }
                                                            ?>
                                                            <input type="radio" name="shipping_option" class="shipping-option" value="{!!check_numeric($shipping->price)!!}" data-code="{!!$shipping->methodCode!!}" {!!$checked!!}> &nbsp;
                                                            <span>{!!$shipping->methodName!!} <strong>
                                                                <br>{!!$shipping->methodCode.'/'.$defaultShippingAmount!!}
                                                                <br>$ {!!number_format(check_numeric($shipping->price),2)!!}</strong></span><br>
                                                            @endforeach
                                                @else
                                                    - - -
                                                   
                                                @endif

                                    @else
                                        - - -
                                        
                                    @endif
                                    {!! $total_shipping_seq_cost !!}
                                    -->
                                    <!-- <strong>$ {!! number_format($total_shipping_seq_cost,2) !!}</strong> -->
                                    <strong>$ {!! number_format($final_shipping_cost,2) !!}</strong> 
                                    
                                    </small>
                                    </span>
                                </td>
                            </tr>

                            <tr class="border-top">
                                <!-- <td colspan="2"><strong>Tax <?php echo $total_shipping_seq_cost; ?></strong></td> -->
                                <td colspan="2"><strong>Tax</strong></td>

                                <td class="uk-text-right roboto"><strong><span id="taxvaluedisplay">
                                    {!!number_format(check_numeric($tax_total),2)!!}
                                </span></strong></td>
                            </tr>

                            <tr class="border-top">
                                <td colspan="2"><strong>ORDER TOTAL</strong></td>
                                <td class="uk-text-right roboto">
                                <?php
                                $cup_amt = 0;
                                $cup_amt1 = $cart[0]->coupon_amount;
                                if(Session::has('couponAmount')) {
                                    $cup_amt = $cup_amt1 = Session::get('couponAmount');
                                }
                                // $order_total = $grand_total + $shipping_total;
                                // $order_total = (float)$grand_total + (float)$defaultShippingAmount + (float)$tax_total + (float)$final_shipping_cost - (float)$cup_amt;
                                $order_total = (float)$grand_total + (float)$defaultShippingAmount + (float)$tax_total + (float)$final_shipping_cost;                               
                                // echo 'subtotal: '.$grand_total.'<br>';
                                // echo 'discount: '.$cart[0]->coupon_amount.'<br>';
                                // echo 'shipping: '.$defaultShippingAmount.'<br>';
                                // echo 'tax: '.$tax_total.'<br>';
                                // echo 'Total Shipping: '.$total_shipping_seq_cost.'<br>';
                                // echo 'Total: '.$order_total.'<br>';
                                ?>
                                 <strong><span id="Grandtotal">                                   
                                   $ {!! number_format($order_total,2)!!}
                                  </span></strong>

                                {!! Form::hidden('total',$sub_total,array('id'=>'total')) !!}

                                @if(empty(Session::get('couponCode')))<?php Session::get('couponCode',''); ?>@endif
                                {!! Form::hidden('coupon_code',Session::get('couponCode')) !!}
                                
                                {!! Form::hidden('coupon_price',$cup_amt1,array('id'=>'coupon_price')) !!}

                                {!! Form::hidden('shipping_rate_val','',array('id'=>'shipping_rate_val')) !!}
                                {{-- Form::hidden('shipping_amount',$shipping_total,array('id'=>'shipping_amount')) --}}

                                <div style="display:none !important;">
                                    {{--  Removed because of shipping sequence  --}}
                                    {{--  {!! Form::text('shipping_amount',$defaultShippingAmount,array('id'=>'shipping_amount','class'=>'shipping_amount')) !!}  --}}
                                    {!! Form::text('shipping_amount',$final_shipping_cost,array('id'=>'shipping_amount','class'=>'shipping_amount')) !!}
                                    
                                    {!! Form::text('shipping_code',$defaultShippingCode,array('id'=>'shipping_code','class'=>'shipping_code')) !!}
                                </div>

                                {!! Form::hidden('tax',$tax_total,array('id'=>'taxvalue')) !!}
                                {!! Form::hidden('tax_percent',$taxpercent,array('id'=>'taxpercent')) !!}

                                {!! Form::hidden('grand_total',$order_total,array('id'=>'grand_total')) !!}

                                {!! Form::hidden('client_id',$client_id,array('id'=>'client_id')) !!}
                                </td>
                            </tr>
                            <tr class="border-top">
                                <td colspan="3" class="">
                                    <label for="paywithcreditcard" class="full-width uk-padding-medium-top"><input type="radio" checked="checked" name="paywithcreditcard" id="paywithcreditcard" value="paywithcreditcard" /> <strong>Debit/Credit Card</strong> {!! Html::image('_front/assets/images/credit-card-image.jpg','pay with credit card', array('width'=>'135','height'=>"26", 'class'=>'')) !!}</label>
                                    <div class="full-width uk-padding-medium-right uk-padding-medium-left grey fsize-12"></div>
                                </td>
                             </tr>
                        </table>
                    </div>
                    <div class="next-btns uk-margin-top">
                        <ul class="uk-tab" data-uk-tab="{connect:'#tabContent'}">
                            <li class="uk-active" id="billing"><a href="javascript:void(0)" class="uk-button uk-button-primary full-width uk-margin-small-bottom ">Next 1</a></li>
                            <li class="please-show" id="shipping"><a href="javascript:void(0)" class="uk-button uk-button-primary full-width uk-margin-small-bottom ">Next 2</a></li>
                            <li class="" id="shippingMethod"><a href="javascript:void(0)" class="uk-button uk-button-primary full-width uk-margin-small-bottom ">Next 3</a></li>
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

    var tab_array_click_counter = 0, required_filled = false,
    tax_amount = 0, tax_total = 0, tax_percent = 0, sub_total = 0, total_temp = 0, shipping_amount = 0, 
    grand_total = discount_amount = discounted_total = client_id = 0,
    client_email = '';
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
        var e = document.getElementById("state");
        var selectedState = e.options[e.selectedIndex].value;
        // alert(selectedState);
        // Compute tax based on Billing State
        // checkTax(this.value);
        checkTax(selectedState);
        $('.next-btns .uk-tab > li#shipping').removeClass('please-show'); isTheSame();
        $('.next-btns .uk-tab > li#payment').addClass('please-show');
      }else{
        // Clear computed tax
        // $('#shippingRateDisplay').hide();
        $('.next-btns .uk-tab > li#payment').removeClass('please-show'); isNotTheSame();
        $('.next-btns .uk-tab > li#shipping').addClass('please-show');
      }
    });

    var tabTimer;
    function displayNext(this_tab_id) {
      console.log('displayNext('+this_tab_id+')');
        tabText = this_tab_id;
        clearTimeout(tabTimer);
        $('#checkoutButton').hide();
        $('.next-btns').removeClass('place-an-order');
        if(tabText == "billing") {
            console.log('tabtext=billing');
            if($("#sameas").is(':checked')) {
                $('.next-btns .uk-tab > li#payment a').text("Next");
                $('.next-btns .uk-tab > li#payment').addClass('please-show');
            }else{
                $('.next-btns .uk-tab > li#shipping a').text("Next");
                $('.next-btns .uk-tab > li#shipping').addClass('please-show');
            }

        } else if(tabText == "shipping") {
            console.log('tabtext=shipping');

            $('.next-btns .uk-tab > li#billing a').text("Back");
            $('.next-btns .uk-tab > li#billing').removeClass('please-show');

              var this_billing_flds_no_error = 0;
              if($('#email').val() != ''){
              }
              console.log('check_duplicate_email()');
              console.log(this_billing_flds_no_error);
              if(this_billing_flds_no_error == 0){
                console.log('checkBillingFields()');
                this_billing_flds_no_error = checkBillingFields();
                if(this_billing_flds_no_error==0) {
                    $('.next-btns .uk-tab > li#payment a').text("Next");
                    $('.next-btns .uk-tab > li#payment').addClass('please-show');
                    // $('.next-btns .uk-tab > li#shippingmethod a').text("Next");
                    // $('.next-btns .uk-tab > li#shippingmethod').addClass('please-show');
                }
               
              }else{
                $("#billingEmailError").html('This email address is already registered. Please <a href=" login">login.</a>');
                $("#billingEmailError").show();
              }
              $('.next-btns .uk-tab > li#billing a').text("Back");
              $('.next-btns .uk-tab > li#billing').addClass('please-show');

              console.log('checkBillingForm('+this_billing_flds_no_error+')');
              checkBillingForm(this_billing_flds_no_error);

        } else if(tabText == "shippingMethod") {

            console.log('tabtext=shippingmethod');

            if(checkShippingFields()==0) {
                $('.next-btns .uk-tab > li#payment a').text("Next");
                $('.next-btns .uk-tab > li#payment').addClass('please-show');

                if($('#sameas').is(':checked')) {
                    $('.next-btns .uk-tab > li#billing a').text("Back");
                    $('.next-btns .uk-tab > li#billing').addClass('please-show');
                }else {
                }

            }else{
               tabTimer = setTimeout(function(){
                    $('.next-btns .uk-tab > li#shipping').trigger('click');
                },100);
            }

        } else if(tabText == "payment") {

			var this_shipping_flds_no_error = 0;
			console.log(this_shipping_flds_no_error);

				console.log('checkShippingFields');
				this_shipping_flds_no_error = checkShippingFields();
				if(this_shipping_flds_no_error==0) {
				} else {
					console.log('error in shipping section');
				}

              console.log('checkShippingForm('+this_shipping_flds_no_error+')');
              checkShippingForm(this_shipping_flds_no_error);

            $('.next-btns .uk-tab > li#shipping a').text("Back");
            $('.next-btns .uk-tab > li#shipping').addClass('please-show');

            $('#checkoutButton').show();
            $('.next-btns').addClass('place-an-order');


        }
    }

    function checkBillingForm(no_error){
        console.log(no_error);
        if(no_error==0) {
                $("#billingError").hide();
				// $("#shipping_country").find('option').removeAttr("selected");
				// $("#back").show();
            }else{
                // return to billing tab
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
                         // $("#shippingstateus").html('{!! Form::select("shipping_state",array("0" => "Select one")+App\Models\State::displayState(), "0",array("id"=>"shipping_state","data-placeholder"=>"Select State","class"=>"form-control textfield_width")) !!}');

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
                        console.log('Ln581');
                        city = document.getElementById('shipping_city').value;
                        state = document.getElementById('shipping_state').value;
                        state = state.replace(" ","%20");
                        zip = document.getElementById('shipping_zip').value;
                        zip = zip.replace(" ","%20");
                        country = document.getElementById('shipping_country').value;
                        city=city.replace(/ /g,"_");
                        // console.log('589 shipping-display/'+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->weight?>+'/'+<?=$cart[0]->subtotal?>);
                        <?php if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
                            console.log('Ln591');
                            var total = document.getElementById("total").value;
                            // generateShipping();
                        <?php } else { ?>
                            $('#shippingRateDisplay').hide();
                        <?php } ?>

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


        if(document.getElementById('shipping_zip').value != "") {
            city = document.getElementById('shipping_city').value;
            state = document.getElementById('shipping_state').value;
            state = state.replace(" ","%20");
            zip = document.getElementById('shipping_zip').value;
            zip = zip.replace(" ","%20");
            country = document.getElementById('shipping_country').value;
            city=city.replace(/ /g,"_");
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
            $("#billingEmailError").html('Please enter a valid email address.');
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

    $(document).on('change', 'input#email', function(){
        // var this_email_available = check_duplicate_email();
    });

    function check_duplicate_email(){
      client_id = $('#client_id').val();
      if(client_id == 0){
        client_email = $('#email').val();
        $.ajax({
          type: "GET",
          url: "{{url('get-client-by-email')}}",
          data:{client_email:client_email},
          cache: false,
          success: function(get_client_res){
            console.log('get_client_res');
            console.log(get_client_res);
            if(get_client_res ==  0){
               $("#billingEmailError").hide();
              $('#shipping').addClass('please-show');
              return 0;
            }else{
              $("#billingEmailError").html('This email address is already registered. Please <a href=" login">login.</a>');
              $("#billingEmailError").show();
              $('#shipping').removeClass('please-show');
              return 1;
            }
          }
        });
      }else{
        return 1;
      }
    }

    function checkShippingForm(no_error){
        console.log(no_error);
        if(no_error==0) {
                $("#shippingError").hide();
                // $("#shipping_country").find('option').removeAttr("selected");
               // $("#back").show();
            }else{
                    //return to billing tab
                tabTimer = setTimeout(function(){
                    $('.next-btns .uk-tab > li#shipping').trigger('click');
                },100);
            }
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

        if($("#shipping_state").val()=="0" || $("#shipping_state").val()=="" ) {
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

                    <?php if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>

                    var total = document.getElementById("total").value;

                        generateShipping();
                    <?php } else { ?>
                        $('#shippingRateDisplay').hide();
                    <?php }  ?>
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

                    <?php  if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>

                    var total = document.getElementById("total").value;

                         generateShipping();
                    <?php } else { ?>
                        $('#shippingRateDisplay').hide();
                    <?php } ?>
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
            console.log('shipping-display-new/'+shipping_address+"/"+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->subtotal?>);
            $('#shipping_rate').load('shipping-display-new/'+shipping_address+"/"+city+'/'+state+'/'+country+'/'+zip+'/'+<?=$cart[0]->subtotal?>);
            $('#shippingRateDisplay').show();
        }

        function checkTax(state) {
            total_shipping_seq_cost = parseFloat('<?php echo $final_shipping_cost; ?>');
            sub_total = $("#total").val(); 
            grand_total = $("#grand_total").val();   
            discount_amount = 0;            
 
            // shipping_amount = $("#shipping_amount").val(); 
            if($('#shipping_amount').val() != ''){
              shipping_amount = parseFloat($('#shipping_amount').val()); 
            }
            if($('#coupon_price').val() != ''){
              discount_amount = parseFloat($('#coupon_price').val()); 
            }
            discounted_total = parseFloat(sub_total) - discount_amount;  
            console.log('checkTax('+state+') called');
            console.log('discount_amount');
            console.log(discount_amount);
            console.log('sub_total');
            console.log(sub_total);
            console.log('shipping_amount');
            console.log(shipping_amount);
            console.log('discounted_total');
            console.log(discounted_total);

            // alert('checkTax Ln972');

            if(state != '' && state != undefined){

              $.ajax({
                  type: "GET",
                  url: "compute-tax/"+state+"/"+<?=$cart[0]->grandtotal?>,
                  cache: false,
                  success: function(data){
                      var items = JSON.parse(data);
                      tax_amount = parseFloat(items[0]);
                      tax_percent = 0;
                      if(items[2] != undefined){
                        tax_percent = parseFloat(items[2]);
                      }
                      
                      $("#tax").text("+ $ "+tax_amount);
                      /*P * (1 - d/100) * t/100*/
                      console.log('tax_amount');
                      console.log(tax_amount);
                      console.log('tax_percent');
                      console.log(tax_percent);
                      tax_total = discounted_total * (tax_percent/100);
                      console.log('tax_total');
                      console.log(tax_total);
                      console.log('shipping_amount');
                      console.log(shipping_amount);
                      console.log('total_shipping_seq_cost');
                      console.log(total_shipping_seq_cost);
                      /*grand_total =  P * (1 - d/100) + Tax total + s*/
                      // grand_total =  discounted_total + tax_total + shipping_amount;
                      grand_total =  discounted_total + tax_total + total_shipping_seq_cost;
                      console.log('grand_total =  discounted_total + tax_total + shipping_amount + total_shipping_seq_cost');
                      console.log(grand_total);
                      tax_total = tax_total.toFixed(2);
                      grand_total = parseFloat(grand_total).toFixed(2);
                      $("#Grandtotal").text("$ "+Number(grand_total).toLocaleString('en'));
                      // $("#Grandtotal").text("$ "+grand_total);
                      $("#taxvalue").val(tax_total);
                      $("#tax_percent").val(tax_percent);
                      $('#taxvaluedisplay').html('$ '+tax_total);
                      // $("#grand_total").val(grand_total);
                  }
              });

            <?php /* // if (!Session::has('client_id')) {
            // >>> Insert Shipping
                // Get shipping options
                $.ajax({
                    type: "GET",
                    url: "display-shipping-options/",
                    data: $("#page_form").serialize(),
                    success: function(data){

                        // alert();
                        
                        var response = JSON.parse(data);
                        console.log('ln1013 - success');
                        console.log(response);
                        // console.log(data);

                        // $("#shipping-selection").hide();

                        // var defaultShippingAmount = 0;
                        var defaultShippingAmount = response.shippingData.baseCost;
                        console.log('defaultShippingAmount: '+defaultShippingAmount);

                        var defaultShippingCode = response.shippingData.carrier;
                        console.log('defaultShippingCode: '+defaultShippingCode);

                        var shipOpt = response.shippingData.shippingCostDatas;
                        var shipping_option_html = '';
                        var checked = '';
                        Object.keys(shipOpt).forEach(function(key) {
                            console.log(key, shipOpt[key]);
                            console.log(shipOpt[key].methodCode);
                            if (key==0) { checked = 'checked="checked"'; } else { checked = '';}
                            shipping_option_html += '<input type="radio" name="shipping_option" class="shipping-option" value="'+shipOpt[key].price+'" data-code="'+shipOpt[key].methodCode+'" '+checked+'> &nbsp; <span>'+shipOpt[key].methodName+'<strong><br>'+shipOpt[key].methodCode+'>'+shipOpt[key].price+'<br>$ '+shipOpt[key].price+'</strong></span><br>';
                        });

                        $("#shipping-selection").html(shipping_option_html);

                        $("#shipping_amount").val(defaultShippingAmount);
                        $("#shipping_code").val('STANDARD');

                        var subTotalAmt  = parseFloat($('#total').val());

                        if(isNaN(parseFloat($('#coupon_price').val())))
                        {
                           var couponAmt = 0 ;
                        }
                        else
                        {
                          var couponAmt = parseFloat($('#coupon_price').val());
                        }

                        var taxAmt       = parseFloat($('#taxvalue').val());
                        var total_shipping_seq_cost = '<?php echo $total_shipping_seq_cost; ?>';
                        var grandTotalAmt = (subTotalAmt + defaultShippingAmount - couponAmt + taxAmt);

                        $("#grand_total").val(grandTotalAmt);
                        $("#Grandtotal").text("$ "+grandTotalAmt.toLocaleString());

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('ln1046 - error');
                        console.log(textStatus, errorThrown);
                    }

                });
            // >>> Insert Shipping
            // } */ ?>

            }

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

            <?php if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
                generateShipping();
            <?php } else { ?>
                $('#shippingRateDisplay').hide();
            <?php } ?>
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
                <?php if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
                    //$('#shipping_rate').load('spin.php');
                   generateShipping();
                <?php } else { ?>
                    $('#shippingRateDisplay').hide();
                <?php } ?>
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

                <?php if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
                    //$('#shipping_rate').load('spin.php');
                    generateShipping();
                <?php } else { ?>
                    $('#shippingRateDisplay').hide();
                <?php } ?>
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
                 // state="";
                 // checkTax(state);
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

            <?php if($coupon_code->freeshipping == "no" || !isset($coupon_code)) { ?>
               generateShipping();
            <?php } else { ?>
                    $('#shippingRateDisplay').hide();
            <?php } ?>
        }

   });

</script>


@section('headercodes')
{{-- Html::style('_front/uikit/css/components/accordion.min.css') --}}
@stop

@section('extracodes')
{{-- Html::script('_front/uikit/js/components/accordion.min.js') --}}
{!! Html::script('_front/assets/js/mask.js') !!}

  <script>
    $(document).ready(function($) {
        $('#address').on('input', function() {
            var maxLength = 60;
            var addressValue = $(this).val();

            if (addressValue.length > maxLength) {
                $('#billingAddressError').show().text('Address cannot exceed ' + maxLength + ' characters');
                $(this).val(addressValue.substring(0, maxLength));
            } else {
                $('#billingAddressError').hide();
            }
        });

        // $('#address').on('input', function() {
        //     var maxLength = 60;
        //     var addressValue = $(this).val();
            
        //     var alphabeticCharacters = addressValue.replace(/[^a-zA-Z]/g, '');
            
        //     if (alphabeticCharacters.length > maxLength) {
        //         $('#billingAddressError').show().text('Address cannot exceed ' + maxLength + ' alphabetic characters');
        //         var excessAlphabetic = alphabeticCharacters.length - maxLength;
        //         $(this).val(addressValue.substring(0, addressValue.length - excessAlphabetic));
        //     } else {
        //         $('#billingAddressError').hide();
        //     }
        // });

        // 
        $(document).on('click',"#shipping-selection .shipping-option",function () {
        // $('.shipping-option').click(function () {
            // alert('click');
            var shippingAmount  = parseFloat($(this).val());

            //patrick add
            if(isNaN(parseFloat($('#coupon_price').val())))
            {
               var couponAmount = 0 ;
            }
            else
            {
               var couponAmount    = parseFloat($('#coupon_price').val());
              
            }

            var total_shipping_seq_cost = '<?php echo $final_shipping_cost; ?>';



            var taxAmount       = parseFloat($('#taxvalue').val());
            var subTotalAmount  = parseFloat($('#total').val());
            var shippingCode    = $(this).attr("data-code");
            // var grandTotalAmount = $('#grand_total').val();
            var grandTotalAmount = ( subTotalAmount + shippingAmount - couponAmount + taxAmount + parseFloat(total_shipping_seq_cost) );
            console.log('code: '+shippingCode+' / amount: '+shippingAmount);
            console.log('subtotal: '+subTotalAmount+' + shipping: '+shippingAmount+' - coupon: '+couponAmount+' + tax: '+taxAmount+' = '+grandTotalAmount);
            $(".shipping_code").val(shippingCode);
            $(".shipping_amount").val(shippingAmount);

            $("#Grandtotal").text("$ "+grandTotalAmount.toLocaleString());
        });



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

        setTimeout(function() {
            $('#emailValidation').fadeOut('fast');
        }, 8000); // <-- time in milliseconds

      });
  </script>
@stop
@stop