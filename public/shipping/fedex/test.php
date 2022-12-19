<?php

// Copyright 2008, FedEx Corporation. All rights reserved.
// Version 6.0.0

require_once('library/fedex-common.php');

//The WSDL is not included with the sample code.
//Please include and reference in $path_to_wsdl variable.
$path_to_wsdl = "wsdl/RateService_v6.wsdl";

ini_set("soap.wsdl_cache_enabled", "0");
 
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
                                               'StreetLines' => array('Wilshire'), // Destination details
                                               'City' => 'Los Angeles',
                                               'StateOrProvinceCode' => 'CA',
                                               'PostalCode' => '90025',
                                               'CountryCode' => 'US',
										  'Residential' => true));
$request['RequestedShipment']['ShippingChargesPayment'] = array('PaymentType' => 'SENDER',
                                                        'Payor' => array('AccountNumber' => '138212017', // Replace 'XXX' with payor's account number
                                                                     'CountryCode' => 'US'));
$request['RequestedShipment']['RateRequestTypes'] = 'ACCOUNT'; 
$request['RequestedShipment']['RateRequestTypes'] = 'LIST'; 
$request['RequestedShipment']['PackageCount'] = '1';
$request['RequestedShipment']['PackageDetail'] = 'INDIVIDUAL_PACKAGES';
$request['RequestedShipment']['RequestedPackages'] = array('0' => array('SequenceNumber' => '1',
                                                                  'InsuredValue' => array('Amount' => 150.0,
                                                                                          'Currency' => 'USD'),
                                                                  'ItemDescription' => 'Test Products',
                                                                  'Weight' => array('Value' => 31.0,
                                                                                    'Units' => 'LB'),
                                                                  'Dimensions' => array('Length' => 29,
                                                                                        'Width' => 52,
                                                                                        'Height' => 5,
                                                                                        'Units' => 'IN')),
														   '1' => array('SequenceNumber' => '1',
                                                                  'InsuredValue' => array('Amount' => 150.0,
                                                                                          'Currency' => 'USD'),
                                                                  'ItemDescription' => 'Test Products',
                                                                  'Weight' => array('Value' => 31.0,
                                                                                    'Units' => 'LB'),
                                                                  'Dimensions' => array('Length' => 29,
                                                                                        'Width' => 52,
                                                                                        'Height' => 5,
                                                                                        'Units' => 'IN')),
														   '2' => array('SequenceNumber' => '1',
                                                                  'InsuredValue' => array('Amount' => 195.0,
                                                                                          'Currency' => 'USD'),
                                                                  'ItemDescription' => 'Test Products',
                                                                  'Weight' => array('Value' => 19.0,
                                                                                    'Units' => 'LB'),
                                                                  'Dimensions' => array('Length' => 54,
                                                                                        'Width' => 31,
                                                                                        'Height' => 6,
                                                                                        'Units' => 'IN')),
														   '3' => array('SequenceNumber' => '1',
                                                                  'InsuredValue' => array('Amount' => 195.0,
                                                                                          'Currency' => 'USD'),
                                                                  'ItemDescription' => 'Test Products',
                                                                  'Weight' => array('Value' => 19.0,
                                                                                    'Units' => 'LB'),
                                                                  'Dimensions' => array('Length' => 54,
                                                                                        'Width' => 31,
                                                                                        'Height' => 6,
                                                                                        'Units' => 'IN')),
														   '4' => array('SequenceNumber' => '1',
                                                                  'InsuredValue' => array('Amount' => 60.0,
                                                                                          'Currency' => 'USD'),
                                                                  'ItemDescription' => 'Test Products',
                                                                  'Weight' => array('Value' => 6.0,
                                                                                    'Units' => 'LB'),
                                                                  'Dimensions' => array('Length' => 20,
                                                                                        'Width' => 1,
                                                                                        'Height' => 10,
                                                                                        'Units' => 'IN'))
														   );

try 
{
    $response = $client ->getRates($request);

    
    if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR')
    {
        echo 'Rates for following service type(s) were returned.'. $newline. $newline; 
       
		foreach ($response->RateReplyDetails as $options) {
		echo '<pre>' . $options->ServiceType . ' -- ' . $options->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount . '</pre>';
    		}
		


        printRequestResponse($client);
    }
    else
    {
        echo 'Error in processing transaction.'. $newline. $newline; 
        foreach ($response -> Notifications as $notification)
        {           
            if(is_array($response -> Notifications))
            {              
               echo $notification -> Severity;
               echo ': ';           
               echo $notification -> Message . $newline;
            }
            else
            {
                echo $notification . $newline;
            }
        } 
    } 
    
    writeToLog($client);    // Write to log file   

} catch (SoapFault $exception) {
   printFault($exception, $client);        
}

?>