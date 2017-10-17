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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['prefix'=>'admin/acl', 'middleware' => ['auth','acl']], function() {

    Route::get('', 'AclController@index')->name('acl');

    Route::get('user', 'AclController@user')->name('acl.user');
    Route::get('user/edit/{user}', 'AclController@user_edit')->name('acl.user.edit');
    Route::put('user/{id}', 'AclController@user_update')->name('acl.user.update');
    Route::post('user', 'AclController@user_store')->name('acl.user.store');

    Route::get('group', 'AclController@group')->name('acl.group');
    Route::get('group/edit/{group}', 'AclController@group_edit')->name('acl.group.edit');
    Route::put('group/{id}', 'AclController@group_update')->name('acl.group.update');
    Route::post('group', 'AclController@group_store')->name('acl.group.store');

});

Route::group(['prefix'=>'admin', 'middleware' => ['auth','acl']], function() {

	Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/kitap', 'kitap@index')->name('kitap');

    Route::get('/kitap/edit', 'kitap@edit')->name('kitap.edit');

	
});
