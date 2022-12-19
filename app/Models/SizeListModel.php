<?php
 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Image;
use File;
use Validator;
use Request;

class SizeListModel extends Model
{
    public $timestamps = true;
    protected $table = 'tblprintsizelist';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'height',
        'fractionHeight',
        'width',
        'fractionWidth',
        'price',
        'print_id'
    ];



    public static function frameFraction($fraction) {
		$fraction_result = '';
		if($fraction == ".0") {
			$fraction_result = "0";
		} else if($fraction == ".125") {
			$fraction_result = "1 / 8";
		} else if($fraction == ".25") {
			$fraction_result = "1 / 4";
		} else if($fraction == ".375") {
			$fraction_result = "3 / 8";
		} else if($fraction == ".5") {
			$fraction_result = "1 / 2";
		} else if($fraction == ".625") {
			$fraction_result = "5 / 8";
		} else if($fraction == ".75") {
			$fraction_result = "3 / 4";
		} else if($fraction == ".875") {
			$fraction_result = "7 / 8";
		}
		return $fraction_result;
		
	}
}