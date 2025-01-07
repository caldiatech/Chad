<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/home", "NewCollection\PagesController@homePage")->name('homePage');
Route::get("/featured", "NewCollection\PagesController@featuredPage")->name('featuredPage');
Route::get("/new-collection", "NewCollection\PagesController@collectionPage")->name('newCollectionPage');
Route::get("/new-about", "NewCollection\PagesController@aboutPage")->name('newAboutPage');
Route::get("/new-privacy-policy", "NewCollection\PagesController@privacyPolicyPage")->name('privacyPolicyPage');
Route::get("/new-shipping", "NewCollection\PagesController@shippingPage")->name('newShippingPage');
Route::get("/terms-of-use", "NewCollection\PagesController@termsUsePage")->name('termsUsePage');
Route::get("/featured-details", "NewCollection\PagesController@featuredDetailsPage")->name('featuredDetailsPage');
Route::get("/contact", "NewCollection\PagesController@contactPage")->name('contactPage');
Route::get("/new-login", "NewCollection\PagesController@loginPage")->name('newLoginPage');
Route::get("/register", "NewCollection\PagesController@registerPage")->name('registerPage');

Route::group(array('prefix' => '/dnradmin'), function()
{

    Route::get("/dashboard", "SettingsController@dashboard");

    Route::get("/unedited-text-create", "SettingsController@uneditedTextCreate");
    Route::post("/unedited-text-addedit", "SettingsController@uneditedTextAdd");

 	Route::get('/sub-category/{category}/{product_id}', 'CategoryController@displaySubCategory');
 	Route::get('/', 'SettingsController@displayLogin');
 	Route::post('/', 'SettingsController@login');
 	Route::get('/settings', 'SettingsController@getNew');
    Route::get('/settings/edit/{id}', 'SettingsController@getEdit');
    Route::post('/settings/edit/{id}', 'SettingsController@postEdit');
 	Route::get('/pages/remove_image/{id}','PagesController@removeImage');

    Route::get('/pages', 'PagesController@getIndex');
    Route::get('/pages/new', 'PagesController@getNew');
    Route::post('/pages/new', 'PagesController@postNew');
    Route::get('/pages/edit/{id}', 'PagesController@getEdit');
    Route::post('/pages/edit/{id}', 'PagesController@postEdit');
    Route::get('/pages/delete/{id}', 'PagesController@getDelete');
    Route::get('/pages/view/{id}', 'PagesController@getView');

    Route::get('/homeslides', 'HomeSlideController@getIndex');
    Route::get('/homeslides/new', 'HomeSlideController@getNew');
    Route::post('/homeslides/new', 'HomeSlideController@postNew');
    Route::get('/homeslides/edit/{id}', 'HomeSlideController@getEdit');
    Route::post('/homeslides/edit/{id}', 'HomeSlideController@postEdit');
    Route::get('/homeslides/delete/{id}', 'HomeSlideController@getDelete');


    Route::get('/contact', 'ContactController@getIndex');
    Route::get('/contact/new', 'ContactController@getNew');
    Route::post('/contact/new', 'ContactController@postNew');
    Route::get('/contact/edit/{id}', 'ContactController@getEdit');
    Route::post('/contact/edit/{id}', 'ContactController@postEdit');
    Route::get('/contact/delete/{id}', 'ContactController@getDelete');



    Route::get('/manager', 'ManagerController@getIndex');
    Route::get('/manager/new', 'ManagerController@getNew');
    Route::post('/manager/new', 'ManagerController@postNew');
    Route::get('/manager/edit/{id}', 'ManagerController@getEdit');
    Route::post('/manager/edit/{id}', 'ManagerController@postEdit');
    Route::get('/manager/delete/{id}', 'ManagerController@getDelete');


    Route::get('/shop-owner', 'ShopOwnerController@getIndex');
    Route::get('/shop-owner/new', 'ShopOwnerController@getNew');
    Route::post('/shop-owner/new', 'ShopOwnerController@postNew');
    Route::get('/shop-owner/edit/{id}', 'ShopOwnerController@getEdit');
    Route::post('/shop-owner/edit/{id}', 'ShopOwnerController@postEdit');
    Route::get('/shop-owner/delete/{id}', 'ShopOwnerController@getDelete');


    Route::get('/client', 'ClientController@getIndex');
    Route::get('/client/new', 'ClientController@getNew');
    Route::post('/client/new', 'ClientController@postNew');
    Route::get('/client/edit/{id}', 'ClientController@getEdit');
    Route::post('/client/edit/{id}', 'ClientController@postEdit');
    Route::get('/client/delete/{id}', 'ClientController@getDelete');

    Route::get('/products', 'ProductController@getIndex');
    Route::post('/products/addProduct', 'ProductController@postNew');
    Route::get('/products/new/{id}', 'ProductController@getNew');
    
    Route::get('/products/edit/{id}', 'ProductController@getEdit');
    Route::post('/products/edit/{id}', 'ProductController@postEdit');
    Route::get('/products/delete/{id}/{category_id}', 'ProductController@getDelete');
    Route::get('/products/view/{id}', 'ProductController@getView');

    Route::get('/category', 'CategoryController@getIndex');
    Route::get('/category/new/{id}/{backid}/', 'CategoryController@getNew');
    Route::post('/category/new/{id}/{backid}/', 'CategoryController@postNew');
    Route::get('/category/edit/{id}', 'CategoryController@getEdit');
    Route::post('/category/edit/{id}', 'CategoryController@postEdit');
    Route::get('/category/delete/{id}', 'CategoryController@getDelete');
    Route::get('/category/view/{id}', 'CategoryController@getView');
    Route::get('/category/display/{category_id}/{product_id?}', 'CategoryController@displaySubCategory');
    Route::get('/category/delete/{id}/0/add', 'CategoryController@getDelete');


    Route::get('/coupon_code', 'CouponCodeController@getIndex');
    Route::get('/coupon_code/new', 'CouponCodeController@getNew');
    Route::post('/coupon_code/new', 'CouponCodeController@postNew');
    Route::get('/coupon_code/edit/{id}', 'CouponCodeController@getEdit');
    Route::post('/coupon_code/edit/{id}', 'CouponCodeController@postEdit');
    Route::get('/coupon_code/delete/{id}', 'CouponCodeController@getDelete');


    Route::get('/state', 'StateController@getIndex');
    Route::get('/state/new', 'StateController@getNew');
    Route::post('/state/new', 'StateController@postNew');
    Route::get('/state/edit/{id}', 'StateController@getEdit');
    Route::post('/state/edit/{id}', 'StateController@postEdit');
    Route::get('/state/delete/{id}', 'StateController@getDelete');


    Route::get('/manager/sales/{id}','ManagerController@getSales');
	Route::controller('/manager', 'ManagerController');
	Route::get('/manager/sales-rep/{id}','SalesRepController@getSales');
	Route::controller('/sales-rep', 'SalesRepController');
	Route::get('/shop-owner/sales/{id}','ShopOwnerController@getSales');
    Route::controller('/shop-owner', 'ShopOwnerController');
 	Route::controller('/client', 'ClientController');


    Route::get('/orders', 'CartController@getIndex');
    Route::get('/orders/new', 'CartController@getNew');
    Route::post('/orders/new', 'CartController@postNew');
    Route::get('/orders/edit/{id}', 'CartController@getEdit');
    Route::post('/orders/edit/{id}', 'CartController@postEdit');
    Route::get('/orders/delete/{id}', 'CartController@getDelete');
    Route::get('/orders/display/{order_code}', 'CartController@getDisplay');
    
    //upload images
    Route::get('/uploadImage', 'UploadImageController@index');
    Route::get('/add/CustomImage', 'UploadImageController@create');
    Route::post('/add/CustomImage/store', 'UploadImageController@store');
    Route::get('/CustomImage/edit/{id}', 'UploadImageController@edit');
    Route::post('/CustomImage/update/{id}', 'UploadImageController@update');
    Route::get('/CustomImage/delete/{id}', 'UploadImageController@destroy');




    Route::get('/commissions', 'CommissionController@getIndex');
    Route::get('/commissions/new', 'CommissionController@getNew');
    Route::post('/commissions/new', 'CommissionController@postNew');
    Route::get('/commissions/edit/{id}', 'CommissionController@getEdit');
    Route::post('/commissions/edit/{id}', 'CommissionController@postEdit');
    Route::get('/commissions/delete/{id}', 'CommissionController@getDelete');
    Route::get('/commissions/display/{manager}/{id}', 'CommissionController@getDisplay');
    Route::get('/commissions/display/{shop}/{id}', 'CommissionController@getDisplay');



    Route::controller('/slider', 'SliderController');
 	Route::controller('/photos', 'PhotoGalleryController');
 	Route::controller('/staff', 'StaffController');
 	Route::controller('/coupon_code', 'CouponCodeController');
 	Route::controller('/category', 'CategoryController');
 	Route::controller('/products', 'ProductController');
 	Route::controller('/product_options', 'OptionsController');
    Route::get('/product_options/display/{category}/{id?}', 'OptionsController@getDisplay');
    Route::get('/product_options/edit/{id?}', 'OptionsController@getEdit');
    Route::post('/product_options/edit/{id?}', 'OptionsController@postEdit');
    Route::get('/product_options/delete/{id?}', 'OptionsController@getDelete');

    Route::controller('/product_options_assets', 'OptionsAssetsController');
    Route::get('/product_options_assets/display/{category}/{id?}', 'OptionsAssetsController@getDisplay');
    Route::get('/product_options_assets/new/{error}/{option_id}/{product_id?}', 'OptionsAssetsController@getNew');
    Route::get('/product_options_assets/edit/{id}/{option_id}/{product_id?}', 'OptionsAssetsController@getEdit');
    Route::post('/product_options_assets/new', 'OptionsAssetsController@postNew');
    Route::post('/product_options_assets/edit/{id}', 'OptionsAssetsController@postEdit');
    Route::get('/product_options_assets/delete/{id}/{product_id?}', 'OptionsAssetsController@getDelete');

    Route::get('/dnradmin/news-category', 'NewsCategoryController@displayCategory');
    Route::controller('/news', 'NewsController');
    Route::controller('/news-category', 'NewsCategoryController');
    Route::controller('/payment', 'PaymentController');
    Route::controller('/authorize', 'AuthorizeController');
    Route::controller('/paypal', 'PaypalController');
 //   Max 12/01: 3. Remove Shipping moduel from admin
    // Route::controller('/shipping', 'ShippingController');
    // Route::controller('/shipping_ups', 'UPSController');
    // Route::controller('/shipping_fedex', 'FedexController');
    // Route::controller('/shipping_usps', 'USPSController');

 	 Route::controller('/orders', 'CartController');

    Route::get('/commissions/details/{type}/{id}/{datefrom}-{dateto}', 'CommissionController@displayTransactionByDates');
    Route::controller('/commissions', 'CommissionController');
    Route::post('/commissions', 'CommissionController@searchOverview');

    Route::controller('/state', 'StateController');
    Route::get('/logout', 'SettingsController@logout');
    Route::get('/not-found', 'PagesController@notFound');
    Route::get('/graphik/display_all/{type}', 'GraphikDimensionController@displayAll');

     Route::post('/edit_print', 'ProductController@editPrint');


   /* Added By Don Pablo */
    Route::get('/product_show_prints', 'ProductController@get_prints');
    Route::post('/product_show_prints/add_size_list', 'ProductController@add_size_list')->name('add_size_list');
    Route::post('/product_show_prints/edit_size_list', 'ProductController@edit_size_list')->name('edit_size_list');
    Route::post('/product_show_prints/delete_size_list', 'ProductController@delete_size_list')->name('delete_size_list');

 });


Route::group(array('prefix' => '/dashboard/customer'), function() {
     Route::get('/', 'ClientController@dashboard');
     Route::get('/edit-profile', 'ClientController@profileEdit');
     Route::post('/edit-profile', 'ClientController@profileUpdate');
     Route::get('/profile', 'ClientController@profile');
     Route::get('/settings', 'ClientController@settings');
     Route::post('/settings', 'ClientController@settingsUpdate');
     Route::get('/order-history', 'ClientController@orderHistory');
     Route::get('/order-history/details/{orderNo}', 'ClientController@OrderHistoryDetails');
     Route::get('/orderInfo/{order_no}', 'ClientController@orderDetails');
     Route::get('/logout', 'ClientController@logout');
 });

 Route::group(array('prefix' => '/dashboard/sales'), function() {
     Route::get('/', 'ManagerController@dashboard');
     Route::get('/profile', 'ManagerController@profile');
     Route::get('/edit-profile', 'ManagerController@profileEdit');
     Route::post('/edit-profile', 'ManagerController@updateProfile');
     Route::get('/logout', 'ManagerController@logout');
     Route::get('/accounts', 'ManagerController@accounts');
     Route::post('/accounts', 'ManagerController@updateAccounts');
     Route::get('/settings', 'ManagerController@settings');
     Route::post('/settings', 'ManagerController@settingsUpdate');
     Route::get('/coupon-codes', 'ManagerController@couponCodes');
     Route::get('/sales-activities', 'ManagerController@salesActivities');
     Route::get('/order-history', 'ManagerController@orderHistory');
     Route::get('/orderInfo/{order_no}', 'ManagerController@orderDetails');
     Route::get('/settings', 'ManagerController@settings');
     Route::post('/settings', 'ManagerController@settingsUpdate');
     Route::get('/sales-rep/new', 'ManagerController@salesRepNew');
     Route::post('/sales-rep/new', 'ManagerController@salesRepSave');
     Route::get('/sales-rep/edit/{id}', 'ManagerController@salesRepEdit');
     Route::post('/sales-rep/edit/{id}', 'ManagerController@salesRepUpdate');
     Route::get('/sales-rep/delete/{id}', 'ManagerController@salesRepDelete');
     Route::get('/sales-rep', 'ManagerController@salesRep');

 });

Route::group(array('prefix' => '/dashboard/shop-owner'), function() {
    Route::get('/', 'ShopOwnerController@dashboard');
    Route::get('/edit-profile', 'ShopOwnerController@profileEdit');
    Route::post('/edit-profile', 'ShopOwnerController@updateProfile');
    Route::get('/profile', 'ShopOwnerController@profile');
    Route::get('/order-history', 'ShopOwnerController@orderHistory');
    Route::get('/orderInfo/{order_no}', 'ShopOwnerController@orderDetails');
    Route::get('/settings', 'ShopOwnerController@settings');
    Route::post('/settings', 'ShopOwnerController@settingsUpdate');
    Route::get('/logout', 'ShopOwnerController@logout');
 });


Route::group(array('prefix' => '/'), function() {
    Route::post('/graphik/package-amount', 'GraphikDimensionController@getPackagePricing');
    Route::get('/graphik/package-amount', 'GraphikDimensionController@getPackagePricing');

    // Route::get('/graphik/display_shipping', 'GraphikDimensionController@getShipping');
    // Route::get('/graphik/display_shipping2', 'GraphikDimensionController@getShipping2'); // removed optional params

    Route::get('/', 'PagesController@home');
    // Route::get('/faq', 'PagesController@FAQ');
    Route::post('/faq', 'PagesController@FAQContact');

    Route::post('/banner/upload-banner/{id}', 'PagesController@uploadBanner');
    Route::get('/preview/{slug}', 'PagesPreviewController@pageDisplay');
    Route::get('/news', 'NewsController@newsDisplay');
    Route::get('/news/category/{slug}', 'NewsController@newsDisplayCategory');
    Route::get('/news/{slug}', 'NewsController@newsFind');
   /* Route::get('/image-galleries', 'PhotoGalleryController@gallery');
    Route::get('/images-gallery/details/{slug}', 'PhotoGalleryController@details');
    Route::get('/products/display/{slug}', 'ProductController@display'); */

    Route::get('/connect', 'ContactController@contact');
    Route::post('/connect', 'ContactController@contactSave');

    // Route::get('/contact-us', 'ContactController@contact');
    // Route::post('/contact-us', 'ContactController@contactSave');
    Route::get('/thankyou/{slug}', 'PagesController@thankyouContact');
    Route::get('/staff-gallery', 'StaffController@gallery');

    /*Route::get('/image-galleries', 'ProductController@displayAll');*/
    /*Route::get('/image-galleries', 'ProductController@displayAll');
    Route::post('/image-galleries', 'ProductController@searchProduct');
    Route::get('/image-galleries/{page}', 'ProductController@displayAll');*/

   /* Route::get('/images', 'ProductController@displayAll');*/
    Route::get('/collection/{slug}', 'ProductController@displayPerCategory'); // Added 12/05
    Route::post('/collection/{slug}', 'ProductController@displayPerCategory'); // Added 12/05
    Route::get('/collection', 'ProductController@displayAll');
    Route::post('/collection', 'ProductController@searchProduct')->name('searchProduct');

    Route::get('/shipping-page', 'ProductController@getShippingIndex');

    Route::get('/featured-images', 'ProductController@featuredImages');
    Route::get('/unedited-digital-files', 'ProductController@uneditedDigitalFiles');
    Route::get('/credit/details/{id}', 'ProductController@creditDetails');

    Route::get('/products/test-price', 'ProductController@displayFramePricing');

    Route::get('/image-galleries/{slug}', 'ProductController@displayAll');
    /*Route::get('/image-galleries/{slug}', 'ProductController@displayAll');*/
    Route::get('/products/details/{slug}', 'ProductController@details');
    Route::get('/product/{slug}', 'ProductController@get_details');
    Route::get('/product-api/{slug}', 'ProductController@getProductAPI');
    Route::post('/product-api/{slug}', 'ProductController@getProductAPI');

    //
    Route::get('/in-home', 'UploadImageController@inHome');
    Route::get('/image/details/{id}', 'UploadImageController@details');
    Route::post('/add/cart', 'UploadImageController@addToCart');
    Route::get('/image-cart', 'UploadImageController@shoppingCartImage');
    Route::post('/image-cart/update', 'UploadImageController@updateImageCart');
    Route::get('/image-cart/delete/{id}', 'UploadImageController@deleteImageCart');
    Route::post('/refer-code/{code}/{total}', 'UploadImageController@checkReferCode');
    Route::get('/download-image/{id}', 'UploadImageController@download');



    Route::get('/addcart/{product_id}/{qty}/{options}', 'TempCartController@addCart');
    Route::get('/shopping-cart', 'TempCartController@shoppingCart');
    Route::post('/shopping-cart/new', 'TempCartController@addShoppingCart');
    Route::post('/shopping-cart/update', 'TempCartController@updateShoppingCart');
    Route::get('/shopping-cart/delete/{id}', 'TempCartController@deleteShoppingCart');
    Route::get('/shopping-cart/{product_id}', 'TempCartController@addShoppingCartByProductId');
    Route::post('/coupon-code/{code}/{total}', 'CouponCodeController@checkCouponCode');
    Route::get('/login', 'PagesController@login');
    Route::post('/login', 'ClientController@checkAccess');
    Route::get('/logout', 'ClientController@logout');
    Route::get('/registration', 'PagesController@registration');
    Route::post('/registration', 'ClientController@newClient');
    Route::get('/checkout', 'TempCartController@checkout');
    Route::post('/checkout', 'TempCartController@payment');
    Route::get('/get-client-by-email', 'ClientController@get_client_by_email');
    Route::post('/shopping-cart-uneditable/new', 'TempCartController@addShoppingCartForUneditable');

    Route::get('/guest-checkout', 'TempCartController@guestCheckout');
    Route::post('/guest-checkout', 'TempCartController@payment');

    Route::get('/forgot-password', 'PagesController@forgot_password');
    Route::post('/forgot-password', 'ClientController@forgotPassword');
    Route::get('/new-password/{hash}', 'ClientController@newPassword');
    Route::post('/new-password', 'ClientController@resetPassword');
    Route::get('/compute-tax/{state}/{total}', 'StateController@computeTax');
    Route::get('/display-shipping-options', 'ShippingController@fetchShipping'); // 2019 Aug 15 - display shipping options for guest checkout or no shipping address
    Route::get('/shipping-display/{city}/{state}/{country}/{zip}/{weight}/{total}', 'ShippingController@displayShipping');
    Route::get('/shipping-display-new/{address}/{city}/{state}/{country}/{zip}/{total}', 'ShippingController@displayShippingGraphic');
   
    Route::get('/dashboard/{category}', 'PagesController@dashboard');
    Route::get('/dashboard/{category}/{slug}', 'PagesController@dashboard');

   /* Route::get('/user-account', 'ClientController@userAccount');
    Route::post('/user-account', 'ClientController@updateUserAccount');
    Route::get('/user-billing', 'ClientController@userBilling');
    Route::post('/user-billing', 'ClientController@updateUserBilling');
    Route::get('/user-shipping', 'ClientController@userShipping');
    Route::post('/user-shipping', 'ClientController@updateUserShipping');
    Route::get('/user-orders', 'CartController@userOrderHistory');
    Route::get('/user-change-password', 'ClientController@userChangePassword');
    Route::post('/user-change-password', 'ClientController@userUpdateChangePassword');*/

    Route::get('/frames/display', 'ProductController@displayFrame');
    Route::get('/frames/attributes/{color}/{frame_width}/{frame_style}/{material}/{sortby}', 'ProductController@displayFrameSearch');
    Route::get('/frames/search_sku/{sku}', 'ProductController@displayFrameSearchBySKU');
    Route::get('/reder-graphik-api', 'ProductController@render_grapik');


    //for sales / territory manager registration
    Route::get('/sales-registration', 'PagesController@salesRegistration');
    Route::post('/sales-registration', 'ManagerController@newSalesRegistration');
    Route::get('/sales-login', 'PagesController@salesLogin');
    Route::post('/sales-login', 'ManagerController@salesLogin');
    Route::post('/sales-forgot-password', 'ManagerController@forgotPassword');
    Route::get('/sales-new-password/{hash}', 'ManagerController@newPassword');
    Route::post('/sales-new-password', 'ManagerController@resetPassword');

    //for shop owner registration login and forgot password
    Route::get('/shop-owner-login', 'PagesController@shopLogin');
    Route::post('/shop-owner-login', 'ShopOwnerController@login');
    Route::get('/shop-owner-registration', 'PagesController@shopRegistration');
    Route::post('/shop-owner-registration', 'ShopOwnerController@newRegistration');
    Route::post('/shop-owner-forgot-password', 'ShopOwnerController@forgotPassword');
    Route::get('/shop-owner-new-password/{hash}', 'ShopOwnerController@newPassword');
    Route::post('/shop-owner-new-password', 'ShopOwnerController@resetPassword');


    /*static*/
    // Route::get('/framing', 'PagesController@fullWidth');
    Route::get('/store', 'PagesController@store');

     Route::post('/404', 'PagesController@page404');
     Route::get('/{slug}', 'PagesController@pageDisplay');
     Route::post('/{slug}', 'PagesController@savePageChanges');
});

define('SITENAME','Clarkin Collections');
define('THUMB_IMAGE','thumb/');
define('SMALL_IMAGE','small/');
define('MEDIUM_IMAGE','medium/');
define('LARGE_IMAGE','large/');
define('XLARGE_IMAGE','x-large/');
// define('PAGES_IMAGE_PATH','public/uploads/pages/');
// define('HOME_SLIDE_IMAGE_PATH','uploads/home-sliders/');
// define('PHOTO_GALLERY_IMAGE_PATH','public/uploads/photo-gallery/');
// define('STAFF_IMAGE_PATH','public/uploads/staff/');
// define('CATEGORY_IMAGE_PATH','public/uploads/category/');
// define('PRODUCT_IMAGE_PATH','public/uploads/products/');
// define('SLIDER_IMAGE_PATH','public/uploads/slider/');
// define('MANAGER_IMAGE_PATH','public/uploads/manager/');
// define('CUSTOMER_IMAGE_PATH','public/uploads/customer/');
// define('SHOP_OWNER_IMAGE_PATH','public/uploads/shop_owner/');

// stage
// define('PAGES_IMAGE_PATH','uploads/pages/');
// define('HOME_SLIDE_IMAGE_PATH','uploads/home-sliders/');
// define('PHOTO_GALLERY_IMAGE_PATH','uploads/photo-gallery/');
// define('STAFF_IMAGE_PATH','upload/staff/');
// define('CATEGORY_IMAGE_PATH','upload/category/');
// define('PRODUCT_IMAGE_PATH','upload/products/');
// define('SLIDER_IMAGE_PATH','upload/slider/');
// define('MANAGER_IMAGE_PATH','upload/manager/');
// define('CUSTOMER_IMAGE_PATH','upload/customer/');
// define('SHOP_OWNER_IMAGE_PATH','upload/shop_owner/');
// define('CUSTOM_IMAGE_THUMBNAIL_PATH','upload/thumbnails/');
// define('CUSTOM_IMAGE_PATH','storage/');

//live
define('PAGES_IMAGE_PATH','uploads/pages/');
define('HOME_SLIDE_IMAGE_PATH','uploads/home-sliders/');
define('PHOTO_GALLERY_IMAGE_PATH','uploads/photo-gallery/');
define('STAFF_IMAGE_PATH','upload/staff/');
define('CATEGORY_IMAGE_PATH','upload/category/');
define('PRODUCT_IMAGE_PATH','uploads/products/');
define('SLIDER_IMAGE_PATH','upload/slider/');
define('MANAGER_IMAGE_PATH','upload/manager/');
define('CUSTOMER_IMAGE_PATH','upload/customer/');
define('SHOP_OWNER_IMAGE_PATH','upload/shop_owner/');
define('CUSTOM_IMAGE_THUMBNAIL_PATH','upload/thumbnails/');


define('PAGES_IMAGE_WIDTH','1200');
define('PAGES_IMAGE_HEIGHT','400');
define('HOMESLIDE_IMAGE_WIDTH','1920');
define('HOMESLIDE_IMAGE_HEIGHT','1000');
define('CATEGORY_IMAGE_WIDTH','248');
define('CATEGORY_IMAGE_HEIGHT','113');
//define('PRODUCT_IMAGE_WIDTH','1560');
//define('PRODUCT_IMAGE_HEIGHT','890');
define('PRODUCT_IMAGE_WIDTH','1200');
define('PRODUCT_IMAGE_HEIGHT','400');
define('SLIDER_IMAGE_WIDTH','1919');
define('SLIDER_IMAGE_HEIGHT','744');
define('PROFILE_IMAGE_WIDTH','250');
define('PROFILE_IMAGE_HEIGHT','250');

define('IMAGES_DIMENSION_ERROR','Your image does not fit the proper dimensions and could not be uploaded, please check the image requirements again.');

define('BRAINTREE_ENVIRONMENT',  'sandbox');
define('BRAINTREE_MERCHANTID',  'yy6wyk624p5428h9');
define('BRAINTREE_PUBLICKEY',  '9n4h64db2yw8mbk9');
define('BRAINTREE_PRIVATEKEY',  'f9af76f67a9fbd94fe2d037e68acdc14');
define('BRAINTREE_MERCHANTACCOUNTID','clarkin_test_sandbox'); // use the accept payment
define('BRAINTREE_MASTERACCOUNTID',  '29690707 ');  // it use to pay the property owner

define('CustomerToSalesManagerCommission','.10');
define('CustomerToShopOwnerCommission','.10');

define('PAGE_MANAGEMENT','Page');
define('SETTINGS_MANAGEMENT','Settings');
define('HOMESLIDE_MANAGEMENT','Home Slide');
define('CATEGORY_MANAGEMENT','Category');
define('PRODUCT_MANAGEMENT','Products');
define('COUPONCODE_MANAGEMENT','Coupon Code');
define('SHIPPING_MANAGEMENT','Shipping');
define('SHIPPING_UPS','UPS');
define('SHIPPING_FEDEX','FEDEX');
define('SHIPPING_USPS','USPS');
define('SUBSCRIPTION','Subscription');
define('ORDERS','Orders');
define('Contact','Contact');
define('SALESMANAGER_MANAGEMENT','Sales Manager');
define('SALESREP_MANAGEMENT','Sales Rep');
define('SHOPOWNER_MANAGEMENT','Shop Owner');
define('CLIENT_MANAGEMENT','Client');

define('COMMISSIONS','Commissions');

define('EmailFrom','no-reply@clarkincollection.com');
// define('EmailFrom','no-reply@dogandrooster.com');
define('EmailFromName','Clarkin No-Reply');

define('EmailTo','fulfillment@graphikdimensions.com');
// define('EmailTo','dennis+123@dogandrooster.com');
define('EmailToName','Fulfill Clarkin');
define('EmailTo2','mcarl@graphikdimensions.com');
// define('EmailTo2','test1@dogandrooster.net');
define('EmailToName2','Admin Clarkin');

define('EmailTo3','chad_clarkin@yahoo.com');
define('EmailToName3','Chad Clarkin');

//define('EmailTo4','mcornelison@graphikdimensions.com');
//define('EmailToName4','mcornelison graphikdimensions');

// Used in Graphik Hi-cost frame (added to Low-cost frame)
define('Differential1',140);
define('Differential2',160);
define('Differential3',185);
define('Differential4',225);
