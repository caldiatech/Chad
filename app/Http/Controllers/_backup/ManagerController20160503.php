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
use App\Models\Manager;

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
		    
		$manager = Manager::all();     
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
		$managerClass = 'class=active';
        return View::make('_admin.manager.manager', array('manager' => $manager,'administrator'=>$administrator,'managerClass'=>$managerClass));
    }
	
  
 	
	public function getNew()
   {
	   	//if not login redirect to login page    	

		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   	
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
		$managerClass = 'class=active';

		  		$try = "N";
			  while($try=="N") {
			   $promocode = 'MGR'.Str::random(4); # changed by abustillo limit promocode to 6 characters
			   $managerPromo = Manager::where('fldManagerPromoCode','=',$promocode)->count();
			   if($managerPromo == 0) {
			    $try = "Y";
			   } else {
			    $try = "N";
			   }
			  }

   		return View::make('_admin.manager.manager_add',array('administrator'=>$administrator,
   															'promocode'=>$promocode,
   														   'managerClass'=>$managerClass));
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
		   $manager->save();	   	  

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
	   
	    return View::make('_admin.manager.manager_edit', array('manager' => $manager,'administrator'=>$administrator,'managerClass'=>$managerClass));		
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
		   
		   if(Input::get('password') != "") { 
		   	   $password = Hash::make(Input::get('password'));
			   $manager->fldManagerPassword = $password;
		   }
		  
		  
		   $manager->save();	   	  
		   Session::flash('success',"Manager was successfully saved.");
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
	
	//For Registration page functionality
	public function newClient() {
	   
  	   
	   $emailCheck = Manager::where('fldManagerEmail','=',Input::get('email'))->first();
	   
	   $menus = Pages::where('fldPagesMainID', '=', 0)->get();
	   $category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();		
	   
	   $data = Input::all();
			
	   if($emailCheck) {
		   $error = 1;
		   return View::make('home.registration', array('menus'=>$menus,'category'=>$category,'email_error' => $error,'data'=>$data));	  
	   } else {		
			   $manager = new Manager;
			   $manager->fldManagerFirstname = Input::get('firstname');	 
			   $manager->fldManagerLastname = Input::get('lastname');	 
			   $manager->fldManagerEmail = Input::get('email');	 			   
			   $manager->fldManagerPhoneNo = Input::get('phone');	 	   
			   $manager->fldManagerGender = Input::get('gender');	 	   
			   $manager->fldManagerBirthDate = Input::get('birthdate');	 	   
			   $manager->fldManagerAddress = Input::get('address');	 
			   $password = Hash::make(Input::get('password'));
			   $manager->fldManagerPassword = $password;	   
			   $manager->save();	   	  
			  						  
			  $client_id = Session::has('client_id') ? Session::has('client_id') : Session::getId();
			  $order_date = date('Y-m-d');
			  //check if temp cart have records based on session id
			  $cart = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)->get();
			  			  
			  $messageData = array(
							'firstname' => Input::get('firstname'),
							'lastname' => Input::get('lastname'),
							'email' => Input::get('email'),							
							'password' => Input::get('password')							
			   );
												
				$settings = Settings::first();									

			 	 //send email code goes here			  							
				  		Mail::send('home.email_registration', $messageData, function ($message) use($settings) {
							
							$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
							$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;
				
							$message->from(Input::get('email'), Input::get('firstname') . ' ' . Input::get('lastname'));
							$message->to($ownerEmail,$ownerName)->subject("New Client");									
						});
						
						//send emai to client
						Mail::send('home.email_registration', $messageData, function ($message) use($settings){							
							$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
							$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;
				
							$message->from($ownerEmail, $ownerName);
							$message->to(Input::get('email'),Input::get('firstname') . ' ' . Input::get('lastname'))->subject("Your Access Information");									
						});
				  //end send mail
				  
			  if(empty($cart)) { 			        
				  return Redirect::to('pages/thank-you');
			  } else {
				  //update the tempcart with the new clients id based on clients table
				  $cart = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)
				  			     ->update(array('fldTempCartClientID'=>$clients->id));
				  //create session client id	
				  Session::put('client_id', $clients->id);
				  //redirect to check out page
				  return Redirect::to('/checkout');
			  }
	   }
   }
   
	//For login page functionality
    public function checkAccess() {
		$username = Input::get('username');

		$manager = Manager::where('fldManagerEmail','=',$username)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();				
			
		if(empty($manager)) {			
			$error = "1";
			$settings = Settings::first();
		   $google = Google::first();				  
		   $cart_count = TempCart::countCart();
			return View::make('home.login', array('menus'=>$menus,
												  'category'=>$category,
												  'error' => $error,
												  'settings'=>$settings,
												  'google'=>$google,
												  'cart_count'=>$cart_count));
		} else {
				//check if the username and password is same

				if (Hash::check(Input::get('password'), $manager->fldManagerPassword)) {

					  $client_id = Session::has('client_id') ? Session::has('client_id') : Session::getId();
					
					  $order_date = date('Y-m-d');
					  //check if temp cart is empty
					  $cart = TempCart::where('fldTempCartClientID','=',$client_id)->where('fldTempCartOrderDate','=',$order_date)->get();
					  //print_r($cart);die();
					  Session::put('client_id', $clients->fldClientID);

					  if(count($cart)==0) {  	
					  	  //redirect to order list page
						  
						  return Redirect::to('/user-orders');
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
					$error = "1";
									
				   $settings = Settings::first();
				   $google = Google::first();				  
				   $cart_count = TempCart::countCart();
				
					return View::make('home.login')->with(array('menus'=>$menus,
																'category'=>$category,
																'settings'=>$settings,
																'google'=>$google,
																'error'=>$error,
																'cart_count'=>$cart_count));
				}
		}
		
		
	}
	
	public function logout() {
		Session::flush();
		return Redirect::to('/');
	}
	
	//For forgot password functionality
	public function forgotPassword() {
		$email = Input::get('email');		
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$settings = Settings::first();
		$google = Google::first();				  
		$cart_count = TempCart::countCart();
				   
		$manager = Manager::where('fldManagerEmail','=',$email)->first();
		
		if(empty($manager)) {
			$error = "1";
			return View::make('home.forgot', array('menus'=>$menus,'category'=>$category,'error' => $error,'settings'=>$settings,'google'=>$google,'cart_count'=>$cart_count));
		} else {
			$manager->fldClientHashSecurity = Session::getId();
			$manager->save();
			
			//send email to client goes here for the email confirmation and include also the links of new password form
				//send email code goes here
						 $messageData = array(
							'security' => Session::getId(),
							'name' => $manager->fldManagerFirstname
						);
						
						
						
				  		Mail::send('home.email_forgot_password', $messageData, function ($message) use($settings) {
							
							$ownerEmail = $settings->fldAdministratorEmail == "" ? "test1@dogandrooster.net" : $settings->fldAdministratorEmail;
							$ownerName = $settings->fldAdministratorSiteName == "" ? "Dog and Rooster" : $settings->fldAdministratorSiteName;
													
							$message->from($ownerEmail, $ownerName);
							$message->to(Input::get('email'))->subject("Forgot Password");									
						});
				  //end send mail
				  
			return Redirect::to('pages/forgot-password');
		}
		
	}
	
	//for new password 
	public function newPassword($hash) {
		$manager = Manager::where('fldManagerHashSecurity','=',$hash)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$settings = Settings::first();
		$google = Google::first();				  
		$cart_count = TempCart::countCart();
				
		return View::make('home.reset-password', array('menus'=>$menus,'category'=>$category,'manager' => $manager,'settings'=>$settings,'google'=>$google,'cart_count'=>$cart_count));
	}
	
	//for reset password
	public function resetPassword() {
		$password = Input::get('password');
		$password1 = Input::get('password1');
		$manager_id = Input::get('client_id');	
		
		$manager = Manager::where('fldManagerID','=',$manager_id)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		
		if($password != $password1) {
			$error = 1;
			return View::make('home.reset-password', array('menus'=>$menus,'category'=>$category,'clients' => $clients,'error'=>$error));
			
		} else {
			//reset password 			
			$manager->fldManagerPassword = Hash::make($password);
			$manager->save();
			
			return Redirect::to('pages/reset-password');
		}
	}
	
	
}
