<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Str;
use Validator;
use File;
use Image;
use Request;


class UneditedText extends Eloquent
{

    protected $table = 'unedite_image_text';
    protected $primaryKey = 'id';
	// public $timestamps = false;


    public static function rules($id) {

		if($id == 0) {
			$rules = [
				'text'        => 'required'
			];
		} else {
			$rules = [
				'text'        => 'required'
			];
		}


		return $rules;
	}

}


?>
