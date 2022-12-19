<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Session;
class TempCart extends Eloquent
{
   
    protected $table = 'tblTempCart';
    protected $primaryKey = 'fldTempCartID';
	public $timestamps = false;

	static function displayCart() {
		
		$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		$order_date = date('Y-m-d');
		$weight="";
		$cartDisplay = self::leftJoin('tblProduct','tblTempCart.fldTempCartProductID','=','tblProduct.fldProductID')
							->where('fldTempCartClientID','=',$client_id)
							->where('fldTempCartOrderDate','=',$order_date)
							->select('tblProduct.fldProductID as product_id','tblTempCart.fldTempCartID as temp_cart_id',
									 'tblTempCart.fldTempCartQuantity as quantity','tblTempCart.fldTempCartProductPrice as product_price',
									 'tblProduct.fldProductSlug as fldProductSlug','tblProduct.fldProductDescription as fldProductDescription',
									 'tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight','tblTempCart.fldTempCartProductName as product_name','tblProduct.fldProductSubTitle as product_sub_title',
									 'tblTempCart.fldTempCartOrderDate as order_date','tblTempCart.fldTempCartProductOptions as product_options')->get();
		
		$total = 0;	$subtotal=0;$ctr=0;$octr=0;	
		foreach($cartDisplay as $cartDisplays) {
				
				
				//for product options
				$productOption = explode("_",$cartDisplays->product_options);								
				$octr=0;
				$totalOptionPrice = 0;
				if(!empty($productOption)) { 
					$myOptions = array();
					foreach($productOption as $productOptions) {
						//check the price of the productOptions					
						$productOptionsPrice = ProductOptions::leftJoin('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','tblProductOptions.fldProductOptionsAssetsID')
															  ->leftJoin('tblOptions','tblOptions.fldOptionsID','=','tblOptionsAssets.fldOptionsAssetsOptionID')
															  ->select('tblOptionsAssets.fldOptionsAssetsName as assets_name','tblOptions.fldOptionsName as option_name',
															  		  'tblProductOptions.fldProductOptionsPrice as option_price')
															  ->where('fldProductOptionsAssetsID','=',$productOptions)
															  ->where('fldProductOptionsProductID','=',$cartDisplays->product_id)
															  ->first();	

							
						if(!empty($productOptionsPrice)) {									  
							$optionPrice = 	$productOptionsPrice->option_price != 0 ? " ( + ".number_format($productOptionsPrice->option_price,2).")": "";			
		
							//$myOptions[] = array("option_name"=>$productOptionsPrice->option_name,"asset_name"=>$productOptionsPrice->assets_name,"option_price"=>$productOptionsPrice->option_price);
							if($productOptionsPrice->option_name != "") { 
								$myOptions[] = $productOptionsPrice->option_name . " : " . $productOptionsPrice->assets_name . $optionPrice;
							}
							//print_r($cartDisplay[$ctr]['cart_options']);
							$totalOptionPrice = $productOptionsPrice->option_price + $totalOptionPrice;
							$octr=$octr+1;
						}
					}
					$cartDisplay[$ctr]['cart_options'] = $myOptions;
				}
				
				$total =  ($cartDisplays->quantity * $cartDisplays->product_price) + $totalOptionPrice;
                $subtotal = $subtotal + $total;    	
				$weight = $weight + $cartDisplays->weight;

				$cartDisplay[$ctr]['total'] = $total;	
				
				//die();
				$ctr=$ctr+1;			
		}
		
		
		if(Session::has('couponCode')) {
			$freeshipping=false;$coupon_amount=0;$stateName=""; 
			//echo $stateName;die();
			$coupon_code=CouponCode::checkCouponCode(Session::get('couponCode'),$subtotal,$stateName);
			$coupon_code = json_decode($coupon_code);  

			$cartDisplay[0]['coupon_amount'] = $coupon_code->coupon_amount;
			$cartDisplay[0]['freeshipping'] = $coupon_code->freeshipping;
			$grandtotal = $subtotal - $coupon_code->coupon_amount;
		} else {
			$grandtotal = $subtotal;
		}
		
		//echo count($cartDisplay);die();
		if(count($cartDisplay)>=1) {
			$cartDisplay[0]['subtotal'] = $subtotal;
			$cartDisplay[0]['grandtotal'] = $grandtotal;		
			$cartDisplay[0]['weight'] = $weight;	
		}
			//print_r($cartDisplay); 
			//die();
		return $cartDisplay;	
	}
	
	static function countCart() {
		$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		$order_date = date('Y-m-d');
		$cart_count = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)->count();	
		return $cart_count;
	}
		
}


?>