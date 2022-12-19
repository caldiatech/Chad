<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Tax extends Eloquent
{
   
    protected $table = 'tblCartTax';
    protected $primaryKey = 'fldCartTaxID';
	public $timestamps = false;
		
}


?>