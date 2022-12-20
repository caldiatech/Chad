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
use App\Models\ManagerShipping;
use App\Models\BraintreeInformation;
use App\Models\ManagerCommission;
use App\Models\Cart;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Mail;
use Validator;
use Illuminate\Support\Str;

class ManagerController extends Controller
{
    public function getIndex()
    {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$manager = Manager::where('fldManagerType','=',1)->orderBy('fldManagerID','DESC')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$managerClass = 'class=active';

		foreach($manager as $managers) {
			//check commission
			$commission = ManagerCommission::calculateCommissionYearAdmin($managers->fldManagerID);
			$managers->fldManagerCommission = $commission;
			// echo 'comm: '.$commission.'<br>';
		}

		// die('Ln45');

		$pageTitle = SALESMANAGER_MANAGEMENT;

	    return View::make('_admin.manager.manager', array('manager' => $manager,'administrator'=>$administrator,'managerClass'=>$managerClass,'pageTitle'=>$pageTitle));
    }


	public function getSales($manager_id) {
    	if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$manager = Manager::find($manager_id);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();

		$dateFrom = date('Y-1-1');
		$dateTo = date('Y-12-31');

		$cart = ManagerCommission::salesActivities($manager_id);
		//print_r($cart);die();
		$managerClass = 'class=active';
		$pageTitle = SALESMANAGER_MANAGEMENT;
		return View::make('_admin.manager.sales', compact('manager','administrator','managerClass','cart','pageTitle'));
	}


	public function getNew()
   {
	   	//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$managerClass = 'class=active';

		$try = "N";
		while($try=="N") {

			$length = 4;
		    $characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
			$promocode = 'TR'.$randomString;

			$managerPromo = Manager::where('fldManagerPromoCode','=',$promocode)->count();
			if($managerPromo == 0) {
				$try = "Y";
			} else {
				$try = "N";
			}
		}

		  // while($try=="N") {
		  //  $promocode = 'TR'.Str::random(4);
		  //  // $promocode = 'MGR'.Str::random(4); # changed by abustillo limit promocode to 6 characters
		  //  $managerPromo = Manager::where('fldManagerPromoCode','=',$promocode)->count();
		  //  if($managerPromo == 0) {
		  //   $try = "Y";
		  //  } else {
		  //   $try = "N";
		  //  }
		  // }

		$pageTitle = SALESMANAGER_MANAGEMENT;
   		return View::make('_admin.manager.manager_add',array('administrator'=>$administrator,
   															'promocode'=>$promocode,
   														   'managerClass'=>$managerClass,
   														   'pageTitle'=>$pageTitle));
   	}


   public function postNew() {

		$rules   = Manager::rules(0);
		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails()) {
		    return Redirect::to('dnradmin/manager/new')->withInput()->withErrors($validator,'manager');
		} else {
	  	   $password = Hash::make(Input::get('password'));
		   $manager = new Manager;
		   $manager->fldManagerFirstname = Input::get('firstname');
		   $manager->fldManagerLastname = Input::get('lastname');
		   $manager->fldManagerEmail = Input::get('email');
		   $manager->fldManagerPassword = $password;
		   $manager->fldManagerPhoneNo = Input::get('phone');
		   $manager->fldManagerGender = Input::get('gender');
		   $manager->fldManagerBirthDate = Input::get('bday');
		   $manager->fldManagerAddress = Input::get('address');
		   $manager->fldManagerPromoCode = Input::get('promocode');
		   $manager->fldManagerStatus = Input::get('status');
		   $manager->fldManagerType = 1;
		   $manager->save();

			//send email to owner
			$messageData = array(
				'firstname' => Input::get('firstname'),
				'lastname' => Input::get('lastname'),
				'status' => Input::get('status'),
				'email' => Input::get('email'),
				'phone'=>Input::get('phone'),
				'password' => Input::get('password')
			);

			$settings = Settings::first();

		 	// Email Manager and Cc Web Admin + DNR Admin
	  		Mail::send('home.email_manager_registration', $messageData, function ($message) use($settings) {
				$message->from(EmailFrom, EmailFromName);
				$message->to(Input::get('email'),Input::get('firstname') . ' ' . Input::get('lastname'));
				$message->cc(EmailTo3, EmailToName3);
				//$message->cc(EmailTo2, EmailToName2);
				$message->bcc('buumber@gmail.com', 'Valuecom Dev');
				//$message->bcc('dennis@dogandrooster.com', 'DNR Dev');
				//$message->bcc('programmer1@dogandrooster.com', 'DNR Admin');
				$message->subject("Welcome to Clarkin!");
			});

		   Session::flash('success',"Manager was successfully saved.");
		   return Redirect::to('dnradmin/manager/new');
		}

   }


   public function getEdit($id) {
	   //if not login redirect to login page

		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

	   $manager =  Manager::where('fldManagerID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
	   $managerClass = 'class=active';

        require_once "public/payment/braintree/lib/Braintree.php";
		\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);

	       if($manager->fldManagerBraintreeCustomerID != "") {
			$braintreeClient = BraintreeInformation::findClient($manager->fldManagerBraintreeCustomerID);
		} else {
			$braintreeClient = "";
		}
		if($manager->fldManagerBrainTreeMerchantID != "") {
			$braintreeMerchant = BraintreeInformation::findMerchant($manager->fldManagerBrainTreeMerchantID);
		} else {
			$braintreeMerchant = "";
		}

	   	$pageTitle = SALESMANAGER_MANAGEMENT;
	    return View::make('_admin.manager.manager_edit', array('manager' => $manager,'administrator'=>$administrator,'managerClass'=>$managerClass,'braintreeClient'=>$braintreeClient,'braintreeMerchant'=>$braintreeMerchant,'pageTitle'=>$pageTitle));
   }

   public function postEdit($id) {
   	$rules   = Manager::rules($id);
	$validator = Validator::make(Input::all(), $rules);

	 if ($validator->fails()) {
		return Redirect::to('dnradmin/manager/edit/'.$id)->withInput()->withErrors($validator,'manager');
	 } else {
		   $manager = Manager::find($id);
		   $manager->fldManagerFirstname = Input::get('firstname');
		   $manager->fldManagerLastname = Input::get('lastname');
		   $manager->fldManagerEmail = Input::get('email');
		   $manager->fldManagerPhoneNo = Input::get('phone');
		   $manager->fldManagerGender = Input::get('gender');
		   $manager->fldManagerBirthDate = Input::get('bday');
		   $manager->fldManagerAddress = Input::get('address');

		   $previousStatus = $manager->fldManagerStatus;
		   $manager->fldManagerStatus = Input::get('status');

		   if(Input::get('password') != "") {
		   	   $password = Hash::make(Input::get('password'));
			   $manager->fldManagerPassword = $password;
		   }

		   if($previousStatus == 1 && Input::get('status') == 2) {
		   	  	// Email Manager sign up
		   		$settings = Settings::first();
		   		$messageData = array("firstname"=>$manager->fldManagerFirstname,"lastname"=>$manager->fldManagerLastname,"email"=>$manager->fldManagerEmail);
		   	  	Mail::send('home.emails.manager.activate', $messageData, function ($message) use($settings,$manager) {

					// $ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
					// $ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

					$message->from(EmailFrom, EmailFromName);
					$message->to($manager->fldManagerEmail, $manager->fldManagerFirstname . ' ' . $manager->fldManagerLastname);
					$message->cc(EmailTo3, EmailToName3);
					//$message->cc(EmailTo2, EmailToName2);
					$message->bcc('buumber@gmail.com', 'Valuecom Dev');
					//$message->bcc('dennis@dogandrooster.com', 'DNR Admin 1');
					//$message->bcc('programmer1@dogandrooster.com', 'DNR Admin 3');
					$message->subject("Welcome to Clarkin - Account Activation");
				});

		   }

		   $manager->save();
		   Session::flash('success',"Manager was successfully updated.");
		   return Redirect::to('dnradmin/manager/edit/'.$id);
	 }


   }

    public function getDelete($id) {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$manager = Manager::find($id);

		if(empty($manager)) {
			return Redirect::to('dnradmin/manager');
			exit();
		}

		$manager->delete();

		return Redirect::to('dnradmin/manager');


	}

	public function newSalesRegistration() {
		$rules   = Manager::rulesRegistration();
		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails()) {
		    return Redirect::to('sales-registration')->withInput()->withErrors($validator,'manager');
		} else {

			$promocode = strtoupper('TR'.Str::random(4));

			$password = Hash::make(Input::get('password'));
			$manager = new Manager;
			$manager->fldManagerFirstname = Input::get('firstname');
			$manager->fldManagerLastname = Input::get('lastname');
			$manager->fldManagerEmail = Input::get('email');
			$manager->fldManagerPassword = $password;
			$manager->fldManagerPhoneNo = Input::get('phone');
			$manager->fldManagerStatus = 1;
			$manager->fldManagerPromoCode = $promocode;
			$manager->fldManagerType = 1;
			$manager->save();

			//send email to owner
			$messageData = array(
				'firstname' => Input::get('firstname'),
				'lastname' => Input::get('lastname'),
				'email' => Input::get('email'),
				'status' => 1,
				'phone'=>Input::get('phone'),
				'password' => Input::get('password')
			);

			$settings = Settings::first();

		 	// Email Manager and Cc Web Admin + DNR Admin
	  		Mail::send('home.email_manager_registration', $messageData, function ($message) use($settings) {

				$message->from(EmailFrom, EmailFromName);
				$message->to(Input::get('email'),Input::get('firstname') . ' ' . Input::get('lastname'));
				$message->cc(EmailTo3, EmailToName3);
				//$message->cc(EmailTo2, EmailToName2);
				$message->bcc('buumber@gmail.com', 'Valuecom Dev');
				//$message->bcc('dennis@dogandrooster.com', 'DNR Admin 1');
				//$message->bcc('programmer1@dogandrooster.com', 'DNR Admin 3');
				$message->subject("Welcome to Clarkin");
			});

			// Mail::send('home.email_manager_registration_owner', $messageData, function ($message) use($settings) {
			// 	$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
			// 	$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;
			// 	$message->from(EmailFrom, Input::get('firstname') . ' ' . Input::get('lastname'));
			// 	$message->to($ownerEmail,$ownerName)->subject("Clarkin: New Sales Manager");
			// });

		   Session::flash('success',"You have been successfully registered. Our representative will contact you as soon as possible.");
		   return Redirect::to('sales-registration');
		}
	}


	public function salesLogin() {

		$email = Input::get('email');

		$manager = Manager::where('fldManagerEmail','=',$email)->first();

		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();

        $rules   	= Manager::rulesLogin();
		$validator 	= Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

			return Redirect::to('sales-login')->withInput()->withErrors($validator,'login');

		} else if(empty($manager)) {

			Session::flash('error',"Account does not exist. Please register.");
			return Redirect::to('sales-login');

		} else {

			//check if the username and password is same
			if (Hash::check(Input::get('password'), $manager->fldManagerPassword)) {
				// Check if status is 2 (Active)
				if ($manager->fldManagerStatus == 2) { // Active
					Session::put('manager_id', $manager->fldManagerID);
					return Redirect::to('/dashboard/sales');
				} else { // Pending status
					Session::flash('error',"Account Pending Activation. Please contact administrator.");
					return Redirect::to('sales-login');
				}

			} else { // Wrong Password
				Session::flash('error',"Invalid username or password.");
				return Redirect::to('sales-login');
			}
		}
	}


    public function forgotPassword() {
		$email = Input::get('email');

		$manager = Manager::where('fldManagerEmail','=',$email)
							->where('fldManagerStatus','=',2)
							->first();

		if(empty($manager)) {
			Session::flash('error-forgot',"Email Address not found.");
			return Redirect::to('sales-login');
		} else {
			$manager->fldManagerHashSecurity = Session::getId();
			$manager->save();

			//send email to client goes here for the email confirmation and include also the links of new password form
			//send email code goes here
			$messageData = array(
				'security' => Session::getId(),
				'name' => $manager->fldManagerFirstname
			);

			$settings = Settings::first();

	  		Mail::send('home.emails.manager.forgot_password', $messageData, function ($message) use($settings) {

				$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
				$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

				$message->from(EmailFrom, EmailFromName);
				$message->to(Input::get('email'))->subject("Forgot Password");
			});

		  	//end send mail
			Session::flash('sales-forgot-success',"Success.");
			return Redirect::to('sales-login');
		}
	}


	public function newPassword($hash) {
		$manager = Manager::where('fldManagerHashSecurity','=',$hash)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$pages = Pages::find(46);
		return View::make('home.sales-reset-password', array('menus'=>$menus,
												       'category'=>$category,
												       'manager' => $manager,
												       'settings'=>$settings,
												       'google'=>$google,
												       'pages'=>$pages,
												       'cart_count'=>$cart_count));

	}

	public function resetPassword() {
		$password = Input::get('password');
		$password1 = Input::get('password1');
		$manager_id = Input::get('manager_id');
		$hash = Input::get('hash');

		$rules   = Manager::rulesResetPassword();
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('sales-new-password/'.$hash)->withInput()->withErrors($validator,'resetpassword');
		} else {
				$manager = Manager::where('fldManagerID','=',$manager_id)->first();

					//reset password
					$manager->fldManagerPassword = Hash::make($password);
					$manager->save();

					$messageData = array(
							'firstname' => $manager->fldManagerFirstname,
							'username' => $manager->fldManagerEmail,
							'password' => $password
						);


						$settings = Settings::first();

				  		Mail::send('home.emails.manager.success_reset', $messageData, function ($message) use($settings,$manager) {

							$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
							$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

							$message->from(EmailFrom, EmailFromName);
							$message->to($manager->fldManagerEmail)->subject("Reset Password");
						});

					Session::flash('sales-reset-success',"Success.");
					return Redirect::to('sales-login');
		}
	}

	 public function dashboard() {
	 	if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);
		//$cart = Cart::displayOrderHistory($client_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Dashboard";
		$pages->category = "sales";
		$pages->slug = "index";
		$settings = Settings::first();

		//$cart = Cart::displayOrderHistoryDashboard($client_id);

		$cart = ManagerCommission::displayOrdersCommission($manager_id);
		return View::make('dashboard.sales.index', array('manager_id'=>$manager_id,
			 'manager' => $manager,
			 'pages'=>$pages,
			 'settings'=>$settings,
			 'cart'=>$cart
			));
	 }

	 public function profile() {
	 	if(!Session::has('manager_id')) { return Redirect::to('/login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Profile";
		$pages->category = "sales";
		$pages->slug = "profile";
		$settings = Settings::first();

		return View::make('dashboard.sales.profile', array('manager_id'=>$manager_id,
													 'manager' => $manager,
													 'pages'=>$pages,
													 'settings'=>$settings));
	 }

	 public function profileEdit() {
		if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Update Profile";
		$pages->category = "sales";
		$pages->slug = "edit-profile";
		$settings = Settings::first();

		$birthMonth = date('n',strtotime($manager->fldManagerBirthDate));
		$birthDay = date('j',strtotime($manager->fldManagerBirthDate));
		$birthYear = date('Y',strtotime($manager->fldManagerBirthDate));

		$birthDate = [$birthMonth,$birthDay,$birthYear];

     		$shipping = ManagerShipping::where('fldManagerShippingClientID','=',$manager_id)->first();

		require_once "public/payment/braintree/lib/Braintree.php";
		\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);
		//$braintreeClient = BraintreeInformation::findClient($manager->fldManagerBraintreeCustomerID);
		//$braintreeMerchant = BraintreeInformation::findMerchant($manager->fldManagerBrainTreeMerchantID);
		//print_r($braintreeMerchant );die();

		if($manager->fldManagerBraintreeCustomerID != "") {
			$braintreeClient = BraintreeInformation::findClient($manager->fldManagerBraintreeCustomerID);
		} else {
			$braintreeClient = "";
		}

		if($manager->fldManagerBrainTreeMerchantID != "") {
			$braintreeMerchant = BraintreeInformation::findMerchant($manager->fldManagerBrainTreeMerchantID);
		} else {
			$braintreeMerchant = "";
		}

     		return View::make('dashboard.sales.edit-profile', compact('manager_id','manager','pages','settings','birthDate','shipping','braintreeClient','braintreeMerchant'));
	 }

	public function updateProfile() {

	 	if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}

		$manager_id = Session::get('manager_id');

		$rules   = Manager::rulesUpdateProfile($manager_id);
		$validator = Validator::make(Input::all(), $rules[0],$rules[1]);

		if ($validator->fails()) {
			Session::flash('error',"Error in saving. See info below.");
			return Redirect::to('dashboard/sales/edit-profile')->withInput()->withErrors($validator,'updateProfile');
		} else {

			$manager = Manager::find($manager_id);
			$manager->fldManagerFirstname = Input::get('firstname');
			$manager->fldManagerLastname = Input::get('lastname');
			$manager->fldManagerEmail = Input::get('email');
			//$manager->fldClientUsername = Input::get('username');
			$manager->fldManagerPhoneNo = Input::get('phone');
			$manager->fldManagerAddress = Input::get('address');
			$manager->fldManagerCity = Input::get('city');
			$manager->fldManagerState = Input::get('state');
			$manager->fldManagerZip = Input::get('zip');
			$manager->fldManagerProfession = Input::get('career');

			if(Input::get('password') != "") {
				$manager->fldManagerPassword = Hash::make(Input::get('password'));
			}

			$file = Input::file('image');
			if($file != "") {
				$manager->fldManagerImage = Manager::uploadSingleImage($file,$manager_id);
			}

			$manager->fldManagerAuthorization = Input::get('authorization');
			$manager->fldManagerMobileAlerts = Input::get('mobile_alerts_value');
			$manager->fldManagerEmailAlerts = Input::get('email_alerts_value');
			$manager->fldManagerBirthDate = Input::get('birth_year') . '-' . Input::get('birth_month') . '-' . Input::get('birth_date');

			$manager->fldManagerBankName 			= Input::get('bank_name');
			$manager->fldManagerBankAccountNumber 	= Input::get('account_no');
			$manager->fldManagerTypeofAccount 		= Input::get('type_of_account');
			$manager->fldManagerBankRoutingNumber 	= Input::get('routing_no');
			$manager->fldManagerBankAddress1 		= Input::get('banking_street');
			$manager->fldManagerBankCity 			= Input::get('banking_city');
			$manager->fldManagerBankState 			= Input::get('banking_state');
			$manager->fldManagerBankZIP 			= Input::get('banking_zip');

			$manager->save();

			//for shipping address
			//check if shipping client is already exist
			$shipping = ManagerShipping::where('fldManagerShippingClientID','=',$manager_id)->count();
			if($shipping == 0) {
				$shippingInfo = new ManagerShipping;
				$shippingInfo->fldManagerShippingClientID = $manager_id;
				$shippingInfo->fldManagerShippingFirstname = Input::get('firstname');
				$shippingInfo->fldManagerShippingLastname = Input::get('lastname');
				$shippingInfo->fldManagerShippingEmail = Input::get('email');
				$shippingInfo->fldManagerShippingPhone = Input::get('phone');
			} else {
				$shippingInfo = ManagerShipping::where('fldManagerShippingClientID','=',$manager_id)->first();
			}

			$shippingInfo->fldManagerShippingAddress = Input::get('shipping_address');
			$shippingInfo->fldManagerShippingCity = Input::get('shipping_city');
			$shippingInfo->fldManagerShippingState = Input::get('shipping_state');
			$shippingInfo->fldManagerShippingZip = Input::get('shipping_zip');
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
					return Redirect::to('/dashboard/sales/edit-profile');
				} else {
					$manager = Manager::find($manager_id);
					$manager->fldManagerBankName = Input::get('bank_name');
					$manager->fldManagerTypeofAccount = Input::get('type_of_account');
					$manager->fldManagerBrainTreeMerchantID = $results->merchantAccount->id;
					$manager->save();
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
					return Redirect::to('/dashboard/sales/edit-profile');
				} else {
					$manager = Manager::find($manager_id);
					$manager->fldManagerCVV = Input::get('cvv');
					$manager->fldManagerBraintreeCustomerID = $results->customer->id;
					$manager->save();
				}

			}
			*/

			Session::flash('success',"Profile was successfully saved.");
			return Redirect::to('/dashboard/sales/edit-profile');
		}
	 }


	public function accounts() {
	 	if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Accounts";
		$pages->category = "sales";
		$pages->slug = "accounts";
		$settings = Settings::first();

		$birthMonth = date('n',strtotime($manager->fldManagerBirthDate));
		$birthDay = date('j',strtotime($manager->fldManagerBirthDate));
		$birthYear = date('Y',strtotime($manager->fldManagerBirthDate));

		$birthDate = [$birthMonth,$birthDay,$birthYear];

		require_once "public/payment/braintree/lib/Braintree.php";
		\Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
		\Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
		\Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
		\Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);
		//$braintreeClient = BraintreeInformation::findClient($manager->fldManagerBraintreeCustomerID);
		//$braintreeMerchant = BraintreeInformation::findMerchant($manager->fldManagerBrainTreeMerchantID);
		if($manager->fldManagerBraintreeCustomerID != "") {
			$braintreeClient = BraintreeInformation::findClient($manager->fldManagerBraintreeCustomerID);
		} else {
			$braintreeClient = "";
		}
		if($manager->fldManagerBrainTreeMerchantID != "") {
			$braintreeMerchant = BraintreeInformation::findMerchant($manager->fldManagerBrainTreeMerchantID);
		} else {
			$braintreeMerchant = "";
		}

     		return View::make('dashboard.sales.accounts', compact('manager','pages','settings','birthDate','braintreeClient','braintreeMerchant'));
	 }

	public function updateAccounts() {
	 	 $manager_id = Session::get('manager_id');

		$rules   = Manager::rulesUpdateAccounts($manager_id);
		$validator = Validator::make(Input::all(), $rules[0],$rules[1]);

		if ($validator->fails()) {
			return Redirect::to('dashboard/sales/accounts')->withInput()->withErrors($validator,'accounts');
		} else {

			$manager = Manager::find($manager_id);

			$manager->fldManagerEmail = Input::get('email');

			if(Input::get('password') != "") {
				$manager->fldManagerPassword = Hash::make(Input::get('password'));
			}

			$manager->fldManagerBankName 			= Input::get('bank_name');
			$manager->fldManagerTypeofAccount 		= Input::get('type_of_account');
			$manager->fldManagerBankAccountNumber 	= Input::get('account_no');
			$manager->fldManagerBankRoutingNumber 	= Input::get('routing_no');
			$manager->fldManagerBankAddress1 		= Input::get('banking_street');
			$manager->fldManagerBankCity 			= Input::get('banking_city');
			$manager->fldManagerBankState 			= Input::get('banking_state');
			$manager->fldManagerBankZIP 			= Input::get('banking_zip');

			$manager->save();

			// require_once "public/payment/braintree/lib/Braintree.php";
			// \Braintree_Configuration::environment(BRAINTREE_ENVIRONMENT);
			// \Braintree_Configuration::merchantId(BRAINTREE_MERCHANTID);
			// \Braintree_Configuration::publicKey(BRAINTREE_PUBLICKEY);
			// \Braintree_Configuration::privateKey(BRAINTREE_PRIVATEKEY);

			// if(is_numeric(Input::get('account_no'))) {
			// 	$bank_name = Input::get('bank_name');
			// 	$account_no = Input::get('account_no');
			// 	$type_of_account = Input::get('type_of_account');
			// 	$routing_no = Input::get('routing_no');
			// 	$banking_street = Input::get('banking_street');
			// 	$banking_city = Input::get('banking_city');
			// 	$banking_state = Input::get('banking_state');
			// 	$banking_zip = Input::get('banking_zip');

			// 	$dateOfBirth = $manager->fldManagerBirthDate;

			// 	$params = [$manager->fldManagerFirstname,$manager->fldManagerLastname,$manager->fldManagerEmail,$manager->fldManagerPhoneNo,$banking_street,
			// 				$banking_zip,$banking_city,$banking_state,$dateOfBirth,$routing_no,$account_no];
			// 	$results= BraintreeInformation::createSubMerchant($params);


			// 	if($results->success == "") {
			// 		 $message = $results->message;
			// 		 Session::flash('braintree-error',"Banking Information: ".$message);
			// 		 return Redirect::to('/dashboard/sales/accounts');
			// 	} else {
			// 		$manager = Manager::find($manager_id);
			// 		$manager->fldManagerBankName = Input::get('bank_name');
			// 		$manager->fldManagerTypeofAccount = Input::get('type_of_account');
			// 		$manager->fldManagerBrainTreeMerchantID = $results->merchantAccount->id;
			// 		$manager->save();
			// 	}

			// }

			// //for create client in braintree use for payment
			// if(is_numeric(Input::get('cc_no'))) {
			// 	$cc_firstname = Input::get('cc_firstname');
			// 	$cc_lastname = Input::get('cc_lastname');
			// 	$cc_no = Input::get('cc_no');
			// 	$cvv = Input::get('cvv');
			// 	$cc_exp_mm = Input::get('cc_exp_mm');
			// 	$bcc_exp_yy = Input::get('bcc_exp_yy');

			// 	$params = [$cc_firstname,$cc_lastname,$manager->fldManagerEmail,$cc_no,$cc_exp_mm,$bcc_exp_yy,$cvv];

			// 	$results = BraintreeInformation::createClient($params);

			// 	if($results->success == "") {
			// 		 $message = $results->message;
			// 		  Session::flash('braintree-error',"Credit Card Information: ".$message);
			// 		 return Redirect::to('/dashboard/sales/accounts');
			// 	} else {
			// 		$manager = Manager::find($manager_id);
			// 			$manager->fldManagerCVV = Input::get('cvv');
			// 			$manager->fldManagerBraintreeCustomerID = $results->customer->id;
			// 		$manager->save();
			// 	}

			// }


			Session::flash('success',"Account was successfully saved.");
			return Redirect::to('/dashboard/sales/accounts');
		}
	 }

	public function settings() {
	 	if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Settings";
		$pages->category = "sales";
		$pages->slug = "settings";
		$settings = Settings::first();

     		return View::make('dashboard.sales.settings', compact('manager','pages','settings'));
	 }

	public function settingsUpdate() {
	 	if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');

		$rules   = Manager::rulesUpdateAccounts($manager_id);
		$validator = Validator::make(Input::all(), $rules[0],$rules[1]);

		if ($validator->fails()) {
			return Redirect::to('dashboard/sales/settings')->withInput()->withErrors($validator,'settings');
		} else {
			$manager = Manager::find($manager_id);
			$manager->fldManagerEmail = Input::get('email');

				if(Input::get('password') != "") {
					$manager->fldManagerPassword = Hash::make(Input::get('password'));
				}

			$manager->fldManagerMobileAlerts = Input::get('mobile_alerts_value');
			$manager->fldManagerEmailAlerts = Input::get('email_alerts_value');

			$manager->save();

			Session::flash('success',"Settings was successfully saved.");
			return Redirect::to('/dashboard/sales/settings');
		}
	 }

	public function couponCodes() {
	 	if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Coupon Codes";
		$pages->category = "sales";
		$pages->slug = "coupon-codes";
		$settings = Settings::first();

		$registrationDate = $manager->fldManagerRegistrationDate;

		$todaysDate = date('Y-m-d', strtotime('+1 years'));
		//echo $todaysDate;


		$datetime1 = new \DateTime($registrationDate);
		$datetime2 = new \DateTime($todaysDate);
		$interval = $datetime1->diff($datetime2);
		$intervalDays = $interval->format('%a');
	        $computeDaysLeft = 365 - (($intervalDays - 365));

	     	return View::make('dashboard.sales.coupon-codes', compact('manager','pages','settings','computeDaysLeft'));
	 }

	public function salesActivities() {
	 	if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Sales Activities";
		$pages->category = "sales";
		$pages->slug = "sales-activities";
		$settings = Settings::first();

		$cart = ManagerCommission::salesActivities($manager_id);

		return View::make('dashboard.sales.sales-activities', compact('manager','pages','settings','cart'));
	 }

	public function orderHistory() {
	 	if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Order History";
		$pages->category = "sales";
		$pages->slug = "order-history";
		$settings = Settings::first();

		$dateFrom = date('Y-1-1');
		$dateTo = date('Y-12-31');

		$cart = ManagerCommission::displayOrdersCommissionByDateOrderHistory($manager_id,$dateFrom,$dateTo);

		return View::make('dashboard.sales.order-history', compact('manager','pages','settings','cart'));
	 }

	public static function orderDetails($orderNo) {
	 	$manager_id = Session::get('manager_id');

	 	$orderInfo = ManagerCommission::displayOrdersCommissionByOrderNo($manager_id,$orderNo);

	 	$orderInfo->orderDetails =  $orderInfo->product_name . ' - ' .
	 							   Cart::getImageSize($orderInfo->fldCartImageSize) . ' - '.
								   Cart::getFrameAttributes($orderInfo->fldCartFrameDesc) . ' - '.
								   Cart::getPaperInfo($orderInfo->fldCartPaperInfo) . ' - ' .
								   Cart::getMat($orderNo);

		$orderInfo->fldCartOrderDate = date('m/d/Y',strtotime($orderInfo->order_date));
		$orderInfo->imageFrame = Cart::getReturnFrameImage($orderNo,$orderInfo->fldProductSlug,$orderInfo->image);

	 	return $orderInfo;
	 }

	 public function logout() {
		Session::flush();
		return Redirect::to('/dashboard/sales');
	}

	public function salesRep() {
		if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "Sales Rep";
		$pages->category = "sales";
		$pages->slug = "sales-rep";
		$settings = Settings::first();

		$salesrep = Manager::where('fldManagerType','=',2)
							->where('fldManagerMainID','=',$manager_id)
							->get();

		return View::make('dashboard.sales.sales-rep', compact('manager','pages','settings','salesrep'));
	}

	public function salesRepNew() {

		if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		settype($pages, 'object');
		$pages->fldPagesTitle = "New Sales Rep";
		$pages->category = "sales";
		$pages->slug = "sales-rep";
		$settings = Settings::first();

		return View::make('dashboard.sales.sales-rep-new', compact('manager','pages','settings'));
	}

	public function salesRepSave() {
		if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		$rules   = Manager::rulesSalesRep(0);
		$validator = Validator::make(Input::all(), $rules[0],$rules[1]);

		if ($validator->fails()) {
			return Redirect::to('dashboard/sales/sales-rep/new')->withInput()->withErrors($validator,'salesrep');
		} else {
			$password = HASH::make(Input::get('password'));
			$promocode = strtoupper('SR'.Str::random(4));

			$salesRep = new Manager;
				$salesRep->fldManagerFirstname = Input::get('firstname');
				$salesRep->fldManagerLastname = Input::get('lastname');
				$salesRep->fldManagerEmail = Input::get('email');
				$salesRep->fldManagerPhoneNo = Input::get('phone');
				$salesRep->fldManagerPassword = $password;
				$salesRep->fldManagerRegistrationDate = date('Y-m-d');
				$salesRep->fldManagerType = 2;
				$salesRep->fldManagerMainID = $manager_id;
				$salesRep->fldManagerPromoCode = $promocode;
				$salesRep->fldManagerStatus = 2;
			$salesRep->save();

			//send email to sales rep
			$messageData = array(
							'firstname' => $salesRep->fldManagerFirstname,
							'lastname' => $salesRep->fldManagerLastname,
							'phone' => $salesRep->fldManagerPhoneNo,
							'username' => $salesRep->fldManagerEmail,
							'manager' =>$manager->fldManagerFirstname . ' ' . $manager->fldManagerLastname,
							'password' => $password
			);


			$settings = Settings::first();

			Mail::send('home.emails.sales_rep.welcome', $messageData, function ($message) use($settings,$salesRep) {

							$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
							$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

							$message->from(EmailFrom, EmailFromName);
							$message->to($salesRep->fldManagerEmail,$salesRep->fldManagerFirstname . ' ' . $salesRep->fldManagerLastname)->subject("Welcome to Clarkin");
			});

			 Session::flash('success',"Sales Rep was successfully added.");
		   	return Redirect::to('dashboard/sales/sales-rep/new');


		}
	}

	public function salesRepEdit($id) {
		if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		//check sales rep manager if valid
		$salesRepManager = Manager::where('fldManagerID','=',$id)
								->where('fldManagerMainID','=',$manager_id)
								->count();
		if($salesRepManager == 0)	{
			 Session::flash('error',"Invalid Sales Rep Access. This Sales Rep belongs to different Manager.");
		   	 return Redirect::to('dashboard/sales/sales-rep');
		} else {
			$salesRep = Manager::find($id);
			settype($pages, 'object');
			$pages->fldPagesTitle = "New Sales Rep";
			$pages->category = "sales";
			$pages->slug = "sales-rep";
			$settings = Settings::first();

			return View::make('dashboard.sales.sales-rep-edit', compact('manager','pages','settings','salesRep'));
		}
	}

	public function salesRepUpdate($id) {
		if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		$rules   = Manager::rulesSalesRep($id);
		$validator = Validator::make(Input::all(), $rules[0],$rules[1]);

		if ($validator->fails()) {
			return Redirect::to('dashboard/sales/sales-rep/edit/'.$id)->withInput()->withErrors($validator,'salesrep');
		} else {
			$salesRep = Manager::find($id);
				$salesRep->fldManagerFirstname = Input::get('firstname');
				$salesRep->fldManagerLastname = Input::get('lastname');
				$salesRep->fldManagerEmail = Input::get('email');
				$salesRep->fldManagerPhoneNo = Input::get('phone');
				if(Input::get('password') != "") {
					$password = HASH::make(Input::get('password'));
					$salesRep->fldManagerPassword = $password;
				}
			$salesRep->save();

			 Session::flash('success',"Sales Rep was successfully updated.");
		   	return Redirect::to('dashboard/sales/sales-rep/edit/'.$id);
		}
	}

	public function salesRepDelete($id) {
		if(!Session::has('manager_id')) { return Redirect::to('/sales-login');}
		$manager_id = Session::get('manager_id');
		$manager = Manager::find($manager_id);

		//check sales rep manager if valid
		$salesRepManager = Manager::where('fldManagerID','=',$id)
								->where('fldManagerMainID','=',$manager_id)
								->count();
		if($salesRepManager == 0)	{
			 Session::flash('error',"Invalid Sales Rep Access. This Sales Rep belongs to different Manager.");
		   	 return Redirect::to('dashboard/sales/sales-rep');
		} else {
			$salesRep = Manager::find($id);
			$salesRep->delete();
			return Redirect::to('dashboard/sales/sales-rep');
		}
	}


	// //For Registration page functionality
	// public function newClient() {


	//    $emailCheck = Manager::where('fldManagerEmail','=',Input::get('email'))->first();

	//    $menus = Pages::where('fldPagesMainID', '=', 0)->get();
	//    $category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();

	//    $data = Input::all();

	//    if($emailCheck) {
	// 	   $error = 1;
	// 	   return View::make('home.registration', array('menus'=>$menus,'category'=>$category,'email_error' => $error,'data'=>$data));
	//    } else {
	// 		   $manager = new Manager;
	// 		   $manager->fldManagerFirstname = Input::get('firstname');
	// 		   $manager->fldManagerLastname = Input::get('lastname');
	// 		   $manager->fldManagerEmail = Input::get('email');
	// 		   $manager->fldManagerPhoneNo = Input::get('phone');
	// 		   $manager->fldManagerGender = Input::get('gender');
	// 		   $manager->fldManagerBirthDate = Input::get('birthdate');
	// 		   $manager->fldManagerAddress = Input::get('address');
	// 		   $password = Hash::make(Input::get('password'));
	// 		   $manager->fldManagerPassword = $password;
	// 		   $manager->save();

	// 		  $client_id = Session::has('client_id') ? Session::has('client_id') : Session::getId();
	// 		  $order_date = date('Y-m-d');
	// 		  //check if temp cart have records based on session id
	// 		  $cart = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)->get();

	// 		  $messageData = array(
	// 						'firstname' => Input::get('firstname'),
	// 						'lastname' => Input::get('lastname'),
	// 						'email' => Input::get('email'),
	// 						'password' => Input::get('password')
	// 		   );

	// 			$settings = Settings::first();

	// 		 	 //send email code goes here
	// 			  		Mail::send('home.email_registration', $messageData, function ($message) use($settings) {

	// 						$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
	// 						$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

	// 						$message->from(Input::get('email'), Input::get('firstname') . ' ' . Input::get('lastname'));
	// 						$message->to($ownerEmail,$ownerName)->subject("New Client");
	// 					});

	// 					//send emai to client
	// 					Mail::send('home.email_registration', $messageData, function ($message) use($settings){
	// 						$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
	// 						$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

	// 						$message->from($ownerEmail, $ownerName);
	// 						$message->to(Input::get('email'),Input::get('firstname') . ' ' . Input::get('lastname'))->subject("Your Access Information");
	// 					});
	// 			  //end send mail

	// 		  if(empty($cart)) {
	// 			  return Redirect::to('pages/thank-you');
	// 		  } else {
	// 			  //update the tempcart with the new clients id based on clients table
	// 			  $cart = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)
	// 			  			     ->update(array('fldTempCartClientID'=>$clients->id));
	// 			  //create session client id
	// 			  Session::put('client_id', $clients->id);
	// 			  //redirect to check out page
	// 			  return Redirect::to('/checkout');
	// 		  }
	//    }
 //   }

	// //For login page functionality
 //    public function checkAccess() {
	// 	$username = Input::get('username');

	// 	$manager = Manager::where('fldManagerEmail','=',$username)->first();
	// 	$menus = Pages::where('fldPagesMainID', '=', 0)->get();
	// 	$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();

	// 	if(empty($manager)) {
	// 		$error = "1";
	// 		$settings = Settings::first();
	// 	   $google = Google::first();
	// 	   $cart_count = TempCart::countCart();
	// 		return View::make('home.login', array('menus'=>$menus,
	// 											  'category'=>$category,
	// 											  'error' => $error,
	// 											  'settings'=>$settings,
	// 											  'google'=>$google,
	// 											  'cart_count'=>$cart_count));
	// 	} else {
	// 			//check if the username and password is same

	// 			if (Hash::check(Input::get('password'), $manager->fldManagerPassword)) {

	// 				  $client_id = Session::has('client_id') ? Session::has('client_id') : Session::getId();

	// 				  $order_date = date('Y-m-d');
	// 				  //check if temp cart is empty
	// 				  $cart = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)->get();
	// 				  //print_r($cart);die();
	// 				  Session::put('client_id', $clients->fldClientID);

	// 				  if(count($cart)==0) {
	// 				  	  //redirect to order list page

	// 					  return Redirect::to('/user-orders');
	// 				  } else {
	// 					 //update the tempcart with the new clients id based on clients table
	// 					 $cart = TempCart::where('fldTempCartClientID','=',$client_id)
	// 					 				 ->where('fldTempCartOrderDate','=',$order_date)
	// 					 				 ->update(array('fldTempCartClientID'=>$clients->fldClientID));
	// 					  //Session::forget('client_id');
	// 					  //create session client id
	// 					  //echo $clients->id;	die();


	// 					  return Redirect::to('/checkout');
	// 				  }
	// 			} else {
	// 				$error = "1";

	// 			   $settings = Settings::first();
	// 			   $google = Google::first();
	// 			   $cart_count = TempCart::countCart();

	// 				return View::make('home.login')->with(array('menus'=>$menus,
	// 															'category'=>$category,
	// 															'settings'=>$settings,
	// 															'google'=>$google,
	// 															'error'=>$error,
	// 															'cart_count'=>$cart_count));
	// 			}
	// 	}


	// }

	// public function logout() {
	// 	Session::flush();
	// 	return Redirect::to('/');
	// }

	// //For forgot password functionality
	// public function forgotPassword() {
	// 	$email = Input::get('email');
	// 	$menus = Pages::where('fldPagesMainID', '=', 0)->get();
	// 	$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
	// 	$settings = Settings::first();
	// 	$google = Google::first();
	// 	$cart_count = TempCart::countCart();

	// 	$manager = Manager::where('fldManagerEmail','=',$email)->first();

	// 	if(empty($manager)) {
	// 		$error = "1";
	// 		return View::make('home.forgot', array('menus'=>$menus,'category'=>$category,'error' => $error,'settings'=>$settings,'google'=>$google,'cart_count'=>$cart_count));
	// 	} else {
	// 		$manager->fldClientHashSecurity = Session::getId();
	// 		$manager->save();

	// 		//send email to client goes here for the email confirmation and include also the links of new password form
	// 			//send email code goes here
	// 					 $messageData = array(
	// 						'security' => Session::getId(),
	// 						'name' => $manager->fldManagerFirstname
	// 					);



	// 			  		Mail::send('home.email_forgot_password', $messageData, function ($message) use($settings) {

	// 						$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
	// 						$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;

	// 						$message->from($ownerEmail, $ownerName);
	// 						$message->to(Input::get('email'))->subject("Forgot Password");
	// 					});
	// 			  //end send mail

	// 		return Redirect::to('pages/forgot-password');
	// 	}

	// }

	// //for new password
	// public function newPassword($hash) {
	// 	$manager = Manager::where('fldManagerHashSecurity','=',$hash)->first();
	// 	$menus = Pages::where('fldPagesMainID', '=', 0)->get();
	// 	$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
	// 	$settings = Settings::first();
	// 	$google = Google::first();
	// 	$cart_count = TempCart::countCart();

	// 	return View::make('home.reset-password', array('menus'=>$menus,'category'=>$category,'manager' => $manager,'settings'=>$settings,'google'=>$google,'cart_count'=>$cart_count));
	// }

	// //for reset password
	// public function resetPassword() {
	// 	$password = Input::get('password');
	// 	$password1 = Input::get('password1');
	// 	$manager_id = Input::get('client_id');

	// 	$manager = Manager::where('fldManagerID','=',$manager_id)->first();
	// 	$menus = Pages::where('fldPagesMainID', '=', 0)->get();
	// 	$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();

	// 	if($password != $password1) {
	// 		$error = 1;
	// 		return View::make('home.reset-password', array('menus'=>$menus,'category'=>$category,'clients' => $clients,'error'=>$error));

	// 	} else {
	// 		//reset password
	// 		$manager->fldManagerPassword = Hash::make($password);
	// 		$manager->save();

	// 		return Redirect::to('pages/reset-password');
	// 	}
	// }


}
