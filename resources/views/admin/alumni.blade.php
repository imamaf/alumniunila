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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAddAlumni">Tambah Data Alumni </button>
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
                                        <a data-toggle="modal" data-target="#ModalDetailAlumni" href="#" class="btn btn-view"><i class="far fa-eye"></i><a>
                                        <a data-toggle="modal" data-target="#ModalAddAlumni" href="#" class="btn btn-edit"><i class="far fa-edit"></i><a>
                                        <a data-toggle="modal" data-target="#exampleModalCenter" href="#" class="btn btn-delete"><i class="far fa-trash-alt"></i><a>
                                    </td>
                                    @endif
                                    @if($usr_Attr_all->nama !== Auth::user()->name )
                                    <td>
                                    <a data-toggle="modal" data-target="#ModalDetailAlumni" href="#" class="btn btn-view"><i class="far fa-eye"></i><a>
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
<!-- Modall -->
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
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tempat_lahir" placeholder="tempat lahir" name="tempat_lahir" value="<?php echo $users_attribut == null ? "" : $users_attribut->tempat_lahir?>">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tgl_lahir" placeholder="tanggal lahir" name="tgl_lahir" value="<?php echo $users_attribut == null ? "" : $users_attribut->tgl_lahir?>">
                        </div>
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="alamat" placeholder="alamat" name="alamat" value="<?php echo $users_attribut == null ? "" : $users_attribut->alamat  ?>">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="no_hp" placeholder="no.handphone" name="no_hp" value="<?php echo $users_attribut == null ? "" : $users_attribut->no_hp  ?>">
                        </div>
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="jurusan_prodi" placeholder="jurusan" name="jurusan_prodi" value="<?php echo $users_attribut == null ? "" : $users_attribut->jurusan_prodi  ?>">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="th_masuk" placeholder="tahun masuk" name="th_masuk" value="<?php echo $users_attribut == null ? "" : $users_attribut->th_masuk  ?>">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="th_lulus" placeholder="tahun lulus" name="th_lulus" value="<?php echo $users_attribut == null ? "" : $users_attribut->th_lulus  ?>">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="status" name="status" value="<?php echo $users_attribut == null ? "" : $users_attribut->status  ?>">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tempat_bekerja" placeholder="tempat bekerja" name="tempat_bekerja" value="<?php echo $users_attribut == null ? "" : $users_attribut->tempat_bekerja ?>">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="waktu_lulus_bekerja" placeholder="waktu lulus kerja" name="waktu_lulus_bekerja" value="<?php echo $users_attribut == null ? "" : $users_attribut->waktu_lulus_bekerja  ?>">
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



    <div class="modal fade" id="ModalDetailAlumni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->th_masuk}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tahun Lulus</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->th_lulus}}">
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
                            <input type="text" readonly class="form-control" id="inputPassword" value="{{$users_attribut->waktu_lulus_bekerja}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    $('.btnsearch').click(function(e){
               $("#searchmodal").modal('show');
     })
</script>
@section('scripts')

@endsection