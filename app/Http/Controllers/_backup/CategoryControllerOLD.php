<?php
/***********************DEVELOPER : EMMANUEL MARCILLA**************************/
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Category;
use View;
use Input;
use Hash;
use Redirect;
use Session;
use Html;
use Image;
use Validator;
use File;

class CategoryController extends Controller
{
    public function getIndex()
    {   
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$category_id=0;		
		$category =  Category::where('fldCategoryMainID', '=', $category_id)->orderby('fldCategoryPosition')->get();            
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
		$productClass = 'class=active';
        return View::make('_admin.product.category', array('category' => $category,
        												   'category_id'=>$category_id,
        												   'administrator'=>$administrator,
        												   'productClass'=>$productClass));
    }
	
	 public function getDisplay($category_id="",$product_id="")
    {   
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$main_id=0;		
		$category =  Category::where('fldCategoryMainID', '=', $main_id)->orderby('fldCategoryPosition')->get();            
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
		$productClass = 'class=active';
        return View::make('_admin.product.product_category', array('category' => $category,
        														   'category_id'=>$category_id,
        														   'administrator'=>$administrator,
        														   'product_id'=>$product_id,
        														   'productClass'=>$productClass));
    }
	
  
   public function postIndex()
    {       
		
		$category = Category::orderby('fldCategoryPosition')->get(); 
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();         
		$productClass = 'class=active';
        return View::make('_admin.product.category', array('category' => $category,
        												   'administrator'=>$administrator,
        												   'productClass'=>$productClass));
        
    }	
	
	public function getNew($id,$backid)
   {
	   	//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   	
		$category = Category::where('fldCategoryID', '=', $id)->first();
		
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();         
		$productClass = 'class=active';

   		return View::make('_admin.product.category_add',array(
   															  'category_id'=>$id,
   															  'backid'=>$backid,   															  
   															  'category'=>$category,
   															  'administrator'=>$administrator,
   															  'productClass'=>$productClass));
   } 
   
    public function getView($id)
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$category =  Category::where('fldCategoryMainID', '=', $id)->orderby('fldCategoryPosition')->get();        
		$maincat = Category::where('fldCategoryID', '=', $id)->first();        
		
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();         
		$productClass = 'class=active';
        return View::make('_admin.product.category', array('category' => $category,
        												   'category_id'=>$id,
        												   'maincat'=>$maincat,
        												   'administrator'=>$administrator,
        												   'category_name'=>count($maincat)==1 ? $maincat->fldCategoryName : "",
        												   'productClass'=>$productClass));
    }
   
   public function getUpdatePosition() {
	   $pctr=1;
		
		foreach(Input::get('page_manager') as $pageManager) {						
			$positionTR =  explode("_",$pageManager);			
			$position_id = $positionTR[0];			
								
			 $category = Category::find($position_id);	
			 if($category) {			 
				 $category->fldCategoryPosition = $pctr;	
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
								
			 $category = Category::find($position_id);	

			 if($category) {			 
				 $category->fldCategoryPosition = $pctr;	
				 $category->save();	
				 $pctr=$pctr+1;				
			 }
				
		
			
		}
		
	   
		
   }
   
   
   public function postNew() {
	   $path = Input::file('image')->getRealPath();
	   list($width, $height) = getimagesize($path);
	  
	   if($width == "248" && $height == "113") { 
					
			   $category = new Category;
			   $category->fldCategoryName = Input::get('name');	 
			   $category->fldCategoryMainID = Input::get('main_id');	 
			   $category->fldCategoryDescription = Input::get('description');
			   $category->save();	   	  
				   
			   $category = Category::find($category->fldCategoryID);
			   $category_id = Input::get('main_id');
			   
			   $file = Input::file('image');
			   if($file != "") {
				   $destinationPath = 'upload/category/'.$category->fldCategoryID.'/';
				   $filename = $file->getClientOriginalName();
				   Input::file('image')->move($destinationPath, $filename);	   
				   
				   $category->fldCategoryImage = $filename;
				   
				   //resize the image to 400px
				   $img = Image::make($destinationPath.$filename)->resize(400, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.'_400_'.$filename, 90);
				   //resize the image to 75px
				   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.'_75_'.$filename, 90);		   		   
			   } else {
				   $category->fldCategoryImage = "";
			   }
			   
			   //generate slug
			    $pageCount = Category::where('fldCategoryName','=',Input::get('name'))->count();
				$slug = $pageCount == 0 ? str_slug($category->fldCategoryName,'-') : str_slug($category->fldCategoryName."-".$pageCount,'-');
				$category->fldCategorySlug = $slug;				
				
			   //get last position
				$categoryPosition = Category::where("fldCategoryMainID","=",Input::get('main_id'))
											  ->where("fldCategoryID","!=",$category->fldCategoryID)
											  ->orderby("fldCategoryPosition","desc")
											  ->first();
				$category->fldCategoryPosition = count($categoryPosition) == 1 ? $categoryPosition->fldCategoryPosition+1 : 1;		
			   
			   
			   $category->save();		  
			   $success=1;
			   $backid=0;
			   if($backid == 0) {
			   	   Session::flash('success',"Category was successfully saved.");  
				   return Redirect::to('dnradmin/products/new/0/2'); 
			   } else {
			   	   Session::flash('success',"Category was successfully saved.");  	
				   return Redirect::to('dnradmin/products/edit/'.$backid);
			   }
			   
	   } else {
		    Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!.");  
		   return Redirect::to('dnradmin/category/new/0/2')->withInput();	
	   }
   }
   
   public function getEdit($id,$backid=2,$success=0,$error=0) {	
   		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		   
	    $category =  Category::where('fldCategoryID', '=', $id)->first();
		$main_cat = Category::where('fldCategoryID', '=', $category->main_id)->first();
		if(empty($main_cat)) {
			$main_cat =  Category::where('fldCategoryID', '=', $id)->first();
		}
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();         
		$productClass = 'class=active';
	    return View::make('_admin.product.category_edit', array('category' => $category,
	    													    'backid'=>$backid,
	    													    'success'=>$success,
	    													    'error'=>$error,
	    													    'main_cat'=>$main_cat,
	    													    'administrator'=>$administrator,
	    													    'productClass'=>$productClass));		
   }
   
   public function postEdit($id) {	  
	  	
	  $file = Input::file('image');
     $category = Category::find($id);
	  if($file != "") {		  	
	  	  $path = Input::file('image')->getRealPath();
		  list($width, $height) = getimagesize($path);
		  if($width == "248" && $height == "113") {
		  	    $destinationPath = 'upload/category/'.$category->id.'/';
			   $filename = $file->getClientOriginalName();
			   Input::file('image')->move($destinationPath, $filename);	   
			   $category->fldCategoryImage = $filename;
			   
			   //resize the image to 400px
			   $img = Image::make($destinationPath.$filename)->resize(400, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
			   $img->save($destinationPath.'_400_'.$filename, 90);
			   //resize the image to 75px
			   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
			   $img->save($destinationPath.'_75_'.$filename, 90);		
			   	 
			   
		   } else {
			   Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!.");  
		       return Redirect::to('dnradmin/category/edit/'.$id.'/2')->withInput();	
		       exit();  		
		   }
	  }
		
	  	 
	   $category->fldCategoryName = Input::get('name');	 
	   $category->fldCategoryDescription = Input::get('description');
	   $backid = Input::get('backid');
	   $main_id = $category->fldCategoryMainID;
	  
	  
	   //generate slug
	   $pageCount = Category::where('fldCategoryName','=',Input::get('name'))
	   						  ->where('fldCategoryID','!=',$id)
	   						  ->count();
	    $slug = $pageCount == 0 ? str_slug($category->fldCategoryName,'-') : str_slug($category->fldCategoryName."-".$pageCount,'-');

		$category->fldCategorySlug = $slug;				
	   
	   $category->save();
	   
	   
	   //$categories = CategoryManagement::orderby('position')->get(); 
	   //return View::make('_admin.category_view', array('category' => $categories,'category_id'=>$main_id));
	   //return Redirect::to('dnradmin/category/view/'.$main_id);
	    if($backid == 0) {
	       Session::flash('success',"Category was successfully saved.");  	
		   return Redirect::to('dnradmin/products/new'); 
	   } else if($backid == 1)  {
	   	   Session::flash('success',"Category was successfully saved.");  	
		   return Redirect::to('dnradmin/products/edit/'.$backid);
	   } else {
		   Session::flash('success',"Category was successfully saved.");  
		   return Redirect::to('dnradmin/category/edit/'.$id.'/2');
	   }
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		 $category = Category::find($id);
		 if(empty($category)) {
		 	return Redirect::to('dnradmin/category');
		 	exit();
		 }
		 $mainid = $category->fldCategoryMainID;
		 $position = $category->fldCategoryPosition;
		 
		 $image1 = 'upload/category/'.$category->fldCategoryID.'/'.$category->fldCategoryImage;
		 $image2 = 'upload/category/'.$category->fldCategoryID.'/_75_'.$category->fldCategoryImage;
		 $image3 = 'upload/category/'.$category->fldCategoryID.'/_400_'.$category->fldCategoryImage;
		 $main_id = $category->main_id;
		  
		File::delete($image1);
		File::delete($image2);
		File::delete($image3);
		
		
		
		$category->delete();
		
		//update all category positions
		
		$categoryPos = Category::where("fldCategoryPosition",">",$position)
							->where("fldCategoryMainID","=",$mainid)
							->orderby("fldCategoryPosition")
							->get();
		
		
		foreach($categoryPos as $categoryPoss) {
			 $categoryUpdate = Category::find($categoryPoss->id);			 
			 	$categoryUpdate->fldCategoryPosition = $categoryPoss->fldCategoryPosition - 1;
			 $categoryUpdate->save();	
		}
		
		//$category = StaffManagement::paginate(20);
	    //return View::make('_admin.staff', array('category' => $category));
		//return Redirect::to('dnradmin/category/view/'.$main_id);
		$type="";
		$backid = 0;
		  if($type == "add") {
			   return Redirect::to('dnradmin/products/new'); 
		   } else if($type == "edit") {
			   return Redirect::to('dnradmin/products/edit/'.$backid);
		   } else {
			   return Redirect::to('dnradmin/category/view/'.$mainid);
		   }
	}
	
	public function displaySubCategory($category_id,$product_id) {
		$category = Category::where('fldCategoryMainID','=',$category_id)->orderby("fldCategoryPosition")->get();
		
		return View::make('_admin.product.category_display', array('category' => $category,
														           'category_id'=>$category_id,
														           'product_id'=>$product_id));	
	}
}
