<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Staff;
use App\Models\Pages;
use App\Models\Google;
use App\Models\Footer;
use App\Models\TempCart;
use View;
use Input;
use Hash;
use Redirect;
use Session;
use Image;
use File;

class StaffController extends Controller
{
    public function getIndex()
    {   
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		    
		$staff = Staff::orderby('fldStaffPosition')->get();        
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$staffClass = 'class=active';
        return View::make('_admin.staff.staff', array('staff' => $staff,
        											  'administrator'=>$administrator,
        											  'staffClass'=>$staffClass));
    }
	
  
   public function postIndex()
    {       
		
		$staff = Staff::orderby('fldStaffPosition')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();        
		$staffClass = 'class=active';
        return View::make('_admin.staff.staff', array('staff' => $staff,
        										      'administrator'=>$administrator,
        										      'staffClass'=>$staffClass));
        
    }	
	
	public function getNew()
   {
	   	//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
	   	
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();        
		$staffClass = 'class=active';
   		return View::make('_admin.staff.staff_add',array(
   														 'administrator'=>$administrator,
   														 'staffClass'=>$staffClass));
   } 
   
   public function getUpdatePosition() {
	   $pctr=0;
	  
		foreach(Input::get('page_manager') as $pageManager) {			
			$positionTR =  explode("_",$pageManager);			
			$position_id = $positionTR[0];			
								
			 $staffs = Staff::find($position_id);	
			 if($staffs) {			 
				 $staffs->fldStaffPosition = $pctr;	
				 $staffs->save();				
			 }
			$pctr=$pctr+1;		
				 
			
		}
	   
		
   }
   
   
   public function postNew() {
	  
	   $path = Input::file('image')->getRealPath();
	   list($width, $height) = getimagesize($path);
	  
	   if($width == "218" && $height == "330") { 
	      	
			   $staffs = new Staff;
			   $staffs->fldStaffFirstname = Input::get('firstname');	 
			   $staffs->fldStaffLastname = Input::get('lastname');	 
			   $staffs->fldStaffDepartment = Input::get('department');	 
			   $staffs->fldStaffDescription = Input::get('description');
			   $staffs->save();	   	  
				   
			   $staffs = Staff::find($staffs->fldStaffID);
			   
			   $file = Input::file('image');
			   if($file != "") {
				   $destinationPath = 'upload/staff/'.$staffs->fldStaffID.'/';
				   $filename = $file->getClientOriginalName();
				   Input::file('image')->move($destinationPath, $filename);	   
				   
				   $staffs->fldStaffImage = $filename;
				   
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
				   $staffs->fldStaffImage = "";
			   }
			   
				//get last position
				$staffPosition = Staff::orderby("fldStaffPosition","desc")->first();
				$staffs->fldStaffPosition = $staffPosition->fldStaffPosition+1;				
			   	$staffs->save();

			  Session::flash('success',"Staff was successfully saved."); 
			  return Redirect::to('dnradmin/staff/new');
	   } else {
		   Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!"); 
		   return Redirect::to('dnradmin/staff/new')->withInput();	
	   }
	  
   }
   
   public function getEdit($id) {
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   
	   $staff =  Staff::where('fldStaffID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
	    $staffClass = 'class=active';
	    return View::make('_admin.staff.staff_edit', array('staff' => $staff,	    												   
	    												   'administrator'=>$administrator,
	    												   'staffClass'=>$staffClass));		
   }
   
   public function postEdit($id) {	  

	$file = Input::file('image');
	$staffs = Staff::find($id);
	  if($file != "") {
		  	
	  	  $path = Input::file('image')->getRealPath();
		  list($width, $height) = getimagesize($path);
		   if($width != "218" && $height != "330") {
			 Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!"); 
		       return Redirect::to('dnradmin/staff/edit/'.$id)->withInput();	
		   } else {
			  $destinationPath = 'upload/staff/'.$id.'/';
			   $filename = $file->getClientOriginalName();
			   Input::file('image')->move($destinationPath, $filename);	   
			   $staffs->fldStaffImage = $filename;
			   
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
		   }
	  }
	  
	   	 
	   $staffs->fldStaffFirstname = Input::get('firstname');	 
	   $staffs->fldStaffLastname = Input::get('lastname');	 
	   $staffs->fldStaffDepartment = Input::get('department');	

	   $staffs->fldStaffDescription = Input::get('description');
	   
	   $file = Input::file('image');
	  
	   $staffs->save();
	   
	   $staff = Staff::orderby('fldStaffPosition')->get(); 
	   //return View::make('_admin.staff', array('staff' => $staff));
	     Session::flash('success',"Staff was successfully saved."); 
	   return Redirect::to('dnradmin/staff/edit/'.$id);	
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$staffs = Staff::find($id);

		if(empty($staffs)) {
			return Redirect::to('dnradmin/staff');
			exit();
		}

		$position = $staffs->fldStaffPosition;
		
		 $image1 = 'upload/staff/'.$staffs->fldStaffID.'/'.$staffs->fldStaffImage;
		 $image2 = 'upload/staff/'.$staffs->fldStaffID.'/_75_'.$staffs->fldStaffImage;
		 $image3 = 'upload/staff/'.$staffs->fldStaffID.'/_400_'.$staffs->fldStaffImage;
		 
		File::delete($image1);
		File::delete($image2);
		File::delete($image3);
						
		$staffs->delete();
		
		//update all staff positions
		$staf = Staff::where("fldStaffPosition",">",$position)->orderby("fldStaffPosition")->get();
		
		
		foreach($staf as $stafs) {
			 $staffUpdate = Staff::find($stafs->id);
			 	$staffUpdate->fldStaffPosition = $stafs->fldStaffPosition - 1;
			 $staffUpdate->save();	
		}
		
		$staff = Staff::orderby("fldStaffPosition")->paginate(20);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
		$staffClass = 'class=active';
	    return View::make('_admin.staff.staff', array('staff' => $staff,
	    											  'administrator'=>$administrator,
	    											  'staffClass'=>$staffClass));
	}
	
	public function gallery() {
		$staff = Staff::orderby('fldStaffPosition')->get();     				
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$footer = Footer::first();
						
		return View::make('home.staff')->with(array('staff' => $staff,
													'menus' => $menus,
													'settings'=>$settings,
													'google'=>$google,
													'footer'=>$footer,
													'cart_count'=>$cart_count));
	}
	
}
