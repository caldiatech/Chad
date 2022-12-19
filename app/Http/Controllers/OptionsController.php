<?php
namespace App\Http\Controllers;


use App\Models\Settings;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Options;
use App\Models\ProductOptions;
use App\Models\AdditionalProduct;
use View;
use Input;
use Hash;
use Redirect;
use Session;
use Html;
use Image;
use Validator;

class OptionsController extends Controller
{
    public function getIndex()
    {   
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		$main_id = 0;

		$options =  Options::orderby('fldOptionsPosition')->get();             
		$product_id=0;
        return View::make('_admin.product.options_display', array('options' => $options,'product_id'=>$product_id));
    }
	
	 public function getDisplay($main_id,$product_id="")
    {   
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$main_id=0;		
		$options =  Options::orderby('fldOptionsPosition')->get();            
		
        return View::make('_admin.product.options_display', array('options' => $options,'product_id'=>$product_id));
    }
	
  
   public function postIndex()
    {       
		
		$options = Options::orderby('fldOptionsPosition')->get();        
        return View::make('_admin.product.options_display', array('options' => $options));
        
    }	
	
	public function getNew($error=0)
   {
	   	//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
	   	$success = "";		
   		return View::make('_admin.product.options_add',array('success'=>$success,'error'=>$error));
   } 
   
    public function getView($id)
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$options =  Options::orderby('fldOptionsPosition')->get();        
        return View::make('_admin.product.options_display', array('options' => $options));
    }
   
   public function getUpdatePosition() {
	   $pctr=1;
		
		foreach(Input::get('page_manager5') as $pageManager) {						
			$positionTR =  explode("_",$pageManager);			
			$position_id = $positionTR[0];			
								
			 $category = Options::find($position_id);	
			 if($category) {			 
				 $category->fldOptionsPosition = $pctr;	
				 $category->save();	
				 $pctr=$pctr+1;				
			 }
				
		
			
		}
		
	   
		
   }
   
   public function getUpdatePositionSub() {
	   $pctr=1;
		
		foreach(Input::get('page_manager1') as $pageManager) {						
			$positionTR =  explode("_",$pageManager);			
			$position_id = $positionTR[0];			
								
			 $category = Options::find($position_id);	

			 if($category) {			 
				 $category->fldOptionsPosition = $pctr;	
				 $category->save();	
				 $pctr=$pctr+1;				
			 }
				
		
			
		}
		
	   
		
   }
   
   
   public function postNew() {
	 				
			   $options = new Options;
			   $options->fldOptionsName = Input::get('name');	 

			  // $options->main_id = Input::get('main_id');	 
			   			   			  
			   //get last position
				$optionsPosition = Options::orderby("fldOptionsPosition","desc")->first();
				if(count($optionsPosition)==1):
					$options->fldOptionsPosition = $optionsPosition->fldOptionsPosition+1;	
				else:
					$options->fldOptionsPosition=1;
				endif;	
			   			   
			   $options->save();		  			 	

   }
   
   public function getEdit($id) {	
   		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		   
	    $options =  Options::where('fldOptionsID', '=', $id)->first();
	    return View::make('_admin.product.options_edit', array('options' => $options));		
   }
   
   public function postEdit($id) {	  
	  	
	 
      $options = Options::find($id);	  	 
      $options->fldOptionsName = Input::get('name');	 	   
	  $options->save();
	   	  
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		 $options = Options::find($id);		 
		 $position = $options->fldOptionsPosition;
		 
		 
		$options->delete();
		
		//update all category positions
		$optionsPos = Options::where("fldOptionsPosition",">",$position)->orderby("fldOptionsPosition")->get();
		
		
		foreach($optionsPos as $optionsPoss) {
			 $optionUpdate = Options::find($optionsPoss->fldOptionsID);
			 	$optionUpdate->fldOptionsPosition = $optionsPoss->fldOptionsPosition - 1;
			 $optionUpdate->save();	
		}
		
	
	}
	
	public function displaySubCategory($category_id,$product_id) {
		$category = Options::orderby("fldOptionsPosition")->get();
		
		return View::make('_admin.product.category_display', array('category' => $category,'category_id'=>$category_id,'product_id'=>$product_id));	
	}
}
