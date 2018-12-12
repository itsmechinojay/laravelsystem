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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'AboutController@index')->name('about');

//Employee
Route::any('/employee', 'EmployeeController@index')->name('employee');
Route::post('/employee/add', 'EmployeeController@createEmployee')->name('employee.create');
Route::get('/employee/all', 'EmployeeController@getAllEmployee');

//Client
Route::any('/client', 'ClientController@index')->name('client');
Route::post('/client/add', 'ClientController@createClient')->name('client.create');
Route::get('/client/all', 'ClientController@getAllClient');

//Client User
Route::get('/client_user', 'Client_UserController@index')->name('client_user');
Route::get('/client_employee', 'Client_EmployeeController@index')->name('client_employee');
Route::get('/client_request', 'Client_RequestController@index')->name('client_request');

//Employee User
Route::get('/employee_user', 'Employee_UserController@index')->name('employee_user');
