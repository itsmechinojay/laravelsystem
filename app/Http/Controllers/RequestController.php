<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Client_Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
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

    public function index()
    {
        return view('request');
    }

    public function getAllRequest()
    {
        return json_encode([
            'result' => 'success',
            'requestlist' => Client_Request::all()
        ]);
    }

    public function getAllEmployee()
    {
        $employee = DB::table('employee')
                    ->where('status', '=', 0)
                    ->get();
        return json_encode([
            'result' => 'success',
            'employeelist' => $employee
        ]);
    }
}
