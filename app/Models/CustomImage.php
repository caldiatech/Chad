<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Validator;
use Request;

class CustomImage extends Eloquent
{
   
    protected $table = 'tblcustomeimage';
    protected $primaryKey = 'Id';
	public $timestamps = false;
}
	
?>