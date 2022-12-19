<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Fedex extends Eloquent
{
   
    protected $table = 'tblFedex';
    protected $primaryKey = 'fldFedexID';
	public $timestamps = false;

	public static function rules() {
		
		
			$rules = [
				'access_key'    => 'required|max:100',                 		       
		        'password'  	=> 'required|max:50',
		        'account_no'  	=> 'required|numeric',
		        'meter_no'   	=> 'required|numeric',
		        'address'  		=> 'required|max:255',
		        'city'  		=> 'required|max:100',		       
		        'state'  		=> 'required|max:100',
		        'zip'  		    => 'required|max:10'
			];
		
		
		

		return $rules;
	}

	public static function getInfo() {
		$upsinfo = self::orderby('fldFedexID')->first();		
		return $upsinfo;
	}	
}


?>