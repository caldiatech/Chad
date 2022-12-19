<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PagesPreview extends Eloquent
{
   
    protected $table = 'tblPagesPreview';
    protected $primaryKey = 'fldPagesPreviewID';
	public $timestamps = false;
		
}


?>