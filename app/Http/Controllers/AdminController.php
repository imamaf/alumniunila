<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Users_Attribut;
use App\Tbl_jurusan;
use App\Tbl_kusioner;
use PDF;
use Illuminate\View\Middleware\ShareErrorsFromSession;
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
        $userCount = Users_Attribut::get();
        $jurusanCount = Tbl_jurusan::get();
        $belumBekerjaCount = Tbl_kusioner::where('pertanyaan_12' , 'Tidak Bekerja')->get();
        $sudahBekerjaCount = Tbl_kusioner::where('pertanyaan_12' , 'Bekerja')->get();
        $lanjutStudyCount = Tbl_kusioner::where('pertanyaan_27' , 'Saya masih beljar/melanjutkan kuliah profesi / pascasarjana')->get();
        $usrCount = count($userCount);
        $jrsanCount = count($jurusanCount);
        $blmKrjCount = count($belumBekerjaCount);
        $sdhKrjCount = count($sudahBekerjaCount);
        $lnjtStdCount = count($lanjutStudyCount);
        return view('admin/dashboard' , compact('usrCount' , 'jrsanCount', 'blmKrjCount', 'sdhKrjCount' , 'lnjtStdCount' ),['users_attribut' => $users_attribut] );
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
        $jurusans = Tbl_jurusan::paginate(5);
        return view('admin.jurusan' , ['users_attribut' => $users_attribut , 'jurusans' => $jurusans]);
    }

    public function viewDataAlumni() {
        $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        $users_attributAll = Users_Attribut::latest()->paginate(5);
        $jurusans = Tbl_jurusan::select('nama_jurusan')->get();
        if($users_attribut != null) {
            return view('admin.alumni' , ['users_attribut' => $users_attribut, 'users_attributAll' => $users_attributAll, 'jurusans' => $jurusans]);
        } else {
            return view('admin.alumni' , ['users_attribut' => $users_attribut, 'users_attributAll' => $users_attributAll, 'jurusans' => $jurusans])->with('status' , 'Anda Belum menambahkan data anda');
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
    public function viewPDF()
    {
        $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        return view('user-detail-PDF' , ['users_attribut' => $users_attribut]);
    }

    function pdf(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->viewPDF())->setPaper('legal', 'potrait');
        return $pdf->stream();
    }

    public function search(Request $request , string $pathSearch){
        $cari = $request->cari;
        $id = auth()->user()->id;
        $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
        //SEARCH ALUMNI
        if($pathSearch == 'Detail'){
            $users_attribut = DB::table('users_attributs')->where('nama','ILIKE' ,"%".strtolower($cari)."%")->where('id', $id)->first();
            if($cari != '') {
                if(empty($users_attribut)) {
                    //MESSAGE
                    return view('admin.detail-user' , ['users_attribut' => $users_attribut])->with('notFound','Data Tidak ditemukan');
                }
                return view('admin.detail-user' , ['users_attribut' => $users_attribut]);
            }
             else {
                $users_attribut = DB::table('users_attributs')->where('id', $id)->first();
                return view('admin.detail-user' , ['users_attribut' => $users_attribut]);
            }
        } 
        //SEARCH ALUMNI
        if($pathSearch == 'Alumni'){
            $users_attributAll = DB::table('users_attributs')->where('nama','ILIKE' ,"%".strtolower($cari)."%")
            ->paginate(5);
            $jurusans = Tbl_jurusan::select('nama_jurusan')->get();
            if($cari != '') {
                if(count($users_attributAll) == 0) {
                    //MESSAGE
                    return view('admin.alumni',['users_attribut'=> $users_attribut , 'users_attributAll'=> $users_attributAll , ])->with('notFound','Data Tidak ditemukan');
                }
                return view('admin.alumni',['users_attribut'=> $users_attribut , 'users_attributAll'=> $users_attributAll , 'jurusans' => $jurusans]);
            } else {
                $users_attributAll = Users_Attribut::latest()->paginate(5);
                return view('admin.alumni',['users_attribut'=> $users_attribut , 'users_attributAll'=> $users_attributAll , 'jurusans'=> $jurusans]);
            }   
        } 
        // SEACRH DATA JURUSAN/PRODI
        if($pathSearch == 'Jurusan'){
            $jurusans = DB::table('tbl_jurusans')->where('nama_jurusan','ILIKE' ,"%".strtolower($cari)."%")
            ->paginate(5);
            if($cari != '') {
                    if(count($jurusans) == 0) {
                        //MESSAGE
                        return view('admin.jurusan',['users_attribut'=> $users_attribut , 'jurusans'=> $jurusans])->with('notFound','Data Tidak ditemukan');
                    }
                return view('admin.jurusan',['users_attribut'=> $users_attribut , 'jurusans'=> $jurusans]);
            } else {
                $jurusans = Tbl_jurusan::paginate(5);
                return view('admin.jurusan',['users_attribut'=> $users_attribut , 'jurusans'=> $jurusans]);
            }   

        } 

    }
}