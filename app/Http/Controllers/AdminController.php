<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
    
    public function index() {
        return view('admin/dashboard');
    }


    //Detail User
    public function detailUser() {
        $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        if($users_attribut != null) {
            return view('admin/detailUser' , ['users_attribut' => $users_attribut]);
        } else {
            return 'Data Belum Tersedia';
        }
    }

}
