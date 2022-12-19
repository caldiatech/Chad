<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Contact;
use App\Models\Pages;
use App\Models\Google;
use App\Models\TempCart;
use App\Models\Footer;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;

class ContactController extends Controller
{
    public function getIndex()
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$contact = Contact::all();        
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
		$contactClass = 'class=active';
        return View::make('_admin.contact.contact', array('contact' => $contact,
        												  'administrator'=>$administrator,
        												  'contactClass'=>$contactClass));
    }
	
  
 	
	public function getNew()
   {
	   	//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
	   	
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
		$contactClass = 'class=active';
   		return View::make('_admin.contact.contact_add',array('administrator'=>$administrator,
   															 'contactClass'=>$contactClass));
   } 
   
     
   
   public function postNew() {
  	
  	  $rules   = Contact::rules();     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/contact/new')->withInput()->withErrors($validator,'contact');		                
	  } else {
		   $contacts = new Contact;
		   $contacts->fldContactFirstname = Input::get('firstname');	 
		   $contacts->fldContactLastname = Input::get('lastname');	 
		   $contacts->fldContactSubject = Input::get('subject');	 
		   $contacts->fldContactComments = Input::get('comments');
		   $contacts->fldContactEmail = Input::get('email');
		   $contacts->fldContactPhone = Input::get('phone');
		   $contacts->save();	   	  
		   	   
		   $contacts = Contact::find($contacts->fldContactID);

		   $contacts->save();		  
		   
		    Session::flash('success',"Contact was successfully saved."); 
		    return Redirect::to('dnradmin/contact/new');
		} 
	  
   }
   
   public function getEdit($id) {
	   //if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
			   
	   $contact =  Contact::where('fldContactID', '=', $id)->first();
	   $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
	   $contactClass = 'class=active';
	    return View::make('_admin.contact.contact_edit', array('contact' => $contact,	    													  
	    													   'administrator'=>$administrator,
	    													   'contactClass'=>$contactClass));		
   }
   
   public function postEdit($id) {	  

   	  $rules   = Contact::rules();     	 
	  $validator = Validator::make(Input::all(), $rules);
	    	
	  	if ($validator->fails()) {   	  
	        return Redirect::to('dnradmin/contact/edit/'.$id)->withInput()->withErrors($validator,'contact');		                
	  	} else {
		   $contacts = Contact::find($id);	 
		   $contacts->fldContactFirstname = Input::get('firstname');	 
		   $contacts->fldContactLastname = Input::get('lastname');	 
		   $contacts->fldContactSubject = Input::get('subject');	 
		   $contacts->fldContactComments = Input::get('comments');
		   $contacts->fldContactEmail = Input::get('email');
		   $contacts->fldContactPhone = Input::get('phone');
		  
		   $contacts->save();

		   $contact = Contact::all();
		   //return View::make('_admin.contact', array('contact' => $contact));
		   Session::flash('success',"Contact was successfully saved."); 	    
		   return Redirect::to('dnradmin/contact/edit/'.$id);	
		}  
   }
   
    public function getDelete($id) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$contacts = Contact::find($id);		

		if(empty($contacts)) {
			return Redirect::to('dnradmin/contact');
			die();
		}

		$contacts->delete();
		
		$contact = Contact::paginate(20);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();  
		$contactClass = 'class=active';
	    return View::make('_admin.contact.contact', array('contact' => $contact,
	    												  'administrator'=>$administrator,
	    												  'contactClass'=>$contactClass));
	}
	
	public function contact() {
		$menus = Pages::where('fldPagesMainID', '=', 0)->get();		
		$settings = Settings::first();
		$google = Google::first();		
		$pages = Pages::where('fldPagesID','=',35)->first();			
		$cart_count = TempCart::countCart();	
		$footer = Footer::first();
   		return View::make('home.contact-us')->with(array('menus'=>$menus,   														
   														 'settings'=>$settings,
   														 'google'=>$google,
   														 'pages'=>$pages,
   														 'footer'=>$footer,
   														 'cart_count'=>$cart_count)); 
		
	}
	
	public function contactSave() {
			
	   	   $contacts = new Contact;		   		   
		   $contacts->fldContactFirstname = Input::get('firstname');	 
		   $contacts->fldContactLastname = Input::get('lastname');	 
		   $contacts->fldContactSubject = Input::get('subject');	 
		   $contacts->fldContactComments = Input::get('comments');
		   $contacts->fldContactEmail = Input::get('email');
		   $contacts->fldContactPhone = Input::get('phone');
		   
		   
		   $messages = array(
		    	'firstname.required' => 'Please input your first name.',
				'lastname.required' => 'Please input your last name.',
				'email.required' => 'Please input your valid email address.',
				'phone.min' => 'Phone must have atleast 10 digits.'
			);
		
	    	$fields = Input::all();
			$rules = array('firstname'=>'required', 'lastname' => 'required', 'email' => 'required|email', 'phone' => 'required|min:13');
		    $validation = Validator::make($fields, $rules,$messages);
			
			if ($validation->fails()){
				return Redirect::to('contact-us/')->withErrors($validation)->withInput();
			} else {
		   
			   $contacts->save();			   
			 //   $contactsInfo = ContactManagement::find($contacts->id);	   	  			   
			   
			 //   $contacts = array("firstname"=>$contactsInfo->firstname,"lastname"=>$contactsInfo->lastname,"subject"=>$contactsInfo->subject,"comments"=>$contactsInfo->comments,"email"=>$contactsInfo->email,"phone"=>$contactsInfo->phone);
			   
			 //   //send email to owner			   			   
			 //   Mail::send('home.email_contact', $contacts, function ($message) {									
				// 		$settings = SettingsManagement::first();
				// 		$ownerEmail = $settings->email == "" ? "test1@dogandrooster.net" : $settings->email;
				// 		$ownerName = $settings->site_name == "" ? "Dog and Rooster" : $settings->site_name;
			   
				// 		$message->from(Input::get('email'),Input::get('firstname') . " " . Input::get('lastname'));
				// 		$message->to($ownerEmail,$ownerName)->subject("Contact Us");									
				// });
			   
			   return Redirect::to('thankyou/contact-us-thankyou');
			} // validation ends
	}
}
