@extends('layouts.master')


@section('title')
    Jurusan/Prodi | Alumni Unila
@endsection

@section('header')
Jurusan/Prodi
@endsection

@section('cari')
Jurusan
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display:flex">
                    <h5 class="card-title">Data Jurusan/Prodi</h5>
                    <div class="tambah" style="margin-left: auto;">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAddData">Tambah Data Jurusan </button>
                    </div>
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No</th>
                                <th>Nama Jurusan/Prodi</th>
                                <th>Kode Jurusan/Prodi</th>
                                <th>Akreditas</th>
                                <th>Tahun Akreditas</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                            @foreach($jurusans as $result => $js)
                                <tr>
                                    <td>{{$result + $jurusans->firstitem()}}</td>
                                    <td>{{$js->nama_jurusan}}</td>
                                    <td>{{$js->kode_jurusan}}</td>
                                    <td>{{$js->akreditas}}</td>
                                    <td>{{$js->th_akreditas}}</td>
                                    <td>
                                        <a href="#" class="btn btn-view"><i class="far fa-eye"></i><a>
                                        <a data-toggle="modal" data-target="#ModalUpdateData" href="#" class="btn btn-edit"><i class="far fa-edit"></i><a>
                                        <a data-toggle="modal" data-target="#exampleModalCenter" href="#" class="btn btn-delete"><i class="far fa-trash-alt"></i><a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$jurusans->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--INCLUDE MODAL ALERT -->
@section('message')
    Apakah Anda yakin ingin menghapus data ini ?
@endsection
    @foreach($jurusans as $js)
        @section('url')
        /delete-data-jurusan/{{$js->id}}
        @endsection
    @endforeach
@include('layouts.alert-modal')
<!-- Modall UPDATE-->
@foreach($jurusans as $js)
<div class="modal fade" id="ModalUpdateData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form clas="form-modal" action= "/update-data-jurusan/{{$js->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="kode_jurusan" placeholder="Kode Jurusan/Prodi" name="kode_jurusan" value="{{$js->kode_jurusan}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="nama_jurusan" placeholder="Nama Jurusan/Prodi" name="nama_jurusan" value="{{$js->nama_jurusan}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="akreditas" placeholder="Akreditas" name="akreditas" value="{{$js->akreditas}}">
                        </div>
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="th_akreditas" placeholder="Tahun Akreditas" name="th_akreditas" value="{{$js->th_akreditas}}">
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
    @endforeach
<!-- MODAL TAMBAH DATA JURUSAN  -->
    <div class="modal fade" id="ModalAddData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form clas="form-modal" action= "{{url('/add-data-jurusan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="kode_jurusan" placeholder="Kode Jurusan/Prodi" name="kode_jurusan" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="nama_jurusan" placeholder="Nama Jurusan/Prodi" name="nama_jurusan" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="akreditas" placeholder="Akreditas" name="akreditas" value="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="th_akreditas" placeholder="Tahun Akreditas" name="th_akreditas" value="">
                            
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

<!-- <script>
$('.btn-edit-button').on('click', function () {
    $('#form-modal').attr('action', $(this).data('link'));
});
</script> -->


@section('scripts')

@endsection