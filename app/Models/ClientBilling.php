<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ClientBilling extends Eloquent
{
   
    protected $table = 'tblClientsBilling';
    protected $primaryKey = 'fldClientsBillingID';
	public $timestamps = false;
		
}


?>