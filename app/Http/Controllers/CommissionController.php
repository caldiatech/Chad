<?php
namespace App\Http\Controllers;



use App\Models\Cart;
use App\Models\Client;
use App\Models\ManagerCommission;
use App\Models\ShopOwnerCommission;
use App\Models\Settings;

// use App\Models\Shipping;
// use App\Models\State;
// use App\Models\ProductOptions;
// use App\Models\Google;
// use App\Models\TempCart;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;
use DB;

class CommissionController extends Controller
{

	public function getIndex()
	{
		//if not login redirect to login page    	
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		

		// SELECT fldShopOwnerCommissionShopOwnerID AS ID, fldShopOwnerCommissionOrderCode AS orderCode, fldShopOwnerFirstname as firstName, fldShopOwnerLastname as lastName, fldShopOwnerEmail as email, fldShopOwnerCity as city, fldShopOwnerState as state, sum(fldShopOwnerCommissionAmount) as totalCommission
		// FROM tblShopOwnerCommission
		// LEFT JOIN tblShopOwner ON fldShopOwnerID = fldShopOwnerCommissionShopOwnerID
		// WHERE fldShopOwnerFirstname LIKE '%er%'
		// GROUP BY fldShopOwnerID

		// UNION 

		// SELECT fldManagerCommissionManagerID AS ID, fldManagerCommissionOrderCode AS orderCode, fldManagerFirstname AS firstName, 	fldManagerLastname as lastName, fldManagerEmail as email, fldManagerCity as city, fldManagerState as state, sum(fldManagerCommissionAmount) as totalCommission
		// FROM tblManagerCommission
		// LEFT JOIN tblManager ON fldManagerID = fldManagerCommissionManagerID
		// WHERE fldManagerFirstname LIKE '%er%'
		// GROUP BY fldManagerID

		$commission_shop 	= ShopOwnerCommission::leftJoin('tblShopOwner','tblShopOwner.fldShopOwnerID','=','tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID')
							->groupBy('tblShopOwner.fldShopOwnerID')
							->select(DB::raw('tblShopOwner.fldShopOwnerID AS ID, tblShopOwnerCommission.fldShopOwnerCommissionOrderCode AS orderCode, "shop" AS type, tblShopOwner.fldShopOwnerFirstname AS firstName, tblShopOwner.fldShopOwnerLastname AS lastName, tblShopOwner.fldShopOwnerEmail AS email, tblShopOwner.fldShopOwnerCity AS city, tblShopOwner.fldShopOwnerState AS state, sum(tblShopOwnerCommission.fldShopOwnerCommissionAmount) AS totalCommission'));

		// Combine with Manager Commission
		$commissions 		= ManagerCommission::leftJoin('tblManager','tblManager.fldManagerID','=','tblManagerCommission.fldManagerCommissionManagerID')
							->groupBy('tblManager.fldManagerID')
							->select(DB::raw('tblManager.fldManagerID AS ID, tblManagerCommission.fldManagerCommissionOrderCode AS orderCode, "manager" AS type, tblManager.fldManagerFirstname AS firstName, tblManager.fldManagerLastname as lastName, tblManager.fldManagerEmail as email, tblManager.fldManagerCity as city, tblManager.fldManagerState as state, sum(tblManagerCommission.fldManagerCommissionAmount) as totalCommission'))
							->union($commission_shop)
							->get();

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();				
		$orderClass = 'class=active'; 
		$pageTitle = COMMISSIONS;

		return View::make('_admin.commissions.commission_overview', compact('administrator','orderClass','pageTitle','commissions') );

		/*
		// Get all Shop Owners
		// Get all Transactions under that Shop Owner

		$commission_shop 	= ShopOwnerCommission::leftJoin('tblShopOwner','tblShopOwner.fldShopOwnerID','=','tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID')
							->leftJoin('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
							->groupBy('tblShopOwner.fldShopOwnerID')
							->select(DB::raw('sum(tblShopOwnerCommission.fldShopOwnerCommissionAmount) as total_commission, tblShopOwnerCommission.fldShopOwnerCommissionID, tblShopOwner.fldShopOwnerID, tblShopOwner.fldShopOwnerEmail, tblShopOwner.fldShopOwnerCity, tblShopOwner.fldShopOwnerState, tblShopOwner.fldShopOwnerFirstname, tblShopOwner.fldShopOwnerLastname'))
							->get();

		foreach ($commission_shop as $shop) {
			$commission = ShopOwnerCommission::leftJoin('tblClient','tblClient.fldClientID','=','tblShopOwnerCommission.fldShopOwnerCommissionUserID')
												->where('fldShopOwnerCommissionShopOwnerID','=',$shop->fldShopOwnerID)->get();
			$shop->transactions = $commission;
			// print_r($commission);
			// echo '<br> ------- <br>';
		}
		// print_r($commission_shop);

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();				
		$orderClass = 'class=active'; 
		$pageTitle = COMMISSIONS;

		return View::make('_admin.commissions.commission_overview', compact('administrator','orderClass','pageTitle','commission_shop') );
		*/

	}


	public function searchOverview() {

		//if not login redirect to login page    	
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		// DB::enableQueryLog();

		$search_name 		= trim(Input::get('search_name'));
		$search_city 		= trim(Input::get('search_city'));
		$search_state 		= trim(Input::get('search_state'));
		$search_date_from 	= trim(Input::get('search_date_from'));
		$search_date_to 	= trim(Input::get('search_date_to'));


		$commission_shop = ShopOwnerCommission::leftJoin('tblShopOwner','tblShopOwner.fldShopOwnerID','=','tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID')
						->groupBy('tblShopOwner.fldShopOwnerID');

		if (!empty($search_city)) {
			$commission_shop->where('tblShopOwner.fldShopOwnerCity','like','%'.$search_city.'%')->where('tblShopOwner.fldShopOwnerCity','<>','');
		}
		if (!empty($search_state)) {
			$commission_shop->where('tblShopOwner.fldShopOwnerState','like','%'.$search_state.'%');
		}
		if (!empty($search_name)) {
			$commission_shop->where('tblShopOwner.fldShopOwnerFirstname','like','%'.$search_name.'%')->orWhere('tblShopOwner.fldShopOwnerLastname','like','%'.$search_name.'%');
		}
		if (!empty($search_date_from) && !empty($search_date_to)) {
			$commission_shop->where('tblShopOwnerCommission.fldShopOwnerCommissionDate','>=',$search_date_from)->where('tblShopOwnerCommission.fldShopOwnerCommissionDate','<=',$search_date_to);
		}

		$commission_shop->select(DB::raw('tblShopOwner.fldShopOwnerID AS ID, tblShopOwnerCommission.fldShopOwnerCommissionOrderCode AS orderCode, "shop" AS type, tblShopOwner.fldShopOwnerFirstname AS firstName, tblShopOwner.fldShopOwnerLastname AS lastName, tblShopOwner.fldShopOwnerEmail AS email, tblShopOwner.fldShopOwnerCity AS city, tblShopOwner.fldShopOwnerState AS state, sum(tblShopOwnerCommission.fldShopOwnerCommissionAmount) AS totalCommission'));

		// Combine with Manager Commission
		$commissions = ManagerCommission::leftJoin('tblManager','tblManager.fldManagerID','=','tblManagerCommission.fldManagerCommissionManagerID')
					->groupBy('tblManager.fldManagerID');

		if (!empty($search_city)) {
			$commissions->where('tblManager.fldManagerCity','like','%'.$search_city.'%');
		}
		if (!empty($search_state)) {
			$commissions->where('tblManager.fldManagerState','like','%'.$search_state.'%');
		}
		if (!empty($search_name)) {
			$commissions->where('tblManager.fldManagerFirstname','like','%'.$search_name.'%')->orWhere('tblManager.fldManagerLastname','like','%'.$search_name.'%');
		}
		if (!empty($search_date_from) && !empty($search_date_to)) {
			$commissions->where('tblManagerCommission.fldManagerCommissionDate','>=',$search_date_from)->where('tblManagerCommission.fldManagerCommissionDate','<=',$search_date_to);
		}

		$commissions = $commissions->select(DB::raw('tblManager.fldManagerID AS ID, tblManagerCommission.fldManagerCommissionOrderCode AS orderCode, "manager" AS type, tblManager.fldManagerFirstname AS firstName, tblManager.fldManagerLastname as lastName, tblManager.fldManagerEmail as email, tblManager.fldManagerCity as city, tblManager.fldManagerState as state, sum(tblManagerCommission.fldManagerCommissionAmount) as totalCommission'))
		->union($commission_shop)
		->get();


		if (!empty($search_date_from) && !empty($search_date_to)) {
			$datefromstr = strtotime($search_date_from);
			$datetostr = strtotime($search_date_to);
		}else{
			$datefromstr ='';
			$datetostr = '';
		}

		// dd(DB::getQueryLog());

		// print_r($commissions);
		// die();


		/*
		// Get all Shop Owners with Search Criteria
		// Get all Transactions under that Shop Owner

		$commission_shop = ShopOwnerCommission::leftJoin('tblShopOwner','tblShopOwner.fldShopOwnerID','=','tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID')
												->leftJoin('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
												->groupBy('tblShopOwner.fldShopOwnerID');

		if (!empty($search_name)) {
			$commission_shop->where('tblShopOwner.fldShopOwnerFirstname','like','%'.$search_name.'%')->orWhere('tblShopOwner.fldShopOwnerLastname','like','%'.$search_name.'%');
		}
		if (!empty($search_city)) {
			$commission_shop->where('tblShopOwner.fldShopOwnerCity','like','%'.$search_city.'%');
		}
		if (!empty($search_state)) {
			// echo '<br> state: '.$search_state.'------- <br>';
			$commission_shop->where('tblShopOwner.fldShopOwnerState','like','%'.$search_state.'%');
		}

		if (!empty($search_date_from) && !empty($search_date_to)) {
			// echo '<br> from: '.$search_date_from.' - '.$search_date_to.'------ <br>';
			$commission_shop->where('tblShopOwnerCommission.fldShopOwnerCommissionDate','>=',$search_date_from)->where('tblShopOwnerCommission.fldShopOwnerCommissionDate','<=',$search_date_to);
			// $commission_shop->where('tblShopOwnerCommission.fldShopOwnerCommissionDate','>=',$search_date_from);
		}

		$commission_shop = $commission_shop->select(DB::raw('sum(tblShopOwnerCommission.fldShopOwnerCommissionAmount) as total_commission, tblShopOwnerCommission.fldShopOwnerCommissionID, tblShopOwner.fldShopOwnerID, tblShopOwner.fldShopOwnerEmail, tblShopOwner.fldShopOwnerCity, tblShopOwner.fldShopOwnerState, tblShopOwner.fldShopOwnerFirstname, tblShopOwner.fldShopOwnerLastname'))->get();

		foreach ($commission_shop as $shop) {
			// echo '<br> commission ID: '.$shop->fldShopOwnerCommissionID.' << <br>';
			$commission = ShopOwnerCommission::leftJoin('tblClient','tblClient.fldClientID','=','tblShopOwnerCommission.fldShopOwnerCommissionUserID')
												->where('fldShopOwnerCommissionShopOwnerID','=',$shop->fldShopOwnerID);
			if (!empty($search_date_from) && !empty($search_date_to)) {
				$commission->where('fldShopOwnerCommissionDate','>=',$search_date_from)->where('fldShopOwnerCommissionDate','<=',$search_date_to);
				$shop->datefromstr = strtotime($search_date_from);
				$shop->datetostr = strtotime($search_date_to);
			}

			$commission = $commission->get();

			$shop->transactions = $commission;
		}
		*/

		if (null !==Input::get('submit_export')) { // Export

			$unique = date('Ymd').'-'.str_random(4);
			$filename = "commission-".$unique.".xls"; // File Name

			header('Content-type: application/excel');
			header('Content-Disposition: attachment; filename='.$filename);

			$data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
			<head>
			    <!--[if gte mso 9]>
			    <xml>
			        <x:ExcelWorkbook>
			            <x:ExcelWorksheets>
			                <x:ExcelWorksheet>
			                    <x:Name>Sheet 1</x:Name>
			                    <x:WorksheetOptions>
			                        <x:Print>
			                            <x:ValidPrinterInfo/>
			                        </x:Print>
			                    </x:WorksheetOptions>
			                </x:ExcelWorksheet>
			            </x:ExcelWorksheets>
			        </x:ExcelWorkbook>
			    </xml>
			    <![endif]-->
			</head>

			<body>';
			$data .= '<table><tr><td>ID</td><td>First Name</td><td>Last Name</td><td>Email Address</td><td>Type</td><td>City</td><td>State</td><td>Commission ($)</td></tr></table>';

			foreach ($commissions as $commission) {
			   $data .= '<table><tr><td>'.$commission->ID.'</td><td>'.ucwords($commission->firstName).'</td><td>'.ucwords($commission->lastName).'</td><td>'.$commission->email.'</td><td>'.ucwords($commission->type).'</td><td>'.ucwords($commission->city).'</td><td>'.ucwords($commission->state).'</td><td>'.$commission->totalCommission.'</td></tr></table>';
			}

			$data .= '</body></html>';

			echo $data;
		}

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();				
		$orderClass = 'class=active'; 
		$pageTitle = COMMISSIONS;

		return View::make('_admin.commissions.commission_overview', compact('administrator','orderClass','pageTitle','commissions', 'datefromstr', 'datetostr') );
		// return View::make('_admin.commissions.commission_overview', compact('administrator','orderClass','pageTitle','commission_shop') );
	}


	public function getDisplay($type, $id) {
	// public function getDisplay($order_code) {
		//echo $type.'<br>';
		// die('getDisplay');
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		if ($type=='manager') {
			$commissions = ManagerCommission::leftJoin('tblManager','fldManagerID','=','fldManagerCommissionManagerID')
						->leftJoin('tblClient','fldClientID','=','fldManagerCommissionUserID')
						->where('fldManagerCommissionManagerID','=',$id)
						->select(DB::raw('fldManagerCommissionOrderCode AS orderCode, fldClientID, fldClientFirstname, fldClientLastname, fldClientEmail, fldClientContact, fldClientCity, fldClientState, fldManagerCommissionAmount AS commissionAmount, fldManagerCommissionDate AS commissionDate'))
						->get();
		} elseif ($type=='shop') {
			$commissions = ShopOwnerCommission::leftJoin('tblShopOwner','fldShopOwnerID','=','fldShopOwnerCommissionShopOwnerID')
						->leftJoin('tblClient','fldClientID','=','fldShopOwnerCommissionUserID')
						->where('fldShopOwnerCommissionShopOwnerID','=',$id)
						->select(DB::raw('fldShopOwnerCommissionOrderCode AS orderCode, fldClientID, fldClientFirstname, fldClientLastname, fldClientEmail, fldClientContact, fldClientCity, fldClientState, fldShopOwnerCommissionAmount AS commissionAmount, fldShopOwnerCommissionDate AS commissionDate'))
						->get();
		}

		// $commission_shop 	= ShopOwnerCommission::leftJoin('tblShopOwner','tblShopOwner.fldShopOwnerID','=','tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID')
		// 					->leftJoin('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
		// 					->where('tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID','=',$shopowner_id)
		// 					->get();

		// print_r($commissions);
		// die();


		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();		
		$orderClass = 'class=active'; 
		$pageTitle = COMMISSIONS;

		// return View::make('_admin.commissions.commission_details', compact('administrator','orderClass','pageTitle','commission_shop'));
		return View::make('_admin.commissions.commission_details', compact('administrator','orderClass','pageTitle','commissions'));
	}
	

	public function displayTransactionByDates($type, $id, $datefrom, $dateto) {

		// echo 'dates: '.$datefrom.' to '.$dateto.'<br>';

		$date_from 	= date('Y-m-d', $datefrom);
		$date_to 	= date('Y-m-d', $dateto);

		if ($type=='manager') {

			$commissions = ManagerCommission::leftJoin('tblManager','fldManagerID','=','fldManagerCommissionManagerID')
						->leftJoin('tblClient','fldClientID','=','fldManagerCommissionUserID')
						->where('fldManagerCommissionManagerID','=',$id);

				if (isset($datefrom)) {
					$commissions->where('fldManagerCommissionDate','>=',$date_from);
				}
				if (isset($dateto)) {
					$commissions->where('fldManagerCommissionDate','<=',$date_to);
				}

				$commissions->select(DB::raw('fldManagerCommissionOrderCode AS orderCode, fldClientID, fldClientFirstname, fldClientLastname, fldClientEmail, fldClientContact, fldClientCity, fldClientState, fldManagerCommissionAmount AS commissionAmount, fldManagerCommissionDate AS commissionDate'));

				$commissions = $commissions->get();

		} elseif ($type=='shop') {

			$commissions = ShopOwnerCommission::leftJoin('tblShopOwner','fldShopOwnerID','=','fldShopOwnerCommissionShopOwnerID')
						->leftJoin('tblClient','fldClientID','=','fldShopOwnerCommissionUserID')
						->where('fldShopOwnerCommissionShopOwnerID','=',$id);

				if (isset($datefrom)) {
					$commissions->where('fldShopOwnerCommissionDate','>=',$date_from);
				}
				if (isset($dateto)) {
					$commissions->where('fldShopOwnerCommissionDate','<=',$date_to);
				}

				$commissions->select(DB::raw('fldShopOwnerCommissionOrderCode AS orderCode, fldClientID, fldClientFirstname, fldClientLastname, fldClientEmail, fldClientContact, fldClientCity, fldClientState, fldShopOwnerCommissionAmount AS commissionAmount, fldShopOwnerCommissionDate AS commissionDate'));
				$commissions = $commissions->get();
		}

		/*
		// echo 'dates: '.$date_from.' to '.$date_to.'<br>';
		// die('displayTransactionByDates');

		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

		$commission_shop 	= ShopOwnerCommission::leftJoin('tblShopOwner','tblShopOwner.fldShopOwnerID','=','tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID')
							->leftJoin('tblCart','tblCart.fldCartOrderNo','=','tblShopOwnerCommission.fldShopOwnerCommissionOrderCode')
							->leftJoin('tblClient','tblClient.fldClientID','=','tblShopOwnerCommission.fldShopOwnerCommissionUserID')
							->where('tblShopOwnerCommission.fldShopOwnerCommissionShopOwnerID','=',$shopowner_id);

		if (isset($datefrom)) {
			$commission_shop->where('tblShopOwnerCommission.fldShopOwnerCommissionDate','>=',$date_from);
		}

		if (isset($dateto)) {
			$commission_shop->where('tblShopOwnerCommission.fldShopOwnerCommissionDate','<=',$date_to);
		}
		$commission_shop = $commission_shop->get();
		*/

		// print_r($commissions);
		// die();

		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();		
		$orderClass = 'class=active'; 
		$pageTitle = COMMISSIONS;

		// return View::make('_admin.commissions.commission_details', compact('administrator','orderClass','pageTitle','commission_shop'));
		return View::make('_admin.commissions.commission_details', compact('administrator','orderClass','pageTitle','commissions'));
	}


	/*
	public function getIndex()
	{
		//if not login redirect to login page    	
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$status = "Paid";	
		$cart = Cart::where('fldCartStatus','=',$status)->orderby('fldCartOrderDate','DESC')->select('fldCartOrderNo','fldCartClientID')->distinct()->get();



		$orderData = array();
		foreach($cart as $carts) {
			$cartInfo = Cart::displayCheckout($carts->fldCartOrderNo);
			
			$sum = Cart::leftJoin('tblClient','tblClient.fldClientID','=','fldCartClientID')
						->where('fldCartOrderNo','=',$carts->fldCartOrderNo)
						->select(DB::raw('sum(fldCartProductPrice * fldCartQuantity) as total',"fldCartClientID"))->first();
						
			$total = ($sum->total - $cartInfo->fldCartCouponCodeCouponPrice) + $cartInfo->fldCartShippingRateShippingAmount + $cartInfo->fldCartTax;						
			$name = $cartInfo->bFirstname. ' ' . $cartInfo->bLastname;

			//echo "Client ID " .  $carts->fldCartClientID;
			$client = Client::find($carts->fldCartClientID);
			if(count($client) == 1) {
				$client_type = $client->fldClientCheckoutType != "" ? $client->fldClientCheckoutType : "Client" ;
			} else {
				$client_type = "";
			}
			$orderData[]= array('order_no' => $carts->fldCartOrderNo,'order_date' => $cartInfo->order_date, 'client_name' => $name, 'total'=>$total,'client_type'=>$client_type);			
			
		}
		
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();				
		$orderClass = 'class=active'; 
		$pageTitle = ORDERS;
		return View::make('_admin.orders.orders', array('orderData' => $orderData,
													    'administrator'=>$administrator,
													    'orderClass'=>$orderClass,
													    'pageTitle'=>$pageTitle));	
	}
	
	public function userOrderHistory() {
		$client_id = Session::get('client_id');
		
		$status = "Paid";	
		$cart = Cart::where('fldCartStatus','=',$status)
						->where('fldCartClientID','=',$client_id)
						->orderby('fldCartOrderDate','DESC')
						->select('fldCartOrderNo')->distinct()
						->get();
		$orderData = array();
		foreach($cart as $carts) {
			$cartInfo = Cart::displayCheckout($carts->fldCartOrderNo);
			
			$sum = Cart::leftJoin('tblClient','tblClient.fldClientID','=','tblcart.fldCartClientID')
						->where('fldCartOrderNo','=',$carts->fldCartOrderNo)
						->select(DB::raw('sum(fldCartProductPrice * fldCartQuantity) as total',"fldCartClientID"))
						->first();

			$total = ($sum->total - $cartInfo->coupon_price) + $cartInfo->shipping_amount + $cartInfo->tax;		
							
			$name = $cartInfo->bFirstname. ' ' . $cartInfo->bLastname;
			$orderData[]= array('order_no' => $carts->fldCartOrderNo,'order_date' => $cartInfo->order_date, 'client_name' => $name, 'total'=>$total);			
			
		}
		
		$settings = Settings::first();
		$google = Google::first();	
		$settings->site_name= "Order History";
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$cart_count = TempCart::countCart();
		$pageTitle = ORDERS;
		return View::make('home.user-orders', array('orderData' => $orderData,
												    'settings'=>$settings,
												    'google'=>$google,
												    'cart_count'=>$cart_count,
												    'administrator'=>$administrator,
												    'pageTitle'=>$pageTitle));	
		
	}
	*/

}
