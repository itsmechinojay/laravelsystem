<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Model\Client;
use Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
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
        $clients = DB::table('client')
            ->paginate(500);

        return view('client', compact('clients'));
    }

    public function getAllClient()
    {
        $clientlist = Client::all();
        return json_encode([
            'result' => 'success',
            'client' => $clientlist
        ]);
    }

    public function getClient(Client $client)
    {
        return json_encode([
            'result' => 'success',
            'client' => $client
        ]);
    }

    public function createClient($id = 0, Request $request)
    {

        $validation = Validator::make($request->all(), [
            'clientname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact' => 'required'
        ]);
        if ($validation->fails()) {
            return json_encode([
                'result' => 'failed',
                'message' => 'Invalid Data Detected. Please try again. ',
                'error' => $validation->errors()->all()
            ]);
        }
        if ($id == 0) {
            $newclient = Client::create($request->all());
            $newAccount = User::create([
                'name' => $request['clientname'],
                'email' => $request['email'],
                'password' => Hash::make(1234),
                'type' => 'Client',
            ]);
            if ($newclient && $newAccount) {
                
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
            $updateClient = Client::where('id', $id)->update($request->except('_token'));
            if ($updateClient) {
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

    public function deleteClient(Request $request)
    {
        $client_id_array = $request->input('id');
        $delete_client = Client::where('id', $client_id_array)->delete();
        if ($delete_client) {
            return json_encode(array('result' => 'success', 'message' => 'Client successfully deleted.'));
        }
    }
}
