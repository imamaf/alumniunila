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
                        <button class="btn btn-primary open_modal_add" data-toggle="modal" data-target="#ModalAddAlumni">Tambah Data Alumni </button>
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
<!-- Modal Tambah -->
    <div class="modal fade" id="ModalAddAlumni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="js-title-step" style="margin-top: 0; font-size: 18px;"></h4>
            </div>
            <div class="modal-body">
                <div class="row hide" data-step="1" data-title="Input Data Alumni">
                    <div class="form-group">
                        <label>Upload Image</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" id="imgInp" name="path_foto" class="custom-file-input" required>
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
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat lahir" name="tempat_lahir" value="<?php echo $users_attribut == null ? "" : $users_attribut->tempat_lahir?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control date" id="tgl_lahir" placeholder="Tanggal lahir" name="tgl_lahir" value="">
                        <script type="text/javascript">
                            $('.date').datepicker({  
                            format: 'yyyy-mm-dd'
                            });  
                        </script>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" value="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_hp" placeholder="No.handphone" name="no_hp" value="">
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
                    </div>
                    <div class="form-group">                          
                        <input type="text" class="form-control date" id="th_lulus" placeholder="Tahun Lulus" name="th_lulus" value="">
                        <script type="text/javascript">
                            $('.date').datepicker({  
                            format: "yyyy", viewMode: "years", minViewMode: "years",
                            });  
                        </script>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="status" placeholder="status" name="status" value="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="tempat_bekerja" placeholder="tempat bekerja" name="tempat_bekerja" value="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control date" id="waktu_lulus_bekerja" placeholder="Waktu Lulus Bekerja" name="waktu_lulus_bekerja" value="">
                        <script type="text/javascript">
                            $('.date').datepicker({  
                            format: "yyyy", viewMode: "years", minViewMode: "years",
                            });  
                        </script>
                    </div>
                </div>
                <div class="row hide" data-step="2" data-title="Kuisioner Alumni Universitas Lampung">
                    <div class="jumbotron" style="padding: 10px">
                        <ol>
                            <li>Sebutkan sumber dana dalam pembiayaan kuliah?
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Biaya sendiri / keluarga</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Beasiswa adik</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Beasiswa bidikmisi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Beasiswa PPA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Beasiswa afirmasi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Beasiswa perusahaan / swasta</label>
                                </div>
                            </li>
                            <li>Kapan anda mulai mencari pekerjaan?</li>
                            <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Sebelum Wisuda</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Sesudah Wisuda</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Saya tidak mencari pekerjaan</label>
                                </div>
                               
                            <li>Bagaimana anda mencari pekerjaan tersebut</li>
                            <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Membangun Bisnis sendiri</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Melalui iklan koran/majalah</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Pergi ke bursa/pameran kerja</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Mencari leat internet</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Dihubungi oleh perusahaan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Menghubungi Kemnakerstrans</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Menghubungi agent tenaga kerja</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Memproleh informasi dari kantor pengembangan karis fakultas dan Universitas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Menghubungi kantor kemahasiswaan / alumni</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Membangun jaringan sejak masaa kuliah</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Melalui relasi (keluarga, teman , dosen dll</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Melalui penempatan kerja / magang</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="#" id="#" value="#">
                                    <label class="form-check-label">Bekerja ditempat yang sama semasa kuliah</label>
                                </div>
                            <li>Kapan anda memperoleh pekerjaan pertama</li>
                            <input type="text" class="form-control" id="tempat_bekerja" placeholder="Silahkan diisi" name="tempat_bekerja" value="">
                            <li>Apakah saat ini anda bekerja/berwirausaha</li>
                            <input type="text" class="form-control" id="tempat_bekerja" placeholder="Silahkan diisi" name="tempat_bekerja" value="">
                        </ol>
                    </div>
                </div>
                <div class="row hide" data-step="3" data-title="Kuisioner Alumni Universitas Lampung">
                    <div class="jumbotron">Kuisioner Alumni Universitas Lampung</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default js-btn-step pull-left" data-orientation="cancel" data-dismiss="modal"></button>
                <button type="button" class="btn btn-warning js-btn-step" data-orientation="previous"></button>
                <button type="button" id="nexBtn" class="btn btn-success js-btn-step submit_step" data-orientation="next"></button>
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
                                    Browse… <input type="file" id="imgInp2" name="path_foto" class="custom-file-input" required>
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
    
 
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../assets/js/modal-steps.min.js"></script>
    <script>
    // $('#ModalAddAlumni').modalSteps();
    $('#ModalAddAlumni').modalSteps({
    btnCancelHtml: "Tutup",
    btnPreviousHtml: "Kembali",
    btnNextHtml: "Selanjutnya",
    btnLastStepHtml : "Simpan",
    disableNextButton: false,
    completeCallback: function() {},
    callbacks: {},
    getTitleAndStep: function() {}
});
$(document).on('click', '.submit_step', function(data) {
    console.log('dataaa' , data);
    // console.log('testttt ' , document.getElementById("nextBtn").innerHTML = "none");
    console.log('aaa ');

    });
    </script>
    <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);
    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    </script>

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
                $('#action').attr('action' , '/update-data-jurusan/' + tour_id);
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
    });
</script>

@endsection