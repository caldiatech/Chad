<?php
/***********************DEVELOPER : EMMANUEL MARCILLA**************************/
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Category;

use Illuminate\Support\Str;
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
		$pageTitle = CATEGORY_MANAGEMENT;
        return View::make('_admin.product.category', array('category' => $category,
        												   'category_id'=>$category_id,
        												   'administrator'=>$administrator,
        												   'productClass'=>$productClass,
        												   'pageTitle'=>$pageTitle));
    }

	 public function getDisplay($category_id="",$product_id="")
    {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		$main_id=0;
		$category =  Category::where('fldCategoryMainID', '=', $main_id)->orderby('fldCategoryPosition')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$productClass = 'class=active';
		$pageTitle = CATEGORY_MANAGEMENT;
        return View::make('_admin.product.product_category', array('category' => $category,
        														   'category_id'=>$category_id,
        														   'administrator'=>$administrator,
        														   'product_id'=>$product_id,
        														   'productClass'=>$productClass,
        														   'pageTitle'=>$pageTitle));
    }


   public function postIndex()
    {

		$category = Category::orderby('fldCategoryPosition')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$productClass = 'class=active';
		$pageTitle = CATEGORY_MANAGEMENT;
        return View::make('_admin.product.category', array('category' => $category,
        												   'administrator'=>$administrator,
        												   'productClass'=>$productClass,
        												   'pageTitle'=>$pageTitle));

    }

	public function getNew($id,$backid)
   {
	   	//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$category = Category::where('fldCategoryID', '=', $id)->first();

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$productClass = 'class=active';
		$pageTitle = CATEGORY_MANAGEMENT;
   		return View::make('_admin.product.category_add',array(
   															  'category_id'=>$id,
   															  'backid'=>$backid,
   															  'category'=>$category,
   															  'administrator'=>$administrator,
   															  'productClass'=>$productClass,
   															  'pageTitle'=>$pageTitle));
   }

    public function getView($id)
    {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$category =  Category::where('fldCategoryMainID', '=', $id)->orderby('fldCategoryPosition')->get();
		if($id != 0) {
			$maincat = Category::where('fldCategoryID', '=', $id)->first();
			$categoryName = $maincat->fldCategoryName;
		} else {
			$categoryName = '';
			$maincat = "";
		}

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$productClass = 'class=active';
		$pageTitle = CATEGORY_MANAGEMENT;
        return View::make('_admin.product.category', array('category' => $category,
        												   'category_id'=>$id,
        												   'maincat'=>$maincat,
        												   'administrator'=>$administrator,
        												   'category_name'=>$categoryName,
        												   'productClass'=>$productClass,
        												   'pageTitle'=>$pageTitle));
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

   	  $rules   = Category::rules(0);
	  $validator = Validator::make(Input::all(), $rules);
	  if ($validator->fails()) {
	        return Redirect::to('dnradmin/category/new/0/2')->withInput()->withErrors($validator,'category');
	  } else {
					   $path = Input::file('image')->getRealPath();
					   list($width, $height) = getimagesize($path);

					   //generate slug
						$pageCount = Category::where('fldCategoryName','=',Input::get('name'))->count();
						$slug = $pageCount == 0 ? Str::slug(Input::get('name'),'-') : Str::slug(Input::get('name')."-".$pageCount,'-');

							   $category = new Category;
							   $category->fldCategoryName = Input::get('name');
							   $category->fldCategoryMainID = Input::get('main_id');
							   $category->fldCategoryDescription = Input::get('description');
							   $category->fldCategorySubTitle = Input::get('sub_title');
							   $category->save();

							   $category = Category::find($category->fldCategoryID);
							   $category_id = Input::get('main_id');

							   $file = Input::file('image');
							   if($file != "") {

								  // $destinationPath = 'upload/category/'.$category->fldCategoryID.'/';
								   //$filename = $file->getClientOriginalName();
							   	  $destinationPath = CATEGORY_IMAGE_PATH.$slug.'/';
							      $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'.$file->getClientOriginalExtension();
								   Input::file('image')->move($destinationPath, $filename);

								   $category->fldCategoryImage = $filename;

								  //create folder for cropping of images
										if(!File::exists($destinationPath.THUMB_IMAGE)) {
											File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);
											File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);
										}

										 //create folder for cropping of images
										if(!File::exists($destinationPath.THUMB_IMAGE)) {
											File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);
											File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);
										}

								   		//resize the image to 400px
									   $img = Image::make($destinationPath.$filename)->resize(400, null, function ($constraint) {
											    	$constraint->aspectRatio();
									   	});
									   $img->save($destinationPath.MEDIUM_IMAGE.$filename, 90);
									   //resize the image to 75px
									   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
											    	$constraint->aspectRatio();
									   });
									   $img->save($destinationPath.THUMB_IMAGE.$filename, 90);

							   } else {
								   $category->fldCategoryImage = "";
							   }


								$category->fldCategorySlug = $slug;

							   //get last position
								$categoryPosition = Category::where("fldCategoryMainID","=",Input::get('main_id'))
															  ->where("fldCategoryID","!=",$category->fldCategoryID)
															  ->orderby("fldCategoryPosition","desc")
															  ->first();
								$category->fldCategoryPosition = !empty($categoryPosition) ? $categoryPosition->fldCategoryPosition+1 : 1;


							   $category->save();
							   $success=1;
							   $backid=0;
							   if($backid == 0) {
							   	   Session::flash('success',"Category was successfully saved.");
								   return Redirect::to('dnradmin/category/new/0/2');
							   } else {
							   	   Session::flash('success',"Category was successfully saved.");
								   return Redirect::to('dnradmin/products/edit/'.$backid);
							   }

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
		$pageTitle = CATEGORY_MANAGEMENT;
	    return View::make('_admin.product.category_edit', array('category' => $category,
	    													    'backid'=>$backid,
	    													    'success'=>$success,
	    													    'error'=>$error,
	    													    'main_cat'=>$main_cat,
	    													    'administrator'=>$administrator,
	    													    'productClass'=>$productClass,
	    													    'pageTitle'=>$pageTitle));
   }

   public function postEdit($id) {
	  $rules   = Category::rules($id);
	  $validator = Validator::make(Input::all(), $rules);

	  if ($validator->fails()) {
	        return Redirect::to('dnradmin/category/edit/'.$id.'')->withInput()->withErrors($validator,'category');
	  } else {

				  $file = Input::file('image');
			      $category = Category::find($id);

			     //generate slug
				   $pageCount = Category::where('fldCategoryName','=',Input::get('name'))
				   						  ->where('fldCategoryID','!=',$id)
				   						  ->count();
				    $slug = $pageCount == 0 ? Str::slug($category->fldCategoryName,'-') : Str::slug($category->fldCategoryName."-".$pageCount,'-');

				    //if there is changes on the product name move the image from old path to new path
					 if($category->fldCategorySlug != $slug) {
					 	//copy all files to old slug to new slug
					 	$path = CATEGORY_IMAGE_PATH.$category->fldCategorySlug.'/';
					 	$target = CATEGORY_IMAGE_PATH.$slug.'/';

					 	if(!File::exists($target)) {
					 		File::makeDirectory($target, 0775);
							File::makeDirectory($target.MEDIUM_IMAGE, 0775);
							File::makeDirectory($target.SMALL_IMAGE, 0775);
							File::makeDirectory($target.THUMB_IMAGE, 0775);
						}

					 	//File::move($path, $target);
						File::copyDirectory($path,$target);
						File::deleteDirectory($path);
					 }

				  if($file != "") {

					  	   $destinationPath = CATEGORY_IMAGE_PATH.$slug.'/';
						   $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'.$file->getClientOriginalExtension();
						   Input::file('image')->move($destinationPath, $filename);
						   $category->fldCategoryImage = $filename;

						    //create folder for cropping of images
									if(!File::exists($destinationPath.THUMB_IMAGE)) {
										File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);
										File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);
									}

						  //resize the image to 400px
								   $img = Image::make($destinationPath.$filename)->resize(400, null, function ($constraint) {
										    	$constraint->aspectRatio();
								   	});
								   $img->save($destinationPath.MEDIUM_IMAGE.$filename, 90);
								   //resize the image to 75px
								   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
										    	$constraint->aspectRatio();
								   });
								   $img->save($destinationPath.THUMB_IMAGE.$filename, 90);



				  }


				   $category->fldCategoryName = Input::get('name');
				   $category->fldCategorySubTitle = Input::get('sub_title');
				   $category->fldCategoryDescription = Input::get('description');
				   $backid = Input::get('backid');
				   $main_id = $category->fldCategoryMainID;




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
					   return Redirect::to('dnradmin/category/edit/'.$id.'');
				   }
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
