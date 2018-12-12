<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Client;
use App\Http\Model\Employee;
use Validator;

class Client_UserController extends Controller
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
        $clients = DB::table('client')
        ->paginate(500);
        
        $employees = DB::table('employee')
        ->paginate(500);
        
        return view('client_user',compact('clients'));
        return view('client_user',compact('employees'));
    }
}
