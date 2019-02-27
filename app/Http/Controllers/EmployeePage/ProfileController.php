<?php

namespace App\Http\Controllers\EmployeePage;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Model\Employee;
use App\Http\Model\Profile;
use Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
        $email = Auth::user()->email;

        $profiles = DB::table('profile')
            ->where('email', '=', $email)
            ->get();

        return view('profile', compact('profiles'));
    }

    // public function getProfile($id)
    // {
    //     $profile = DB::table('profile')
    //         ->where('id', $id)
    //         ->get();
            
    //     return json_encode([
    //         'profile' => $profile
    //     ]);
    // }

    public function getProfile($email) { 
        
        $email = Auth::user()->email;

        $profile =  Profile::where('email',$email)->get();
        return json_encode([
            'result' => 'success',
            'profile' => $profile
        ]);
      }
  
}
