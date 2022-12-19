<?php
namespace App\Http\Controllers;


use App\Models\Settings;
use App\Models\Payment;
use App\Models\Paypal;
use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;

class PaypalController extends Controller
{
   public function getIndex()
    {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		
        // get the posts from the database by asking the Active Record for "all"
        $payment = Paypal::find(1);
		//$pages = AuthorizeManagement::paginate(5);
 	
        // and create a view which we return - note dot syntax to go into folder
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$paymentClass = 'class=active'; 
        return View::make('_admin.payment.paypal', array('payment' => $payment,'administrator'=>$administrator,'paymentClass'=>$paymentClass));
    }
	
	   
   public function postIndex() {
	   
	   
	   $paypal = new Paypal;	   
	   $paypal->fldPaypalEmail = Input::get('email');

	    
		$messages = array(
		    'email.required' => 'Please input your paypal email address.'

		);
		
	    $fields = Input::all();
		$rules = array('email'=>'required');
		
		
		
	   	$validation = Validator::make($fields, $rules,$messages);
		if ($validation->fails()){
			return Redirect::to('dnradmin/paypal')->withErrors($validation);
		} else {	
			$authorize->save();
		}
	  	   
		Session::flash('success',"Paypal information was successfully saved.");     
		return Redirect::to('dnradmin/paypal');	
   }
   
   public function postEdit($id) {
	   
	   $authorize = Paypal::find($id);	   
	   $authorize->fldPaypalEmail = Input::get('email');
	    
		$messages = array(
		    'email.required' => 'Please input your paypal email address.'
		);
		
	    $fields = Input::all();
		$rules = array('email'=>'required');
		
		
		
	   	$validation = Validator::make($fields, $rules,$messages);
		if ($validation->fails()){
			return Redirect::to('dnradmin/paypal')->withErrors($validation);
		} else {	
			$authorize->save();
		}
	  	   
		Session::flash('success',"Paypal information was successfully saved.");     
		return Redirect::to('dnradmin/paypal');	
   }
     
}
