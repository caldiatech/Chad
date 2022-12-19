<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\HomeSlide;
use View;
use Input;
use Hash;
use Redirect;
use Session;
use Image;
use File;

class HomeSlideController extends Controller
{
    public function getIndex()
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$homeslide = HomeSlide::orderby('fldHomeSlidePosition')->get();        
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   
		
		$homeSlideClass = 'class=active';
        return View::make('_admin.homeslide.homeslide', array('homeslide' => $homeslide,
        													  'administrator'=>$administrator,
        													  'homeSlideClass'=>$homeSlideClass));
    }
	
  
   public function postIndex()
    {       
		
		$homeslide = HomeSlide::orderby('fldHomeSlidePosition')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();           
		$homeSlideClass = 'class=active';
        return View::make('_admin.homeslide.homeslide', array('homeslide' => $homeslide,
        													  'administrator'=>$administrator,
        													  'homeSlideClass'=>$homeSlideClass));
        
    }	
	
	public function getNew()
   {
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   	
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();           
		$homeSlideClass = 'class=active';
   		return View::make('_admin.homeslide.homeslide_add',array(
   																 'administrator'=>$administrator,
   																 'homeSlideClass'=>$homeSlideClass));
   } 
   
   public function getUpdatePosition() {
	   $pctr=0;
	  
		foreach(Input::get('page_manager') as $pageManager) {			
			$positionTR =  explode("_",$pageManager);			
			$position_id = $positionTR[0];			
								
			 $homeslide = HomeSlide::find($position_id);	
			 if($homeslide) {			 
				 $homeslide->position = $pctr;	
				 $homeslide->save();				
			 }
			$pctr=$pctr+1;		
				 
			
		}
	   
		
   }
   
   
   public function postNew() {
	     		   	  
	   $path = Input::file('image')->getRealPath();
	   list($width, $height) = getimagesize($path);
	  
	   if($width == "1920" && $height == "715") { 
		   $homeslide = new HomeSlide;
		   $homeslide->fldHomeSlideName = Input::get('name');	 
		   $homeslide->fldHomeSlideLinks = Input::get('links');	 
		   $homeslide->fldHomeSlideDescription = Input::get('description');	   
		   
		   $homeslide->save();	   	  	   	   
		   $homeslide = HomeSlide::find($homeslide->fldHomeSlideID);
	   	   
		   $file = Input::file('image');
			
		   if($file != "") {
			   $destinationPath = 'uploads/home-sliders/';

			   $filename = $file->getClientOriginalName();
			   
			   Input::file('image')->move($destinationPath, $filename);	   
			   
			   $homeslide->fldHomeSlideImage = $filename;
			   
			   //resize the image to 400px
			   $img = Image::make($destinationPath.$filename)->resize(990, null, function ($constraint) {
					    $constraint->aspectRatio();
			   });
			   $img->save($destinationPath.'_990_'.$filename, 90);
			   //resize the image to 75px
			   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
			   });
			   $img->save($destinationPath.'_75_'.$filename, 90);		   		   
		   } else {
			   $homeslide->fldHomeSlideImage = "";
		   }

		   
			   //get last position
				$homeSlidePosition = HomeSlide::orderby("fldHomeSlidePosition","desc")->first();
				$homeslide->fldHomeSlidePosition = $homeSlidePosition->fldHomeSlidePosition+1;
				$homeslide->save();

				 Session::flash('success',"Home Slide was successfully saved."); 			
		  		return Redirect::to('dnradmin/homeslides/new');		
	   } else {
		   Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!"); 
		   return Redirect::to('dnradmin/homeslides/new')->withInput();	
	   }
	  
   }
   
   public function getEdit($id,$success=0,$error=0) {	
   		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		   
	   $homeslide =  HomeSlide::where('fldHomeSlideID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
	    $homeSlideClass = 'class=active';
	    return View::make('_admin.homeslide.homeslide_edit', array('homeslide' => $homeslide,
	    														   'success'=>$success,
	    														   'error'=>$error,
	    														   'administrator'=>$administrator,
	    														   'homeSlideClass'=>$homeSlideClass));		
   }
   
   public function postEdit($id) {	  
	  
	  $file = Input::file('image');
      $homeslide = HomeSlide::find($id);	 
	  
	  if($file != "") {
		  	
	  	 $path = Input::file('image')->getRealPath();
	  	 list($width, $height) = getimagesize($path);

		  if($width != "1920" && $height != "715") { 
			   Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!"); 
		       return Redirect::to('dnradmin/homeslides/edit/'.$id)->withInput();	
		   } else {
			   $destinationPath = 'uploads/home-sliders/';
			   $filename = $file->getClientOriginalName();
			   Input::file('image')->move($destinationPath, $filename);	   
			   $homeslide->fldHomeSlideImage = $filename;
			   
			   //resize the image to 400px
			   $img = Image::make($destinationPath.$filename)->resize(990, null, function ($constraint) {
					    $constraint->aspectRatio();
			   });
			   $img->save($destinationPath.'_990_'.$filename, 90);
			   //resize the image to 75px
			   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
			   });
			   $img->save($destinationPath.'_75_'.$filename, 90);
		   }
	  }
	  

	    	
	  
	   $homeslide->fldHomeSlideName = Input::get('name');	  	    
	   $homeslide->fldHomeSlideLinks = Input::get('links');	 
	   $homeslide->fldHomeSlideDescription = Input::get('description');
	   	 
	   $homeslide->save();

	  // $photos = HomeSlideManagement::all();
	   $homeslide = HomeSlide::orderby('fldHomeSlidePosition')->get();       
	   //return View::make('_admin.homeslide', array('homeslide' => $homeslide));
	   Session::flash('success',"Home Slide was successfully saved."); 
	   return Redirect::to('dnradmin/homeslides/edit/'.$id);	
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			
		$homeslide = HomeSlide::find($id);	

		if(empty($homeslide)) {
			return Redirect::to('dnradmin/homeslides');
			exit();
		}

		$position = $homeslide->fldHomeSlidePosition;
		
		 $image1 = 'upload/homeslide/'.$homeslide->fldHomeSlideImage;
		 $image2 = 'upload/homeslide/_75_'.$homeslide->fldHomeSlideImage;
		 $image3 = 'upload/homeslide/_400_'.$homeslide->fldHomeSlideImage;
		 
		 File::delete($image1);
		 File::delete($image2);
		 File::delete($image3);		
		
		$homeslide->delete();
		
		//update all home slide positions
		$homes = HomeSlide::where("fldHomeSlidePosition",">",$position)->orderby("fldHomeSlidePosition")->get();
		
		
		foreach($homes as $homess) {
			 $homeUpdate = HomeSlide::find($homess->fldHomeSlideID);
			 	$homeUpdate->fldHomeSlidePosition = $homess->fldHomeSlidePosition - 1;
			 $homeUpdate->save();	
		}
		
		$homeslide = HomeSlide::paginate(20);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
	    return View::make('_admin.homeslide.homeslide', array('homeslide' => $homeslide,'administrator'=>$administrator));
	}
	
}
