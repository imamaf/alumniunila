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

                    <div class="tambah" style="margin-left: auto;">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah</button>
                    </div>
                </div>
                <div class="card-body">
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
                                <tr>
                                    <td>Tes12345</td>
                                    <td>Tes12345</td>
                                    <td>Tes12345</td>
                                    <td>Tes12345</td>
                                    <td>Tes12345</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="nama" placeholder="nama">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tempat_Lahir" placeholder="tempat lahir">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tanggal_lahir" placeholder="tanggal lahir">
                        </div>
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="alamat" placeholder="alamat">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="no_handphone" placeholder="no.handphone">
                        </div>
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="jurusan" placeholder="jurusan">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tahun_masuk" placeholder="tahun masuk">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tahun_lulus" placeholder="tahun lulus">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="status">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="tempat bekerja">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="waktu lulus kerja">
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection