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
        $profiles = DB::table('profile')
            ->paginate(500);

        return view('profile', compact('profiles'));
    }

    /**
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param $email
     *
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return User::with('profile')->wherename($name)->firstOrFail();
    }

    /**
     * Display the specified resource.
     *
     * @param string $name
     *
     * @return Response
     */
    public function show($email)
    {
        try {
            $emai = $this->getUserByName($name);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
        $currentClient = Profile::find($name->profile->client);
        $data = [
            'name' => $name,
            'currentClient' => $currentClient,
        ];
        return view('profile')->with($data);
    }

}
