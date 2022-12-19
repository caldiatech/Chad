<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Authorize extends Eloquent
{
   
    protected $table = 'tblAuthorize';
    protected $primaryKey = 'fldAuthorizeID';
	public $timestamps = false;
		
}


?>