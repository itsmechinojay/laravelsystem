<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class AccountController extends Controller
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
        $accounts = DB::table('users')
            ->paginate(500);

        return view('admin/account', compact('accounts'));
    }
    
    public function getAllAccount()
    {
         $accountlist = User::where('type', '!=', 'dev')
            ->get();
        return json_encode([
            'result' => 'success',
            'account' => $accountlist
        ]);
    }

    public function getAccount(Account $account)
    {
        return json_encode([
            'result' => 'success',
            'account' => $account
        ]);
    }

    public function createAccount($id = 0, Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'type' => ['required', 'string', 'max:255'],
        ]);
        if ($validation->fails()) {
            return json_encode([
                'result' => 'failed',
                'message' => 'Invalid Data Detected. Please try again. ',
                'error' => $validation->errors()->all()
            ]);
        }
        if ($id == 0) {
            return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'type' => $request['type'],
            ]);
        } else {
            $updateAccount = User::where('id', $id)->update('password'->Hash::make(1234));
            if ($updateAccount) {
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

    public function changePassword($id){
        
    }

    public function updateAccount($id)
    {
        $closeRequest = DB::table('users')
            ->where('id', $id)
            ->update(['password' => Hash::make(1234)]);
        if ($closeRequest) {
            return json_encode([
                'result' => 'success',
                'message' => 'Success update password'
            ]);
        } else {
            return json_encode([
                'result' => 'failed',
                'message' => 'Something problem'
            ]);
        }
    }

    public function getPassword(User $user)
    {
        return json_encode([
            'result' => 'success',
            'user' => $user
        ]);
    }

    public function resetPassword($id = 0, Request $request)
    {
        $updateAccount = User::where('id', $id)->update(['password'->Hash::make(1234)]);
        if ($updateAccount) {
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

    public function deleteAccount(Request $request)
    {
        $account_id_array = $request->input('id');
        $delete_account = User::where('id', $account_id_array)->delete();
        if ($delete_account) {
            return json_encode(array('result' => 'success', 'message' => 'Account successfully deleted.'));
        }
    }
}

