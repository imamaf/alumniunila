<?php

namespace App\Http\Controllers;

use App\Users_Attribut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAttributsController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        // dd($users_attribut);
        if($users_attribut != null) {
            return 'Datanya ada';
        } else {

            return view('admin/crud/addAlumni' );
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users_Attribut  $users_Attribut
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $model = Post::find($id);
        // return view('/admin/detailUser',compact('model'));

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users_Attribut  $users_Attribut
     * @return \Illuminate\Http\Response
     */
    public function edit(Users_Attribut $users_Attribut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users_Attribut  $users_Attribut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users_Attribut $users_Attribut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users_Attribut  $users_Attribut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users_Attribut $users_Attribut)
    {
        //
    }
}
