<?php
 
namespace App\Models;
use App\Models\AdditionalProduct;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Image;
use File;
use Validator;
use Request;

class Product extends Eloquent
{
   
    protected $table = 'tblProduct';
    protected $primaryKey = 'fldProductID';
    public $timestamps = false;

    public static function rules($id) {

		Validator::extend('img_min_size', function($attribute, $value, $parameters)
    	{
	            $file = Request::file($attribute);
	            $image_info = getimagesize($file);
	            $image_width = $image_info[0];
	            $image_height = $image_info[1];
	            if($image_width >= $parameters[0] && $image_height >= $parameters[1]) {
	            	return true;
	            } 
	            
	            return false;
	            
	    });

		if($id==0) {
			$rules = [
			'name'         => 'required|max:255',
			'sub_title'    => 'required|max:255',                 		       
		        'old_price'    => 'required|numeric',
		        'price'    	   => 'required|numeric',
		        'weight'   	   => 'required|numeric',
		        'image' 	   => 'required|img_min_size:'.PRODUCT_IMAGE_WIDTH.','.PRODUCT_IMAGE_HEIGHT.'|mimes:jpeg,gif,png'		        
			];
		} else {
			$rules = [
			'name'         => 'required|max:255',                 		       
			'sub_title'    => 'required|max:255',
		        'old_price'    => 'required|numeric',
		        'price'    	   => 'required|numeric',
		        'weight'   	   => 'required|numeric',
		        'image' 	   => 'img_min_size:'.PRODUCT_IMAGE_WIDTH.','.PRODUCT_IMAGE_HEIGHT.'|mimes:jpeg,gif,png'		        
			];
		}	
		

		return $rules;
	}

    static function multipleUpload($files,$slug,$product_id) {
		$notUploaded="";

		foreach($files as $file) {
			$destinationPath = PRODUCT_IMAGE_PATH.$slug.'/others/';	

			 if($file != "") {
					 $path = $file->getRealPath();
				  	 list($width, $height) = getimagesize($path);
				   	 if($width >= PRODUCT_IMAGE_WIDTH && $height >= PRODUCT_IMAGE_HEIGHT) {
				   	 	$additional_filename = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'.$file->getClientOriginalExtension();	
						$file->move($destinationPath, $additional_filename);

						if(!File::exists($destinationPath.THUMB_IMAGE)) {												
							File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);	
							File::makeDirectory($destinationPath.SMALL_IMAGE, 0775);		
							File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);							
						}

						//save the other images to database					
						$img = Image::make($destinationPath.$additional_filename)->resize(456, 376);
						$img->save($destinationPath.MEDIUM_IMAGE.$additional_filename, 90);
						//resize  the image to 140px
						$img = Image::make($destinationPath.$additional_filename)->resize(250, null, function ($constraint) {
							$constraint->aspectRatio();
						});
						$img->save($destinationPath.SMALL_IMAGE.$additional_filename, 90);
						//resize the image to 75px
						$img = Image::make($destinationPath.$additional_filename)->resize(75, null, function ($constraint) {
							$constraint->aspectRatio();
						});
						$img->save($destinationPath.THUMB_IMAGE.$additional_filename, 90);
											   
						$addProductsImages = new AdditionalProduct;
							$addProductsImages->fldAdditionalProductProductID = $product_id;
							$addProductsImages->fldAdditionalProductIDImage = $additional_filename;
						$addProductsImages->save();

				   	 } else {
				   	 	$notUploaded .= $file->getClientOriginalName() ."<br>";
				   	 } // if width and height
			} //if file != ""	   	 

		}

		return $notUploaded;

	}

	static function uploadSingleImage($file,$slug) {
		
		if($file != "") {
			$destinationPath = PRODUCT_IMAGE_PATH.$slug.'/';						   
			$filename = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'.$file->getClientOriginalExtension();
			$file->move($destinationPath, $filename);	

			if(!File::exists($destinationPath.THUMB_IMAGE)) {												
				File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);	
				File::makeDirectory($destinationPath.SMALL_IMAGE, 0775);		
				File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);							
			}

			//$img = Image::make($destinationPath.$filename)->resize(456, 376);
			$img = Image::make($destinationPath.$filename)->resize(null, 376, function ($constraint) {
			    $constraint->aspectRatio();
			});
			$img->save($destinationPath.MEDIUM_IMAGE.$filename, 90);
			//resize the image to 140px
			$img = Image::make($destinationPath.$filename)->resize(250, null, function ($constraint) {
			    $constraint->aspectRatio();
			});
			$img->save($destinationPath.SMALL_IMAGE.$filename, 90);
			//resize the image to 75px
			$img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($destinationPath.THUMB_IMAGE.$filename, 90);	
			
		} else {
			$filename = "";
		}

		return $filename;
	}	
		
}


?>