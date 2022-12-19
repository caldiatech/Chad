<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Shipping;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;

class ShippingController extends Controller
{
  public function getIndex()
    {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		        
        $shipping = Shipping::all();
         
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$shippingClass = 'class=active'; 
        return View::make('_admin.shipping.shipping', array('shipping' => $shipping,'administrator'=>$administrator,'shippingClass'=>$shippingClass));
    }
	
	 public function getView($id)
    {    
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		   
		if($id == 1) { 
	        return Redirect::to('dnradmin/shipping_ups');
		} else if($id == 2) { 
			return Redirect::to('dnradmin/shipping_fedex');	
		} else if($id == 3) { 
			return Redirect::to('dnradmin/shipping_usps');			
		}
    }
	
	public function getEdit($id)
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$shipping = Shipping::find($id);
		
		if($shipping->fldShippingIsActive == 1) {
			$shipping->fldShippingIsActive=0;
		} else {
			$shipping->fldShippingIsActive=1;
		}
		$shipping->save();
		
		return Redirect::to('dnradmin/shipping');
    }
	
	public function displayShipping($city,$state,$country,$zip,$weight,$total) {
		 $shipping = Shipping::where('fldShippingIsActive','=',1)->get();
		 if(count($shipping)==1) {
			 $shipping = Shipping::where('fldShippingIsActive','=',1)->first();
		 }
		 
		 $value = array('city'=>$city,'state'=>$state,'country'=>$country,'zip'=>$zip,'weight'=>$weight,'total'=>$total);
		 $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		 return View::make('home.shipping', array('shipping' => $shipping,'values'=>$value,'administrator'=>$administrator));
	}
	
	public function displaySpin() {
		return View::make('home.spin');
	}
     
}
