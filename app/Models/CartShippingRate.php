<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CartShippingRate extends Eloquent
{
   
    protected $table = 'tblCartShippingRate';
    protected $primaryKey = 'fldCartShippingRateID';
	public $timestamps = false;
		
}


?>