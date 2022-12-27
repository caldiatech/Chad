<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ShippingFee extends Eloquent
{

    protected $table = 'tblshippingfee';
    protected $primaryKey = 'fldShippingFeeID';
	public $timestamps = false;

}
?>