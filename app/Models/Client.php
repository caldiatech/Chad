<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Validator;
use File;
use Image;
use Request;


class Client extends Eloquent
{

    protected $table = 'tblClient';
    protected $primaryKey = 'fldClientID';
	public $timestamps = false;


    public static function rules($id) {

		if($id == 0) {
			$rules = [
				'firstname'        => 'required|max:255',
				'lastname'         => 'required|max:255',
		        'email'            => 'required|email',
		        // 'email'            => 'required|email|unique:tblClient,fldClientEmail',
		        'phone' 		   => 'required',
		        'password'         => 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/'
			];
		} else {
			$rules = [
				'firstname'        => 'required|max:255',
				'lastname'         => 'required|max:255',
		        'email'            => 'required|email',
		        // 'email'            => 'required|email|unique:tblClient,fldClientEmail,'.$id.',fldClientID',
		        'phone' 		   => 'required',
		        'password'         => 'min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/'

			];
		}


		return $rules;
	}

   public static function rulesLogin() {
		$rules = [
				'email'           => 'required|email',
				'password'        => 'required|max:255'
			];

		return $rules;
   }

   public static function rulesRegistration() {
		$rules = [
			'firstname'        				=> 'required|max:255',
			'lastname'         				=> 'required|max:255',
		        'email'            				=> 'required|email',
		        'password'         				=> 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/|confirmed',
		        'phone' 	       				=> 'required',
		        'password_confirmation'         		=> 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/'

			];

		return $rules;
	}

   public static function rulesResetPassword() {
		$rules = [
		        'password'         		=> 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/|confirmed'
			];

			return $rules;
	}

   public static function rulesUpdateProfile($id) {
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


			$rules = [
				'firstname'        => 'required|max:255',
				'lastname'         => 'required|max:255',
				'phone' 		   => 'required',
		        'email'            => 'required|email',
		        'username'         => 'required|email',
			'address' 		   	   => 'required',
		        'city' 		   	   => 'required',
		        'state' 		   => 'required',
		        'zip' 		       => 'required|numeric',
			'shipping_address'    => 'required',
		        'shipping_city'    => 'required',
		        'shipping_state'   => 'required',
		        'shipping_zip'     => 'required|numeric',
			'password'         => 'min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
			'image' 	       => 'img_min_size:'.PROFILE_IMAGE_WIDTH.','.PROFILE_IMAGE_HEIGHT.'|mimes:jpeg,gif,png'
		    ];

		    $messages = [
		    	'firstname.required'       => 'Please enter your First name',
				'firstname.max'     	   => 'Max character for First name is 255',
				'lastname.required'        => 'Please enter your Last name',
				'lastname.max'     	       => 'Max character for Last name is 255',
				'phone.required' 		   => 'Please enter your Contact no',
		        'email.required'           => 'Please enter your email address',
		        'email.email'         	   => 'Please enter your valid email address',
				'email.unique'         	   => 'Email address already taken.',
		        'username.required'        => 'Please enter your username',
		        'username.unique'          => 'Username is already taken.',
			'address.required' 		   => 'Please enter your address',
		        'city.required' 		   => 'Please enter your city',
		        'state.required' 		  		   => 'Please enter your state',
		        'zip.required' 		       		   => 'Please enter your ZIP',
			'shipping_address.required'    		   => 'Please enter your address',
		        'shipping_city.required'    		   => 'Please enter your city',
		        'shipping_state.required'  		   => 'Please enter your state',
		        'shipping_zip.required'     		   => 'Please enter your zip',
			 'password.regex'     => 'Password should contain at least an upper case, a number, a special character and at least 8 char',
			'image.img_min_size' => 			IMAGES_DIMENSION_ERROR,
		        'image.mimes' => 			'Invalid Image. Please upload .jpg,.gif,.png format'
		    ];

			return [$rules,$messages];

	}

	public static function rulesSettings($id) {
		$rules = [

		        'email'            => 'required|email',
			'password'         => 'min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/'

		    ];

		    $messages = [

		        'email.required'           => 'Please enter your email address',
		        'email.email'         	   => 'Please enter your valid email address',
			'password.regex'     => 'Password should contain at least an upper case letter, a number, a special character and at least 8 char',
			'email.unique'         	   => 'Email address is already taken.'

		    ];

			return [$rules,$messages];
	}

	static function uploadSingleImage($file,$id) {

		if($file != "") {
			$destinationPath = CUSTOMER_IMAGE_PATH.$id.'/';
			$filename = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'.$file->getClientOriginalExtension();
			$file->move($destinationPath, $filename);

			if(!File::exists($destinationPath.THUMB_IMAGE)) {
				File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);
				File::makeDirectory($destinationPath.SMALL_IMAGE, 0775);
				File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);
			}

			$img = Image::make($destinationPath.$filename)->resize(400, null);
			$img->save($destinationPath.MEDIUM_IMAGE.$filename, 90);
			//resize the image to 140px
			$img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
			    $constraint->aspectRatio();
			});
			$img->save($destinationPath.SMALL_IMAGE.$filename, 90);
			//resize the image to 75px
			$img = Image::make($destinationPath.$filename)->resize(39, 39, function ($constraint) {
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
