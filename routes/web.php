<?php

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


Route::get('/d','admin\AdminController@login');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::match(['get','post'],'/login','HomeController@login')->name('login');
Route::get('user-logout','user\UserController@logout')->name('user.logout');

//user guest

//index page
Route::get('/', 'IndexController@index')->name('index');

//user login and register
Route::get( 'login-register', 'user\UserController@userLoginRegister')->name('user.userLoginRegister');
Route::post( 'user-register', 'user\UserController@register')->name('user.register');
Route::post( 'user-login', 'user\UserController@login')->name('user.login');
Route::match(['get', 'post'], 'check-email', 'user\UserController@checkEmail')->name('user.check_email');

Route::get('/user/verify/{token}', 'user\UserController@verifyUser')->name('verify');

Auth::routes(['verify' => true]);
//user account settings
Route::middleware(['userLogin'])->group(function () {
    Route::match(['get','post'], 'user-account', 'user\UserController@account')->name('user.account')->middleware('verified');
    Route::match(['get','post'],'check-password', 'user\UserController@checkPassword')->name('user.check_password');
    Route::post('update-password', 'user\UserController@updatePassword')->name('user.update_password');
    Route::match(['get','post'],'check-out', 'user\ProductsController@checkOut')->name('user.check_out');
    Route::match(['get','post'],'order-review', 'user\ProductsController@orderReview')->name('user.order_review');
    Route::match(['get','post'],'place-order', 'user\ProductsController@placeorder')->name('user.place_order');
    Route::match(['get','post'],'thanks', 'user\ProductsController@thanks')->name('user.thank');

    Route::match(['get','post'],'user-orders', 'user\ProductsController@userOrders')->name('user.orders');
    Route::match(['get','post'],'order/{id}', 'user\ProductsController@orderDetails')->name('user.order_details');


    //cart
    Route::match(['get','post'],'/add-to-cart','user\ProductsController@addToCart')->name('addToCart');
    Route::match(['get','post'],'/user-cart','user\ProductsController@showCart')->name('showCart');
    Route::get('/user-cart/delete-cart-product/{id}','user\ProductsController@deleteCartProduct')->name('delete_cart_product');
    Route::get('/user-cart/update-cart-product-quantity/{id}/{quantity}',
        'user\ProductsController@updateCartProductQuantity')->name('update_cart_product_quantity');


    Route::post('/user-cart/apply-coupon','user\ProductsController@applyCoupon')->name('apply_coupon');
});


//products

Route::get('products/{url}','user\ProductsController@products')->name('categorize_products');
Route::get('product/{id}','user\ProductsController@product')->name('product');
Route::post('product/attribute','user\ProductsController@getProductAttributes')->name('get_product_attribute');

