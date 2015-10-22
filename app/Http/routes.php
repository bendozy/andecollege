<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'index', function () {
	return view('pages.welcome');
}]);

Route::get('/resources', ['as' => 'resources', function () {
	return view('pages.resources');
}]);

Route::get('/login', ['as' => 'getLogin', function () {
	return view('auth.login');
}]);

Route::post('/login', [
	'as' => 'postLogin', 'uses' => 'Auth\AuthController@doLogin'
]);

Route::get('/login/{provider?}', [
	'as' => 'getSocial', 'uses' => 'Auth\AuthController@socialLogin'
]);

Route::get('/logout', [
	'as' => 'logout', 'uses' => 'Auth\AuthController@getLogout'
]);

Route::get('/register', ['as' => 'getRegister', function () {
	return view('auth.register');
}]);

Route::post('/register', [
	'as' => 'postRegister', 'uses' => 'Auth\AuthController@postRegister'
]);

Route::get('/logout', [
	'as' => 'logout', 'uses' => 'Auth\AuthController@getLogout'
]);

//Route::get('/user', ['as' => 'user', function () {
//	return view('welcome');
//}]);
//
//Route::get('/user/register', ['as' => 'register', function () {
//	return view('welcome');
//}]);
//
//Route::get('/user', ['as' => 'user', function () {
//	return view('welcome');
//}]);
//
//Route::get('/resources', ['as' => 'resources', function () {
//	return view('welcome');
//}]);