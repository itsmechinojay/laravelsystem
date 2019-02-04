<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Client_Request;
use App\Http\Model\Employee;
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
        return view('admin/request');
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
            ->where('Client', '=', 'Pending')
            ->get();
        return json_encode([
            'result' => 'success',
            'employeelist' => $employee
        ]);
    }

    public function getRequest(Request $request)
    {
        return json_encode([
            'result' => 'success',
            'request' => $request
        ]);
    }

    public function Approve($id = 0, Request $request)
    {
        $updateRequest = Client_Request::where('id', $id)->update(['status' => "1"]);
        if ($updateRequest) {
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
    
    public function formAction()
    {
        $request = Input::get('status');
        if (Input::get('Approve')) {
            $this->approveResquest($request);
        } elseif (Input::get('Pending')) {
            $this->pendingRequest($request);
        }
        return redirect('admin');
    }
    public function approveResquest($request)
    {
        foreach ($request as $requestId)
            Client_Request::findOrNew($requestId)->update(['status' => "1"]);
    }
    public function pendingRequest($request)
    {
        foreach ($request as $requestId)
            Client_Request::findOrNew($requestId)->update(['status' => "0"]);
    }
}