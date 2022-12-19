<?php
namespace App\Models;

// use App\Models\Product;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Image;
use File;
use Validator;
use Request;

class ProductCost extends Eloquent
{
   
    protected $table = 'tblProductCost';
    protected $primaryKey = 'productcost_id';
    public $timestamps = false;

}
?>