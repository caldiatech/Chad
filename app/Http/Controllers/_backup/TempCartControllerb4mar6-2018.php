<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Models\Settings;
use App\Models\Shipping;
use App\Models\Cart;
use App\Models\State;
use App\Models\ProductOptions;
use App\Models\Product;
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

use App\SoapXmlBuilder;

class TempCartController extends Controller
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
		
		return View::make('home.checkout')->with(array('pages'=>$pages,'menus'=>$menus,
													   'category'=>$category,
													   'cart'=>$cart,
													   'shipping'=>$shipping,
													   'billing'=>$billing,
													   'payment'=>$payment,
													   'settings'=>$settings,
													   'google'=>$google,
													   'coupon_code'=>$coupon_code,
													   'tax'=>$tax,
													   'cart_count'=>$cart_count,'client'=>$client));		   		
	}
	
	
	public function shoppingCart() {

		$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		$order_date = date('Y-m-d');
		
		$pages = Pages::where('fldPagesSlug', '=', 'shopping-cart')->first();
		
			
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();	
		
		$cartDisplay = TempCart::displayCart();
		//print_r($cartDisplay);die();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();			
		
		$settings->site_name = "Shopping Cart";
   		return View::make('home.cart')->with(array('pages'=>$pages, 'menus'=>$menus,'category'=>$category,'cart'=>$cartDisplay,'settings'=>$settings,'google'=>$google,'cart_count'=>$cart_count));
	}
	
	
	
	public function addShoppingCart(Request $request) {

		// print_r($request->all());
		Log::debug('Session::has(client_id)');
		Log::debug(Session::has('client_id') );
	  	$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		Log::debug('client_id');
		Log::debug($client_id);

		$product_id = $request->get('product_id1');
		$product = $product = Product::find($product_id);

		$productOption = ProductOptions::leftJoin('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','tblProductOptions.fldProductOptionsAssetsID')
					->where('fldProductOptionsProductID','=',$product->fldProductID)
					->where('fldProductOptionsID', '=', $request->get('imageSize'))
					->select('fldProductOptionsPrice','fldProductOptionsID','fldOptionsAssetsWidth','fldOptionsAssetsHeight')
					->first();
		if($productOption) {			
			$width = $productOption->fldOptionsAssetsWidth;
			$height = $productOption->fldOptionsAssetsHeight;
		} else {
			Session::flash('error','Missing frame size');
			return Redirect::to('products/details/'.$product->fldProductSlug)->withInput();
		}

		$qty = Input::get('qty');
		$frame_info = Input::get('frame_info');
		$frame_desc = Input::get('frame_desc');
		$frame_width = Input::get('frame_width');
		$frame_border_size = Input::get('frame_border_size');
		$packagePrice = array();
		$total_price = $image_price = $frame_price = $feeTotal = $merchandiseTotal = $promotionTotal = $wholesaleTotal = $discountTotal = 0;
		$total_price = $image_price = $frame_price = $feeTotal = $merchandiseTotal = $promotionTotal = $wholesaleTotal = Input::get('image_price');
		//check if cart alreadty has an item
		$get_the_same_cart_item = TempCart::where('fldTempCartProductID','=', $product_id)->where('fldTempCartFrameInfo','=',$frame_info)->where('fldTempCartImageSize', '=', $frame_border_size)->where('fldTempCartClientID', '=', $client_id)->first();
		Log::debug('get_the_same_cart_item');
		Log::debug($get_the_same_cart_item);


		$a_liner = config('constants.liner');
		$o_liner = $a_liner[0];
		Log::debug('o_liner');
		Log::debug($o_liner);

		// dd($request->all());
		if(count($get_the_same_cart_item) > 0){
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
				

			$fldCartImageSize = Input::get('imageSize');
			$matborder_whole = Input::get('matborder_whole');
			$matborder_fractions = Input::get('matborder_fractions');
			$mats_width = $matborder_whole + $matborder_fractions;

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


			$order_date = date('Y-m-d');

			// $cart = TempCart::where('fldTempCartProductID','=',$product_id)
			// 					->where('fldTempCartClientID','=',$client_id)
			// 					->where('fldTempCartOrderDate','=',$order_date)
			// 					->first();	
			// removed checking cart 		
			// always new because of a lot of options
			// if(empty($cart)) {
			$tempcart = new TempCart;					
			$tempcart->fldTempCartClientID = $client_id;		
			$tempcart->fldTempCartQuantity = $qty;		
			$tempcart->fldTempCartProductID = $product_id;

			$products = Product::where('fldProductID','=',$product_id)->first();		
			$tempcart->fldTempCartProductName = $products->fldProductName;
			$tempcart->fldTempCartProductPrice = $total_price;
			
			$tempcart->fldTempCartOrderDate = $order_date;
			$tempcart->fldTempCartImagePrice = $image_price;

			$tempcart->fldTempCartLinerDesc 	= $o_liner['title'];
		
			$tempcart->fldTempCartLinerSku 	= $o_liner['sku'];
			

			$tempcart->fldTempCartFrameInfo = $frame_info;
			$tempcart->fldTempCartFramePrice = $frame_price;
			$tempcart->fldTempCartFrameDesc = $frame_desc;
			$tempcart->fldTempCartPaperInfo = $paper_info;
			$tempcart->fldTempCartPaperOptions = $paper_options;
			$tempcart->fldTempCartFinishkitInfo = $finishkit_info;
			$tempcart->fldTempCartMat1Info = $mat1_info;
			$tempcart->fldTempCartMat2Info = $mat2_info;
			$tempcart->fldTempCartMat3Info = $mat3_info;
			$tempcart->fldTempCartMat1Options = $mat1_options;
			$tempcart->fldTempCartMat2Options = $mat2_options;
			$tempcart->fldTempCartMat3Options = $mat3_options;
			$tempcart->fldTempCartImageSize = $frame_border_size;
			//$tempcart->fldTempCartMatBorderSize = $matborder_whole + $matborder_fractions;
			$tempcart->fldTempCartMatBorderSize = $frame_width;

			// graphika amounts
			$tempcart->feeTotal 		= $feeTotal;
			$tempcart->merchandiseTotal = $merchandiseTotal;
			$tempcart->promotionTotal 	= $promotionTotal;
			$tempcart->wholesaleTotal 	= $wholesaleTotal;
			$tempcart->discountTotal 	= $discountTotal;
			$tempcart->save();
			Log::debug($tempcart);

		}
	
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
					
					list ($key,$cartid) = each ($cartID);
					
					$tempcart = TempCart::find($cartid);						
					$tempcart->fldTempCartQuantity = $qty;
					$tempcart->save();
					
				 }
				
				if(isset($data['checkout'])) {	
					if(Session::has('client_id')) { 					
						return Redirect::to('checkout');
					} else {
						return Redirect::to('login');
					}
				} else {
					return Redirect::to('shopping-cart')->with(array('message'=>'Success'));
				}
		}
	}
	
	public function deleteShoppingCart($id) {
		$cart = TempCart::find($id);		
		$cart->delete();	
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

		$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		$clientInfo = Client::find($client_id);

		$order_code = $client_id .'-'.date('Ymd').'-'.rand(1,400);
		$temp_cart_class = new TempCart;
		$temp_cart = $temp_cart_class->displayCart();
        Log::debug('---------temp_cart--------------');
        Log::debug($temp_cart);
        Log::debug('---------temp_cart--------------');
		// Authorize.net - START
		$subtotal_amount = $tax_amount = $grandtotal = $coupon_discount = $discount_formula = $tax_total = $sales_manager_commission_total = $shop_owner_commission_total = 0;

		if(isset($temp_cart[0]['grandtotal'])){
			$grandtotal	= $discount_formula = $temp_cart[0]['grandtotal'];
			if(isset($temp_cart[0]['coupon_amount'])){
				$coupon_discount = $temp_cart[0]['coupon_amount'];				
			}
		}
		$firstName 			= $data['card_firstname'];
		$lastName 			= $data['card_lastname'];
		$companyName 		= $data['company'];
		$email 				= $data['email'];
		$phone				= $data['phone']; //ok

		$card_no 			= $data['card_no1'] .$data['card_no2'] . $data['card_no3'] . $data['card_no4']; 
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

		$shipping_rate_val 	= explode(';', $data['shipping_rate_val']);
		$shipping_amount 	= $shipping_rate_val[1];
        Log::debug('---------shipping_amount--------------');
        Log::debug($shipping_amount);
		$tax_amount 	= State::getStateTax($state,$grandtotal);	
        Log::debug('---------tax_amount--------------');
        Log::debug($tax_amount);
        Log::debug('---------original grandtotal--------------');
        Log::debug($grandtotal);
        Log::debug('---------discount_formula--------------');
        Log::debug($discount_formula);

        Log::debug('---------sales_manager_commission_total 0.10 * P * (1 - d/100)--------------');
        //  0.10 * P * (1 - d/100)
        // 0.10 * 240 * (1 - 10/100)
        // 0.10 * 240 * (1 - 0.1)
        //0.10 * 240 * (0.9)
        // 21.6

        // 0.10 * 240 * d/100
        //0.10 * 240 * 0.10
        //0.10 * .

        $sales_manager_commission_total = 0.10 * $discount_formula;
        Log::debug($sales_manager_commission_total);

        Log::debug('---------shop_owner_commission_total 0.10 * P * (1 - d/100)--------------');
        $shop_owner_commission_total = 0.50 * $discount_formula;
        Log::debug($shop_owner_commission_total);
        
        $tax_total = $discount_formula * ($tax_amount/100);
        Log::debug('---------tax_total P * (1 - d/100) * t/100--------------');
        Log::debug($tax_total);

        Log::debug('---------Grand Total Price = P * (1 - d/100) + Tax total + s --------------');
		$charge_amount 		= $discount_formula + $tax_total + $shipping_amount;		
        Log::debug($charge_amount);

		$currencyCode 		= "USD"; //ok

        ////////////////////////////////////////////////// -- Authorize.net Start
        require('payment/authorizenet/recurring/config.inc.php');
        require('payment/authorizenet/recurring/AuthnetXML.class.php');


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
        $refId = date('ymdhis') . rand(1000,9999);
        $xml_profile->createCustomerProfileRequest($customer_profile);

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
            // $refId = date('ymdhis') . rand(1000,9999);
            $xml_profile_update->updateCustomerProfileRequest($customer_profile_update);

            $clientInfo->fldClientAuthProfileID = $customerProfileID;
            $clientInfo->fldClientAuthPaymentID = $customerPaymentProfileID;
            $clientInfo->save();

        } else {
			
			$error_custprofile = "ERROR in creating customer profile for payment.";

            Session::flash('flash', Array('alert' => 'danger', 'msg' => $error_custprofile));
            return Redirect::to('/checkout');
        }


        ////////////////////////////////////////////////// -- Authorize.net One Time Payment
        $one_time_charge = array(
                'refId' => $refId, // Must be Unique / optional 
                'transaction' => array(
                    'profileTransAuthCapture' => array(
                        'amount' => $charge_amount,
                        'lineItems' => array(
                            'itemId' => 'Order: '+$order_code,
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

        Log::debug('---------one_time_charge--------------');
        Log::debug($one_time_charge);
        Log::debug('---------one_time_charge--------------');

        $xml_charge = new \AuthnetXML(AUTHNET_LOGIN, AUTHNET_TRANSKEY, \AuthnetXML::USE_DEVELOPMENT_SERVER);
        $refId = date('ymdhis') . rand(1000,9999);
        $xml_charge->createCustomerProfileTransactionRequest($one_time_charge); // authorizeAndCapture

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

			$error_payment1 = "Error in processing payment.";

            Session::flash('flash', Array('alert' => 'danger', 'msg' => $error_payment1));
            return Redirect::to('/checkout');
        }


		/*
		// Braintree
		if(!Input::has('braintree')) {

			$cc_firstname = Input::get('card_firstname');
			$cc_lastname = Input::get('card_lastname');
			$cc_no = Input::get('card_no1').Input::get('card_no2').Input::get('card_no3').Input::get('card_no4');
			$cvv = Input::get('card_cvv');
			$cc_exp_mm = Input::get('card_month');
			$bcc_exp_yy = Input::get('card_year');

			$params = [$cc_firstname,$cc_lastname,$clientInfo->fldClientEmail,$cc_no,$cc_exp_mm,$bcc_exp_yy,$cvv];

			// create brain tree customer
			if (!$clientInfo->fldClientBraintreeCustomerID) {
				$resultInfo = BraintreeInformation::createClient($params);

			}else{ // update braintree customer information
				$resultInfo = BraintreeInformation::updateClient($clientInfo->fldClientBraintreeCustomerID, $params);
			}

			if($resultInfo->success == "") {
				 $message = $resultInfo->message;
			     Session::flash('braintree-error',"Credit Card Information: ".$message);    
				 return Redirect::to('/checkout'); 
			} else {
				if($clientInfo->fldClientBraintreeCustomerID == "") {
					$clientInfo->fldClientBraintreeCustomerID = $resultInfo->customer->id;
					$clientInfo->save();	
				}
				// $results = BraintreeInformation::clientPayment($resultInfo->customer->id,$amount);
			}
		}
		*/



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
		
		//save shipping rate
		 if(Input::get('freeshipping')=="no" || Input::get('freeshipping')=="") { 
			$shippingrate = explode(";",Input::get('shipping_rate_val'));
			$shippingRateVal = new CartShippingRate;
			$shippingRateVal->fldCartShippingRateOrderNo = $order_code;	
			$shippingRateVal->fldCartShippingRateShippingName = $shippingrate[0];	
			$shippingRateVal->fldCartShippingRateShippingAmount = $shippingrate[1];	
			$shippingRateVal->save();
		} 
		
		// $amount = number_format(Input::get('total'),2);

		// // pay through braintree account
		// $results = BraintreeInformation::clientPayment($clientInfo->fldClientBraintreeCustomerID, $amount);

		if($success <> 1) {
				 $message = 'Error'; // $results->message;
				 // Session::flash('braintree-error',"Payment Information: ".$message); 
				 session()->flash('flash', ['alert' => "danger", 'msg' => $message]);
				 return Redirect::to('/checkout'); 
		} else {

			// CREATE ORDER TO GRAPHIK API
			$createOrder = new SoapXmlBuilder;
			$gd_order = $createOrder->gdCreateOrder($data, $order_code);
			// SAMPLE RESPONSE FROM GRAPHIK API
			// array:4 [▼
			//   "code" => "PLACED"
			//   "externalId" => "10301840"
			//   "message" => "Order Processed"
			//   "orderId" => "10301840"
			// ]

			// after successful payment transfer temp cart to cart
			//save tempcart to cart
			$this->__transferToCart($temp_cart, $order_code, $gd_order,$client_id);

			if (Session::has('couponSourceID')) {
				if(Session::get('couponSource') == 'Manager') {
				 	//compute manager comissions
				 	$manager = Manager::find(Session::get('couponSourceID'));
				 	$managerCommission = ManagerCommission::calculateCommission($sales_manager_commission_total,$manager,$clientInfo,$order_code,1);
				} elseif(Session::get('couponSource') == 'Shop') {
				 	$shopOwner = ShopOwner::find(Session::get('couponSourceID'));
				 	$shopOwnerCommission = ShopOwnerCommission::calculateCommission($shop_owner_commission_total,$shopOwner,$clientInfo,$order_code,1);
				} 	
			}
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
		
		$dataFields = array("order_code"=>$data->order_code,"order_date"=>$data->order_date,"bFirstname"=>$data->bFirstname,
			"bLastname"=>$data->bLastname,"bAddress"=>$data->bAddress,"bAddress1"=>$data->bAddress1,
			"bCity"=>$data->bCity,"bSTate"=>$data->bSTate,"bZip"=>$data->bZip,"bEmail"=>$data->bEmail,
			"bPhone"=>$data->bPhone,"sFirstname"=>$data->sFirstname,"sLastname"=>$data->sLastname,
			"sAddress"=>$data->sAddress,"sAddress1"=>$data->sAddress1,"sCity"=>$data->sCity,
			"sState"=>$data->sState,"sZip"=>$data->sZip,"sEmail"=>$data->sEmail,"sPhone"=>$data->sPhone,
			"tax"=>$data->fldCartTax,"shipping_name"=>$data->fldCartShippingRateShippingName,
			"shipping_amount"=>$data->fldCartShippingRateShippingAmount,"coupon_price"=>$data->fldCartCouponCodeCouponPrice,
			"coupon_code"=>$data->fldCartCouponCodeCouponCode);

		$settings = Settings::first();
		Mail::send('home.email_checkout', $dataFields, function ($message) use($settings) {
						
			$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
			$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;
					
			$message->from(EmailFrom, EmailFromName);
			$message->to(Input::get('email'),Input::get('firstname') . ' ' . Input::get('lastname'))->subject("Your Order Details");									
		});

		//send email to owner
		Mail::send('home.email_checkout', $dataFields, function ($message) use($settings) {
						
			$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
			$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;
					
			$message->from(EmailFrom,Input::get('firstname') . ' ' . Input::get('lastname'));							
			$message->to($ownerEmail, $ownerName)->subject("New Orders");
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
		
		
		return View::make('home.guest-checkout')->with(array('pages'=>$pages,'menus'=>$menus,
													   'category'=>$category,
													   'cart'=>$cart,													   
													   'payment'=>$payment,
													   'settings'=>$settings,
													   'google'=>$google,
													   'coupon_code'=>$coupon_code,
													   'tax'=>$tax,
													   'cart_count'=>$cart_count,
													   'pages'=>$pages));
	}


	public function paymentGuestCheckout() {

		$data = Input::all();
		// // $cart = TempCart::displayCart();
		// $order_code = 'SAMPLE123';
		// $createOrder = new SoapXmlBuilder;
		// $gd_order = $createOrder->gdCreateOrder($data, $order_code);
		// dd("EXIT");
		// // dd($cart);

		$sessions = session()->all();

		$client_old_id =  Session::getId();
		
		//save guest to client info
		$clients = new Client;
		// $clients->fldClientFirstname = Input::get('firstname');	 
		// $clients->fldClientLastname = Input::get('lastname');	 
		// $clients->fldClientEmail = Input::get('email');	 			     
		// $clients->fldClientContact = Input::get('phone');
		$clients->fldClientFirstname 	= $data['firstname'];
		$clients->fldClientLastname 	= $data['lastname'];
		$clients->fldClientEmail 		= $data['email'];
		$clients->fldClientContact 		= $data['phone'];
		$clients->fldClientCheckoutType = "Guest";	  	   				
		$clients->save();

		$client_id = $clients->fldClientID;
		$order_code = $client_id .'-'.date('Ymd').'-'.rand(1,400);

		// Authorize.net - START
		$firstName 			= $data['card_firstname'];
		$lastName 			= $data['card_lastname'];
		$companyName 		= $data['company'];
		$email 				= $data['email'];
		$phone				= $data['phone']; //ok

		$card_no 			= $data['card_no1'] .$data['card_no2'] . $data['card_no3'] . $data['card_no4']; 
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

		$subtotal_amount	= $data['total']; // Including Tax
		$shipping_rate_val 	= explode(';', $data['shipping_rate_val']);
		$shipping_amount 	= $shipping_rate_val[1];
		$tax_amount 		= $data['tax'];
		// $total = $subtotal_amount + $shipping_amount + $tax_amount;
		$total = $subtotal_amount + $shipping_amount;
		$charge_amount 		= $total;

		$currencyCode 		= "USD"; //ok

        ////////////////////////////////////////////////// -- Authorize.net Start
        require('payment/authorizenet/recurring/config.inc.php');
        require('payment/authorizenet/recurring/AuthnetXML.class.php');
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
        $refId = date('ymdhis') . rand(1000,9999);
        $xml_profile->createCustomerProfileRequest($customer_profile);

        if ($xml_profile->messages->message->code == 'I00001') { // Successful

            $customerProfileID = $xml_profile->customerProfileId; // Customer Profile ID
            $customerPaymentProfileID = $xml_profile->customerPaymentProfileIdList->numericString; // Customer Payment Profile ID

            // Update Customer Profile
            $customer_profile_update = array(
                    'profile' => array(
                        'merchantCustomerId' => $client_id,
                        'description' => $companyName,
                        'email' => $email,
                        'customerProfileId' => $customerProfileID,
                        )
                    );

            $xml_profile_update = new \AuthnetXML(AUTHNET_LOGIN, AUTHNET_TRANSKEY, \AuthnetXML::USE_DEVELOPMENT_SERVER);
            // $refId = date('ymdhis') . rand(1000,9999);
            $xml_profile_update->updateCustomerProfileRequest($customer_profile_update);

            $clients->fldClientAuthProfileID = $customerProfileID;
            $clients->fldClientAuthPaymentID = $customerPaymentProfileID;
            $clients->save();

        } else {
			
			$error_custprofile = "ERROR in creating customer profile for payment.";

            Session::flash('flash', Array('alert' => 'danger', 'msg' => $error_custprofile));
            return Redirect::to('/checkout');
        }


        ////////////////////////////////////////////////// -- Authorize.net One Time Payment
        $one_time_charge = array(
                'refId' => $refId, // Must be Unique / optional 
                'transaction' => array(
                    'profileTransAuthCapture' => array(
                        'amount' => $charge_amount,
                        'lineItems' => array(
                            'itemId' => 'Order: '+$order_code,
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

        $xml_charge = new \AuthnetXML(AUTHNET_LOGIN, AUTHNET_TRANSKEY, \AuthnetXML::USE_DEVELOPMENT_SERVER);
        $refId = date('ymdhis') . rand(1000,9999);
        $xml_charge->createCustomerProfileTransactionRequest($one_time_charge); // authorizeAndCapture

        if ($xml_charge->messages->message->code == 'I00001') {

			$direct_response = $xml_charge->directResponse;
			$response = explode(',', $direct_response);

            $transactionID 	= $response[4]; // Payment Transaction ID
            $authCode 		= $response[6]; // Authorization Code

            $invoiceNumber 	= $refId;

            $success = 1;

        } else {

			$error_payment1 = "Error in processing payment.";

            Session::flash('flash', Array('alert' => 'danger', 'msg' => $error_payment1));
            return Redirect::to('/guest-checkout');
        }

        /*
		if(!Input::has('braintree')) {

			$cc_firstname = Input::get('card_firstname');
			$cc_lastname = Input::get('card_lastname');
			$cc_no = Input::get('card_no1').Input::get('card_no2').Input::get('card_no3').Input::get('card_no4');
			$cvv = Input::get('card_cvv');
			$cc_exp_mm = Input::get('card_month');
			$bcc_exp_yy = Input::get('card_year');

			$params = [$cc_firstname,$cc_lastname,$clients->fldClientEmail,$cc_no,$cc_exp_mm,$bcc_exp_yy,$cvv];

			// create brain tree customer
			if (!$clients->fldClientBraintreeCustomerID) {
				$resultInfo = BraintreeInformation::createClient($params);

			}else{ // update braintree customer information
				$resultInfo = BraintreeInformation::updateClient($clients->fldClientBraintreeCustomerID, $params);
			}

			if($resultInfo->success == "") {
				 $message = $resultInfo->message;
			     Session::flash('braintree-error',"Credit Card Information: ".$message);    
				 return Redirect::to('/guest-checkout'); 
			} else {
				// if($clientInfo->fldClientBraintreeCustomerID == "") {
				// 	$clientInfo->fldClientBraintreeCustomerID = $resultInfo->customer->id;
				// 	$clientInfo->save();	
				// }

				$braintreeCustomerID = $resultInfo->customer->id;
				// $results = BraintreeInformation::clientPayment($resultInfo->customer->id,$amount);
			}
		}
		*/

		$clientInfo = Client::find($client_id);
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
		
		//save shipping rate
		 if(Input::get('freeshipping')=="no" || Input::get('freeshipping')=="") { 
			$shippingrate = explode(";",Input::get('shipping_rate_val'));
			$shippingRateVal = new CartShippingRate;
			$shippingRateVal->fldCartShippingRateOrderNo = $order_code;	
			$shippingRateVal->fldCartShippingRateShippingName = $shippingrate[0];	
			$shippingRateVal->fldCartShippingRateShippingAmount = $shippingrate[1];	
			$shippingRateVal->save();
		} 
		
		// $amount = number_format(Input::get('total'),2);

		// pay through braintree account
		// $results = BraintreeInformation::clientPayment($braintreeCustomerID, $amount);

		if($success <> 1) {
				 $message = $results->message;
				 // Session::flash('braintree-error',"Payment Information: ".$message); 
				 session()->flash('flash', ['alert' => "danger", 'msg' => $message]);
				 return Redirect::to('/guest-checkout'); 
		} else {

			// CREATE ORDER TO GRAPHIK API
			$createOrder = new SoapXmlBuilder;
			$gd_order = $createOrder->gdCreateOrder($data, $order_code);
			// SAMPLE RESPONSE FROM GRAPHIK API
			// array:4 [▼
			//   "code" => "PLACED"
			//   "externalId" => "10301840"
			//   "message" => "Order Processed"
			//   "orderId" => "10301840"
			// ]

			// after successful payment transfer temp cart to cart
			//save tempcart to cart
			$cart = TempCart::displayCart();
			$this->__transferToCart($cart, $order_code, $gd_order,$client_id);

			if (Session::has('couponSourceID')) {
				if(Session::get('couponSource') == 'Manager') {
				 	//compute manager comissions
				 	$manager = Manager::find(Session::get('couponSourceID'));
				 	$managerCommission = ManagerCommission::calculateCommission($charge_amount,$manager,$clientInfo,$order_code,1);
				} elseif(Session::get('couponSource') == 'Shop') {
				 	$shopOwner = ShopOwner::find(Session::get('couponSourceID'));
				 	$shopOwnerCommission = ShopOwnerCommission::calculateCommission($charge_amount,$shopOwner,$clientInfo,$order_code,1);
				} 	
			}

			// if($clientInfo->fldClientInviteCode != "" && $clientInfo->fldClientInviteCodeType == 1) {
			//  	//compute manager comissions
			//  	$manager = Manager::find($clientInfo->fldClientInviteCodeID);
			//  	$managerCommission = ManagerCommission::calculateCommission($amount,$manager,$clientInfo,$order_code,1);
			// } else if($clientInfo->fldClientInviteCode != "" && $clientInfo->fldClientInviteCodeType == 3) {
			//  	$shopOwner = ShopOwner::find($clientInfo->fldClientInviteCodeID);
			//  	$shopOwnerCommission = ShopOwnerCommission::calculateCommission($amount,$shopOwner,$clientInfo,$order_code,1);
			// } 	

			// send email to client and admin 
			$this->__paymentSendMail($order_code);
						
			$status = "Paid";								
			Session::forget('couponCode');

			$cart = Cart::where('fldCartOrderNo','=',$order_code)->get();
			foreach($cart as $carts) {
				$carts->fldCartStatus = $status;
				$carts->save();
			}								

			return Redirect::to('thankyou/payment');
		}
	}

}
