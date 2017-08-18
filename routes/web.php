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
Route::get('', function(){
	return view('index', [
		'name' => 'test'
	]);
});

Route::get('index', function(){
	return view('index');
});

Route::get('login','UserController@getLoginAdmin');
Route::post('login', 'UserController@postLoginAdmin');
Route::get('logout', 'UserController@getLogoutAdmin');

Route::get('login', function () {
    return view('login');
});


Route::get('dangky', function () {
    return view('register');
});

Route::get('register', 'UserController@getRegister');
Route::post('register', 'UserController@postRegister');

