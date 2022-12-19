<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Cart extends Eloquent
{
   
    protected $table = 'tblCart';
    protected $primaryKey = 'fldCartID';
	public $timestamps = false;

	static function displayCart($order_code) {

		$cartDisplay = self::leftJoin('tblProduct','fldProductID','=','fldCartProductID')
					->select('tblProduct.fldProductID as product_id','tblCart.fldCartID as cart_id','tblCart.fldCartQuantity as quantity','tblProduct.fldProductSubTitle as product_sub_title',
							'tblCart.fldCartProductPrice as product_price','tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight',
							'tblCart.fldCartProductName as product_name','tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_no',
							'tblCart.fldCartProductOptions as product_options')
					->where('tblCart.fldCartOrderNo','=',$order_code)
					->get();
		

		
		$total = 0;	$subtotal=0;$ctr=0;	

		foreach($cartDisplay as $cartDisplays) {
			
				//******for product options***********//
				$productOption = explode("_",$cartDisplays->product_options);								
				$octr=0;
				$totalOptionPrice = 0;
				if(!empty($productOption)) { 
					$myOptions = array();
					foreach($productOption as $productOptions) {
						//check the price of the productOptions					
						$productOptionsPrice = ProductOptions::leftJoin('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','fldProductOptionsOptionsID')
															  ->leftJoin('tblOptions','fldOptionsID','=','fldOptionsAssetsOptionID')
															  ->select('fldOptionsAssetsName as assets_name','fldOptionsName as option_name',
															  		    'fldProductOptionsPrice as option_price')
															  ->where('fldOptionsAssetsID','=',$productOptions)
															  ->where('fldProductOptionsProductID','=',$cartDisplays->product_id)
															  ->first();	
						if(!empty($productOptionsPrice)) {									  	
							$optionPrice = 	$productOptionsPrice->option_price != 0 ? " ( + ".number_format($productOptionsPrice->option_price,2).")": "";			
							
							
							if($productOptionsPrice->option_name != "") { 
								$myOptions[] = $productOptionsPrice->option_name . " : " . $productOptionsPrice->assets_name . $optionPrice;
							}
							//print_r($cartDisplay[$ctr]['cart_options']);
							$totalOptionPrice = $productOptionsPrice->option_price + $totalOptionPrice;
						}
							$octr=$octr+1;
					}
					$cartDisplay[$ctr]['cart_options'] = $myOptions;
				}
				//******END for product options***********//
				
				
				$total =  ($cartDisplays->quantity * $cartDisplays->product_price)+$totalOptionPrice;
                $subtotal = $subtotal + $total;    					
				$cartDisplay[$ctr]['total'] = $total;
				$ctr=$ctr+1;
				
		}
		
		
		
		$cartDisplay[0]['subtotal'] = $subtotal;	
		
		return $cartDisplay;	
		
	}
	
	static function displayCheckout($order_code) {
						
		$cartDisplay = self::leftJoin('tblCartCouponCode','tblCart.fldCartOrderNo','=','tblCartCouponCode.fldCartCouponCodeOrderNo')
							->leftJoin('tblCartShippingRate','tblCart.fldCartOrderNo','=','tblCartShippingRate.fldCartShippingRateOrderNo')
							->leftJoin('tblCartTax','tblCart.fldCartOrderNo','=','tblCartTax.fldCartTaxOrderNo')
							->leftJoin('tblClientsBilling','tblCart.fldCartClientID','=','tblClientsBilling.fldClientsBillingClientID')
							->leftJoin('tblClientsShipping','tblCart.fldCartClientID','=','tblClientsShipping.fldClientsShippingClientID')
							->where('tblCart.fldCartOrderNo','=',$order_code)
							->select('tblCartCouponCode.*','tblCartShippingRate.*','tblCartTax.*',
									'tblClientsBilling.fldClientsBillingFirstname as bFirstname','tblClientsBilling.fldClientsBillingLastname as bLastname','tblClientsBilling.fldClientsBillingAddress as bAddress','tblClientsBilling.fldClientsBillingAddress1 as bAddress1','tblClientsBilling.fldClientsBillingCity as bCity','tblClientsBilling.fldClientsBillingState as bSTate','tblClientsBilling.fldClientsBillingZip as bZip','tblClientsBilling.fldClientsBillingEmail as bEmail','tblClientsBilling.fldClientsBillingPhone as bPhone','tblClientsBilling.fldClientsBillingCountry as bCountry',
									 'tblClientsShipping.fldClientsShippingFirstname as sFirstname','tblClientsShipping.fldClientsShippingLastname as sLastname','tblClientsShipping.fldClientsShippingAddress as sAddress','tblClientsShipping.fldClientsShippingAddress1 as sAddress1','tblClientsShipping.fldClientsShippingCity as sCity','tblClientsShipping.fldClientsShippingState as sState','tblClientsShipping.fldClientsShippingZip as sZip','tblClientsShipping.fldClientsShippingEmail as sEmail','tblClientsShipping.fldClientsShippingPhone as sPhone','tblClientsShipping.fldClientsShippingCountry as sCountry',
									 'tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_code')
							->first();
		return $cartDisplay;	
	}

	static function displayOrderHistory($client_id) {
		$cartDisplay = Client::leftJoin('tblCart','tblCart.fldCartClientID','=','tblClient.fldClientID')
							  ->leftJoin('tblProduct','fldProductID','=','fldCartProductID')
							  ->select('tblProduct.fldProductID as product_id','tblCart.fldCartID as cart_id','tblCart.fldCartQuantity as quantity','tblProduct.fldProductSubTitle as product_sub_title',
									   'tblCart.fldCartProductPrice as product_price','tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight',
									   'tblCart.fldCartProductName as product_name','tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_no',
									   'tblCart.fldCartProductOptions as product_options')
							  ->where('tblClient.fldClientID','=',$client_id)
							  ->orderBy('order_date','DESC')
							  ->get();
		return $cartDisplay;							  
		
	}
		
}


?>