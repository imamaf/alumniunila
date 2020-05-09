<?php

namespace App\Http\Controllers;

use App\Users_Attribut;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
      * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function AddUserAlumni(Request $request)
    { 
        $id = auth()->user()->id;
        $path = $request->file('path_foto')->store('foto_users');
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        if($users_attribut != null) {
            Storage::delete($users_attribut->path_foto);
            User::where('id' , $id)
            ->update([
                'name' => $request->nama,
            ]);
            Users_Attribut::where('id' , $id)
            ->update([
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'status' => $request->status,
                'no_hp' => $request->no_hp,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'jurusan_prodi' => $request->jurusan_prodi,
                'th_masuk' => $request->th_masuk,
                'th_lulus' => $request->th_lulus,
                'tempat_bekerja' => $request->tempat_bekerja,
                'waktu_lulus_bekerja' => $request->waktu_lulus_bekerja,
                'path_foto' =>$path,
            ]);
             return redirect('/alumni')->with('status' , 'Data berhasil di update');
       } else {
            User::where('id' , $id)
            ->update([
                'name' => $request->nama,
            ]);
            Users_Attribut::create([
                'id' => $id, 
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'status' => $request->status,
                'no_hp' => $request->no_hp,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'jurusan_prodi' => $request->jurusan_prodi,
                'th_masuk' => $request->th_masuk,
                'th_lulus' => $request->th_lulus,
                'tempat_bekerja' => $request->tempat_bekerja,
                'waktu_lulus_bekerja' => $request->waktu_lulus_bekerja,
                'path_foto' =>$path,
            ]);
            return redirect('/alumni')->with('status' , 'Data berhasil ditambahkan');
       }
        //  view('admin/dashboard' );
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
    public function edit(string $id )
    {
        $id = auth()->user()->id;
        $usr_attr = DB::table('users_attributs')->where('id', $id)->first();
        return view('admin/crud/edit-user/forms-edit-user', ['usr_attr'=>$usr_attr]);

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
    public function deleteUser(Users_Attribut $users_Attribut)
    {
        Storage::delete($users_Attribut->path_foto);
        $users_Attribut->delete();
        return redirect('/alumni')->with('status' , 'Data berhasil dihapus');
        //
    }
}
