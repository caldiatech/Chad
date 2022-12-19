<?php
namespace App\Http\Controllers;

// use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Shipping;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;
use SoapClient;

use App\SoapXmlBuilder;

class ShippingController extends Controller
{
  public function getIndex()
    {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		        
        $shipping = Shipping::all();
         
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$shippingClass = 'class=active'; 
		$pageTitle = SHIPPING_MANAGEMENT;
        return View::make('_admin.shipping.shipping', array('shipping' => $shipping,'administrator'=>$administrator,'shippingClass'=>$shippingClass,'pageTitle'=>$pageTitle));
    }
	
	 public function getView($id)
    {    
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		   
		if($id == 1) { 
	        return Redirect::to('dnradmin/shipping_ups');
		} else if($id == 2) { 
			return Redirect::to('dnradmin/shipping_fedex');	
		} else if($id == 3) { 
			return Redirect::to('dnradmin/shipping_usps');			
		}
    }
	
	public function getEdit($id)
    {       
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$shipping = Shipping::find($id);
		
		if($shipping->fldShippingIsActive == 1) {
			$shipping->fldShippingIsActive=0;
		} else {
			$shipping->fldShippingIsActive=1;
		}
		$shipping->save();
		
		return Redirect::to('dnradmin/shipping');
    }
	
	public function displayShipping($city,$state,$country,$zip,$weight,$total) {
		 $shipping = Shipping::where('fldShippingIsActive','=',1)->get();
		 if(count($shipping)==1) {
			 $shipping = Shipping::where('fldShippingIsActive','=',1)->first();
		 }
		 
		 $value = array('city'=>$city,'state'=>$state,'country'=>$country,'zip'=>$zip,'weight'=>$weight,'total'=>$total);
		 $administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		 $pageTitle = SHIPPING_MANAGEMENT;
		 return View::make('home.shipping', array('shipping' => $shipping,'values'=>$value,'administrator'=>$administrator,'pageTitle'=>$pageTitle));
	}
	
	public function displaySpin() {
		return View::make('home.spin');
	}

	public function displayShippingGraphic($address,$city,$state,$country,$zip,$total) {

		 $value = array('address'=>$address,'city'=>$city,'state'=>$state,'country'=>$country,'zip'=>$zip,'total'=>$total);	
		// print_r($value);die();
		  return View::make('home.shipping',array('value'=> $value));

	}
     
	public function fetchShipping() {

		// $zipcode = 'anc';
		$shipping_firstname = $_REQUEST['shipping_firstname'];
		$shipping_lastname 	= $_REQUEST['shipping_lastname'];
		$shipping_email 	= $_REQUEST['shipping_email'];
		$shipping_phone 	= $_REQUEST['shipping_phone'];
		$shipping_country 	= $_REQUEST['shipping_country'];
		$shipping_address 	= $_REQUEST['shipping_address'];
		$shipping_address1 	= $_REQUEST['shipping_address1'];
		$shipping_city 		= $_REQUEST['shipping_city'];
		$shipping_state 	= $_REQUEST['shipping_state'];
		$shipping_zip 		= $_REQUEST['shipping_zip'];

		$total 				= $_REQUEST['total'];
		$coupon_price 		= $_REQUEST['coupon_price'];
		$tax 				= $_REQUEST['tax'];
		$grand_total 		= $_REQUEST['grand_total'];
        
		// return 'ln108: '.$tax;

		// Shipping from API
    	$wsdl = "https://ifs.graphikservices.com/services/shippingService?wsdl";

    	$options = array(
    		// "userAccess"=>"79FE7017D6ACDEF082F845C766968E0A36DE84953739018C",
    		"userAccess"=>"0FC64D717788C2310626F5D6A199EA54754DB71051E9D578",
    		"externalOrder"=>array(
    			"costData"=> array(
    				//"discountAmount" => $coupon_price,
    				//"feeCost" => $tax,
    				"merchCost" => $total,
    				"oversizedShipFeeTotal" => 0,
    				"promoAmount" => 0,
    				"retailCost" => 0,
    				"shippingCost" => 0,
    				"taxCost" => 0,
    				"totalCost" => $grand_total
    			),
    			"customer"=>array(
    				"shippingAddress"=>array(
    					"activeInd" => 1,
    					"addressType" => "SHIPPING",
    					"city"=>$shipping_city,
    					"company"=>"",
    					"country"=>$shipping_country,
    					"firstName"=>$shipping_firstname,
    					"homePhone"=>$shipping_phone,
    					"lastName"=>$shipping_lastname,
    					"prefix"=>"",
    					"state"=>$shipping_state,
    					"street"=>$shipping_address,
    					"streetTwo"=>$shipping_address1,
    					"zip"=>$shipping_zip
    				),
    				"vendorID"=>1233444
    			),
    			"externalOrderId"=>"",
    			"insuranceFee"=>0.00,
    			"shippingData"=>array(
    				"discountAmount"=>0.00,
    				"shippingService"=>"STANDARD"
    			)
    		)
    	);

    	//dd($options);

		$graphikAPI = new SoapClient($wsdl, $options);
		$response = $graphikAPI->__soapCall("getShippingAmoutsByMerchPrice", array($options));
		// dd($response);
		// print_r($response);die();
		// if (is_soap_fault($response)) {
		if (empty($response)) {
			return false;
			// die('Ln212');
		}

		// $shipping_options = $response;
		// dd($response);

		$sample_html = $checked = '';
		foreach ($response->shippingData->shippingCostDatas as $shipping) {

	        if ($shipping->methodCode=='STANDARD') {
	            $checked = 'checked="checked"';
	            $defaultShippingAmount = $shipping->price;
	            $defaultShippingCode = $shipping->methodCode;
	        } else {
	            $checked = '';
	        }

			$sample_html .= '<input type="radio" name="shipping_option" class="shipping-option" value="'.$shipping->price.'" data-code="'.$shipping->methodName.'" '.$checked.'> &nbsp; 
                            <span>'.$shipping->methodName.'<strong>
                                <br>'.$shipping->methodCode.'/'.$defaultShippingAmount.'
                                <br>$ '.number_format($shipping->price,2).'</strong></span><br>';

		}

		// $sample_html = '<input type="radio" name="shipping_option" class="shipping-option" value="1.00" data-code="SMP"> &nbsp; 
  //                                       <span>Sample Rate<strong>
  //                                           <br>SMP/1.00
  //                                           <br>$ 1.00</strong></span><br>';

		// return $sample_html;
		return json_encode($response);
		// die("Ln129");
	}


}
