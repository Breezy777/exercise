<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::resource('post', 'PostController', ['except' => ['show', 'edit', 'update']]);
    Route::resource('user', 'UserController');
    Route::get('sondage', 'SondageController@index');
    Route::get('sondage/create/{nom}', 'SondageController@create');
    Route::post('sondage/{nom}', 'SondageController@store');
    Route::get('email', 'EmailController@getForm');
    Route::post('email', ['uses' => 'EmailController@postForm', 'as' => 'storeEmail']);
  
    Route::get('post/tag/{tag}', 'PostController@indexTag');
});



Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
