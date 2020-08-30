<?php

namespace App\Http\Controllers;
use App\Users_Attribut;
use App\Tbl_jurusan;
use App\Tbl_kusioner;
use ConsoleTVs\Charts\Facades\Charts;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index() {
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
                $chart = 
               Charts::create('donut', 'highcharts')
               ->title('Grafik')
                ->labels(['Bekerja', 'Belum Bekerja', 'Melanjutkan Study'])
                ->values([$sdhKrjCount, $blmKrjCount,$lnjtStdCount])
                ->dimensions(600,300)
                ->responsive(false);
        return view('welcome' , compact('usrCount' , 'jrsanCount', 'blmKrjCount', 'sdhKrjCount' , 'lnjtStdCount', 'chart' ) );
    }
    //
}
