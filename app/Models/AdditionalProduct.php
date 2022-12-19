<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class AdditionalProduct extends Eloquent
{
   
    protected $table = 'tblAdditionalProduct';
    protected $primaryKey = 'fldAdditionalProductID';
	public $timestamps = false;
		
}


?>