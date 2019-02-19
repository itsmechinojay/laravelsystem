<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\Notify;

class NotifyController extends Controller
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
        return view('notify');
    }

    public function databaseCount(Request $request)
    {
        $count = DB::table('notify')
            ->where('status', 1)
            ->where('sendto', 'Admin')
            ->count();
        return json_encode([
            'result' => 'success',
            'count' => $count
        ]);
    }

    public function getAllNotify()
    {
        $request = Notify::where('status', '1')->get();
        return json_encode([
            'result' => 'success',
            'notifylist' => $request
        ]);
    }
}
