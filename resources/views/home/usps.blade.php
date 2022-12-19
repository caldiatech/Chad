<?php
// Load the class
require_once("public/shipping/usps/USPSRate.php"); 
$shippingInfo = App\Models\USPS::getInfo();	
// Initiate and set the username provided from usps

$rate = new USPSRate($shippingInfo->fldUSPSUsername);
//$rate = new USPSRate('576PONYT3863');

// During test mode this seems not to always work as expected
//$rate->setTestMode(true);

// Create new package object and assign the properties
// apartently the order you assign them is important so make sure
// to set them as the example below
// set the USPSRatePackage for more info about the constants

$package = new USPSRatePackage;
$servicePackage = array(USPSRatePackage::SERVICE_FIRST_CLASS,USPSRatePackage::SERVICE_PRIORITY,USPSRatePackage::SERVICE_EXPRESS,USPSRatePackage::SERVICE_PARCEL,USPSRatePackage::SERVICE_MEDIA);

foreach($servicePackage as $servicePackages) {

	$package->setService($servicePackages);
	$package->setFirstClassMailType(USPSRatePackage::MAIL_TYPE_PARCEL);	
	$package->setZipOrigination($shippingInfo->fldUSPSZip);
	$package->setZipDestination($values['zip']);
	$package->setPounds($values['weight']);
	$package->setOunces(0);
	$package->setContainer('');
	$package->setSize(USPSRatePackage::SIZE_REGULAR);
	$package->setField('Machinable', true);
	// add the package to the rate stack
	$rate->addPackage($package);
	// Perform the request and print out the result
	$rate->getRate();
	//$uspsRate = $rate->getRate();
	//print_r($rate->getArrayResponse());		
	$rateResponse = $rate->getArrayResponse();	
}



// Was the call successful
// if($rate->isSuccess()) {
// 	echo 'Done';
// } else {
// 	echo 'Error: ' . $rate->getErrorMessage();
// }
?>
			
	
	    <div class="panel panel-default">
    		<div class="panel-heading">
            	<h4 class="panel-title">
			    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
				    USPS
    			</a>
                </h4>
    		</div>
		    <div id="collapseTwo" class="panel-collapse collapse {{ count($shipping)==1 ? "in" : "" }}">
			    <div class="panel-body">
					                           
                        <table border="0" class="table shippingRate">                    		
            				
						  <? 
						  	$strSearch = array("&#174;","&#8482;");
							$strReplace = array("","");
						  	for($i=0;$i<=5;$i++) { 
								//echo htmlentities($rateResponse['RateV4Response']['Package'][$i]['Postage']['MailService']);
						  		$name_service = html_entity_decode(str_replace($strSearch,$strReplace,$rateResponse['RateV4Response']['Package'][$i]['Postage']['MailService']));								
                                $shipping_usps_name_value =  strip_tags($name_service);
                                $shipping_usps_price_value = $rateResponse['RateV4Response']['Package'][$i]['Postage']['Rate'];
								if($shipping_usps_name_value != "") { 									
                          ?>
                            <tr>
                                <td><input type="radio" value="<?=$shipping_usps_name_value?>;<?=$shipping_usps_price_value?>" name="shipping_rate_value" id="shipping_rate_value"> <?=$shipping_usps_name_value?></td>
                                <td>$<?=number_format($shipping_usps_price_value,2)?></td>
                            </tr>   
                         <? } }?>   
                   </table>
					
                   
                
          </div>
                
      </div>
      </div>