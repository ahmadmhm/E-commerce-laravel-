<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 6/14/2019
 * Time: 23:20
 */

/*Route::middleware(['auth'])->group(function () {




});//end of route group*/

//Route::get('/','admin\AdminController@login');

Route::match(['get' , 'post'],'/', 'admin\AdminController@login')->name('admin.login');

Route::get('dashboard','admin\AdminController@dashboard')->name('admin.dashboard');
