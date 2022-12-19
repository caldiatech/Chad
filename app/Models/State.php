<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class State extends Eloquent
{
   
    protected $table = 'tblState';
    protected $primaryKey = 'fldStateID';
	public $timestamps = false;


	public static function displayState()
	{
		$menuList = array();
		$state = self::orderby('fldStateID')->get();
		$ctr=0;
		foreach ($state as $states)
		{
			$statelist[$states->fldStateID] = $states->fldStateName;			
		}		
		return $statelist;
	}
	
	public static function getStateTax($state,$total) {
		$state = self::where('fldStateID','=',$state)->first();
		$tax = 0;
		if(!empty($state)){
			$tax = $total * ($state->fldStateTax);
		}
		return $tax;
	}
	
	public static function getStateTax_percent($state,$total) {
		$state = self::where('fldStateID','=',$state)->first();
		$tax_percent = 0;
		if(!empty($state)){
			$tax_percent = $state->fldStateTax;
		}		
		return $tax_percent;
	}
		
}


?>