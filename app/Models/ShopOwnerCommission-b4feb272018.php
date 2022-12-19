<?php
namespace App\Models;

use App\Models\BraintreeInformation;
use Illuminate\Database\Eloquent\Model as Eloquent;

use Session;

class ShopOwnerCommission extends Eloquent
{
   
    protected $table = 'tblShopOwnerCommission';
    protected $primaryKey = 'fldShopOwnerCommissionID';
	public $timestamps = false;


	static function calculateCommission($amount,$shopOwner,$clientInfo,$orderCode,$userType) {
		$commission = number_format($amount * .50,2);

		//save information to shop owner commission table
		$shopOwnerCom = new ShopOwnerCommission;
		$shopOwnerCom->fldShopOwnerCommissionShopOwnerID = Session::get('couponSourceID');
		$shopOwnerCom->fldShopOwnerCommissionUserType = $userType;
		$shopOwnerCom->fldShopOwnerCommissionUserID = $clientInfo->fldClientID;
		$shopOwnerCom->fldShopOwnerCommissionOrderCode = $orderCode;
		$shopOwnerCom->fldShopOwnerCommissionDate = date('Y-m-d');
		$shopOwnerCom->fldShopOwnerCommissionAmount = $commission;
		$shopOwnerCom->save();

		/*
		require_once "public/payment/braintree/lib/Braintree.php";
	 	\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);

		$results = BraintreeInformation::commissionPayment($commission,$shopOwner->fldShopOwnerBrainTreeMerchantID);
		
		if($results->success != "") {
			//save information to manager commission table
			$shopOwnerCom = new ShopOwnerCommission;
				$shopOwnerCom->fldShopOwnerCommissionShopOwnerID = $shopOwner->fldShopOwnerID;
				$shopOwnerCom->fldShopOwnerCommissionUserType = $userType;
				$shopOwnerCom->fldShopOwnerCommissionUserID = $clientInfo->fldClientID;
				$shopOwnerCom->fldShopOwnerCommissionOrderCode = $orderCode;
				$shopOwnerCom->fldShopOwnerCommissionDate = date('Y-m-d');
				$shopOwnerCom->fldShopOwnerCommissionAmount = $commission;
			$shopOwnerCom->save();

			//check if shop owner have sales person
			if($shopOwner->fldShopOwnerManagerID != "") {
				 $manager = Manager::find($shopOwner->fldShopOwnerManagerID);
				 $managerCommission = ManagerCommission::calculateCommission($commission,$manager,$clientInfo,$orderCode,$userType);
			}
		}
		*/
	}

	public static function displayOrdersCommission($shopOwnerID) {
		$status = "Paid";
		$dateFrom = date('Y-m-1');
		$dateTo = date('Y-m-31');

		$cartDisplay = self::join('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
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
									   'tblShopOwnerCommission.fldShopOwnerCommissionAmount','tblClient.fldClientFirstname','tblClient.fldClientLastname')
							  ->where('tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblShopOwnerCommission.fldShopOwnerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldShopOwnerCommissionDate','DESC')							
							  ->get();
		
		return $cartDisplay;							  
	}

	public static function displayOrdersCommissionByDate($shopOwnerID,$dateFrom,$dateTo) {
		$status = "Paid";
		
		$cartDisplay = self::join('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
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
									   'tblShopOwnerCommission.fldShopOwnerCommissionAmount','tblClient.fldClientFirstname','tblClient.fldClientLastname')
							  ->where('tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblShopOwnerCommission.fldShopOwnerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldShopOwnerCommissionDate','DESC')							
							  ->get();
		
		return $cartDisplay;							  
	}

	public static function displayOrdersCommissionByDateOrderHistory($shopOwnerID,$dateFrom,$dateTo) {
		$status = "Paid";
		
		$cartDisplay = self::join('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
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
									   'tblShopOwnerCommission.fldShopOwnerCommissionAmount','tblClient.fldClientFirstname','tblClient.fldClientLastname')
							  ->where('tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblShopOwnerCommission.fldShopOwnerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldShopOwnerCommissionDate','DESC')							
							  ->paginate(15);
		
		return $cartDisplay;							  
	}

	public static function displayOrdersCommissionByOrderNo($shopOwnerID,$OrderNo) {
		$status = "Paid";
		
		$cartDisplay = self::join('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
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
									   'tblShopOwnerCommission.fldShopOwnerCommissionAmount','tblClient.fldClientFirstname','tblClient.fldClientLastname')
							  ->where('tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->where('tblCart.fldCartOrderNo','=',$OrderNo)							  							  
							  ->first();
		
		return $cartDisplay;							  
	}



	public static function salesActivities($shopOwnerID) {
		$status = "Paid";
		$salesTransaction = array();
		$totalCommission = 0;
		for($i=1;$i<=12;$i++) {
			$dateFrom = date('Y'.'-'.$i.'-1');
			$dateTo = date('Y'.'-'.$i.'-31');
			
			$userAccount = self::where('fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)
								->whereBetween('tblShopOwnerCommission.fldShopOwnerCommissionDate', [$dateFrom,$dateTo])
								->groupBy('fldShopOwnerCommissionUserID')
								->count();

			$sales = self::join('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
						->where('fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)
						->whereBetween('tblShopOwnerCommission.fldShopOwnerCommissionDate', [$dateFrom,$dateTo])
						->sum('fldCartProductPrice');

			$commission = self::where('fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)					
								->whereBetween('tblShopOwnerCommission.fldShopOwnerCommissionDate', [$dateFrom,$dateTo])			
								->sum('fldShopOwnerCommissionAmount');

			$itemsSold = self::join('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
						->where('fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)
						->whereBetween('tblShopOwnerCommission.fldShopOwnerCommissionDate', [$dateFrom,$dateTo])
						->count('tblCart.fldCartOrderNo');													

			$salesTransaction[$i]['month'] = date('F',strtotime($dateFrom));
			$salesTransaction[$i]['userAccount'] = $userAccount;
			$salesTransaction[$i]['iTemsSold'] = $itemsSold;
			$salesTransaction[$i]['Sales'] = $sales;
			$salesTransaction[$i]['Commission'] =$commission; 
			$salesTransaction[$i]['Transaction'] = self::displayOrdersCommissionByDate($shopOwnerID,$dateFrom,$dateTo);
			$totalCommission = $totalCommission + $commission;

		}
		$salesTransaction[1]['TotalCommission'] =$totalCommission; 
		return $salesTransaction;

		
	}

	public static function calculateCommissionYear($shopOwnerID) {
		$status = "Paid";
		$dateFrom = date('Y-m-1');
		$dateTo = date('Y-m-31');

		$sumCommission = self::join('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')							  							  
							  ->where('tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblShopOwnerCommission.fldShopOwnerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldShopOwnerCommissionDate','DESC')							
							  ->sum('fldShopOwnerCommissionAmount');
		
		return $sumCommission;							  
	}

	public static function calculateCommissionYearAdmin($shopOwnerID) {
		$status = "Paid";
		$dateFrom = date('Y-1-1');
		$dateTo = date('Y-12-31');

		$sumCommission = self::join('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')							  							  
							  ->where('tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID','=',$shopOwnerID)
							  ->where('tblCart.fldCartStatus','=',$status)							  
							  ->whereBetween('tblShopOwnerCommission.fldShopOwnerCommissionDate', [$dateFrom,$dateTo])
							  ->orderBy('fldShopOwnerCommissionDate','DESC')							
							  ->sum('fldShopOwnerCommissionAmount');
		
		return $sumCommission;							  
	}
		
}


?>