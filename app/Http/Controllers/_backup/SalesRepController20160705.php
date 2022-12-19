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

class SalesRepController extends Controller
{
    public function getIndex()
    {   
		//if not login redirect to login page    	
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		    
		$manager = Manager::where('fldManagerType','=',2)->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
		$salesClass = 'class=active';

		foreach($manager as $managers) {
			//check commission
			$commission = ManagerCommission::calculateCommissionYearAdmin($managers->fldManagerID);
			$managers->fldManagerCommission = $commission;
		}

	        return View::make('_admin.sales_rep.index', array('manager' => $manager,'administrator'=>$administrator,'salesClass'=>$salesClass));
    }

    public function getSales($manager_id) {
    	if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$manager = Manager::find($manager_id);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
		
		$dateFrom = date('Y-1-1');
		$dateTo = date('Y-12-31');

		$cart = ManagerCommission::salesActivities($manager_id);

		$salesClass = 'class=active';
		return View::make('_admin.sales_rep.sales', compact('manager','administrator','salesClass','cart'));	 
	}
	
  
 	
	public function getNew()
   {
	   	//if not login redirect to login page    	

		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   	
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
		$salesClass = 'class=active';

		  		$try = "N";
			  while($try=="N") {
			   $promocode = 'SR'.Str::random(4); 
			   $managerPromo = Manager::where('fldManagerPromoCode','=',$promocode)->count();
			   if($managerPromo == 0) {
			    $try = "Y";
			   } else {
			    $try = "N";
			   }
			  }

   		return View::make('_admin.sales_rep.add',array('administrator'=>$administrator,
   															'promocode'=>$promocode,
   														   'salesClass'=>$salesClass));
   } 
   
     
   
   public function postNew() {
	   
		$rules   = Manager::rules(0);    
		$validator = Validator::make(Input::all(), $rules);
    	
	    if ($validator->fails()) {    			
		    return Redirect::to('dnradmin/sales_rep/new')->withInput()->withErrors($validator,'manager');	
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
		   $manager->fldManagerStatus = 2;
		   $manager->fldManagerType = 2;	 	   	   	   	 
		   $manager->save();	   	  

		   Session::flash('success',"Sales Rep was successfully saved."); 		   
		   return Redirect::to('dnradmin/sales-rep/new');
		   
		}
	   	   	   
	   
	  
   }
   
   public function getEdit($id) {
	   //if not login redirect to login page    	
   
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
				   
	   $manager =  Manager::where('fldManagerID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
	   $salesClass = 'class=active';
		
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
	
	   
	    return View::make('_admin.sales_rep.edit', array('manager' => $manager,'administrator'=>$administrator,'salesClass'=>$salesClass,'braintreeClient'=>$braintreeClient,'braintreeMerchant'=>$braintreeMerchant));		
   }
   
   public function postEdit($id) {	  
   	$rules   = Manager::rules($id);    
	$validator = Validator::make(Input::all(), $rules);
    	
	 if ($validator->fails()) {  
		return Redirect::to('dnradmin/sales_rep/edit/'.$id)->withInput()->withErrors($validator,'manager');	
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
		   Session::flash('success',"Sales Rep was successfully saved.");
		   return Redirect::to('dnradmin/sales-rep/edit/'.$id);	
		   
	 }   

	 
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    	
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$manager = Manager::find($id);
		
		if(empty($manager)) {
			return Redirect::to('dnradmin/sales-rep');
			exit();
		}

		$manager->delete();

		return Redirect::to('dnradmin/sales-rep');
		
		
	}

	
	
	
}
