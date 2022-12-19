<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ShopOwnerShipping extends Eloquent
{
   
    protected $table = 'tblShopOwnerShipping';
    protected $primaryKey = 'fldShopOwnerShippingID';
	public $timestamps = false;
		
}


?>