<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Client;
use App\Http\Model\Employee;
use App\Http\Model\Profile;

class Employee_UserController extends Controller
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
        $profiles = DB::table('profile')
            ->paginate(500);

        return view('employee/profile', compact('profiles'));
    }
}
