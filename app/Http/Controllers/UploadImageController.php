<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Client;
use App\Models\CustomImage;
use App\Models\Footer;
use App\Models\Google;
use App\Models\HomeSlide;
use App\Models\Pages;
use App\Models\Product;
use App\Models\Settings;
use App\Models\TempCart;
use App\Models\userWallet;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Session;
use File;
use Mail;
use Input;
use Log;
use View;
use Response;


// use Image;
class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Custom Photo";
        $product = CustomImage::orderby('id')->get();
		return view('_admin.photoUpload', compact('pageTitle','product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Images";
        return view('_admin.customeImage.add_image', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
		// 	'uploadRAWFile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
		$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
			'uploadRAWFile' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->all();
        
        // Store the original uploaded image
        $uploadedImage1 = $request->file('uploadRAWFile');
        $originalImagePath = $uploadedImage1->store('uploads/originals', 'public');

		$uploadedImage = $request->file('image');
        // Create a thumbnail from the original image
        $thumbnailPath = public_path('uploads' . DIRECTORY_SEPARATOR . 'thumbnails' . DIRECTORY_SEPARATOR . 'thumb_' . $uploadedImage->hashName());
        $thumbnail = Image::make($uploadedImage)->resize(450, 450, function ($constraint) {
            $constraint->aspectRatio();
			// $constraint->upsize(); 
        });

		$thumbnail->fit(450, 450, function ($constraint) {
			$constraint->upsize(); 
		});
		// $thumbnail->crop(150, 150);
		
        if (!file_exists(dirname($thumbnailPath))) {
            mkdir(dirname($thumbnailPath), 0755, true);
        }
        $thumbnailFileName = 'thumbnails/thumb_' . $uploadedImage->hashName();

    // Save the thumbnail to the storage (public disk)
         Storage::disk('public')->put($thumbnailFileName, $thumbnail->stream());

        // $thumbnail->save($thumbnailPath);

        $imageCustom = new CustomImage();
        $imageCustom['image_name'] = $data['name'];
        // $imageCustom['price_range'] = $data['startPrice'].'-'.$data['endPrice'];
        $imageCustom['price_range'] = $data['credit_options'];
        $imageCustom['orignal_image'] = $originalImagePath;
        $imageCustom['thumbnail_image'] = $thumbnailFileName;
        $imageCustom['description'] = $data['description'];
        $imageCustom->save();

        if($imageCustom){
            Session::flash('success',"Image uploaded successfully.");
            return Redirect::to('/dnradmin/add/CustomImage');
        } else {
            Session::flash('error',"Something went wrong.");
            return Redirect::to('/dnradmin/add/CustomImage');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Image";
        $product = CustomImage::where('id',$id)->first();
		return view('_admin.customeImage.edit_image', compact('pageTitle','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);

        $data = $request->all();
        
        // Store the original uploaded image
        $uploadedImage = $request->file('image');
        if ($uploadedImage !== null && $uploadedImage->isValid()) {
            // File is present in the request and it is valid
        $originalImagePath = $uploadedImage->store('uploads/originals', 'public');

        // Create a thumbnail from the original image
        $thumbnailPath = public_path('uploads' . DIRECTORY_SEPARATOR . 'thumbnails' . DIRECTORY_SEPARATOR . 'thumb_' . $uploadedImage->hashName());
        $thumbnail = Image::make($uploadedImage)->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        });
        if (!file_exists(dirname($thumbnailPath))) {
            mkdir(dirname($thumbnailPath), 0755, true);
        }
        $thumbnailFileName = 'thumbnails/thumb_' . $uploadedImage->hashName();

    // Save the thumbnail to the storage (public disk)
         Storage::disk('public')->put($thumbnailFileName, $thumbnail->stream());
         /*$imageCustom = CustomImage::where('id',$id)->first();
         $imageCustom['image_name'] = $data['name'];
         $imageCustom['price_range'] = $data['startPrice'].'-'.$data['endPrice'];
         $imageCustom['orignal_image'] = $originalImagePath;
         $imageCustom['thumbnail_image'] = $thumbnailFileName;
         $imageCustom['description'] = $data['description'];
         $imageCustom->save();*/

         $imageCustom = CustomImage::where('id',$id)->update(['image_name'=>$data['name'],'price_range'=>$data['startPrice'].'-'.$data['endPrice'],'orignal_image'=>$originalImagePath,'thumbnail_image'=>$thumbnailFileName,'description'=>$data['description']]);

        } else {
        // $thumbnail->save($thumbnailPath);

        /*$imageCustom = CustomImage::where('id',$id)->first();
        $imageCustom->image_name = $data['name'];
        $imageCustom->price_range = $data['startPrice'].'-'.$data['endPrice'];
        $imageCustom['orignal_image'] = $imageCustom['orignal_image'];
        $imageCustom['thumbnail_image'] = $imageCustom['thumbnail_image'];
        $imageCustom->description = $data['description'];
        $imageCustom->save();*/

        $imageCustom = CustomImage::where('id',$id)->update(['image_name'=>$data['name'],'price_range'=>$data['startPrice'].'-'.$data['endPrice'],'description'=>$data['description']]);

    }
        if($imageCustom){
            Session::flash('success',"Image data updated successfully.");
			return Redirect::to('dnradmin/CustomImage/edit/'.$id);
        } else {
            Session::flash('error',"Something went wrong.");
            return Redirect::to('/dnradmin/CustomImage/edit/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$addProductsImages = CustomImage::where('id','=',$id)->first();
		 $image1 = $addProductsImages->originalImagePath;
		 $image2 = $addProductsImages->thumbnailFileName;
		 File::delete($image1);
		File::delete($image2);
	
		CustomImage::where('id','=',$id)->delete();
        Session::flash('success',"Image deleted successfully.");
        return Redirect::to('/dnradmin/uploadImage');
    }

    public function inHome()
    {
        $productImage = CustomImage::orderby('Id')->get();
        $pageTitle ="In-Home";
        $pageEditable = Session::has('dnradmin_id') ? true : false;
	   	$menus = Pages::where('fldPagesMainID', '=', 0)->get();

		$homeslide = HomeSlide::orderby('fldHomeSlidePosition')->get();

		$pages = Pages::where('fldPagesSlug','=','home')->first();

		$settings = Settings::first();
		$google = Google::first();
		$footer = Footer::first();

		$homeslideFirst = HomeSlide::orderby('fldHomeSlidePosition')->first();

		$cart_count = TempCart::countCart();

		//$product = Product::join('tblProductOptions','fldProductOptionsProductID', '=', 'fldProductID')->where('fldProductIsFeatured','=',1)->groupBy('fldProductOptionsProductID')->orderBy('fldProductPosition')->take(4)->get();

		$product = Product::where('fldProductIsFeatured','=',1)->orderBy('fldProductPosition')->take(4)->get();

		/* get prices */
		$product_array_id = $product_array_prices = $product_array_highest_prices = $product_array_lowest_prices = array();
		foreach($product as $get_product_item){
			$product_array_id[] = $get_product_item->fldProductID;
		}
		$product_option_class = new \App\Models\ProductOptions;

		$get_product_options = $product_option_class->whereIn('fldProductOptionsProductID', $product_array_id)->orderBy('fldProductOptionsPrice','DESC')->get();

		foreach($get_product_options as $get_product_option){
			$fldProductOptionsProductID = $get_product_option->fldProductOptionsProductID;
			$fldProductOptionsPrice =  $get_product_option->fldProductOptionsPrice;
			$product_array_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			if(!isset($product_array_highest_prices[$fldProductOptionsProductID])){
				$product_array_highest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice; // 300 because max expensive frame = max cheap frame cost + 300
			}
			if(!isset($product_array_lowest_prices[$fldProductOptionsProductID])){
				$product_array_lowest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}
			if($fldProductOptionsPrice < $product_array_lowest_prices[$fldProductOptionsProductID]){
				$product_array_lowest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}
			if($fldProductOptionsPrice > $product_array_highest_prices[$fldProductOptionsProductID]){
				$product_array_highest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice; // 300 because max expensive frame = max cheap frame cost + 300
			}

		}
		//dd($product_array_prices);
   		
        return view('home.in_home')->with(array('menus'=>$menus,
        'homeslide'=>$homeslide,
        'homeslideFirst'=>$homeslideFirst,
        'pages' => $pages,
        'settings'=>$settings,
        'google'=>$google,
        'footer'=>$footer,
        'cart_count'=>$cart_count,
        'pageEditable'=>$pageEditable,
        'product'=>$product,
        'product_array_prices'=>$product_array_prices,
        'product_array_highest_prices'=>$product_array_highest_prices,
        'product_array_lowest_prices' => $product_array_lowest_prices,
        'productImage' =>$productImage ));
    }

    public function details($id)
    {
        $productImage = CustomImage::where('Id',$id)->first();
        $pageEditable = Session::has('dnradmin_id') ? true : false;
	   	$menus = Pages::where('fldPagesMainID', '=', 0)->get();

		$homeslide = HomeSlide::orderby('fldHomeSlidePosition')->get();

		$pages = Pages::where('fldPagesSlug','=','home')->first();

		$settings = Settings::first();
		$google = Google::first();
		$footer = Footer::first();

		$homeslideFirst = HomeSlide::orderby('fldHomeSlidePosition')->first();

		$cart_count = TempCart::countCart();

		//$product = Product::join('tblProductOptions','fldProductOptionsProductID', '=', 'fldProductID')->where('fldProductIsFeatured','=',1)->groupBy('fldProductOptionsProductID')->orderBy('fldProductPosition')->take(4)->get();

		$product = Product::where('fldProductIsFeatured','=',1)->orderBy('fldProductPosition')->take(4)->get();

		/* get prices */
		$product_array_id = $product_array_prices = $product_array_highest_prices = $product_array_lowest_prices = array();
		foreach($product as $get_product_item){
			$product_array_id[] = $get_product_item->fldProductID;
		}
		$product_option_class = new \App\Models\ProductOptions;

		$get_product_options = $product_option_class->whereIn('fldProductOptionsProductID', $product_array_id)->orderBy('fldProductOptionsPrice','DESC')->get();

		foreach($get_product_options as $get_product_option){
			$fldProductOptionsProductID = $get_product_option->fldProductOptionsProductID;
			$fldProductOptionsPrice =  $get_product_option->fldProductOptionsPrice;
			$product_array_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			if(!isset($product_array_highest_prices[$fldProductOptionsProductID])){
				$product_array_highest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice; // 300 because max expensive frame = max cheap frame cost + 300
			}
			if(!isset($product_array_lowest_prices[$fldProductOptionsProductID])){
				$product_array_lowest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}
			if($fldProductOptionsPrice < $product_array_lowest_prices[$fldProductOptionsProductID]){
				$product_array_lowest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}
			if($fldProductOptionsPrice > $product_array_highest_prices[$fldProductOptionsProductID]){
				$product_array_highest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice; // 300 because max expensive frame = max cheap frame cost + 300
			}

		}
		//dd($product_array_prices);
   		
        return view('home.details-page')->with(array('menus'=>$menus,
        'homeslide'=>$homeslide,
        'homeslideFirst'=>$homeslideFirst,
        'pages' => $pages,
        'settings'=>$settings,
        'google'=>$google,
        'footer'=>$footer,
        'cart_count'=>$cart_count,
        'pageEditable'=>$pageEditable,
        'product'=>$product,
        'product_array_prices'=>$product_array_prices,
        'product_array_highest_prices'=>$product_array_highest_prices,
        'product_array_lowest_prices' => $product_array_lowest_prices,
        'productImage' =>$productImage ));

    }

    public function addToCart(Request $request) {
		// dd($request->all());
        if(!isset($request->walletPurchase)) {
		if(isset($request->counter_if))
		{
			Session::flash('error','This product seems to be not yet ready to be purchased.');
			return redirect()->back();
		}
		}
	  	$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		$product_id = $request['product_id'] ?? null;
		Session::put('productId', $product_id);
		$productImage = CustomImage::find($product_id);
		$print_name = $request->get('print_name'); // MARK CHANGES
		$qty = "1";
		$liner_description = '';
		$liner_desc = $liner_description;
		$liner_sku = '';

		$packagePrice = array();
		$total_price = $image_price = $frame_price = $feeTotal = $merchandiseTotal = $promotionTotal = $wholesaleTotal = $discountTotal = 0;
		$total_price = $image_price = $frame_price = $feeTotal = $merchandiseTotal = $promotionTotal = $wholesaleTotal = Input::get('image_price');
        if(!isset($request->walletPurchase)) {
		if($total_price > 0){

		}else{
			Session::flash('error','This product seems to be not yet ready to be purchased.');
			return redirect()->back();
		}
		} else {
			$total_price = 1;
		}
		//check if cart alreadty has an item
		$get_the_same_cart_item = TempCart::where('fldTempCartProductID','=', $product_id)
										  ->where('printName', '=', $print_name)
										  ->where('fldTempCartClientID', '=', $client_id)->first();
		

		if(!empty($get_the_same_cart_item)){
				$tempcart = TempCart::find($get_the_same_cart_item->fldTempCartID);
				$qty = ($qty == "" || $qty <0) ? $qty=1 : $qty;
				$tempcart->fldTempCartQuantity = $tempcart->fldTempCartQuantity + $qty;
				$tempcart->save();
		}else{
		
			$order_date = date('Y-m-d');
			$tempcart = new TempCart;
			$tempcart->fldTempCartClientID 		= $client_id;
			$tempcart->fldTempCartQuantity 		= $qty;
			$tempcart->fldTempCartProductID 	= $product_id;
			$productsImage =  CustomImage::find($product_id);
			$tempcart->fldTempCartProductName 	= $productsImage->image_name ?? 'Credit';

			$tempcart->fldTempCartProductPrice 	= $total_price;
			$tempcart->fldTempCartOrderDate 	= $order_date;
			$tempcart->fldTempCartImagePrice 	= $image_price;
			$tempcart->fldTempCartLinerDesc 	= $liner_desc;
			$tempcart->fldTempCartLinerSku 		= $liner_sku;
			$tempcart->feeTotal 		= 0;
			$tempcart->graphik_cost 	= 0;
            $tempcart->is_custom = 1;
			$tempcart->printTotal 	= '';
			$tempcart->printName	= '';
			$tempcart->save();
			Log::debug($tempcart);
		}
		if(isset($request->walletPurchase)) {
    		$order_code = $client_id .date('Ymd').rand(1,400);
			$order_date = date('Y-m-d');
			$gd_order = [];
	        $gd_order['code'] = 'PLACED';
	        $gd_order['externalId'] = '99999999';
	        $gd_order['message'] = 'Order Processed';
	        $gd_order['orderId'] = '99999999';
			$data = Cart::where('fldCartClientID', $client_id)->orderBy('fldCartID', 'desc')->first();
			$status = 'New';
			$cartSave = new Cart;
			$cartSave->fldCartProductID = ($tempcart->product_id != 0)? $tempcart->product_id : $tempcart->fldTempCartProductID;
			$cartSave->fldCartClientID = $client_id;
			$cartSave->fldCartProductName = $tempcart->fldTempCartProductName;
			$cartSave->fldCartProductPrice = $tempcart->product_price;
			$cartSave->fldCartProductOptions = $tempcart->fldTempCartProductOptions;
			// $cartSave->fldCartShippingPrice = $carts->fldTempCartShippingPrice;
			$cartSave->fldCartShippingPrice = 0; // Shipping Amount for the whole transaction
			$cartSave->fldCartShippingCode = "STANDARD";//Input::get('shipping_code'); // Shipping Code for the whole transaction
			$cartSave->fldCartQuantity =$tempcart->quantity;
			$cartSave->fldCartOrderNo = $order_code;
			$cartSave->fldCartOrderDate = $order_date;
			$cartSave->fldCartStatus = $status;

			$cartSave->fldCartShippingAddress = $data->fldCartShippingAddress;

			$cartSave->fldCartImagePrice = $tempcart->fldTempCartImagePrice;
			$cartSave->fldCartFrameInfo = $tempcart->fldTempCartFrameInfo;
			$cartSave->fldCartFramePrice = $tempcart->fldTempCartFramePrice;
			$cartSave->fldCartFrameDesc = $tempcart->fldTempCartFrameDesc;
			$cartSave->fldCartPaperInfo = $tempcart->fldTempCartPaperInfo;
			$cartSave->fldCartMat1Info = $tempcart->fldTempCartMat1Info;
			$cartSave->fldCartMat2Info = $tempcart->fldTempCartMat2Info;
			$cartSave->fldCartMat3Info = $tempcart->fldTempCartMat3Info;
			$cartSave->fldCartMat1Options = $tempcart->fldTempCartMat1Options;
			$cartSave->fldCartMat2Options = $tempcart->fldTempCartMat2Options;
			$cartSave->fldCartMat3Options = $tempcart->fldTempCartMat3Options;
			if($tempcart->fldTempCartImageSize) {
				$cartSave->fldCartImageSize = $tempcart->fldTempCartImageSize;
			}
			if($tempcart->fldTempCartMatBorderSize) {
				$cartSave->fldCartMatBorderSize = $tempcart->fldTempCartMatBorderSize;
			}
			$cartSave->fldCartLinerDesc = $tempcart->fldTempCartLinerDesc;
			$cartSave->fldCartLinerSku = $tempcart->fldTempCartLinerSku;
			$cartSave->printTotal = ($tempcart->printTotal) ? $tempcart->printTotal : '';
			$cartSave->printName = ($tempcart->printName ) ? $tempcart->printName : '';
			$cartSave->graphik_cost = $tempcart->graphik_cost;
			$cartSave->fldCartFinishkitInfo = $tempcart->fldTempCartFinishkitInfo;
			$cartSave->gd_status  = $gd_order['code'];
			$cartSave->gd_orderId = $gd_order['orderId'];
			$cartSave->fldCartIpAddress = $request->ip();
			$cartSave->save();
			//remove order from tempcart
			$cartDelete = TempCart::find($tempcart->fldTempCartID);
			$cartDelete->delete();
			$data1 = Cart::displayCheckout($order_code);
			$dataFields = array("order_code"=>$order_code,"order_date"=>$order_date,"bFirstname"=>$data1->bFirstname,
			"bLastname"=>$data1->bLastname,"bAddress"=>$data1->bAddress,"bAddress1"=>$data1->bAddress1,
			"bCity"=>$data1->bCity,"bSTate"=>$data1->bSTate,"bZip"=>$data1->bZip,"bEmail"=>$data1->bEmail,
			"bPhone"=>$data1->bPhone,"sFirstname"=>$data1->sFirstname,"sLastname"=>$data1->sLastname,
			"sAddress"=>$data1->sAddress,"sAddress1"=>$data1->sAddress1,"sCity"=>$data1->sCity,
			"sState"=>$data1->sState,"sZip"=>$data1->sZip,"sEmail"=>$data1->sEmail,"sPhone"=>$data1->sPhone,
			"tax"=>$data1->fldCartTax,"coupon_price"=>$data1->fldCartCouponCodeCouponPrice,"coupon_code"=>$data1->fldCartCouponCodeCouponCode,
			);
			$settings = Settings::first();
			$user = Client::where('fldClientID',$client_id)->first();
			Mail::send('home.image_email_checkout', $dataFields, function ($message) use($settings,$user) {

				$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
				$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;
	
				$message->from(EmailFrom, EmailFromName);
				$message->to($user->fldClientEmail,$user->fldClientFirstname . ' ' . $user->fldClientLastname);
				$message->bcc('buumber@gmail.com', 'Valuecom Dev');
				$message->subject("Clarkin: Your Order Details");
			});
			$userwalltData = userWallet::where('user_id',$client_id)->first();
			$userwalltData->amount -= 1;
			$userwalltData->save();
			return Redirect::to('thankyou/payment');
		} 
		if(Input::get('checkout')) {
			if(Session::has('client_id')) {
				return Redirect::to('checkout');
			} else {
				return Redirect::to('login');
			}
		} else {
			return Redirect::to('image-cart');
		}
		

    }

    public function shoppingCartImage() {

		$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		$order_date = date('Y-m-d');

		$pages = Pages::where('fldPagesSlug', '=', 'shopping-cart')->first();


		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();

		$cartDisplay = TempCart::displayCart();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();

		$settings->site_name = "Shopping Cart";
   		return View::make('home.cart_image')->with(array('pages'=>$pages, 'menus'=>$menus,'category'=>$category,'cart'=>$cartDisplay,'settings'=>$settings,'google'=>$google,'cart_count'=>$cart_count,'credits'=>'Credits'));
	}

    public function updateImageCart() {
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
			//dd($data);
			$qty = 	Input::get('qty');
			//  foreach(Input::get('qty') as $qty)
			//  {
			// 	if($qty == 0){$qty=1;}
			// 	//echo "<pre>";print_r($cartID);exit;
			// 	//list ($key,$cartid) = each ($cartID);
				
				foreach($cartID as $key=>$cartid){
				
					$tempcart = TempCart::find($cartid);
					$tempcart->fldTempCartQuantity = $qty[$key];
					$tempcart->save();
				}

			// }

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

				return Redirect::to('image-cart')->with(array('message'=>'Success'));
			}
		}

	}


	public function deleteImageCart($id) {
		$cart = TempCart::find($id);
		if (!empty($cart)) {
		$cart->delete();
		Session::forget('couponSource');
		Session::forget('couponSourceID');
		Session::forget('couponCode');
		Session::forget('couponAmount');

		}

		return Redirect::to('image-cart');
	}


    public function checkReferCode($code,$total) {
        $value = array();
        if(Session::has('couponSource') && Session::has('couponCode')) {
            $value[] = "already_applied";
        } else {
            $percentDiscount = 25;
            $coupon = Client::where('fldClientPromoCode','=',$code)->first();
            $coupon_amount = 0;
            if(empty($coupon)) {
                $value[] = "error";
                if(Session::has('couponCode')) { 
                   Session::forget('couponSource');
                   Session::forget('couponSourceID');
                   Session::forget('couponCode');
                }
            } else {
                if(Session::get('client_id') != $coupon->fldClientID) {
                    Session::put('couponSource', 'Coupon Code Module');
                    Session::put('couponCode', $code);
                    if($coupon->fldClientPromoCode != "") {
                        $value[] = ($percentDiscount/100) * $total;
                        $coupon_amount =($percentDiscount/100) * $total;
                        $value[] = $total-(($percentDiscount/100) * $total);
                        $qty = 0;
                        $cartDt = TempCart::displayCart();
                        foreach ($cartDt as $key => $value1) {
                            $qty += (int) $value1['product_price'];
                        }
                        $cup_amt = (10/100) * $total;
                        $userWallet = new userWallet;
                        $userWallet->user_id = $coupon->fldClientID;
                        $userWallet->amount = $qty;
                        $userWallet->is_discount = $cup_amt;
                        $userWallet->type = 'raw';
                        $userWallet->save();
                    }
                    Session::put('couponAmount', $coupon_amount);
                } else {
                    $value[] = "same_user_coupon";
                }
            }
        }
		print json_encode($value);
	}
	public function download($id)
    {
		$cartData = Cart::where('fldCartOrderNo',$id)->first();
		$productsImage =  CustomImage::find($cartData['fldCartProductID']);
        $imagePath = public_path('storage/'.$productsImage->orignal_image);
        return Response::download($imagePath);
    }
}
