<?php
 
namespace App\Models;

use App\Models\BraintreeInformation;
use Illuminate\Database\Eloquent\Model as Eloquent;

use Session;

class ManagerCommission extends Eloquent
{
   
    protected $table = 'tblManagerCommission';
    protected $primaryKey = 'fldManagerCommissionID';
	public $timestamps = false;


	static function calculateCommission($amount,$manager,$clientInfo,$orderCode,$userType) {
		//2% commission for manager or sales		
		$commission = number_format($amount * .10,2);

		$managerCom = new ManagerCommission;
		$managerCom->fldManagerCommissionManagerID = Session::get('couponSourceID');
		$managerCom->fldManagerCommissionUserType = $userType;
		$managerCom->fldManagerCommissionUserID = $clientInfo->fldClientID;
		$managerCom->fldManagerCommissionOrderCode = $orderCode;
		$managerCom->fldManagerCommissionDate = date('Y-m-d');
		$managerCom->fldManagerCommissionAmount = $commission;
		$managerCom->save();

		/*
		require_once "public/payment/braintree/lib/Braintree.php";
	 	\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);

		$results = BraintreeInformation::commissionPayment($commission,$manager->fldManagerBrainTreeMerchantID);
		
		if($results->success != "") {
			//save information to manager commission table
			$managerCom = new ManagerCommission;
				$managerCom->fldManagerCommissionManagerID = $manager->fldManagerID;
				$managerCom->fldManagerCommissionUserType = $userType;
				$managerCom->fldManagerCommissionUserID = $clientInfo->fldClientID;
				$managerCom->fldManagerCommissionOrderCode = $orderCode;
				$managerCom->fldManagerCommissionDate = date('Y-m-d');
				$managerCom->fldManagerCommissionAmount = $commission;
			$managerCom->save();

			//check if sales have manager / territory manager
			if($manager->fldManagerMainID != 0) {
				$managerSales = Manager::find($manager->fldManagerMainID);
				$managerComission = number_format($commission * .20,2);
				self::managerComission($managerComission,$managerSales,$clientInfo,$orderCode,$userType);
			}
		}
		*/

	}



	static function managerComission($amount,$manager,$clientInfo,$orderCode,$userType) {
		require_once "public/payment/braintree/lib/Braintree.php";
	 	\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);

		$results = BraintreeInformation::commissionPayment($amount,$manager->fldManagerBrainTreeMerchantID);
		
		if($results->success != "") {
			//save information to manager commission table
			$managerCom = new ManagerCommission;
				$managerCom->fldManagerCommissionManagerID = $manager->fldManagerID;
				$managerCom->fldManagerCommissionUserType = $userType;
				$managerCom->fldManagerCommissionUserID = $clientInfo->fldClientID;
				$managerCom->fldManagerCommissionOrderCode = $orderCode;
				$managerCom->fldManagerCommissionDate = date('Y-m-d');
				$managerCom->fldManagerCommissionAmount = $amount;
			$managerCom->save();
		}
	}

	public static function displayOrdersCommission($managerID) {
		$status = "Paid";
		$dateFrom = date('Y-m-1');
		$dateTo = date('Y-m-31');

		$cartDisplay = self::join('tblCart','tblCart.fldCartOrderNo','=','tblManagerCommission.fldManagerCommissionOrderCode')
							  ->join('tblClient','tblClient.fldClientID','=','tblCart.fldCartClientID')	
							  ->join('tblProduct','fldProductID','=','fldCartProductID')
							  ->join('tblClientsShipping','tblClientsShipping.fldClientsShippingClientID','=','tblClient.fldClientID')
							  ->select('tblProduct.fldProductSlug as fldProductSlug','tblProduct.fldProductID as product_id','tblCart.fldCartID as cart_id','tblCart.fldCartQuantity as quantity','tblProduct.fldProductSubTitle as product_sub_title',
									   'tblCart.fldCartProductPrice as product_price','tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight',
									   'tblCart.fldCartProductName as product_name','tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_no',
									   'tblCart.fldCartProductOptions as product_options',
									   'tblCart.fldCartImagePrice','tblCart.fldCartFrameInfo','tblCart.fldCartFramePrice',
						    		   	   'tblCart.fldCartFrameDesc','tblCart.fldCartPaperInfo','tblCart.fldCartMat1Info',
									   'tblCart.fldCartMat2Info','tblCart.fldCartMat3Info','tblCart.fldCartMat1Options',
									   'tblCart.fldCartMat2Options','tblCart.fldCartMat3Options','tblCart.fldCartImageSize',
									   'tblCart.fldCartMatBorderSize','tblClientsShipping.fldClientsShippingAddress','tblClientsShipping.fldClientsShippingAddress1',
									   'tblClientsShipping.fldClientsShippingCity','tblClientsShipping.fldClientsShippingState','tblClientsShipping.fldClientsShippingZip',
									   'tblManagerCommission.fldManagerCommissionAmount','tblClient.fldClientFirstname','tblClient.fldClientLastname')
							  ->where('tblManagerCommission.fldManagerCommissionManagerID','=',$managerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblManagerCommission.fldManagerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldManagerCommissionDate','DESC')							
							  ->get();

									  
		return $cartDisplay;							  
	}

	public static function displayOrdersCommissionByDate($managerID,$dateFrom,$dateTo) {
		$status = "Paid";
		
		$cartDisplay = self::join('tblCart','tblCart.fldCartOrderNo','=','tblManagerCommission.fldManagerCommissionOrderCode')
							  ->join('tblClient','tblClient.fldClientID','=','tblCart.fldCartClientID')	
							  ->join('tblProduct','fldProductID','=','fldCartProductID')
							  ->join('tblClientsShipping','tblClientsShipping.fldClientsShippingClientID','=','tblClient.fldClientID')
							  ->select('tblProduct.fldProductSlug as fldProductSlug','tblProduct.fldProductID as product_id','tblCart.fldCartID as cart_id','tblCart.fldCartQuantity as quantity','tblProduct.fldProductSubTitle as product_sub_title',
									   'tblCart.fldCartProductPrice as product_price','tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight',
									   'tblCart.fldCartProductName as product_name','tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_no',
									   'tblCart.fldCartProductOptions as product_options',
									   'tblCart.fldCartImagePrice','tblCart.fldCartFrameInfo','tblCart.fldCartFramePrice',
						    		   	   'tblCart.fldCartFrameDesc','tblCart.fldCartPaperInfo','tblCart.fldCartMat1Info',
									   'tblCart.fldCartMat2Info','tblCart.fldCartMat3Info','tblCart.fldCartMat1Options',
									   'tblCart.fldCartMat2Options','tblCart.fldCartMat3Options','tblCart.fldCartImageSize',
									   'tblCart.fldCartMatBorderSize','tblClientsShipping.fldClientsShippingAddress','tblClientsShipping.fldClientsShippingAddress1',
									   'tblClientsShipping.fldClientsShippingCity','tblClientsShipping.fldClientsShippingState','tblClientsShipping.fldClientsShippingZip',
									   'tblManagerCommission.fldManagerCommissionAmount','tblClient.fldClientFirstname','tblClient.fldClientLastname')
							  ->where('tblManagerCommission.fldManagerCommissionManagerID','=',$managerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblManagerCommission.fldManagerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldManagerCommissionDate','DESC')							
							  ->get();
		
		return $cartDisplay;							  
	}

	public static function displayOrdersCommissionByDateOrderHistory($managerID,$dateFrom,$dateTo) {
		$status = "Paid";
		
		$cartDisplay = self::join('tblCart','tblCart.fldCartOrderNo','=','tblManagerCommission.fldManagerCommissionOrderCode')
							  ->join('tblClient','tblClient.fldClientID','=','tblCart.fldCartClientID')	
							  ->join('tblProduct','fldProductID','=','fldCartProductID')
							  ->join('tblClientsShipping','tblClientsShipping.fldClientsShippingClientID','=','tblClient.fldClientID')
							  ->select('tblProduct.fldProductSlug as fldProductSlug','tblProduct.fldProductID as product_id','tblCart.fldCartID as cart_id','tblCart.fldCartQuantity as quantity','tblProduct.fldProductSubTitle as product_sub_title',
									   'tblCart.fldCartProductPrice as product_price','tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight',
									   'tblCart.fldCartProductName as product_name','tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_no',
									   'tblCart.fldCartProductOptions as product_options',
									   'tblCart.fldCartImagePrice','tblCart.fldCartFrameInfo','tblCart.fldCartFramePrice',
						    		   	   'tblCart.fldCartFrameDesc','tblCart.fldCartPaperInfo','tblCart.fldCartMat1Info',
									   'tblCart.fldCartMat2Info','tblCart.fldCartMat3Info','tblCart.fldCartMat1Options',
									   'tblCart.fldCartMat2Options','tblCart.fldCartMat3Options','tblCart.fldCartImageSize',
									   'tblCart.fldCartMatBorderSize','tblClientsShipping.fldClientsShippingAddress','tblClientsShipping.fldClientsShippingAddress1',
									   'tblClientsShipping.fldClientsShippingCity','tblClientsShipping.fldClientsShippingState','tblClientsShipping.fldClientsShippingZip',
									   'tblManagerCommission.fldManagerCommissionAmount','tblClient.fldClientFirstname','tblClient.fldClientLastname')
							  ->where('tblManagerCommission.fldManagerCommissionManagerID','=',$managerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblManagerCommission.fldManagerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldManagerCommissionDate','DESC')							
							  ->paginate(15);
		
		return $cartDisplay;							  
	}

	public static function displayOrdersCommissionByOrderNo($managerID,$OrderNo) {
		$status = "Paid";
		
		$cartDisplay = self::join('tblCart','tblCart.fldCartOrderNo','=','tblManagerCommission.fldManagerCommissionOrderCode')
							  ->join('tblClient','tblClient.fldClientID','=','tblCart.fldCartClientID')	
							  ->join('tblProduct','fldProductID','=','fldCartProductID')
							  ->join('tblClientsShipping','tblClientsShipping.fldClientsShippingClientID','=','tblClient.fldClientID')
							  ->select('tblProduct.fldProductSlug as fldProductSlug','tblProduct.fldProductID as product_id','tblCart.fldCartID as cart_id','tblCart.fldCartQuantity as quantity','tblProduct.fldProductSubTitle as product_sub_title',
									   'tblCart.fldCartProductPrice as product_price','tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight',
									   'tblCart.fldCartProductName as product_name','tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_no',
									   'tblCart.fldCartProductOptions as product_options',
									   'tblCart.fldCartImagePrice','tblCart.fldCartFrameInfo','tblCart.fldCartFramePrice',
						    		   	'tblCart.fldCartFrameDesc','tblCart.fldCartPaperInfo','tblCart.fldCartMat1Info',
									   'tblCart.fldCartMat2Info','tblCart.fldCartMat3Info','tblCart.fldCartMat1Options',
									   'tblCart.fldCartMat2Options','tblCart.fldCartMat3Options','tblCart.fldCartImageSize',
									   'tblCart.fldCartMatBorderSize','tblClientsShipping.fldClientsShippingAddress','tblClientsShipping.fldClientsShippingAddress1',
									   'tblClientsShipping.fldClientsShippingCity','tblClientsShipping.fldClientsShippingState','tblClientsShipping.fldClientsShippingZip',
									   'tblManagerCommission.fldManagerCommissionAmount','tblClient.fldClientFirstname','tblClient.fldClientLastname')
							  ->where('tblManagerCommission.fldManagerCommissionManagerID','=',$managerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->where('tblCart.fldCartOrderNo','=',$OrderNo)							  							  
							  ->first();
		
		return $cartDisplay;							  
	}

	public static function salesActivities($managerID) {
		$status = "Paid";
		$salesTransaction = array();
		$totalCommission  = 0;
		for($i=1;$i<=12;$i++) {
			$dateFrom = date('Y'.'-'.$i.'-1');
			$dateTo = date('Y'.'-'.$i.'-31');

			$userAccount = self::where('fldManagerCommissionManagerID','=',$managerID)
								->whereBetween('tblManagerCommission.fldManagerCommissionDate', [$dateFrom,$dateTo])
								->groupBy('fldManagerCommissionUserID')
								->count();

			$sales = self::join('tblCart','tblCart.fldCartOrderNo','=','tblManagerCommission.fldManagerCommissionOrderCode')
						->where('fldManagerCommissionManagerID','=',$managerID)
						->whereBetween('tblManagerCommission.fldManagerCommissionDate', [$dateFrom,$dateTo])
						->sum('fldCartProductPrice');

			$commission = self::where('fldManagerCommissionManagerID','=',$managerID)					
								->whereBetween('tblManagerCommission.fldManagerCommissionDate', [$dateFrom,$dateTo])			
								->sum('fldManagerCommissionAmount');					

			$itemsSold = self::join('tblCart','tblCart.fldCartOrderNo','=','tblManagerCommission.fldManagerCommissionOrderCode')
						->where('fldManagerCommissionManagerID','=',$managerID)
						->whereBetween('tblManagerCommission.fldManagerCommissionDate', [$dateFrom,$dateTo])
						->count('tblCart.fldCartOrderNo');													

			$salesTransaction[$i]['month'] = date('F',strtotime($dateFrom));
			$salesTransaction[$i]['userAccount'] = $userAccount;
			$salesTransaction[$i]['iTemsSold'] = $itemsSold;
			$salesTransaction[$i]['Sales'] = $sales;
			$salesTransaction[$i]['Commission'] =$commission;  
			$salesTransaction[$i]['Transaction'] = self::displayOrdersCommissionByDate($managerID,$dateFrom,$dateTo);
			$totalCommission = $totalCommission + $commission;
		}
		$salesTransaction[1]['TotalCommission'] =$totalCommission; 
		//print_r($salesTransaction);die();
		return $salesTransaction;
	}

	public static function calculateCommissionYear($managerID) {
		$status = "Paid";
		$dateFrom = date('Y-m-1');
		$dateTo = date('Y-m-31');

		$sumCommission = self::join('tblCart','tblCart.fldCartOrderNo','=','tblManagerCommission.fldManagerCommissionOrderCode')							  							  
							  ->where('tblManagerCommission.fldManagerCommissionManagerID','=',$managerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblManagerCommission.fldManagerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldManagerCommissionDate','DESC')							
							  ->sum('fldManagerCommissionAmount');
		
		return $sumCommission;							  
	}

	public static function calculateCommissionYearAdmin($managerID) {
		$status = "Paid";
		$dateFrom = date('Y-1-1');
		$dateTo = date('Y-12-31');

		$sumCommission = self::join('tblCart','tblCart.fldCartOrderNo','=','tblManagerCommission.fldManagerCommissionOrderCode')							  							  
							  ->where('tblManagerCommission.fldManagerCommissionManagerID','=',$managerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblManagerCommission.fldManagerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldManagerCommissionDate','DESC')							
							  ->sum('fldManagerCommissionAmount');
		
		return $sumCommission;							  
	}
		
}


?>