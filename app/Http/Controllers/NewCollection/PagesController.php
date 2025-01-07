<?php

namespace App\Http\Controllers\NewCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Contact;
use App\Models\Pages;
use App\Models\Google;
use App\Models\TempCart;
use App\Models\Footer;
use View;

class PagesController extends Controller
{
    public function homePage(Request $request) {
        return view('new_collection.home');
    }

    public function featuredPage(Request $request) {
        return view('new_collection.featured');
    }

    public function collectionPage(Request $request) {
        return view('new_collection.collection');
    }

    public function aboutPage(Request $request) {
        return view('new_collection.about');
    }

    public function privacyPolicyPage(Request $request) {
        return view('new_collection.privacy_policy');
    }

    public function shippingPage(Request $request) {
        return view('new_collection.shipping');
    }

    public function termsUsePage(Request $request) {
        return view('new_collection.terms_of_use');
    }

    public function featuredDetailsPage(Request $request) {
        return view('new_collection.featured_detail');
    }

    public function contactPage(Request $request) {
        return view('new_collection.contact');
    }

    public function loginPage(Request $request) {
        return view('new_collection.login');
    }

    public function registerPage(Request $request) {
        return view('new_collection.register');
    }
    
    // public function aboutPage() {
	// 	$menus = Pages::where('fldPagesMainID', '=', 0)->get();
	// 	$settings = Settings::first();
	// 	$google = Google::first();
	// 	$pages = Pages::where('fldPagesID','=',109)->first();
	// 	$cart_count = TempCart::countCart();
	// 	$footer = Footer::first();
    //     // dd($footer);
   	// 	return View::make('home.new-about')->with(array('menus'=>$menus,
   	// 													 'settings'=>$settings,
   	// 													 'google'=>$google,
   	// 													 'pages'=>$pages,
   	// 													 'footer'=>$footer,
   	// 													 'cart_count'=>$cart_count));

	// }
}
