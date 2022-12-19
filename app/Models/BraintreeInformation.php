<?php
 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

use \Braintree_Customer;

class BraintreeInformation extends Eloquent
{
   
    public static function createSubMerchant($params) {
	    				
			$validParams = array(
			  'individual' => array(
				'firstName' => $params[0], //firstname
				'lastName' => $params[1], //lastname
				'email' => $params[2], //email
				'phone' => $params[3], //phone
				'address' => array(
				  'streetAddress' => $params[4], //address
				  'postalCode' => $params[5], //postal code 
				  'locality' => $params[6], //city
				  'region' => $params[7], // state
				),		
				'dateOfBirth' => $params[8],
			  ),
			  
			  'funding' => array(
				'routingNumber' => $params[9], //routing number
				'accountNumber' => $params[10], // account number
				'destination' => \Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
				'descriptor' => $params[0] . ' ' . $params[1],
			  ),
			  'tosAccepted' => true,
			  'masterMerchantAccountId' => BRAINTREE_MERCHANTACCOUNTID
			);
			 
			$results= \Braintree_MerchantAccount::create($validParams);
			return $results;
    }

    public static function createClient($params) {

		$result = \Braintree_Customer::create(array(
				'firstName' => $params[0], //firstname
				'lastName' => $params[1], //lastname
				'email' => $params[2], //email
					'creditCard' => array(
						'number' => $params[3], //cc number
						'expirationDate' => $params[4].'/'.$params[5], // cc_month/cc_year
						'cvv' => $params[6], //cvv
						'cardholderName' => $params[0] . ' ' . $params[1]
					)
		));
		return $result;
    }

	public static function updateClient($braintreeID, $params) {
	    		
		$result = Braintree_Customer::update(
		    $braintreeID, [
				'firstName' => $params[0], //firstname
				'lastName' => $params[1], //lastname
				'email' => $params[2], //email
				'creditCard' => [
					'number' => $params[3], //cc number
					'expirationDate' => $params[4].'/'.$params[5], // cc_month/cc_year
					'cvv' => $params[6], //cvv
					'cardholderName' => $params[0] . ' ' . $params[1]
				]
	    	]
		);
		return $result;
    }

   public static function findClient($id) {
    	$result = \Braintree_Customer::find($id);			
	return $result;
    }	

   public static function findMerchant($id) {
    	$result = \Braintree_MerchantAccount::find($id);
    	return $result;
    }	
	
     public static function clientPayment($customer_id,$amount){

		$result = \Braintree_Transaction::sale(array(
			'merchantAccountId' => BRAINTREE_MERCHANTACCOUNTID,
			'amount' => $amount,
			'customerId' => $customer_id,
			'options' => array(
				'submitForSettlement' => true,
			)
		));

		return $result;
	}
	
	public static function commissionPayment($amount,$braintreeMerchant) {
		$result = \Braintree_Transaction::sale(array(
			'merchantAccountId' => $braintreeMerchant,
			'amount' => $amount,
			'customerId' => BRAINTREE_MASTERACCOUNTID,
			'options' => array(
				'submitForSettlement' => true,
			),
	        'serviceFeeAmount' => 0.00
		));

		return $result;
	}
		
}


?>