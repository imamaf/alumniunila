<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Users_Attribut;
use PDF;
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
        $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        return view('admin/dashboard' ,['users_attribut' => $users_attribut] );
    }


    //Detail Userr
    public function detailUser() {
        $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        if($users_attribut != null) {
            return view('admin.detail-user' , ['users_attribut' => $users_attribut]);
        } else {
            // dd($users_attribut);
            return view('admin.detail-user' , ['users_attribut' => $users_attribut]);
        }
    }

    public function viewDataJurusan() {
    $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        $users_attributAll = Users_Attribut::all();
        return view('admin.jurusan' , ['users_attribut' => $users_attribut, 'users_attributAll' => $users_attributAll]);
    }

    public function viewDataAlumni() {
        $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        $users_attributAll = Users_Attribut::all();
        if($users_attribut != null) {
            return view('admin.alumni' , ['users_attribut' => $users_attribut, 'users_attributAll' => $users_attributAll]);
        } else {
            return view('admin.alumni' , ['users_attribut' => $users_attribut, 'users_attributAll' => $users_attributAll])->with('status' , 'Anda Belum menambahkan data anda');
        }
    }

    public function generatePDF()

    {
        $data = ['title' => 'Welcome to belajarphp.net'];

        $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();

        $pdf = PDF::loadView('user-detail-PDF', ['users_attribut' => $users_attribut]);
        return $pdf->download('laporan-pdf.pdf');
    }
}
