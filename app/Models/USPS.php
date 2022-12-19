<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class USPS extends Eloquent
{
   
    protected $table = 'tblUSPS';
    protected $primaryKey = 'fldUSPSID';
	public $timestamps = false;

	public static function rules() {
		
		
			$rules = [
				'username'      => 'required|max:100',                 		       		        
		        'zip'  		    => 'required|max:10'
			];
		
		
		

		return $rules;
	}

	public static function getInfo() {
		$uspsinfo = self::orderby('fldUSPSID')->first();		
		return $uspsinfo;
	}	
}


?>