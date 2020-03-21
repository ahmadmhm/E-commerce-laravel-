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
Route::get('logout','HomeController@logout')->name('logout');

//user guest

//index page
Route::get('/', 'IndexController@index')->name('index');

//products

Route::get('products/{url}','admin\ProductsController@products')->name('categorize_products');
Route::get('product/{id}','admin\ProductsController@product')->name('product');
Route::post('product/attribute','admin\ProductsController@getProductAttributes')->name('get_product_attribute');

//cart
Route::match(['get','post'],'/add-to-cart','admin\ProductsController@addToCart')->name('addToCart');
Route::match(['get','post'],'/user-cart','admin\ProductsController@showCart')->name('showCart');
Route::get('/user-cart/delete-cart-product/{id}','admin\ProductsController@deleteCartProduct')->name('delete_cart_product');
Route::get('/user-cart/update-cart-product-quantity/{id}/{quantity}',
    'admin\ProductsController@updateCartProductQuantity')->name('update_cart_product_quantity');