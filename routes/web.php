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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'employees' => 'EmployeeController',
    'companies' => 'CompanyController'
]);

Route::get('export-company', 'CompanyController@exportCompany')->middleware('auth')->name('exportCompany');
Route::get('export-employee', 'EmployeeController@exportEmployee')->middleware('auth')->name('exportEmployee');