<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Shipping;
use App\Models\UPS;
use App\Models\State;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;

class UPSController extends Controller
{
  public function getIndex()
    {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
        
        $shipping = UPS::find(1);
		
 		
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$shippingClass = 'class=active'; 
        return View::make('_admin.shipping.shipping_ups', array('shipping' => $shipping,'administrator'=>$administrator,'shippingClass'=>$shippingClass));
    }
	
	   
   public function postIndex() {
	   
	  $rules   = UPS::rules();     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/shipping_ups')->withInput()->withErrors($validator,'ups');		                
	  } else {  
			   $ups = new UPS;	   
			   $ups->fldUPSXmlAccessKey = Input::get('xml_access_key');
			   $ups->fldUPSUserID = Input::get('user_id');
			   $ups->fldUPSPassword = Input::get('password');	   
			   $ups->fldUPSAddress = Input::get('address');
			   $ups->fldUPSCity = Input::get('city');
			   $ups->fldUPSState = Input::get('state');
			   $ups->fldUPSZip = Input::get('zip');			   			    		
			   $ups->save();
							  	   
				Session::flash('success',"UPS information was successfully saved.");     
				return Redirect::to('dnradmin/shipping_ups');	
		}			
   }
   
   public function postEdit($id) {
	  $rules   = UPS::rules();     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/shipping_ups')->withInput()->withErrors($validator,'ups');		                
	  } else { 
			   $ups = UPS::find($id);	   
			   $ups->fldUPSXmlAccessKey = Input::get('xml_access_key');
			   $ups->fldUPSUserID = Input::get('user_id');
			   $ups->fldUPSPassword = Input::get('password');	   
			   $ups->fldUPSAddress = Input::get('address');
			   $ups->fldUPSCity = Input::get('city');
			   $ups->fldUPSState = Input::get('state');
			   $ups->fldUPSZip = Input::get('zip');
			    				
			   $ups->save();
							  	  
				Session::flash('success',"UPS information was successfully saved.");     
				return Redirect::to('dnradmin/shipping_ups');	
		}			
   }
}
