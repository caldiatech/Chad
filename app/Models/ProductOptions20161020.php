<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ProductOptions extends Eloquent
{
   
    protected $table = 'tblProductOptions';
    protected $primaryKey = 'fldProductOptionsID';
	public $timestamps = false;

	static function displayOptions($product_id) {
		$optionList = array();
		$ctr=0;				
		$productOptions = self::leftJoin('tblOptions','tblProductOptions.fldProductOptionsOptionsID','=','tblOptions.fldOptionsID')
								->select('tblOptions.fldOptionsName as option_name','tblOptions.fldOptionsID as option_id')
								->where('tblProductOptions.fldProductOptionsProductID','=',$product_id)
								->groupby('option_id')
								->get();

		foreach($productOptions as $productOption) {
			$optionList[] = array("option_name"=>$productOption->option_name,"option_id"=>$productOption->option_id);
			$productAssets = self::leftJoin('tblOptionsAssets','tblProductOptions.fldProductOptionsAssetsID','=','tblOptionsAssets.fldOptionsAssetsID')
								->select('tblOptionsAssets.fldOptionsAssetsName as option_name','tblOptionsAssets.fldOptionsAssetsID as option_id',
										 'tblProductOptions.fldProductOptionsPrice as option_price')
								->where('tblProductOptions.fldProductOptionsProductID','=',$product_id)
								->where('tblProductOptions.fldProductOptionsID','=',$productOption->option_id)
								->get(); 		
			
			foreach($productAssets as $productAsset) {			
				$optionPrice = $productAsset->option_price >=1 ? ' + $'.$productAsset->option_price : "";
				
				$optionList[$ctr]['assets'][] = array("assets_name"=>$productAsset->option_name.$optionPrice,"assets_id"=>$productAsset->option_id);
			}
			$ctr=$ctr+1;
		}
		//die();
		//print_r($productOptions);die();
		return $optionList;	
		
	}

	static function setMatOptions($request) {
		
		$mats = [];
		$options = [];
		for($a = 1; $a <= $request->get('mat_type'); $a++){
			$matinfo = explode(';', $request->get("mat".$a."_info"));
			$mats[$a] = $matinfo[0];

			// options
			if($request->has('offset'.$a)){
				$offset = [$request->get('offset'.$a)];
				$opts = array_merge($offset, $request->get('option'.$a));
			}else{
				$opts = ($request->has('option'.$a)) ? $request->get('option'.$a) : [];
			}

			$options[$a] = implode(',', $opts);
		}

		return [$mats, $options];
	}
}


?>