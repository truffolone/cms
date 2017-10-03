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
    return view('welcome');
});

/**
 * Resources
 */
Route::resource('companies', 'CompanyController');
Route::resource('users', 'UserController');

/**
 * Recycle Bin
 */
Route::get('bin/companies', 'CompanyController@bin');
Route::get('bin/companies/restore/{company}', 'CompanyController@restore');

Route::get('bin/users', 'UserController@bin');
Route::get('bin/users/restore/{user}', 'UserController@restore');