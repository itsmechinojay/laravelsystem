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

    public function getAllNotify()
    {
        $notifylist = Notify::where('status', '1')->where('sendto', 'Admin')->get();

        return json_encode([
            'result' => 'success',
            'notify' => $notifylist
        ]);
    }

    public function getAllClientNotify()
    {
        $name = Auth::user()->name;

        $clientnotifylist = DB::table('notify')
            ->where('status', '1')
            ->where('sendto', '=', $name)
            ->get();
        return json_encode([
            'result' => 'success',
            'notify' => $clientnotifylist
        ]);
    }

    public function getAdminNotyCount()
    {
        
        
        $count = Notify::where('status', '1')->where('sendto', 'Admin')->count();

        return json_encode([
            'result' => 'success',
            'count' => $count
        ]);
    }

    public function getClientNotyCount()
    {
        $name = Auth::user()->name;

        $count = Notify::where('status', '1')->where('sendto', $name)->count();

        return json_encode([
            'result' => 'success',
            'count' => $count
        ]);
    }

    public function deleteNotify($id = 0, Request $request)
    {
        $updateNotify = Notify::where('id', $id)->update(['status' => "0"]);
        if ($updateNotify) {
            return json_encode([
                'result' => 'success',
                'message' => 'Successfully Mark as Read!'
            ]);
        } else {
            return json_encode([
                'result' => 'failed',
                'message' => 'Not success'
            ]);
        }
    }
}
