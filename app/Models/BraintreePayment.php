<?php
 
//IF CREDIT CARD NO FIELDS HAS VALUE CREATE NEW BRAINTREE ACCOUNT
require_once "app/payment/braintree/lib/Braintree.php";

Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);

class PaymentManagement extends Eloquent
{
    // does nothing more than
    // specify the table in the database
    protected $table = 'payment_gateway';
	public $timestamps = false;

	public static function bt_create_cust(){
		$userdata = Session::get('user_registration');
		$result = Braintree_Customer::create(array(
			'firstName' => Request::get('cc_firstname'),
			'lastName' => Request::get('cc_lastname'),
			'email' => $userdata['email_address'],
			'creditCard' => array(
				'number' => Request::get('cc_no'),
				// 'expirationDate' => $expiration_month.'/'.Request::get('cc_year'),
				'expirationDate' => Request::get('cc_month').'/'.Request::get('cc_year'),
				'cvv' => Request::get('cc_cvv'),
				'cardholderName' => Request::get('cc_name_on_card')
			)
		));

		return $result;
	}

	public static function bt_update_cust($braintree_id){
		$userdata = Session::get('user_registration');

		$result = Braintree_Customer::update($braintree_id, array(
			'firstName' => Request::get('cc_firstname'),
			'lastName' => Request::get('cc_lastname'),
			'email' => $userdata['email_address'],
			'creditCard' => array(
				'number' => Request::get('cc_no'),
				// 'expirationDate' => $expiration_month.'/'.Request::get('cc_year'),
				'expirationDate' => Request::get('cc_month').'/'.Request::get('cc_year'),
				'cvv' => Request::get('cc_cvv'),
				'cardholderName' => Request::get('cc_name_on_card')
			)
		));

		return $result;
	}

	public static function bt_sale_rw($customer_id){

		$result = Braintree_Transaction::sale(array(
			'merchantAccountId' => BRAINTREE_MERCHANTACCOUNTID,
			'amount' => Config::get('constants.subscription_amount'),
			'customerId' => $customer_id,
			'options' => array(
				'submitForSettlement' => true,
			)
		));

		return $result;
	}

	public static function bt_sale_la($customer_id, $merchantId){

		$result = Braintree_Transaction::sale(array(
			'merchantAccountId' => $merchantId,
			'amount' => Config::get('constants.subscription_amount'),
			'customerId' => $customer_id,
			'options' => array(
				'submitForSettlement' => true,
			),
	        'serviceFeeAmount' => Config::get('constants.service_fee_amount')
		));

		return $result;
	}

	public static function bt_find_subscription($subscription_id) {
		$bt_subscription = Braintree_Subscription::find($subscription_id);

		return $bt_subscription;
	}

	public function bt_find_transaction($transaction_id){
		$transaction = Braintree_Transaction::find($transaction_id);
		// 		pr('transaction');
		// pr($transaction);
		return $transaction;
	}

	public static function payment_thru_braintree($payto, $payfrom, $amount, $service_fee = "0.00") {
		$params = array(
			'merchantAccountId' => $payto, // Paid TO
			'amount' => $amount,
			'customerId' => $payfrom, // Paid FROM
			'options' => array(
				'submitForSettlement' => true,
				'holdInEscrow' => true,
			),
	        'serviceFeeAmount' => $service_fee
		);
		
		$payment = Braintree_Transaction::sale($params);
		return $payment;
	}


	public static function payment_thru_braintree_with_security_deposit($payto, $payfrom, $amount, $security_deposit, $service_fee = "0.00"){
		$paramsRental = array(
			'merchantAccountId' => $payto, // Paid TO
			'amount' => $amount,
			'customerId' => $payfrom, // Paid FROM
			'options' => array(
				'submitForSettlement' => True,
			),
	        'serviceFeeAmount' => $service_fee
		);
		$paymentRental = Braintree_Transaction::sale($paramsRental);

		// Needs to be voided and re-authorized every week
		$paramsSecurityDeposit = array(
			'merchantAccountId' => $payto, // Paid TO
			'amount' => $security_deposit,
			'customerId' => $payfrom, // Paid FROM
			'options' => array(
				'submitForSettlement' => False,
			),
	        'serviceFeeAmount' => $service_fee
		);
		$paymentSecurityDeposit = Braintree_Transaction::sale($paramsSecurityDeposit);

		return $paymentRental;
	}

	public static function security_deposit_thru_braintree($payto, $payfrom, $security_deposit, $service_fee = "0.00"){
		// Needs to be voided and re-authorized every week
		$paramsSecurityDeposit = array(
			'merchantAccountId' => $payto, // Paid TO
			'amount' 			=> $security_deposit,
			'customerId' 		=> $payfrom, // Paid FROM
			'options' 			=> array(
				'submitForSettlement' => false,
			),
	        'serviceFeeAmount' => $service_fee
		);
		$paymentSecurityDeposit = Braintree_Transaction::sale($paramsSecurityDeposit);

		return $paymentSecurityDeposit;
	}

	public function bt_refund($transaction_id, $amount = null) {
		$result = Braintree_Transaction::refund($transaction_id);

		return $result;
	}

	public static function bt_release_escrow($transaction_id) {

		$release = Braintree_Transaction::releaseFromEscrow($transaction_id);

		if($release->success == null) {
			return $release;
		} else {
			$reservation = ReservationHistoryManagement::where('bt_transaction', '=', $transaction_id)->first();

			// release escrow to ambassador
			if($reservation->bt_la_transaction != null) {
				$amb_release = Braintree_Transaction::releaseFromEscrow($reservation->bt_la_transaction);
			}
			
			// toggle release on history and checkout
			$reservation->checked_out = date('Y-m-d h:i:s');
			$reservation->escrow_released = 1;
			$reservation->save();
			return true;
		}

	}

}
 
?>