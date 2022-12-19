<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class NewsCategory extends Eloquent
{
   
    protected $table = 'tblNewsCategory';
    protected $primaryKey = 'fldNewsCategoryID';
	public $timestamps = false;
		
}


?>