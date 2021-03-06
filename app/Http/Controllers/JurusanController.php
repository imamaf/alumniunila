<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Users_Attribut;
use App\Tbl_jurusan;
use Response;


class JurusanController extends Controller
{
    public function create(Request $request ) {
        Tbl_jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'kode_jurusan' => $request->kode_jurusan,
            'akreditas' => $request->akreditas,
            'th_akreditas' => $request->th_akreditas.'-01-01',
        ]);
        return redirect('/jurusan')->with('status' , 'Data berhasil ditambahkan');
    }
    
    public function update(Request $request, Tbl_jurusan $tbl_jurusan ) {
        Tbl_jurusan::where('id' , $tbl_jurusan->id)
        ->update([
            'nama_jurusan' => $request->nama_jurusan,
            'kode_jurusan' => $request->kode_jurusan,
            'akreditas' => $request->akreditas,
            'th_akreditas' => $request->th_akreditas.'-01-01',
        ]);
        return redirect('/jurusan')->with('status' , 'Data berhasil di update');
    }

    
    public function delete(Tbl_jurusan $tbl_jurusan) {
        $tbl_jurusan->delete();
        return redirect('/jurusan')->with('status' , 'Data berhasil dihapus');
    }

    public function edit($id) {
        $jurusans = DB::table('tbl_jurusans')->where('id', $id)->first();
        // dd($jurusans);
        return Response::json($jurusans);
    }

    // GET JURUSAN BY ID
    public function getJurusanById(Request $request)
    {
        $data = Tbl_jurusan::find($request->id);
        return $data;
    }

}
