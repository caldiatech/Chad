<?php
namespace App\Http\Controllers;

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

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Html;
use Image;
use Validator;
use File;
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
        return View::make('_admin.product.products', array('products' => $products,
        												   'administrator'=>$administrator,
        												   'productClass'=>$productClass));
        
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
        return View::make('_admin.product.products', array('product' => $products,
        												   'category_id'=>$id,
        												   'mainid'=>$mainid,
        												   'administrator'=>$administrator,
        												   'productClass'=>$productClass));
    }
	
	public function getNew()
   {
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
	   	//$success = "";		
		$category = Category::where('fldCategoryMainID','=','0')->orderby("fldCategoryPosition")->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();          		
		$options =  Options::orderby('fldOptionsPosition')->get();    
		$productClass = 'class=active';
   		return View::make('_admin.product.products_add',array('category'=>$category,   															  
   															  'administrator'=>$administrator,
   															  'options'=>$options,
   															  'productClass'=>$productClass));
   															  
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
	   $file = Input::file('image');
		if($file != "") {
		   $path = Input::file('image')->getRealPath();
		   list($width, $height) = getimagesize($path);
		}

	   if($width == "600" && $height == "350" && $file != "") { 
				//get the last product position
	   	$categoryID = Input::get('category');
	   	$catID = reset($categoryID);
	   	
				$productPos = Product::join('tblProductCategory','tblProductCategory.fldProductCategoryProductID','=','fldProductID')
										->where('fldProductCategoryCategoryID','=',$catID)
										->orderBy('fldProductPosition','DESC')
										->first();
				if(count($productPos)==1):						
					$newPosition = $productPos->fldProductPosition + 1;
				else:
					$newPosition =1;	
				endif;	

			   $products = new Product;
			   $products->fldProductName = Input::get('name');	 
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
			   $slug = $pageCount == 0 ? str_slug($products->fldPagesName,'-') : str_slug($products->fldPagesName."-".$pageCount,'-');

			   $products->fldProductSlug = $slug;		
			   $products->save();	   	  
			   
			   //save multiple category
			   foreach(Input::get('category') as $category) {
				   $categories = new ProductCategory;
						$categories->fldProductCategoryProductID = $products->fldProductID;
						$categories->fldProductCategoryCategoryID = $category;
				   $categories->save();
			   }
			   
			    /* CODE FOR OPTIONS ASSIGN TO PRODUCTS */
				if(Input::get('options_assets')) {
				   $asset_price = Input::get('assets_price');	   	   	   
				   foreach(Input::get('options_assets') as $key=>$option_assets) {	
					   //$option_price = $asset_price[$option_assets];	
					   $optionsInfo = OptionsAssets::find($option_assets);
					  			 
					  $productOptions = new ProductOptions;
							$productOptions->fldProductOptionsProductID = $products->fldProductID;
							$productOptions->fldProductOptionsAssetsID = $option_assets;
							$productOptions->fldProductOptionsOptionsID = $optionsInfo->fldOptionsAssetsOptionID;
							//$productOptions->fldProductOptionsPrice = $option_price;
					   $productOptions->save();
					 
				   }			
				}
			    /* END CODE FOR OPTIONS ASSIGN TO PRODUCTS */
				
				   
			   $products = Product::find($products->fldProductID);
			   //$category_id = Input::get('category_id');
			   
			   $file = Input::file('image');
			   if($file != "") {
				   $destinationPath = 'upload/products/'.$products->fldProductID.'/';
				   $filename = $file->getClientOriginalName();
				   Input::file('image')->move($destinationPath, $filename);	   
				   
				   $products->fldProductImage = $filename;
				   
				   //resize the image to 400px
				   $img = Image::make($destinationPath.$filename)->resize(400, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.'_400_'.$filename, 90);
				   //resize the image to 140px
				   $img = Image::make($destinationPath.$filename)->resize(140, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.'_140_'.$filename, 90);
				   //resize the image to 75px
				   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				   $img->save($destinationPath.'_75_'.$filename, 90);		   		   
			   } else {
				   $products->fldProductImage = "";
			   }	   	
			   	   
			   $products->save();		  	   
			   
			   
				
			   //CODE FOR MULTIPLE IMAGES
				$count = count(Input::file('images'));									
				if($count >1 ) { 
						$images = Input::file('images');
						$destinationPath = 'upload/products/'.$products->id.'/others/';
						for ($i=0; $i < $count; $i++)
						{
							$UserImage = $images["{$i}"];
							$additional_filename = $UserImage->getClientOriginalName();
							$images["{$i}"]->move($destinationPath, $additional_filename);	   
							
						  //save the other images to database					
						   $img = Image::make($destinationPath.$additional_filename)->resize(400, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
						   $img->save($destinationPath.'_400_'.$additional_filename, 90);
						   //resize  the image to 140px
						   $img = Image::make($destinationPath.$additional_filename)->resize(140, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
						   $img->save($destinationPath.'_140_'.$additional_filename, 90);
						   //resize the image to 75px
						   $img = Image::make($destinationPath.$additional_filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
						   $img->save($destinationPath.'_75_'.$additional_filename, 90);
						   
						   $addProductsImages = new AdditionalProduct;
							 $addProductsImages->fldAdditionalProductProductID = $products->fldProductID;
							 $addProductsImages->fldAdditionalProductIDImage = $additional_filename;
						   $addProductsImages->save();
						   
						}
					}
				
			 
			   Session::flash('success',"Product was successfully saved."); 
			   return Redirect::to('dnradmin/products/new');	
	   } else {
		   
		   Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!");
		   return Redirect::to('dnradmin/products/new')->withInput();	
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
	    return View::make('_admin.product.products_edit', array('products' => $products,
	    													    'additional_image' => $additional_image,
	    													    'category'=>$category,
	    													    'maincat'=>$maincat,
	    													    'pCategories'=>$pCategories,	    													   
	    													    'administrator'=>$administrator,
	    													    'options'=>$options,
	    													    'product_options'=>$product_options,
	    													    'productClass'=>$productClass));		
   }
   
   public function postEdit($id) {	
     
	 $file = Input::file('image');
	 $products = Product::find($id);	   
	 
	  if($file != "") {
		  	
	  	  $path = Input::file('image')->getRealPath();
		  list($width, $height) = getimagesize($path);
		   if($width != "600" && $height != "350") {
		   	   Session::flash('error',"Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!");
		       return Redirect::to('dnradmin/products/edit/'.$id)->withInput();	
		   } else {
			   $destinationPath = 'upload/products/'.$products->fldProductID.'/';
			   $filename = $file->getClientOriginalName();
			   Input::file('image')->move($destinationPath, $filename);	   
			   $products->fldProductImage = $filename;
			   
			   //resize the image to 400px
			   $img = Image::make($destinationPath.$filename)->resize(400, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
			   $img->save($destinationPath.'_400_'.$filename, 90);
				//resize the image to 140px
			   $img = Image::make($destinationPath.$filename)->resize(140, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
			   $img->save($destinationPath.'_140_'.$filename, 90);
			   //resize the image to 75px
			   $img = Image::make($destinationPath.$filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
			   $img->save($destinationPath.'_75_'.$filename, 90);	   		
		   }
	  }
	  
	   
	   $products->fldProductName = Input::get('name');	 
	   $products->fldProductPrice = Input::get('price');	
	   $products->fldProductOldPrice = Input::get('old_price'); 
	   $products->fldProductWeight = Input::get('weight');
	   $products->fldProductDescription = Input::get('description');
	   $products->fldProductIsNew = Input::get('isNew');
	   $products->fldProductIsFeatured = Input::get('isFeatured');
	   
	  
	   //CODE FOR MULTIPLE IMAGES
	   
	  
		$count = count(Input::file('images'));	
		if($count > 1) {	
			$images = Input::file('images');	
			$destinationPath = 'upload/products/'.$products->fldProductID.'/others/';
			for ($i=0; $i < $count; $i++)
			{
				// $UserImage = Input::file("images[{$i}]");
				// $additional_filename = $UserImage->getClientOriginalName();
				// Input::file("images[{$i}]")->move($destinationPath, $additional_filename);	   
				$UserImage = $images["{$i}"];
				$additional_filename = $UserImage->getClientOriginalName();
				$images["{$i}"]->move($destinationPath, $additional_filename);

				//save the other images to database					
			   $img = Image::make($destinationPath.$additional_filename)->resize(400, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
			   $img->save($destinationPath.'_400_'.$additional_filename, 90);
			    //resize  the image to 140px
		  		 $img = Image::make($destinationPath.$additional_filename)->resize(140, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
		   		$img->save($destinationPath.'_140_'.$additional_filename, 90);
			   //resize the image to 75px
			   $img = Image::make($destinationPath.$additional_filename)->resize(75, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
			   $img->save($destinationPath.'_75_'.$additional_filename, 90);
			   
			   $addProductsImages = new AdditionalProduct;
			   $addProductsImages->fldAdditionalProductProductID = $products->fldProductID;
			   $addProductsImages->fldAdditionalProductIDImage = $additional_filename;
			   $addProductsImages->save();
			   
			}
		}
	   	   
		//generate slug
		$pageCount = Product::where('fldProductName','=',Input::get('name'))
							  ->where('fldProductID','!=',$id)	
							  ->count();

		$slug = $pageCount == 0 ? str_slug(Input::get('name'),'-') : str_slug(Input::get('name')."-".$pageCount,'-');
		
		$products->fldProductSlug = $slug;

	  $products->save();
	   
	   //delete all category
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
					  //$option_price = $asset_price[$option_assets];	
					   $optionsInfo = OptionsAssets::find($option_assets);
					  			 
					  $productOptions = new ProductOptions;
							$productOptions->fldProductOptionsProductID = $id;
							$productOptions->fldProductOptionsAssetsID = $option_assets;
							$productOptions->fldProductOptionsOptionsID = $optionsInfo->fldOptionsAssetsOptionID;
							//$productOptions->fldProductOptionsPrice = $option_price;
					   $productOptions->save();
					 
				   }			
				}
			    /* END CODE FOR OPTIONS ASSIGN TO PRODUCTS */
	   
	   //$categories = ProductsManagement::orderby('position')->get(); 
	   //return View::make('_admin.products_view', array('products' => $categories,'products_id'=>$main_id));
	   Session::flash('success',"Product was successfully saved."); 
	   return Redirect::to('dnradmin/products/edit/'.$id);

   }
   
    public function getDelete($id,$category_id=0) {
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
		// 	$categoryDelete = ProductCategory::find($pCategories->id);
		//  	$categoryDelete->delete();
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
		$productOptions = ProductOptions::displayOptions($product->fldProductID);
		$settings = Settings::first();
		$footer = Footer::first();
		//print_r($productOptions);die();
   		return View::make('home.products-details')->with(array('menus' => $menus, 
   															   'category' => $category, 
   															   'category_details' => $category_details, 
   															   'product' => $product, 
   															   'productImage' => $productImage,
   															   'google'=>$google,
   															   'cart_count'=>$cart_count,
   															   'settings'=>$settings,
   													   		   'footer'=>$footer,
   															   'productOptions'=>$productOptions));
	}
}
