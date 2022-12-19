<?php
/***********************DEVELOPER : EMMANUEL MARCILLA**************************/

namespace App\Http\Controllers;


use App\Models\Settings;
use App\Models\Payment;
use App\Models\Authorize;
use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;

class AuthorizeController extends Controller
{
   public function getIndex()
    {
        
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		// get the posts from the database by asking the Active Record for "all"
        $payment = Authorize::find(1);
 		
        // and create a view which we return - note dot syntax to go into folder
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$paymentClass = 'class=active'; 

        return View::make('_admin.payment.authorize', array('payment' => $payment,
        												    'administrator'=>$administrator,
        												    'paymentClass'=>$paymentClass));
    }
	
	   
   public function postIndex() {
	   	   
	   $authorize = new Authorize;	   
	   $authorize->fldAuthorizeLoginKey = Input::get('login_key');
	   $authorize->fldAuthorizeTranKey = Input::get('tran_key');
	    
		$messages = array(
		    'login_key.required' => 'Please input login key.',
			'tran_key.required' => 'Please input transaction key.'
		);
		
	    $fields = Input::all();
		$rules = array('login_key'=>'required', 'tran_key' => 'required');
		
		
		
	   	$validation = Validator::make($fields, $rules,$messages);
		if ($validation->fails()){
			return Redirect::to('dnradmin/authorize')->withErrors($validation);
		} else {	
			$authorize->save();
		}

	  	Session::flash('success',"Authorize.net information was successfully saved.");     
		return Redirect::to('dnradmin/authorize');
	   
   }
   
   public function postEdit($id) {
	   
	   $authorize = Authorize::find($id);	   
	   $authorize->fldAuthorizeLoginKey = Input::get('login_key');
	   $authorize->fldAuthorizeTranKey = Input::get('tran_key');
	    
		$messages = array(
		    'login_key.required' => 'Please input login key.',
			'tran_key.required' => 'Please input transaction key.'
		);
		
	    $fields = Input::all();
		$rules = array('login_key'=>'required', 'tran_key' => 'required');
		
		
		
	   	$validation = Validator::make($fields, $rules,$messages);
		if ($validation->fails()){
			return Redirect::to('dnradmin/authorize')->withErrors($validation);
		} else {	
			$authorize->save();
		}
	  	   
		
		Session::flash('success',"Authorize.net information was successfully saved.");     
		return Redirect::to('dnradmin/authorize');
   }
}
