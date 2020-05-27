<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PostController@display');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/post', [
			'uses' => 'PostController@create',
			'as' => 'create'
		]);

Route::post('/post', [
			'uses' => 'PostController@store',
			'as' => 'store'
		]);


Route::group(['middleware' => ['auth']], function($route){

		Route::get('/user', 'AdminCheckController@userDemo')->name('user');

		Route::group(['middleware' => ['admin']], function($route){

		Route::get('/admin', 'AdminCheckController@adminDemo')->name('admin');

});
	});

