<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Settings;
use App\Models\Shipping;
use App\Models\Cart;
use App\Models\State;
use App\Models\ProductOptions;
use App\Models\Product;
use App\Models\ProductCost;
use App\Models\Tax;
use App\Models\Category;
use App\Models\Pages;
use App\Models\ClientShipping;
use App\Models\ClientBilling;
use App\Models\CartCouponCode;
use App\Models\CartShippingRate;
use App\Models\TempCart;
use App\Models\Google;
use App\Models\Footer;
use App\Models\Payment;
use App\Models\CouponCode;
use App\Models\Client;
use App\Models\BraintreeInformation;
use App\Models\ManagerCommission;
use App\Models\Manager;
use App\Models\ShopOwnerCommission;
use App\Models\ShopOwner;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;
use DB;
// use Request;
use Mail;
use Log;
use SoapClient;

use App\SoapXmlBuilder;

class TempCartController extends BaseController
{

	// public function __construct()
	// {
	// 	require_once "public/payment/braintree/lib/Braintree.php";
	//  	\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
	// 	\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
	// 	\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
	// 	\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);
	// }


  	public function postNew() {


	   $tempCart = new TempCart;
	   $tempCart->fldTempCartProductID = Input::get('product_id');
	   $tempCart->fldTempCartOrderDate = date('Y-m-d');
	   $tempCart->fldTempCartClientID = Input::get('client_id');
	   if(Input::get('client_id') == "") {
		   $tempCart->fldTempCartQuantity = 1;
	   }
	   $tempCart->save();

	   $success=1;
	   return View::make('_front.cart');
   	}


    public function getDelete($id,$client_id) {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$tempCart = TempCart::find($id);

		$tempCart->delete();

		$orderdate = date('Y-m-d');
		$tempCart = TempCart::where('fldTempCartOrderDate','=',$orderdate)->where('fldTempCartClientID','=',$client_id)->get();
	    return View::make('_admin.cart', array('temp_cart' => $tempCart));
	}



	public function checkout() {
		$slug = 'checkout';
		$client_id = Session::has('client_id') ? Session::get('client_id') : "";
		$pages = Pages::where('fldPagesSlug', '=', $slug)->first();
		$cart = TempCart::displayCart();

		if($cart->isEmpty()) {
			// if cart is empty redirect to image galleries
			return redirect()->to('/collection');
		}


		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$shipping = ClientShipping::where('fldClientsShippingClientID','=',$client_id)->first();
		// dd($shipping);
		$billing = ClientBilling::where('fldClientsBillingClientID','=',$client_id)->first();
		$payment = Payment::where('fldPaymentIsActive','=',1)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$settings->site_name = "Checkout";
		$freeshipping=false;$coupon_amount=0;$stateName=isset($billing) ? $billing->fldClientsBillingState :  "";

		$coupon_code =CouponCode::checkCouponCode(Session::get('couponCode'),$cart[0]->subtotal,$stateName);
		$coupon_code = json_decode($coupon_code);
		$tax = "";
		$client= Client::find($client_id);
		/*
		if($client->fldClientBraintreeCustomerID != "") {
			require_once "public/payment/braintree/lib/Braintree.php";
			\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
			\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
			\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
			\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);
			$results = BraintreeInformation::findClient($client->fldClientBraintreeCustomerID);
			print_r($results);die();
		}*/

		$shipping_options = NULL;
		// Generate Shipping Options
		if (!empty($shipping)) {

			$without_shipping_total = '';
			foreach ($cart as $item) {
	            $without_shipping_total = (float)$without_shipping_total + (float)$item->total;
	        }


			// Product cost
			$merchCost = $without_shipping_total;

			$feeCost = 0;
			// Discount
			$discountAmount = number_format($cart[0]->coupon_amount,2);

			// Total
			$totalCost = $without_shipping_total + $feeCost - $discountAmount;
			// echo 'merch: '.$merchCost.'<br>';
			// echo 'fee: '.$feeCost.'<br>';
			// echo 'disc: '.$discountAmount.'<br>';
			// echo 'total: '.$totalCost.'<br>';
			// echo '<hr>';
			// die();

			// Shipping from API
	    	// $wsdl = "https://ifs.graphikservices.com/services/shippingService?wsdl";

	    	// $options = array(
	    	// 	// "userAccess"=>"79FE7017D6ACDEF082F845C766968E0A36DE84953739018C",
	    	// 	"userAccess"=>"0FC64D717788C2310626F5D6A199EA54754DB71051E9D578",
	    	// 	"externalOrder"=>array(
	    	// 		"costData"=> array(
	    	// 			// "discountAmount" => 44.7,
	    	// 			// "feeCost" => 35.95,
	    	// 			// "merchCost" => 142.86,
	    	// 			"discountAmount" => $discountAmount,
	    	// 			"feeCost" => $feeCost,
	    	// 			"merchCost" => $merchCost,
	    	// 			"oversizedShipFeeTotal" => 0,
	    	// 			"promoAmount" => 0,
	    	// 			"retailCost" => 0,
	    	// 			"shippingCost" => 0,
	    	// 			"taxCost" => 0,
	    	// 			// "totalCost" => 134.11
	    	// 			"totalCost" => $totalCost
	    	// 		),
	    	// 		"customer"=>array(
	    	// 			"shippingAddress"=>array(
	    	// 				"activeInd" => 1,
	    	// 				"addressType" => "SHIPPING",
	    	// 				// "city"=>"High Point",
	    	// 				// "company"=>"Graphik Dimensions, Ltd.",
	    	// 				// "country"=>"US",
	    	// 				// "firstName"=>"John",
	    	// 				// "homePhone"=>"3365555555",
	    	// 				// "lastName"=>"Doe",
	    	// 				// "prefix"=>"MR",
	    	// 				// "state"=>"NC",
	    	// 				// "street"=>"2103 Brentwood St.",
	    	// 				// "streetTwo"=>"",
	    	// 				// "zip"=>"27263"
	    	// 				"city"=>$shipping->fldClientsShippingCity,
	    	// 				"company"=>"",
	    	// 				"country"=>$shipping->fldClientsShippingCountry,
	    	// 				"firstName"=>$shipping->fldClientsShippingFirstname,
	    	// 				"homePhone"=>$shipping->fldClientsShippingPhone,
	    	// 				"lastName"=>$shipping->fldClientsShippingLastname,
	    	// 				"prefix"=>"",
	    	// 				"state"=>$shipping->fldClientsShippingState,
	    	// 				"street"=>$shipping->fldClientsShippingAddress,
	    	// 				"streetTwo"=>$shipping->fldClientsShippingAddress1,
	    	// 				"zip"=>$shipping->fldClientsShippingZip
	    	// 			),
	    	// 			"vendorID"=>1233444
	    	// 		),
	    	// 		"externalOrderId"=>"",
	    	// 		"insuranceFee"=>0.00,
	    	// 		"shippingData"=>array(
	    	// 			"discountAmount"=>0.00,
	    	// 			"shippingService"=>"STANDARD"
	    	// 		)
	    	// 	)
	    	// );


			// $graphikAPI = new SoapClient($wsdl, $options);
			// $response = $graphikAPI->__soapCall("getShippingAmoutsByMerchPrice", array($options));
			// // dd($response);
			// // print_r($response);die();
			// // if (is_soap_fault($response)) {
			// if (empty($response)) {
			// 	return false;
			// 	die('Ln212');
			// }

			// $shipping_options = $response;
			// // dd($shipping_options);
			// // return $response;
			// // die("Ln129");
			$shipping_options = NULL;
		}

	    return View::make('home.checkout', compact('pages','menus','category','cart','shipping','billing','payment','settings','google','coupon_code','tax','cart_count','client','shipping_options'));

		// return View::make('home.checkout')->with(array('pages'=>$pages,'menus'=>$menus,
		// 											   'category'=>$category,
		// 											   'cart'=>$cart,
		// 											   'shipping'=>$shipping,
		// 											   'billing'=>$billing,
		// 											   'payment'=>$payment,
		// 											   'settings'=>$settings,
		// 											   'google'=>$google,
		// 											   'coupon_code'=>$coupon_code,
		// 											   'tax'=>$tax,
		// 											   'cart_count'=>$cart_count,'client'=>$client));
	}


	public function shoppingCart() {

		$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		$order_date = date('Y-m-d');

		$pages = Pages::where('fldPagesSlug', '=', 'shopping-cart')->first();


		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();

		$cartDisplay = TempCart::displayCart();
		// print_r($cartDisplay);die();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();

		$settings->site_name = "Shopping Cart";
   		return View::make('home.cart')->with(array('pages'=>$pages, 'menus'=>$menus,'category'=>$category,'cart'=>$cartDisplay,'settings'=>$settings,'google'=>$google,'cart_count'=>$cart_count));
	}



	public function addShoppingCart(Request $request) {
		//dd($request->all());
		

		 //dd($request->get('imageSize'));
		// dd($request->all());
		// print_r($request->all());
		// die('168');
		// Log::debug('Session::has(client_id)');
		// Log::debug(Session::has('client_id') );
		if(isset($request->counter_if))
		{
			Session::flash('error','This product seems to be not yet ready to be purchased.');
			return redirect()->back();
		}

	  	$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		// Log::debug('client_id');
		// Log::debug($client_id);

		$product_id = $request->get('product_id1');
		$product = Product::find($product_id);

		$print_name = $request->get('print_name'); // MARK CHANGES

		
		$productOption = ProductOptions::leftJoin('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','tblProductOptions.fldProductOptionsAssetsID')
					->where('fldProductOptionsProductID','=',$product->fldProductID)
					->where('fldProductOptionsID', '=', $request->get('imageSize'))
					->select('fldProductOptionsPrice','fldProductOptionsID','fldOptionsAssetsWidth','fldOptionsAssetsHeight')
					->first();
		if($productOption) {
			$width = $productOption->fldOptionsAssetsWidth;
			$height = $productOption->fldOptionsAssetsHeight;
		} else {
            //Added by Don Pablo
			if ($request->get('print_id_add_cart') != "10001") {
				$sizelistdata = \App\Models\SizeListModel::where('print_id',$request->get('print_id_add_cart'))->where('id',$request->get('imageSize'))->get();
				if(count($sizelistdata) == 0)
					{
						Session::flash('error','This product seems to be not yet ready to be purchased.');
						return redirect()->back();
					}
				$width = $sizelistdata[0]->width;
				$height = $sizelistdata[0]->height;
			} else {
				Session::flash('error','Missing frame size');
				return Redirect::to('products/details/'.$product->fldProductSlug)->withInput();
			}
		}

		$qty = Input::get('qty');
		$frame_info = Input::get('frame_info');
		$frame_desc = Input::get('frame_desc');
		$frame_width = Input::get('frame_width');
		$frame_border_size = Input::get('frame_border_size');
		$liner_sku 	= Input::get('liner');

		$liner_description = '';
		if ($liner_sku == 'LN1BK') { $liner_description = 'Black Liner 1-1/4"'; }
		elseif ($liner_sku == 'LN1NT') { $liner_description = 'Natural Liner 1-1/4"'; }
		elseif ($liner_sku == 'LN1WT') { $liner_description = 'White Liner 1-1/4"'; }
		elseif ($liner_sku == 'LN2BK') { $liner_description = 'Black Liner 2"'; }
		elseif ($liner_sku == 'LN2NT') { $liner_description = 'Natural Liner 2"'; }
		elseif ($liner_sku == 'LN2WT') { $liner_description = 'White Liner 2"'; }
		elseif ($liner_sku == 'LN3BK') { $liner_description = 'Black Liner 3"'; }
		elseif ($liner_sku == 'LN3NT') { $liner_description = 'Natural Liner 3"'; }
		elseif ($liner_sku == 'LN3WT') { $liner_description = 'White Liner 3"'; }
		$liner_desc = $liner_description;
		$liner_sku = Input::get('liner_color_code');

		$packagePrice = array();
		$total_price = $image_price = $frame_price = $feeTotal = $merchandiseTotal = $promotionTotal = $wholesaleTotal = $discountTotal = 0;
		$total_price = $image_price = $frame_price = $feeTotal = $merchandiseTotal = $promotionTotal = $wholesaleTotal = Input::get('image_price');
		if($total_price > 0){

		}else{
			Session::flash('error','This product seems to be not yet ready to be purchased.');
			return redirect()->back();
		}
		//check if cart alreadty has an item
		$get_the_same_cart_item = TempCart::where('fldTempCartProductID','=', $product_id)
										  ->where('fldTempCartFrameInfo','=',$frame_info)
										  ->where('fldTempCartImageSize', '=', $frame_border_size)
										  ->where('printName', '=', $print_name) // MARK CHANGES
										  ->where('fldTempCartLinerDesc', '=', $liner_description) // MARK CHANGES
										  ->where('fldTempCartClientID', '=', $client_id)->first();
		Log::debug('get_the_same_cart_item');
		Log::debug($get_the_same_cart_item);

		// $a_liner = config('constants.liner');
		// $o_liner = $a_liner[0];
		// Log::debug('o_liner');
		// Log::debug($o_liner);
		// dd($get_the_same_cart_item);
		// dd($request->all());
		//if(count($get_the_same_cart_item) > 0){
		if(!empty($get_the_same_cart_item)){
				$tempcart = TempCart::find($get_the_same_cart_item->fldTempCartID);
				$qty = ($qty == "" || $qty <0) ? $qty=1 : $qty;
				$tempcart->fldTempCartQuantity = $tempcart->fldTempCartQuantity + $qty;
				$tempcart->save();
		}else{


			$paper_info = Input::get('paper_info').';'.Input::get('print_on');
			$finishkit_info = Input::get('finishkit_desc');
			$mat1_info = Input::get('mat1_info');
			$mat2_info = Input::get('mat2_info');
			$mat3_info = Input::get('mat3_info');

			$mat1_options = (Input::has('option1')) ? json_encode(Input::get('option1')) : "";
			$mat2_options = (Input::has('option2')) ? json_encode(array_merge([$request->get('offset2')], $request->get('option2'))) : "";
			$mat3_options = (Input::has('option3')) ? json_encode(array_merge([$request->get('offset3')], $request->get('option3'))) : "";
			list($mats, $mat_options) = ProductOptions::setMatOptions($request);
			// dd($mats);
			$paperSku = explode(';', Input::get('paper_info'));

			// canvas data
			$paperType = $request->get('print_on');
			$wrap_options = $request->get('wrap_options');
			$matType = Input::get('mat_type');
			$borderStyle = $paper_options = "";
			$error = false;


			if($frame_info == "") {
				Session::flash('error',"Please select frame to continue.");
				$error = true;
			}
			/*
			*selecting mat removed as requested
			 else if($matType == 1) {
				if($mat1_info == "") {
					Session::flash('error',"Please select single top mat color.");
					$error = true;
				}
			} else if($matType == 2) {
				if($mat2_info == "") {
					Session::flash('error',"Please select double mat color.");
					$error = true;
				}
			} else if($matType == 3) {
				if($mat3_info == "") {
					Session::flash('error',"Please select triple mat color.");
					$error = true;
				}
			}
			if($error == true) {
				return Redirect::to('products/details/'.$product->fldProductSlug)->withInput();
			}
			if($wrap_options == "GW")
				$borderStyle = $request->get('gw_options');
			else
				$borderStyle = $request->get('mw_options');
			if($paperType == 'canvas')
				$paper_options = json_encode([
					'wrap_options'  => $wrap_options,
					'borderStyle'	=> $borderStyle,
				]);
			else
			*/


			$fldCartImageSize 		= Input::get('imageSize');
			$matborder_whole 		= Input::get('matborder_whole');
			$matborder_fractions 	= Input::get('matborder_fractions');
			$mats_width 			= $matborder_whole + $matborder_fractions;
			$shipping_proc_fee 		= Input::get('shipprocfee');
			$graphik_cost 			= Input::get('defaultcost');
			$frame_sequence			= Input::get('frame_sequence');

			// REQUEST AGAIN THE PACKAGE PRICE TO PREVENT MARK-UP CHANGED MANUALLY
			/*
			*remove api
			$xmlbld = new SoapXmlBuilder;
			$xmlbld->setImageElem($width, $height, $product->fldProductName, url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage), $borderStyle);
			if(Input::has('paper_info'))
	    		$xmlbld->setPaperElem($paperSku[0], $paperType, $wrap_options);
	    	else
	    		$xmlbld->setPaperElem(Input::get('photo_paper'), $paperType, $wrap_options);
	    	if($frame_info){
				$xmlbld->setFrameElem($frame_info);
			}
			if($mats) {
				$xmlbld->setMatElem($mats, $mats_width, $mat_options);
			}
			if($request->has('finishkit')) {
				$xmlbld->setFinishElem($request->get('finishkit'));
			}
			// dd($xmlbld->buildBody('getProductGroupPrice', 'pricingGroupRequest'));
			$packagePrice = $xmlbld->curlExec('getProductGroupPrice', 'pricingGroupRequest');
			//print_r($packagePrice);die();
			if(isset($packagePrice->soapBody)){
				if($packagePrice->soapBody->soapFault->faultstring != "") {
					Session::flash('error',"There is an error in frame options. Please try again.");
					return Redirect::to('products/details/'.$product->fldProductSlug)->withInput();
				}
			}
			//$packagePrice = json_decode(json_encode($packagePrice['PricedProductPackage']));
			if(count($packagePrice) > 0) {
			   	$frame_price 		= ($frame_info) ? $packagePrice->frame->priceData->markUpPrice : 0;
			   	$feeTotal 			= $packagePrice->packagePriceData->feeTotal;
			   	$merchandiseTotal 	= $packagePrice->packagePriceData->merchandiseTotal;
			   	$promotionTotal 	= $packagePrice->packagePriceData->promotionTotal;
			   	$wholesaleTotal 	= $packagePrice->packagePriceData->wholesaleTotal;
			   	$discountTotal 		= $packagePrice->packagePriceData->discountTotal;
			   	$image_price  		= $image_price_temp = 0;
			   	if(isset($productOption->fldProductOptionsPrice)){
			   		$image_price_temp  		= floatval($productOption->fldProductOptionsPrice);
			   	}
			   	$image_price = number_format($image_price_temp,2);
				$total_price		= $image_price + $discountTotal;
			}*/

			//ROI
			if($request->print_fee){
                $total_price = $total_price + $request->print_fee;
            }
            //ROI

			$order_date = date('Y-m-d');

			// $cart = TempCart::where('fldTempCartProductID','=',$product_id)
			// 					->where('fldTempCartClientID','=',$client_id)
			// 					->where('fldTempCartOrderDate','=',$order_date)
			// 					->first();
			// removed checking cart
			// always new because of a lot of options
			// if(empty($cart)) {
			$tempcart = new TempCart;
			$tempcart->fldTempCartClientID 		= $client_id;
			$tempcart->fldTempCartQuantity 		= $qty;
			$tempcart->fldTempCartProductID 	= $product_id;

			$products = Product::where('fldProductID','=',$product_id)->first();
			$tempcart->fldTempCartProductName 	= $products->fldProductName;

			$tempcart->fldTempCartProductPrice 	= $total_price;
			// $tempcart->fldTempCartShippingPrice	= $shipping_proc_fee;
			$tempcart->fldTempCartOrderDate 	= $order_date;
			$tempcart->fldTempCartImagePrice 	= $image_price;
			// $tempcart->fldTempCartLinerDesc 	= $o_liner['title'];
			// $tempcart->fldTempCartLinerSku 		= $o_liner['sku'];
			$tempcart->fldTempCartLinerDesc 	= $liner_desc;
			$tempcart->fldTempCartLinerSku 		= $liner_sku;
			$tempcart->fldTempCartFrameInfo 	= $frame_info;
			$tempcart->fldTempCartFramePrice 	= $frame_price;
			$tempcart->fldTempCartFrameDesc 	= $frame_desc;
			$tempcart->fldTempCartPaperInfo 	= $paper_info;
			$tempcart->fldTempCartPaperOptions 	= $paper_options;
			$tempcart->fldTempCartFinishkitInfo = $finishkit_info;
			$tempcart->fldTempCartMat1Info 		= $mat1_info;
			$tempcart->fldTempCartMat2Info 		= $mat2_info;
			$tempcart->fldTempCartMat3Info 		= $mat3_info;
			$tempcart->fldTempCartMat1Options 	= $mat1_options;
			$tempcart->fldTempCartMat2Options 	= $mat2_options;
			$tempcart->fldTempCartMat3Options 	= $mat3_options;
			$tempcart->fldTempCartImageSize 	= $frame_border_size;
			//$tempcart->fldTempCartMatBorderSize = $matborder_whole + $matborder_fractions;
			$tempcart->fldTempCartMatBorderSize = $frame_width;
			// graphika amounts
			$tempcart->feeTotal 		= $feeTotal;
			$tempcart->merchandiseTotal = $merchandiseTotal;
			$tempcart->promotionTotal 	= $promotionTotal;
			$tempcart->wholesaleTotal 	= $wholesaleTotal;
			$tempcart->discountTotal 	= $discountTotal;
			$tempcart->frame_sequence 	= $frame_sequence;

			if ($frame_info=='') { // PRINT ONLY
				// fldTempCartProductID and frame_sequence
				$graphik = ProductCost::where('product_id','=',$product_id)->where('sequence','=',$frame_sequence)->first();
				// dd($graphik);
				// $graphik_cost = $graphik->framelow_cost - 125;
				$graphik_cost = $graphik->framelow_cost;
			}
			$tempcart->graphik_cost 	= $graphik_cost;

			$tempcart->printTotal 	= ($request->print_fee) ? $request->print_fee : '';
			$tempcart->printName	= ($request->print_name) ? $request->print_name : '';
			$tempcart->save();
			Log::debug($tempcart);
		}

		Session::forget('couponSource');
		Session::forget('couponSourceID');
		Session::forget('couponCode');
		Session::forget('couponAmount');

		if(Input::get('checkout')) {
			if(Session::has('client_id')) {
				return Redirect::to('checkout');
			} else {
				return Redirect::to('login');
			}
		} else if(Input::get('continue')){
			$category = Category::orderBy('fldCategoryPosition')->first();
			return Redirect::to('products/display/'.$category->fldCategorySlug);
		} else {
			return Redirect::to('shopping-cart');
		}
	}


	public function addCart($product_id,$qty,$options="") {
		$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();

		// $qty = 1;
		if($options != "") {
			$options = substr($options,0,strlen($options)-1);
		}

	   	$order_date = date('Y-m-d');
 	   	$cart = TempCart::where('fldTempCartProductID','=',$product_id)
 	   					->where('fldTempCartClientID','=',$client_id)
 	   					->where('fldTempCartOrderDate','=',$order_date)
 	   					->first();

		if(empty($cart)) {
			$tempcart = new TempCart;
			$tempcart->fldTempCartClientID = $client_id;
			$tempcart->fldTempCartQuantity = $qty;
			$tempcart->fldTempCartProductID = $product_id;
			$tempcart->fldTempCartProductOptions = $options;
			$products = Product::where('fldProductID','=',$product_id)->first();
			$tempcart->fldTempCartProductName = $products->fldProductName;
			$tempcart->fldTempCartProductPrice = $products->fldProductPrice;

			$tempcart->fldTempCartOrderDate = $order_date;
		} else {
			$tempcart = TempCart::find($cart->fldTempCartID);
			$qty = ($qty == "" || $qty <0) ? $qty=1 : $qty;
			$tempcart->fldTempCartQuantity = $cart->fldTempCartQuantity + $qty;
		}

		$tempcart->save();

		$cart_count = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)->count();

		return $cart_count;
	}

	public function updateShoppingCart() {
		$data = Input::all();

		if(isset($data['continue'])) {
			//if continue shopping is click in shopping cart
			$category = Category::where('fldCategoryMainID','!=',0)->orderBy('fldCategoryPosition')->first();
			return Redirect::to('products/display/'.$category->fldCategorySlug);

		} else {

			//if update button is click in shopping cart
			$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
			$order_date = date('Y-m-d');

			 $cartID = Input::get('cartId');
			 foreach(Input::get('qty') as $qty)
			 {
				if($qty == 0){$qty=1;}
				//echo "<pre>";print_r($cartID);exit;
				//list ($key,$cartid) = each ($cartID);
				foreach($cartID as $key=>$cartid){
					$tempcart = TempCart::find($cartid);
					$tempcart->fldTempCartQuantity = $qty;
					$tempcart->save();
				}

			 }

			if(isset($data['checkout'])) {

				if(Session::has('client_id')) {
					return Redirect::to('checkout');
				} else {
					return Redirect::to('login');
				}
			} else {
				Session::forget('couponSource');
				Session::forget('couponSourceID');
				Session::forget('couponCode');
				Session::forget('couponAmount');

				return Redirect::to('shopping-cart')->with(array('message'=>'Success'));
			}
		}

	}


	public function deleteShoppingCart($id) {
		$cart = TempCart::find($id);
		$cart->delete();

		Session::forget('couponSource');
		Session::forget('couponSourceID');
		Session::forget('couponCode');
		Session::forget('couponAmount');

		return Redirect::to('shopping-cart');
	}

	public function addShoppingCartByProductId($product_id) {
		$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();

		$order_date = date('Y-m-d');
 	    $cart = TempCart::where('fldTempCartProductID','=',$product_id)
 	    				->where('fldTempCartClientID','=',$client_id)
 	    				->where('fldTempCartOrderDate','=',$order_date)
 	    				->first();

		if(empty($cart)) {
			$tempcart = new TempCart;
			$tempcart->fldTempCartClientID = $client_id;
			$tempcart->fldTempCartQuantity = 1;
			$tempcart->fldTempCartProductID = $product_id;

			$products = Product::where('fldProductID','=',$product_id)->first();
			$tempcart->fldTempCartProductName = $products->fldProductName;
			$tempcart->fldTempCartProductPrice = $products->fldProductPrice;

			$tempcart->fldTempCartOrderDate = $order_date;
		} else {
			$tempcart = TempCart::find($cart->fldTempCartID);
			$tempcart->fldTempCartQuantity = $cart->fldTempCartQuantity + 1;
		}

		$tempcart->save();

		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('position')->get();

		$cartDisplay = TempCart::leftJoin('tblProduct','tblTempCart.fldTempCartProductID','=','tblProduct.fldProductID')
						->where('fldTempCartClientID','=',$client_id)
						->where('fldTempCartOrderDate','=',$order_date)
						->select('tblProduct.id as fldProductID','tblTempCart.fldTempCartID as temp_cart_id','tblTempCart.fldTempCartQuantity as quantity',
								 'tblTempCart.fldTempCartProductPrice as product_price','tblProduct.fldProductPrice as image','tblTempCart.fldTempCartProductName as product_name','tblTempCart.fldTempCartOrderDate as order_date')
						->get();

   		return Redirect::to('shopping-cart');
	}

	function displayAuthorize() {
		return View::make('home.payment_authorize');
	}



	public function payment() {

		$data = Input::all();


		$sessions = session()->all();
		$class_client = new Client;

		if(Session::has('client_id')){ // Logged In User
			$client_id = Session::get('client_id');
		}else{ // Guest Checkout
			// Create Client account but tag as Guest
			$client_id = $this->get_create_guest(0,$data);
			Session::put('client_id', $client_id);

			// Update cart
			$temp_client_id = Session::getId();
			$tempcart = TempCart::where('fldTempCartClientID','=',$temp_client_id)->update(array('fldTempCartClientID' => $client_id));
		}

		$clientInfo = $class_client->find($client_id);

		// $order_code = $client_id .'-'.date('Ymd').'-'.rand(1,400);
		$order_code = $client_id .date('Ymd').rand(1,400);
		$temp_cart_class = new TempCart;
		$temp_cart = $temp_cart_class->displayCart();
        Log::debug('---------temp_cart--------------');
        Log::debug($temp_cart);
        Log::debug('---------temp_cart--------------');

		// Authorize.net - START
		$subtotal_amount = $tax_amount = $tax_percent = $grandtotal = $coupon_discount = $discount_formula = $tax_total = $total_quantity = 0;
		$sales_manager_commission_total = $shop_owner_commission_total = $total_shipping = $total_graphik_cost = $base_amount_commission = 0;

		// echo '<hr>';
		// echo '<pre>';
		// print_r($temp_cart);


		//dd($temp_cart);
		foreach ($temp_cart as $ea) {
			//echo 'graphik cost est: '.$ea->graphik_cost.'<br>';
			 //$total_shipping += ($ea->fldTempCartShippingPrice * $ea->quantity);

			 $num1 = $ea->graphik_cost;
				$int1 = (int)$num1;
				$float1 = (float)$num1;

			$num2 = $ea->quantity;
				$int2 = (int)$num2;
				$float2 = (float)$num2;

			//$total_graphik_cost += ($ea->graphik_cost * $ea->quantity);
			$total_graphik_cost += ($float1 * $float2);


		}


		if(isset($temp_cart[0]['grandtotal'])){
			$grandtotal	= $discount_formula = $temp_cart[0]['grandtotal'];
			// $grandtotal	= $discount_formula = $subtotal_amount = $temp_cart[0]['subtotal'];
			$subtotal_amount = $temp_cart[0]['subtotal'];
			// grandtotal - removed the default 10$ discount when user uses a discount code

			if(isset($temp_cart[0]['coupon_amount'])){
				$coupon_discount = $temp_cart[0]['coupon_amount'];
			}
		}

		$firstName 			= $data['card_firstname'];
		$lastName 			= $data['card_lastname'];
		$companyName 		= $data['company'];
		$email 				= $data['email'];
		$phone				= $data['phone']; //ok

		// $card_no 			= $data['card_no1'] .$data['card_no2'] . $data['card_no3'] . $data['card_no4'];
		$card_no 			= trim($data['card_number']);
		$creditCardNumber 	= $card_no;
		$expDateMonth 		= $data['card_month'];
		$padDateMonth 		= str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
		$expDateYear 		= $data['card_year'];
		$cvv2Number 		= $data['card_cvv'];

		$address1 			= $data['address']; //ok
		if(isset($data['address1'])) {
			$address2 = $data['address1'];
		}
		$city 				= $data['city']; //ok
		$state 				= $data['state']; //ok
		$zip 				= $data['zip']; //ok
		$country 			= $data['country']; //ok

		// REMOVED Shipping Amount since its included in the product price already and it is saved on tblTempCart and will be copied over to tblCart
		// $shipping_rate_val 	= explode(';', $data['shipping_rate_val']);
		// $shipping_amount 	= $shipping_rate_val[1];
		// $shipping_amount 	= $temp_cart[0]['fldTempCartShippingPrice'];
		// $shipping_amount 	= $total_shipping;
		$shipping_amount 	= $data['shipping_amount'];

        Log::debug('---------shipping_amount--------------');
        Log::debug($shipping_amount);
		// $tax_percent 	= State::getStateTax_percent($state,$grandtotal);
		// $tax_amount 	= $grandtotal * $tax_percent;
        // Log::debug('---------tax_percent--------------');
        // Log::debug($tax_percent);
        // Log::debug('---------tax_amount--------------');
        // Log::debug($tax_amount);
        Log::debug('---------grandtotal--------------');
        Log::debug($grandtotal);
        Log::debug('---------discount_formula--------------');
        Log::debug($discount_formula);

        // $tax_total = $discount_formula 	* ($tax_percent/100);
        $tax_total = $data['tax'];
        // Log::debug('---------tax_total P * (1 - d/100) * t/100--------------');
        Log::debug('---------tax_total--------------');
        Log::debug($tax_total);

        // $sales_manager_commission_total = 0.10 * $discount_formula;
        // $sales_manager_commission_total = ($discount_formula - $shipping_amount - $tax_total) * 0.10;
        // Log::debug('---------sales_manager_commission_total 0.10 * P * (1 - d/100)--------------');
        // $sales_manager_commission_total = ($discount_formula - $shipping_amount) * 0.10;
        // $sales_manager_commission_total = $discount_formula * 0.10;
        $sales_manager_commission_total = $discount_formula * 0.08;
        Log::debug('---------sales_manager_commission_total--------------');
        Log::debug($sales_manager_commission_total);

        Log::debug('---------total_graphik_cost--------------');
        Log::debug($total_graphik_cost);

        // $shop_owner_commission_total = 0.50 * $discount_formula;
        // $shop_owner_commission_total = ($discount_formula - $shipping_amount - $tax_total) * 0.50;
        // Log::debug('---------shop_owner_commission_total 0.10 * P * (1 - d/100)--------------');
        // $shop_owner_commission_total = ($discount_formula - $shipping_amount) * 0.50;
        // $shop_owner_commission_total = ($discount_formula - $shipping_amount) * 0.47;
        // $shop_owner_commission_total 	= $discount_formula * 0.47;
        // $shop_owner_commission_total 	= $discount_formula * 0.45;
        $shop_owner_commission_total = ($discount_formula - $total_graphik_cost) * 0.50;
        Log::debug('---------shop_owner_commission_total--------------');
        Log::debug($shop_owner_commission_total);

		$charge_amount_orig 			= (float)$discount_formula + (float)$tax_total +(float) $shipping_amount;
        // Log::debug('---------Grand Total Price = P * (1 - d/100) + Tax total + s --------------');
		// $charge_amount_orig 		= $discount_formula + $tax_total;
		$charge_amount 					= round($charge_amount_orig,2);
        Log::debug('---------charge_amount--------------');
        Log::debug($charge_amount);

		$currencyCode 		= "USD"; //ok

		// $myArray = array([
		// 	'shipping_amount' => $shipping_amount,
		// 	'grandtotal'	=> $grandtotal,
		// 	'discount_formula' => $discount_formula,
		// 	'tax_total' => $tax_total,
		// 	'sales_manager_commission_total' => $sales_manager_commission_total,
		// 	'total_graphik_cost' => $total_graphik_cost,
		// 	'shop_owner_commission_total'	=> 	$shop_owner_commission_total,
		// 	'charge_amount_orig'	=> $charge_amount_orig,
		// 	'charge_amount'	=> $charge_amount,
		// 	'currencyCode'	=> $currencyCode
		// ]);
		// dd($myArray);
		// echo '<hr>';
		// echo 'Product Cost: '.$subtotal_amount.'<br>';
		// echo '20% Discount: '.$coupon_discount.'<br>';
		// echo 'Shipping: '.$shipping_amount.'<br>';
		// echo 'Tax: '.$tax_total.'<br>';
		// echo 'Charged: '.$charge_amount.'<br>';
		// echo 'Base Cost for Sales Commission: '.$discount_formula.'<br>';
		// echo 'Sales Manager Commission: '.$sales_manager_commission_total.'<br>';
		// echo 'Base Cost for Shop Owner Commission: '.($discount_formula - $total_graphik_cost).'<br>';
		// echo 'Shop Owner Commission: '.$shop_owner_commission_total.'<br>';
		// die('Ln695');

        ////////////////////////////////////////////////// -- Authorize.net Start
        require('payment/authorizenet/recurring/config.inc.php');
        require('payment/authorizenet/recurring/AuthnetXML.class.php');

        // Create Customer / Buyer Profile
        // Pay Web admin full amount
        // if shop owner code is used - pay commission from web admin to shop owner
        // if manager code is used - pay commission from admin to manager

        ////////////////////////////////////////////////// -- Authorize.net Create Customer Profile
        $customer_profile = array(
                'profile' => array(
                    // 'merchantCustomerId' => '123',
                    'description' => 'Clarkin Customer: '.$firstName.' '.$lastName.'',
                    'email' => $email,
                    'paymentProfiles' => array(
                        'billTo' => array(
                            'firstName' => $firstName,
                            'lastName' => $lastName,
                            'company' => $companyName,
                            'address' => $address1,
                            'city' => $city,
                            'state' => $state,
                            'zip' => $zip,
                            'country' => 'US',
                            'phoneNumber' => $phone,
                            ),
                        'payment' => array(
                            'creditCard' => array(
                                'cardNumber' => $creditCardNumber,
                                'expirationDate' => $padDateMonth.'-'.$expDateYear, // 2020-08
                                'cardCode' => $cvv2Number,
                                ),
                            ),
                        ),
                    )
                );

        $xml_profile = new \AuthnetXML(AUTHNET_LOGIN, AUTHNET_TRANSKEY, \AuthnetXML::USE_DEVELOPMENT_SERVER);
        //$xml_profile = new \AuthnetXML(AUTHNET_LOGIN, AUTHNET_TRANSKEY, \AuthnetXML::USE_PRODUCTION_SERVER);
        $refId = date('ymdhis') . rand(1000,9999);
        $xml_profile->createCustomerProfileRequest($customer_profile);

        Log::debug('---------xml_profile Ln704 --------------');
        Log::debug($xml_profile);
        Log::debug('---------xml_profile--------------');

        if ($xml_profile->messages->message->code == 'I00001') { // Successful

            $customerProfileID = $xml_profile->customerProfileId; // Customer Profile ID
            $customerPaymentProfileID = $xml_profile->customerPaymentProfileIdList->numericString; // Customer Payment Profile ID

            // Update Customer Profile
            $customer_profile_update = array(
                    'profile' => array(
                        'merchantCustomerId' => $client_id,
                        'description' => Session::get('company_name'),
                        'email' => Session::get('company_email'),
                        'customerProfileId' => $customerProfileID,
                        )
                    );

             $xml_profile_update = new \AuthnetXML(AUTHNET_LOGIN, AUTHNET_TRANSKEY, \AuthnetXML::USE_DEVELOPMENT_SERVER);
            //$xml_profile_update = new \AuthnetXML(AUTHNET_LOGIN, AUTHNET_TRANSKEY, \AuthnetXML::USE_PRODUCTION_SERVER);
            // $refId = date('ymdhis') . rand(1000,9999);
            $xml_profile_update->updateCustomerProfileRequest($customer_profile_update);

            $clientInfo->fldClientAuthProfileID = $customerProfileID;
            $clientInfo->fldClientAuthPaymentID = $customerPaymentProfileID;
            $clientInfo->save();

        } else {

			$error_custprofile = "ERROR in creating customer profile for payment.<br>";
			$error_custprofile .= ucfirst($xml_profile->messages->message->text);

            Session::flash('flash', Array('alert' => 'danger', 'msg' => $error_custprofile));
            return back()->withInput();
            // return Redirect::to('/checkout');
        }


        ////////////////////////////////////////////////// -- Authorize.net One Time Payment
        // $charge_amount = '1.01';
        $one_time_charge = array(
                'refId' => $refId, // Must be Unique / optional
                'transaction' => array(
                    'profileTransAuthCapture' => array(
                        'amount' => $charge_amount,
                        'lineItems' => array(
                            'itemId' => 'Order: '.$order_code,
                            'name' => 'Image Galleries',
                            'description' => 'Clarkin Purchase $'.$charge_amount,
                            'quantity' => '1',
                            'unitPrice' => $charge_amount,
                            // 'taxable' => 'true',
                            ),
                        'customerProfileId' => $customerProfileID, // '1810567088' sample
                        'customerPaymentProfileId' => $customerPaymentProfileID, // sample '1805262337'
                        // 'customerShippingAddressId' => '',
                        'order' => array(
                            'invoiceNumber' => $refId,
                            'description' => 'Clarkin Purchase ('.$firstName.' '.$lastName.')',
                            // 'purchaseOrderNumber' => 'PO123',
                            ),
                        // 'taxExempt' => 'false',
                        'recurringBilling' => 'false',
                        // 'cardCode' => '000',
                        // 'splitTenderId' => '',
                    )
                )
            );

        Log::debug('---------one_time_charge Authorize --------------');
        Log::debug($one_time_charge);
        Log::debug('---------one_time_charge--------------');

        $xml_charge = new \AuthnetXML(AUTHNET_LOGIN, AUTHNET_TRANSKEY, \AuthnetXML::USE_DEVELOPMENT_SERVER);
        //$xml_charge = new \AuthnetXML(AUTHNET_LOGIN, AUTHNET_TRANSKEY, \AuthnetXML::USE_PRODUCTION_SERVER);
        $refId = date('ymdhis') . rand(1000,9999);
        $xml_charge->createCustomerProfileTransactionRequest($one_time_charge); // authorizeAndCapture

        Log::debug('---------xml_charge->messages->message--------------');
        Log::debug($xml_charge);
        Log::debug('---------xml_charge->messages->message--------------');

        if ($xml_charge->messages->message->code == 'I00001') {
            // echo '<br><br>------------------<br';
            // print_r($xml_charge->directResponse);

			$direct_response = $xml_charge->directResponse;
			$response = explode(',', $direct_response);

            $transactionID 	= $response[4]; // Payment Transaction ID
            $authCode 		= $response[6]; // Authorization Code

            $invoiceNumber 	= $refId;

            $success = 1;

        } else {

			$error_payment1 = "Error in processing payment.<br>";
			$error_payment1 .= ucfirst($xml_charge->messages->message->text);

            Session::flash('flash', Array('alert' => 'danger', 'msg' => $error_payment1));
            return back()->withInput();
        }


		$shipping = ClientShipping::where('fldClientsShippingClientID','=',$client_id)->first();
		$billing = ClientBilling::where('fldClientsBillingClientID','=',$client_id)->first();

		if(empty($shipping)) {
			$shipping = new ClientShipping;
			$shipping->fldClientsShippingClientID = $client_id;
		}

		//save shipping information
		$shipping->fldClientsShippingFirstname = Input::get('shipping_firstname');
		$shipping->fldClientsShippingLastname = Input::get('shipping_lastname');
		$shipping->fldClientsShippingAddress = Input::get('shipping_address');
		$shipping->fldClientsShippingAddress1 = Input::get('shipping_address1');
		$shipping->fldClientsShippingCity = Input::get('shipping_city');
		$shipping->fldClientsShippingState = Input::get('shipping_state');
		$shipping->fldClientsShippingCountry = Input::get('shipping_country');
		$shipping->fldClientsShippingZip = Input::get('shipping_zip');
		$shipping->fldClientsShippingPhone = Input::get('shipping_phone');
		$shipping->fldClientsShippingEmail = Input::get('shipping_email');
		$shipping->save();


		if(empty($billing)) {
			$billing = new ClientBilling;
			$billing->fldClientsBillingClientID = $client_id;
		}

		//save billing information
		$billing->fldClientsBillingFirstname = Input::get('firstname');
		$billing->fldClientsBillingLastname = Input::get('lastname');
		$billing->fldClientsBillingAddress = Input::get('address');
		$billing->fldClientsBillingAddress1 = Input::get('address1');
		$billing->fldClientsBillingCity = Input::get('city');
		$billing->fldClientsBillingState = Input::get('state');
		$billing->fldClientsBillingCountry = Input::get('country');
		$billing->fldClientsBillingZip = Input::get('zip');
		$billing->fldClientsBillingPhone = Input::get('phone');
		$billing->fldClientsBillingEmail = Input::get('email');
		$billing->fldClientsBillingCompany = Input::get('company');
		$billing->save();

		$tax = Input::get('tax');
		$coupon_price = Input::get('coupon_price');
		$coupon_code = Input::get('coupon_code');

		//save tax
		if($tax != "") {
			$taxSave = new Tax;
			$taxSave->fldCartTaxOrderNo = $order_code;
			$taxSave->fldCartTax = $tax;
			$taxSave->save();
		}

		//save coupon code
		if($coupon_code != "") {
			$CouponCode = new CartCouponCode;
			$CouponCode->fldCartCouponCodeOrderNo = $order_code;
			$CouponCode->fldCartCouponCodeCouponCode = $coupon_code;
			$CouponCode->fldCartCouponCodeCouponPrice = $coupon_price;
			$CouponCode->save();
		}

		// // save shipping rate
		//  if(Input::get('freeshipping')=="no" || Input::get('freeshipping')=="") {
		// 	$shippingrate = explode(";",Input::get('shipping_rate_val'));
		// 	$shippingRateVal = new CartShippingRate;
		// 	$shippingRateVal->fldCartShippingRateOrderNo = $order_code;
		// 	$shippingRateVal->fldCartShippingRateShippingName = $shippingrate[0];
		// 	$shippingRateVal->fldCartShippingRateShippingAmount = $shippingrate[1];
		// 	$shippingRateVal->save();
		// }

		// $amount = number_format(Input::get('total'),2);

		// // pay through braintree account
		// $results = BraintreeInformation::clientPayment($clientInfo->fldClientBraintreeCustomerID, $amount);

		if($success <> 1) {
			$message = 'Error'; // $results->message;
			// Session::flash('braintree-error',"Payment Information: ".$message);
			session()->flash('flash', ['alert' => "danger", 'msg' => $message]);
			return back()->withInput();
			// return Redirect::to('/checkout');
		} else {

			// // CREATE ORDER TO GRAPHIK API
			// $createOrder = new SoapXmlBuilder;
			// $gd_order = $createOrder->gdCreateOrder($data, $order_code);

	        // // Override API
	        $gd_order = [];
	        $gd_order['code'] = 'PLACED';
	        $gd_order['externalId'] = '99999999';
	        $gd_order['message'] = 'Order Processed';
	        $gd_order['orderId'] = '99999999';

	        // Log::debug('TempCartController - 927');
	        // Log::debug($gd_order);
	        // Log::debug('929 <hr>');

			// SAMPLE RESPONSE FROM GRAPHIK API
			// array:4 [▼
			//   "code" => "PLACED"
			//   "externalId" => "10301840"
			//   "message" => "Order Processed"
			//   "orderId" => "10301840"
			// ]

	   //      if (empty($gd_order['code'])) {
				// $message = 'Error'; // $results->message;
				// session()->flash('flash', ['alert' => "danger", 'msg' => 'Note: Graphik API Error. Please contact web administrator.']);
				// return back()->withInput();
	   //      }


			if (Session::has('couponSourceID')) {
				$shop_owner_manager_id = 0;
				if(Session::get('couponSource') == 'Shop') {
					$class_shop_owner = new ShopOwner;
				 	$shopOwner = $class_shop_owner->find(Session::get('couponSourceID'));
				 	$shopOwnerCommission = ShopOwnerCommission::calculateCommission($shop_owner_commission_total,$shopOwner,$clientInfo,$order_code,1);
				 	Log::debug('shopOwner');
				 	Log::debug($shopOwner);
				 	if( $shopOwner->fldShopOwnerManagerID != null && $shopOwner->fldShopOwnerManagerID != '' ){
				 		$shop_owner_manager_id =  $shopOwner->fldShopOwnerManagerID;
				 	}
				 	Log::debug('shop_owner_manager_id');
				 	Log::debug($shop_owner_manager_id);
					//dd($shopOwnerCommission);
				}
				if( ( Session::get('couponSource') == 'Manager' ) || ( $shop_owner_manager_id > 0 )) {
				 	//compute manager comissions
				 	// $this_manager_id = Session::get('couponSource');
				 	$this_manager_id = Session::get('couponSourceID');
				 	if($shop_owner_manager_id > 0){
				 		$this_manager_id = $shop_owner_manager_id;
				 	}

				 	Log::debug('this_manager_id');
				 	Log::debug($this_manager_id);
				 	$manager = Manager::find($this_manager_id);
				 	$managerCommission = ManagerCommission::calculateCommission($sales_manager_commission_total,$manager,$clientInfo,$order_code,1);
					//dd($managerCommission);
				}
			}

			// after successful payment transfer temp cart to cart
			//save tempcart to cart
			$this->__transferToCart($temp_cart, $order_code, $gd_order,$client_id);

			/*
			if($clientInfo->fldClientInviteCode != "" && $clientInfo->fldClientInviteCodeType == 1) {
			 	//compute manager comissions
			 	$manager = Manager::find($clientInfo->fldClientInviteCodeID);
			 	$managerCommission = ManagerCommission::calculateCommission($amount,$manager,$clientInfo,$order_code,1);
			} else if($clientInfo->fldClientInviteCode != "" && $clientInfo->fldClientInviteCodeType == 3) {
			 	$shopOwner = ShopOwner::find($clientInfo->fldClientInviteCodeID);
			 	$shopOwnerCommission = ShopOwnerCommission::calculateCommission($amount,$shopOwner,$clientInfo,$order_code,1);
			}
			*/
			// send email to client and admin
			$this->__paymentSendMail($order_code);

			$status = "Paid";
			Session::forget('couponCode');

			$cart = Cart::where('fldCartOrderNo','=',$order_code)->get();
			foreach($cart as $carts) {
				$carts->fldCartStatus 	= $status;
				$carts->fldCartTransID 	= $transactionID;
				$carts->fldCartAuthID 	= $authCode;
				$carts->save();
			}

			return Redirect::to('thankyou/payment');
		}
	}


	public function __transferToCart($cart = [], $order_code, $gd_order,$client_id) {
		$request = new Request;
		$date = date("Y-m-d");
		$status = 'New';
		//$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();

		foreach($cart as $carts) {
			$cartSave = new Cart;

			$cartSave->fldCartProductID = $carts->product_id;
			$cartSave->fldCartClientID = $client_id;
			$cartSave->fldCartProductName = $carts->fldTempCartProductName;
			$cartSave->fldCartProductPrice = $carts->product_price;
			$cartSave->fldCartProductOptions = $carts->fldTempCartProductOptions;
			// $cartSave->fldCartShippingPrice = $carts->fldTempCartShippingPrice;
			$cartSave->fldCartShippingPrice = Input::get('shipping_amount'); // Shipping Amount for the whole transaction
			$cartSave->fldCartShippingCode = "STANDARD";//Input::get('shipping_code'); // Shipping Code for the whole transaction
			$cartSave->fldCartQuantity =$carts->quantity;
			$cartSave->fldCartOrderNo = $order_code;
			$cartSave->fldCartOrderDate = $date;
			$cartSave->fldCartStatus = $status;

			$cartSave->fldCartShippingAddress = Input::get('shipping_address') . ' ' . Input::get('shipping_address1') . ' ' . Input::get('shipping_city') . ' ' . Input::get('shipping_state') . ' ' . Input::get('shipping_country') . ' ' . Input::get('shipping_zip');

			$cartSave->fldCartImagePrice = $carts->fldTempCartImagePrice;
			$cartSave->fldCartFrameInfo = $carts->fldTempCartFrameInfo;
			$cartSave->fldCartFramePrice = $carts->fldTempCartFramePrice;
			$cartSave->fldCartFrameDesc = $carts->fldTempCartFrameDesc;
			$cartSave->fldCartPaperInfo = $carts->fldTempCartPaperInfo;
			$cartSave->fldCartMat1Info = $carts->fldTempCartMat1Info;
			$cartSave->fldCartMat2Info = $carts->fldTempCartMat2Info;
			$cartSave->fldCartMat3Info = $carts->fldTempCartMat3Info;
			$cartSave->fldCartMat1Options = $carts->fldTempCartMat1Options;
			$cartSave->fldCartMat2Options = $carts->fldTempCartMat2Options;
			$cartSave->fldCartMat3Options = $carts->fldTempCartMat3Options;
			if($carts->fldTempCartImageSize) {
				$cartSave->fldCartImageSize = $carts->fldTempCartImageSize;
			}
			if($carts->fldTempCartMatBorderSize) {
				$cartSave->fldCartMatBorderSize = $carts->fldTempCartMatBorderSize;
			}
			$cartSave->fldCartLinerDesc = $carts->fldTempCartLinerDesc;
			$cartSave->fldCartLinerSku = $carts->fldTempCartLinerSku;
			$cartSave->printTotal = ($carts->printTotal) ? $carts->printTotal : '';
			$cartSave->printName = ($carts->printName ) ? $carts->printName : '';
			$cartSave->graphik_cost = $carts->graphik_cost;
			$cartSave->fldCartFinishkitInfo = $carts->fldTempCartFinishkitInfo;
			$cartSave->gd_status  = $gd_order['code'];
			$cartSave->gd_orderId = $gd_order['orderId'];
			$cartSave->fldCartIpAddress = $request->ip();
			$cartSave->save();

			//remove order from tempcart
			$cartDelete = TempCart::find($carts->temp_cart_id);
			$cartDelete->delete();
		}
	}


	private function __paymentSendMail($order_code) {

		$data = Cart::displayCheckout($order_code);

		$settings = Settings::first();

		if ($data->fldCartCouponCodeCouponCode != null) {
			$code = trim($data->fldCartCouponCodeCouponCode);

			$mgr = Manager::where('fldManagerPromoCode','=',$code)->first();
			if ($mgr) {
				$settings->manager 			= $mgr->fldManagerFirstname.' '.$mgr->fldManagerLastname;
				$settings->manager_email 	= $mgr->fldManagerEmail;

				$shopcc = ShopOwner::where('fldShopOwnerManagerID','=',$mgr->fldManagerID)->first();
				if (isset($shopcc)) {
					$settings->shop 			= $shopcc->fldShopOwnerFirstname.' '.$shopcc->fldShopOwnerLastname;
					$settings->shop_email 		= $shopcc->fldShopOwnerEmail;
				}
			} else {

				$shop = ShopOwner::where('fldShopOwnerPromoCode','=',$code)->first();
				if ($shop) {
					$settings->shop 			= $shop->fldShopOwnerFirstname.' '.$shop->fldShopOwnerLastname;
					$settings->shop_email 		= $shop->fldShopOwnerEmail;

					if ($shop->fldShopOwnerManagerID > 0) {
						$mgrcc = Manager::find($shop->fldShopOwnerManagerID);
						$settings->manager 			= $mgrcc->fldManagerFirstname.' '.$mgrcc->fldManagerLastname;
						$settings->manager_email 	= $mgrcc->fldManagerEmail;
					}
				}
			}

		}

		// $dataFields = array("order_code"=>$data->order_code,"order_date"=>$data->order_date,"bFirstname"=>$data->bFirstname,
		// 	"bLastname"=>$data->bLastname,"bAddress"=>$data->bAddress,"bAddress1"=>$data->bAddress1,
		// 	"bCity"=>$data->bCity,"bSTate"=>$data->bSTate,"bZip"=>$data->bZip,"bEmail"=>$data->bEmail,
		// 	"bPhone"=>$data->bPhone,"sFirstname"=>$data->sFirstname,"sLastname"=>$data->sLastname,
		// 	"sAddress"=>$data->sAddress,"sAddress1"=>$data->sAddress1,"sCity"=>$data->sCity,
		// 	"sState"=>$data->sState,"sZip"=>$data->sZip,"sEmail"=>$data->sEmail,"sPhone"=>$data->sPhone,
		// 	"tax"=>$data->fldCartTax,"shipping_name"=>$data->fldCartShippingRateShippingName,
		// 	"shipping_amount"=>$data->fldCartShippingRateShippingAmount,"coupon_price"=>$data->fldCartCouponCodeCouponPrice,
		// 	"coupon_code"=>$data->fldCartCouponCodeCouponCode);

		$dataFields = array("order_code"=>$data->order_code,"order_date"=>$data->order_date,"bFirstname"=>$data->bFirstname,
			"bLastname"=>$data->bLastname,"bAddress"=>$data->bAddress,"bAddress1"=>$data->bAddress1,
			"bCity"=>$data->bCity,"bSTate"=>$data->bSTate,"bZip"=>$data->bZip,"bEmail"=>$data->bEmail,
			"bPhone"=>$data->bPhone,"sFirstname"=>$data->sFirstname,"sLastname"=>$data->sLastname,
			"sAddress"=>$data->sAddress,"sAddress1"=>$data->sAddress1,"sCity"=>$data->sCity,
			"sState"=>$data->sState,"sZip"=>$data->sZip,"sEmail"=>$data->sEmail,"sPhone"=>$data->sPhone,
			"tax"=>$data->fldCartTax,"coupon_price"=>$data->fldCartCouponCodeCouponPrice,"coupon_code"=>$data->fldCartCouponCodeCouponCode,
			"shipping_amount"=>Input::get('shipping_amount'),"shipping_code"=>Input::get('shipping_code'));

		// $settings = Settings::first();
		// Email User Buyer
		Mail::send('home.email_checkout', $dataFields, function ($message) use($settings) {

			$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
			$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

			$message->from(EmailFrom, EmailFromName);
			$message->to(Input::get('email'),Input::get('firstname') . ' ' . Input::get('lastname'));
			if ($settings->shop_email) { $message->cc($settings->shop_email ,$settings->shop); }
			if ($settings->manager_email) { $message->cc($settings->manager_email ,$settings->manager); }

			//$message->cc(EmailTo, EmailToName);
			//$message->cc(EmailTo2, EmailToName2);
			//$message->cc(EmailTo3, EmailToName3);
			//$message->cc(EmailTo4, EmailToName4);
			$message->bcc('buumber@gmail.com', 'Valuecom Dev');
			//$message->bcc('dennis@dogandrooster.com', 'DNR Admin 1');
			//$message->bcc('programmer1@dogandrooster.com', 'DNR Admin 3');
			//$message->bcc('programmer@dogandrooster.com', 'DNR Admin 2');
			//$message->bcc('officeassist@dogandrooster.com', 'DNR Admin 4');
            $message->subject("Clarkin: Your Order Details");
		});

		// // Email Web Admin
		Mail::send('home.email_checkout', $dataFields, function ($message) use($settings) {

			$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
			$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

			$message->from(EmailFrom, EmailFromName);

			$message->to(EmailTo, EmailToName);
			$message->to(EmailTo2, EmailToName2);
			$message->cc(EmailTo3, EmailToName3);
			//$message->cc(EmailTo4, EmailToName4);
			$message->bcc('buumber@gmail.com', 'Valuecom Dev');
			$message->subject("Clarkin: New Orders");
		});

	}

	public function guestCheckout() {

		$slug = 'checkout';

		$pages = Pages::where('fldPagesSlug', '=', $slug)->first();
		$cart = TempCart::displayCart();
		if($cart->isEmpty()) {
			// if cart is empty redirect to image galleries
			return redirect()->to('/image-galleries');
		}


		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();

		$payment = Payment::where('fldPaymentIsActive','=',1)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$settings->site_name = "Checkout";
		$freeshipping=false;$coupon_amount=0;
		$stateName=isset($billing) ? $billing->fldClientsBillingState :  "";

		$coupon_code=CouponCode::checkCouponCode(Session::get('couponCode'),$cart[0]->subtotal,$stateName);

		$coupon_code = json_decode($coupon_code);
		$tax = "";
		$client = array();
		settype($client,'object');
		$client->fldClientFirstname = $client->fldClientLastname = $client->fldClientEmail = $client->fldClientAddress = $client->fldClientContact = $client->fldClientCity = $client->fldClientState = $client->fldClientZip = '';


		return View::make('home.checkout')->with(array('pages'=>$pages,'menus'=>$menus,
													   'category'=>$category,
													   'cart'=>$cart,
													   'payment'=>$payment,
													   'settings'=>$settings,
													   'google'=>$google,
													   'coupon_code'=>$coupon_code,
													   'tax'=>$tax,
													   'client'=>$client,
													   'cart_count'=>$cart_count,
													   'pages'=>$pages
													   ));
	}

	public function get_create_client($client_id = 0, $data = array()){

        if($client_id == 0){
            // die('new client');

            $emailExists = Client::where('fldClientEmail','=',$data['email'])->first();

            if (empty($emailExists)) {
	            // die('new client - email does not exist');
                $clients = new Client;
                $clients->fldClientFirstname    = $data['firstname'];
                $clients->fldClientLastname     = $data['lastname'];
                $clients->fldClientEmail        = $data['email'];
                $clients->fldClientContact      = $data['phone'];
                $clients->fldClientCheckoutType = "Guest";
                $clients->save();

                $client_id = $clients->fldClientID;
            } else {

                Session::flash('flash', Array('alert' => 'danger', 'msg' => 'Email already exists in our record. Please use a unique email address.'),1500);
				$client_id = 0;
            }

		}else{
            // die('client_id: '.$client_id);
			$clients = Client::find($client_id);
		}
		return $client_id;
	}


	public function get_create_guest($client_id = 0, $data = array()){

        $client = new Client;
        $client->fldClientFirstname    	= $data['firstname'];
        $client->fldClientLastname     	= $data['lastname'];
        $client->fldClientEmail        	= $data['email'];
        $client->fldClientContact      	= $data['phone'];
        $client->fldClientCheckoutType 	= "Guest";
        $client->is_guest 				= 1;
        $client->save();

        $client_id = $client->fldClientID;

		return $client_id;
	}

}
