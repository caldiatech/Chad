<?php
/***********************DEVELOPER : EMMANUEL MARCILLA**************************/
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Client;
use App\Models\Pages;
use App\Models\Google;
use App\Models\Category;
use App\Models\TempCart;
use App\Models\ClientBilling;
use App\Models\ClientShipping;
use App\Models\Cart;
use App\Models\BraintreeInformation;
use App\Models\Product;
use App\Models\Manager;
use App\Models\ShopOwner;
use Auth;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Mail;
use Validator;
use Illuminate\Support\Str;

class ClientController extends Controller
{

    public function getIndex()
    {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		//$type = "Guest";
		//$client = Client::where('fldClientCheckoutType','!=',$type)->get();
		$client = Client::orderby('fldClientID','DESC')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$clientClass = 'class=active';
		$pageTitle = CLIENT_MANAGEMENT;
       	return View::make('_admin.client.client', array('client' => $client,'administrator'=>$administrator,'clientClass'=>$clientClass,'pageTitle'=>$pageTitle));
    }



	public function getNew()
   {
	   	//if not login redirect to login page

		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$clientClass = 'class=active';
		$pageTitle = CLIENT_MANAGEMENT;
   		return View::make('_admin.client.client_add',array('administrator'=>$administrator,
   														   'clientClass'=>$clientClass,
   														   'pageTitle'=>$pageTitle));
   }



   public function postNew() {
	$rules   = Client::rules(0);
	$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		   return Redirect::to('dnradmin/client/new')->withInput()->withErrors($validator,'client');
		} else {
	  	   $password = Hash::make(Input::get('password'));
		   $clients = new Client;
		   $clients->fldClientFirstname = Input::get('firstname');
		   $clients->fldClientLastname = Input::get('lastname');
		   $clients->fldClientEmail = Input::get('email');
		   $clients->fldClientPassword = $password;
 		   $clients->fldClientContact = Input::get('phone');
		   $clients->save();
		   Session::flash('success',"Client was successfully saved.");
		   return Redirect::to('dnradmin/client/new');

	   }
   }

   public function getEdit($id) {
	   //if not login redirect to login page

		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

	   $client =  Client::where('fldClientID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
	   $clientClass = 'class=active';
	   $pageTitle = CLIENT_MANAGEMENT;
	    return View::make('_admin.client.client_edit', array('client' => $client,'administrator'=>$administrator,'clientClass'=>$clientClass,'pageTitle'=>$pageTitle));
   }

   public function postEdit($id) {
   		$rules   = Client::rules($id);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		   return Redirect::to('dnradmin/client/edit/'.$id)->withInput()->withErrors($validator,'client');
		} else {

		   $clients = Client::find($id);
		   $clients->fldClientFirstname = Input::get('firstname');
		   $clients->fldClientLastname = Input::get('lastname');
		   $clients->fldClientEmail = Input::get('email');
		   $clients->fldClientContact = Input::get('phone');

		   if(Input::get('password') != "") {
		   	   $password = Hash::make(Input::get('password'));
			   $clients->fldClientPassword = $password;
		   }


		   $clients->save();
		   Session::flash('success',"Client was successfully saved.");
			return Redirect::to('dnradmin/client/edit/'.$id);
		}


   }

    public function getDelete($id) {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$clients = Client::find($id);

		if(empty($clients)) {
			return Redirect::to('dnradmin/client');
			exit();
		}

		$clients->delete();

		$client = Client::paginate(20);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$clientClass = 'class=active';
		$pageTitle = CLIENT_MANAGEMENT;
	    return View::make('_admin.client.client', array('client' => $client,'administrator'=>$administrator,'clientClass'=>$clientClass,'pageTitle'=>$pageTitle));
	}

	//For Registration page functionality
	public function newClient() {

	   $menus = Pages::where('fldPagesMainID', '=', 0)->get();
	   $category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();

	   $data = Input::all();

	   $rules   = Client::rulesRegistration();
	   $validator = Validator::make(Input::all(), $rules);

	   if ($validator->fails()) {
	   		return Redirect::to('registration')->withInput()->withErrors($validator,'registration');
	   } else {

		   	$clientGuest = "";
		   	$clientEmailCount = Client::where('fldClientEmail','=',Input::get('email'))
								  ->where('is_guest','=',0)
	   							  ->where('fldClientCheckoutType','=',NULL)
	   							  ->count();

		   	if($clientEmailCount >= 1) {
		   			Session::flash('error',"Email address already registered.");
					return Redirect::to('registration')->withInput();
		   	}	else {

			//generate Promo Code
	   		// $promocode = 'CL'.Str::random(4);

			if(Input::get('invite_code') != "") {
				$manager = Manager::where('fldManagerPromoCode','=',Input::get('invite_code'))->first();
				$shopOwner = ShopOwner::where('fldShopOwnerPromoCode','=',Input::get('invite_code'))->first();

				if(count($manager)>0) {
					$clientInviteCodeID = $manager->fldManagerID;
					$clientInviteCodeType = 1;
				} else if(count($shopOwner)>0) {
					$clientInviteCodeID = $shopOwner->fldShopOwnerID;
					$clientInviteCodeType = 3;
				} else {
					Session::flash('error',"Invalid invite code.");
					return Redirect::to('registration')->withInput();
				}
			} else {
				$clientInviteCodeID = "";
				$clientInviteCodeType = "";
			}

			$clients = new Client;
			$clients->fldClientFirstname = Input::get('firstname');
			$clients->fldClientLastname = Input::get('lastname');
			$clients->fldClientEmail = Input::get('email');
			$password = Hash::make(Input::get('password'));
			$clients->fldClientPassword = $password;
			$clients->fldClientContact = Input::get('phone');
			// $clients->fldClientPromoCode = strtoupper($promocode);
			$clients->fldClientInviteCode =  Input::get('invite_code');
			$clients->fldClientInviteCodeType= $clientInviteCodeType;
			$clients->fldClientInviteCodeID = $clientInviteCodeID;
			$clients->is_guest = 0;
			$clients->save();

			$client_id = Session::has('client_id') ? Session::has('client_id') : Session::getId();
			$order_date = date('Y-m-d');
			//check if temp cart have records based on session id
			$cart = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)->get();

		  	$messageData = array(
						'firstname' => Input::get('firstname'),
						'lastname' => Input::get('lastname'),
						'email' => Input::get('email'),
						'username' => Input::get('username'),
						'password' => Input::get('password')
		   	);

			$settings = Settings::first();

			// Email Web Admin / BCC DNR Admin
			Mail::send('home.email_registration', $messageData, function ($message) use($settings) {
				// $ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
				// $ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

				//$message->from(Input::get('email'), Input::get('firstname') . ' ' . Input::get('lastname'));
				$message->from(EmailFrom, EmailFromName);
				// $message->to($ownerEmail,$ownerName);
				$message->to(EmailTo3, EmailToName3);
				//$message->cc(EmailTo2, EmailToName2);
				$message->bcc('buumber@gmail.com', 'valuecom dev');
				//$message->bcc('dennis@dogandrooster.com', 'DNR Admin 1');
				//$message->bcc('appteam@dogandrooster.com', 'DNR Admin 2');
				//$message->bcc('programmer1@dogandrooster.com', 'DNR Admin 3');
				$message->subject("Clarkin: New Client Registration");
			});

			// Email Client (User)
			Mail::send('home.email_registration_client', $messageData, function ($message) use($settings){
				$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
				$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

				$message->from(EmailFrom, EmailFromName);
				$message->to(Input::get('email'),Input::get('firstname') . ' ' . Input::get('lastname'));
				$message->cc(EmailTo3, EmailToName3);
				//$message->cc(EmailTo2, EmailToName2);
				$message->bcc('buumber@gmail.com', 'valuecom dev');
				//$message->bcc('dennis@dogandrooster.com', 'DNR Admin 1');
				//$message->bcc('appteam@dogandrooster.com', 'DNR Admin 2');
				//$message->bcc('programmer1@dogandrooster.com', 'DNR Admin 3');
				$message->subject("Clarkin: Your Access Information");
			});

			//create session client id
			Session::put('client_id', $clients->fldClientID);

		  	if(count($cart)==0) {
					Session::flash('success',"Registration successful!.");
		  		return Redirect::to('/dashboard/customer');
		  	} else {
			  	//update the tempcart with the new clients id based on clients table
			  	$cart = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)
			  			     ->update(array('fldTempCartClientID'=>$clients->fldClientID));

			  	//redirect to check out page
			  	return Redirect::to('/checkout');
		  	}

	   }
	 }
   }

	//For login page functionality
    public function checkAccess() {
		$email = Input::get('email');
		// $clients = Client::where('fldClientEmail','=',$email)->first();
		$clients 	= Client::where('fldClientEmail','=',$email)
					->where('is_guest','=',0)
					->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();

                $rules   = Client::rulesLogin();
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

			return Redirect::to('login')->withInput()->withErrors($validator,'login');
		} else if(empty($clients)) {

			Session::flash('error',"Invalid username or password.");
			return Redirect::to('login');
		} else {

				//check if the username and password is same
				//print_r( Hash::check(Input::get('password'), $clients->fldClientPassword) );
				//die();
				if (Hash::check(Input::get('password'), $clients->fldClientPassword)) {
					  $client_id = Session::has('client_id') ? Session::has('client_id') : Session::getId();

					  $order_date = date('Y-m-d');
					  //check if temp cart is empty
					  $cart = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)->get();
					  //print_r($cart);die();
					  Session::put('client_id', $clients->fldClientID);
					  if(count($cart)==0) {

					  	  //redirect to order list page
						  return Redirect::to('/dashboard/customer');
					  } else {
						 //update the tempcart with the new clients id based on clients table
						 $cart = TempCart::where('fldTempCartClientID','=',$client_id)
						 				 ->where('fldTempCartOrderDate','=',$order_date)
						 				 ->update(array('fldTempCartClientID'=>$clients->fldClientID));
						  //Session::forget('client_id');
						  //create session client id
						  //echo $clients->id;	die();


						  return Redirect::to('/checkout');
					  }
				} else {


					Session::flash('error',"Invalid username or password.");
					return Redirect::to('login');
				}
		}


	}



	//For forgot password functionality
	public function forgotPassword() {
		$email = Input::get('email');

		// $clients = Client::where('fldClientEmail','=',$email)->first();
		$clients 	= Client::where('fldClientEmail','=',$email)
					->where('is_guest','=',0)
					->first();

		if(empty($clients)) {
			Session::flash('error-forgot',"Email Address not found.");
			return Redirect::to('login');
		} else {
			$clients->fldClientHashSecurity = Session::getId();
			$clients->save();

			//send email to client goes here for the email confirmation and include also the links of new password form
				//send email code goes here
						 $messageData = array(
							'security' => Session::getId(),
							'name' => $clients->fldClientFirstname
						);

						$settings = Settings::first();

				  		Mail::send('home.email_forgot_password', $messageData, function ($message) use($settings) {

							$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
							$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

							// $message->from('angela@tekcopia.com', $ownerName);
							$message->from(EmailFrom, EmailFromName);
							$message->to(Input::get('email'))->subject("Forgot Password");
						});
				  //end send mail
			Session::flash('forgot-success',"Success.");
			return Redirect::to('login');
		}

	}

	//for new password
	public function newPassword($hash) {
		$clients = Client::where('fldClientHashSecurity','=',$hash)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$pages = Pages::find(46);
		// die($hash);
		// return View::make('home.reset-password', array('menus'=>$menus,
		// 										       'category'=>$category,
		// 										       'clients' => $clients,
		// 										       'settings'=>$settings,
		// 										       'google'=>$google,
		// 										       'pages'=>$pages,
		// 										       'cart_count'=>$cart_count));
		return View::make('home.reset-password', compact('menus','category','clients','settings','google','pages','cart_count'));
	}

	//for reset password
	public function resetPassword() {
		$password = Input::get('password');
		$password1 = Input::get('password1');
		$client_id = Input::get('client_id');
		$hash = Input::get('hash');

		$rules   = Client::rulesResetPassword();
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('new-password/'.$hash)->withInput()->withErrors($validator,'resetpassword');
		} else {
				$clients = Client::where('fldClientID','=',$client_id)->first();

					//reset password
					$clients->fldClientPassword = Hash::make($password);
					$clients->save();

					$messageData = array(
							'firstname' => $clients->fldClientFirstname,
							'username' => $clients->fldClientEmail,
							'password' => $password
						);


						$settings = Settings::first();

				  		Mail::send('home.email_success_reset', $messageData, function ($message) use($settings,$clients) {

							$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
							$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

							//$message->from('angela@tekcopia.com', $ownerName);
							$message->from(EmailFrom, EmailFromName);
							$message->to($clients->fldClientEmail)->subject("Reset Password");
						});

					Session::flash('reset-success',"Success.");
					return Redirect::to('login');
		}
	}

	public function userAccount() {
		$client_id = Session::get('client_id');
		$error = "";
		$clients = Client::where('fldClientID','=',$client_id)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$settings->site_name = "Account Information";
		return View::make('home.user-account', array('menus'=>$menus,
													 'clients' => $clients,
													 'error'=>$error,
													 'settings'=>$settings,
													 'google'=>$google,
													 'cart_count'=>$cart_count));
	}

	public function updateUserAccount() {
		$client_id = Session::get('client_id');
		$lastname = Input::get('lastname');
		$firstname = Input::get('firstname');
		$email = Input::get('email');
		$username = Input::get('username');
		$ctr = "";

		$clients = Client::where('fldClientID','!=',$client_id)->where('fldClientEmail','=',$email)->first();
		if(!empty($clients)) {
			Session::flash('error',"Email Address already in use.");
			return Redirect::to('/user-account');
		}
		$clientUsername = Client::where('fldClientID','!=',$client_id)->where('fldClientUsername','=',$username)->first();
		if(!empty($clientUsername)) {
			Session::flash('error',"Username already in use.");
			return Redirect::to('/user-account');
		}

		if($ctr=="") {
			$clients = Client::find($client_id);
	   		$clients->fldClientFirstname = Input::get('firstname');
			$clients->fldClientLastname = Input::get('lastname');
			$clients->fldClientEmail = Input::get('email');
			$clients->fldClientUsername = Input::get('username');
			$clients->save();
			$error = "";
			$success = "Account information successfully saved.";
		}

		Session::flash('success',"User account was successfully saved.");
		return Redirect::to('/user-account');

	}

	public function userBilling() {
		$client_id = Session::get('client_id');
		$error = "";
		$billing = ClientBilling::where('fldClientsBillingClientID','=',$client_id)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$settings->site_name = "Billing Information";
		return View::make('home.user-billing', array('menus'=>$menus,
													 'billing' => $billing,
													 'error'=>$error,
													 'settings'=>$settings,
													 'google'=>$google,
													 'cart_count'=>$cart_count));
	}

	public function updateUserBilling() {
		$clients = ClientBilling::find(Input::get('Id'));
		$clients->fldClientsBillingLastname = Input::get('lastname');
		$clients->fldClientsBillingFirstname = Input::get('firstname');
		$clients->fldClientsBillingAddress = Input::get('address');
		$clients->fldClientsBillingAddress1 = Input::get('address1');
		$clients->fldClientsBillingCity = Input::get('city');
		$clients->fldClientsBillingState = Input::get('state');
		$clients->fldClientsBillingCountry = Input::get('country');
		$clients->fldClientsBillingZip = Input::get('zip');
		$clients->fldClientsBillingPhone = Input::get('phone');
		$clients->fldClientsBillingEmail = Input::get('email');
		$clients->save();

		$success = "Billing information successfully saved.";

		Session::flash('success',"Billing information successfully saved.");
		return Redirect::to('/user-billing');
	}

	public function userShipping() {
		$client_id = Session::get('client_id');
		$error = "";
		$shipping = ClientShipping::where('fldClientsShippingClientID','=',$client_id)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$settings->site_name = "Shipping Information";
		return View::make('home.user-shipping', array('menus'=>$menus,
													  'shipping' => $shipping,
													  'error'=>$error,
													  'settings'=>$settings,
													  'google' => $google,
													  'cart_count'=>$cart_count));
	}

	public function updateUserShipping() {
		$clients = ClientShipping::find(Input::get('Id'));
		$clients->fldClientsShippingLastname = Input::get('lastname');
		$clients->fldClientsShippingFirstname = Input::get('firstname');
		$clients->fldClientsShippingAddress = Input::get('address');
		$clients->fldClientsShippingAddress1 = Input::get('address1');
		$clients->fldClientsShippingCity = Input::get('city');
		$clients->fldClientsShippingState = Input::get('state');
		$clients->fldClientsShippingCountry = Input::get('country');
		$clients->fldClientsShippingZip = Input::get('zip');
		$clients->fldClientsShippingPhone = Input::get('phone');
		$clients->fldClientsShippingEmail = Input::get('email');
		$clients->save();


		Session::flash('success',"Shipping information successfully saved.");
		return Redirect::to('/user-shipping');
	}

	public function userChangePassword() {
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$settings->site_name = "Change Password";
		return View::make('home.user-change-password', array('menus'=>$menus,
															 'settings'=>$settings,
															 'google'=>$google,
															 'cart_count'=>$cart_count));
	}

	public function userUpdateChangePassword() {
		$client_id = Session::get('client_id');
		$password = Input::get('password');
		$password1 = Input::get('password1');
		$error = "";
		$success = "";
		if($password != $password1) {
			Session::flash('error',"Password and confirm password is not identical");
			return Redirect::to('/user-change-password');
		} else {
			//update password
			$clients = Client::where('fldClientID','=',$client_id)->first();
			$clients->fldClientPassword = Hash::make($password);
			$clients->save();

			Session::flash('success',"Password successfully changed");
			return Redirect::to('/user-change-password');
		}


	}

	public function testClient() {
		$client = new Client;
			$client->fldClientFirstname = "JohnT";
		$client->save();

		DB::setDefaultConnection('mysql1');
		$client = new Client;
			$client->fldClientFirstname = "JohnT";
		$client->save();
	}

	public function dashboard() {

		if(!Session::has('client_id'))
		{ return Redirect::to('/login');}
		$client_id = Session::get('client_id');
		$client = Client::find($client_id);
		//$cart = Cart::displayOrderHistory($client_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Dashboard";
		$pages->category = "customer";
		$pages->slug = "index";
		$settings = Settings::first();

		$cart = Cart::displayOrderHistoryDashboard($client_id);

		return View::make('dashboard.customer.index', array('client_id'=>$client_id,
													 'client' => $client,
													 'cart'=>$cart,
													 'pages'=>$pages,
													 'settings'=>$settings,
													 'cart'=>$cart));
	}

	public function profileEdit() {
		if(!Session::has('client_id')) { return Redirect::to('/login');}
		$client_id = Session::get('client_id');
		$client = Client::find($client_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Update Profile";
		$pages->category = "customer";
		$pages->slug = "edit-profile";
		$settings = Settings::first();

		if($client->fldClientBirthday != "0000-00-00") {
			$birthMonth = date('n',strtotime($client->fldClientBirthday));

			$birthDay = date('j',strtotime($client->fldClientBirthday));
			$birthYear = date('Y',strtotime($client->fldClientBirthday));
		} else {
			$birthMonth = "0";
			$birthDay = "0";
			$birthYear = "0";
		}

		$birthDate = [$birthMonth,$birthDay,$birthYear];


        $shipping = ClientShipping::where('fldClientsShippingClientID','=',$client_id)->first();
        $billing = ClientBilling::where('fldClientsBillingClientID','=',$client_id)->first();

        if($billing == null);
        {
            $billing = array();
        }
		require_once "../public/payment/braintree/lib/Braintree.php";
		\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);

		//$braintreeClient = BraintreeInformation::findClient($client->fldClientBraintreeCustomerID);
		//$braintreeMerchant = BraintreeInformation::findMerchant($client->fldClientBraintreeMerchantID);
		if($client->fldClientBraintreeCustomerID != "") {
			$braintreeClient = BraintreeInformation::findClient($client->fldClientBraintreeCustomerID);
		} else {
			$braintreeClient = "";
		}
		if($client->fldClientBraintreeMerchantID != "") {
			$braintreeMerchant = BraintreeInformation::findMerchant($client->fldClientBraintreeMerchantID);
		} else {
			$braintreeMerchant = "";
		}


        if(count($billing)==1) {

			if($client->fldClientAddress == "") {
				$client->fldClientAddress = $billing->fldClientsBillingAddress;
			}

			if($client->fldClientCity == "") {
				$client->fldClientCity = $billing->fldClientsBillingCity;
			}

			if($client->fldClientState == "") {
				$client->fldClientState = $billing->fldClientsBillingState;
			}

			if($client->fldClientZip == "") {
				$client->fldClientZip = $billing->fldClientsBillingZip;
			}


		}

			if(isset($braintreeMerchant->individual['address']['streetAddress'])) {
				$client->fldBankingAddress =  $braintreeMerchant->individual['address']['streetAddress'];
			} else {

				$client->fldBankingAddress = count($billing)==1 ? $billing->fldClientsBillingAddress : "";
			}

			if(isset($braintreeMerchant->individual['address']['locality'])) {
				$client->fldBankingCity = $braintreeMerchant->individual['address']['locality'];
			} else {
				$client->fldBankingCity = count($billing)==1 ?  $billing->fldClientsBillingCity : "";
			}

			if(isset($braintreeMerchant->individual['address']['region'])) {
				$client->fldBankingState = $braintreeMerchant->individual['address']['region'];
			} else {
				$client->fldBankingState = count($billing)==1 ? $billing->fldClientsBillingState : 0;
			}

			if(isset($braintreeMerchant->individual['address']['postalCode'])) {
				$client->fldBankingZip = $braintreeMerchant->individual['address']['postalCode'];
			} else {
				$client->fldBankingZip = count($billing)==1 ? $billing->fldClientsBillingZip : "";
			}



		return View::make('dashboard.customer.edit-profile', compact('client_id','client','pages','settings','birthDate','shipping','braintreeClient','braintreeMerchant','billing') );
	}

	public function profileUpdate() {

		if(!Session::has('client_id')) { return Redirect::to('/login');}
		$client_id = Session::get('client_id');

		$rules   = Client::rulesUpdateProfile($client_id);
		$validator = Validator::make(Input::all(), $rules[0],$rules[1]);

		if ($validator->fails()) {
			return Redirect::to('dashboard/customer/edit-profile')->withInput()->withErrors($validator,'updateProfile');
		} else {
			$clientEmailCheck = Client::where('fldClientEmail','=', Input::get('email'))
			                           ->where('fldClientID','!=',$client_id)
			                           ->where('fldClientCheckoutType','!=','Guest')
			                           ->count();
			$clientUsernameCheck = Client::where('fldClientUsername','=', Input::get('username'))
			                           ->where('fldClientID','!=',$client_id)
			                           ->where('fldClientCheckoutType','!=','Guest')
			                           ->count();

			if($clientUsernameCheck >= 1 && $clientEmailCheck >= 1) {
				if($clientEmailCheck >= 1) {
					Session::flash('emailError',"Email address already taken.");
				}

				if($clientUsernameCheck >= 1) {
					Session::flash('usernameError',"Username address already taken.");
				}

				return Redirect::to('/dashboard/customer/edit-profile');

			}  else {

			$client = Client::find($client_id);
				$client->fldClientFirstname = Input::get('firstname');
				$client->fldClientLastname = Input::get('lastname');
				$client->fldClientEmail = Input::get('email');
				$client->fldClientUsername = Input::get('username');
				$client->fldClientContact = Input::get('phone');
				$client->fldClientAddress = Input::get('address');
				$client->fldClientCity = Input::get('city');
				$client->fldClientState = Input::get('state');
				$client->fldClientZip = Input::get('zip');
				$client->fldClientCareer = Input::get('career');

				if(Input::get('password') != "") {
					$client->fldClientPassword = Hash::make(Input::get('password'));
				}

				$file = Input::file('image');
				if($file != "") {
					$client->fldClientImage = Client::uploadSingleImage($file,$client_id);
				}

				$client->fldClientAuthorization = Input::get('authorization');
				$client->fldClientMobileAlerts = Input::get('mobile_alerts_value');
				$client->fldClientEmailAlerts = Input::get('email_alerts_value');
				$client->fldClientBirthday = Input::get('birth_year') . '-' . Input::get('birth_month') . '-' . Input::get('birth_date');
			$client->save();

			//for shipping address
			//check if shipping client is already exist
			$shipping = ClientShipping::where('fldClientsShippingClientID','=',$client_id)->count();
			if($shipping == 0) {
				$shippingInfo = new ClientShipping;
				$shippingInfo->fldClientsShippingClientID = $client_id;
				$shippingInfo->fldClientsShippingFirstname = Input::get('firstname');
				$shippingInfo->fldClientsShippingLastname = Input::get('lastname');
				$shippingInfo->fldClientsShippingEmail = Input::get('email');
				$shippingInfo->fldClientsShippingPhone = Input::get('phone');
			} else {
				$shippingInfo = ClientShipping::where('fldClientsShippingClientID','=',$client_id)->first();
			}

				$shippingInfo->fldClientsShippingAddress = Input::get('shipping_address');
				$shippingInfo->fldClientsShippingCity = Input::get('shipping_city');
				$shippingInfo->fldClientsShippingState = Input::get('shipping_state');
				$shippingInfo->fldClientsShippingZip = Input::get('shipping_zip');
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
						 return Redirect::to('/dashboard/customer/edit-profile');
					} else {
						$client = Client::find($client_id);
							$client->fldClientBankName = Input::get('bank_name');
							$client->fldClientTypeofAccount = Input::get('type_of_account');
							$client->fldClientBraintreeMerchantID = $results->merchantAccount->id;
						$client->save();
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
						return Redirect::to('/dashboard/customer/edit-profile');
					} else {
						$client = Client::find($client_id);
						$client->fldClientCVV = Input::get('cvv');
						$client->fldClientBraintreeCustomerID = $results->customer->id;
						$client->save();
					}

				}
				*/

				Session::flash('success',"Profile was successfully saved.");
				return Redirect::to('/dashboard/customer/edit-profile');
				//reserve for braintree code
			}
		}


	}

	public function profile() {
		if(!Session::has('client_id')) { return Redirect::to('/login');}
		$client_id = Session::get('client_id');
		$client = Client::find($client_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Profile";
		$pages->category = "customer";
		$pages->slug = "profile";
		$settings = Settings::first();

		return View::make('dashboard.customer.profile', array('client_id'=>$client_id,
													 'client' => $client,
													 'pages'=>$pages,
													 'settings'=>$settings));

	}

	public function settings() {
		if(!Session::has('client_id')) { return Redirect::to('/login');}
		$client_id = Session::get('client_id');
		$client = Client::find($client_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Settings";
		$pages->category = "customer";
		$pages->slug = "settings";
		$settings = Settings::first();

		return View::make('dashboard.customer.settings', array('client_id'=>$client_id,
													 'client' => $client,
													 'pages'=>$pages,
													 'settings'=>$settings));
	}

	public function settingsUpdate() {
		if(!Session::has('client_id')) { return Redirect::to('/login');}
		$client_id = Session::get('client_id');
		$client = Client::find($client_id);

		$rules   = Client::rulesSettings($client_id);
		$validator = Validator::make(Input::all(), $rules[0],$rules[1]);

		if ($validator->fails()) {
			return Redirect::to('dashboard/customer/settings')->withInput()->withErrors($validator,'settings');
		} else {


			$clientEmailCheck = Client::where('fldClientEmail','=', Input::get('email'))
			                           ->where('fldClientID','!=',$client_id)
			                           ->where('fldClientCheckoutType','!=','Guest')
			                           ->count();

			if($clientEmailCheck == 0) {
				$mobile_alerts_value = Input::get('mobile_alerts_value');
				$email_alerts_value = Input::get('email_alerts_value');
				$email = Input::get('email');
				$password = Input::get('password');

				$client->fldClientMobileAlerts = $mobile_alerts_value;
				$client->fldClientEmailAlerts = $email_alerts_value;
				$client->fldClientEmail = $email;
				if($password != "") {$client->fldClientPassword=Hash::make($password);}

				$client->save();

					Session::flash('success',"Settings was successfully saved.");
					return Redirect::to('/dashboard/customer/settings');
				} else {
					Session::flash('success',"Email address is already taken.");
					return Redirect::to('/dashboard/customer/settings');
				}

		}
	}

	public function orderHistory() {
		if(!Session::has('client_id')) { return Redirect::to('/login');}
		$client_id = Session::get('client_id');
		$client = Client::find($client_id);
		$cart = Cart::displayOrderHistory($client_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Order History";
		$pages->category = "customer";
		$pages->slug = "order-history";
		$settings = Settings::first();



		return View::make('dashboard.customer.order-history', array('client_id'=>$client_id,
													 'client' => $client,
													 'cart'=>$cart,
													 'pages'=>$pages,
													 'settings'=>$settings,
													 'cart'=>$cart));
	}

	public function OrderHistoryDetails($orderNo) {
		if(!Session::has('client_id')) { return Redirect::to('/login');}
		$client_id = Session::get('client_id');
		$client = Client::find($client_id);

		//check if order no and client id is match
		$cartCheck = Cart::where('fldCartClientID','=',$client_id)
						 ->where('fldCartOrderNo','=',$orderNo)
						 ->count();

		if($cartCheck >= 1) {
			$cart = Cart::displayCart($orderNo);
			// $cartInfo = Cart::displayCheckout($orderNo);
			$data = Cart::displayCheckout($orderNo); // Gets the overall info common to every cart row

			settype($pages, 'object');
			$pages->fldPagesTitle = "Order History";
			$pages->category = "customer";
			$pages->slug = "order-history";
			$settings = Settings::first();
			//dd( $cart, $data);

			return View::make('dashboard.customer.order-history-details', compact('client_id','client','pages','settings','data','cart'));
			// return View::make('dashboard.customer.order-history-details', array('client_id'=>$client_id,
			// 										 'client' => $client,
			// 										 'pages'=>$pages,
			// 										 'settings'=>$settings,
			// 										 'data'=>$cartInfo,
			// 										 'cart'=>$cart));

		} else {
			Redirect::to('dashboard/customer/order-history');
		}
	}

	public function orderDetails($orderCode) {
		$orderInfo = Cart::where('fldCartOrderNo','=',$orderCode)->first();
		$product = Product::find($orderInfo->fldCartProductID);
		$clientShipping = ClientShipping::where('fldClientsShippingClientID','=',$orderInfo->fldCartClientID)->first();

		$orderInfo->fldAddress = $clientShipping->fldClientsShippingAddress . ' ' . $clientShipping->fldClientsShippingAddress1 . ', ' .
								 $clientShipping->fldClientsShippingCity . ' ' . $clientShipping->fldClientsShippingState . ' ' .
								 $clientShipping->fldClientsShippingZip;
		$orderInfo->orderDetails = $orderInfo->fldCartProductName . ' - ' .
								   Cart::getImageSize($orderInfo->fldCartImageSize) . ' - '.
								   Cart::getFrameAttributes($orderInfo->fldCartFrameDesc) . ' - '.
								   Cart::getPaperInfo($orderInfo->fldCartPaperInfo) . ' - ' .
								   Cart::getMat($orderCode);
		$orderInfo->fldProductDescription = $product->fldProductDescription;
		$orderInfo->fldCartOrderDate = date('m/d/Y',strtotime($orderInfo->fldCartOrderDate));
		$orderInfo->imageFrame = Cart::getReturnFrameImage($orderCode,$product->fldProductSlug,$product->fldProductImage);
		return $orderInfo;
	}

	public function get_client_by_email(){
		$this_client_email = Input::get('client_email');
		$this_client_obj = Client::where('fldClientEmail','=',$this_client_email)->count();
		return json_encode($this_client_obj);
	}

	public function logout() {

		Session::flush();
		return Redirect::to('/dashboard/customer');
	}
}
