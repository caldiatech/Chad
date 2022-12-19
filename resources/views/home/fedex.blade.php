<? 
	require_once("public/app/shipping/fedex/library/fedex-common.php"); 
	//$path_to_wsdl ="app/shipping/fedex/wsdl/RateService_v6.wsdl"; 
	$path_to_wsdl = "public/app/shipping/fedex/wsdl/RateService_v6.wsdl";
	
	ini_set("soap.wsdl_cache_enabled", "0");
	
	$shippingInfo = Fedex::getInfo();		

$client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

$request['WebAuthenticationDetail'] = array('UserCredential' =>
                                      array('Key' => 'yOlFkA291x4uK5Ev', 'Password' => 'camrqMM4Yh5GXUZ6eQHA7isMb')); // Replace 'XXX' and 'YYY' with FedEx provided credentials 
$request['ClientDetail'] = array('AccountNumber' => '138212017', 'MeterNumber' => '103459490');// Replace 'XXX' with your account and meter number
$request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Rate Available Services Request v6 using PHP ***');
$request['Version'] = array('ServiceId' => 'crs', 'Major' => '6', 'Intermediate' => '0', 'Minor' => '0');
$request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
$request['RequestedShipment']['ShipTimestamp'] = date('c');
// Service Type and Packaging Type are not passed in the request
$request['RequestedShipment']['Shipper'] = array('Address' => array(
                                          'StreetLines' => array('10 Fed Ex Pkwy'), // Origin details
                                          'City' => 'Inglewood',
                                          'StateOrProvinceCode' => 'CA',
                                          'PostalCode' => '90301',
                                          'CountryCode' => 'US'));
$request['RequestedShipment']['Recipient'] = array('Address' => array (
                                               'StreetLines' => array($shipping->fldShippingAddress), // Destination details
                                               'City' => $shipping->fldShippingCity,
                                               'StateOrProvinceCode' => $state,
                                               'PostalCode' => $shipping->fldShippingZip,
                                               'CountryCode' => $country,
											   'Residential' => true));
$request['RequestedShipment']['ShippingChargesPayment'] = array('PaymentType' => 'SENDER',
                                                        'Payor' => array('AccountNumber' => '138212017', // Replace 'XXX' with payor's account number
                                                                     'CountryCode' => 'US'));
$request['RequestedShipment']['RateRequestTypes'] = 'ACCOUNT'; 
$request['RequestedShipment']['RateRequestTypes'] = 'LIST'; 
$request['RequestedShipment']['PackageCount'] = '1';
$request['RequestedShipment']['PackageDetail'] = 'INDIVIDUAL_PACKAGES';

$cart = TempCart::displayCart();
foreach($cart as $carts) {
	for($i=1;$i<=$carts->quantity;$i++) { 
						$myOrder[] = array('SequenceNumber' => '1',
	                             'InsuredValue' => array('Amount' => 100,
                                                         'Currency' => 'USD'),
                                 'ItemDescription' => 'Test Products',
                                 'Weight' => array('Value' => number_format(2,2),
                                                       'Units' => 'LB'),
                                 'Dimensions' => array('Length' => number_format(1,2),
                                                       'Width' => number_format(2,2),
                                                       'Height' => number_format(3,2)	,
                                                       'Units' => 'IN'));				
				 $ctr=$ctr+1;
	}
}

//print_r($myOrder);
?>


	    <div class="accordion-group">
    		<div class="accordion-heading">
			    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
				    FedEx
    			</a>
    		</div>
		    <div id="collapseThree" class="accordion-body collapse {{ count($shipping)==1 ? "in" : "" }}">
			    <div class="accordion-inner">
                	
                    
					    <table width="50%" border="0" cellspacing="1" bgcolor="#EAE6E3">
							<?php													
									   $request['RequestedShipment']['RequestedPackages'] = $myOrder;			   
									   $response = $client->getRates($request);
									   
									   function fedexDesc($name) {
										   if($name == "FIRST_OVERNIGHT") {
											   return "FedEx First Overnight";
										   } else if($name == "PRIORITY_OVERNIGHT") {
											   return "FedEx Priority Overnight";
										   } else if($name == "STANDARD_OVERNIGHT") {
											   return "FedEx Standard Overnight";
										   } else if($name == "FEDEX_2_DAY") {
											   return "FedEx 2 Day";
										   } else if($name == "FEDEX_EXPRESS_SAVER") {
											   return "FedEx Express Saver";
										   } else if($name == "FEDEX_GROUND") {
											   return "Fedex Ground";
										   } else if($name == "INTERNATIONAL_PRIORITY") {
											   return "International Priority";	   
										    } else if($name == "INTERNATIONAL_ECONOMY") {
											   return "International Economy";	 
											} else if($name == "GROUND_HOME_DELIVERY") {
											   return "Ground Home Delivery";	    											   
										   } else {
											   return $name;
										   }
									   }
								if(isset($response->RateReplyDetails)) { 	   
                           		 foreach ($response->RateReplyDetails as $options) {
							?>

                              <tr style="padding:5px 5px;">

                                <td>
                                    <input name="shipping_rate_value" id="shipping_rate_value" type="radio" value="<?=fedexDesc($options->ServiceType) .','.$options->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount?>" checked="checked"/>
									<?=fedexDesc($options->ServiceType)?>
                                    <!--<input type="hidden" name="service" value="<?//=fedexDesc($options->ServiceType)?>" />-->
                                </td>                                
                                <td> $<?=number_format($options->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount,2)?> </td>
                              </tr>

                           <? } }?>

                    </table>
                                        
			    </div>
		    </div>
	
        
