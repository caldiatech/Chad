<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\PhotoGallery;
use App\Models\AdditionalPhotoGallery;
use App\Models\Pages;
use App\Models\Google;
use App\Models\TempCart;
use App\Models\Footer;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Image;
use File;
class PhotoGalleryController extends Controller
{
    public function getIndex()
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$photos = PhotoGallery::orderby('fldPhotoGalleryPosition')->get();        
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$photoClass = 'class=active';
        return View::make('_admin.photo_gallery.photos', array('photo' => $photos,
        													   'administrator'=>$administrator,
        													   'photoClass'=>$photoClass));
    }
	
  
   public function postIndex()
    {       
		
		$photos = PhotoGallery::orderby('fldPhotoGalleryPosition')->get();  
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();      
		$photoClass = 'class=active';
        return View::make('_admin.photo_gallery.photos', array('photo' => $photos,
        													   'administrator'=>$administrator,
        													   'photoClass'=>$photoClass));
        
    }	
	
	public function getNew()
   {
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   	
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$photoClass = 'class=active';
   		return View::make('_admin.photo_gallery.photos_add',array(
   																  'administrator'=>$administrator,
   																  'photoClass'=>$photoClass));
   } 
   
   public function getUpdatePosition() {
	   $pctr=0;
	  
		foreach(Input::get('page_manager') as $pageManager) {			
			$positionTR =  explode("_",$pageManager);			
			$position_id = $positionTR[0];			
								
			 $photos = PhotoGallery::find($position_id);	
			 if($photos) {			 
				 $photos->fldPhotoGalleryPosition = $pctr;	
				 $photos->save();				
			 }
			$pctr=$pctr+1;		
				 
			
		}
	   
		
   }
   
   
   public function postNew() {
	   
	   $path = Input::file('image')->getRealPath();
	   list($width, $height) = getimagesize($path);
	  
	   if($width == "990" && $height == "450") { 
	     	
			   $photos = new PhotoGallery;
			   $photos->fldPhotoGalleryName = Input::get('name');	 
			   $photos->fldPhotoGalleryDescription = Input::get('description');	   
			   $photos->save();	   	  
				   
			   $photos = PhotoGallery::find($photos->fldPhotoGalleryID);
			   
			   $file = Input::file('image');
			   if($file != "") {
				   $destinationPath = 'upload/photos/'.$photos->fldPhotoGalleryID.'/';
				   $filename = $file->getClientOriginalName();
				   Input::file('image')->move($destinationPath, $filename);	   
				   
				   $photos->fldPhotoGalleryImage = $filename;
				   
				   //resize the image to 400px
				   $img = Image::make($destinationPath.$filename)->resize(400, null, function ($constraint) {
					    $constraint->aspectRatio();
			  	    });
				   $img->save($destinationPath.'_400_'.$filename, 90);
					//resize the image to 300px
				   $img = Image::make($destinationPath.$filename)->resize(300, null, function ($constraint) {
					    $constraint->aspectRatio();
			       });
				   $img->save($destinationPath.'_300_'.$filename, 90);
				   //resize the image to 75px
				   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
			       });
				   $img->save($destinationPath.'_75_'.$filename, 90);		   		   
			   } else {
				   $photos->fldPhotoGalleryImage = "";
			   }
			   
				
				//CODE FOR MULTIPLE IMAGES
				$count = count(Input::file('images'));				
				$destinationPath = 'upload/photos/'.$photos->fldPhotoGalleryID.'/others/';
				if($count >1 ) { 			  
					$images = Input::file('images');

					for ($i=0; $i < $count; $i++)
					{
						
						//$UserImage = Input::file("images[0]");
						$UserImage = $images["{$i}"];
						
						$additional_filename = $UserImage->getClientOriginalName();
						$images["{$i}"]->move($destinationPath, $additional_filename);	   
						
						//save the other images to database					
					   $img = Image::make($destinationPath.$additional_filename)->resize(400, null, function ($constraint) {
					    	$constraint->aspectRatio();
			       		});
					   $img->save($destinationPath.'_400_'.$additional_filename, 90);
					   //resize the image to 300px
					   $img = Image::make($destinationPath.$additional_filename)->resize(300, null, function ($constraint) {
					    	$constraint->aspectRatio();
			       		});
					   $img->save($destinationPath.'_300_'.$additional_filename, 90);
					   //resize the image to 75px
					   $img = Image::make($destinationPath.$additional_filename)->resize(75, null, function ($constraint) {
					    	$constraint->aspectRatio();
			      		 });
					   $img->save($destinationPath.'_75_'.$additional_filename, 90);
					   
					   $addPhotos = new AdditionalPhotoGallery;
					   $addPhotos->fldPhotoGalleryID = $photos->fldPhotoGalleryID;
					   $addPhotos->fldAdditionalPhotoGalleryImage = $additional_filename;
					   $addPhotos->save();
					   
					}
				}
			   
					//get last position									
					$photosPosition = PhotoGallery::orderby("fldPhotoGalleryPosition","desc")->first();									
					$photos->fldPhotoGalleryPosition = $photosPosition->fldPhotoGalleryPosition+1;
				 
				//generate slug
				$photoCount = PhotoGallery::where('fldPhotoGalleryName','=',Input::get('name'))->count();
				$slug = $photoCount == 0 ? str_slug(Input::get('name'),'-') : str_slug(Input::get('name')."-".$photoCount,'-');	
				$photos->fldPhotoGallerySlug = $slug;
				 $photos->save();	
			   Session::flash('success',"Photo Gallery was successfully saved."); 		
			   return Redirect::to('dnradmin/photos/new');
	   } else {
		   Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!"); 
		   return Redirect::to('dnradmin/photos/new')->withInput();	
	   }
	  
   }
   
   public function getEdit($id) {	
   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		   
	   $photos =  PhotoGallery::where('fldPhotoGalleryID', '=', $id)->first();
	   $photos_additional =  AdditionalPhotoGallery::where('fldPhotoGalleryID', '=', $id)->get();	   
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
	   $photoClass = 'class=active';
	    return View::make('_admin.photo_gallery.photos_edit', array('photo' => $photos,
	    															'additional_photos' => $photos_additional,
	    															'administrator'=>$administrator,
	    															'photoClass'=>$photoClass));		
   }
   
   public function postEdit($id) {	  
		
	 $file = Input::file('image');
	 $photos = PhotoGallery::find($id);	 
	  if($file != "") {
		  	
	  	  $path = Input::file('image')->getRealPath();
		  list($width, $height) = getimagesize($path);
		   if($width != "990" && $height != "450") {
			   Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!"); 
		       return Redirect::to('dnradmin/photos/edit/'.$id)->withInput();	
		   } else {
			   $destinationPath = 'upload/photos/'.$photos->fldPhotoGalleryID.'/';
			   $filename = $file->getClientOriginalName();
			   Input::file('image')->move($destinationPath, $filename);	   
			   $photos->fldPhotoGalleryImage = $filename;
			   
			   //resize the image to 400px
			   $img = Image::make($destinationPath.$filename)->resize(400, null, function ($constraint) {
					    	$constraint->aspectRatio();
			   	});
			   $img->save($destinationPath.'_400_'.$filename, 90);
				//resize the image to 300px
			   $img = Image::make($destinationPath.$filename)->resize(300, null, function ($constraint) {
					    	$constraint->aspectRatio();
			   });
			   $img->save($destinationPath.'_300_'.$filename, 90);
			   //resize the image to 75px
			   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    	$constraint->aspectRatio();
			   });
			   $img->save($destinationPath.'_75_'.$filename, 90);
		   }
	  }
	  	
	   
	   $photos->fldPhotoGalleryName = Input::get('name');	  	    
	   $photos->fldPhotoGalleryDescription = Input::get('description');
	   
	   
	   
	   //CODE FOR MULTIPLE IMAGES
	   if(Input::file('images') != "") { 
			$count = count(Input::file('images'));	
			$destinationPath = 'upload/photos/'.$photos->fldPhotoGalleryID.'/others/';
				for ($i=0; $i < $count; $i++)
				{	
					if(Input::file("images[{$i}]") != NULL) { 
						$additional_filename = Input::file("images[{$i}]")->getClientOriginalName();
						Input::file("images[{$i}]")->move($destinationPath, $additional_filename);	   
						
						//save the other images to database					
					   $img = Image::make($destinationPath.$additional_filename)->resize(400, null, function ($constraint) {
					    	$constraint->aspectRatio();
			   			});
					   $img->save($destinationPath.'_400_'.$additional_filename, 90);
					    //resize the image to 300px
		  				 $img = Image::make($destinationPath.$additional_filename)->resize(300, null, function ($constraint) {
					    	$constraint->aspectRatio();
			   			});
		  				 $img->save($destinationPath.'_300_'.$additional_filename, 90);
					   //resize the image to 75px
					   $img = Image::make($destinationPath.$additional_filename)->resize(75, null, function ($constraint) {
					    	$constraint->aspectRatio();
			   			});
					   $img->save($destinationPath.'_75_'.$additional_filename, 90);
					   
					   $addPhotos = new AdditionalPhotoGallery;
					   $addPhotos->fldPhotoGalleryID = $photos->fldPhotoGalleryID;
					   $addPhotos->image = $additional_filename;
					   $addPhotos->save();
					}
				}
	   }
	   
	   //generate slug
	   $photoCount = PhotoGallery::where('fldPhotoGalleryName','=',Input::get('name'))->where('fldPhotoGalleryID','!=',$id)->count();
	    $slug = $photoCount == 0 ? str_slug(Input::get('name'),'-') : str_slug(Input::get('name')."-".$photoCount,'-');
		$photos->fldPhotoGallerySlug = $slug;
		
	   $photos->save();

	  // $photos = PhotosManagement::all();
	   $photos = PhotoGallery::orderby('fldPhotoGalleryPosition')->get();       
	   //return View::make('_admin.photos', array('photo' => $photos));
	   Session::flash('success',"Photo Gallery was successfully saved."); 
	   return Redirect::to('dnradmin/photos/edit/'.$id);	
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$photos = PhotoGallery::find($id);

		if(empty($photos)) {
			return Redirect::to('dnradmin/photos');
			exit();
		}

		$position = $photos->fldPhotoGalleryPosition;
		
		 $image1 = 'upload/photos/'.$photos->fldPhotoGalleryID.'/'.$photos->fldPhotoGalleryImage;
		 $image2 = 'upload/photos/'.$photos->fldPhotoGalleryID.'/_75_'.$photos->fldPhotoGalleryImage;
		 $image3 = 'upload/photos/'.$photos->fldPhotoGalleryID.'/_400_'.$photos->fldPhotoGalleryImage;
		 $image3 = 'upload/photos/'.$photos->fldPhotoGalleryID.'/_300_'.$photos->fldPhotoGalleryImage;
		 
		File::delete($image1);
		File::delete($image2);
		File::delete($image3);
						
		$photos->delete();
		
		//update all photos positions
		$pho = PhotoGallery::where("fldPhotoGalleryPosition",">",$position)->orderby("fldPhotoGalleryPosition")->get();
		
		
		foreach($pho as $phos) {
			 $photoUpdate = PhotoGallery::find($phos->fldPhotoGalleryID);
			 	$photoUpdate->fldPhotoGalleryPosition = $phos->fldPhotoGalleryPosition - 1;
			 $photoUpdate->save();	
		}
		
		$photos = PhotoGallery::orderby("fldPhotoGalleryPosition")->paginate(20);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$photoClass = 'class=active';
	    return View::make('_admin.photo_gallery.photos', array('photo' => $photos,
	    													   'administrator'=>$administrator,
	    													   'photoClass'=>$photoClass));
	}
	
	public function getDelete1($id,$delete) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$photos = AdditionalPhotoGallery::find($delete);
		 $image1 = 'upload/photos/others/'.$id.'/'.$photos->fldAdditionalPhotoGalleryImage;
		 $image2 = 'upload/photos/others/'.$id.'/_75_'.$photos->fldAdditionalPhotoGalleryImage;
		 $image3 = 'upload/photos/others/'.$id.'/_400_'.$photos->fldAdditionalPhotoGalleryImage;
		 
		File::delete($image1);
		File::delete($image2);
		File::delete($image3);
		
				
		$photos->delete();
		return Redirect::to('dnradmin/photos/edit/'.$id);			    
	}	
	
	public function gallery() {
		//$photos = PhotoGallery::orderby('fldPhotoGalleryPosition')->get();  
		 $pages = Pages::where('fldPagesSlug', '=', 'image-galleries')->first();	
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();		
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$footer = Footer::first();
		
   		return View::make('home.photos',array('pages' => $pages,
   													'menus' => $menus,   													
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count,
   													'footer'=>$footer));
	}
	
	public function details($slug) {
		$photos = PhotoGallery::where('fldPhotoGallerySlug','=',$slug)->first(); 
		$photos_additional =  AdditionalPhotoGallery::where('fldPhotoGalleryID', '=', $photos->fldPhotoGalleryID)->get();	       
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$footer = Footer::first();
		
		return View::make('home.photos_details', array('photo' => $photos,
													   'photos_additional'=>$photos_additional,
													   'menus' => $menus,
													   'settings'=>$settings,
													   'google'=>$google,
													   'footer'=>$footer,
													   'cart_count'=>$cart_count));
	}
	
}
