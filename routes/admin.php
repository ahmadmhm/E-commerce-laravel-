<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 6/14/2019
 * Time: 23:20
 */
//Route::group(['prefix' => 'admin', 'middleware'=>['auth','web']], function(){
Route::middleware(['auth'])->group(function () {

    Route::match(['get' , 'post'],'/', 'admin\AdminController@login')->name('admin.login');

    Route::get('dashboard','admin\AdminController@dashboard')->name('admin.dashboard');
    Route::get('settings','admin\AdminController@settings')->name('admin.settings');


    //ajax requests
    Route::get('check-password','admin\AdminController@checkPassword')->name('admin.check_password');


});//end of route group

//Route::get('/','admin\AdminController@login');




