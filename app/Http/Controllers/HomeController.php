<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use Auth;
use App\Hospital;
use App\Doctor;

class HomeController extends Controller
{
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
            $condition=['type'=>null];
            return view('home')->with(['total_users'=>User::count(),'total_roles'=>Role::where($condition)->count(),'total_permissions'=>Permission::where($condition)->count()]);
    }
}
