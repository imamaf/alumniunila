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
        $user_attribut = DB::table('user_attributs')->where('id', $id)->first();
        if($user_attribut != null) {
            return view('admin/detailUser' , ['users_attribut' => $user_attribut]);
        } else {
            return 'Data Belum Tersedia';
        }
    }

}
