<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Client_Request;
use App\Http\Model\Clienthistory;
use App\Http\Model\Employee;
use App\Http\Model\Notify;
use Illuminate\Support\Facades\DB;
use Auth;

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
        return view('admin/request');
    }
    public function getAllRequest()
    {
        $request = Client_Request::where('request_status', 'O')->get();


        Client_Request::where('needed', "0")->update(['request_status' => "C"]);

        return json_encode([
            'result' => 'success',
            'requestlist' => $request
        ]);
    }


    public function getAllEmployee($position)
    {
        $employee = DB::table('employee')
            ->select('id', 'lastname', 'firstname', 'middlename', 'email')
            ->where('position', '=', $position)
            ->where('client', 'Pending')
            ->get();

        return json_encode([
            'result' => 'success',
            'employeelist' => $employee
        ]);
    }

    public function deployEmployee($id, $employeeid, $clientname)
    {

        $upRequest = DB::table('client_request')
            ->where('id', $id)
            ->decrement('needed');

        $deployEmployee = DB::table('employee')
            ->where('id', $employeeid)
            ->update(['client' => $clientname]);


        if ($deployEmployee && $upRequest) {

            Notify::create([
                'sender' => Auth::user()->name,
                'action' => 'Deployed Employee',
                'sendto' => $clientname,
                'status' => 1
            ]);

            return json_encode([
                'result' => 'success',
                'message' => 'Successfully Deploy'
            ]);
        } else {
            return json_encode([
                'result' => 'failed',
                'message' => 'Something problem'
            ]);
        }
    }


    public function getEmployee(Employee $employee)
    {
        return json_encode([
            'result' => 'success',
            'employee' => $employee
        ]);
    }

    public function getClient(Client_Request $client_request)
    {
        return json_encode([
            'result' => 'success',
            'employee' => $client_request
        ]);
    }

    public function getRequest(Request $request)
    {


        return json_encode([
            'result' => 'success',
            'request' => $request
        ]);
    }

    public function Approved($id = 0)
    {
        $clientname = DB::table('client_request')
            ->select('client_id')
            ->where('id', $id)
            ->get();

        $updateRequest = Client_Request::where('id', $id)->update(['status' => "1"]);

        if ($updateRequest) {
            Notify::create([
                'sender' => Auth::user()->name,
                'action' => 'Approved Request',
                'sendto' => $clientname,
                'status' => 1
            ]);
            return json_encode([
                'result' => 'success',
                'message' => 'Successfully Updated!'
            ]);
        } else {
            return json_encode([
                'result' => 'failed',
                'message' => 'Not success'
            ]);
        }
    }
}
