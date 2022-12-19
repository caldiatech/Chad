<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Validator;
use Request;

class HomeSlide extends Eloquent
{
   
    protected $table = 'tblHomeSlide';
    protected $primaryKey = 'fldHomeSlideID';
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
		        'links'        => 'required|max:255',
		        'linkname'     => 'required|max:255',
		        'description'  => 'required',
		        'image' 	   => 'required|img_min_size:'.HOMESLIDE_IMAGE_WIDTH.','.HOMESLIDE_IMAGE_HEIGHT.'|mimes:jpeg,gif,png'		        
			];
		} else {
			$rules = [
				'name'         => 'required|max:255',                 
		        'links'        => 'required|max:255',
		        'linkname'     => 'required|max:255',
		        'description'  => 'required',
		        'image' 	   => 'img_min_size:'.HOMESLIDE_IMAGE_WIDTH.','.HOMESLIDE_IMAGE_HEIGHT.'|mimes:jpeg,gif,png'		        
			];
		}	
		

		return $rules;
	}
}


?>