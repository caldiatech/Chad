<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class OptionsAssets extends Eloquent
{
   
    protected $table = 'tblOptionsAssets';
    protected $primaryKey = 'fldOptionsAssetsID';
	public $timestamps = false;
		
}


?>