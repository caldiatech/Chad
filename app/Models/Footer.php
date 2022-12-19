<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Footer extends Eloquent
{
   
    protected $table = 'tblFooter';
    protected $primaryKey = 'fldFooterID';
	public $timestamps = false;
	
	
}


?>