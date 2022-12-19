<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Staff extends Eloquent
{
   
    protected $table = 'tblStaff';
    protected $primaryKey = 'fldStaffID';
	public $timestamps = false;
		
}


?>