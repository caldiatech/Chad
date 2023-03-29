<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Validator;
use Request;

class Pages extends Eloquent
{
   
    protected $table = 'tblPages';
    protected $primaryKey = 'fldPagesID';
	public $timestamps = false;
	
	public static function rules() {

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
				'name'         => 'required|max:255',                 
		        'title'        => 'required|max:255',
		        'image' 	   => 'img_min_size:'.PAGES_IMAGE_WIDTH.','.PAGES_IMAGE_HEIGHT.'|mimes:jpeg,gif,png'		        
			];
		

		return $rules;
	}

	public static function FAQRules() {
		$rules = [				      
		        'email'            => 'required|email', 		      
		        'question'         => 'required'
			];
		

		return $rules;
	}

	public static function pageList()
	{
		$pagelist = array();
		$page = self::where('fldPagesMainID','=',0)->where('fldPagesIsVisible','=','1')->orderby('fldPagesPosition')->get();
		
		foreach ($page as $pages)
		{
			$pagelist[$pages->fldPagesID] = $pages->fldPagesName;
			$subpage = self::where('fldPagesMainID','=',$pages->fldPagesID)->where('fldPagesIsVisible','=','1')->orderby('fldPagesPosition')->get();
			foreach ($subpage as $subpages)
			{
				$pagelist[$subpages->fldPagesID] = "&nbsp;&nbsp;&nbsp;--".$subpages->fldPagesName;	
			}
		}
		return $pagelist;
	}

	public static function displayMenu()
	{
		$menuList = array();
		$page = self::where('fldPagesMainID','=',0)->where('fldPagesIsVisible','=','1')->where('fldPagesID','!=',74)->orderBy('fldPagesPosition')->get();
		$ctr=0;
		foreach ($page as $pages)
		{
			$menuList[] = array("pagename"=>$pages->fldPagesName,"slug"=>$pages->fldPagesSlug,"isCMS"=>$pages->fldPagesIsCMS,"filename"=>$pages->fldPagesFilename);
			$subpage = self::where('fldPagesMainID','=',$pages->fldPagesID)->where('fldPagesIsVisible','=','1')->orderBy('fldPagesPosition')->get();
			$nctr=0;
			foreach($subpage as $subpages) {
				//get the second level
				$menuList[$ctr]['subpage'][] = array("pagename"=>$subpages->fldPagesName,"slug"=>$subpages->fldPagesSlug,"isCMS"=>$subpages->fldPagesIsCMS,"filename"=>$subpages->fldPagesFilename);
				//get the third level
				
				$thirdpage = self::where('fldPagesMainID','=',$subpages->fldPagesID)->where('fldPagesIsVisible','=','1')->orderBy('fldPagesPosition')->get();	

				foreach($thirdpage as $thirdpages) {
					//echo $subpages->name . ' ' . $subpages->id . ' ' . $ctr . ' ' . $nctr;die();
					$menuList[$ctr]['subpage'][$nctr]['thirdpage'][] = array("pagename"=>$thirdpages->fldPagesName,"slug"=>$thirdpages->fldPagesSlug,"isCMS"=>$thirdpages->fldPagesIsCMS,"filename"=>$thirdpages->fldPagesFilename);		
				} 
				$nctr=$nctr+1;
			}
			$ctr=$ctr+1;
		}	

		return $menuList;
	}
}


?>