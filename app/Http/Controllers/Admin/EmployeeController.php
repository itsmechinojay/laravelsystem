<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Model\Employee;
use Validator;

class EmployeeController extends Controller
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
        $employees = DB::table('employee')
        ->paginate(500);
        
        return view('admin/employee',compact('employees'));
    }
    
    public function getAllEmployee(Employee $employee){
        $employeelist = Employee::all();
		return json_encode([
			'result' => 'success',
			'employee' => $employeelist
		]);
    }
    
    public function getEmployee(Client $employee){
		return json_encode([
			'result' => 'success',
			'employee' => $employee
		]);
    }
    
    public function createEmployee(Request $request){
        $validation = Validator::make($request->all(), [
            'lastname'=> 'required',
            'firstname'=> 'required',
            'middlename'=> 'required',
            'position'=> 'required',
            'gender'=> 'required',
            'bday'=> 'required',
            'email'=> 'required',
            'address'=> 'required',
            'city'=> 'required',
            'contact'=> 'required'
            //'client',
            //'status'
        ]);
        if ($validation->fails())
        {
            return json_encode([
                'result' => 'failed', 
                'message' => 'Invalid Data Detected. Please try again. ',
                'error' => $validation->errors()->all()
            ]);
        }
        $newemployee = Employee::create($request->all());
        if($newemployee){
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
}
