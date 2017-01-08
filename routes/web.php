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
use App\Customer;

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/customers', function () {
    return view('customers');
});
Route::get('/customer/add', function () {
    return view('new_customer');
});
Route::get('/customer/{id}/edit', function ($id) {
    return view('edit_customer',['id' => $id]);
});
Route::get('/technologies', function () {
    return view('technologies');
});
Route::get('/technology/add', function () {
    return view('new_technology');
});
Route::get('/technology/{id}/edit', function ($id) {
    return view('edit_technology',['id' => $id]);
});
Route::get('/machines', function () {
    return view('machines');
});
Route::get('/machine/add', function () {
    return view('new_machine');
});
Route::get('/machine/{id}/edit', function ($id) {
    return view('edit_machine',['id' => $id]);
});
Route::get('/databases', function () {
    return view('databases');
});
Route::get('/database/add', function () {
    return view('new_database');
});
Route::get('/database/{id}/edit', function ($id) {
    return view('edit_database',['id' => $id]);
});
Route::get('/sites', function () {
    return view('sites');
});
Route::get('/site/add', function () {
    return view('new_site');
});
Route::get('/site/{id}/edit', function ($id) {
    return view('edit_site',['id' => $id]);
});