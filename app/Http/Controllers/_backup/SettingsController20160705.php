<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;
class SettingsController extends Controller
{
    

    public function getIndex()
    {       

		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$settings = Settings::orderby('fldAdministratorID')->get();  
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();   		
		$settingsClass = 'class=active';    
        return View::make('_admin.settings.settings', array('settings' => $settings,
        												    'administrator'=>$administrator,
        												    'settingsClass'=>$settingsClass));
    }

    public function displayLogin($error="") {

    	return View::make('_admin.index',array('error'=>$error));
    }
	
  
   public function postIndex()
    {       
		
		$settings = Settings::orderby('fldAdministratorID')->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();        
		$settingsClass = 'class=active';   
        return View::make('_admin.settings.settings', array('settings' => $settings,'administrator'=>$administrator,'settingsClass'=>$settingsClass));
        
    }	
	
	public function getNew()
   {
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
	   	$success = "";
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first(); 
		$settingsClass = 'class=active';   
   		return View::make('_admin.settings.settings_add',array('success'=>$success,'administrator'=>$administrator,'settingsClass'=>$settingsClass));
   } 
   
   public function getUpdatePosition() {
	   $pctr=0;
	  
		foreach(Input::get('page_manager') as $pageManager) {			
			$positionTR =  explode("_",$pageManager);			
			$position_id = $positionTR[0];			
								
			 $settingss = Settings::find($position_id);	
			 if($settingss) {			 
				 $settingss->position = $pctr;	
				 $settingss->save();				
			 }
			$pctr=$pctr+1;		
				 
			
		}
	   
		
   }
   
   
   public function postNew() {
	$rules   = Settings::rules(0);    
	$validator = Validator::make(Input::all(), $rules);
    	
    if ($validator->fails()) {    			
	    return Redirect::to('dnradmin/settings/new')->withInput()->withErrors($validator,'settings');		                
	} else {	        	
	   $settings = new Settings;
		   $settings->fldAdministratorFullname = Input::get('fullname');	 
		   $settings->fldAdministratorEmail = Input::get('email');	 
		   $settings->fldAdministratorPhone = Input::get('phone');	 
		   $settings->fldAdministratorUsername = Input::get('username');
	       $settings->fldAdministratorPassword = Hash::make(Input::get('password'));	   
		   $settings->fldAdministratorSiteName = Input::get('site_name');	   
		   $settings->fldAdministratorFacebook = Input::get('facebook');
		   $settings->fldAdministratorTwitter = Input::get('twitter');
		   $settings->fldAdministratorLinkedIn = Input::get('linkedIn');	   
	   $settings->save();	   	  
	   	   	   
	   
	   Session::flash('success',"Settings was successfully saved.");  
	   return Redirect::to('dnradmin/settings/new');	   
	 } 
   }
   
   public function getEdit($id) {
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   
	   $settings =  Settings::where('fldAdministratorID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first(); 
	    $settingsClass = 'class=active';   
	    return View::make('_admin.settings.settings_edit', array('settings' => $settings,'administrator'=>$administrator,'settingsClass'=>$settingsClass));		
   }
   
   public function postEdit($id) {	  
    $rules   = Settings::rules($id);    
	$validator = Validator::make(Input::all(), $rules);
    	
    if ($validator->fails()) {    			
	    return Redirect::to('dnradmin/settings/edit/'.$id)->withInput()->withErrors($validator,'settings');		                
	} else {	
			   $settings = Settings::find($id);	 
			 	   $settings->fldAdministratorFullname = Input::get('fullname');	 
				   $settings->fldAdministratorEmail = Input::get('email');	 
				   $settings->fldAdministratorPhone = Input::get('phone');	 
				   $settings->fldAdministratorUsername = Input::get('username');
			   if(Input::get('password') != "") { 
			       $settings->fldAdministratorPassword = Hash::make(Input::get('password'));	   
			   }
			 	   $settings->fldAdministratorSiteName = Input::get('site_name');	   
				   $settings->fldAdministratorFacebook = Input::get('facebook');
				   $settings->fldAdministratorTwitter = Input::get('twitter');
				   $settings->fldAdministratorLinkedIn = Input::get('linkedIn');	   
			   $settings->save();
			  	  
			  Session::flash('success',"Settings was successfully saved."); 
			  return Redirect::to('dnradmin/settings/edit/'.$id); 
	}
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$settingss = Settings::find($id);	

		if(empty($settingss)) {
			return Redirect::to('dnradmin/settings');
			exit();
		}

		$settingss->delete();
		
		$settings = Settings::paginate(20);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$settingsClass = 'class=active'; 
	    return View::make('_admin.settings.settings', array('settings' => $settings,'administrator'=>$administrator,'settingsClass'=>$settingsClass));
	}
	
	public function login() {
		
		$username = Input::get('username');
		$password = Input::get('password');
		
		$settings = Settings::where('fldAdministratorUsername','=',$username)->first();
		
		if(empty($settings)) {
			 $error = "Invalid username or password";
			 return View::make('_admin.index', array('error' => $error));
		} else {
			if(Hash::check($password,$settings->fldAdministratorPassword)) {
				if(Input::get('security') != Input::get('code')) {
					$error = "Invalid security code";
					return View::make('_admin.index', array('error' => $error));
				} else {
					//goto dashboard
					Session::put('dnradmin_id', $settings->fldAdministratorID);
					return Redirect::to('dnradmin/pages');
				}
			} else {
				$error = "Invalid username or password";
				 return View::make('_admin.index', array('error' => $error));
			}
			
		}
	}
	
	public function loginseo() {
		$username = Input::get('username');
		$password = Input::get('password');
		$settings = Settings::where('fldAdministratorUsername','=',$username)->first();
		
		if(empty($settings)) {
			 $error = "Invalid username or fldAdministratorPassword";
			 return View::make('_seo.index', array('error' => $error));
		} else {
			if(Hash::check($password,$settings->fldAdministratorPassword)) {
				if(Input::get('security') != Input::get('code')) {
					$error = "Invalid security code";
					return View::make('_seo.index', array('error' => $error));
				} else {
					//goto dashboard
					Session::put('dnradmin_id', $settings->fldAdministratorID);
					return Redirect::to('dnrseo/pages');
				}
			} else {
				$error = "Invalid username or password";
				 return View::make('_seo.index', array('error' => $error));
			}
			
		}
	}
	
	public function logout() {
		Session::flush();
		return Redirect::to('dnradmin/');
	}
	
	public function logoutseo() {
		Session::flush();
		return Redirect::to('dnrseo/');
	}
}
