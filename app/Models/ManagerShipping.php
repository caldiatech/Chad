<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ManagerShipping extends Eloquent
{
   
    protected $table = 'tblManagerShipping';
    protected $primaryKey = 'fldManagerShippingID';
	public $timestamps = false;
		
}


?>