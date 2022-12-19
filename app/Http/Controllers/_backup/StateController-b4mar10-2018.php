<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\State;
use App\Models\Settings;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Image;
use File;

class StateController extends Controller
{
    public function getIndex()
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$category_id=0;		
		$state =  State::orderBy('fldStateName')->get();           
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
		$taxClass = 'class=active';
		$pageTitle = "Tax";
        return View::make('_admin.tax.index', compact('state','administrator','taxClass','pageTitle'));
    }

   
	
  
   public function postIndex()
    {       
		
		
        
    }	
	
	public function getNew()
   {
	   	
   } 
   
   public function getUpdatePosition() {
	   		
   }
   
   
   public function postNew() {
	   
   }
   
   public function getEdit($id) {	   
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$category_id=0;		
		$state =  State::where('fldStateID','=',$id)->first();           
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
		$settings = $administrator;
		$taxClass = 'class=active';
		$pageTitle = "Tax";
        return View::make('_admin.tax.edit', compact('state','administrator','taxClass','pageTitle','settings'));
   }
   
   public function postEdit($id) {	  
   		 $state = State::where('fldStateID','=',$id)->first();
   		 	$state->fldStateTax = Input::get('tax');
   		 $state->save();
   		 
   		 Session::flash('success',"Tax was successfully saved."); 	    
		 return Redirect::to('dnradmin/state/edit/'.$id);
	   
   }
   
    public function getDelete($id) {
		
	}
	
	public function computeTax($stateName,$total) {
		
		$value = array();
		$tax = 0;
		if($stateName != "") { 
			
			$state = State::where('fldStateID','=',$stateName)->first();
							
			$tax = $total * ($state->fldStateTax);
			$total = $total + $tax;
			$value[] = $tax;
			$value[] = $total;			
		} else {
			$value[] = 0;
			$value[] = $total;			
		}
			
		
		print json_encode($value);
	}
	
}
