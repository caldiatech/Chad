<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Options extends Eloquent
{
   
    protected $table = 'tblOptions';
    protected $primaryKey = 'fldOptionsID';
	public $timestamps = false;
		
}


?>