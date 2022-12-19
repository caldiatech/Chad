<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ProductCategory extends Eloquent
{
   
    protected $table = 'tblProductCategory';
    protected $primaryKey = 'fldProductCategoryID';
	public $timestamps = false;
		
}


?>