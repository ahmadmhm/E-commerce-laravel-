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
Route::get('/', 'IndexController@index')->name('index');