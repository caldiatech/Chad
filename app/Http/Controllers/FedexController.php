<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Shipping;
use App\Models\Fedex;
use App\Models\State;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;

class FedexController extends Controller
{
  public function getIndex()
    {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
        // get the posts from the database by asking the Active Record for "all"
        $shipping = Fedex::find(1);
		
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$shippingClass = 'class=active'; 
		$pageTitle = SHIPPING_FEDEX;
        return View::make('_admin.shipping.shipping_fedex', array('shipping' => $shipping,'administrator'=>$administrator,'shippingClass'=>$shippingClass,'pageTitle'=>$pageTitle));
    }
	
	   
   public function postIndex() {
	   
	  $rules   = Fedex::rules();     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/shipping_fedex')->withInput()->withErrors($validator,'fedex');		                
	  } else { 
			   $fedex = new Fedex;	   
			   $fedex->fldFedexApKey = Input::get('access_key');
			   $fedex->fldFedexPassword = Input::get('password');
			   $fedex->fldFedexAccountNo = Input::get('account_no');
			   $fedex->fldFedexMeterNo = Input::get('meter_no');	   
			   $fedex->fldFedexAddress = Input::get('address');
			   $fedex->fldFedexCity = Input::get('city');
			   $fedex->fldFedexState = Input::get('state');
			   $fedex->fldFedexZip = Input::get('zip');
			    
				
				$fedex->save();
				
			  	   
				Session::flash('success',"Fedex information was successfully saved.");     
				return Redirect::to('dnradmin/shipping_fedex');	
	  }					
   }
   
   public function postEdit($id) {
	   
	  $rules   = Fedex::rules();     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/shipping_fedex')->withInput()->withErrors($validator,'fedex');		                
	  } else { 
			   $fedex = Fedex::find($id);	   
			   $fedex->fldFedexApKey = Input::get('access_key');
			   $fedex->fldFedexPassword = Input::get('password');
			   $fedex->fldFedexAccountNo = Input::get('account_no');
			   $fedex->fldFedexMeterNo = Input::get('meter_no');	   
			   $fedex->fldFedexAddress = Input::get('address');
			   $fedex->fldFedexCity = Input::get('city');
			   $fedex->fldFedexState = Input::get('state');
			   $fedex->fldFedexZip = Input::get('zip');
			    
				
				$fedex->save();
				
			  	   
				Session::flash('success',"Fedex information was successfully saved.");     
				return Redirect::to('dnradmin/shipping_fedex');		
		}		
   }
}
