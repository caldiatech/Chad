<?php
namespace App\Http\Controllers;


use App\Models\Settings;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Pages;
use App\Models\Google;
use App\Models\TempCart;
use App\Models\Footer;


use View;
use Input;
use Hash;
use Redirect;
use Session;

class NewsController extends Controller
{
    public function getIndex()
    {    
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		   
		$news = NewsCategory::orderBy('fldNewsCategoryPosition')->get();        
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first(); 
		$newsClass = 'class=active';

        return View::make('_admin.news.news-category-display', array('news' => $news,
        															 'administrator'=>$administrator,
        															 'newsClass'=>$newsClass));
    }
	
	public function getDisplay($id)
    {    
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}   
		$news = News::where("fldNewsCategoryID","=",$id)->orderby('fldNewsNewsDate',"DESC")->get();        
		$newsDisp = NewsCategory::where('fldNewsCategoryID','=',$id)->first();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first(); 
		$newsClass = 'class=active';
        return View::make('_admin.news.news', array('news' => $news,
        											'category_id'=>$id,
        											'newsDisp'=>$newsDisp,
        											'administrator'=>$administrator,
        											'newsClass'=>$newsClass));
    }
	
    	
	public function getNew($category_id)
   {
	   	//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   
		$newsDisp = NewsCategory::where('fldNewsCategoryID','=',$category_id)->first();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first(); 
		$newsClass = 'class=active';
   		return View::make('_admin.news.news_add',array("category_id"=>$category_id,
   													   'newsDisp'=>$newsDisp,
   													   'administrator'=>$administrator,
   													   'newsClass'=>$newsClass));
   } 
  
   
   
   public function postNew() {
	     	
	   $news = new News;
	   $news->fldNewsName = Input::get('title');	 
	   $news->fldNewsCategoryID = Input::get('category_id');	 
	   $news->fldNewsDescription = Input::get('description');
	   $news->fldNewsNewsDate = Input::get('news_date');	 
	   
	   //generate slug
	   $pageCount = News::where('fldNewsName','=',Input::get('title'))->count();
	   $slug = $pageCount == 0 ? str_slug($news->fldNewsName,'-') : str_slug($news->fldNewsName."-".$pageCount,'-');

	   $news->fldNewsSlug = $slug;
	   
	   $news->save();	   	  
	   	   
	   
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first(); 
	   $newsClass = 'class=active';

	   Session::flash('success',"News was successfully saved.");  
	   return Redirect::to('dnradmin/news/new/0');
	   	  
   }
   
   public function getEdit($id,$category_id) {
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   
	   $news =  News::where('fldNewsID', '=', $id)->first();
	   $newsDisp = NewsCategory::where('fldNewsCategoryID','=',$category_id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first(); 
	   $newsClass = 'class=active';
	    return View::make('_admin.news.news_edit', array('news' => $news,
	    												 'category_id'=>$category_id,
	    												 'newsDisp'=>$newsDisp,
	    												 'administrator'=>$administrator,
	    												 'newsClass'=>$newsClass));		
   }
   
   public function postEdit($id) {	  
		$category_id = Input::get('category_id');

	    $news = News::find($id);
		$news->fldNewsCategoryID = Input::get('category_id');	 
	    $news->fldNewsName = Input::get('title');	 
		$news->fldNewsNewsDate = Input::get('news_date');	 
	   $news->fldNewsDescription = Input::get('description');
	   $category_id =  Input::get('category_id');

	   //generate slug
	   $pageCount = News::where('fldNewsName','=',Input::get('title'))
	   					->where('fldNewsID','!=',$id)
	   					->count();
	   $slug = $pageCount == 0 ? str_slug($news->fldNewsName,'-') : str_slug($news->fldNewsName."-".$pageCount,'-');

	   $news->fldNewsSlug = $slug;
	   	  
	   $news->save();

	   Session::flash('success',"News was successfully saved.");  
	   return Redirect::to('dnradmin/news/edit/'.$id."/".$category_id);
	   
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$news = News::find($id);	
		if(empty($news)) {
			return Redirect::to('dnradmin/news');
			exit();
		}	
		$category_id = $news->fldNewsCategoryID;
		$news->delete();
		
		if($category_id) {
			return Redirect::to('dnradmin/news/display/'.$category_id);
		} else {
			return Redirect::to('dnradmin/news');
		}
	}
	
	public function newsDisplay() {
		$news = News::orderby('fldNewsNewsDate','desc')->get();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		
		$settings = Settings::first();
		$google = Google::first();	
		$cart_count = TempCart::countCart();		
		$settings->site_name = "News";
		$news_category = NewsCategory::orderby("fldNewsCategoryPosition")->get();
		$news_category_id  = 0;
		$pages = Pages::find(51);
		$footer = Footer::first();
		 return View::make('home.news')->with(array('menus'=>$menus,
		 											'settings'=>$settings,
		 											'news'=>$news,
		 											'google'=>$google,
		 											'news_category'=>$news_category,
		 											'cart_count'=>$cart_count,
		 											'pages'=>$pages,
		 											'footer'=>$footer,
		 											'news_category_id'=>$news_category_id)); 
	}
	
	public function newsDisplayCategory($slug) {
		$newsCategory = NewsCategory::where("fldNewsCategorySlug",'=',$slug)->first();		
		$news = News::where('fldNewsCategoryID','=',$newsCategory->fldNewsCategoryID)->orderby('fldNewsNewsDate','desc')->get();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
		
		$settings = Settings::first();
		$google = Google::first();	
		$cart_count = TempCart::countCart();	
		$settings->site_name = "News";
		$news_category = NewsCategory::orderby("fldNewsCategoryPosition")->get();
		$pages = Pages::find(51);
		$footer = Footer::first();
		 return View::make('home.news')->with(array('menus'=>$menus,		 											
		 											'settings'=>$settings,
		 											'news'=>$news,
		 											'google'=>$google,
		 											'news_category'=>$news_category,
		 											'news_category_id'=>$newsCategory->fldNewsCategoryID,
		 											'pages'=>$pages,
		 											'footer'=>$footer,
		 											'cart_count'=>$cart_count)); 
	}
	
	public function newsFind($slug) {
		$news = News::where('fldNewsSlug','=',$slug)->first();
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();
				
		$settings = Settings::first();	
		$google = Google::first();	
		$cart_count = TempCart::countCart();
		$settings->site_name = "News";
		$news_category = NewsCategory::orderby("fldNewsCategoryPosition")->get();
		
		

		$news_next_search = News::where('fldNewsID','>',$news->fldNewsID)->orderBy('fldNewsNewsDate','DESC')->min('fldNewsID');
		$news_next  = News::where('fldNewsID','=',$news_next_search)->first();
		$news_previous_search = News::where('fldNewsID','<',$news->fldNewsID)->orderBy('fldNewsNewsDate','DESC')->max('fldNewsID');
		$news_previous = News::where('fldNewsID','=',$news_previous_search)->first();
		//print_r($news_next);die();
		$footer = Footer::first();
		 return View::make('home.news_display')->with(array('menus'=>$menus,		 												    
		 												    'settings'=>$settings,
		 												    'news'=>$news,
		 												    'google'=>$google,
		 												    'footer'=>$footer,
		 												    'news_category'=>$news_category,
		 												    'news_category_id'=>$news->category_id,
		 												    'cart_count'=>$cart_count,
		 												    'news_next'=>$news_next,
		 												    'news_previous'=>$news_previous)); 
	}
}
