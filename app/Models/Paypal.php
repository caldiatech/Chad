<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Paypal extends Eloquent
{
   
    protected $table = 'tblPaypal';
    protected $primaryKey = 'fldPaypalID';
	public $timestamps = false;
		
}


?>