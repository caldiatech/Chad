<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Pages;
use App\Models\PagesPreview;
use App\Models\HomeSlide;
use App\Models\Google;
use App\Models\Footer;
use App\Models\TempCart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Html;
use Image;
use Validator;
use File;
use Mail;

class PagesController extends Controller
{
    public function getIndex()
    {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		//check if user is login to the database
        // get the posts from the database by asking the Active Record for "all"
		$pageid=0;
		$mainid=555;

        $pages = Pages::where('fldPagesMainID','=',$pageid)->orderby('fldPagesPosition')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$pageClass = 'class=active';
		$pageTitle = PAGE_MANAGEMENT;
		return View::make('_admin.pages.pages', array('page' => $pages,
													  'pageid'=>$pageid,
													  'mainid'=>$mainid,
													  'administrator'=>$administrator,
													  'pageClass'=>$pageClass,
													  'pageTitle'=>$pageTitle));

    }



	 public function getView($id)
    {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

	    if($id!=0) {
			$mainpage =  Pages::where('fldPagesID', '=', $id)->first();
			$mainid = $mainpage->fldPagesMainID;
		} else {
			$mainid = 0;
		}

		$pages =  Pages::where('fldPagesMainID', '=', $id)->orderby('fldPagesPosition')->get();
		$page_display = Pages::where('fldPagesID','=',$id)->first();

		if(!empty($page_display)) {

			if($page_display->fldPagesMainID != 0) {
				$mainpage = Pages::where('fldPagesID','=',$page_display->fldPagesMainID)->first();
			} else {
				$mainpage = "";
			}
		} else {
			return Redirect::to('dnradmin/pages');
		}

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();

		$pageClass = 'class=active';
		$pageTitle = PAGE_MANAGEMENT;
        return View::make('_admin.pages.pages', array('page' => $pages,
        											  'pageid'=>$id,
        											  'mainid'=>$mainid,
        											  'page_display'=>$page_display,
        											  'mainpage'=>$mainpage,
        											  'administrator'=>$administrator,
        											  'pageClass'=>$pageClass,
        											  'pageTitle'=>$pageTitle));
    }

	public function getNew() {
	   	//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$pageClass = 'class=active';
		$pagelist = Pages::pageList();

		$pageTitle = PAGE_MANAGEMENT;
   		return View::make('_admin.pages.page_add',array('administrator'=>$administrator,
   													    'pageClass'=>$pageClass,
   													    'pagelist'=>$pagelist,
   													    'pageTitle'=>$pageTitle));
   }

   public function postNew() {

   	   $rules   = Pages::rules();
	   $validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails()) {
		  	Session::flash('flash',['alert' => 'danger', 'msg' => "Please complete below information."]);
		    return Redirect::to('dnradmin/pages/new')->withInput()->withErrors($validator,'pages');
		} else {

			   $pages = new Pages;
			   $pages->fldPagesName = Input::get('name');
			   $pages->fldPagesTitle = $pages->fldPagesMetaTitle = Input::get('title');
			   $pages->fldPagesDescription = Input::get('description');
			   $pages->fldPagesFilename = Input::get('filename');
			   $pages->fldPagesMainID = Input::get('main_id');
			   $pages->fldPagesIsVisible = Input::get('isVisible');
			   $pages->fldPagesIsCMS = Input::get('isCMS');


				//generate slug
				$pageCount = Pages::where('fldPagesName','=',Input::get('name'))->count();
				$slug = $pageCount == 0 ? Str::slug($pages->fldPagesName,'-') : Str::slug($pages->fldPagesName."-".$pageCount,'-');

				$pages->fldPagesSlug = $slug;

			   $file = Input::file('image');
			   if($file != "") {
				   $destinationPath = PAGES_IMAGE_PATH;
				   $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'.$file->getClientOriginalExtension();
				   Input::file('image')->move($destinationPath, $filename);

				   $pages->fldPagesImage = $filename;

				   if(!File::exists($destinationPath.THUMB_IMAGE)) {
				   		File::makeDirectory($destinationPath.LARGE_IMAGE, 0775);
				   		File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);
				   		File::makeDirectory($destinationPath.SMALL_IMAGE, 0775);
				   		File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);
			   		}

				   //resize the image to 400px
				   $img = Image::make($destinationPath.$filename)->resize(400, null,function ($constraint) {
					    $constraint->aspectRatio();
					});
				    $img->save($destinationPath.MEDIUM_IMAGE.$filename, 90);
				   //resize the image to 140px
				   $img = Image::make($destinationPath.$filename)->resize(1920, null,function ($constraint) {
					    $constraint->aspectRatio();
					});

				   $img->save($destinationPath.LARGE_IMAGE.$filename, 90);

				   //resize the image to 140px
				   $img = Image::make($destinationPath.$filename)->resize(140, null,function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.SMALL_IMAGE.$filename, 90);
				   //resize the image to 75px
				   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.THUMB_IMAGE.$filename, 90);
			   } else {
				   $pages->fldPagesImage = "";
			   }


					//get last position
					$pagesPosition = Pages::orderby("fldPagesPosition","desc")->first();
					$pages->fldPagesPosition = $pagesPosition->fldPagesPosition+1;
					$pages->save();

					//***save to preview page****//
					   $pagesPreview = new PagesPreview;
					   $pagesPreview->fldPagesPreviewName = Input::get('name');
					   $pagesPreview->fldPagesPreviewTitle = Input::get('title');
					   $pagesPreview->fldPagesPreviewDescription = Input::get('description');
					   $pagesPreview->fldPagesPreviewFilename = Input::get('filename');
					   $pagesPreview->fldPagesPreviewMainID = Input::get('main_id');
					   $pagesPreview->fldPagesPreviewIsVisible = Input::get('isVisible');
					   $pagesPreview->fldPagesPreviewIsCMS = Input::get('isCMS');
					   $pagesPreview->fldPagesPreviewSlug = $slug;
					   $pagesPreview->fldPagesPreviewImage = $pages->fldPagesImage;
					   $pagesPreview->fldPagesPreviewPosition = $pagesPosition->fldPagesPosition+1;
					   $pagesPreview->save();
					//***end save to preview page****//

			  	Session::flash('flash',['alert' => 'success', 'msg' => "Page was successfully saved."]);
	   			return redirect()->back();
	   }
   }

   public function getEdit($id) {
   	 	//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

	    $pages =  Pages::where('fldPagesID', '=', $id)->first();
		$preview =  PagesPreview::where('fldPagesPreviewID', '=', $id)->first();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$pageClass = 'class=active';
		$pagelist = Pages::pageList();
		$pageTitle = PAGE_MANAGEMENT;
		if(empty($pages)){
			return redirect()->to('dnradmin/not-found');
		}
	    return View::make('_admin.pages.page_edit', array('page' => $pages,
	    												  'preview' => $preview,
	    												  'administrator'=>$administrator,
	    												  'pageClass'=>$pageClass,
	    												  'pagelist'=>$pagelist,
	    												  'pageTitle'=>$pageTitle));
   }

   public function notFound(){
   		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

	    $pages =  Pages::where('fldPagesID', '=', 32)->first();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$pageClass = 'class=active';
		$pagelist = Pages::pageList();
		$pageTitle = PAGE_MANAGEMENT;

   		return View::make('_admin.error', array('page' => $pages,
	    												  'administrator'=>$administrator,
	    												  'pageClass'=>$pageClass,
	    												  'pagelist'=>$pagelist,
	    												  'pageTitle'=>$pageTitle));
   }

    public function getSlug($slug) {
	   $pages =  Pages::where('fldPagesSlug', '=', $slug)->first();
	    return View::make('home.pages', array('page' => $pages));
   }

   public function postEdit($id) {

		$rules   = Pages::rules();
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('flash',['alert' => 'danger', 'msg' => "Please see below errors:"]);
			return Redirect::to('dnradmin/pages/edit/'.$id)->withInput()->withErrors($validator,'pages');
		} else {

			$file = Input::file('image');

			if(Input::get('isLive')=== '1' || Input::get('filename')!= "") {
				$pages = Pages::find($id);
				// $pages->fldPagesIsLive=1;
			} else {
				$pages = PagesPreview::find($id);
				//UPDATE THE ISLIVE FIELDS IN PAGE MANAGEMENT
				$pagesLive = Pages::find($id);
				// $pagesLive->fldPagesIsLive=0;
				$pagesLive->save();
			}

			if($file != "") {

				$destinationPath = PAGES_IMAGE_PATH;
				$filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'.$file->getClientOriginalExtension();
				Input::file('image')->move($destinationPath, $filename);

				$pages->fldPagesImage = $filename;

				if(!File::exists($destinationPath.THUMB_IMAGE)) {
					File::makeDirectory($destinationPath.LARGE_IMAGE, 0775);
					File::makeDirectory($destinationPath.MEDIUM_IMAGE, 0775);
					File::makeDirectory($destinationPath.SMALL_IMAGE, 0775);
					File::makeDirectory($destinationPath.THUMB_IMAGE, 0775);
				}
				//resize the image to 400px
				$img = Image::make($destinationPath.$filename)->resize(400, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				$img->save($destinationPath.MEDIUM_IMAGE.$filename, 90);
				//resize the image to 140px
				$img = Image::make($destinationPath.$filename)->resize(1920, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				$img->save($destinationPath.LARGE_IMAGE.$filename, 90);

				//resize the image to 140px
				$img = Image::make($destinationPath.$filename)->resize(140, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				$img->save($destinationPath.SMALL_IMAGE.$filename, 90);
				//resize the image to 75px
				$img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				$img->save($destinationPath.THUMB_IMAGE.$filename, 90);
			}


		    $pages->fldPagesName = Input::get('name');
		   	$pages->fldPagesTitle = $pages->fldPagesMetaTitle = Input::get('title');
	   	  	$pages->fldPagesSubTitle = Input::get('page_sub_title');
			$pages->fldPagesDescription = Input::get('description');


			if(in_array($id, array(74,85,88,102))) {
		   	// if($id==85 || $id==88 || $id==102) {
		   		$pages->fldPagesDescription2 = Input::get('description2');
		   	}

		   if($id==32) { //home page
		   	  // $pages->fldPagesSubTitle = Input::get('page_sub_title');
		   	  $pages->fldPagesButton = Input::get('page_button');
		   	  $pages->fldPagesButtonLinks = Input::get('page_button_links');
		   } else {

                if($id==73) { $pages->fldPagesSubTitle = Input::get('page_sub_title'); }

				// $pages->fldPagesDescription = Input::get('description');

				$pages->fldPagesFilename = Input::get('filename');
				// $pages->fldPagesMainID = Input::get('main_id');
				// $pages->fldPagesIsVisible = Input::get('isVisible');
				$pages->fldPagesIsCMS = Input::get('isCMS');
		   }


		   $messages = array(
			    'name.required' => 'Please input page name.',
				'description.required' => 'Please input page content.',
				'image.img_min_size' => 'Please see miniumum dimension.'
			);

			//generate slug
		   $pageCount = Pages::where('fldPagesName','=',Input::get('name'))->where('fldPagesID','!=',$id)->count();
		   $slug = $pageCount == 0 ? Str::slug($pages->fldPagesName,'-') : Str::slug($pages->fldPagesName."-".$pageCount,'-');

			$pages->fldPagesSlug = $slug;
			if(Input::has('filename')){
				$pages->fldPagesSlug = stripslashes(Input::get('filename'));
			}


		   	$fields = Input::all();
			// $rules = array('name'=>'required', 'description' => 'required');
			$rules = array('name'=>'required');

		   	$validation = Validator::make($fields, $rules, $messages);
			if ($validation->fails()){
				return Redirect::to('dnradmin/pages/edit/'.$id)->withErrors($validation)->withInput();
			} else {
			   $pages->save();
			}

			Session::flash('flash',['alert' => 'success', 'msg' => "Page was successfully updated."]);
			return redirect()->back();
		} // if validator
   }

    public function getDelete($id) {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$pages = Pages::find($id);
		$position = $pages->fldPagesPosition;
		$pages->delete();

		//update all pages positions
		$page = Pages::where("fldPagesPosition",">",$position)->orderby("fldPagesPosition")->get();


		foreach($page as $pagess) {
			 $pageUpdate = Pages::find($pagess->fldPagesID);
			 	$pageUpdate->fldPagesPosition = $pagess->fldPagesPosition - 1;
			 $pageUpdate->save();
		}


		//$pages = PagesManagement::all();
	    return Redirect::to('dnradmin/pages');
	}

	public function removeImage($id) {
		$pages = Pages::find($id);
		   $pages->fldPagesImage = "";
		$pages->save();
		Session::flash('success_image',"Image was successfully removed.");
		return Redirect::to('dnradmin/pages/edit/'.$id);
	}

	public function getUpdatePosition() {
	   $pctr=1;

		foreach(Input::get('page_manager') as $pageManager) {
			$positionTR =  explode("_",$pageManager);
			$position_id = $positionTR[0];

			 $pages = Pages::find($position_id);
			 if($pages) {
				 $pages->fldPagesPosition = $pctr;
				 $pages->save();
				 $pctr=$pctr+1;
			 }
		}
   }

   public function getSubUpdatePosition() {
	   $pctr=1;

		foreach(Input::get('page_manager1') as $pageManager) {
			$positionTR =  explode("_",$pageManager);
			$position_id = $positionTR[0];

			 $pages = Pages::find($position_id);
			 if($pages) {
				 $pages->fldPagesPosition = $pctr;
				 $pages->save();
				 $pctr=$pctr+1;
			 }
		}
   }

   public function getThirdUpdatePosition() {
	   $pctr=1;

		foreach(Input::get('page_manager2') as $pageManager) {
			$positionTR =  explode("_",$pageManager);
			$position_id = $positionTR[0];

			 $pages = Pages::find($position_id);
			 if($pages) {
				 $pages->fldPagesPosition = $pctr;
				 $pages->save();
				 $pctr=$pctr+1;
			 }
		}
   }

   public function home() {

   		$pageEditable = Session::has('dnradmin_id') ? true : false;
	   	$menus = Pages::where('fldPagesMainID', '=', 0)->get();

		$homeslide = HomeSlide::orderby('fldHomeSlidePosition')->get();

		$pages = Pages::where('fldPagesSlug','=','home')->first();

		$settings = Settings::first();
		$google = Google::first();
		$footer = Footer::first();

		$homeslideFirst = HomeSlide::orderby('fldHomeSlidePosition')->first();

		$cart_count = TempCart::countCart();

		//$product = Product::join('tblProductOptions','fldProductOptionsProductID', '=', 'fldProductID')->where('fldProductIsFeatured','=',1)->groupBy('fldProductOptionsProductID')->orderBy('fldProductPosition')->take(4)->get();

		$product = Product::where('fldProductIsFeatured','=',1)->orderBy('fldProductPosition')->take(4)->get();

		/* get prices */
		$product_array_id = $product_array_prices = $product_array_highest_prices = $product_array_lowest_prices = array();
		foreach($product as $get_product_item){
			$product_array_id[] = $get_product_item->fldProductID;
		}
		$product_option_class = new \App\Models\ProductOptions;

		$get_product_options = $product_option_class->whereIn('fldProductOptionsProductID', $product_array_id)->orderBy('fldProductOptionsPrice','DESC')->get();

		foreach($get_product_options as $get_product_option){
			$fldProductOptionsProductID = $get_product_option->fldProductOptionsProductID;
			$fldProductOptionsPrice =  $get_product_option->fldProductOptionsPrice;
			$product_array_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			if(!isset($product_array_highest_prices[$fldProductOptionsProductID])){
				$product_array_highest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice+300; // 300 because max expensive frame = max cheap frame cost + 300
			}
			if(!isset($product_array_lowest_prices[$fldProductOptionsProductID])){
				$product_array_lowest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}
			if($fldProductOptionsPrice < $product_array_lowest_prices[$fldProductOptionsProductID]){
				$product_array_lowest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}
			if($fldProductOptionsPrice > $product_array_highest_prices[$fldProductOptionsProductID]){
				$product_array_highest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice+300; // 300 because max expensive frame = max cheap frame cost + 300
			}

		}
		//dd($product_array_prices);
   		return View::make('home.index')->with(array('menus'=>$menus,
   													'homeslide'=>$homeslide,
   													'homeslideFirst'=>$homeslideFirst,
   													'pages' => $pages,
   													'settings'=>$settings,
   													'google'=>$google,
   													'footer'=>$footer,
   													'cart_count'=>$cart_count,
   													'pageEditable'=>$pageEditable,
   													'product'=>$product,
   													'product_array_prices'=>$product_array_prices,
   													'product_array_highest_prices'=>$product_array_highest_prices,
   													'product_array_lowest_prices' => $product_array_lowest_prices ));
   }

   public function pageDisplay($slug) {

// echo $slug;

   		$pageEditable = Session::has('dnradmin_id') ? true : false;

	    $pages = Pages::where('fldPagesSlug', '=', $slug)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$footer = Footer::first();

// print_r($pages);
// die();

		if(empty($pages)){
			$pages = Pages::where('fldPagesSlug', '=', "404")->first();
			return response()->view('errors.404', array('pages' => $pages,
   													'menus' => $menus,
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count,
   													'footer'=>$footer,
   													'pageEditable'=>$pageEditable), "404 Not Found");
		} else if($pages->fldPagesID == 72) {
			$slider = Slider::orderBy('fldSliderPosition')->get();

			return View::make('home.pages')->with(array('pages' => $pages,
   													'menus' => $menus,
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count,
   													'footer'=>$footer,
   													'slider'=>$slider,
   													'pageEditable'=>$pageEditable));

		} else {

			if (!empty($pages->fldPagesFilename)) {
				return View::make('home.'.$pages->fldPagesFilename)->with(array('pages' => $pages,
					'menus' => $menus,
					'settings'=>$settings,
					'google'=>$google,
					'cart_count'=>$cart_count,
					'footer'=>$footer,
					'pageEditable'=>$pageEditable));
			} else {
				return View::make('home.pages')->with(array('pages' => $pages,
					'menus' => $menus,
					'settings'=>$settings,
					'google'=>$google,
					'cart_count'=>$cart_count,
					'footer'=>$footer,
					'pageEditable'=>$pageEditable));
			}

   			// return View::make('home.pages')->with(array('pages' => $pages,
   			// 										'menus' => $menus,
   			// 										'settings'=>$settings,
   			// 										'google'=>$google,
   			// 										'cart_count'=>$cart_count,
   			// 										'footer'=>$footer,
   			// 										'pageEditable'=>$pageEditable));
   		}


   }


	// public function fullWidth($slug = 'framing'){

	// 	$pageEditable = Session::has('dnradmin_id') ? true : false;
	// 	$pages = Pages::where('fldPagesSlug', '=', $slug)->first();
	// 	$menus = Pages::where('fldPagesMainID', '=', 0)->get();
	// 	$settings = Settings::first();
	// 	$google = Google::first();
	// 	$cart_count = TempCart::countCart();
	// 	$footer = Footer::first();
	// 	return View::make('home.full-width')->with(array('pages' => $pages,
	// 										'menus' => $menus,
	// 										'settings'=>$settings,
	// 										'google'=>$google,
	// 										'cart_count'=>$cart_count,
	// 										'footer'=>$footer,
	// 										'pageEditable'=>$pageEditable));
	// }

   public function store($slug = 'store'){
		$pageEditable = Session::has('dnradmin_id') ? true : false;
	    $pages = Pages::where('fldPagesSlug', '=', $slug)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$footer = Footer::first();
		return View::make('home.store')->with(array('pages' => $pages,
   													'menus' => $menus,
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count,
   													'footer'=>$footer,
   													'pageEditable'=>$pageEditable));
   }

   public function dashboard($category='customer',$slug="index") {

   		$pageEditable = Session::has('dnradmin_id') ? true : false;
	   	$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$pages = Pages::where('fldPagesSlug','=',$slug)->first();
		$settings = Settings::first();
		$google = Google::first();
		$footer = Footer::first();
		$cart_count = TempCart::countCart();

		if(empty($pages)){
			settype($pages, 'object');
			$pages->fldPagesTitle = "Dashboard";
		}

			$pages->slug = $slug;
			$pages->category = $category;

		if(View::exists('dashboard.'.$category.'.'.$slug)){
			return View::make('dashboard.'.$category.'.'.$slug)->with(array('pages' => $pages,
   													'menus' => $menus,
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count,
   													'footer'=>$footer,
   													'pageEditable'=>$pageEditable));
		}else{

			return View::make('dashboard.'.$category.'.index')->with(array('pages' => $pages,
   													'menus' => $menus,
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count,
   													'footer'=>$footer,
   													'pageEditable'=>$pageEditable));
		}


   }

   public function thankyouDisplay($slug,$merchant) {

	    $settings = SettingsManagement::first();

		$ownerEmail = $settings->email == "" ? "test1@dogandrooster.net" : $settings->email;
		$ownerName = $settings->site_name == "" ? "Dog and Rooster" : $settings->site_name;

	     if($merchant == "paypal"){
				 foreach ($_POST as $key => $value) {
					  if($key == "custom") {
							$requestid =  $value;
					  }
			  	}

			  			$cartEmail = CartManagement::displayCheckout($requestid);

						Mail::send('home.email_checkout', $cartEmail, function ($message) {
							$message->from(EmailFrom, EmailFromName);
							//$message->to(EmailTo3, EmailToName3);
							//$message->cc(EmailTo3, EmailToName3);
							$message->bcc('buumber@gmail.com', 'valuecom dev');
							$message->to($email,$firstname . ' ' . $lastname);
							$message->subject("Your Order Details");
						});

						//send email to owner
						Mail::send('home.email_checkout', $cartEmail, function ($message) {
							$message->from(EmailFrom, EmailFromName);
							$message->to(EmailTo, EmailToName);
							$message->to(EmailTo2, EmailToName2);
							$message->cc(EmailTo3, EmailToName3);
							$message->bcc('buumber@gmail.com', 'valuecom dev');
							$message->subject("New Orders");
						});
		 }

	    $cart_count = TempCartManagement::countCart();
		$settings->site_name = "Thank you";

		$client_id = Session::has('client_id') ? Session::get('client_id') : Session::getId();
		$order_date = date('Y-m-d');
		$cart_count = TempCartManagement::where('client_id','=',$client_id)->where('order_date','=',$order_date)->count();

   		return View::make('home.thankyou')->with(array('pages' => $pages,'menus' => $menus,'category'=>$category,'settings'=>$settings,'cart_count'=>$cart_count));
   }

   public function thankyouContact($slug) {
	    $pages = Pages::where('fldPagesSlug', '=', $slug)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$footer = Footer::first();
		if(!isset($settings)){ settype($settings, 'object'); }
		$settings->site_name = "Thank you";

		$cart_count = TempCart::countCart();

   		return View::make('home.thankyou')->with(array('pages' => $pages,
   													   'menus' => $menus,
   													   'settings'=>$settings,
   													   'google'=>$google,
   													   'footer'=>$footer,
   													   'cart_count'=>$cart_count));
   }



   public function login() {
	   $menus = Pages::where('fldPagesMainID', '=', 0)->get();
	   $category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
	   $settings = Settings::first();
	   $google = Google::first();
	   $settings->site_name = "Login";
	   $cart_count = TempCart::countCart();

	   $slug = 'login';
	   $pages = Pages::where('fldPagesSlug', '=', $slug)->first();

   		return View::make('home.login')->with(array('pages' => $pages,
		   											'menus'=>$menus,
   													'category'=>$category,
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count));
   }

   public function registration() {
	    $menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$settings = Settings::first();
		$google = Google::first();
		$pages = Pages::find(55);
		$settings->site_name = "Registration";
		$cart_count = TempCart::countCart();
		return View::make('home.registration')->with(array('menus'=>$menus,
   														   'category'=>$category,
   														   'settings'=>$settings,
   														   'google'=>$google,
   														   'pages'=>$pages,
   														   'cart_count'=>$cart_count));
   }

   public function forgot_password() {
	   $menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$settings = Settings::first();
		$google = Google::first();
		$settings->site_name = "Forgot Password";
		$cart_count = TempCart::countCart();
   		$pages = Pages::find(45);
   		return View::make('home.forgot')->with(array('menus'=>$menus,
   													 'category'=>$category,
   													 'settings'=>$settings,
   													 'google'=>$google,
   													 'pages'=>$pages,
   													 'cart_count'=>$cart_count));
   }



   public function salesRegistration() {
	    $menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$settings = Settings::first();
		$google = Google::first();
		$pages = Pages::find(55);
		$settings->site_name = "Registration";
		$cart_count = TempCart::countCart();
   		return View::make('home.registration_sales')->with(array('menus'=>$menus,
   														   'category'=>$category,
   														   'settings'=>$settings,
   														   'google'=>$google,
   														   'pages'=>$pages,
   														   'cart_count'=>$cart_count));
   }

   public function salesLogin() {
	   $menus = Pages::where('fldPagesMainID', '=', 0)->get();
	   $category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
	   $settings = Settings::first();
	   $google = Google::first();
	   $settings->site_name = "Login";
	   $cart_count = TempCart::countCart();

	   $slug = 'login';
	   $pages = Pages::where('fldPagesSlug', '=', $slug)->first();
	   $pages->fldPagesName = 'sales';
   		return View::make('home.sales_login')->with(array('pages' => $pages,'menus'=>$menus,
   													'category'=>$category,
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count));
   }

   public function shopLogin() {
	   $menus = Pages::where('fldPagesMainID', '=', 0)->get();
	   $category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
	   $settings = Settings::first();
	   $google = Google::first();
	   $settings->site_name = "Login";
	   $cart_count = TempCart::countCart();

	   $slug = 'login';
	   $pages = Pages::where('fldPagesSlug', '=', $slug)->first();
	   $pages->fldPagesName = 'shop';
   		return View::make('home.shop_owner_login')->with(array('pages' => $pages,'menus'=>$menus,
   													'category'=>$category,
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count));
   }

   public function shopRegistration() {
	    $menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();
		$settings = Settings::first();
		$google = Google::first();
		$pages = Pages::find(55);
		$settings->site_name = "Registration";
		$cart_count = TempCart::countCart();
   		return View::make('home.registration_shop_owner')->with(array('menus'=>$menus,
   														   'category'=>$category,
   														   'settings'=>$settings,
   														   'google'=>$google,
   														   'pages'=>$pages,
   														   'cart_count'=>$cart_count));
   }

   	/*
   	public function FAQ() {

	    $pages = Pages::find(88);
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$settings = Settings::first();
		$google = Google::first();
		$cart_count = TempCart::countCart();
		$footer = Footer::first();

   		return View::make('home.faq')->with(array('pages' => $pages,
   													'menus' => $menus,
   													'settings'=>$settings,
   													'google'=>$google,
   													'cart_count'=>$cart_count,
   													'footer'=>$footer));
   	}
	*/

   	public function FAQContact() {
		$email = Input::get('email');
		$question = Input::get('question');

		$rules   = Pages::FAQRules();
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/faq')->withInput()->withErrors($validator,'faq');
		} else {

	  		$contacts = array("questions"=>$question,"email"=>$email);

	  		Mail::send('home.emails.faq', $contacts, function ($message) {
		 		$message->from(EmailFrom,EmailFromName);
		 		$message->to(EmailTo3,EmailToName3);
		 		$message->bcc('buumber@gmail.com', 'Valuecom Dev');
		 		$message->subject("Clarkin: FAQ Questions");
			});

	  		Session::flash('success',"Question successfully sent.");
			return Redirect::to("/faq");
	  	}

   	}


}
