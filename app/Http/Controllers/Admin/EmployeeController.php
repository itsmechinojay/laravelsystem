<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Model\Employee;
use Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

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

        return view('admin/employee', compact('employees'));
    }

    public function getAllEmployee()
    {
        $employeelist = Employee::all();
        return json_encode([
            'result' => 'success',
            'employee' => $employeelist
        ]);
    }

    public function getEmployee(Employee $employee)
    {
        return json_encode([
            'result' => 'success',
            'employee' => $employee
        ]);
    }


    public function getDeplyedEmployee()
    {
        $employee = DB::table('employee')
            ->where('Client', '=', "Deployed")
            ->get();
        return json_encode([
            'result' => 'success',
            'employeelist' => $employee
        ]);
    }

    public function getPendingEmployee()
    {
        $employee = DB::table('employee')
            ->where('Client', '=', "Pending")
            ->get();
        return json_encode([
            'result' => 'success',
            'employeelist' => $employee
        ]);
    }

    public function createEmployee($id = 0, Request $request)
    {

        $validation = Validator::make($request->all(), [
            'lastname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'position' => 'required',
            'gender' => 'required',
            'bday' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact' =>['required', 'string', 'max:255'],
        ]);
        if ($validation->fails()) {
            return json_encode([
                'result' => 'failed',
                'message' => 'Invalid Data Detected. Please try again. ',
                'error' => $validation->errors()->all()
            ]);
        }
        if ($id == 0) {
            $newemployee = Employee::create([
                'lastname' => $request['lastname'],
                'firstname' => $request['firstname'],
                'middlename' => $request['middlename'],
                'position' => $request['position'],
                'gender' => $request['gender'],
                'bday' => $request['bday'],
                'email' => $request['email'],
                'address' => $request['address'],
                'city' => $request['city'],
                'contact' => $request['contact'],
                'client' => 'Pending',
                'status' => '1',
            ]);

            $newAccount = User::create([
                'name' => $request['Lastname'],
                'email' => $request['email'],
                'password' => Hash::make(1234),
                'type' => 'Employee',
            ]);
            if ($newemployee && $newAccount) {

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
        } else {
            $updateEmployee = Employee::where('id', $id)->update($request->except('_token'));
            if ($updateEmployee) {
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

    public function deleteEmployee(Request $request)
    {
        $employee_id_array = $request->input('id');
        $delete_employee = Employee::where('id', $employee_id_array)->delete();
        if ($delete_employee) {
            return json_encode(array('result' => 'success', 'message' => 'employee successfully deleted.'));
        }
    }
}
