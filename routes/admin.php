<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 6/14/2019
 * Time: 23:20
 */
//Route::group(['prefix' => 'admin', 'middleware'=>['auth','web']], function(){
Route::middleware(['auth'])->group(function () {

    Route::get('dashboard','admin\AdminController@dashboard')->name('admin.dashboard');


});//end of route group

//Route::get('/','admin\AdminController@login');

Route::match(['get' , 'post'],'/', 'admin\AdminController@login')->name('admin.login');


