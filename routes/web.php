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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'AboutController@index')->name('about');

Route::group(['middleware' => ['admin'] && ['dev']], function () {
    //Employee

    // Route::any('/admin/employee', 'Admin\EmployeeController@index')->name('admin.employee');
    // Route::get('admin/show/{employee}', 'Admin\EmployeeController@index');
    // Route::post('admin/employee/add/{id}',  'Admin\EmployeeController@index')->name('employee.create');
    // Route::get('admin/employee/all', 'Admin\EmployeeController@index');
    // Route::get('admin/employee/delete', 'Admin\EmployeeController@index');
    
    Route::any('admin/employee', 'Admin\EmployeeController@index')->name('admin.employee');
    Route::get('admin/show/{employee}', 'Admin\EmployeeController@getEmployee');
    Route::post('admin/employee/add/{id}', 'Admin\EmployeeController@createEmployee')->name('employee.create');
    Route::get('admin/employee/all', 'Admin\EmployeeController@getAllEmployee');
    Route::get('admin/employee/deployed', 'Admin\EmployeeController@getDeployedEmployee');
    Route::get('admin/employee/pending', 'Admin\EmployeeController@getPendingEmployee');
    Route::get('admin/employee/delete', 'Admin\EmployeeController@deleteEmployee');

    //Client
    Route::any('admin/client', 'Admin\ClientController@index')->name('admin.client');
    Route::get('admin/show/{client}', 'Admin\ClientController@getClient');
    Route::post('admin/client/add/{id}', 'Admin\ClientController@createClient')->name('client.create');
    Route::get('admin/client/all', 'Admin\ClientController@getAllClient');
    Route::get('admin/client/delete', 'Admin\ClientController@deleteClient');

    //Request

    Route::any('/admin/request', 'Admin\RequestController@index')->name('admin.request');
    Route::get('admin/getallrequest', 'Admin\RequestController@getAllRequest');
    Route::get('admin/show/{employee}', 'Admin\RequestController@getRequest');
    Route::get('admin/getallemployee', 'Admin\RequestController@getAllEmployee');
    Route::get('admin/deploy', 'Admin\RequestController@Deploy');
    Route::post('admin/request/{id}', 'Admin\RequestController@Approved')->name('request.create');
    // Route::post('admin/action', array('uses' => 'RequestController@formAction'));

    //Account
    Route::any('admin/account', 'Admin\AccountController@index')->name('admin.account');
    Route::get('admin/show/{users}', 'Admin\AccountController@getAccount');
    Route::get('admin/password/{users}', 'Admin\AccountController@getPassword');
    Route::post('admin/account/add/{id}', 'Admin\AccountController@createAccount')->name('account.create');
    Route::get('admin/account/all', 'Admin\AccountController@getAllAccount');
    Route::get('admin/account/delete', 'Admin\AccountController@deleteAccount');
    Route::post('admin/reset/{id}', 'Admin\AccountController@resetPassword')->name('reset.create');
});

Route::group(['middleware' => ['client'] && ['dev']], function () {
    //Client User
    Route::any('/client_user', 'Client_UserController@index')->name('client_user');
    Route::any('/client_employee', 'Client_EmployeeController@index')->name('client_employee');
    Route::get('/client_employee/getallemployee', 'Client_EmployeeController@getAllEmployee');
    Route::get('/client_request', 'Client_RequestController@index')->name('client_request');
    Route::post('/client_request/add', 'Client_RequestController@requestClient');
    Route::get('/client_user/get_request' , 'Client_RequestController@getRequest');
    Route::get('client/request/delete', 'Client_RequestController@deleteRequest');
});




//Employee User
// Route::get('/employee_user', 'Employee_UserController@index')->name('employee_user');
Route::get('/profile', 'EmployeePage\ProfileController@index')->name('profile');

