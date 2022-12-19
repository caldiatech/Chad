<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\State;

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
	   
   }
   
   public function postEdit($id) {	  

	   
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
