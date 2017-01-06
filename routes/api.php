<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => '/v1'], function () {
	// get list of customers
	Route::get('customers','CustomerController@index');
	// get specific customers
	Route::get('customers/{id}','CustomerController@show');
	// delete a customers
	Route::delete('customers/{id}','CustomerController@destroy');
	// update existing customers
	Route::put('customers/{id}','CustomerController@update');
	// create new customers
	Route::post('customers','CustomerController@store');
	
	// get list of technologies
	Route::get('technologies','TechnologyController@index');
	// get specific technologies
	Route::get('technologies/{id}','TechnologyController@show');
	// delete a technologies
	Route::delete('technologies/{id}','TechnologyController@destroy');
	// update existing technologies
	Route::put('technologies/{id}','TechnologyController@update');
	// create new technologies
	Route::post('technologies','TechnologyController@store');
});
