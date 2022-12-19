<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\CouponCode;
use App\Models\Manager;
use App\Models\ShopOwner;


use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;
use DB;

class CouponCodeController extends Controller
{
    public function getIndex()
    {    
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		   	
		$coupon =  CouponCode::orderBy('fldCouponCodeExpirationDate','DESC')->get();          
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
		$couponClass = 'class=active';
		$pageTitle = COUPONCODE_MANAGEMENT;
        return View::make('_admin.coupon_code.coupon_code', array('coupon' => $coupon,
        														  'administrator'=>$administrator,
        														  'couponClass'=>$couponClass,
        														  'pageTitle'=>$pageTitle));
    }
	
  
   public function postIndex()
    {       
		
		$coupon = CouponCode::all();   
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();       
		$couponClass = 'class=active';
		$pageTitle = COUPONCODE_MANAGEMENT;
        return View::make('_admin.coupon_code.coupon_code', array('coupon' => $coupon,'administrator'=>$administrator,'couponClass'=>$couponClass,'pageTitle'=>$pageTitle));
        
    }	
	
	public function getNew()
   {
	   	//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   	
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$couponClass = 'class=active';
		$pageTitle = COUPONCODE_MANAGEMENT;
   		return View::make('_admin.coupon_code.coupon_code_add',array('administrator'=>$administrator,'couponClass'=>$couponClass,'pageTitle'=>$pageTitle));
   } 
   
    public function getView($id)
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$coupon =  CouponCode::all();  
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();      
		$couponClass = 'class=active';
		$pageTitle = COUPONCODE_MANAGEMENT;
        return View::make('_admin.coupon_code.coupon_code', array('coupon' => $coupon,'administrator'=>$administrator,'couponClass'=>$couponClass,'pageTitle'=>$pageTitle));
    }
   
        
   public function postNew() {
	  $rules   = CouponCode::rules(0);     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/coupon_code/new')->withInput()->withErrors($validator,'couponcode');		                
	  } else {  	  	
			   $coupon = new CouponCode;
			   $coupon->fldCouponCodeName = Input::get('name');	 
			   $coupon->fldCouponCode = Input::get('code');	 
			   $coupon->fldCouponCodeAmount = Input::get('amount');
			   $coupon->fldCouponCodePercentage = Input::get('percentage');
               $coupon->fldCouponCodeExpirationDate = Input::get('expiration_date');
			   if(isset($_POST['isFreeShipping'])) {
			   	  $freeShipping = 1;
			   } else {
			   	  $freeShipping = 0;
			   }
			   $coupon->fldCouponCodeIsFreeShipping = $freeShipping;
			   $coupon->save();	   	  
			   	

			  	Session::flash('success',"Coupon code was successfully saved."); 
			    return Redirect::to('dnradmin/coupon_code/new');
	   } 
	  
   }
   
   public function getEdit($id) {	   
  		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
			
	   $coupon =  CouponCode::where('fldCouponCodeID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first(); 
	    $couponClass = 'class=active';
	    $pageTitle = COUPONCODE_MANAGEMENT;
	    return View::make('_admin.coupon_code.coupon_code_edit', array('coupon' => $coupon,'administrator'=>$administrator,'couponClass'=>$couponClass,'pageTitle'=>$pageTitle));		
   }
   
   public function postEdit($id) {	  
	  
   	  $rules   = CouponCode::rules($id);     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
			
	        return Redirect::to('dnradmin/coupon_code/edit/'.$id)->withInput()->withErrors($validator,'couponcode');		                
	  } else {  	  							
				   $coupon = CouponCode::find($id);
				   $coupon->fldCouponCodeName = Input::get('name');	 
				   $coupon->fldCouponCode = Input::get('code');	 
				   $coupon->fldCouponCodeAmount = Input::get('amount');
				   $coupon->fldCouponCodePercentage = Input::get('percentage');
                                   $coupon->fldCouponCodeExpirationDate = Input::get('expiration_date');
				   if(isset($_POST['isFreeShipping'])) {
				   	  $freeShipping = 1;
				   } else {
				   	  $freeShipping = 0;
				   }
				   $coupon->fldCouponCodeIsFreeShipping = $freeShipping;
				   			
				   
				   $coupon->save();
				   
				   	   
				   Session::flash('success',"Coupon code was successfully saved."); 
				    return Redirect::to('dnradmin/coupon_code/edit/'.$id);	 
		} 	      
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$coupon = CouponCode::find($id);
		
		$coupon->delete();
				
		return Redirect::to('dnradmin/coupon_code');
	}
	
	public function checkCouponCode($code,$total) {

		// Check if code is in Coupon Code Module
		// else
			// Check if code is from Manager
			// Check if code is from Shop Owner
			// else
				// error: Code invalid

		$value = array();
		$percentDiscount = 10;

		$coupon = CouponCode::where('fldCouponCode','=',$code)->where('fldCouponCodeExpirationDate','>',date('Y-m-d'))->first();
		if(empty($coupon)) {

			$couponMgr = Manager::where('fldManagerPromoCode','=',$code)->first();
			if (empty($couponMgr)) { // No manager coupon, check shop owner coupon

				$couponSO = ShopOwner::where('fldShopOwnerPromoCode','=',$code)->first();
				if (empty($couponSO)) {
					$value[] = "error";			  
					if(Session::has('couponCode')) { 
						Session::forget('couponSource');
						Session::forget('couponSourceID');
						Session::forget('couponCode');
					}
				} else {
					// Commission to Shop Owner
					Session::put('couponSource', 'Shop');
					Session::put('couponSourceID', $couponSO->fldShopOwnerID);
					Session::put('couponCode', $code);
					$value[] = ($percentDiscount/100) * $total;
					$value[] = $total-(($percentDiscount/100) * $total);
					// $value[] = 'Shop Owner Promo Code';
				}

			} else {
				// Commission to Manager
				Session::put('couponSource', 'Manager');
				Session::put('couponSourceID', $couponMgr->fldManagerID);
				Session::put('couponCode', $code);  
				$value[] = ($percentDiscount/100) * $total;
				$value[] = $total-(($percentDiscount/100) * $total);
				// $value[] = 'Manager Promo Code';
			}

		} else {			

			Session::put('couponSource', 'Coupon Code Module');
			Session::put('couponCode', $code);  
			if($coupon->fldCouponCodeAmount != "") {
				$value[] = $coupon->fldCouponCodeAmount;
				$value[] = $total - $coupon->fldCouponCodeAmount;
			} else if($coupon->fldCouponCodePercentage != "") {
				$value[] = ($coupon->fldCouponCodePercentage/100) * $total;
				$value[] = $total-(($coupon->fldCouponCodePercentage/100) * $total);	
			} else if($coupon->fldCouponCodeIsFreeShipping == 1) {
				$value[] = "Free Shipping";
			}		

		}

		print json_encode($value);

		/*
		$couponMgr = Manager::where('fldManagerPromoCode','=',$code)->first();
		if (empty($couponMgr)) { // No manager coupon, check shop owner coupon

			$couponSO = ShopOwner::where('fldShopOwnerPromoCode','=',$code)->first();
			if (empty($couponSO)) {
				$value[] = "error";			  
				if(Session::has('couponCode')) { Session::forget('couponCode');}
			} else {
				// Commission to Shop Owner
				Session::put('couponSource', 'Shop');
				Session::put('couponSourceID', $couponSO->fldShopOwnerID);
				Session::put('couponCode', $code);
				$value[] = ($percentDiscount/100) * $total;
				$value[] = $total-(($percentDiscount/100) * $total);
			}

		} else {
			// Commission to Manager
			Session::put('couponSource', 'Manager');
			Session::put('couponSourceID', $couponMgr->fldManagerID);
			Session::put('couponCode', $code);  
			$value[] = ($percentDiscount/100) * $total;
			$value[] = $total-(($percentDiscount/100) * $total);
		}
		print json_encode($value);

			// Check if code 
		  $value = array();
		  $coupon = CouponCode::where('fldCouponCode','=',$code)->first();
		  if(empty($coupon)) {
			  $value[] = "error";			  
			  if(Session::has('couponCode')) { Session::forget('couponCode');}
		  } else {			
		  	  Session::put('couponCode', $code);  
				if($coupon->fldCouponCodeAmount != "") {
					$value[] = $coupon->fldCouponCodeAmount;
					$value[] = $total - $coupon->fldCouponCodeAmount;			
				} else if($coupon->fldCouponCodePercentage != "") {
					$value[] = ($coupon->fldCouponCodePercentage/100) * $total;
					$value[] = $total-(($coupon->fldCouponCodePercentage/100) * $total);	
				} else if($coupon->fldCouponCodeIsFreeShipping == 1) {
					$value[] = "Free Shipping";
				}		
		  }

		  print json_encode($value);
		*/
	}
}
