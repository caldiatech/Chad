<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Shipping;
use App\Models\USPS;
use App\Models\State;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;

class USPSController extends Controller
{
  public function getIndex()
    {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		        
        $shipping = USPS::find(1);		
 		
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$shippingClass = 'class=active'; 
		$pageTitle = SHIPPING_USPS;
        return View::make('_admin.shipping.shipping_usps', array('shipping' => $shipping,
        														 'administrator'=>$administrator,
        														 'shippingClass'=>$shippingClass,
        														 'pageTitle'=>$pageTitle));
    }
	
	   
   public function postIndex() {
	   
	  $rules   = USPS::rules();     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/shipping_usps')->withInput()->withErrors($validator,'usps');		                
	  } else {
			   $usps = new USPS;	   
			   $usps->fldUSPSUsername = Input::get('username');
			   $usps->fldUSPSZip = Input::get('zip');
			    
				
				$usps->save();
				
			  	   
				Session::flash('success',"USPS information was successfully saved.");     
				return Redirect::to('dnradmin/shipping_usps');
		}		
   }
   
   public function postEdit($id) {
	    $rules   = USPS::rules();     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
		  if ($validator->fails()) {   	  
		        return Redirect::to('dnradmin/shipping_usps')->withInput()->withErrors($validator,'usps');		                
		  } else {
		    $usps = USPS::find($id);  
		    $usps->fldUSPSUsername = Input::get('username');
		    $usps->fldUSPSZip = Input::get('zip');
			
			
			$usps->save();

		  	   
			Session::flash('success',"USPS information was successfully saved.");     
			return Redirect::to('dnradmin/shipping_usps');
		}
	}
}
