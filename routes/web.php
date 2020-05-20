<?php

use Illuminate\Support\Facades\Route;

//Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function(){
	return view('app');
});

Route::any('{slug}', function () {
    return view('app');
});

// Route::post('user/login', 'UserController@login');
// Route::get('/', 'UserController@index');
// Route::get('/{slug}', 'UserController@index');


Route::get('tag/list', 'TagController@list');
Route::post('tag/create', 'TagController@store');
Route::post('tag/update', 'TagController@update');
Route::delete('tag/delete', 'TagController@destroy');
// UPLAD CATEGORY ICON
Route::get('category/list', 'CategoryController@list');
Route::post('category/create', 'CategoryController@store');
Route::delete('category/delete', 'CategoryController@destroy');

Route::post('category/upload', 'CategoryController@upload');
Route::delete('category/deleteIcon', 'CategoryController@deleteIcon');

