<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PhotoGallery extends Eloquent
{
   
    protected $table = 'tblPhotoGallery';
    protected $primaryKey = 'fldPhotoGalleryID';
	public $timestamps = false;
	
	
}


?>