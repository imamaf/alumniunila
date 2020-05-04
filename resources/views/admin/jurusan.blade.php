@extends('layouts.master')


@section('title')
    Jurusan/Prodi | Alumni Unila
@endsection

@section('header')
    Jurusan/Prodi
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Jurusan/Prodi</h5>
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
@endsection


@section('scripts')

@endsection