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

//user account settings
Route::middleware(['userLogin'])->group(function () {
    Route::match(['get','post'], 'user-account', 'user\UserController@account')->name('user.account');
    Route::match(['get','post'],'check-password', 'user\UserController@checkPassword')->name('user.check_password');
    Route::post('update-password', 'user\UserController@updatePassword')->name('user.update_password');
});


//products

Route::get('products/{url}','user\ProductsController@products')->name('categorize_products');
Route::get('product/{id}','user\ProductsController@product')->name('product');
Route::post('product/attribute','user\ProductsController@getProductAttributes')->name('get_product_attribute');

//cart
Route::match(['get','post'],'/add-to-cart','user\ProductsController@addToCart')->name('addToCart');
Route::match(['get','post'],'/user-cart','user\ProductsController@showCart')->name('showCart');
Route::get('/user-cart/delete-cart-product/{id}','user\ProductsController@deleteCartProduct')->name('delete_cart_product');
Route::get('/user-cart/update-cart-product-quantity/{id}/{quantity}',
    'user\ProductsController@updateCartProductQuantity')->name('update_cart_product_quantity');

Route::post('/user-cart/apply-coupon','user\ProductsController@applyCoupon')->name('apply_coupon');
