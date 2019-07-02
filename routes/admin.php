<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 6/14/2019
 * Time: 23:20
 */
//Route::group(['prefix' => 'admin', 'middleware'=>['auth','web']], function(){

Route::match(['get' , 'post'],'/', 'admin\AdminController@login')->name('admin.login');

Route::middleware(['auth'])->group(function () {

    //above menu items
    Route::get('dashboard','admin\AdminController@dashboard')->name('admin.dashboard');
    Route::get('settings','admin\AdminController@settings')->name('admin.settings');


    //ajax requests for passwords
    Route::get('check-password','admin\AdminController@checkPassword')->name('admin.check_password');
    Route::post('update-password','admin\AdminController@updatePassword')->name('admin.update_password');


    //categories
    Route::match(['get','post'],'add-category','admin\CategoryController@addCategory')->name('admin.add_category');

});//end of route group

//Route::get('/','admin\AdminController@login');




