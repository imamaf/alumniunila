@extends('layouts.master')


@section('title')
    Alumni | Alumni Unila
@endsection

@section('header')
    Alumni
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header" style="display: flex;">  
                    <h5 class="card-title">Detail Profil</h5> 
                  <!-- STATUS MESSAGE -->
                    @if (session('status'))
                    <p style="color : green">
                        {{ session('status') }}
                    </p>
                    @endif
                    @if($users_attribut == null)
                    <p style="color: red;">Infomarsi : Anda belum menambahkan data pribadi anda </p>
                    <div class="tambah" style="margin-left: auto;">
                    <button class="btn btn-primary"><a href="{{url('/dashboard')}}" style="color:white;">Kembali </a></button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAddAlumni">Tambah </button>
                    </div>
                    @endif
                    @if($users_attribut != null)    
                        <div class="tambah" style="margin-left: auto;">
                            <button class="btn btn-primary">
                            <a href="{{url('/laporan-pdf')}}" style="color:white;">Cetak </a>
                             </button>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAddAlumni">Edit </button>
                        </div>
                    </div>      
                    <form>
                    <div class="container-fluid">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->nama}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->tempat_lahir}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tangggal Lahir</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->tgl_lahir}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->alamat}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">No Hp</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->no_hp}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Jurusan</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->jurusan_prodi}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tahun Masuk</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{substr($users_attribut->th_masuk,0,4)}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tahun Lulus</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{substr($users_attribut->th_lulus,0,4)}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword"  value="{{$users_attribut->status}}"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tempat Bekerja</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->tempat_bekerja}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Waktu Lulus Kerja</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{substr($users_attribut->waktu_lulus_bekerja,0,4)}}">
                            </div>
                        </div>
                    </form>
                    @endif
            </div>
        </div>
    </div>
    <section>
<!-- Modal -->
<div class="modal fade" id="ModalAddAlumni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $users_attribut == null ? "Tambah Data" : "Update Data"?></h5>
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
                        <input type="hidden" id="detailUser" name="detailUser" value="detailUser">
                            <div class="form-group">
                            <input type="text" required class="form-control" id="nama" placeholder="nama" name="nama" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" required class="form-control" id="tempat_lahir" placeholder="tempat lahir" name="tempat_lahir" value="<?php echo $users_attribut == null ? "" : $users_attribut->tempat_lahir?>">
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control date" id="tgl_lahir" placeholder="Tanggal Lahir" name="tgl_lahir" value="{{$users_attribut->tgl_lahir == null ? : $users_attribut->tgl_lahir }}">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: 'yyyy-mm-dd'
                                });  
                            </script>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" id="alamat" placeholder="Alamat" name="alamat" value="<?php echo $users_attribut == null ? "" : $users_attribut->alamat  ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" id="no_handphone" placeholder="No.handphone" name="no_hp" value="<?php echo $users_attribut == null ? "" : $users_attribut->no_hp  ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" id="jurusan_prodi" placeholder="Jurusan" name="jurusan_prodi" value="<?php echo $users_attribut == null ? "" : $users_attribut->jurusan_prodi  ?>">
                        </div>
                        <div class="form-group">
                        <input type="text" required class="form-control date" id="th_masuk" placeholder="Tahun Masuk" name="th_masuk" value="{{$users_attribut->th_masuk == null ? : substr($users_attribut->th_masuk , 0 , 4) }}">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: "yyyy", viewMode: "years", minViewMode: "years",
                                });  
                            </script>
                        </div>
                        <div class="form-group">
                        <input type="text" required class="form-control date" id="th_lulus" placeholder="Tahun Lulus" name="th_lulus" value="{{$users_attribut->th_lulus == null ? : substr($users_attribut->th_lulus , 0 , 4) }}">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: "yyyy", viewMode: "years", minViewMode: "years",
                                });  
                            </script>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" id="status" placeholder="Status" name="status" value="<?php echo $users_attribut == null ? "" : $users_attribut->status  ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" id="tempat_bekerja" placeholder="Tempat Bekerja" name="tempat_bekerja" value="<?php echo $users_attribut == null ? "" : $users_attribut->tempat_bekerja ?>">
                        </div>
                        <div class="form-group">
                        <input type="text" required class="form-control date" id="waktu_lulus_bekerja" placeholder="Waktu Lulus Kerja" name="waktu_lulus_bekerja" value="{{$users_attribut->waktu_lulus_bekerja == null ? : substr($users_attribut->waktu_lulus_bekerja , 0 , 4) }}">
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                format: "yyyy", viewMode: "years", minViewMode: "years",
                                });  
                            </script>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')

@endsection