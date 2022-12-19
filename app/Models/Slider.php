<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Validator;
use Request;

class Slider extends Eloquent
{
   
    protected $table = 'tblSlider';
    protected $primaryKey = 'fldSliderID';
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
		        'title1'  	   => 'required|max:255',
		        'description1' => 'required',
		        'title2'  	   => 'required|max:255',
		        'description2' => 'required',
		        'title3'  	   => 'required|max:255',
		        'description3' => 'required',
		        'image' 	   => 'required|img_min_size:'.SLIDER_IMAGE_WIDTH.','.SLIDER_IMAGE_HEIGHT.'|mimes:jpeg,gif,png'		        
			];
		} else {
			$rules = [
				'name'         => 'required|max:255',                 
		        'links'        => 'required|max:255',
		        'linkname'     => 'required|max:255',
		        'title1'  	   => 'required|max:255',
		        'description1' => 'required',
		        'title2'  	   => 'required|max:255',
		        'description2' => 'required',
		        'title3'  	   => 'required|max:255',
		        'description3' => 'required',
		        'image' 	   => 'img_min_size:'.SLIDER_IMAGE_WIDTH.','.SLIDER_IMAGE_HEIGHT.'|mimes:jpeg,gif,png'		        
			];
		}	
		

		return $rules;
	}
}


?>