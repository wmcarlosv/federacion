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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function(){
	Route::resource('messages','MessagesController');
	Route::get('/messages/write_message/{role}','MessagesController@write_message')->name('messages.write_message');
	Route::resource('users','UsersController');
	Route::resource('places','PlacesController');
	Route::resource('products','ProductsController');
	Route::resource('notices','NoticesController');
	Route::resource('documents','DocumentsController');
	Route::get('/delete-document/{id}','DocumentsController@delete_document')->name('delete.document');
	Route::resource('trainings','TrainingsController');
	Route::resource('entries','EntriesController');
	Route::resource('categories','CategoriesController');
	Route::resource('cameras','CamerasController');
	Route::resource('locations','LocationsController');
});
