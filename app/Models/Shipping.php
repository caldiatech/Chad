<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Shipping extends Eloquent
{
   
    protected $table = 'tblShipping';
    protected $primaryKey = 'fldShippingID';
	public $timestamps = false;
		
}


?>