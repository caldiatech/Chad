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
		$matParams = "";

		$cartDisplay = self::leftJoin('tblProduct','tblTempCart.fldTempCartProductID','=','tblProduct.fldProductID')
							->where('fldTempCartClientID','=',$client_id)
							->where('fldTempCartOrderDate','=',$order_date)
							->select('tblProduct.fldProductID as product_id','tblTempCart.fldTempCartID as temp_cart_id',
									 'tblTempCart.fldTempCartQuantity as quantity','tblTempCart.fldTempCartProductPrice as product_price',
									 'tblTempCart.fldTempCartProductName', 
									 'tblProduct.fldProductSlug as fldProductSlug','tblProduct.fldProductDescription as fldProductDescription',
									 'tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight','tblTempCart.fldTempCartProductName as product_name','tblProduct.fldProductSubTitle as product_sub_title','tblProduct.fldProductIsVertical',
									 'tblTempCart.fldTempCartOrderDate as order_date','tblTempCart.fldTempCartProductOptions as product_options',
									 'tblTempCart.fldTempCartImagePrice','tblTempCart.fldTempCartFrameInfo','tblTempCart.fldTempCartFramePrice',
									 'tblTempCart.fldTempCartFrameDesc','tblTempCart.fldTempCartPaperInfo','tblTempCart.fldTempCartMat1Info',
									 'tblTempCart.fldTempCartMat2Info','tblTempCart.fldTempCartMat3Info','tblTempCart.fldTempCartMat1Options',
									 'tblTempCart.fldTempCartMat2Options','tblTempCart.fldTempCartMat3Options','tblTempCart.fldTempCartImageSize',
									 'tblTempCart.fldTempCartMatBorderSize', 'tblTempCart.fldTempCartFinishkitInfo')->get();
								
		
		$total = 0;	$subtotal=0;$ctr=0;
		
		if($cartDisplay->isEmpty())
			return $cartDisplay;

		foreach($cartDisplay as $cartDisplays) {
				
				
				//for product options
				$productOption = explode("_",$cartDisplays->product_options);				
				$total =  ($cartDisplays->quantity * $cartDisplays->product_price);
                $subtotal = $subtotal + $total;    	
				$weight = $weight + $cartDisplays->weight;
				$cartDisplay[$ctr]['total'] = $total;	
				
				//die();
				//For frame options
				if($cartDisplays->fldTempCartPaperInfo != "") {
					$paperInfo = explode(';', $cartDisplays->fldTempCartPaperInfo);
					$cartDisplay[$ctr]['paper_info'] = $paperInfo;
				}

				if($cartDisplays->fldTempCartMat1Info != "") {
					$mat1 = explode(';', $cartDisplays->fldTempCartMat1Info);
					$cartDisplay[$ctr]['mat1'] = $mat1;
					$matParams .=  "&mat1=".$mat1[0]; 					
				}

				if($cartDisplays->fldTempCartMat2Info != "") {
					$mat2 = explode(';', $cartDisplays->fldTempCartMat2Info);
					$cartDisplay[$ctr]['mat2'] = $mat2;
					$matParams .=  "&mat2=".$mat2[0]; 
				}

				if($cartDisplays->fldTempCartMat3Info != "") {
					$mat3 = explode(';', $cartDisplays->fldTempCartMat3Info);
					$cartDisplay[$ctr]['mat3'] = $mat3;
					$matParams .=  "&mat3=".$mat3[0];
				}

				if($cartDisplays->fldTempCartMat1Options != "") {
					$mat1Options = explode(';', $cartDisplays->fldTempCartMat1Options);
					$cartDisplay[$ctr]['mat1_Options'] = $mat1Options;

					foreach($mat1Options as $mat1Optionss) {
						if($mat1Optionss=="V-Groove") {
							$matParams .=  "&vgrooveOffset=.75";		
						}
						if($mat1Optionss=="Reverse Bevel Cut") {
							$matParams .=  "&m1b=true";		
						}
						if($mat1Optionss=="Raised Mat") {
							$matParams .=  "&mat1Raised=true";		
						}
					}

				}

				if($cartDisplays->fldTempCartMat2Options != "") {
					$mat2Options = explode(';', $cartDisplays->fldTempCartMat2Options);
					$cartDisplay[$ctr]['mat2_Options'] = $mat2Options;
					$matParams .=  "&off=".$mat2Options[0];
					foreach($mat2Options as $mat2Optionss) {
						if($mat2Optionss=="Reverse Bevel Cut") {
							$matParams .=  "&m2b=true";		
						}
						if($mat2Optionss=="Raised Mat") {
							$matParams .=  "&mat2Raised=true";		
						}
					}
				}

				if($cartDisplays->fldTempCartMat3Options != "") {
					$mat3Options = explode(';', $cartDisplays->fldTempCartMat3Options);
					$cartDisplay[$ctr]['mat3_Options'] = $mat3Options;
					$matParams .=  "&off3=".$mat3Options[0];
					foreach($mat3Options as $mat3Optionss) {
						if($mat3Optionss=="Reverse Bevel Cut") {
							$matParams .=  "&m3b=true";		
						}
						if($mat3Optionss=="Raised Mat") {
							$matParams .=  "&mat3Raised=true";		
						}
					}
				}

				$imageSize = ProductOptions::join('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','tblProductOptions.fldProductOptionsAssetsID')
								->where('fldProductOptionsID','=',$cartDisplays->fldTempCartImageSize)
								->first();
								// dd($imageSize);
				if($cartDisplays->fldTempCartFrameDesc != "") {			
					$frameDESC = explode(';', $cartDisplays->fldTempCartFrameDesc);
					$cartDisplay[$ctr]['frame_size'] = $frameDESC[0];
					if(count($frameDESC)==2) {
						$cartDisplay[$ctr]['frame_desc'] = $frameDESC[1];
					}	
				}

				$cartDisplay[$ctr]['image_height'] = ($imageSize) ? $imageSize->fldOptionsAssetsHeight : 0;
				$cartDisplay[$ctr]['image_width'] = ($imageSize) ? $imageSize->fldOptionsAssetsWidth : 0;
				$cartDisplay[$ctr]['matParams'] = $matParams;	
				$ctr=$ctr+1;			
		}
		
		
		if(Session::has('couponCode')) {
			$freeshipping=false;$coupon_amount=0;$stateName=""; 
			//echo $stateName;die();
			$coupon_code=CouponCode::checkCouponCode(Session::get('couponCode'),$subtotal,$stateName);
			$coupon_code = json_decode($coupon_code);  
			$cartDisplay[0]['coupon_amount'] = $coupon_code->coupon_amount;
			$cartDisplay[0]['freeshipping'] = $coupon_code->freeshipping;	
			$grandtotal = $subtotal - $cartDisplay[0]['coupon_amount'];		
		}else{
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
		$cart_count = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)->sum('fldTempCartQuantity');	
		return $cart_count;
	}
		
}


?>