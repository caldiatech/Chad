<?php
namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Options;
use App\Models\OptionsAssets;
use App\Models\AdditionalProduct;
use App\Models\ProductOptions;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Html;
use Image;
use Validator;

class OptionsAssetsController extends Controller
{
    public function getIndex()
    {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
	
		$options =  OptionsAssets::orderby('fldOptionsAssetsPosition')->get();             
		$product_id = 0;
        return View::make('_admin.product.options_asset_display', array('options' => $options,'product_id'=>$product_id));
    }
	
	 public function getDisplay($option_id,$product_id="")
    {   
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$main_id=0;		
		$options =  OptionsAssets::where('fldOptionsAssetsOptionID','=',$option_id)->orderby('fldOptionsAssetsPosition')->get();

		// if($product_id == "") {
		// 	$prodOptions = OptionsAssets::join('tblProductOptions','tblProductOptions.fldProductOptionsAssetsID','=','tblOptionsAssets.fldOptionsAssetsID')
		// 		   								->where('fldOptionsAssetsOptionID','=',$option_id)
		// 		   								->select('fldProductOptionsProductID')
		// 		   								->first();
		// 	$product_id = empty($prodOptions) ? "" : $prodOptions->fldProductOptionsProductID;
		// }			   								

		// Get all pre-set
		// if productID: get all from tblProductOptions then tag
		// if no productID: show all blank
		if ($product_id > 0) {
			$product_options = ProductOptions::where('fldProductOptionsProductID','=',$product_id)->select('fldProductOptionsAssetsID')->get();
			foreach ($product_options as $selected) {
				$product_options_array[] = $selected->fldProductOptionsAssetsID;
				// echo $selected->fldProductOptionsAssetsID.'<br>';
			}
		} else {
			// Nothing to tag
			$product_options_array[] = '';
		}
		
			// if (!empty($options)) {
		// 	foreach ($options as $preset) {
		// 		if (in_array($preset->fldOptionsAssetsID, $product_options_array)) {
		// 			echo 'Y - ';
		// 		}
		// 		echo  '('.$preset->fldOptionsAssetsID.') '.$preset->fldOptionsAssetsWidth.''.$preset->fldOptionsAssetsWidthFraction .' x '.$preset->fldOptionsAssetsHeight.''.$preset->fldOptionsAssetsHeightFraction.'<br>';
		// 	}
		// }
        return View::make('_admin.product.options_asset_display', array('options' => $options,'option_id'=>$option_id,'product_id'=>$product_id,'product_options_array'=>$product_options_array));
    }
	
  
   public function postIndex()
    {       
		
		$options = OptionsAssets::orderby('fldOptionsAssetsPosition')->get();        
        return View::make('_admin.product.options_asset_display', array('options' => $options));
        
    }	
	
	public function getNew($error=0,$option_id,$product_id)
   {
	   
	   	//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
	   	$success = "";		
		
   		return View::make('_admin.product.options_assets_add',array('success'=>$success,'error'=>$error,'option_id'=>$option_id,'product_id'=>$product_id));
   } 
   
    public function getView($option_id)
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$options =  OptionsAssets::where('fldOptionsAssetsOptionID','=',$option_id)->orderby('fldOptionsAssetsPosition')->get();    
        return View::make('_admin.product.options_asset_display', array('options' => $options));
    }
   
   public function getUpdatePosition($option_id) {
	   $pctr=1;
		
		foreach(Input::get('page_manager'.$option_id.'1') as $pageManager) {						
			$positionTR =  explode("_",$pageManager);			
			$position_id = $positionTR[0];			
								
			 $category = OptionsAssets::find($position_id);	
			 
			 if($category) {			 
				 $category->fldOptionsAssetsPosition = $pctr;	
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
								
			 $category = OptionsAssets::find($position_id);	

			 if($category) {			 
				 $category->fldOptionsAssetsPosition = $pctr;	
				 $category->save();	
				 $pctr=$pctr+1;				
			 }
				
		
			
		}
		
	   
		
   }
   
   
   public function postNew() {
	   
					
			   $options = new OptionsAssets;
			   $options->fldOptionsAssetsName = Input::get('name');	
			   $options->fldOptionsAssetsOptionID = Input::get('option_id');	 
               $options->fldOptionsAssetsWidth = Input::get('width');	
			   $options->fldOptionsAssetsHeight = Input::get('height');	

			   $options->fldOptionsAssetsWidthFraction = Input::get('widthfraction');
			   $options->fldOptionsAssetsHeightFraction = Input::get('heightfraction');	


				$product_id =Input::get('product_id');	 
	
			  // $options->main_id = Input::get('main_id');	 
			   			   			  
			   //get last position
				$optionsPosition = OptionsAssets::where('fldOptionsAssetsOptionID','=',Input::get('option_id'))->orderby("fldOptionsAssetsPosition","desc")->first();
				if(count($optionsPosition)==1):
					$options->fldOptionsAssetsPosition = $optionsPosition->fldOptionsAssetsPosition+1;	
				else:
					$options->fldOptionsAssetsPosition = 1;
				endif;	
			   			   
			   $options->save();

				

			   	//echo $options->fldOptionsAssetsOptionID;	  			 	
			echo json_encode(array('option_id' => $options->fldOptionsAssetsOptionID,'product_id'=>$product_id));
			
   }
   
   public function getEdit($id,$option_id,$product_id) {	
   		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		   
	    $options =  OptionsAssets::where('fldOptionsAssetsID', '=', $id)->first();
	    
	    return View::make('_admin.product.options_assets_edit', array('options' => $options,'option_id'=>$option_id,'product_id'=>$product_id));	

   }
   
   public function postEdit($id) {	  
	  	
	 
      $options = OptionsAssets::find($id);	  	 
      $options->fldOptionsAssetsName = Input::get('name');	 	
      $options->fldOptionsAssetsWidth = Input::get('width');	
      $options->fldOptionsAssetsHeight = Input::get('height');
      $options->fldOptionsAssetsWidthFraction = Input::get('widthfraction');
	  $options->fldOptionsAssetsHeightFraction = Input::get('heightfraction');			  
	  $options->save();
	  
	//  echo Input::get('option_id');
	$product_id =Input::get('product_id');	 

	 echo json_encode(array('option_id' => Input::get('option_id'),'product_id'=>$product_id));
	
   }
   
    public function getDelete($id,$product_id) {

		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		 $options = OptionsAssets::find($id);
		 //$mainid = $options->main_id;
		 $position = $options->fldOptionsAssetsPosition;
		 $option_id = $options->fldOptionsAssetsOptionID;
		 
		$options->delete();


                
		
		//update all category positions
		$optionsPos = OptionsAssets::where("fldOptionsAssetsPosition",">",$position)->orderby("fldOptionsAssetsPosition")->get();

		if( !empty( $optionsPos ) ) {
		    foreach($optionsPos as $optionsPoss) {
                	 $optionUpdate = OptionsAssets::find($optionsPoss->fldOptionsAssetsIDPrimary);
                         if ( !empty( $optionUpdate ) ) {
			 	$optionUpdate->fldOptionsAssetsPosition = $optionsPoss->fldOptionsAssetsPosition - 1;
			$optionUpdate->save();	
                        } else { 

                        }
		    }
                }

		if ( $product_id ) {
		$delete_option_asset= \DB::delete('DELETE FROM tblProductOptions WHERE fldProductOptionsAssetsID = "'.$id.'" AND fldProductOptionsProductID = "'.$product_id.'"');
		}
		
		echo $option_id ? $option_id : 0;
	}
}
