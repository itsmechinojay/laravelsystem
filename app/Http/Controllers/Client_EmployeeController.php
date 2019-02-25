<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Client;
use App\Http\Model\Employee;
use Illuminate\Support\Facades\Auth;

class Client_EmployeeController extends Controller
{
     //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client_employee');
    }


    public function getAllEmployee()
    {
        $name =Auth::user()->name;

        $employeelist = DB::table('employee')
            ->where('client','=',$name)
            ->get();
        return json_encode([
            'result' => 'success',
            'employee' => $employeelist
        ]);
    }
}
