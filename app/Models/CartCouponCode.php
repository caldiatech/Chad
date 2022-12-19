<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CartCouponCode extends Eloquent
{
   
    protected $table = 'tblCartCouponCode';
    protected $primaryKey = 'fldCartCouponCodeID';
	public $timestamps = false;
		
}


?>