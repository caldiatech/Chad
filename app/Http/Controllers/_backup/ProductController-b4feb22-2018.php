<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Options;
use App\Models\ProductOptions;
use App\Models\AdditionalProduct;
use App\Models\OptionsAssets;
use App\Models\Pages;
use App\Models\Google;
use App\Models\TempCart;
use App\Models\Footer;
use App\Models\GraphikDimension;

use App\SoapXmlBuilder;

use \App\Http\Requests\Request;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Html;
use Image;
use Validator;
use File;
use SoapClient, Log;

class ProductController extends Controller
{

    public function getIndex()
    {
			
    }
	
  
   public function postIndex()
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$products = Product::orderby('fldProductPosition')->get();       
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();          
		$productClass = 'class=active';
		$pageTitle = PRODUCT_MANAGEMENT;
        return View::make('_admin.product.products', array('products' => $products,
        												   'administrator'=>$administrator,
        												   'productClass'=>$productClass,
        												   'pageTitle'=>$pageTitle));
        
    }	
	
	 public function getView($id)
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		//$products = ProductsManagement::orderby('position')->where('category_id', '=', $id)->leftjoin('category','category.id','=','products.category_id')->get(array('products.*', 'category.main_id'));
		
		$products = ProductCategory::join('tblProduct','tblProduct.fldProductID','=','tblProductCategory.fldProductCategoryProductID')
							->where('tblProductCategory.fldProductCategoryCategoryID','=',$id)
							->orderby('tblProduct.fldProductPosition')
							->get();
		
		$mainid = Category::where('fldCategoryID','=',$id)->first();
		//print_r($products);die();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();          		
		$productClass = 'class=active';
		$pageTitle = PRODUCT_MANAGEMENT;
        return View::make('_admin.product.products', array('product' => $products,
        												   'category_id'=>$id,
        												   'mainid'=>$mainid,
        												   'administrator'=>$administrator,
        												   'productClass'=>$productClass,
        												   'pageTitle'=>$pageTitle));
    }
	
	public function getNew()
   {


   		if(Input::get('new_size')){
   			Product::generateLandscapeImages();
   			exit();
   		}
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
	   	//$success = "";		
		$category = Category::where('fldCategoryMainID','=','0')->orderby("fldCategoryPosition")->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();          		
		$options =  Options::orderby('fldOptionsPosition')->get();    
		$productClass = 'class=active';
		$pageTitle = PRODUCT_MANAGEMENT;
   		return View::make('_admin.product.products_add',array('category'=>$category,   															  
   															  'administrator'=>$administrator,
   															  'options'=>$options,
   															  'productClass'=>$productClass,
   															  'pageTitle'=>$pageTitle));
   															  
   } 
   
   
   
   public function getUpdatePosition() {
	   $pctr=1;
	  
		foreach(Input::get('page_manager') as $pageManager) {						
			$positionTR =  explode("_",$pageManager);			
			$position_id = $positionTR[0];			
								
			 $products = Product::find($position_id);	
			 if($products) {			 
				 $products->fldProductPosition = $pctr;	
				 $products->save();	
				 $pctr=$pctr+1;				
			 }
				
				 
			
		}
	   
		
   }
   
   
   public function postNew() {
   	  $rules   = Product::rules(0);     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/products/new')->withInput()->withErrors($validator,'product');		                
	  } else { 
			   $file = Input::file('image');
				if($file != "") {
				   $path = Input::file('image')->getRealPath();
				   list($width, $height) = getimagesize($path);
				}

		            if(count(Input::get('category')) == 0) {
						Session::flash('error',"Please select category");
						return Redirect::to('dnradmin/products/new')->withInput();
						exit();		 
					}

			   
			   		$categoryID = Input::get('category');
			   		$catID = reset($categoryID);	   	
					$productPos = Product::join('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','fldProductID')
												->where('fldProductCategoryCategoryID','=',$catID)
												->orderBy('fldProductPosition','DESC')
												->first();

					  $newPosition = count($productPos) == 1 ? $productPos->fldProductPosition + 1 : 1;
							
					   $products = new Product;
					   $products->fldProductName = Input::get('name');	 
					   $products->fldProductSubTitle = Input::get('sub_title');		
					   $products->fldProductPrice = Input::get('price');	 
					   $products->fldProductOldPrice = Input::get('old_price');	 
					   $products->fldProductWeight = Input::get('weight');
					   $products->fldProductDescription = Input::get('description');
					   //$products->category_id = Input::get('category_id');
					   $products->fldProductIsNew = Input::get('isNew');
					   $products->fldProductIsFeatured = Input::get('isFeatured');
					   $products->fldProductPosition = $newPosition;
					   
					   //generate slug
					   $pageCount = Product::where('fldProductName','=',Input::get('name'))->count();
					   //$slug = $pageCount == 0 ? str_slug($products->fldPagesName,'-') : str_slug($products->fldPagesName."-".$pageCount,'-');
					   $slug = $pageCount == 0 ? str_slug(Input::get('name'),'-') : str_slug(Input::get('name')."-".$pageCount,'-');	

					   $products->fldProductSlug = $slug;		
					   $products->save();	   	  
					   
					   //save multiple category
					   if(count(Input::get('category')) >=1 ) {
						   foreach(Input::get('category') as $category) {
							   $categories = new ProductCategory;
									$categories->fldProductCategoryProductID = $products->fldProductID;
									$categories->fldProductCategoryCategoryID = $category;
							   $categories->save();
						   }
						}
					   
					    /* CODE FOR OPTIONS ASSIGN TO PRODUCTS */
						if(Input::get('options_assets')) {
						   $asset_price = Input::get('assets_price');	   	   	   
						   foreach(Input::get('options_assets') as $key=>$option_assets) {	
							   $option_price = isset($asset_price[$option_assets])  ? $asset_price[$option_assets] : 0;	
							   $optionsInfo = OptionsAssets::find($option_assets);
							  			 
							  $productOptions = new ProductOptions;
									$productOptions->fldProductOptionsProductID = $products->fldProductID;
									$productOptions->fldProductOptionsAssetsID = $option_assets;
									$productOptions->fldProductOptionsOptionsID = $optionsInfo->fldOptionsAssetsOptionID;
									$productOptions->fldProductOptionsPrice = $option_price;
							   $productOptions->save();
							 
						   }			
						}
					    /* END CODE FOR OPTIONS ASSIGN TO PRODUCTS */
						
						   
					   $products = Product::find($products->fldProductID);
					   //$category_id = Input::get('category_id');
					   
					   //Upload Single Image
					   $products->fldProductImage = Product::uploadSingleImage(Input::file('image'),$slug);		   	
					   	   
					   $products->save();		  	   
					   
					   
						
					   //CODE FOR MULTIPLE IMAGES
					   //$notUploaded = Product::multipleUpload(Input::file('images'),$slug,$products->fldProductID);	
					    $notUploaded = "";	
						
					   
					   if($notUploaded != "") {
						   Session::flash('upload_error',$notUploaded); 
					   }
					   Session::flash('success',"Product was successfully saved."); 
					   return Redirect::to('dnradmin/products/new');	
			   
		}	   
   }
   
   public function getEdit($id) {	 
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		  	
		$products =  Product::where('fldProductID', '=', $id)->first();

	    $additional_image =  AdditionalProduct::where('fldAdditionalProductProductID', '=', $id)->get();	   

		$category = Category::where('fldCategoryMainID','=','0')->orderby("fldCategoryPosition")->get();

		$productsCategory = ProductCategory::where('fldProductCategoryProductID','=',$id)->get();

		$cat = ProductCategory::where('fldProductCategoryProductID','=',$id)->first();
		
		$maincat = Category::where('fldCategoryID','=',$cat->fldProductCategoryCategoryID)->first();
		
		foreach($productsCategory as $productsCategories) {
			$pCategories[] = $productsCategories->fldProductCategoryCategoryID;
		}


	    
    

		
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first(); 
		$options =  Options::orderby('fldOptionsPosition')->get();    
		$product_options = ProductOptions::where('fldProductOptionsProductID','=',$id)->get();
		$productClass = 'class=active';
		$pageTitle = PRODUCT_MANAGEMENT;
	    return View::make('_admin.product.products_edit', array('products' => $products,
	    													    'additional_image' => $additional_image,
	    													    'category'=>$category,
	    													    'maincat'=>$maincat,
	    													    'pCategories'=>$pCategories,	    													   
	    													    'administrator'=>$administrator,
	    													    'options'=>$options,
	    													    'product_options'=>$product_options,
	    													    'productClass'=>$productClass,
	    													    'pageTitle'=>$pageTitle));		
   }
   
   public function postEdit($id) {	
     $rules   = Product::rules($id);     	 
	 $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/products/edit/'.$id)->withInput()->withErrors($validator,'product');		                
	  } else { 
				 $file = Input::file('image');
				 $product_class = new Product;
				 $products = Product::find($id);	   
				 
				
			    if(count(Input::get('category')) == 0) {
						Session::flash('error',"Please select category");
						return Redirect::to('dnradmin/products/edit/'.$id);	  
						exit();
				}
				
				 $slug = $product_class->generate_slug(Input::get('name'), $id);
				
				 //if there is changes on the product name move the image from old path to new path
				 if($products->fldProductSlug != $slug) {
				 	//copy all files to old slug to new slug
				 	$path = PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/';
				 	$target = PRODUCT_IMAGE_PATH.$slug.'/';

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
					  	
				  	  $path = Input::file('image')->getRealPath();
					  list($width, $height) = getimagesize($path);
					   if(($width <= "3000" && $height <= "3000") && ($width >= "300" && $height >= "300")) {
					      $products->fldProductImage = Product::uploadSingleImage(Input::file('image'),$slug);
					   } else {
					   	 Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!");
					       return Redirect::to('dnradmin/products/edit/'.$id)->withInput();	
			                      //Upload single Image
					      	   		
					   }
				  }
				  
				   
				   $products->fldProductName = Input::get('name');	
				   $products->fldProductSubTitle = Input::get('sub_title'); 
				   $products->fldProductPrice = Input::get('price');	
				   $products->fldProductOldPrice = Input::get('old_price'); 
				   $products->fldProductWeight = Input::get('weight');
				   $products->fldProductDescription = Input::get('description');
				   $products->fldProductIsNew = Input::get('isNew');
				   $products->fldProductIsFeatured = Input::get('isFeatured');
				   
				  
				   //CODE FOR MULTIPLE IMAGES
				   	//$notUploaded = Product::multipleUpload(Input::file('images'),$slug,$id);
				        $notUploaded = "";
					//generate slug
					
					
					$products->fldProductSlug = $slug;

				  $products->save();
				   
				   //delete all category
				   if(count(Input::get('category')) >=1 ) {

						   $pCategory = ProductCategory::where('fldProductCategoryProductID','=',$id)->get();
						   foreach($pCategory as $pCategories) {
							  $delete = ProductCategory::find($pCategories->fldProductCategoryID);
							  $delete->delete();
						   }
						   
						   //add new category
						    foreach(Input::get('category') as $category) {
									   $categories = new ProductCategory;
											$categories->fldProductCategoryProductID = $products->fldProductID;
											$categories->fldProductCategoryCategoryID = $category;
									   $categories->save();
									   $category_id = $categories->fldProductCategoryCategoryID;
							}
					}
					 /* CODE FOR OPTIONS ASSIGN TO PRODUCTS */
					 
					  $pOptions = ProductOptions::where('fldProductOptionsProductID','=',$id)->get();
					  //print_r($pOptions);die();
					   foreach($pOptions as $pOptionss) {
						  $delete = ProductOptions::find($pOptionss->fldProductOptionsID);
						  $delete->delete();
					   }
					 
							if(Input::get('options_assets')) {
							   $asset_price = Input::get('assets_price');	   	   	   
							   foreach(Input::get('options_assets') as $key=>$option_assets) {	
								 $option_price = isset($asset_price[$option_assets])  ? $asset_price[$option_assets] : 0;		
								   $optionsInfo = OptionsAssets::find($option_assets);
								  			 
								  $productOptions = new ProductOptions;
										$productOptions->fldProductOptionsProductID = $id;
										$productOptions->fldProductOptionsAssetsID = $option_assets;
										$productOptions->fldProductOptionsOptionsID = $optionsInfo->fldOptionsAssetsOptionID;
										$productOptions->fldProductOptionsPrice = $option_price;
								   $productOptions->save();
								 
							   }			
							}
						    /* END CODE FOR OPTIONS ASSIGN TO PRODUCTS */
				   
				   //$categories = ProductsManagement::orderby('position')->get(); 
				   //return View::make('_admin.products_view', array('products' => $categories,'products_id'=>$main_id));

					if($notUploaded != "") {
						   Session::flash('upload_error',$notUploaded); 
					}
				   Session::flash('success',"Product was successfully saved."); 
				   return Redirect::to('dnradmin/products/edit/'.$id);
		}		   

   }
   
    public function getDelete($id,$category_id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		 $products = Product::find($id);
		 $image1 = 'upload/products/'.$products->fldProductID.'/'.$products->fldProductImage;
		 $image2 = 'upload/products/'.$products->fldProductID.'/_75_'.$products->fldProductImage;
		 $image3 = 'upload/products/'.$products->fldProductID.'/_140_'.$products->fldProductImage;
		 $image4 = 'upload/products/'.$products->fldProductID.'/_400_'.$products->fldProductImage;
		 
		  
		File::delete($image1);
		File::delete($image2);
		File::delete($image3);
		File::delete($image4);
		
		
		
		$products->delete();
		
		//delete all category under this products
		$pCategory = ProductCategory::where('fldProductCategoryProductID','=',$id)->delete();
		// foreach($pCategory as $pCategories) {
		// 	$delete = ProductCategory::find($pCategories->id);
		//  	$delete->delete();
		// }
		
		
		//$products = StaffManagement::paginate(20);
	    //return View::make('_admin.staff', array('products' => $products));
		return Redirect::to('dnradmin/products/view/'.$category_id);
	}
	
	public function getDelete1($id,$delete) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$addProductsImages = AdditionalProduct::where('fldAdditionalProductID','=',$delete)->first();
		 $image1 = 'upload/products/'.$id.'/others/'.$addProductsImages->fldAdditionalProductIDImage;
		 $image2 = 'upload/products/'.$id.'/others/_75_'.$addProductsImages->fldAdditionalProductIDImage;
		 $image3 = 'upload/products/'.$id.'/others/_140_'.$addProductsImages->fldAdditionalProductIDImage;
		 $image4 = 'upload/products/'.$id.'/others/_400_'.$addProductsImages->fldAdditionalProductIDImage;
		 
		 File::delete($image1);
		File::delete($image2);
		File::delete($image3);
		File::delete($image4);
		 
		$addProductsImages->delete();
		return Redirect::to('dnradmin/products/edit/'.$id);
	}


	public function displayAll($slug="") {

		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$pages = Pages::where('fldPagesSlug', '=', 'collection')->first();
		$category = Category::orderby('fldCategoryPosition')->get();	
		
		settype($category_details, 'object');
			
		if($slug == "") {	
			/*$product_vertical = Product::join('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','tblProduct.fldProductID')
					   ->join('tblCategory','tblCategory.fldCategoryID','=','tblProductCategory.fldProductCategoryCategoryID')	
					   ->orderBY('fldProductName')
					   ->where('fldProductIsVertical',1)
					   ->paginate(2);*/
			$product_vertical = array();
			
			$product = Product::join('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','tblProduct.fldProductID')
					   ->join('tblCategory','tblCategory.fldCategoryID','=','tblProductCategory.fldProductCategoryCategoryID')	
					   ->orderBY('fldProductName')
					   ->paginate(12);

			$category_details->fldCategoryName = "Products";
															
		} else {
			$category_details= Category::where('fldCategorySlug','=',$slug)->first();
			
			$product = Product::leftJoin('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','tblProduct.fldProductID')
								->where('tblProductCategory.fldProductCategoryCategoryID','=',$category_details->fldCategoryID)
								->orderBY('fldProductName')
								->paginate(12);
		}				

		/* get prices */
		$product_array_id = $product_array_prices = $product_array_highest_prices = $product_array_lowest_prices = array();
		foreach($product as $get_product_item){
			$product_array_id[] = $get_product_item->fldProductID;
		}
		$product_option_class = new ProductOptions;
		
		$get_product_options = $product_option_class->whereIn('fldProductOptionsProductID', $product_array_id)->orderBy('fldProductOptionsPrice','DESC')->get();

		foreach($get_product_options as $get_product_option){
			$fldProductOptionsProductID = $get_product_option->fldProductOptionsProductID;
			$fldProductOptionsPrice =  $get_product_option->fldProductOptionsPrice;
			$product_array_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			if(!isset($product_array_highest_prices[$fldProductOptionsProductID])){
				$product_array_highest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}
			if(!isset($product_array_lowest_prices[$fldProductOptionsProductID])){
				$product_array_lowest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}
			if($fldProductOptionsPrice < $product_array_lowest_prices[$fldProductOptionsProductID]){
				$product_array_lowest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}
			if($fldProductOptionsPrice > $product_array_highest_prices[$fldProductOptionsProductID]){
				$product_array_highest_prices[$fldProductOptionsProductID] = $fldProductOptionsPrice;
			}

		}

								
		$google = Google::first();
		$cart_count = TempCart::countCart();	
		$settings = Settings::first();
		$footer = Footer::first();

	
   		return View::make('home.products')->with(array('pages'=> $pages,
   													   'menus' => $menus, 
   													   'category' => $category, 
   													   'category_details' => $category_details, 
   													   'product' => $product,
   													   'product_vertical' => $product_vertical,
   													   'google' => $google,
   													   'settings'=>$settings,
   													   'footer'=>$footer,
   													   'slug'=>$slug,
   													   'cart_count'=>$cart_count,
	   													'product_array_prices'=>$product_array_prices,
	   													'product_array_highest_prices'=>$product_array_highest_prices,
	   													'product_array_lowest_prices' => $product_array_lowest_prices));
	}


	public function displayPerCategory($slug) {

		$google = Google::first();
		$cart_count = TempCart::countCart();
		$settings = Settings::first();
		$footer = Footer::first();

		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$pages = Pages::where('fldPagesSlug', '=', 'collection')->first();
		$category = Category::orderby('fldCategoryPosition')->get();	
		
		// settype($category_details, 'object');
		
		$category_details= Category::where('fldCategorySlug','=',$slug)->first();
		
		/*$product_vertical = Product::join('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','tblProduct.fldProductID')
					   ->join('tblCategory','tblCategory.fldCategoryID','=','tblProductCategory.fldProductCategoryCategoryID')	
					   // ->orderBY('fldProductName')
					   ->where('fldProductIsVertical',1)
					   ->paginate(2);*/

			$product_vertical = array();
		$product = Product::leftJoin('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','tblProduct.fldProductID')
							->where('tblProductCategory.fldProductCategoryCategoryID','=',$category_details->fldCategoryID)
					   
							->paginate(12);

		// echo "<pre>";
		// print_r($product);
		// die('--displayPerCategory');

		return View::make('home.products', compact('pages','menus','category','category_details','product','google','settings','footer','cart_count','slug', 'product_vertical'));
	}

	public function getProductAPI($slug = ''){
		Log::debug('getProductAPI'.$slug);
		$get_response = array();
		switch ($slug) {
			case 'mats':
				$get_response = $this->getGraphikMatsAPI();
				# code...
				break;
			case 'paper':
				$get_response = $this->getGraphikPapersAPI();
				# code...
				break;
			case 'frames':
				$get_response = $this->getGraphikFramesAPI();
				# code...
				break;
			
			default:
				# code...
				break;
		}
		return json_encode($get_response);

		/*$graphikAPI = GraphikDimension::displayAll(1); // for all frames
		
		
		list($frameDesc,$frameWidth,$sku,$graphikAPI,$color, $styleValue,$widthValue,$materialValue,$framePrice) = \App\Models\GraphikDimension::getGraphikAttribute($graphikAPI->frame);
	    $graphikAPICount = count($graphikAPI);
	    $slideCount = floor($graphikAPICount / 6);
	    $slideFinalCount = fmod($graphikAPICount,6) > 0 ? $slideCount+1 : $slideCount;
	    
	    $graphikPaperAPI = \App\Models\GraphikDimension::displayAll(4); // for paper api
	    $graphikCanvassAPI = \App\Models\GraphikDimension::displayAll(5); // for canvas api
	    $graphikMatsAPI = \App\Models\GraphikDimension::displayAll(2); //for mats
	    $graphikGlazingAPI = \App\Models\GraphikDimension::displayAll(3); //for glazings

	    // get default price for frame and paper
	    $xmlbld = new App\SoapXmlBuilder;
	    $xmlbld->setImageElem($product->fldProductImageWidth, $product->fldProductImageHeight, $product->fldProductName, url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage));
	    $xmlbld->setPaperElem($graphikPaperAPI->paper->sku);
	    // $xmlbld->setFrameElem($sku);
	    $packagePrice = $xmlbld->curlExec('getProductGroupPrice', 'pricingGroupRequest');
	    $packagePrice = $packagePrice['PricedProductPackage'];*/
	 
	}

	public function getGraphikMatsAPI(){
		$graphikMatsAPI = GraphikDimension::displayAll(2); //for mats
		$graphikMatsAPI_html = '';
		$client_mats_array = array('PM918', 'BC6277', 'PM33');
		if(count($graphikMatsAPI) > 0 && $graphikMatsAPI != NULL){
			foreach($graphikMatsAPI->mat as $graphikMatsAPIs){
				$sku = $graphikMatsAPIs->sku;
				if(in_array($sku, $client_mats_array)){
					$graphikMatsAPI_html .= '<div class="uk-thumbnail uk-thumbnail-small uk-width-1-4 uk-container-center">
                        <a href="#selectedMats" class="full-width uk-text-center selectMat" onClick="selectedMat(\''.$sku.'\',\''.$graphikMatsAPIs->shortDescription.'\','.$graphikMatsAPIs->priceData->markUpPrice.')"> <img src="http://image.pictureframes.com/images/mats/'.$sku.'.gif" style="width:100px; height: 100px;" > </a>
                        <div class="uk-thumbnail-caption"><a href="#" class="full-width uk-text-center" onClick="selectedMat(\''.$sku.'\',\''.$graphikMatsAPIs->shortDescription.'\','.$graphikMatsAPIs->priceData->markUpPrice.')">'.$graphikMatsAPIs->shortDescription.'</a></div>
                    </div>';
				}
				
			}
			 
		}
		return $graphikMatsAPI_html;
	}
	public function getGraphikPapersAPI(){
		$GraphikPapersAPI = GraphikDimension::displayAll(4); //for mats
		/*$default_paper = array();
		foreach($GraphikPapersAPI->paper as $GraphikPapersAPIs){
			
		}*/
		return $GraphikPapersAPI;
	}
	public function getGraphikFramesAPI(){
		$graphikAPI = GraphikDimension::displayAll(6); //for mats
		/*$default_paper = array();
		foreach($GraphikPapersAPI->paper as $GraphikPapersAPIs){			
		}*/
		/*dd($graphikAPI); exit();
		$graphikAPI_param = GraphikDimension::getGraphikAttribute($graphikAPI->frame);
		dd($graphikAPI_param); exit();*/
		list($frameDesc,$frameWidth,$sku,$graphikAPI_param,$colorValue, $styleValue,$widthValue,$materialValue,$framePrice) = GraphikDimension::getGraphikAttribute($graphikAPI->frame);

		Log::debug('getGraphikFramesAPI graphikAPI');
		
		return array('frameDesc'=>$frameDesc,'frameWidth'=>$frameWidth,'sku'=>$sku,'graphikAPI'=>$graphikAPI_param,'colorValue'=>$colorValue, 'styleValue'=>$styleValue,'widthValue'=>$widthValue,'materialValue'=>$materialValue,'framePrice'=>$framePrice);

		
	}

	public function searchProduct() {
		$search = Input::get('search');
		$slug = "";
		
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$pages = Pages::where('fldPagesSlug', '=', 'collection')->first();
		$category = Category::orderby('fldCategoryPosition')->get();	
		
		settype($category_details, 'object');

		/*$product_vertical = Product::join('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','tblProduct.fldProductID')
					   ->join('tblCategory','tblCategory.fldCategoryID','=','tblProductCategory.fldProductCategoryCategoryID')	
					    ->orderBY('fldProductName')
						->where(function($query) use ($search) {                
        						          return $query->where('fldProductName', 'LIKE', '%'.$search.'%')
            								 ->orWhere('fldProductSubTitle', 'LIKE', '%'.$search.'%')
            								 ->orWhere('fldProductPrice', 'LIKE', '%'.$search.'%');
    					})
					   ->where('fldProductIsVertical',1)
					   ->paginate(2);*/

			$product_vertical = array();

		$product = Product::join('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','tblProduct.fldProductID')
								->join('tblCategory','tblCategory.fldCategoryID','=','tblProductCategory.fldProductCategoryCategoryID')
								->orderBY('fldProductName')
								->where(function($query) use ($search) {                
                						          return $query->where('fldProductName', 'LIKE', '%'.$search.'%')
                    								 ->orWhere('fldProductSubTitle', 'LIKE', '%'.$search.'%')
                    								 ->orWhere('fldProductPrice', 'LIKE', '%'.$search.'%');
            					})
								->paginate(12);
		//print_r($product);die();
		$category_details->fldCategoryName = "Products";

		$google = Google::first();
		$cart_count = TempCart::countCart();	
		$settings = Settings::first();
		$footer = Footer::first();
	
   		return View::make('home.products')->with(array('pages'=> $pages,
   													   'menus' => $menus, 
   													   'category' => $category, 
   													   'category_details' => $category_details, 
   													   'product' => $product,
   													   'product_vertical' => $product_vertical,
   													   'google' => $google,
   													   'settings'=>$settings,
   													   'footer'=>$footer,
                                                        'slug'=>$slug,
   													   'cart_count'=>$cart_count));								
	}
	
	public function display($slug) {
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();	
		$category_details = Category::where('fldCategorySlug','=',$slug)->first();

		//$product = ProductsManagement::where('category_id','=',$category_details->id)->get();		
		//echo $category_details->id;
		$product = Product::leftJoin('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','tblProduct.fldProductID')
								->where('tblProductCategory.fldProductCategoryCategoryID','=',$category_details->fldCategoryID)
								->get();
		$google = Google::first();
		$cart_count = TempCart::countCart();	
		$settings = Settings::first();
		$footer = Footer::first();

   		return View::make('home.products')->with(array('menus' => $menus, 
   													   'category' => $category, 
   													   'category_details' => $category_details, 
   													   'product' => $product,
   													   'google' => $google,
   													   'settings'=>$settings,
   													   'footer'=>$footer,
   													   'cart_count'=>$cart_count));
	}
	
	public function details($slug) {

		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();	
		$product = Product::where('fldProductSlug','=',$slug)->first();
		
					
		$category_details = Category::leftJoin('tblProductCategory','tblProductCategory.fldProductCategoryCategoryID','=','tblCategory.fldCategoryID')
									->where('tblProductCategory.fldProductCategoryProductID','=',$product->fldProductID)
									->first();	
		
		$productImage = AdditionalProduct::where('fldAdditionalProductProductID','=',$product->fldProductID)->get();
		$google = Google::first();
		$cart_count = TempCart::countCart();		
		//$productOptions = ProductOptions::displayOptions($product->fldProductID);
		$settings = Settings::first();
		$footer = Footer::first();
		
		// $productOption = ProductOptions::leftJoin('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','tblProductOptions.fldProductOptionsAssetsID')
		// 						->where('fldProductOptionsProductID','=',$product->fldProductID)
		// 						->select('fldProductOptionsPrice','fldProductOptionsID','fldOptionsAssetsWidth','fldOptionsAssetsHeight','fldOptionsAssetsWidthFraction','fldOptionsAssetsHeightFraction')
		// 						->get();
	
		$productOption = ProductOptions::leftJoin('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','tblProductOptions.fldProductOptionsAssetsID')
								->where('fldProductOptionsProductID','=',$product->fldProductID)
								->select('fldProductOptionsPrice','fldProductOptionsID','fldOptionsAssetsWidth','fldOptionsAssetsHeight','fldOptionsAssetsWidthFraction','fldOptionsAssetsHeightFraction')
								->orderBy('fldOptionsAssetsWidth','ASC')
								->get();

		// echo '<pre>';
		// print_r($productOption);
		// die('details');

		//get the product options assets
		if(count($productOption) > 0) {
			$product->fldProductImageHeight = $productOption{0}->fldOptionsAssetsHeight;
			$product->fldProductImageWidth = $productOption{0}->fldOptionsAssetsWidth;
			$product->fldProductImagePrice = $productOption{0}->fldProductOptionsPrice;
			$product->fldProductImageID = $productOption{0}->fldProductOptionsID;
		} else {
			$product->fldProductImageHeight = 8;
			$product->fldProductImageWidth = 11;
			$product->fldProductImageID = 0;
		}
   		return View::make('home.products-details')->with(array('menus' => $menus, 
															   'category' => $category, 
															   'category_details' => $category_details, 
															   'product' => $product, 
															   'productImage' => $productImage,
															   'google'=>$google,
															   'cart_count'=>$cart_count,
															   'settings'=>$settings,
													   		   'footer'=>$footer,
															   'productOption' =>$productOption));

	}

	public function get_details($slug) {

		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		$category = Category::where('fldCategoryMainID','=',0)->orderby('fldCategoryPosition')->get();	
		$product = Product::where('fldProductSlug','=',$slug)->first();
		
					
		$category_details = Category::leftJoin('tblProductCategory','tblProductCategory.fldProductCategoryCategoryID','=','tblCategory.fldCategoryID')
									->where('tblProductCategory.fldProductCategoryProductID','=',$product->fldProductID)
									->first();	
		
		$productImage = AdditionalProduct::where('fldAdditionalProductProductID','=',$product->fldProductID)->get();
		$google = Google::first();
		$cart_count = TempCart::countCart();		
		//$productOptions = ProductOptions::displayOptions($product->fldProductID);
		$settings = Settings::first();
		$footer = Footer::first();
		
		// $productOption = ProductOptions::leftJoin('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','tblProductOptions.fldProductOptionsAssetsID')
		// 						->where('fldProductOptionsProductID','=',$product->fldProductID)
		// 						->select('fldProductOptionsPrice','fldProductOptionsID','fldOptionsAssetsWidth','fldOptionsAssetsHeight','fldOptionsAssetsWidthFraction','fldOptionsAssetsHeightFraction')
		// 						->get();
	
		$productOption = ProductOptions::leftJoin('tblOptionsAssets','tblOptionsAssets.fldOptionsAssetsID','=','tblProductOptions.fldProductOptionsAssetsID')
								->where('fldProductOptionsProductID','=',$product->fldProductID)
								->select('fldProductOptionsPrice','fldProductOptionsID','fldOptionsAssetsWidth','fldOptionsAssetsHeight','fldOptionsAssetsWidthFraction','fldOptionsAssetsHeightFraction')
								->orderBy('fldOptionsAssetsWidth','ASC')
								->get();

		// print_r($productOption);
		// die('details');

		//get the product options assets
		if(count($productOption) > 0) {
			$product->fldProductImageHeight = $productOption{0}->fldOptionsAssetsHeight;
			$product->fldProductImageWidth = $productOption{0}->fldOptionsAssetsWidth;
			$product->fldProductImagePrice = $productOption{0}->fldProductOptionsPrice;
			$product->fldProductImageID = $productOption{0}->fldProductOptionsID;
		} else {
			$product->fldProductImageHeight = 8;
			$product->fldProductImageWidth = 11;
			$product->fldProductImageID = 0;
		}
   		return View::make('home.products-details-test')->with(array('menus' => $menus, 
															   'category' => $category, 
															   'category_details' => $category_details, 
															   'product' => $product, 
															   'productImage' => $productImage,
															   'google'=>$google,
															   'cart_count'=>$cart_count,
															   'settings'=>$settings,
													   		   'footer'=>$footer,
															   'productOption' =>$productOption));
	}

	public function displayFrame() {
		$graphikAPI = GraphikDimension::displayAll(1);
		$graphikAPICount = count($graphikAPI->frame);

		

	   	$slideCount = floor($graphikAPICount / 6);
		$slideFinalCount = fmod($graphikAPICount,6) > 0 ? $slideCount+1 : $slideCount;

		list($frameDesc,$frameWidth,$sku,$graphikAPI,$colorValue, $styleValue,$widthValue,$materialValue,$framePrice) = GraphikDimension::getGraphikAttribute($graphikAPI->frame);
		Log::debug('displayFrame graphikAPI');
		//dd($graphikAPI);
		//print_r($graphikAPI);
		//print_r($graphikAPI);die();
		return View::make('home.frame_display')->with(array('graphikAPI'=>$graphikAPI,'slideFinalCount'=>$slideFinalCount));

	}

	public function displayFrameSearch($color,$width,$style,$material,$sortby) {
		$graphikAPI = GraphikDimension::displayAll(1);
		
		/*
		list($frameWidth,$sku,$graphikAPI,$colorValue, $styleValue,$widthValue,$materialValue) = GraphikDimension::getGraphikAttribute($graphikAPI->frame);
		
		print_r($graphikAPI);die();
		print_r(array_search($color, $graphikAPI));die();
		*/
		$frameDisplay = GraphikDimension::displayAllSearch($graphikAPI->frame,$color,$width,$style,$material,$sortby);
		//print_r($frameDisplay);die();
		$graphikAPICount = count($frameDisplay);
	 	$slideCount = floor($graphikAPICount / 6);
		$slideFinalCount = fmod($graphikAPICount,6) > 0 ? $slideCount+1 : $slideCount;

		list($frameDesc,$frameWidth,$sku,$graphikAPI,$colorValue, $styleValue,$widthValue,$materialValue,$framePrice) = GraphikDimension::getGraphikAttribute($frameDisplay);

		return View::make('home.frame_display')->with(array('graphikAPI'=>$frameDisplay,'slideFinalCount'=>$slideFinalCount));

	}

    public function displayFrameSearchBySKU($sku) {

		// $graphikAPI = GraphikDimension::displayAll(1);
		// $frameDisplay = GraphikDimension::displayAllSearchBySKU($graphikAPI->frame,$sku);
		// 
    	$frameDisplay = [];
		$searchBySku = GraphikDimension::searchBySku($sku);

		//print_r($searchBySku);die();

		if(!$searchBySku){
			return "<strong>SKU: ".$sku." NOT FOUND </strong>";
		}

		$frameDisplay[] = $searchBySku->externalproduct;

		$graphikAPICount = count($frameDisplay);
	 	$slideCount = floor($graphikAPICount / 6);
		$slideFinalCount = fmod($graphikAPICount,6) > 0 ? $slideCount+1 : $slideCount;
		
		list($frameDesc,$frameWidth,$sku,$graphikAPI,$colorValue, $styleValue,$widthValue,$materialValue,$framePrice) = GraphikDimension::getGraphikAttribute($frameDisplay);

		return View::make('home.frame_display')->with(array('graphikAPI'=>$frameDisplay,'slideFinalCount'=>$slideFinalCount));
	}


	public function displayFramePricing() {

		$wsdl = "https://ifs.graphikservices.com/services/pricingService?wsdl";
		 //printAndFramePackage or canvasWrapPackage
		$previous_encoding = mb_internal_encoding();
		print_r($previous_encoding);
   		//Set the encoding to UTF-8, so when reading files it ignores the BOM       
   		mb_internal_encoding('UTF-8');
		$options = array(
		  // "detailLevel" => "4",
		  // "userId" => config('gd_api.graphikUserID'),
		  "userId" => "1000506996﻿",
		  "userAccess" => "0FC64D717788C2310626F5D6A199EA54754DB71051E9D578",
		  "pricingGroupRequest xsi:type='ns1:printAndFramePackage'" =>array(
				  "image"=> array(
				  	"height"=>6.00,
				  	"width"=>6.00,
				  	"imageName"=> "Mountains-2",
				  	"imageUrl"=> "http://104.197.67.179/clarkin/public/uploads/products/mountains-2/mountains.jpg"
				  ),
				  "substrate xsi:type='ns1:paper'"=>array(
				  	"sku"=>"PAPER7"
				  ),

				  "frame"=>array(
				  	"sku"=>'3BK'
				  ),

				  "finishKit"=>array(
				  	"sku"=>"CAHF"
				  ),

				  "mat1"=>array(
				  	"sku"=>"PM63297",
				  	"topBorder"=>2,
				  	"bottomBorder"=>2,
				  	"rightBorder"=>2,
				  	"leftBorder"=>2
				  ),

				  "mat2"=>array(
				  	"sku"=>"PM989",
				  	"offset"=>2.5
				  )
		 	)
		  
		);
		echo "<pre>";
		var_dump($options);
		echo "</pre>";
		
		$client = new SoapClient($wsdl);
		// dd($client->__getFunctions());

		$response = $client->__soapCall("getProductGroupPrice", array($options));
		dd($client->__getLastRequest());
		try {
 			
			echo $client->__getLastResponse();
		}
		catch (Exception $e) {
			$error_xml =  $client->__getLastRequest();
			echo $error_xml;
			echo "\n\n".$e->getMessage();
		}

		return $response;
	}

	function render_grapik(){
		$graphik_url_render = 'http://pod.cloud.graphikservices.com/renderEMF/render';
		$graphik_url_render_param = '';
		if(Input::get('imgUrl')){
			$graphik_url_render_param .= $this->append_to_url_param($graphik_url_render_param,'imgUrl='.Input::get('imgUrl'));
		}
		if(Input::get('sku')){
			$graphik_url_render_param .= $this->append_to_url_param($graphik_url_render_param,'sku='.Input::get('sku'));
		}
		if(Input::get('imgHI')){
			$graphik_url_render_param .= $this->append_to_url_param($graphik_url_render_param,'imgHI='.Input::get('imgHI'));
		}
		if(Input::get('imgWI')){
			$graphik_url_render_param .= $this->append_to_url_param($graphik_url_render_param,'imgWI='.Input::get('imgWI'));
		}
		$graphik_url_render_html = '';
		if($graphik_url_render_param != ''){
			$graphik_url_render_html = file_get_contents($graphik_url_render.'?'.$graphik_url_render_param.'&t=2&b=2&r=2&l=2&mat1=PM983&mat2=PM3297');
		}
		return ($graphik_url_render_html);
	}

	function append_to_url_param($current_url = '', $new_param = ''){
		if($current_url != ''){
			$current_url .= '&';
		}
		$current_url .= $new_param;
		return $current_url;
	}


	

}
