<?php

namespace App\Http\Controllers;

use App\Users_Attribut;
use App\User;
use App\Tbl_kusioner;
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
        // UPDATE DATA ALUMNI
        $id = auth()->user()->id;
        $path = null;
        if(empty($request->path_foto)) {
            $path;
        } else {
            $path = $request->file('path_foto')->store('foto_users');
        }
        $checkPath = null;
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
                'th_masuk' => $request->th_masuk != null ?  $request->th_masuk.'-01-01' :   $request->th_masuk,
                'th_lulus' => $request->th_lulus != null ? $request->th_lulus.'-01-01' : $request->th_lulus,
                'tempat_bekerja' => $request->tempat_bekerja,
                'waktu_lulus_bekerja' => $request->waktu_lulus_bekerja != null ? $request->waktu_lulus_bekerja.'-01-01' : $request->waktu_lulus_bekerja,
                'path_foto' =>$path,
            ]);
            if($request->detailUser == 'detailUser') {
                return redirect('/detail-user')->with('status' , 'Data berhasil di update');
            } else {
                return redirect('/alumni')->with('status' , 'Data berhasil di update');
            }
       } else {
           // TAMBAH DATA ALUMNI
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
                'th_masuk' => $request->th_masuk != null ? $request->th_masuk.'-01-01': $request->th_masuk,
                'th_lulus' => $request->th_lulus != null ? $request->th_lulus.'-01-01': $request->th_lulus,
                'tempat_bekerja' => $request->tempat_bekerja,
                'waktu_lulus_bekerja' => $request->waktu_lulus_bekerja != null ?  $request->waktu_lulus_bekerja.'-01-01': $request->waktu_lulus_bekerja,
                'path_foto' =>$path,
            ]);
            Tbl_kusioner::create([
                'user_id' => $id,
                'pertanyaan_1' => $request->pertanyaan_1 ,
                'pertanyaan_2' => $request->pertanyaan_2,
                'pertanyaan_3' => $request->pertanyaan_3,
                'pertanyaan_4' => $request->pertanyaan_4,
                'pertanyaan_5' => $request->pertanyaan_5,
                'pertanyaan_6' => $request->pertanyaan_6,
                'pertanyaan_7' => $request->pertanyaan_7,
                'pertanyaan_8' => $request->pertanyaan_8,
                'pertanyaan_9' => $request->pertanyaan_9,
                'pertanyaan_10' => $request->pertanyaan_10,
                'pertanyaan_11' => $request->pertanyaan_11,
                'pertanyaan_12' => $request->pertanyaan_12,
                'pertanyaan_13' => $request->pertanyaan_13,
                'pertanyaan_14' => $request->pertanyaan_14,
                'pertanyaan_15' => $request->pertanyaan_15,
                'pertanyaan_16' => $request->pertanyaan_16,
                'pertanyaan_17' => $request->pertanyaan_17,
                'pertanyaan_18' => $request->pertanyaan_18,
                'pertanyaan_19' => $request->pertanyaan_19,
                'pertanyaan_20' => $request->pertanyaan_20,
                'pertanyaan_21' => $request->pertanyaan_21,
                'pertanyaan_22' => $request->pertanyaan_22,
                'pertanyaan_23' => $request->pertanyaan_23,
                'pertanyaan_24' => $request->pertanyaan_24,
                'pertanyaan_25' => $request->pertanyaan_25,
                'pertanyaan_26' => $request->pertanyaan_26,
                'pertanyaan_27' => $request->pertanyaan_27,
                'pertanyaan_28' => $request->pertanyaan_28,
                'pertanyaan_29'  => $request->pertanyaan_30
            ]);
            return redirect('/alumni')->with('status' , 'Data berhasil ditambahkan');
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
        $tbl_kusioner = Tbl_kusioner::where('user_id' , $users_Attribut->id)->first();
        $users_Attribut->delete();
        $tbl_kusioner->delete();
        return redirect('/alumni')->with('status' , 'Data berhasil dihapus');
        //
    }

        // GET DATA Alumni BY ID
        public function getAlumniById(Request $request)
        {
            $data = Users_Attribut::find($request->id);
            return $data;
        }
}
