<?php
namespace App\Http\Controllers;


use App\Models\Settings;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Str;
use View;
use Input;
use Hash;
use Redirect;
use Session;

class NewsCategoryController extends Controller
{
   public function getIndex()
    {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		$category_id = 0;
		$category =  NewsCategory::orderby('fldNewsCategoryPosition')->get();
        return View::make('_admin.news.news_category', array('category' => $category,'category_id'=>$category_id));
    }

	public function getDisplay($category_id)
    {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$category =  NewsCategory::orderby('fldNewsCategoryPosition')->get();
        return View::make('_admin.news.news_category', array('category' => $category,'category_id'=>$category_id));
    }


	public function getNew()
   {
	   	//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
   		return View::make('_admin.news.news_category_add');
   }


   public function getUpdatePosition() {
	   $pctr=1;

		foreach(Input::get('page_manager') as $pageManager) {
			$positionTR =  explode("_",$pageManager);
			$position_id = $positionTR[0];

			 $category = NewsCategory::find($position_id);
			 if($category) {
				 $category->fldNewsCategoryPosition = $pctr;
				 $category->save();
				 $pctr=$pctr+1;
			 }



		}



   }


   public function postNew() {

	   $category = new NewsCategory;
	   $category->fldNewsCategoryName = Input::get('name');


	   //generate slug
	   $pageCount = NewsCategory::where('fldNewsCategoryName','=',Input::get('name'))
	   					->count();
	    $slug = $pageCount == 0 ? Str::slug($category->fldNewsCategoryName,'-') : Str::slug($category->fldNewsCategoryName."-".$pageCount,'-');

		$category->fldNewsCategorySlug = $slug;

	   //get last position
	    $categoryPosition = NewsCategory::orderby("fldNewsCategoryPosition","desc")->first();
			$category->fldNewsCategoryPosition = $categoryPosition->fldNewsCategoryPosition+1;
	    $category->save();

   }

   public function getEdit($id) {
   		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

	   $category =  NewsCategory::where('fldNewsCategoryID', '=', $id)->first();
	    return View::make('_admin.news.news_category_edit', array('category' => $category));
   }

   public function postEdit($id) {

	   $category = NewsCategory::find($id);
	   $category->fldNewsCategoryName = Input::get('name');

	  //generate slug
	   $pageCount = NewsCategory::where('fldNewsCategoryName','=',Input::get('name'))
	   					->where('fldNewsCategoryID','!=',$id)
	   					->count();
	    $slug = $pageCount == 0 ? Str::slug($category->fldNewsCategoryName,'-') : Str::slug($category->fldNewsCategoryName."-".$pageCount,'-');

	   $category->fldNewsCategorySlug = $slug;
	   $category->save();


   }

    public function getDelete($id) {
		//if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		 $category = NewsCategory::find($id);
		 $position = $category->fldNewsCategoryPosition;

		$category->delete();

		//update all category positions
		$categoryPos = NewsCategory::where("fldNewsCategoryPosition",">",$position)->orderby("fldNewsCategoryPosition")->get();


		foreach($categoryPos as $categoryPoss) {
			 $categoryUpdate = NewsCategory::find($categoryPoss->fldNewsCategoryID);
			 	$categoryUpdate->fldNewsCategoryPosition = $categoryPoss->fldNewsCategoryPosition - 1;
			 $categoryUpdate->save();
		}


	}
}
