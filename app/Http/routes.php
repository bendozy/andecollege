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
    $categories = \AndeCollege\Category::all();
    $resources =  \AndeCollege\Resource::all();
    return view('pages.resources', compact('categories', 'resources'));
}]);

Route::get('/login', ['as' => 'getLogin', function () {
    return view('auth.login');
}]);

Route::post('/login', [
    'as' => 'postLogin', 'uses' => 'Auth\AuthController@doLogin'
]);

Route::get('/login/{provider}', [
    'as' => 'login.social',
    'uses' => 'Auth\AuthController@socialLogin',
    'middleware' => ['guest']
]);

Route::get('/logout', [
    'as' => 'logout',
    'uses' => 'Auth\AuthController@getLogout',
    'middleware' => ['auth']
]);

Route::get('/register', [
    'as' => 'getRegister',
    'middleware' => ['guest'],
    function () {
        return view('auth.register');
    }]);

Route::post('/register', [
    'as' => 'postRegister',
    'uses' => 'Auth\AuthController@postRegister',
    'middleware' => ['guest']
]);

Route::get('/logout', [
    'as' => 'logout',
    'uses' => 'Auth\AuthController@getLogout',
    'middleware' => ['auth']
]);

Route::get('/social', [
    'as' => 'get.social',
    'uses' => 'Auth\AuthController@getSocial',
    'middleware' => ['guest']
]);

Route::get('/social/twitter', [
    'as' => 'get.social.twitter',
    'uses' => 'Auth\AuthController@getSocialTwitter',
    'middleware' => ['guest']
]);

Route::post('/social', [
    'as' => 'post.social',
    'uses' => 'Auth\AuthController@postSocial',
    'middleware' => ['guest']
]);

Route::get('/resource/create', [
    'as' => 'resource.create',
    'uses' => 'ResourceController@create',
    'middleware' => ['auth']
]);

Route::post('/resource', [
    'as' => 'resource.save',
    'uses' => 'ResourceController@store',
    'middleware' => ['auth']
]);

Route::get('/resource/{id}', [
    'as' => 'resource.show',
    'uses' => 'ResourceController@show'
]);

Route::get('/rescat/{name}', [
    'as' => 'resource.cat',
    'uses' => 'ResourceController@resourceCategory'
]);

Route::resource('category', 'CategoryController');
