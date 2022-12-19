<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CouponCode extends Eloquent
{
   
    protected $table = 'tblCouponCode';
    protected $primaryKey = 'fldCouponCodeID';
	public $timestamps = false;

	public static function rules($id) {
		

		if($id==0) {
			$rules = [
				'name'         		=> 'required|max:255',                 		       
		        'code'  	   		=> 'required|max:100|unique:tblCouponCode,fldCouponCode',
		        'amount'  	   		=> 'numeric',
		        'percentage'   		=> 'numeric',
		        'expiration_date'   => 'required'
		        
			];
		} else {
			$rules = [
				'name'         		=> 'required|max:255',                 		       
		        'code'  	   		=> 'required|max:100|unique:tblCouponCode,fldCouponCode,'.$id.',fldCouponCodeID',
		        'amount'  	   		=> 'numeric',
		        'percentage'   		=> 'numeric',
		        'expiration_date'   => 'required'
		        
			];
		}
		
		

		return $rules;
	}

	public static function checkCouponCode($code,$total,$stateName) {		

		$value = array();

		if(!empty($code)){

			$coupon = self::where('fldCouponCode','=',$code)->where('fldCouponCodeExpirationDate','>',date('Y-m-d'))->first();
			if(empty($coupon)) {

				// $percentDiscount = 10; // Changed to 20% as per client
				$percentDiscount = 20;

				$couponMgr = Manager::where('fldManagerPromoCode','=',$code)->first();
				if (empty($couponMgr)) { // No manager coupon, check shop owner coupon

					$couponSO = ShopOwner::where('fldShopOwnerPromoCode','=',$code)->first();
					if (empty($couponSO)) {
						$value = array('coupon_amount'=>0,'total'=>$total,'freeshipping'=>'no','tax'=>0);
					} else {
						// Commission to Shop Owner
						$discount_amount = ($percentDiscount/100) * $total;
						$discounted_total = $total-(($percentDiscount/100) * $total);
						$value = array('coupon_amount'=>$discount_amount,'total'=>$discounted_total,'freeshipping'=>'no','tax'=>0);
					}

				} else {
					// Commission to Manager
					$discount_amount = ($percentDiscount/100) * $total;
					$discounted_total = $total-(($percentDiscount/100) * $total);
					$value = array('coupon_amount'=>$discount_amount,'total'=>$discounted_total,'freeshipping'=>'no','tax'=>0);
				}

			} else {			

				if($coupon->fldCouponCodeAmount != "") {
					$total = $total - $coupon->fldCouponCodeAmount;
					$value = array('coupon_amount'=>$coupon->fldCouponCodeAmount,'total'=>$total,'freeshipping'=>'no','tax'=>0);
				} else if($coupon->fldCouponCodePercentage != "") {
					$coupon_amount= ($coupon->fldCouponCodePercentage/100) * $total;
					$total = $total-(($coupon->fldCouponCodePercentage/100) * $total);	
					$value = array('coupon_amount'=>$coupon_amount,'total'=>$total,'freeshipping'=>'no','tax'=>0);
				} else if($coupon->fldCouponCodeIsFreeShipping == 1) {
					$value = array('coupon_amount'=>"Free Shipping",'total'=>$total,'freeshipping'=>'yes','tax'=>0);
				}		

			}

			/*
			$coupon = self::where('fldCouponCode','=',$code)->first();		
			if($coupon->fldCouponCodeAmount != "") {
				$total = $total - $coupon->fldCouponCodeAmount;
				$value = array('coupon_amount'=>$coupon->fldCouponCodeAmount,'total'=>$total,'freeshipping'=>'no','tax'=>0);
			} else if($coupon->fldCouponCodePercentage != "") {
				$coupon_amount= ($coupon->fldCouponCodePercentage/100) * $total;
				$total = $total-(($coupon->fldCouponCodePercentage/100) * $total);	
				$value = array('coupon_amount'=>$coupon_amount,'total'=>$total,'freeshipping'=>'no','tax'=>0);
			} else if($coupon->fldCouponCodeIsFreeShipping == 1) {
				$value = array('coupon_amount'=>"Free Shipping",'total'=>$total,'freeshipping'=>'yes','tax'=>0);
			}
			*/	

		}else {
			$value = array('freeshipping'=>'no');
		}

		/*
		if(!empty($code)){
			$coupon = self::where('fldCouponCode','=',$code)->first();		
			if($coupon->fldCouponCodeAmount != "") {
				$total = $total - $coupon->fldCouponCodeAmount;
				$value = array('coupon_amount'=>$coupon->fldCouponCodeAmount,'total'=>$total,'freeshipping'=>'no','tax'=>0);
			} else if($coupon->fldCouponCodePercentage != "") {
				$coupon_amount= ($coupon->fldCouponCodePercentage/100) * $total;
				$total = $total-(($coupon->fldCouponCodePercentage/100) * $total);	
				$value = array('coupon_amount'=>$coupon_amount,'total'=>$total,'freeshipping'=>'no','tax'=>0);
			} else if($coupon->fldCouponCodeIsFreeShipping == 1) {
				$value = array('coupon_amount'=>"Free Shipping",'total'=>$total,'freeshipping'=>'yes','tax'=>0);
			}	

		}else {
			$value = array('freeshipping'=>'no');
			//	return json_encode($value);		
		}
		*/

		$tax=0;		 
		if($stateName != "") {						 		
			$tax = State::getStateTax($stateName,$total);
			$total = $total + $tax;
			$value['total'] = $total;
			$value['tax'] = $tax;
		}

		return json_encode($value);	
	}
		
}

?>