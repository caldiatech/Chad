<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Settings extends Eloquent
{

    protected $table = 'tblAdministrator';
    protected $primaryKey = 'fldAdministratorID';
    public $timestamps = false;

    public static function rules($id) {

		if($id == 0) {
			$rules = [
			'fullname'         => 'required',
		        'email'            => 'required|email|unique:tblAdministrator,fldAdministratorEmail',
		        'username'         => 'required|unique:tblAdministrator,fldAdministratorUsername',
		        'password'         => 'required|min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/'
			];
		} else {
			$rules = [
			'fullname'         => 'required',
		        'email'            => 'required|email|unique:tblAdministrator,fldAdministratorEmail,'.$id.',fldAdministratorID',
		        'username'         => 'required|unique:tblAdministrator,fldAdministratorUsername,'.$id.',fldAdministratorID',
		        'password'         => 'min:8|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/'
			];
		}

		return $rules;
	}

}


?>
