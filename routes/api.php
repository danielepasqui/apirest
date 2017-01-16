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
    Route::group(['prefix' => '/customers'], function () {
        // get list of customers
        Route::get('/', 'CustomerController@index')->name('customers.index');
        // get specific customers
        Route::get('/{id}', 'CustomerController@show')->name('customers.show');
        // delete a customers
        Route::delete('/{id}', 'CustomerController@destroy')->name('customers.destroy');
        // update existing customers
        Route::put('/{id}', 'CustomerController@update')->name('customers.update');
        // create new customers
        Route::post('/', 'CustomerController@store')->name('customers.store');
    });

    Route::group(['prefix' => '/technologies'], function () {
        // get list of technologies
        Route::get('/', 'TechnologyController@index')->name('technologies.index');
        // get specific technologies
        Route::get('/{id}', 'TechnologyController@show')->name('technologies.show');
        // delete a technologies
        Route::delete('/{id}', 'TechnologyController@destroy')->name('technologies.destroy');
        // update existing technologies
        Route::put('/{id}', 'TechnologyController@update')->name('technologies.update');
        // create new technologies
        Route::post('/', 'TechnologyController@store')->name('technologies.store');
    });

    Route::group(['prefix' => '/machines'], function () {
        // get list of machines
        Route::get('/', 'MachineController@index')->name('machines.index');
        // get specific machines
        Route::get('/{id}', 'MachineController@show')->name('machines.show');
        // delete a machines
        Route::delete('/{id}', 'MachineController@destroy')->name('machines.destroy');
        // update existing machines
        Route::put('/{id}', 'MachineController@update')->name('machines.update');
        // create new machines
        Route::post('/', 'MachineController@store')->name('machines.store');
    });

    Route::group(['prefix' => '/databases'], function () {
        // get list of databases
        Route::get('/', 'DatabaseController@index')->name('databases.index');
        // get specific databases
        Route::get('/{id}', 'DatabaseController@show')->name('databases.show');
        // delete a databases
        Route::delete('/{id}', 'DatabaseController@destroy')->name('databases.destroy');
        // update existing databases
        Route::put('/{id}', 'DatabaseController@update')->name('databases.update');
        // create new databases
        Route::post('/', 'DatabaseController@store')->name('databases.store');
    });

    Route::group(['prefix' => '/sites'], function () {
        // get list of sites
        Route::get('/', 'SiteController@index')->name('sites.index');
        // get specific sites
        Route::get('/{id}', 'SiteController@show')->name('sites.show');
        // delete a sites
        Route::delete('/{id}', 'SiteController@destroy')->name('sites.destroy');
        // update existing sites
        Route::put('/{id}', 'SiteController@update')->name('sites.update');
        // create new sites
        Route::post('/', 'SiteController@store')->name('sites.store');
    });
});
