<?php
/***********************DEVELOPER : EMMANUEL MARCILLA**************************/
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Settings;
use App\Models\Shipping;
use App\Models\Cart;
use App\Models\State;
use App\Models\ProductOptions;
use App\Models\Google;
use App\Models\TempCart;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;
use DB;

class CartController extends Controller
{
  public function getIndex()
	{
		//if not login redirect to login page    	
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$status = "Paid";	
		$cart = Cart::where('fldCartStatus','=',$status)->orderby('fldCartOrderDate','DESC')->select('fldCartOrderNo')->distinct()->get();
		$orderData = array();
		foreach($cart as $carts) {
			$cartInfo = Cart::displayCheckout($carts->fldCartOrderNo);
			
			$sum = Cart::leftJoin('tblClient','tblClient.fldClientID','=','fldCartClientID')
						->where('fldCartOrderNo','=',$carts->fldCartOrderNo)
						->select(DB::raw('sum(fldCartProductPrice * fldCartQuantity) as total',"fldCartClientID"))->first();
						
			$total = ($sum->total - $cartInfo->coupon_price) + $cartInfo->shipping_amount + $cartInfo->tax;						
			$name = $cartInfo->bFirstname. ' ' . $cartInfo->bLastname;
			$orderData[]= array('order_no' => $carts->fldCartOrderNo,'order_date' => $cartInfo->order_date, 'client_name' => $name, 'total'=>$total);			
			
		}
		
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();				
		$orderClass = 'class=active'; 
		return View::make('_admin.orders.orders', array('orderData' => $orderData,
													    'administrator'=>$administrator,
													    'orderClass'=>$orderClass));	
	}
	
	public function getDisplay($order_code) {
		//if not login redirect to login page    
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}
		
		$cart = Cart::displayCart($order_code);

		$cartInfo = Cart::displayCheckout($order_code);
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();		
		$orderClass = 'class=active'; 
		return View::make('_admin.orders.orders_display', array('cart' => $cart,
														        'data'=>$cartInfo,
														        'administrator'=>$administrator,
														        'orderClass'=>$orderClass));
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
		return View::make('home.user-orders', array('orderData' => $orderData,
												    'settings'=>$settings,
												    'google'=>$google,
												    'cart_count'=>$cart_count,
												    'administrator'=>$administrator));	
		
	}
}
