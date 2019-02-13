<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Client_Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\Notify;


class Client_RequestController extends Controller
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
        $client_requests = DB::table('client_request')
            ->paginate(500);

        return view('client_request', compact('client_requests'));
    }

    public function getRequest()
    {
        $request = DB::table('client_request')
            ->where('client_id', '=', Auth::user()->name)
            ->get();
        return json_encode([
            'result' => 'success',
            'request' => $request
        ]);
    }

    public function requestClient(Request $request)
    {
        $requestEmployee = Client_Request::create([
            'client_id' => Auth::user()->name,
            'status' => 0,
            'position' => $request['position'],
            'description' => $request['description'],
            'needed' => $request['needed'],
            'request_status' => 'O'
        ]);
        
        $newNot = Notify::create([
            'sender' => Auth::user()->name,
            'action' => 'New Request by Client',
            'sendto' => 'Admin',
            'status' => 1
        ]);

        if ($requestEmployee) {
            return json_encode([
                'result' => 'success',
                'message' => 'Successfully Added!'
            ]);
        } else {
            return json_encode([
                'result' => 'failed',
                'message' => 'Not success'
            ]);
        }
    }

    public function deleteRequest(Request $request)
    {
        $request_id_array = $request->input('id');
        $delete_request = Client_Request::where('id', $request_id_array)->delete();
        if ($delete_request) {
            return json_encode(array('result' => 'success', 'message' => 'employee successfully deleted.'));
        }
    }
}
