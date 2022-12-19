<?php
namespace App\Http\Controllers;


use App\Models\Settings;
use App\Models\Payment;


use View;
use Input;
use Hash;
use Redirect;
use Session;

class PaymentController extends Controller
{
   public function getIndex()
    {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
        // get the posts from the database by asking the Active Record for "all"
        $payment = Payment::all();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
        // and create a view which we return - note dot syntax to go into folder
		$paymentClass = 'class=active'; 
        return View::make('_admin.payment.payment', array('payment' => $payment,'administrator'=>$administrator,'paymentClass'=>$paymentClass));
    }
	
	 public function getView($id)
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		if($id == 1) { 
	        return Redirect::to('dnradmin/authorize');
		} else if($id == 2) { 
			return Redirect::to('dnradmin/paypal');		
		}
    }
	
	 public function getEdit($id)
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$payment = Payment::find($id);
		if($payment->fldPaymentIsActive == 1) {
			$payment->fldPaymentIsActive=0;
		} else {
			$payment->fldPaymentIsActive=1;
		}
		$payment->save();
		
		$payment = Payment::all();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$paymentClass = 'class=active'; 
		return View::make('_admin.payment.payment', array('payment' => $payment,'administrator'=>$administrator,'paymentClass'=>$paymentClass));
    }
}
