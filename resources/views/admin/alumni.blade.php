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
                    <h5 class="card-title">Data Alumni</h5>                   
                    @if ($users_attribut !== null)
                    <div class="tambah" style="margin-left: auto;">
                    <a href="{{url('/detail-user')}}">
                        <button class="btn btn-primary">Detail</button>
                        </a>
                    </div>
                   @endif
                   @if ($users_attribut === null)
 
                    <div class="tambah" style="margin-left: auto;">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAddAlumni">Tambah </button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                @if ($users_attribut === null)
                    <p style="color: red;">Andah belum menambahkan data anda </p>
                @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Nama</th>
                                <th>Jurusan/Prodi</th>
                                <th>Tahun Masuk</th>
                                <th>Tahun Lulus</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($users_attributAll as $usr_Attr_all)
                                <tr>
                                    <td>{{$usr_Attr_all->nama}}</td>
                                    <td>{{$usr_Attr_all->jurusan_prodi}}</td>
                                    <td>{{$usr_Attr_all->th_masuk}}</td>
                                    <td>{{$usr_Attr_all->th_lulus}}</td>
                                    <td><a href="">view<a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalAddAlumni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                @if($users_attribut != null)
                    <form action="{{url('/add-alumni')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="{{$users_attribut->nama}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tempat_lahir" placeholder="tempat lahir" name="tempat_Lahir" value="{{$users_attribut->tempat_lahir}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tgl_lahir" placeholder="tanggal lahir" name="tgl_lahir" value="{{$users_attribut->tgl_lahir}}">
                        </div>
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="alamat" placeholder="alamat" name="alamat" value="{{$users_attribut->alamat}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="no_handphone" placeholder="no.handphone" name="no_hp" value="{{$users_attribut->no_hp}}">
                        </div>
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="jurusan" placeholder="jurusan" name="jurusan_prodi" value="{{$users_attribut->jurusan_prodi}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tahun_masuk" placeholder="tahun masuk" name="th_masuk" value="{{$users_attribut->th_masuk}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tahun_lulus" placeholder="tahun lulus" name="th_lulus" value="{{$users_attribut->th_lulus}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="status" name="status" value="{{$users_attribut->status}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="tempat bekerja" name="tempat_bekerja" value="{{$users_attribut->tempat_bekerja}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="waktu lulus kerja" name="waktu_lulus_bekerja" value="{{$users_attribut->waktu_lulus_bekerja}}">
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="path_foto" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection