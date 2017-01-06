<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/customers', function () {
    return view('customers');
});
Route::get('/newcustomer', function () {
    return view('new_customer');
});
Route::get('/technologies', function () {
    return view('technologies');
});
Route::get('/newtechnology', function () {
    return view('new_technology');
});
Route::get('/machines', function () {
    return view('machines');
});
Route::get('/newmachine', function () {
    return view('new_machine');
});