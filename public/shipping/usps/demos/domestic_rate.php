<?php
// Load the class
require_once('../USPSRate.php');

// Initiate and set the username provided from usps
$rate = new USPSRate('576PONYT3863');

// During test mode this seems not to always work as expected
//$rate->setTestMode(true);

// Create new package object and assign the properties
// apartently the order you assign them is important so make sure
// to set them as the example below
// set the USPSRatePackage for more info about the constants
$package = new USPSRatePackage;
$servicePackage = array(USPSRatePackage::SERVICE_FIRST_CLASS,USPSRatePackage::SERVICE_PRIORITY,USPSRatePackage::SERVICE_EXPRESS,USPSRatePackage::SERVICE_PARCEL,USPSRatePackage::SERVICE_MEDIA,USPSRatePackage::SERVICE_LIBRARY);

foreach($servicePackage as $servicePackages) {

	$package->setService($servicePackages);
	$package->setFirstClassMailType(USPSRatePackage::MAIL_TYPE_PARCEL);
	$package->setZipOrigination(91601);
	$package->setZipDestination(91730);
	$package->setPounds(0);
	$package->setOunces(3.5);
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
print_r($rateResponse);
for($i=0;$i<=3;$i++) { 
	echo str_replace('&lt;sup&gt;&amp;reg;&lt;/sup&gt;','',$rateResponse['RateV4Response']['Package'][$i]['Postage']['MailService']) . "<br>";
	echo $rateResponse['RateV4Response']['Package'][$i]['Postage']['Rate'] . "<br><br><br>";
}
// Was the call successful
if($rate->isSuccess()) {
	echo 'Done';
} else {
	echo 'Error: ' . $rate->getErrorMessage();
}