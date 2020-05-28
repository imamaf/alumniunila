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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Tambah Data Alumni </button>
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
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
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
                        <img src="" class="img-thumbnail"  id='img-upload' style="width : 150px; heigth: 150px"/>
                        @endif
                        @if($users_attribut == null)
                        <img class="img-thumbnail"  id='img-upload' style="width : 150px; heigth: 150px"/>
                        @endif
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat lahir" name="tempat_lahir" value="">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

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
                                    Browse… <input type="file" id="imgInp" name="path_foto" class="custom-file-input" required>
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        @if($users_attribut != null)
                        <img src="" class="img-thumbnail"  id='img-upload' style="width : 150px; heigth: 150px"/>
                        @endif
                        @if($users_attribut == null)
                        <img class="img-thumbnail"  id='img-upload' style="width : 150px; heigth: 150px"/>
                        @endif
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat lahir" name="tempat_lahir" value="">
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
                $('#action').attr('action' , '/update-data-jurusan/' + tour_id);
                $('#alamat').val(data.alamat);
                $('#jenis_kelamin').val(data.jenis_kelamin);
                $('#jurusan_prodi').val(data.jurusan_prodi);
                $('#nama').val(data.nama);
                $('#no_hp').val(data.no_hp);
                $('#status').val(data.status);
                $('#tempat_bekerja').val(data.tempat_bekerja);
                $('#tempat_lahir').val(data.tempat_lahir);
                $('#tgl_lahir').val(data.tgl_lahir);
                $('#th_lulus').val(data.th_lulus.substring(0,4));
                $('#th_masuk').val(data.th_masuk.substring(0,4));
                $('#waktu_lulus_bekerja').val(data.waktu_lulus_bekerja.substring(0,4));
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
    });
</script>

@endsection