<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Slider;
use Illuminate\Support\Str;
use View;
use Input;
use Hash;
use Redirect;
use Session;
use Image;
use File;
use Validator;

class SliderController extends Controller
{
    public function getIndex()
    {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$slider = Slider::orderby('fldSliderPosition')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		//$SliderCategory = SliderCategory::all();

		$pageClass = 'class=active';
        return View::make('_admin.slider.slider', array('slider' => $slider,
        													  'administrator'=>$administrator,
        													  'pageClass'=>$pageClass));

    }



   public function postIndex()
    {

		$slider = Slider::orderby('fldSliderPosition')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$pageClass = 'class=active';
        return View::make('_admin.slider.slider', array('slider' => $slider,
        													  'administrator'=>$administrator,
        													  'pageClass'=>$pageClass));

    }

	public function getNew()
   {
	   //if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$pageClass = 'class=active';
   		return View::make('_admin.slider.slider_add',array(
   																 'administrator'=>$administrator,
   																 'pageClass'=>$pageClass));
   }

   public function getUpdatePosition() {
	   $pctr=0;

		foreach(Input::get('page_manager') as $pageManager) {
			if($pctr >0) {

			$positionTR =  explode("_",$pageManager);
			$position_id = $positionTR[0];

			 $slider = Slider::find($position_id);
			 if($slider) {
				 $slider->fldSliderPosition = $pctr;
				 $slider->save();
			 }

			}
                      $pctr=$pctr+1;


		}


   }


   public function postNew() {

	  $rules   = Slider::rules(0);
	  $validator = Validator::make(Input::all(), $rules);

	  if ($validator->fails()) {
	        return Redirect::to('dnradmin/slider/new')->withInput()->withErrors($validator,'slider');
	  } else {
		   $slider = new Slider;
		   $slider->fldSliderName = Input::get('name');
		   $slider->fldSliderButtonLink = Input::get('links');
	  	   $slider->fldSliderButtonLinkText = Input::get('linkname');
	  	   $slider->fldSliderTitle1 = Input::get('title1');
	  	   $slider->fldSliderContent1 = Input::get('description1');
	  	   $slider->fldSliderTitle2 = Input::get('title2');
	  	   $slider->fldSliderContent2 = Input::get('description2');
	  	   $slider->fldSliderTitle3 = Input::get('title3');
	  	   $slider->fldSliderContent3 = Input::get('description3');

		   $slider->save();
		   $slider = Slider::find($slider->fldSliderID);

		   $file = Input::file('image');

		   if($file != "") {
			      $destinationPath = SLIDER_IMAGE_PATH.'/';
			  	   $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'.$file->getClientOriginalExtension();
				   Input::file('image')->move($destinationPath, $filename);

				   $slider->fldSliderImage = $filename;

				   //create folder for cropping of images
						if(!File::exists($destinationPath.MEDIUM_IMAGE)) {
							File::makeDirectory($destinationPath.LARGE_IMAGE, 0775);
							File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);
							File::makeDirectory($destinationPath.SMALL_IMAGE, 0775);
							File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);
						}
				   //resize the image to 400px
				   $img = Image::make($destinationPath.$filename)->resize(1919, 724, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.LARGE_IMAGE.$filename, 90);
									   //resize the image to 400px
				   $img = Image::make($destinationPath.$filename)->resize(990, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.MEDIUM_IMAGE.$filename, 90);
				   //resize the image to 140px
				   $img = Image::make($destinationPath.$filename)->resize(360, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.SMALL_IMAGE.$filename, 90);
				   //resize the image to 75px
				   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.THUMB_IMAGE.$filename, 90);
		   } else {
			   $slider->fldSliderImage = "";
		   }


			   //get last position
				$sliderPosition = Slider::orderby("fldSliderPosition","desc")->first();
				$slider->fldSliderPosition = $sliderPosition->fldSliderPosition+1;
				$slider->save();

				 Session::flash('success',"Slider was successfully saved.");
		  		return Redirect::to('dnradmin/slider/new');
	   }

   }

   public function getEdit($id,$success=0,$error=0) {
   		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

	   $slider =  Slider::where('fldSliderID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
	    $pageClass = 'class=active';
	    return View::make('_admin.slider.slider_edit', array('slider' => $slider,
	    														   'success'=>$success,
	    														   'error'=>$error,
	    														   'administrator'=>$administrator,
	    														   'pageClass'=>$pageClass));
   }

   public function postEdit($id) {
	  $rules   = Slider::rules($id);
	  $validator = Validator::make(Input::all(), $rules);

	  if ($validator->fails()) {
	        return Redirect::to('dnradmin/slider/edit/'.$id)->withInput()->withErrors($validator,'slider');
	  } else {
					  $file = Input::file('image');
				      $slider = Slider::find($id);
					  if($file != "") {


							   $destinationPath = SLIDER_IMAGE_PATH;
							  	   $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'.$file->getClientOriginalExtension();
								   Input::file('image')->move($destinationPath, $filename);

								   $slider->fldSliderImage = $filename;

								   //create folder for cropping of images
										if(!File::exists($destinationPath.MEDIUM_IMAGE)) {
											File::makeDirectory($destinationPath.LARGE_IMAGE, 0775);
											File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);
											File::makeDirectory($destinationPath.SMALL_IMAGE, 0775);
											File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);
										}
								   //resize the image to 1920px
								   $img = Image::make($destinationPath.$filename)->resize(1919, 724, function ($constraint) {
									    $constraint->aspectRatio();
									});
								   $img->save($destinationPath.LARGE_IMAGE.$filename, 90);
									//resize the image to 400px
								   $img = Image::make($destinationPath.$filename)->resize(990, null, function ($constraint) {
									    $constraint->aspectRatio();
									});
								   $img->save($destinationPath.MEDIUM_IMAGE.$filename, 90);
								   //resize the image to 360px
								   $img = Image::make($destinationPath.$filename)->resize(360, null, function ($constraint) {
									    $constraint->aspectRatio();
									});
								   $img->save($destinationPath.SMALL_IMAGE.$filename, 90);
								   //resize the image to 75px
								   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
									    $constraint->aspectRatio();
									});
								   $img->save($destinationPath.THUMB_IMAGE.$filename, 90);


					  }




					   $slider->fldSliderName = Input::get('name');
					   $slider->fldSliderButtonLink = Input::get('links');
				  	   $slider->fldSliderButtonLinkText = Input::get('linkname');
				  	   $slider->fldSliderTitle1 = Input::get('title1');
				  	   $slider->fldSliderContent1 = Input::get('description1');
				  	   $slider->fldSliderTitle2 = Input::get('title2');
				  	   $slider->fldSliderContent2 = Input::get('description2');
				  	   $slider->fldSliderTitle3 = Input::get('title3');
				  	   $slider->fldSliderContent3 = Input::get('description3');

					   $slider->save();

					  // $photos = SliderManagement::all();
					   $slider = Slider::orderby('fldSliderPosition')->get();
					   //return View::make('_admin.Slider', array('Slider' => $Slider));
					   Session::flash('success',"Slider was successfully saved.");
					   return Redirect::to('dnradmin/slider/edit/'.$id);
		}
   }

    public function getDelete($id) {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$slider = Slider::find($id);

		if(empty($slider)) {
			return Redirect::to('dnradmin/slider');
			exit();
		}

		$position = $slider->fldSliderPosition;

		 $image1 = 'upload/slider/'.$slider->fldSliderImage;
		 $image2 = 'upload/slider/_75_'.$slider->fldSliderImage;
		 $image3 = 'upload/slider/_400_'.$slider->fldSliderImage;

		 File::delete($image1);
		 File::delete($image2);
		 File::delete($image3);

		$slider->delete();

		//update all home slide positions
		$homes = Slider::where("fldSliderPosition",">",$position)->orderby("fldSliderPosition")->get();


		foreach($homes as $homess) {
			 $homeUpdate = Slider::find($homess->fldSliderID);
			 	$homeUpdate->fldSliderPosition = $homess->fldSliderPosition - 1;
			 $homeUpdate->save();
		}

	    return Redirect::to('dnradmin/slider');
	}

}
