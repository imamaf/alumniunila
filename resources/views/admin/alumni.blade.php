@extends('layouts.master')


@section('title')
    Alumni | Alumni Unila
@endsection

@section('header')
Alumni
@endsection

@section('cari')
Alumni
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex;">
                    <h5 class="card-title">Data Alumni</h5>               
                   @if ($users_attribut === null)
 
                    <div class="tambah" style="margin-left: auto;">
                        <button class="btn btn-primary open_modal_add" onclick="myFunction()" data-toggle="modal" data-target="#myModal1">Tambah Data Alumni </button>
                    </div>
                    @endif
                </div>
                <!-- STATUS MESSAGE -->
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (session('error') || !empty($notFound) )
                    <div class="alert alert-danger" role="alert">
                       <?php echo !empty($error) ? $error:$notFound ?>
                    </div>
                    @endif    
                <div class="card-body">
                @if ($users_attribut === null)
                    <p style="color: red;">Infomarsi : Anda belum menambahkan data pribadi anda </p>
                @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jurusan/Prodi</th>
                                <th>Tahun Masuk</th>
                                <th>Tahun Lulus</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($users_attributAll as $result => $usr_Attr_all)
                                @if($usr_Attr_all->nama === Auth::user()->name)
                                <tr style="color:red">
                                @endif
                                @if($usr_Attr_all->nama !== Auth::user()->name)
                                <tr>
                                @endif
                                    <td>{{$result + $users_attributAll->firstitem()}}</td>
                                    <td>{{$usr_Attr_all->nama}}</td>
                                    <td>{{$usr_Attr_all->jurusan_prodi}}</td>
                                    <td>{{substr($usr_Attr_all->th_masuk,0,4)}}</td>
                                    <td>{{substr($usr_Attr_all->th_lulus,0 ,4 )}}</td>
                                    @if($usr_Attr_all->nama === Auth::user()->name )
                                    <td>
                                        <a data-toggle="modal" value="{{$usr_Attr_all->id}}" href="#" class="btn btn-view open_modal_view"><i class="far fa-eye"></i><a>
                                        <a data-toggle="modal" value="{{$usr_Attr_all->id}}" href="#" class="btn btn-edit open_modal_update"><i class="far fa-edit"></i><a>
                                        <a data-toggle="modal" data-target="#modal-info" href="#" class="btn btn-delete"><i class="far fa-trash-alt"></i><a>
                                    </td>
                                    @endif
                                    @if($usr_Attr_all->nama !== Auth::user()->name )
                                    <td>
                                    <a data-toggle="modal" value="{{$usr_Attr_all->id}}" href="#" class="btn btn-view open_modal_view"><i class="far fa-eye"></i><a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users_attributAll->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>
 <!-- Alert -->
 @section('message')
    Apakah Anda yakin ingin menghapus data ini ?
@endsection
 @section('url')
 /delete-user/{{Auth::user()->id}}
@endsection
 @include('layouts.alert-modal')
<!-- end alert -->

<!-- MODAL TAMBAH  -->
<form id="actionTambah" action="" method="POST" enctype="multipart/form-data">
@csrf
@method('put')
<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Biodata Alumni</h4>
         </div>
         <div class="modal-body">
                <fieldset style="display: block;">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Step 1 / 4</h3>
                            <p>Lengkapi data berikut !</p>
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse… <input type="file" required id="imgInp" name="path_foto" class="custom-file-input" required>
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                            @if($users_attribut != null)
                            <img src="storage/<?php echo $users_attribut->path_foto ?>" class="img-thumbnail"  id='img-upload' style="width : 150px; heigth: 150px"/>
                            @endif
                            @if($users_attribut == null)
                            <img class="img-thumbnail"  id='img-upload' style="width : 150px; heigth: 150px"/>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="{{ Auth::user()->name }}">
                            <span id='messageNama'></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat lahir" name="tempat_lahir" value="<?php echo $users_attribut == null ? "" : $users_attribut->tempat_lahir?>">
                            <span id='messageTempat_lahir'></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control date" id="tgl_lahir" placeholder="Tanggal lahir" name="tgl_lahir" value="">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: 'yyyy-mm-dd'
                                });  
                            </script>
                            <span id='messageTgl_lahir'></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" value="">
                            <span id='messageAlamat'></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="no_hp" placeholder="No.handphone" name="no_hp" value="">
                            <span id='messageNo_hp'></span>
                        </div>
                        <div class="form-group">
                            <select class="form-control" placeholder="Jurusan" id="exampleFormControlSelect1" name="jurusan_prodi" value="">
                                <option>lainnya</option>
                                @foreach($jurusans as $js)
                                <?php echo $users_attribut != null && $users_attribut->jurusan_prodi  === $js->nama_jurusan ? "<option selected> $users_attribut->jurusan_prodi</option>" : "<option> $js->nama_jurusan</option>" ?>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control date" id="th_masuk" placeholder="Tahun Masuk" name="th_masuk" value="">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: "yyyy", viewMode: "years", minViewMode: "years",
                                });  
                            </script>
                            <span id='messageTh_masuk'></span>
                        </div>
                        <div class="form-group">                          
                            <input type="text" class="form-control date" id="th_lulus" placeholder="Tahun Lulus" name="th_lulus" value="">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: "yyyy", viewMode: "years", minViewMode: "years",
                                });  
                            </script>
                            <span id='messageTh_lulus'></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="status" placeholder="status" name="status" value="">
                            <span id='messageStatus'></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tempat_bekerja" placeholder="tempat bekerja" name="tempat_bekerja" value="">
                            <span id='messageTempat_bekerja'></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control date" id="waktu_lulus_bekerja" placeholder="Waktu Lulus Bekerja" name="waktu_lulus_bekerja" value="">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: "yyyy", viewMode: "years", minViewMode: "years",
                                });  
                            </script>
                            <span id='messageWaktu_lulus_bekerja'></span>
                        </div>
                    </div>
                </fieldset>
            </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default btn-prev">Kembali</button>
            <button type="button" id="btnNext" class="btn btn-default btn-next">Selanjutnya</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Form Kusioner</h4>
         </div>
         <div class="modal-body">
            <div class="form-top">
                <div class="form-top-left">
                    <h3>Step 2 / 4</h3>
                    <p>Isilah form kusioner ini dengan jawaban yang tepat:</p>
                </div>
            </div>         
            <div class="jumbotron" style="padding: 10px">
                    
                    <!-- PERTANYAA 1 -->
                        <li>Sebutkan sumber dana dalam pembiayaan kuliah?
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_1" id="pertanyaan_1" value="Biaya sendiri / keluarga">
                                <label class="form-check-label">Biaya sendiri / keluarga</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_1" id="pertanyaan_1" value="Beasiswa adik">
                                <label class="form-check-label">Beasiswa adik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_1" id="pertanyaan_1" value="Beasiswa bidikmisi">
                                <label class="form-check-label">Beasiswa bidikmisi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_1" id="pertanyaan_1" value="Beasiswa PPA">
                                <label class="form-check-label">Beasiswa PPA</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_1" id="pertanyaan_1" value="Beasiswa afirmasi">
                                <label class="form-check-label">Beasiswa afirmasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_1" id="pertanyaan_1" value="Beasiswa perusahaan / swasta">
                                <label class="form-check-label">Beasiswa perusahaan / swasta</label>
                            </div>
                        </li>
                        <!-- <span id='message_pertanyaan_1'></span> -->
                        <!-- PERTANYAA 2 -->
                        <li>Menurut anda seberepa besar penekanan pada metode pembelajaran dibawah ini dilaksana di program studi anda?</li>
                        <input type="text" class="form-control" id="pertanyaan_2" placeholder="Silahkan diisi" name="pertanyaan_2" value="">
                        <span id='message_pertanyaan_2'></span>
                        <!-- PERTANYAA 3 -->
                        <li>Kapan anda mulai mencari pekerjaan?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_3" id="pertanyaan_3" value="Sebelum Wisuda">
                                <label class="form-check-label">Sebelum Wisuda</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_3" id="3" value="Sesudah Wisuda">
                                <label class="form-check-label">Sesudah Wisuda</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_3" id="pertanyaan_3" value="Saya tidak mencari pekerjaan">
                                <label class="form-check-label">Saya tidak mencari pekerjaan</label>
                            </div>
                        <!-- PERTANYAA 4 -->  
                        <li>Berapa Lama sebelum wisuda?</li>
                        <input type="text" class="form-control" id="pertanyaan_4" placeholder="Silahkan diisi" name="pertanyaan_4" value="">
                        <span id='message_pertanyaan_4'></span>
                        <!-- PERTANYAA 5 -->
                        <li>Bagaimana anda mencari pekerjaan tersebut</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Membangun Bisnis sendiri">
                                <label class="form-check-label">Membangun Bisnis sendiri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Melalui iklan koran/majalah">
                                <label class="form-check-label">Melalui iklan koran/majalah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Pergi ke bursa/pameran kerja">
                                <label class="form-check-label">Pergi ke bursa/pameran kerja</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Mencari leat internet">
                                <label class="form-check-label">Mencari leat internet</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Dihubungi oleh perusahaan<">
                                <label class="form-check-label">Dihubungi oleh perusahaan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Menghubungi Kemnakerstrans">
                                <label class="form-check-label">Menghubungi Kemnakerstrans</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Menghubungi agent tenaga kerja">
                                <label class="form-check-label">Menghubungi agent tenaga kerja</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Memproleh informasi dari kantor pengembangan karis fakultas dan Universitas">
                                <label class="form-check-label">Memproleh informasi dari kantor pengembangan karis fakultas dan Universitas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Menghubungi kantor kemahasiswaan / alumni">
                                <label class="form-check-label">Menghubungi kantor kemahasiswaan / alumni</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Membangun jaringan sejak masaa kuliah">
                                <label class="form-check-label">Membangun jaringan sejak masaa kuliah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Melalui relasi (keluarga, teman , dosen dll">
                                <label class="form-check-label">Melalui relasi (keluarga, teman , dosen dll</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Melalui penempatan kerja / magang">
                                <label class="form-check-label">Melalui penempatan kerja / magang</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="Bekerja ditempat yang sama semasa kuliah">
                                <label class="form-check-label">Bekerja ditempat yang sama semasa kuliah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_5" id="pertanyaan_5" value="lain - lain">
                                <label class="form-check-label">lain - lain</label>
                            </div>
                            <!-- PERTANYAAN 6 -->
                        <li>Berapa perusahaan instansi , intitusi , yang sudah anda lamar (termasuk lewat surat atau email) Sebelum anda bekerja</li>
                            <input type="text" class="form-control" id="pertanyaan_6" placeholder="Silahkan diisi" name="pertanyaan_6" value="">
                            <span id='message_pertanyaan_6'></span>
                            <!-- PERTANYAAN 7 -->
                        <li>Berapa banyak perusahaan, instansi, instusi yang merespon lamaran anda?</li>
                            <input type="text" class="form-control" id="pertanyaan_7" placeholder="Silahkan diisi" name="pertanyaan_7" value="">
                            <span id='message_pertanyaan_7'></span>
                            <!-- PERTANYAAN 8 -->
                            <!-- PERTANYAAN 9 -->
                        <li>Berapa banyak perusahaan, instansi, instusi yang mengundang anda untuk wawancara?</li>
                        <input type="text" class="form-control" id="pertanyaan_9" placeholder="Silahkan diisi" name="pertanyaan_9" value="">
                        <span id='message_pertanyaan_9'></span>
                        <!-- PERTANYAAN 10 -->
                        <li>Kapan anda memperoleh pekerjaan pertama</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_10" id="pertanyaan_10" value="Sebelum Wisuda">
                                <label class="form-check-label">Sebelum Wisuda</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_10" id="pertanyaan_10" value="Sesudah Wisuda">
                                <label class="form-check-label">Sesudah Wisuda</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_10" id="pertanyaan_10" value="Saya tidak mencari pekerjaan">
                                <label class="form-check-label">Saya tidak mencari pekerjaan</label>
                            </div>
                    
                </div>
            </div> 
              
         <div class="modal-footer">
            <button type="button" class="btn btn-default btn-prev">Kembali</button>
            <button type="button" class="btn btn-default btn-next">Selanjutnya</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Form Kusioner</h4>
         </div>
         <div class="modal-body">
            <div class="form-top">
                <div class="form-top-left">
                    <h3>Step 3 / 4</h3>
                    <p>Isilah form kusioner ini dengan jawaban yang tepat:</p>
                </div>
            </div>         
            <div class="jumbotron" style="padding: 10px">
                    <!-- PERTANYAA 11 -->
                        <li>Berapa bulan sebelum/sesudah wisuda?</li>
                        <input type="text" class="form-control" id="pertanyaan_11" placeholder="Silahkan diisi" name="pertanyaan_11" value="">
                        <span id='message_pertanyaan_11'></span>
                        <!-- PERTANYAA 12 -->
                        <li>Apakah saat ini anda bekerja/berwirausaha?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_12" id="pertanyaan_12" value="Bekerja">
                                <label class="form-check-label">Bekerja</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_12" id="pertanyaan_12" value="Berwirausaha">
                                <label class="form-check-label">Berwirausaha</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_12" id="pertanyaan_12" value="Tidak Bekerja">
                                <label class="form-check-label">Tidak Bekerja</label>
                            </div>
                        <!-- PERTANYAA 13 -->
                        <li>Apa jenis perusahaan instansi, instusi tempat anda bekerja sekarang?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_13" id="pertanyaan_13" value="instansi pemerintah (termasuk BUMN)</">
                                <label class="form-check-label">instansi pemerintah (termasuk BUMN)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_13" id="pertanyaan_13" value="organisasi non profit, lembaga swadaya masyarakat">
                                <label class="form-check-label">organisasi non profit, lembaga swadaya masyarakat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_13" id="pertanyaan_13" value="wiraswasta, perusahaan sendiri">
                                <label class="form-check-label">wiraswasta, perusahaan sendiri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_13" id="pertanyaan_13" value="lain - lain">
                                <label class="form-check-label">lain - lain</label>
                            </div>
                        <!-- PERTANYAA 14 -->  
                        <li>Nama perusahaan? (mohon disi jika bekerja)</li>
                        <input type="text" class="form-control" id="pertanyaan_14" placeholder="Silahkan diisi" name="pertanyaan_14" value="">
                        <span id='message_pertanyaan_14'></span>
                        <!-- PERTANYAA 15 -->
                        <li>Nama antasan langsung?</li>
                        <input type="text" class="form-control" id="pertanyaan_15" placeholder="Silahkan diisi" name="pertanyaan_15" value="">
                        <span id='message_pertanyaan_15'></span>
                            <!-- PERTANYAAN 16 -->
                        <li>Nomor WA atasan langsung?</li>
                            <input type="text" class="form-control" id="pertanyaan_16" placeholder="Silahkan diisi" name="pertanyaan_16" value="">
                        <span id='message_pertanyaan_16'></span>
                            <!-- PERTANYAAN 17 -->
                        <li>Email atasan langsung?</li>
                        <input type="text" class="form-control" id="pertanyaan_17" placeholder="Silahkan diisi" name="pertanyaan_17" value="">
                        <span id='message_pertanyaan_17'></span>
                        <!-- PERTANYAAN 18 -->
                        <li>Perusahaan tempat anda bekerja bergerak dibidang apa?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Kegiatan badan internasional dan badan ekstra internasional">
                                <label class="form-check-label">Kegiatan badan internasional dan badan ekstra internasional</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Pengadaan air, pengelola sampah, dan daur ulang, pembuangan dan pembersuhan limbah dan sampah">
                                <label class="form-check-label">Pengadaan air, pengelola sampah, dan daur ulang, pembuangan dan pembersuhan limbah dan sampah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Pertambangan dan penggalian">
                                <label class="form-check-label">Pertambangan dan penggalian</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Jasa pelayanan yang melayani rumah tangga">
                                <label class="form-check-label">Jasa pelayanan yang melayani rumah tangga</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Jasa profesional, ilmiah dan teknis">
                                <label class="form-check-label">Jasa profesional, ilmiah dan teknis</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Kebudayaan, hiburan, dan rekreasi">
                                <label class="form-check-label">Kebudayaan, hiburan, dan rekreasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Jasa persewaan ketenagakerjaan , agen perjalanan dan penunjang usaha lainnya">
                                <label class="form-check-label">Jasa persewaan ketenagakerjaan , agen perjalanan dan penunjang usaha lainnya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Real estate">
                                <label class="form-check-label">Real estate</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Transportasi dan pegudangan">
                                <label class="form-check-label">Transportasi dan pegudangan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Informasi dan komunikasi">
                                <label class="form-check-label">Informasi dan komunikasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Pengadaan lisrik, gas, uap air panas dan dingin">
                                <label class="form-check-label">Pengadaan lisrik, gas, uap air panas dan dingin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Industri pengolahan">
                                <label class="form-check-label">Industri pengolahan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Penyedia akomodasi dan penyediaan makan dan minum">
                                <label class="form-check-label">Penyedia akomodasi dan penyediaan makan dan minum</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Administrasi pemerintah, pertahanan dan jaminan sosial">
                                <label class="form-check-label">Administrasi pemerintah, pertahanan dan jaminan sosial</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="egiatan jasa lainnya">
                                <label class="form-check-label">Kegiatan jasa lainnya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Pertanian, kehutanan, dan perikanan">
                                <label class="form-check-label">Pertanian, kehutanan, dan perikanan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Jasa kesehatan dan kegiatan sosial">
                                <label class="form-check-label">Jasa kesehatan dan kegiatan sosial</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Konstruksi">
                                <label class="form-check-label">Konstruksi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Perdagangan besar dan eceran, reparasi perawatan mobil dan motor">
                                <label class="form-check-label">Perdagangan besar dan eceran, reparasi perawatan mobil dan motor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Jasa keuangan dan asuransi">
                                <label class="form-check-label">Jasa keuangan dan asuransi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="Jasa pendidikan">
                                <label class="form-check-label">Jasa pendidikan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_18" id="pertanyaan_18" value="lain - lain">
                                <label class="form-check-label">lain - lain</label>
                            </div>
                         <!-- PERTANYAAN 19 -->
                         <li>Kira-kira berapa pendapatan anda disetiap bulannya dari pekerjaan utama?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_19" id="pertanyaan_19" value="Rp 0 - Rp 1.000.0000">
                                <label class="form-check-label">Rp 0 - Rp 1.000.0000 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_19" id="pertanyaan_19" value="Rp 1.000.000 - Rp 3.000.0000">
                                <label class="form-check-label">Rp 1.000.000 - Rp 3.000.0000</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_19" id="pertanyaan_19" value="Rp 3.000.000 - Rp 5000.0000">
                                <label class="form-check-label">Rp 3.000.000 - Rp 5000.0000</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_19" id="pertanyaan_19" value="Rp 5.000.000 - Rp 10.000.0000">
                                <label class="form-check-label">Rp 5.000.000 - Rp 10.000.0000</label>
                            </div>
                         <!-- PERTANYAAN 20 -->
                         <li>Kira-kira berapa pendapatan anda setiap bulannya dari lembur dan tips?</li>
                         <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_20" id="pertanyaan_20" value="Rp 0 - Rp 1.000.0000">
                                <label class="form-check-label">Rp 0 - Rp 1.000.0000 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_20" id="pertanyaan_20" value="Rp 1.000.000 - Rp 3.000.0000">
                                <label class="form-check-label">Rp 1.000.000 - Rp 3.000.0000</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_20" id="pertanyaan_20" value="Rp 3.000.000 - Rp 5000.0000">
                                <label class="form-check-label">Rp 3.000.000 - Rp 5000.0000</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_20" id="pertanyaan_20" value="Rp 5.000.000 - Rp 10.000.0000">
                                <label class="form-check-label">Rp 5.000.000 - Rp 10.000.0000</label>
                            </div>
                        
                </div>
            </div> 
         <div class="modal-footer">
            <button type="button" class="btn btn-default btn-prev">Kembali</button>
            <button type="button" class="btn btn-default btn-next">Selanjutnya</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">form Kusioner 4</h4>
         </div>
         <div class="modal-body">
            <div class="form-top">
                <div class="form-top-left">
                    <h3>Step 4 / 4</h3>
                    <p>Isilah form kusioner ini dengan jawaban yang tepat:</p>
                </div>
            </div>         
            <div class="jumbotron" style="padding: 10px">
                    <!-- PERTANYAA 21 -->
                        <li>Kira-kira berapa pendapatan anda setiap bulannya dari pekerjaan lainnya?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_21" id="pertanyaan_21" value="Rp 0 - Rp 1.000.0000">
                                <label class="form-check-label">Rp 0 - Rp 1.000.0000 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_21" id="pertanyaan_21" value="Rp 1.000.000 - Rp 3.000.0000">
                                <label class="form-check-label">Rp 1.000.000 - Rp 3.000.0000</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_21" id="pertanyaan_21" value="Rp 3.000.000 - Rp 5000.0000">
                                <label class="form-check-label">Rp 3.000.000 - Rp 5000.0000</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_21" id="pertanyaan_21" value="Rp 5.000.000 - Rp 10.000.0000">
                                <label class="form-check-label">Rp 5.000.000 - Rp 10.000.0000</label>
                            </div>
                        <!-- PERTANYAA 22 -->
                        <li>Seberapa erat hubungan antara bidang studi dengan pekerjaan anda?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_22" id="pertanyaan_22" value="Sangat erat">
                                <label class="form-check-label">Sangat erat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_22" id="pertanyaan_22" value="Erat">
                                <label class="form-check-label">Erat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_22" id="pertanyaan_22" value="Cukup erat">
                                <label class="form-check-label">Cukup erat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_22" id="pertanyaan_22" value="Kurang erat">
                                <label class="form-check-label">Kurang erat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_22" id="pertanyaan_22" value="Tidak erat sama sekali">
                                <label class="form-check-label">Tidak erat sama sekali</label>
                            </div>
                        <!-- PERTANYAA 23 -->
                        <li>Tingkat pendidikan apa yang paling tepat/sesuai untuk pekrjaan anda saat ini?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_23" id="pertanyaan_23" value="setingkat lebih tinggi">
                                <label class="form-check-label">setingkat lebih tinggi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_23" id="pertanyaan_23" value="tingkat yang sama<">
                                <label class="form-check-label">tingkat yang sama</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_23" id="pertanyaan_23" value="setingkat lebih rendah">
                                <label class="form-check-label">setingkat lebih rendah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_23" id="pertanyaan_23" value="tidak perlu pendidikan tinggi">
                                <label class="form-check-label">tidak perlu pendidikan tinggi</label>
                            </div>
                        <!-- PERTANYAA 24 -->  
                        <li>Jika menurut anda pekerjaan saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Pertanyaan tidak sesuai">
                                <label class="form-check-label">Pertanyaan tidak sesuai</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="saya belum mendapatkan pekerjaan yang sesuai">
                                <label class="form-check-label">saya belum mendapatkan pekerjaan yang sesuai</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Diperkerjaan ini saya mendapatkan prospek kerja yang baik">
                                <label class="form-check-label">Diperkerjaan ini saya mendapatkan prospek kerja yang baik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Saya lebih suka dia area pekerjaan yang tidak ada hubungannya diarea pekerjaan saya</">
                                <label class="form-check-label">Saya lebih suka dia area pekerjaan yang tidak ada hubungannya diarea pekerjaan saya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Saya dipromosikan posisi yang kurang berhubungan dengan pendidikan saya">
                                <label class="form-check-label">Saya dipromosikan posisi yang kurang berhubungan dengan pendidikan saya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Saya dapat memperoleh pendapatan yang lebih tinggi dari pekerjaan ini">
                                <label class="form-check-label">Saya dapat memperoleh pendapatan yang lebih tinggi dari pekerjaan ini</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Pekerjaan saya saat ini lebih aman/terjamin/secure">
                                <label class="form-check-label">Pekerjaan saya saat ini lebih aman/terjamin/secure</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Pekerjaan saya saat ini lebih menarik">
                                <label class="form-check-label">Pekerjaan saya saat ini lebih menarik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Pekerjaan saya saat ini memungkinkan saya mendapatkan pekerjaaan tambahan/jadwal yang lebih fleksibel">
                                <label class="form-check-label">Pekerjaan saya saat ini memungkinkan saya mendapatkan pekerjaaan tambahan/jadwal yang lebih fleksibel</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Pekerjaan saat in lebih dekat lokasinya dari rumah saya<">
                                <label class="form-check-label">Pekerjaan saat in lebih dekat lokasinya dari rumah saya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Pekerjaan saa saat ini lebih menjamin kebutuhan keluarga saya">
                                <label class="form-check-label">Pekerjaan saa saat ini lebih menjamin kebutuhan keluarga saya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_24" id="pertanyaan_24" value="Pada awal meniti karir saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya">
                                <label class="form-check-label">Pada awal meniti karir saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya</label>
                            </div>
                    
                        <!-- PERTANYAA 25 -->
                        <li>Usaha anda saat ini bergerak pada bidang apa?</li>
                            <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Kegiatan badan internasional dan badan ekstra internasional">
                                    <label class="form-check-label">Kegiatan badan internasional dan badan ekstra internasional</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Pengadaan air, pengelola sampah, dan daur ulang, pembuangan dan pembersuhan limbah dan sampah">
                                    <label class="form-check-label">Pengadaan air, pengelola sampah, dan daur ulang, pembuangan dan pembersuhan limbah dan sampah</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Pertambangan dan penggalian">
                                    <label class="form-check-label">Pertambangan dan penggalian</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Jasa pelayanan yang melayani rumah tangga">
                                    <label class="form-check-label">Jasa pelayanan yang melayani rumah tangga</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Jasa profesional, ilmiah dan teknis">
                                    <label class="form-check-label">Jasa profesional, ilmiah dan teknis</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Kebudayaan, hiburan, dan rekreasi">
                                    <label class="form-check-label">Kebudayaan, hiburan, dan rekreasi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Jasa persewaan ketenagakerjaan , agen perjalanan dan penunjang usaha lainnya">
                                    <label class="form-check-label">Jasa persewaan ketenagakerjaan , agen perjalanan dan penunjang usaha lainnya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Real estate">
                                    <label class="form-check-label">Real estate</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Transportasi dan pegudangan">
                                    <label class="form-check-label">Transportasi dan pegudangan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Informasi dan komunikasi">
                                    <label class="form-check-label">Informasi dan komunikasi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Pengadaan lisrik, gas, uap air panas dan dingin">
                                    <label class="form-check-label">Pengadaan lisrik, gas, uap air panas dan dingin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Industri pengolahan">
                                    <label class="form-check-label">Industri pengolahan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Penyedia akomodasi dan penyediaan makan dan minum">
                                    <label class="form-check-label">Penyedia akomodasi dan penyediaan makan dan minum</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Administrasi pemerintah, pertahanan dan jaminan sosial">
                                    <label class="form-check-label">Administrasi pemerintah, pertahanan dan jaminan sosial</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="egiatan jasa lainnya">
                                    <label class="form-check-label">Kegiatan jasa lainnya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Pertanian, kehutanan, dan perikanan">
                                    <label class="form-check-label">Pertanian, kehutanan, dan perikanan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Jasa kesehatan dan kegiatan sosial">
                                    <label class="form-check-label">Jasa kesehatan dan kegiatan sosial</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Konstruksi">
                                    <label class="form-check-label">Konstruksi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Perdagangan besar dan eceran, reparasi perawatan mobil dan motor">
                                    <label class="form-check-label">Perdagangan besar dan eceran, reparasi perawatan mobil dan motor</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Jasa keuangan dan asuransi">
                                    <label class="form-check-label">Jasa keuangan dan asuransi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="Jasa pendidikan">
                                    <label class="form-check-label">Jasa pendidikan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pertanyaan_25" id="pertanyaan_25" value="lain - lain">
                                    <label class="form-check-label">lain - lain</label>
                                </div>
                            <!-- PERTANYAAN 26 -->
                        <li>Kira-kira pendapatan usaha anda setiap bulannya?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_26" id="pertanyaan_26" value="Rp 0 - Rp 1.000.0000">
                                <label class="form-check-label">Rp 0 - Rp 1.000.0000 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_26" id="pertanyaan_26" value="Rp 1.000.000 - Rp 3.000.0000">
                                <label class="form-check-label">Rp 1.000.000 - Rp 3.000.0000</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_26" id="pertanyaan_26" value="Rp 3.000.000 - Rp 5000.0000">
                                <label class="form-check-label">Rp 3.000.000 - Rp 5000.0000</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_26" id="pertanyaan_26" value="Rp 5.000.000 - Rp 10.000.0000">
                                <label class="form-check-label">Rp 5.000.000 - Rp 10.000.0000</label>
                            </div>
                            <!-- PERTANYAAN 27 -->
                        <li>Bagaimana anda menggambarkan situasi anda saat  ini?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_27" id="pertanyaan_27" value="Saya masih beljar/melanjutkan kuliah profesi / pascasarjana">
                                <label class="form-check-label">Saya masih beljar/melanjutkan kuliah profesi / pascasarjana</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_27" id="pertanyaan_27" value="Saya menikah">
                                <label class="form-check-label">Saya menikah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_27" id="pertanyaan_27" value="Saya sibuk dengan keluarga dan anak-anak">
                                <label class="form-check-label">Saya sibuk dengan keluarga dan anak-anak</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_27" id="pertanyaan_27" value="Saya sibuk dengan keluarga dan anak-anak">
                                <label class="form-check-label">Saya sibuk dengan keluarga dan anak-anak</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_27" id="pertanyaan_27" value="Lain - lain">
                                <label class="form-check-label">Lain - lain </label>
                            </div>
                          
                            <!-- PERTANYAAN 28 -->
                            <li>Apakah anda aktif mencari pekerjaan dalam 4 minggu terakhir?</li>
                        <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_28" id="pertanyaan_28" value="Tidak">
                                <label class="form-check-label">Tidak</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_28" id="pertanyaan_28" value="Tidak, tapi saya sedang menunggu hasil lamaran saya">
                                <label class="form-check-label">Tidak, tapi saya sedang menunggu hasil lamaran saya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_28" id="pertanyaan_28" value="Ya, saya akan mulai bekerja 2 minggu ke depan">
                                <label class="form-check-label">Ya, saya akan mulai bekerja 2 minggu ke depan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_28" id="pertanyaan_28" value="Ya, tapi saya belum pasti akan bekerja 2 minggu kedepan">
                                <label class="form-check-label">Ya, tapi saya belum pasti akan bekerja 2 minggu kedepan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pertanyaan_28" id="pertanyaan_28" value="Lain - lain">
                                <label class="form-check-label">Lain - lain</label>
                            </div>
                            <!-- <input type="text" class="form-control" id="pertanyaan_28" placeholder="Lain - lain" name="pertanyaan_28" value=""> -->
                            <!-- PERTANYAAN 29 -->
                        <li>Pada saat lulus, pada tingkat mana kompetensi dibawah ini anda kuasai? Pada saat ini, pada tingkat mana kompetensi dibawah ini diperlukan dalam pekerjaan?</li>
                        <input type="text" class="form-control" id="pertanyaan_29" placeholder="Silahkan diisi" name="pertanyaan_29" value="">
                        <span id='message_pertanyaan_29'></span>
                </div>
            </div> 
         <div class="modal-footer">
            <button type="button" class="btn btn-default btn-prev">Kembali</button>
            <button type="button" class="btn btn-default btn-submit-simpan">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

         </div>
      </div>
   </div>
</div>
</form>


<!-- Modall Update -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{url('/add-alumni')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Upload Image</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" id="imgInp2" name="path_foto" class="custom-file-input">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <img class="img-thumbnail"  id='img-upload2' style="width : 150px; heigth: 150px"/>
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="nama_update" placeholder="Nama" name="nama" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tempat_lahir_update" placeholder="Tempat lahir" name="tempat_lahir" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control date" id="tgl_lahir_update" placeholder="Tanggal lahir" name="tgl_lahir" value="">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: 'yyyy-mm-dd'
                                });  
                            </script>
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="alamat_update" placeholder="Alamat" name="alamat" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="no_hp_update" placeholder="No.handphone" name="no_hp" value="">
                        </div>
                        <div class="form-group">
                            <select class="form-control" placeholder="Jurusan" id="jurusan_prodi_update" name="jurusan_prodi" value="">
                            <option>lainnya</option>
                            @foreach($jurusans as $js)
                            <?php echo $users_attribut != null && $users_attribut->jurusan_prodi  === $js->nama_jurusan ? "<option selected> $users_attribut->jurusan_prodi</option>" : "<option> $js->nama_jurusan</option>" ?>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <input type="text" class="form-control date" id="th_masuk_update" placeholder="Tahun Masuk" name="th_masuk" value="">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: "yyyy", viewMode: "years", minViewMode: "years",
                                });  
                            </script>
                        </div>
                        <div class="form-group">                          
                        <input type="text" class="form-control date" id="th_lulus_update" placeholder="Tahun Lulus" name="th_lulus" value="">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: "yyyy", viewMode: "years", minViewMode: "years",
                                });  
                            </script>
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status_update" placeholder="status" name="status" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tempat_bekerja_update" placeholder="tempat bekerja" name="tempat_bekerja" value="">
                        </div>
                        <div class="form-group">
                        <input type="text" class="form-control date" id="waktu_lulus_bekerja_update" placeholder="Waktu Lulus Bekerja" name="waktu_lulus_bekerja" value="">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: "yyyy", viewMode: "years", minViewMode: "years",
                                });  
                            </script>
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<!-- MODAL VIEW  -->
    <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="container-fluid">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="nama_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="tempat_lahir_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tangggal Lahir</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="tgl_lahir_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="alamat_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">No Hp</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="no_hp_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Jurusan</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="jurusan_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tahun Masuk</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="th_masuk_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tahun Lulus</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="th_lulus_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="status_view"  value=""> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tempat Bekerja</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="tempat_bekerja_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Waktu Lulus Kerja</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="waktu_lulus_bekerja_view" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
    .modal {
    overflow-y:auto;
    }
    
    </style>

</section>
@endsection
@section('scripts')

<script>
$(document).ready(function(){
   $(document).on('click', '.open_modal_update', function() {
            var url = "/getAlumniById";
            var tour_id = $(this).attr("value");
                console.log('id : ', tour_id);
            $.get(url + '/' + tour_id, function(data) {
                //success data
                console.log('data : ', data);
                console.log('data img-upload2 : ', $('#img-upload2'));
                // $('#action').attr('actionUpdate' , '/update-data-jurusan/' + tour_id);
                $('#alamat_update').val(data.alamat);
                document.getElementById("img-upload2").src="storage/" + data.path_foto;
                $('#jenis_kelamin_update').val(data.jenis_kelamin);
                $('#jurusan_prodi_update').val(data.jurusan_prodi);
                $('#nama_update').val(data.nama);
                $('#no_hp_update').val(data.no_hp);
                $('#status_update').val(data.status);
                $('#tempat_bekerja_update').val(data.tempat_bekerja);
                $('#tempat_lahir_update').val(data.tempat_lahir);
                $('#tgl_lahir_update').val(data.tgl_lahir);
                $('#th_lulus_update').val(data.th_lulus.substring(0,4));
                $('#th_masuk_update').val(data.th_masuk.substring(0,4));
                $('#waktu_lulus_bekerja_update').val(data.waktu_lulus_bekerja.substring(0,4));
                $('#btn-save').val("update");
                $('#modalEdit').modal('show');
            })
        });
   $(document).on('click', '.open_modal_view', function() {
            var url = "/getAlumniById";
            var tour_id = $(this).attr("value");
                console.log('id : ', tour_id);
            $.get(url + '/' + tour_id, function(data) {
                //success data
                console.log('data : ', data);
                $('#alamat_view').val(data.alamat);
                $('#jenis_kelamin_view').val(data.jenis_kelamin);
                $('#jurusan_view').val(data.jurusan_prodi);
                $('#nama_view').val(data.nama);
                $('#no_hp_view').val(data.no_hp);
                $('#status_view').val(data.status);
                $('#tempat_bekerja_view').val(data.tempat_bekerja);
                $('#tempat_lahir_view').val(data.tempat_lahir);
                $('#tgl_lahir_view').val(data.tgl_lahir);
                $('#th_lulus_view').val(data.th_lulus.substring(0,4));
                $('#th_masuk_view').val(data.th_masuk.substring(0,4));
                $('#waktu_lulus_bekerja_view').val(data.waktu_lulus_bekerja.substring(0,4));
                $('#btn-save').val("update");
                $('#ModalView').modal('show');
            })
        });
        $(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});
		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload2').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#imgInp2").change(function(){
		    readURL(this);
        }); 
        
        // js MODAL NEX STEP
        $("div[id^='myModal']").each(function(){
  
            var currentModal = $(this);
            
            //click next
            currentModal.find('.btn-next').click(function(){
                currentModal.modal('hide');
                currentModal.closest("div[id^='myModal']").nextAll("div[id^='myModal']").first().modal('show'); 
            });
            
            //click prev
            currentModal.find('.btn-prev').click(function(){
                currentModal.modal('hide');
                currentModal.closest("div[id^='myModal']").prevAll("div[id^='myModal']").first().modal('show'); 
            });
        });

        $(document).on('click', '.btn-submit-simpan', function() {
                    console.log('button submit' );
                    $('#actionTambah').attr('action' , '/add-alumni');
                    document.getElementById("actionTambah").submit(); 
         });

         function myFunction() {
             console.log('aaaa');

		}

         $(document).on('click', $('#myModal1'), function () {
            // this.myFunction();
            //  $('#btnNext').prop('disabled', true); 
             $('#nama, #tempat_lahir, #tgl_lahir ,#status ,#no_hp ,#alamat , #th_masuk , #th_lulus , #tempat_bekerja, #waktu_lulus_bekerja ,#pertanyaan_1, #pertanyaan_2 , #pertanyaan_4 , #pertanyaan_6 , #pertanyaan_7 , #pertanyaan_9 , #pertanyaan_11 , #pertanyaan_14 , #pertanyaan_15 , #pertanyaan_16 , #pertanyaan_17 , #pertanyaan_29'  ).on('keyup', function () {
                // $('#btnNext').prop('disabled', true); 
            if ($('#nama').val() == null || $('#nama').val() == '' ) {
                $('#messageNama').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#messageNama').css('display', 'none');
            }
            if ($('#tempat_lahir').val() == null || $('#tempat_lahir').val() == '' ) {
                $('#messageTempat_lahir').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#messageTempat_lahir').css('display', 'none');
            }
            if ($('#tgl_lahir').val() == null || $('#tgl_lahir').val() == '' ) {
                $('#messageTgl_lahir').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#messageTgl_lahir').css('display', 'none');
            }
            if ($('#status').val() == null || $('#status').val() == '' ) {
                $('#messageStatus').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#messageStatus').css('display', 'none');
            }
            if ($('#no_hp').val() == null || $('#no_hp').val() == '' ) {
                $('#messageNo_hp').html('Kolom ini wajib diisi (menggunakan numeric)').css({"color":"red" , "display" : "block"});
            } else {
                $('#messageNo_hp').css('display', 'none');
            }
            if ($('#alamat').val() == null || $('#alamat').val() == '' ) {
                $('#messageAlamat').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#messageAlamat').css('display', 'none');
            }
            if ($('#th_masuk').val() == null || $('#th_masuk').val() == '' ) {
                $('#messageTh_masuk').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#messageTh_masuk').css('display', 'none');
            }
            if ($('#th_lulus').val() == null || $('#th_lulus').val() == '' ) {
                $('#messageTh_lulus').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#messageTh_lulus').css('display', 'none');
            }
            // if ($('#tempat_bekerja').val() == null || $('#tempat_bekerja').val() == '' ) {
            //     $('#messageTempat_bekerja').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            // } else {
            //     $('#messageTempat_bekerja').css('display', 'none');
            // }
            if ($('#waktu_lulus_bekerja').val() == null || $('#waktu_lulus_bekerja').val() == '' ) {
                $('#messageWaktu_lulus_bekerja').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#messageWaktu_lulus_bekerja').css('display', 'none');
            }
            // VALIDADATE FORM KUSIONER
            // if ($('#pertanyaan_1').val() == null || $('#pertanyaan_1').val() == '' ) {
            //     $('#message_pertanyaan_1').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            // } else {
            //     $('#message_pertanyaan_1').css('display', 'none');
            // }
            if ($('#pertanyaan_2').val() == null || $('#pertanyaan_2').val() == '' ) {
                $('#message_pertanyaan_2').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_2').css('display', 'none');
            }
            if ($('#pertanyaan_4').val() == null || $('#pertanyaan_4').val() == '' ) {
                $('#message_pertanyaan_4').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_4').css('display', 'none');
            }
            if ($('#pertanyaan_6').val() == null || $('#pertanyaan_6').val() == '' ) {
                $('#message_pertanyaan_6').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_6').css('display', 'none');
            }
            if ($('#pertanyaan_7').val() == null || $('#pertanyaan_7').val() == '' ) {
                $('#message_pertanyaan_7').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_7').css('display', 'none');
            }
            if ($('#pertanyaan_9').val() == null || $('#pertanyaan_9').val() == '' ) {
                $('#message_pertanyaan_9').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_9').css('display', 'none');
            }
            if ($('#pertanyaan_11').val() == null || $('#pertanyaan_11').val() == '' ) {
                $('#message_pertanyaan_11').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_11').css('display', 'none');
            }
            if ($('#pertanyaan_14').val() == null || $('#pertanyaan_14').val() == '' ) {
                $('#message_pertanyaan_14').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_14').css('display', 'none');
            }
            if ($('#pertanyaan_15').val() == null || $('#pertanyaan_15').val() == '' ) {
                $('#message_pertanyaan_15').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_15').css('display', 'none');
            }
            if ($('#pertanyaan_16').val() == null || $('#pertanyaan_16').val() == '' ) {
                $('#message_pertanyaan_16').html('Kolom ini wajib diisi (menggunakan numeric)').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_16').css('display', 'none');
            }
            if ($('#pertanyaan_17').val() == null || $('#pertanyaan_17').val() == '' ) {
                $('#message_pertanyaan_17').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_17').css('display', 'none');
            }
            if ($('#pertanyaan_29').val() == null || $('#pertanyaan_29').val() == '' ) {
                $('#message_pertanyaan_29').html('Kolom ini wajib diisi').css({"color":"red" , "display" : "block"});
            } else {
                $('#message_pertanyaan_29').css('display', 'none');
            }
        });
    });
                
    });
</script>

@endsection