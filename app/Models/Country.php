<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Country extends Eloquent
{
   
    protected $table = 'tblCountry';
    protected $primaryKey = 'fldCountryID';
	public $timestamps = false;

	public static function displayCountry()
	{		
		$country = self::orderby('fldCountryID')->get();
		$ctr=0;
		foreach ($country as $countries)
		{
			$countrylist[$countries->fldCountryCode] = $countries->fldCountryName;			
		}		
		return $countrylist;
	}
	
	public static function displayExpirationMonth() {
		for($i=1;$i<=12;$i++) { 
	         $date = date('Y').'-'.$i.'-1';			 
			$monthList[$i] = date('F', strtotime($date));			
		}
		
		return $monthList;
	}
	
	public static function displayExpirationYear() {
		for($x=date('Y');$x<=date('Y')+15;$x++) {	        
			$yearList[$x] = $x;			
		}
		
		return $yearList;
	}
		
		
}


?>