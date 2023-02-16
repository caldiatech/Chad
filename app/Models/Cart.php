<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

use App\SoapXmlBuilder;

class Cart extends Eloquent
{

    protected $table = 'tblCart';
    protected $primaryKey = 'fldCartID';
	public $timestamps = false;

	static function displayCart($order_code) {

		$cartDisplay = self::leftJoin('tblProduct','fldProductID','=','fldCartProductID')
					->select('tblProduct.fldProductSlug as fldProductSlug',
						'tblProduct.fldProductID as product_id',
						'tblProduct.fldProductSubTitle as product_sub_title',
						'tblProduct.fldProductIsVertical',
						'tblCart.fldCartID as cart_id',
						'tblCart.fldCartQuantity as quantity',
						'tblCart.fldCartProductPrice as product_price','tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight',
						'tblCart.fldCartProductName as product_name','tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_no',
						'tblCart.fldCartProductOptions as product_options',
						'tblCart.fldCartShippingPrice',
						'tblCart.fldCartImagePrice','tblCart.fldCartFrameInfo','tblCart.fldCartFramePrice',
					    'tblCart.fldCartFrameDesc','tblCart.fldCartPaperInfo','tblCart.fldCartMat1Info',
						'tblCart.fldCartMat2Info','tblCart.fldCartMat3Info','tblCart.fldCartMat1Options',
						'tblCart.fldCartMat2Options','tblCart.fldCartMat3Options','tblCart.fldCartImageSize',
						'tblCart.fldCartMatBorderSize', 'tblCart.gd_status', 'tblCart.gd_orderId', 'tblCart.fldCartFinishkitInfo', 'tblCart.fldCartLinerDesc', 'tblCart.fldCartLinerSku','tblCart.printTotal','tblCart.printName')
					->where('tblCart.fldCartOrderNo','=',$order_code)
					->get();

		$total = 0;	$subtotal=0;$ctr=0;

		if(count($cartDisplay) > 0){
			foreach($cartDisplay as $cartDisplays) {
				if($cartDisplays->gd_orderId != "") {
					// $gd_update = SoapXmlBuilder::getOrderStatus($cartDisplays->gd_orderId);
					// $cartDisplays->gd_status = $gd_update->orderConfirmation->message;
					// $cartDisplays->gd_orderId = $gd_update->orderConfirmation->orderId;
					$cartDisplays->gd_status = "";
					$cartDisplays->gd_orderId = "";
				} else {
					$cartDisplays->gd_status = "";
					$cartDisplays->gd_orderId = "";
				}



				//******for product options***********//
				$productOption = explode("_",$cartDisplays->product_options);
				$octr=0;
				$totalOptionPrice = 0;
				$matParams = "";
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
				// $total =  ($cartDisplays->quantity * $cartDisplays->product_price)+$totalOptionPrice + $cartDisplays->fldCartShippingPrice;
                $subtotal = $subtotal + $total;
				$cartDisplay[$ctr]['total'] = $total;

				//For frame options
				if($cartDisplays->fldCartPaperInfo != "") {
					$paperInfo = explode(';', $cartDisplays->fldCartPaperInfo);
					$cartDisplay[$ctr]['paper_info'] = $paperInfo;
				}

				if($cartDisplays->fldCartMat1Info != "") {
					$mat1 = explode(';', $cartDisplays->fldCartMat1Info);
					$cartDisplay[$ctr]['mat1'] = $mat1;
					$matParams .=  "&mat1=".$mat1[0];
				}

				if($cartDisplays->fldCartMat2Info != "") {
					$mat2 = explode(';', $cartDisplays->fldCartMat2Info);
					$cartDisplay[$ctr]['mat2'] = $mat2;
					$matParams .=  "&mat2=".$mat2[0];
				}

				if($cartDisplays->fldCartMat3Info != "") {
					$mat3 = explode(';', $cartDisplays->fldCartMat3Info);
					$cartDisplay[$ctr]['mat3'] = $mat3;
					$matParams .=  "&mat3=".$mat3[0];
				}

				if($cartDisplays->fldCartMat1Options != "") {
					$mat1Options = explode(';', $cartDisplays->fldCartMat1Options);
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

				if($cartDisplays->fldCartMat2Options != "") {
					$mat2Options = explode(';', $cartDisplays->fldCartMat2Options);
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

				if($cartDisplays->fldCartMat3Options != "") {
					$mat3Options = explode(';', $cartDisplays->fldCartMat3Options);
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
								->where('fldProductOptionsID','=',$cartDisplays->fldCartImageSize)
								->first();
				if($cartDisplays->fldCartFrameDesc != "") {
					$frameDESC = explode(';', $cartDisplays->fldCartFrameDesc);
					$cartDisplay[$ctr]['frame_size'] = $frameDESC[0];
					if(count($frameDESC)==2) {
						$cartDisplay[$ctr]['frame_desc'] = $frameDESC[1];
					}
				}
				if($imageSize) {
					$cartDisplay[$ctr]['image_height'] = $imageSize->fldOptionsAssetsHeight;
					$cartDisplay[$ctr]['image_width'] = $imageSize->fldOptionsAssetsWidth;
				}
				$cartDisplay[$ctr]['matParams'] = $matParams;

				$ctr=$ctr+1;

			}
			$cartDisplay[0]['subtotal'] = $subtotal;
		}

		return $cartDisplay;

	}


	static function displayCheckout($order_code) {

		// $cartDisplay = self::leftJoin('tblCartCouponCode','tblCart.fldCartOrderNo','=','tblCartCouponCode.fldCartCouponCodeOrderNo')
		// 					->leftJoin('tblCartShippingRate','tblCart.fldCartOrderNo','=','tblCartShippingRate.fldCartShippingRateOrderNo')
		// 					->leftJoin('tblCartTax','tblCart.fldCartOrderNo','=','tblCartTax.fldCartTaxOrderNo')
		// 					->leftJoin('tblClientsBilling','tblCart.fldCartClientID','=','tblClientsBilling.fldClientsBillingClientID')
		// 					->leftJoin('tblClientsShipping','tblCart.fldCartClientID','=','tblClientsShipping.fldClientsShippingClientID')
		// 					->where('tblCart.fldCartOrderNo','=',$order_code)
		// 					->select('tblCartCouponCode.*','tblCartShippingRate.*','tblCartTax.*',
		// 							'tblClientsBilling.fldClientsBillingFirstname as bFirstname','tblClientsBilling.fldClientsBillingLastname as bLastname','tblClientsBilling.fldClientsBillingAddress as bAddress','tblClientsBilling.fldClientsBillingAddress1 as bAddress1','tblClientsBilling.fldClientsBillingCity as bCity','tblClientsBilling.fldClientsBillingState as bSTate','tblClientsBilling.fldClientsBillingZip as bZip','tblClientsBilling.fldClientsBillingEmail as bEmail','tblClientsBilling.fldClientsBillingPhone as bPhone','tblClientsBilling.fldClientsBillingCountry as bCountry',
		// 							 'tblClientsShipping.fldClientsShippingFirstname as sFirstname','tblClientsShipping.fldClientsShippingLastname as sLastname','tblClientsShipping.fldClientsShippingAddress as sAddress','tblClientsShipping.fldClientsShippingAddress1 as sAddress1','tblClientsShipping.fldClientsShippingCity as sCity','tblClientsShipping.fldClientsShippingState as sState','tblClientsShipping.fldClientsShippingZip as sZip','tblClientsShipping.fldClientsShippingEmail as sEmail','tblClientsShipping.fldClientsShippingPhone as sPhone','tblClientsShipping.fldClientsShippingCountry as sCountry',
		// 							 	'tblCart.fldCartOrderDate as order_date',
		// 							 	 'tblCart.fldCartOrderNo as order_code',
		// 							 	 'tblCart.fldCartShippingAddress','tblCart.fldCartClientID', 'tblCart.fldCartLinerDesc', 'tblCart.fldCartLinerSku', 'tblCart.fldCartShippingPrice')
		// 					->first();

		$cartDisplay = self::leftJoin('tblCartCouponCode','tblCart.fldCartOrderNo','=','tblCartCouponCode.fldCartCouponCodeOrderNo')
							->leftJoin('tblCartTax','tblCart.fldCartOrderNo','=','tblCartTax.fldCartTaxOrderNo')
							->leftJoin('tblClientsBilling','tblCart.fldCartClientID','=','tblClientsBilling.fldClientsBillingClientID')
							->leftJoin('tblClientsShipping','tblCart.fldCartClientID','=','tblClientsShipping.fldClientsShippingClientID')
							->where('tblCart.fldCartOrderNo','=',$order_code)
							->select('tblCartCouponCode.fldCartCouponCodeCouponPrice', 'tblCartCouponCode.fldCartCouponCodeCouponCode', 'tblCartTax.fldCartTax',
									'tblClientsBilling.fldClientsBillingFirstname as bFirstname','tblClientsBilling.fldClientsBillingLastname as bLastname','tblClientsBilling.fldClientsBillingAddress as bAddress','tblClientsBilling.fldClientsBillingAddress1 as bAddress1','tblClientsBilling.fldClientsBillingCity as bCity','tblClientsBilling.fldClientsBillingState as bSTate','tblClientsBilling.fldClientsBillingZip as bZip','tblClientsBilling.fldClientsBillingEmail as bEmail','tblClientsBilling.fldClientsBillingPhone as bPhone','tblClientsBilling.fldClientsBillingCountry as bCountry',
									 'tblClientsShipping.fldClientsShippingFirstname as sFirstname','tblClientsShipping.fldClientsShippingLastname as sLastname','tblClientsShipping.fldClientsShippingAddress as sAddress','tblClientsShipping.fldClientsShippingAddress1 as sAddress1','tblClientsShipping.fldClientsShippingCity as sCity','tblClientsShipping.fldClientsShippingState as sState','tblClientsShipping.fldClientsShippingZip as sZip','tblClientsShipping.fldClientsShippingEmail as sEmail','tblClientsShipping.fldClientsShippingPhone as sPhone','tblClientsShipping.fldClientsShippingCountry as sCountry',
									 	'tblCart.fldCartOrderDate as order_date', 'tblCart.fldCartOrderNo as order_code', 'tblCart.fldCartQuantity as quantity',
									 	'tblCart.fldCartShippingAddress','tblCart.fldCartClientID', 'tblCart.fldCartLinerDesc', 'tblCart.fldCartLinerSku', 'tblCart.fldCartShippingPrice','tblCart.fldCartShippingCode')
							->first();

		//print_r($cartDisplay);die();
		return $cartDisplay;
	}

	static function displayOrderHistory($client_id) {
		$status = "Paid";

		// $cartDisplay = Client::join('tblCart','tblCart.fldCartClientID','=','tblClient.fldClientID')
		// 				->join('tblProduct','fldProductID','=','fldCartProductID')
		// 				->join('tblClientsShipping','tblClientsShipping.fldClientsShippingClientID','=','tblClient.fldClientID')
		// 					->leftJoin('tblCartCouponCode','tblCart.fldCartOrderNo','=','tblCartCouponCode.fldCartCouponCodeOrderNo')
		// 					->leftJoin('tblCartShippingRate','tblCart.fldCartOrderNo','=','tblCartShippingRate.fldCartShippingRateOrderNo')
		// 					->leftJoin('tblCartTax','tblCart.fldCartOrderNo','=','tblCartTax.fldCartTaxOrderNo')
		// 					->select('tblCartCouponCode.*','tblCartShippingRate.*','tblCartTax.*',
		// 					  	'tblProduct.fldProductSlug as fldProductSlug','tblProduct.fldProductID as product_id','tblCart.fldCartID as cart_id','tblCart.fldCartQuantity as quantity','tblProduct.fldProductSubTitle as product_sub_title',
		// 				   'tblCart.fldCartProductPrice as product_price','tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight',
		// 				   'tblCart.fldCartProductName as product_name','tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_no',
		// 				   'tblCart.fldCartProductOptions as product_options',
		// 				   'tblCart.fldCartImagePrice','tblCart.fldCartFrameInfo','tblCart.fldCartFramePrice',
		// 				   	   'tblCart.fldCartFrameDesc','tblCart.fldCartPaperInfo','tblCart.fldCartMat1Info',
		// 				   'tblCart.fldCartMat2Info','tblCart.fldCartMat3Info','tblCart.fldCartMat1Options',
		// 				   'tblCart.fldCartMat2Options','tblCart.fldCartMat3Options','tblCart.fldCartImageSize',
		// 				   'tblCart.fldCartMatBorderSize','tblClientsShipping.fldClientsShippingAddress','tblClientsShipping.fldClientsShippingAddress1',
		// 				   'tblClientsShipping.fldClientsShippingCity','tblClientsShipping.fldClientsShippingState','tblClientsShipping.fldClientsShippingZip',
		// 				   'tblCart.fldCartShippingAddress', 'tblCart.fldCartLinerDesc', 'tblCart.fldCartLinerSku')
		// 				->where('tblClient.fldClientID','=',$client_id)
		// 				->where('tblCart.fldCartStatus','=',$status)
		// 				->orderBy('fldCartID','DESC')
		// 				->get();

		$cartDisplay = Client::join('tblCart','tblCart.fldCartClientID','=','tblClient.fldClientID')
						->join('tblClientsShipping','tblClientsShipping.fldClientsShippingClientID','=','tblClient.fldClientID')
						->leftJoin('tblCartCouponCode','tblCart.fldCartOrderNo','=','tblCartCouponCode.fldCartCouponCodeOrderNo')
						->leftJoin('tblCartShippingRate','tblCart.fldCartOrderNo','=','tblCartShippingRate.fldCartShippingRateOrderNo')
						->leftJoin('tblCartTax','tblCart.fldCartOrderNo','=','tblCartTax.fldCartTaxOrderNo')
						->select('tblCart.*','tblCartShippingRate.*','tblCartTax.*','tblClientsShipping.*','tblClientsShipping.*','tblCartCouponCode.*')
						->where('tblClient.fldClientID','=',$client_id)
						->where('tblCart.fldCartStatus','=',$status)
						->groupBy('fldCartOrderNo')
						->orderBy('fldCartID','DESC')
						->get();

		return $cartDisplay;

	}

	static function displayOrderHistoryDashboard($client_id) {

		$status = "Paid";

		// $cartDisplay = Client::join('tblCart','tblCart.fldCartClientID','=','tblClient.fldClientID')
		// 					  ->join('tblProduct','fldProductID','=','fldCartProductID')
		// 					  ->join('tblClientsShipping','tblClientsShipping.fldClientsShippingClientID','=','tblClient.fldClientID')
		// 						->leftJoin('tblCartCouponCode','tblCart.fldCartOrderNo','=','tblCartCouponCode.fldCartCouponCodeOrderNo')
		// 						->leftJoin('tblCartShippingRate','tblCart.fldCartOrderNo','=','tblCartShippingRate.fldCartShippingRateOrderNo')
		// 						->leftJoin('tblCartTax','tblCart.fldCartOrderNo','=','tblCartTax.fldCartTaxOrderNo')
		// 					  ->select('tblCartCouponCode.*','tblCartShippingRate.*','tblCartTax.*',
		// 					  	'tblProduct.fldProductSlug as fldProductSlug','tblProduct.fldProductID as product_id','tblCart.fldCartID as cart_id','tblCart.fldCartQuantity as quantity','tblProduct.fldProductSubTitle as product_sub_title',
		// 							   'tblCart.fldCartProductPrice as product_price','tblProduct.fldProductImage as image','tblProduct.fldProductWeight as weight',
		// 							   'tblCart.fldCartProductName as product_name','tblCart.fldCartOrderDate as order_date','tblCart.fldCartOrderNo as order_no',
		// 							   'tblCart.fldCartProductOptions as product_options',
		// 							   'tblCart.fldCartImagePrice','tblCart.fldCartFrameInfo','tblCart.fldCartFramePrice',
		// 				    		   	   'tblCart.fldCartFrameDesc','tblCart.fldCartPaperInfo','tblCart.fldCartMat1Info',
		// 							   'tblCart.fldCartMat2Info','tblCart.fldCartMat3Info','tblCart.fldCartMat1Options',
		// 							   'tblCart.fldCartMat2Options','tblCart.fldCartMat3Options','tblCart.fldCartImageSize',
		// 							   'tblCart.fldCartMatBorderSize','tblClientsShipping.fldClientsShippingAddress','tblClientsShipping.fldClientsShippingAddress1',
		// 							   'tblClientsShipping.fldClientsShippingCity','tblClientsShipping.fldClientsShippingState','tblClientsShipping.fldClientsShippingZip',
		// 						           'tblCart.fldCartShippingAddress')
		// 					  ->where('tblClient.fldClientID','=',$client_id)
		// 					  ->where('tblCart.fldCartStatus','=',$status)
		// 					  ->orderBy('fldCartID','DESC')
		// 					  ->take(6)
		// 					  ->get();

		// $cartDisplay = Client::join('tblCart','tblCart.fldCartClientID','=','tblClient.fldClientID')
		// 				->join('tblClientsShipping','tblClientsShipping.fldClientsShippingClientID','=','tblClient.fldClientID')
		// 				->leftJoin('tblCartCouponCode','tblCart.fldCartOrderNo','=','tblCartCouponCode.fldCartCouponCodeOrderNo')
		// 				->leftJoin('tblCartShippingRate','tblCart.fldCartOrderNo','=','tblCartShippingRate.fldCartShippingRateOrderNo')
		// 				->leftJoin('tblCartTax','tblCart.fldCartOrderNo','=','tblCartTax.fldCartTaxOrderNo')
		// 				->select('tblCart.*','tblCartShippingRate.*','tblCartTax.*','tblClientsShipping.*','tblClientsShipping.*','tblCartCouponCode.*')
		// 				->where('tblClient.fldClientID','=',$client_id)
		// 				->where('tblCart.fldCartStatus','=',$status)
		// 				->groupBy('fldCartOrderNo')
		// 				->orderBy('fldCartID','DESC')
		// 				->take(6)
		// 				->get();


		// Get all Order No by client ID
		// Get all products under Order ID
		// $cartDisplay = self::where('fldCartClientID','=',$client_id)->select('fldCartOrderNo as order_no')->groupBy('fldCartOrderNo')->get();
		$cartDisplay = self::leftJoin('tblCartCouponCode','tblCart.fldCartOrderNo','=','tblCartCouponCode.fldCartCouponCodeOrderNo')
					->leftJoin('tblCartTax','tblCart.fldCartOrderNo','=','tblCartTax.fldCartTaxOrderNo')
					->where('tblCart.fldCartClientID','=',$client_id)
					->select('tblCart.fldCartID','tblCart.fldCartOrderNo', 'tblCart.fldCartShippingAddress', 'tblCart.fldCartOrderDate', 'tblCartTax.fldCartTax', 'tblCartCouponCode.fldCartCouponCodeCouponPrice')
					->groupBy('fldCartOrderNo')
					->orderBy('fldCartID','DESC')
					->get();




		// $subtotal_per_line = $subtotal = 0;
		// foreach ($cartDisplay as $eaCart) {
		// 	$items = self::leftJoin('tblProduct','tblCart.fldCartProductID','=','tblProduct.fldProductID')
		// 			->where('fldCartOrderNo','=',$eaCart->fldCartOrderNo)->get();

		// 	// $cartDisplay->products[$eaCart->order_no] 	= array();
		// 	// $eaCart->products = array();

		// 	$items->name[$eaCart->fldCartOrderNo]  = array();
		// 	$items->slug[$eaCart->fldCartOrderNo]  = array();
		// 	$items->price[$eaCart->fldCartOrderNo] = array();
		// 	$items->image[$eaCart->fldCartOrderNo] = array();

		// 	foreach ($items as $key => $item) {
		// 		echo 'Prod: '.$item->fldCartProductName.'<br>';
		// 		echo 'Img: '.$item->fldProductImage.'<br>';
		// 		echo 'Price: '.$item->fldCartProductPrice.'<br>';
		// 		echo 'Shipping: '.$item->fldCartShippingPrice.'<br>';
		// 		echo 'Discount: '.$eaCart->fldCartCouponCodeCouponPrice.'<br>';
		// 		echo 'Tax: '.$eaCart->fldCartTax.'<br>';
		// 		echo '<hr>';

		// 		// array_push($cartDisplay->products[$eaCart->order_no], $item->fldCartProductName);
		// 		// array_push($eaCart->products, $item->fldCartProductName);

		// 		// array_push($items->name[$eaCart->order_no], $item->fldCartProductName);
		// 		// array_push($items->slug[$eaCart->order_no], $item->fldCartProductSlug);
		// 		// $subtotal_per_row = $item->fldCartProductPrice * $item->fldCartQuantity;
		// 		// $subtotal += $subtotal_per_row;
		// 		// array_push($items->price[$eaCart->order_no], $subtotal_per_line);
		// 		// if($item->fldProductImage) { array_push($items->image[$eaCart->order_no], $item->fldProductImage); }

		// 	}

		// }

		// 	print_r($cartDisplay->products[$eaCart->order_no]);
		// 	die();

		// dd($cartDisplay);
		// die('301');

		/*
		foreach ($cartDisplay as $id => $cart) {
			$orders = Cart::where('fldCartOrderNo','=',$cart->fldCartOrderNo)->get();

			$total_tax 		= $cart->fldCartTax;
			$total_coupon 	= $cart->fldCartCouponCodeCouponPrice;
			$total_shipping = $cart->fldCartShippingRateShippingAmount;

			$products->name[$cart->fldCartID] 	= array();
			$products->price[$cart->fldCartID] 	= array();
			$products->image[$cart->fldCartID] 	= array();
			$products->slug[$cart->fldCartID] 	= array();
			// $products->name 	= array();
			// $products->price 	= array();
			// $products->image 	= array();
			// $products->slug 	= array();
			$subtotal_per_cart = 0;

			foreach ($orders as $key => $item) {
				$product = \App\Models\Product::find($item->fldCartProductID);

				array_push($products->name[$cart->fldCartID], $item->fldCartProductName);
				array_push($products->slug[$cart->fldCartID], $item->fldCartProductSlug);
				$subtotal_per_line = $item->fldCartProductPrice * $item->fldCartQuantity;
				$subtotal_per_cart += $subtotal_per_line;
				array_push($products->price[$cart->fldCartID], $subtotal_per_line);
				array_push($products->image[$cart->fldCartID], $product->fldProductImage);

				// array_push($products->name[$key], $item->fldCartProductName);
				// array_push($products->slug[$key], $item->fldCartProductSlug);
				// $subtotal_per_line = $item->fldCartProductPrice * $item->fldCartQuantity;
				// $subtotal_per_cart += $subtotal_per_line;
				// array_push($products->price[$key], $subtotal_per_line);
				// array_push($products->image[$key], $product->fldProductImage);
			}

			$total_per_cart = $subtotal_per_cart + $total_tax + $total_shipping - $total_coupon;
			$slugs = (count($products->slug[$cart->fldCartID]) > 1)? '': $products->slug[$cart->fldCartID][0];
			$images = (count($products->image[$cart->fldCartID]) > 1)? 'Multiple': $products->image[$cart->fldCartID][0];
			// $slugs = (count($products->slug[$id]) > 1)? '': $products->slug[$id][0];
			// $images = (count($products->image[$id]) > 1)? 'Multiple': $products->image[$id][0];

			// echo '<pre>';
			// print_r($products->name[$cart->fldCartID]);

			// echo '<pre>';
			// print_r($products->price[$cart->fldCartID]);

			// echo '<pre>';
			// print_r($products->image[$cart->fldCartID]);

			// echo 'Sub Total: '.$subtotal_per_cart.'<br>';
			// echo 'Total Tax: '.$total_tax.'<br>';
			// echo 'Discount: '.$total_coupon.'<br>';
			// echo 'Shipping: '.$total_shipping.'<br>';
			// echo 'Total: '.$total_per_cart.'<br>';
			// echo 'Images: '.$images.'<br>';

			$cartDisplay->subtotal_per_cart = $subtotal_per_cart;
			$cartDisplay->total_tax 		= $total_tax;
			$cartDisplay->total_coupon 		= $total_coupon;
			$cartDisplay->total_shipping 	= $total_shipping;
			$cartDisplay->total_per_cart 	= $total_per_cart;
			$cartDisplay->images 			= $images;
			$cartDisplay->slugs 			= $slugs;

			$cartDisplay->order_date		= $cart->fldCartOrderDate;
			$cartDisplay->shipping_address	= $cart->fldCartShippingAddress;
			$cartDisplay->order_number		= $cart->fldCartOrderNo;
			$cartDisplay->products 			= implode(',', $products->name[$cart->fldCartID]);
		}
		*/

		return $cartDisplay;
	}

	static function getFrameAttributes($frame) {
		if($frame != "") {
			$frameInfo = explode(';', $frame);
			if(isset($frameInfo[1])){
				return $frameInfo[1];
			}
			return $frameInfo[0];
		} else {
			return "";
		}
	}

	static function getPaperInfo($paper) {
		$paperInfo = explode(';', $paper);
		if(isset($paperInfo[2])) {
			return $paperInfo[0] . ' - ' . $paperInfo[2];
		} else {
			return $paperInfo[0];
		}
	}

	static function getMatInfo($mat) {
		$matInfo  = explode(';',$mat);

		if(isset($paperInfo[1])) {
			return $matInfo[0] . ' - ' . $matInfo[1];
		} else {
			return $matInfo[0];
		}
	}

	static function getMatOptions($options) {
		$optionInfo = str_replace(';', ' ', $options);
		return $optionInfo;
	}

	static function getMat($orderCode) {
		$orderInfo = self::where('fldCartOrderNo','=',$orderCode)->first();
		$matInfo = "";


		$mat1 = $orderInfo->fldCartMat1Info != "" ? self::getMatInfo($orderInfo->fldCartMat1Info) : "";
		$mat1Option = $orderInfo->fldCartMat1Options != "" ? self::getMatOptions($orderInfo->fldCartMat1Options) : "";
		$mat2 = $orderInfo->fldCartMat2Info != "" ? self::getMatInfo($orderInfo->fldCartMat2Info) : "";
		$mat2Option = $orderInfo->fldCartMat2Options != "" ? self::getMatOptions($orderInfo->fldCartMat2Options) : "";
		$mat3 = $orderInfo->fldCartMat3Info != "" ? self::getMatInfo($orderInfo->fldCartMat3Info) : "";
		$mat3Option = $orderInfo->fldCartMat3Options != "" ? self::getMatOptions($orderInfo->fldCartMat3Options) : "";

		if($mat1 != "") {
			$matInfo = $mat1;
		}

		if($mat1Option != "") {
			$matInfo .= ' - '.$mat1Option;
		}

		if($mat2 != "") {
			$matInfo = ', '.$mat2;
		}

		if($mat1Option != "") {
			$matInfo .= ' - '.$mat2Option;
		}

		if($mat3 != "") {
			$matInfo = ', '.$mat3;
		}

		if($mat3Option != "") {
			$matInfo .= ' - '.$mat3Option;
		}





		return $matInfo;

	}

	static function getImageSize($cartSize) {
		$imageSize = ProductOptions::join('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','tblProductOptions.fldProductOptionsAssetsID')
								->where('fldProductOptionsID','=',$cartSize)
								->first();
		if(empty($imageSize)) {
			return true;
		} else {
			return 	$imageSize->fldOptionsAssetsWidth . ' x ' . $imageSize->fldOptionsAssetsHeight;
		}

	}

	static function getReturnFrameImage($orderCode,$slug,$image) {
		$orderInfo = self::where('fldCartOrderNo','=',$orderCode)->first();

		$matParams = "";
		$frameparams = "";

		if($orderInfo->fldCartMat1Info != "") {
			$mat1 = explode(';', $orderInfo->fldCartMat1Info);
			$matParams .=  "&mat1=".$mat1[0];
		}

		if($orderInfo->fldCartMat2Info != "") {
			$mat2 = explode(';', $orderInfo->fldCartMat2Info);
			$matParams .=  "&mat2=".$mat2[0];
		}

		if($orderInfo->fldCartMat3Info != "") {
			$mat3 = explode(';', $orderInfo->fldCartMat3Info);
			$matParams .=  "&mat3=".$mat3[0];
		}

		if($orderInfo->fldCartMat1Options != "") {
			$mat1Options = explode(';', $orderInfo->fldCartMat1Options);

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

			$matParams .= '&t='.$orderInfo->fldCartMatBorderSize.'&r='.$orderInfo->fldCartMatBorderSize.'&b='.$orderInfo->fldCartMatBorderSize.'&l='.$orderInfo->fldCartMatBorderSize;
		}

		if($orderInfo->fldCartMat2Options != "") {
					$mat2Options = explode(';', $orderInfo->fldCartMat2Options);
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

		if($orderInfo->fldCartMat3Options != "") {
			$mat3Options = explode(';', $orderInfo->fldCartMat3Options);
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
								->where('fldProductOptionsID','=',$orderInfo->fldCartImageSize)
								->first();


		if(empty($imageSize)) {
			$imageSize = OptionsAssets::orderBy('fldOptionsAssetsPosition')->first();
		}

		if($orderInfo->fldCartFrameInfo){
			$frameDESC = explode(';', $orderInfo->fldCartFrameDesc);
			$frameparams = '&sku='.$orderInfo->fldCartFrameInfo.'&frameW='.$frameDESC[0];
		}

		// $imageLink = 'https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl='.url(PRODUCT_IMAGE_PATH.$slug.'/'.SMALL_IMAGE.$image).'&imgHI='.$imageSize->fldOptionsAssetsHeight.'&imgWI='.$imageSize->fldOptionsAssetsWidth.'&maxW=225&maxH=225'.$frameparams.$matParams;
		$imageLink = 'https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl=https://clarkincollection.com/new/'.PRODUCT_IMAGE_PATH.$slug.'/'.SMALL_IMAGE.$image.'&imgHI='.$imageSize->fldOptionsAssetsHeight.'&imgWI='.$imageSize->fldOptionsAssetsWidth.'&maxW=225&maxH=225'.$frameparams.$matParams;

		return $imageLink;
	}
}


?>
