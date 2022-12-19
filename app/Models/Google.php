<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Google extends Eloquent
{
   
    protected $table = 'tblGoogle';
    protected $primaryKey = 'fldGoogleID';
	public $timestamps = false;
	
	
}


?>