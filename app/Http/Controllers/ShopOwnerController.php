<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Client;
use App\Models\Pages;
use App\Models\Google;
use App\Models\Category;
use App\Models\TempCart;
use App\Models\ClientBilling;
use App\Models\Manager;
use App\Models\ShopOwner;
use App\Models\ShopOwnerShipping;
use App\Models\BraintreeInformation;
use App\Models\ShopOwnerCommission;
use App\Models\Cart;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Mail;
use Validator, Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShopOwnerController extends Controller
{
    public function getIndex()
    {   
		//if not login redirect to login page    	
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		    
		$shopOwner = ShopOwner::orderBy('fldShopOwnerID','DESC')->get();     
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
		$shopClass = 'class=active';
		foreach($shopOwner as $shopOwners) {
			//check commission
			$commission = ShopOwnerCommission::calculateCommissionYearAdmin($shopOwners->fldShopOwnerID);
			$shopOwners->fldShopOwnerCommission = $commission;
		}
		$google = Google::first();
		$pageTitle = SHOPOWNER_MANAGEMENT;
        return View::make('_admin.shop_owner.shop_owner', array('shopOwner' => $shopOwner,'administrator'=>$administrator,'shopClass'=>$shopClass,'pageTitle'=>$pageTitle , 'google'=>$google));
    }
	
    public function getSales($shop_owner_id) {
    	if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$shopOwner = ShopOwner::find($shop_owner_id);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
		
		$dateFrom = date('Y-1-1');
		$dateTo = date('Y-12-31');

		$cart = ShopOwnerCommission::salesActivities($shop_owner_id);

		$shopClass = 'class=active';
		$pageTitle = SHOPOWNER_MANAGEMENT;
		return View::make('_admin.shop_owner.sales', compact('shopOwner','administrator','shopClass','cart','pageTitle'));	 
	}	
  
 	
	public function getNew()
   {
	   	//if not login redirect to login page    	

		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   	
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
		$shopClass = 'class=active';

		$try = "N";
		while($try=="N") {

			$length = 4;
		    $characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
			// $promocode = 'SO'.$randomString;
			$promocode = 'SH'.$randomString;

			// $promocode = 'SO'.Str::random(4);
			$managerPromo = ShopOwner::where('fldShopOwnerPromoCode','=',$promocode)->count();
			if($managerPromo == 0) {
				$try = "Y";
			} else {
				$try = "N";
			}
		}

		  // while($try=="N") {
		  //  $promocode = 'SO'.Str::random(4);
		  //  // $promocode = 'SHP'.Str::random(4); # changed by abustillo limit promocode to 6 characters
		  //  $managerPromo = ShopOwner::where('fldShopOwnerPromoCode','=',$promocode)->count();
		  //  if($managerPromo == 0) {
		  //   $try = "Y";
		  //  } else {
		  //   $try = "N";
		  //  }
		  // }

		$manager = Manager::orderBy('fldManagerFirstname')
							->orderBy('fldManagerLastname')
							->get();	  
		$managerId = 0;							
		$pageTitle = SHOPOWNER_MANAGEMENT;
   		return View::make('_admin.shop_owner.shop_owner_add',array('administrator'=>$administrator,
   															'promocode'=>$promocode,
   														   'shopClass'=>$shopClass,
   														   'manager'=>$manager,
   														   'managerId'=>$managerId,
   														   'pageTitle'=>$pageTitle));
   } 
   
     
   
   public function postNew() {
	   
	$rules   = ShopOwner::rules(0);    
	$validator = Validator::make(Input::all(), $rules);
    	
	if ($validator->fails()) {    			
	   return Redirect::to('dnradmin/shop-owner/new')->withInput()->withErrors($validator,'shopOwner');	
	} else {     
  	   $password = Hash::make(Input::get('password'));	   		
	   $shopOwner = new ShopOwner;
	   $shopOwner->fldShopOwnerManagerID 	= Input::get('manager_id');
	   $shopOwner->fldShopOwnerFirstname 	= Input::get('firstname');
	   $shopOwner->fldShopOwnerLastname 	= Input::get('lastname');
	   $shopOwner->fldShopOwnerBusiness 	= Input::get('business_name');
	   $shopOwner->fldShopOwnerEmail 		= Input::get('email');
	   $shopOwner->fldShopOwnerPassword 	= $password;
	   $shopOwner->fldShopOwnerPhoneNo 		= Input::get('phone');
	   $shopOwner->fldShopOwnerGender 		= Input::get('gender');
	   $shopOwner->fldShopOwnerBirthDate 	= Input::get('bday');
	   $shopOwner->fldShopOwnerAddress 		= Input::get('address');
	   $shopOwner->fldShopOwnerPromoCode 	= Input::get('promocode');
	   $shopOwner->save();	   	  

	   	//send email to owner
		$messageData = array(
			'firstname' => Input::get('firstname'),
			'lastname' => Input::get('lastname'),
			'email' => Input::get('email'),
			'phone'=>Input::get('phone'),
			'business_name'=>Input::get('business'),
			'password' => Input::get('password')
		);
											
		$settings = Settings::first();									

		// Email Shop Owner / Cc Web Admin / BCC DNR Admin
  		Mail::send('home.emails.shop_owner.sign_up', $messageData, function ($message) {
			$message->from('chad@clarkincollection.com', 'ClarkinCollection.com');
			$message->to(Input::get('email'), Input::get('firstname').' '.Input::get('lastname'));
			$message->cc(EmailTo3, EmailToName3);
			//$message->cc(EmailTo2, EmailToName2);
			$message->bcc('buumber@gmail.com', 'Valuecom Dev');
			//$message->bcc('dennis@dogandrooster.com', 'DNR Dev');
			//$message->bcc('programmer1@dogandrooster.com', 'DNR Admin');
			$message->subject("Welcome to Clarkin!");
		});


	   Session::flash('success',"Shop Owner was successfully saved."); 		   
	   return Redirect::to('dnradmin/shop-owner/new');
	}
	   	   	   
	   
	  
   }
   
   public function getEdit($id) {
	   //if not login redirect to login page    	
   
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
				   
	   $shopOwner =  ShopOwner::where('fldShopOwnerID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
	   $shopClass = 'class=active';
	   $manager = Manager::orderBy('fldManagerFirstname')
							->orderBy('fldManagerLastname')
							->get();	  
		
		$pageTitle = SHOPOWNER_MANAGEMENT;								
	    return View::make('_admin.shop_owner.shop_owner_edit', array('shopOwner' => $shopOwner,'administrator'=>$administrator,'shopClass'=>$shopClass,'manager'=>$manager,'pageTitle'=>$pageTitle));		
   }
   
   public function postEdit($id) {	  
   	$rules   = ShopOwner::rules($id);    
	$validator = Validator::make(Input::all(), $rules);
    	
	if ($validator->fails()) {    			
	   return Redirect::to('dnradmin/shop-owner/edit/'.$id)->withInput()->withErrors($validator,'shopOwner');	
	} else {   
	   $shopOwner = ShopOwner::find($id);		    	  	  
	   $shopOwner->fldShopOwnerManagerID 	= Input::get('manager_id');
	   $shopOwner->fldShopOwnerFirstname 	= Input::get('firstname');
	   $shopOwner->fldShopOwnerLastname 	= Input::get('lastname');
	   $shopOwner->fldShopOwnerBusiness 	= Input::get('business_name');
	   $shopOwner->fldShopOwnerEmail 		= Input::get('email');
	   $shopOwner->fldShopOwnerPhoneNo 		= Input::get('phone');
	   $shopOwner->fldShopOwnerGender 		= Input::get('gender');
	   $shopOwner->fldShopOwnerBirthDate 	= Input::get('bday');
	   $shopOwner->fldShopOwnerAddress 		= Input::get('address');
	   // $shopOwner->fldShopOwnerPromoCode = Input::get('promocode');	  	   
	   
	   if(Input::get('password') != "") { 
	   	   $password = Hash::make(Input::get('password'));
		   $shopOwner->fldShopOwnerPassword = $password;
	   }
	  
	   $shopOwner->save();	   	  
	   Session::flash('success',"Shop Owner was successfully saved.");
	   return Redirect::to('dnradmin/shop-owner/edit/'.$id);	
	}   

	 
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    	
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$shopOwner = ShopOwner::find($id);
		
		if(empty($shopOwner)) {
			return Redirect::to('dnradmin/shop-owner');
			exit();
		}

		$shopOwner->delete();

		return Redirect::to('dnradmin/shop-owner');
		
		
	}

	public function login(Request $requestShopOwner) {
		$email = Input::get('email');
		$shopOwner = ShopOwner::where('fldShopOwnerEmail','=',$email)							
							->first();

		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();				
		
        	$rules   = ShopOwner::rulesLogin();    
		$validator = Validator::make(Input::all(), $rules);
    	
		if ($validator->fails()) {    		
			return Redirect::to('shop-owner-login')->withInput()->withErrors($validator,'login');	 	
		} else if(empty($shopOwner)) {						
			Session::flash('error',"Invalid username or password."); 					 			
			return Redirect::to('shop-owner-login');
		} else {
				//check if the username and password is same
			
				if (Hash::check(Input::get('password'), $shopOwner->fldShopOwnerPassword)) {
					  Session::put('shop_owner_id', $shopOwner->fldShopOwnerID);						  					
					  return Redirect::to('/dashboard/shop-owner');					 
				} else {					
					Session::flash('error',"Invalid username or password."); 		
					return Redirect::to('shop-owner-login');
				}		}
	}

	public function newRegistration() {
		$rules   = ShopOwner::rulesRegistration();    
		$validator = Validator::make(Input::all(), $rules);
    	
	    if ($validator->fails()) {
		    return Redirect::to('shop-owner-registration')->withInput()->withErrors($validator,'shop');	
		} else {

			$invite_code = Input::get('invite_code');

			//check if Invite code is valid
			$sales = Manager::where('fldManagerPromoCode','=',$invite_code)
							 ->first();
			if(count($sales) == 0) {
				Session::flash('error',"Invalid Invite Code."); 		   
		  		return Redirect::to('shop-owner-registration')->withInput();
		  		exit();		
			} else {
				$manager_id = $sales->fldManagerID;
			}				 	

// 			$promocode = strtoupper('SO'.Str::random(4));
			$promocode = strtoupper('SH'.Str::random(4));

			$password = Hash::make(Input::get('password'));	   		
			$shopOwner = new ShopOwner;
			$shopOwner->fldShopOwnerFirstname = Input::get('firstname');
			$shopOwner->fldShopOwnerLastname = Input::get('lastname');
			$shopOwner->fldShopOwnerBusiness 	= Input::get('business_name');
			$shopOwner->fldShopOwnerEmail = Input::get('email');
			$shopOwner->fldShopOwnerPassword = $password;
			$shopOwner->fldShopOwnerPhoneNo = Input::get('phone');
			$shopOwner->fldShopOwnerPromoCode = $promocode;
			$shopOwner->fldShopOwnerManagerID = $manager_id;
			$shopOwner->save();	   	  

		   //send email to owner

			  $messageData = array(
							'firstname' => Input::get('firstname'),
							'lastname' => Input::get('lastname'),
							'business_name'=>Input::get('business_name'),
							'email' => Input::get('email'),	
							'phone'=>Input::get('phone'),						
							'password' => Input::get('password')							
			   );
												
			$settings = Settings::first();									

		 	// Send email code goes here
	  		// Mail::send('home.email_manager_registration', $messageData, function ($message) use($settings) {
				// $ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
				// $ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

			// Email Shop Owner / Cc Web Admin / BCC DNR Admin
	  		Mail::send('home.emails.shop_owner.sign_up', $messageData, function ($message) {
				$message->from('chad@clarkincollection.com', 'ClarkinCollection.com');
				$message->to(Input::get('email'), Input::get('firstname').' '.Input::get('lastname'));
				$message->cc(EmailTo3, EmailToName3);
				//$message->cc(EmailTo2, EmailToName2);
				$message->bcc('buumber@gmail.com', 'Valuecom Dev');
				//$message->bcc('dennis@dogandrooster.com', 'DNR Admin 1');
				//$message->bcc('programmer1@dogandrooster.com', 'DNR Admin 3');
				$message->subject("Welcome to Clarkin");
			});

	  		// Send to Web Admin
			// Mail::send('home.email_manager_registration_owner', $messageData, function ($message) use($settings) {
			// 	$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
			// 	$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

			// // Email Web Admin
			// Mail::send('home.emails.shop_owner.sign_up', $messageData, function ($message) {
			// 	$message->from(EmailFrom, Input::get('firstname') . ' ' . Input::get('lastname'));
			// 	$message->to(EmailTo,EmailToName);
			// 	$message->cc(EmailTo2,EmailToName2);
			// 	$message->subject("Clarkin: New Shop Owner");
			// });

		   Session::flash('success',"You have been successfully registered."); 		   
		   return Redirect::to('shop-owner-registration');		   
		}
	}


	public function forgotPassword() {
		$email = Input::get('email');		
						  
		$shopOwner = ShopOwner::where('fldShopOwnerEmail','=',$email)							
							->first();
		
		if(empty($shopOwner)) {
			Session::flash('error-forgot',"Email Address not found."); 		
			return Redirect::to('shop-owner-login');		
		} else {
			$shopOwner->fldShopOwnerHashSecurity = Session::getId();
			$shopOwner->save();
			
			//send email to client goes here for the email confirmation and include also the links of new password form
				//send email code goes here
						 $messageData = array(
							'security' => Session::getId(),
							'name' => $shopOwner->fldShopOwnerFirstname
						);
						
						$settings = Settings::first();	
						
				  		Mail::send('home.emails.shop_owner.forgot_password', $messageData, function ($message) use($settings) {
							
							//$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
							//$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;
													
							$message->from('chad@clarkincollection.com', 'ClarkinCollection.com');
							$message->to(Input::get('email'))->subject("Forgot Password");									
						});
				  //end send mail
			Session::flash('shop-owner-forgot-success',"Success."); 		  
			return Redirect::to('shop-owner-login');
		}
	}


	public function newPassword($hash) {
		$shopOwner = ShopOwner::where('fldShopOwnerHashSecurity','=',$hash)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$settings = Settings::first();
		$google = Google::first();				  
		$cart_count = TempCart::countCart();
		$pages = Pages::find(46);		
		return View::make('home.shop-owner-reset-password', array('menus'=>$menus,
												       'category'=>$category,
												       'shopOwner' => $shopOwner,
												       'settings'=>$settings,
												       'google'=>$google,
												       'pages'=>$pages,
												       'cart_count'=>$cart_count));	

	}

	public function resetPassword() {
		$password = Input::get('password');
		$password1 = Input::get('password1');
		$shop_owner_id = Input::get('shop_owner_id');	
		$hash = Input::get('hash');	
		
		$rules   = ShopOwner::rulesResetPassword();    
		$validator = Validator::make(Input::all(), $rules);
    	
		if ($validator->fails()) {    		
			return Redirect::to('shop-owner-new-password/'.$hash)->withInput()->withErrors($validator,'resetpassword');	
		} else {	
				$shopOwner = ShopOwner::where('fldShopOwnerID','=',$shop_owner_id)->first();
								
					//reset password 			
					$shopOwner->fldShopOwnerPassword = Hash::make($password);
					$shopOwner->save();
					
					$messageData = array(
							'firstname' => $shopOwner->fldShopOwnerFirstname,
							'username' => $shopOwner->fldShopOwnerLastname,
							'password' => $password
						);
						
						
						$settings = Settings::first();	

				  		Mail::send('home.emails.shop_owner.success_reset', $messageData, function ($message) use($settings,$shopOwner) {
							
							//$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
							//$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;
													
							$message->from('chad@clarkincollection.com', 'ClarkinCollection.com');
							$message->to($shopOwner->fldShopOwnerEmail)->subject("Reset Password");									
						});
					Session::flash('shop-owner-reset-success',"Success.");
					return Redirect::to('shop-owner-login');				
		}	
	}



	public function dashboard() {
		if(!Session::has('shop_owner_id')) { return Redirect::to('/shop-owner-login');}
		
		$shop_owner_id = Session::get('shop_owner_id');
		$shopOwner = ShopOwner::find($shop_owner_id);
		

		settype($pages, 'object');
		$pages->fldPagesTitle = "Dashboard";
		$pages->category = "shop-owner";
		$pages->slug = "index";
		$settings = Settings::first();

		$cart = ShopOwnerCommission::displayOrdersCommission($shop_owner_id);		
		$google = Google::first();
		return View::make('dashboard.shop-owner.index', array('shop_owner_id'=>$shop_owner_id,
													 'shopOwner' => $shopOwner,													 
													 'pages'=>$pages,
													 'settings'=>$settings,
													 'cart'=>$cart,
													 'google' => $google
													 ));
	}


	public function profileEdit() {
		if(!Session::has('shop_owner_id')) { return Redirect::to('/shop-owner-login');}
		$shop_owner_id = Session::get('shop_owner_id');
		$shopOwner = ShopOwner::find($shop_owner_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Update Profile";
		$pages->category = "shop-owner";
		$pages->slug = "edit-profile";
		$settings = Settings::first();
		
		$birthMonth = date('n',strtotime($shopOwner->fldShopOwnerBirthDate));
		$birthDay = date('j',strtotime($shopOwner->fldShopOwnerBirthDate));
		$birthYear = date('Y',strtotime($shopOwner->fldShopOwnerBirthDate));

		$birthDate = [$birthMonth,$birthDay,$birthYear];

		$shipping = ShopOwnerShipping::where('fldShopOwnerShippingClientID','=',$shop_owner_id)->first();
     	
		require_once('../public/payment/braintree/lib/Braintree.php');
		\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);
		if($shopOwner->fldShopOwnerBraintreeCustomerID != "") {	
			$braintreeClient = BraintreeInformation::findClient($shopOwner->fldShopOwnerBraintreeCustomerID);
		} else {
			$braintreeClient = "";
		}
		$braintreeMerchant = "";
		if($shopOwner->fldShopOwnerBrainTreeMerchantID != "") {	
			$braintreeMerchant = BraintreeInformation::findMerchant($shopOwner->fldShopOwnerBrainTreeMerchantID);
		} else {
			$braintreeClient = "";	
		}		
		$google = Google::first();
	     	return View::make('dashboard.shop-owner.edit-profile', compact('shop_owner_id','shopOwner','pages','settings','birthDate','shipping','braintreeClient','braintreeMerchant','google'));	 		
 		
	 }


	public function updateProfile() {
	 	if(!Session::has('shop_owner_id')) { return Redirect::to('/shop-owner-login');}
		$shop_owner_id = Session::get('shop_owner_id');
		
		$rules   = Manager::rulesUpdateProfile($shop_owner_id);    
		$validator = Validator::make(Input::all(), $rules[0],$rules[1]);
    	
		if ($validator->fails()) {    		
			return Redirect::to('dashboard/shop-owner/edit-profile')->withInput()->withErrors($validator,'updateProfile');	
		} else {	
	
			$shopOwner = ShopOwner::find($shop_owner_id);
			$shopOwner->fldShopOwnerFirstname 	= Input::get('firstname');
			$shopOwner->fldShopOwnerLastname 	= Input::get('lastname');
			$shopOwner->fldShopOwnerBusiness 	= Input::get('business_name');
			$shopOwner->fldShopOwnerEmail 		= Input::get('email');
			$shopOwner->fldShopOwnerPhoneNo 	= Input::get('phone');
			$shopOwner->fldShopOwnerAddress 	= Input::get('address');
			$shopOwner->fldShopOwnerCity 		= Input::get('city');
			$shopOwner->fldShopOwnerState 		= Input::get('state');
			$shopOwner->fldShopOwnerZip 		= Input::get('zip');
			$shopOwner->fldShopOwnerProfession 	= Input::get('career');

			if(Input::get('password') != "") {
				$shopOwner->fldShopOwnerPassword = Hash::make(Input::get('password'));
			}

			$file = Input::file('image');
			if($file != "") {
				$shopOwner->fldShopOwnerImage = ShopOwner::uploadSingleImage($file,$shop_owner_id);
			}

			$shopOwner->fldShopOwnerAuthorization = Input::get('authorization');
			$shopOwner->fldShopOwnerMobileAlerts = Input::get('mobile_alerts_value');
			$shopOwner->fldShopOwnerEmailAlerts = Input::get('email_alerts_value');
			$shopOwner->fldShopOwnerBirthDate = Input::get('birth_year') . '-' . Input::get('birth_month') . '-' . Input::get('birth_date');

			$shopOwner->fldShopOwnerBankName = Input::get('bank_name');
			$shopOwner->fldShopOwnerTypeofAccount = Input::get('type_of_account');
			$shopOwner->fldShopOwnerBankAccountNumber = Input::get('account_no');
			$shopOwner->fldShopOwnerBankRoutingNumber = Input::get('routing_no');
			$shopOwner->fldShopOwnerBankAddress1 = Input::get('banking_street');
			$shopOwner->fldShopOwnerBankCity = Input::get('banking_city');
			$shopOwner->fldShopOwnerBankState = Input::get('banking_state');
			$shopOwner->fldShopOwnerBankZIP = Input::get('banking_zip');

			$shopOwner->save();	

			//for shipping address
			//check if shipping client is already exist			
			$shipping = ShopOwnerShipping::where('fldShopOwnerShippingClientID','=',$shop_owner_id)->count();
			if($shipping == 0) {
				$shippingInfo = new ShopOwnerShipping;
				$shippingInfo->fldShopOwnerShippingClientID = $shop_owner_id;
				$shippingInfo->fldShopOwnerShippingFirstname = Input::get('firstname');
				$shippingInfo->fldShopOwnerShippingLastname = Input::get('lastname');
				$shippingInfo->fldShopOwnerShippingEmail = Input::get('email');
				$shippingInfo->fldShopOwnerShippingPhone = Input::get('phone');
			} else {
				$shippingInfo = ShopOwnerShipping::where('fldShopOwnerShippingClientID','=',$shop_owner_id)->first();
			}

			$shippingInfo->fldShopOwnerShippingAddress = Input::get('shipping_address');
			$shippingInfo->fldShopOwnerShippingCity = Input::get('shipping_city');
			$shippingInfo->fldShopOwnerShippingState = Input::get('shipping_state');
			$shippingInfo->fldShopOwnerShippingZip = Input::get('shipping_zip');
			$shippingInfo->save();

			/*
			//created braintree submerchant				
			 require_once "public/payment/braintree/lib/Braintree.php";
			\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
			\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
			\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
			\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);

			if(is_numeric(Input::get('account_no'))) {
				$bank_name = Input::get('bank_name');
				$account_no = Input::get('account_no');
				$type_of_account = Input::get('type_of_account');
				$routing_no = Input::get('routing_no');
				$banking_street = Input::get('banking_street');
				$banking_city = Input::get('banking_city');
				$banking_state = Input::get('banking_state');
				$banking_zip = Input::get('banking_zip');

				$dateOfBirth = Input::get('birth_year') . '-'. Input::get('birth_month') . '-' . Input::get('birth_date');

				$params = [Input::get('firstname'),Input::get('lastname'),Input::get('email'),Input::get('phone'),$banking_street,
							$banking_zip,$banking_city,$banking_state,$dateOfBirth,$routing_no,$account_no];
				$results= BraintreeInformation::createSubMerchant($params);
				

				if($results->success == "") {
					 $message = $results->message;
					 Session::flash('braintree-error',"Banking Information: ".$message);  
					 return Redirect::to('/dashboard/shop-owner/edit-profile'); 
				} else {
					$shopOwner = ShopOwner::find($shop_owner_id);
					$shopOwner->fldShopOwnerBankName = Input::get('bank_name');
					$shopOwner->fldShopOwnerTypeofAccount = Input::get('type_of_account');
					$shopOwner->fldShopOwnerBrainTreeMerchantID = $results->merchantAccount->id;
					$shopOwner->save();
				}

			}
			//for create client in braintree use for payment
			if(is_numeric(Input::get('cc_no'))) {
				$cc_firstname = Input::get('cc_firstname');
				$cc_lastname = Input::get('cc_lastname');
				$cc_no = Input::get('cc_no');
				$cvv = Input::get('cvv');
				$cc_exp_mm = Input::get('cc_exp_mm');
				$bcc_exp_yy = Input::get('bcc_exp_yy');

				$params = [$cc_firstname,$cc_lastname,Input::get('email'),$cc_no,$cc_exp_mm,$bcc_exp_yy,$cvv];
				
				$results = BraintreeInformation::createClient($params);

				if($results->success == "") {
					 $message = $results->message;
					  Session::flash('braintree-error',"Credit Card Information: ".$message);    
					 return Redirect::to('/dashboard/shop-owner/edit-profile'); 
				} else {
					$shopOwner = ShopOwner::find($shop_owner_id);
					$shopOwner->fldShopOwnerCVV = Input::get('cvv');
					$shopOwner->fldShopOwnerBraintreeCustomerID = $results->customer->id;
					$shopOwner->save();	
				}

			}
			*/

			Session::flash('success',"Profile was successfully saved.");  
			return Redirect::to('/dashboard/shop-owner/edit-profile'); 
				
		}	
	 }
	
	 public function profile() {
	 	if(!Session::has('shop_owner_id')) { return Redirect::to('/shop-owner-login');}
		$shop_owner_id = Session::get('shop_owner_id');
		$shopOwner = ShopOwner::find($shop_owner_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Profile";
		$pages->category = "shop-owner";
		$pages->slug = "profile";
		$settings = Settings::first();
		$google = Google::first();
		return View::make('dashboard.shop-owner.profile', array('shop_owner_id'=>$shop_owner_id,
													 'shopOwner' => $shopOwner,
													 'pages'=>$pages,
													 'settings'=>$settings,
													'google' => $google));
	 }

	public function orderHistory() {
	 	if(!Session::has('shop_owner_id')) { return Redirect::to('/');}
		$shop_owner_id = Session::get('shop_owner_id');
		$shopOwner = ShopOwner::find($shop_owner_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Order History";
		$pages->category = "shop-owner";
		$pages->slug = "order-history";
		$settings = Settings::first();

		$dateFrom = date('Y-1-1');
		$dateTo = date('Y-12-31');

		$cart = ShopOwnerCommission::displayOrdersCommissionByDateOrderHistory($shop_owner_id,$dateFrom,$dateTo);
		$google = Google::first();
		return View::make('dashboard.shop-owner.order-history', compact('shopOwner','pages','settings','cart','google'));	 
	 }

	 public static function orderDetails($orderNo) {
	 	$shop_owner_id = Session::get('shop_owner_id');
		
	 	$orderInfo = ShopOwnerCommission::displayOrdersCommissionByOrderNo($shop_owner_id,$orderNo);

	 	$orderInfo->orderDetails = $orderInfo->product_name . ' - ' .
	 							   Cart::getImageSize($orderInfo->fldCartImageSize) . ' - '.
								   Cart::getFrameAttributes($orderInfo->fldCartFrameDesc) . ' - '.
								   Cart::getPaperInfo($orderInfo->fldCartPaperInfo) . ' - ' .
								   Cart::getMat($orderNo);
		
		$orderInfo->fldCartOrderDate = date('m/d/Y',strtotime($orderInfo->order_date));
		$orderInfo->imageFrame = Cart::getReturnFrameImage($orderNo,$orderInfo->fldProductSlug,$orderInfo->image);
			
	 	return $orderInfo;
	 }

	public function bankRouting() {	 	
	 	if(!Session::has('shop_owner_id')) { return Redirect::to('/shop-owner-login');}
		$shop_owner_id = Session::get('shop_owner_id');
		$shopOwner = ShopOwner::find($shop_owner_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Bank Routing";
		$pages->category = "shop-owner";
		$pages->slug = "bank-routing";
		$settings = Settings::first();
		
		
     	
		require_once "public/payment/braintree/lib/Braintree.php";
		\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);		

		if($shopOwner->fldShopOwnerBraintreeCustomerID != "") {	
			$braintreeClient = BraintreeInformation::findClient($shopOwner->fldShopOwnerBraintreeCustomerID);
		} else {
			$braintreeClient = "";
		}
		if($shopOwner->fldShopOwnerBrainTreeMerchantID != "") {	
			$braintreeMerchant = BraintreeInformation::findMerchant($shopOwner->fldShopOwnerBrainTreeMerchantID);
		} else {
			$braintreeClient = "";	
		}
		
     	return View::make('dashboard.shop-owner.bank-routing', compact('shopOwner','pages','settings','braintreeClient','braintreeMerchant'));	 		
	 
	 }

	 public function updateBankRouting() {
	 	if(!Session::has('shop_owner_id')) { return Redirect::to('/shop-owner-login');}
		$shop_owner_id = Session::get('shop_owner_id');
		$shopOwner = ShopOwner::find($shop_owner_id);

		$shopOwner->fldShopOwnerBankName = Input::get('bank_name');
		$shopOwner->fldShopOwnerTypeofAccount = Input::get('type_of_account');

		$shopOwner->fldShopOwnerBankAccountNumber = Input::get('account_no');
		$shopOwner->fldShopOwnerBankRoutingNumber = Input::get('routing_no');
		$shopOwner->fldShopOwnerBankAddress1 = Input::get('banking_street');
		$shopOwner->fldShopOwnerBankCity = Input::get('banking_city');
		$shopOwner->fldShopOwnerBankState = Input::get('banking_state');
		$shopOwner->fldShopOwnerBankZIP = Input::get('banking_zip');

		$shopOwner->save();

		/*		
		require_once "public/payment/braintree/lib/Braintree.php";
		\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);

		if(is_numeric(Input::get('account_no'))) {
			$bank_name = Input::get('bank_name');
			$account_no = Input::get('account_no');
			$type_of_account = Input::get('type_of_account');
			$routing_no = Input::get('routing_no');
			$banking_street = Input::get('banking_street');
			$banking_city = Input::get('banking_city');
			$banking_state = Input::get('banking_state');
			$banking_zip = Input::get('banking_zip');

			$dateOfBirth = $shopOwner->fldShopOwnerBirthDate;

			$params = [$shopOwner->fldShopOwnerFirstname,$shopOwner->fldShopOwnerLastname,$shopOwner->fldShopOwnerEmail,$shopOwner->fldShopOwnerPhoneNo,$banking_street,
						$banking_zip,$banking_city,$banking_state,$dateOfBirth,$routing_no,$account_no];
			$results= BraintreeInformation::createSubMerchant($params);
			

			if($results->success == "") {
				 $message = $results->message;
				 Session::flash('braintree-error',"Banking Information: ".$message);  
				 return Redirect::to('/dashboard/shop-owner/bank-routing'); 
			} else {
				$shopOwnerUpdate = ShopOwner::find($shop_owner_id);
					$shopOwnerUpdate->fldShopOwnerBankName = Input::get('bank_name');
					$shopOwnerUpdate->fldShopOwnerTypeofAccount = Input::get('type_of_account');
					$shopOwnerUpdate->fldShopOwnerBrainTreeMerchantID = $results->merchantAccount->id;
				$shopOwnerUpdate->save();
			}

		}

		//for create client in braintree use for payment
		if(is_numeric(Input::get('cc_no'))) {
			$cc_firstname = Input::get('cc_firstname');
			$cc_lastname = Input::get('cc_lastname');
			$cc_no = Input::get('cc_no');
			$cvv = Input::get('cvv');
			$cc_exp_mm = Input::get('cc_exp_mm');
			$bcc_exp_yy = Input::get('bcc_exp_yy');

			$params = [$cc_firstname,$cc_lastname,$shopOwner->fldShopOwnerEmail,$cc_no,$cc_exp_mm,$bcc_exp_yy,$cvv];
			
			$results = BraintreeInformation::createClient($params);

			if($results->success == "") {
				 $message = $results->message;
				  Session::flash('braintree-error',"Credit Card Information: ".$message);    						 
				 return Redirect::to('/dashboard/shop-owner/bank-routing'); 
			} else {
				$shopOwnerUpdate = ShopOwner::find($shop_owner_id);
					$shopOwnerUpdate->fldShopOwnerCVV = Input::get('cvv');
					$shopOwnerUpdate->fldShopOwnerBraintreeCustomerID = $results->customer->id;
				$shopOwnerUpdate->save();	
			}

		}
		*/

		Session::flash('success',"Bank Routing was successfully saved.");  
		return Redirect::to('/dashboard/shop-owner/bank-routing'); 
	 }

	public function settings() {
	 	if(!Session::has('shop_owner_id')) { return Redirect::to('/shop-owner-login');}
		$shop_owner_id = Session::get('shop_owner_id');
		$shopOwner = ShopOwner::find($shop_owner_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Settings";
		$pages->category = "shop-owner";
		$pages->slug = "settings";
		$settings = Settings::first();
		$google = Google::first();		
     	return View::make('dashboard.shop-owner.settings', compact('shopOwner','pages','settings','google'));	 		
	 }

	 public function settingsUpdate() {
	 	if(!Session::has('shop_owner_id')) { return Redirect::to('/shop-owner-login');}
		$shop_owner_id = Session::get('shop_owner_id');
		
				
		$rules   = ShopOwner::rulesUpdateAccounts($shop_owner_id);    
		$validator = Validator::make(Input::all(), $rules[0],$rules[1]);
    	
		if ($validator->fails()) {    		
			return Redirect::to('dashboard/shop-owner/settings')->withInput()->withErrors($validator,'settings');	
		} else {
			$shopOwner = ShopOwner::find($shop_owner_id);
			$shopOwner->fldShopOwnerEmail = Input::get('email');
				
				if(Input::get('password') != "") {
					$shopOwner->fldShopOwnerPassword = Hash::make(Input::get('password'));
				}

			$shopOwner->fldShopOwnerMobileAlerts = Input::get('mobile_alerts_value');
			$shopOwner->fldShopOwnerEmailAlerts = Input::get('email_alerts_value');	
				
			$shopOwner->save();	

			Session::flash('success',"Settings was successfully saved.");  
			return Redirect::to('/dashboard/shop-owner/settings'); 		
		}
	 }

	public function logout(Request $requestShopOwner) {
	 	$requestShopOwner->session()->forget('shop_owner_id');
		$requestShopOwner->session()->flush();

		return Redirect::to('/dashboard/shop-owner');
	 }
	
	
	
}
