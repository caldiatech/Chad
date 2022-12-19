<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UPS extends Eloquent
{
   
    protected $table = 'tblUPS';
    protected $primaryKey = 'fldUPSID';
	public $timestamps = false;

	public static function rules() {
		
		
			$rules = [
				'xml_access_key'    => 'required|max:100',                 		       
		        'user_id'  	   		=> 'required|max:50',
		        'password'  	    => 'required|max:50',
		        'city'   			=> 'required|max:100',
		        'state'  		    => 'required|max:100',
		        'zip'  		    	=> 'required|max:10'		       
			];
		
		
		

		return $rules;
	}

	public static function getInfo() {
		$upsinfo = self::orderby('fldUPSID')->first();		
		return $upsinfo;
	}
		
}


?>