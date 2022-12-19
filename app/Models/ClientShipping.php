<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ClientShipping extends Eloquent
{
   
    protected $table = 'tblClientsShipping';
    protected $primaryKey = 'fldClientsShippingID';
	public $timestamps = false;
		
}


?>