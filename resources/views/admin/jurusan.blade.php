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
                                    <td>{{substr($js->th_akreditas,0,4)}}</td>
                                    <td>
                                        <a data-toggle="modal" href="#" value="{{$js->id}}" class="btn btn-view open_modal_view"><i class="far fa-eye"></i><a>
                                        <a data-toggle="modal" href="#" value="{{$js->id}}" class="btn btn-edit open_modal_update"><i class="far fa-edit"></i><a>
                                        <a data-toggle="modal" href="#" value="{{$js->id}}" class="btn btn-delete open_modal_delete"><i class="far fa-trash-alt"></i><a>
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
@include('layouts.alert-modal')

<!-- Modall View-->
<section>
<div class="modal fade" id="ModalViewData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Jurusan</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="kode_jurusan_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Jurusan</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="nama_jurusan_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Akreditas</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="akreditas_view" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tahun Akreditas</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="th_akreditas_view" value="">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
  </section>

<!-- Modall UPDATE-->
<section>
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
                <form clas="form-modal" id="action" action= "" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <div class="form-group">
                            
                            <input type="text" class="form-control" required id="kode_jurusan" placeholder="Kode Jurusan/Prodi" name="kode_jurusan" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" required id="nama_jurusan" placeholder="Nama Jurusan/Prodi" name="nama_jurusan" value="">
                        </div>
                        <div class="form-group">
                        <div class="form-group">
                            <select class="form-control" placeholder="Akreditas" id="akreditas" name="akreditas" value="">
                            <option>lainnya</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>

                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                        <input type="text" class="form-control date" required id="th_akreditas" placeholder="Tahun Akreditas" name="th_akreditas" value="">
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
  </section>
<!-- MODAL TAMBAH DATA JURUSAN  -->
<section>
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
                            
                            <input type="text" required class="form-control" id="kode_jurusan" placeholder="Kode Jurusan/Prodi" name="kode_jurusan" value="">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" required class="form-control" id="nama_jurusan" placeholder="Nama Jurusan/Prodi" name="nama_jurusan" value="">
                        </div>
                        <div class="form-group">                            
                        <select class="form-control" placeholder="Akreditas" id="akreditas" name="akreditas" value="">
                            <option selected>lainnya</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>

                            </select>
                        </div>
                        <div class="form-group">
                        <input type="text" required class="form-control date" id="th_akreditas" placeholder="Tahun Akreditas" name="th_akreditas" value="">
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
</section>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
   $(document).on('click', '.open_modal_update', function() {
            var url = "/getJurusanById";
            var tour_id = $(this).attr("value");
                console.log('id : ', tour_id);
                console.log('id ModalUpdateData  : ', $('#exampleModal') );
            $.get(url + '/' + tour_id, function(data) {
                //success data
                console.log('data : ', data);
                $('#action').attr('action' , '/update-data-jurusan/' + tour_id);
                $('#kode_jurusan').val(data.kode_jurusan);
                $('#nama_jurusan').val(data.nama_jurusan);
                $('#akreditas').val(data.akreditas);
                $('#th_akreditas').val(data.th_akreditas.substring(0,4));
                $('#btn-save').val("update");
                $('#ModalUpdateData').modal('show');
            })
        });
   $(document).on('click', '.open_modal_view', function() {
            var url = "/getJurusanById";
            var tour_id = $(this).attr("value");
                console.log('id : ', tour_id);
                console.log('id ModalUpdateData  : ', $('#exampleModal') );
            $.get(url + '/' + tour_id, function(data) {
                //success data
                console.log('data : ', data);
                $('#kode_jurusan_view').val(data.kode_jurusan);
                $('#nama_jurusan_view').val(data.nama_jurusan);
                $('#akreditas_view').val(data.akreditas);
                $('#th_akreditas_view').val(data.th_akreditas.substring(0,4));
                $('#btn-save').val("update");
                $('#ModalViewData').modal('show');
            })
        });
   $(document).on('click', '.open_modal_delete', function() {
            var url = "/getJurusanById";
            var tour_id = $(this).attr("value");
            $('#action').attr('action' , '/delete-data-jurusan/' + tour_id);
                console.log('id : ', tour_id);
                $('#modal-info').modal('show');
        });
    });
</script>

@endsection