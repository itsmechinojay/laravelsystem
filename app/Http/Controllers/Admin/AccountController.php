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
        $accountlist = User::all();
        return json_encode([
            'result' => 'success',
            'users' => $accountlist
        ]);
    }

    public function getAccount(User $account)
    {
        return json_encode([
            'result' => 'success',
            'users' => $account
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
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'type' => $data['type'],
            ]);
        } else {
            $updateAccount = User::where('id', $id)->update($request->except('_token'));
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

    public function deleteAccount(Request $request)
    {
        $account_id_array = $request->input('id');
        $delete_account = User::where('id', $account_id_array)->delete();
        if ($delete_accountt) {
            return json_encode(array('result' => 'success', 'message' => 'Account successfully deleted.'));
        }
    }
}

