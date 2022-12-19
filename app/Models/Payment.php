<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Payment extends Eloquent
{
   
    protected $table = 'tblPayment';
    protected $primaryKey = 'fldPaymentID';
	public $timestamps = false;
		
}


?>