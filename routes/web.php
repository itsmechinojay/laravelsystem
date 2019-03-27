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
Route::get('/count', 'NotifyController@getAdminNotyCount');
Route::get('/count/client', 'NotifyController@getClientNotyCount');

Route::group(['middleware' => ['admin'] && ['dev']], function () {

    
    Route::get('/admin/evaluationlist/all', 'EvaluationController@getAllEvaluation');

    Route::any('/notify', 'NotifyController@index')->name('notify');
    Route::get('/admin/notify/all', 'NotifyController@getAllNotify');
    Route::get('/admin/clientnotify/all', 'NotifyController@getAllClientNotify');
    Route::post('/deletenotify/{id}', 'NotifyController@deleteNotify')->name('notify.create');

    //Employee
    Route::any('admin/employee', 'Admin\EmployeeController@index')->name('admin.employee');
    Route::get('admin/show/{employee}', 'Admin\EmployeeController@getEmployee');
    Route::post('admin/employee/add/{id}', 'Admin\EmployeeController@createEmployee')->name('employee.create');
    Route::get('admin/employee/all', 'Admin\EmployeeController@getAllEmployee');
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
    Route::get('admin/getallemployee/{position}', 'Admin\RequestController@getAllEmployee');
    Route::post('admin/request/{id}', 'Admin\RequestController@Approved')->name('request.create');
    Route::put('admin/request/update/{id}/{employeeid}/{clientname}', 'Admin\RequestController@deployEmployee');
    
    //Account
    Route::any('admin/account', 'Admin\AccountController@index')->name('admin.account');
    Route::get('admin/show/{users}', 'Admin\AccountController@getAccount');
    Route::get('admin/password/{users}', 'Admin\AccountController@getPassword');
    Route::post('admin/account/add/{id}', 'Admin\AccountController@createAccount')->name('account.create');
    Route::get('admin/account/all', 'Admin\AccountController@getAllAccount');
    Route::get('admin/account/delete', 'Admin\AccountController@deleteAccount');
    Route::post('admin/reset/{id}', 'Admin\AccountController@resetPassword')->name('reset.create');
    Route::put('admin/updateaccount/{id}', 'Admin\AccountController@updateAccount');
});

Route::group(['middleware' => ['client'] && ['dev']], function () {
    //Client User
    
    Route::any('/notify', 'NotifyController@index')->name('notify');
    Route::get('/admin/notify/all', 'NotifyController@getAllNotify');
    Route::get('/admin/clientnotify/all', 'NotifyController@getAllClientNotify');
    Route::post('/notify/{id}', 'NotifyController@deleteNotify')->name('notify.create');
    Route::any('/client_user', 'Client_UserController@index')->name('client_user');
    Route::any('/client_employee', 'Client_EmployeeController@index')->name('client_employee');
    Route::get('/client_employee/getallemployee', 'Client_EmployeeController@getAllEmployee');
    Route::get('/client_request', 'Client_RequestController@index')->name('client_request');
    Route::post('/client_request/add', 'Client_RequestController@requestClient');
    Route::get('/client_user/get_request', 'Client_RequestController@getRequest');
    
    
    Route::put('client/contract/{id}/{contractyear}', 'Client_EmployeeContract@makeContract');

    Route::get('client/request/delete', 'Client_RequestController@deleteRequest');
    Route::any('/evaluation', 'EvaluationController@index')->name('client_user');
    Route::post('/evaluation/addperiod', 'EvaluationController@addEvalPeriod');
    Route::post('/evaluation/evaluateemployee', 'EvaluationController@evaluateEmployee');
    Route::get('/evaluation/checkevaluation', 'EvaluationController@checkEvaluationDate');
});




//Employee User
// Route::get('/employee_user', 'Employee_UserController@index')->name('employee_user');
Route::get('/profile', 'EmployeePage\ProfileController@index')->name('profile');
Route::get('/employee/profile/{email}', 'EmployeePage\ProfileController@getProfile');
Route::get('/deployment_history', 'EmployeePage\ClienthistoryController@getHistory');
Route::get('/deploymenthistory', 'EmployeePage\ClienthistoryController@index')->name('history');

