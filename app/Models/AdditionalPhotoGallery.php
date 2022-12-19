<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class AdditionalPhotoGallery extends Eloquent
{
   
    protected $table = 'tblAdditionalPhotoGallery';
    protected $primaryKey = 'fldAdditionalPhotoGalleryID';
	public $timestamps = false;
	
	
}


?>