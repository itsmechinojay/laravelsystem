<?php

namespace App\Http\Controllers\EmployeePage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Clienthistotry;
use Illuminate\Support\Facades\DB;
use Auth;

class ClienthistoryController extends Controller
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
        $name = Auth::user()->email;

        $histories = DB::table('clienthistory')
            ->where('email', '=', $name)
            ->get();

        return view('deploymenthistory', compact('histories'));
    }

    public function getHistory()
    {
        $name =Auth::user()->name;

        $history = DB::table('clienthistory')
            ->where('email','=',$name)
            ->get();
        return json_encode([
            'result' => 'success',
            'historylist' => $history
        ]);
    }
}
