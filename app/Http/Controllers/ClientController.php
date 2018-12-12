<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Model\Client;
use Validator;

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
        
        return view('client',compact('clients'));
    }
    
    public function getClient(Client $employee){
		return json_encode([
			'result' => 'success',
			'client' => $client
		]);
    }
    
    public function createClient(Request $request){
		$validation = Validator::make($request->all(), [
            'clientname'=> 'required',
            'email'=> 'required',
            'address'=> 'required',
            'city'=> 'required',
            'contact'=> 'required'
        ]);
		if ($validation->fails())
        {
            return json_encode([
            	'result' => 'failed', 
            	'message' => 'Invalid Data Detected. Please try again. ',
            	'error' => $validation->errors()->all()
            ]);
		}
		$newclient = Client::create($request->all());
		if($newclient){
			return json_encode(array('result' => 'success', 'message' => 'Successfully Added!'));
		}
	}
}
