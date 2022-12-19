<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Contact extends Eloquent
{
   
    protected $table = 'tblContact';
    protected $primaryKey = 'fldContactID';
	public $timestamps = false;

	public static function rules() {

		
			$rules = [
				'firstname'        => 'required|max:255', 
				'lastname'         => 'required|max:255',                 
		        'email'            => 'required|email', 
		        'subject'          => 'required|max:255', 
		        'comments'         => 'required'
			];
		

		return $rules;
	}	
		
}


?>