@extends('layouts.master')


@section('title')
    Dashboard | Alumni Unila
@endsection

@section('header')
Dashboard
@endsection

@section('content')
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Dashboard</h5>
                </div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Name</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Salary</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Dakota Rice</td>
                                    <td>Niger</td>
                                    <td>Oud-Turnhout</td>
                                    <td>Minerva Hooper</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">Dashboard</h4>
                        <hr>
                        <div class="card-info">
                            <div class="kotak">
                                <i class="fas fa-home"></i>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">Alumni</h4>
                        <hr>
                        <div class="card-info">
                            <div class="kotak">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="summary">
                                <h1>{{$usrCount}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">Jurusan/Prodi</h4>
                        <hr>
                        <div class="card-info">
                            <div class="kotak">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="summary">
                                <h1>{{$jrsanCount}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">Bekerja</h4>
                        <hr>
                        <div class="card-info">
                            <div class="kotak">
                                <i class="far fa-building"></i>
                            </div>
                            <div class="summary">
                                <h1>{{$sdhKrjCount}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">Belum Bekerja</h4>
                        <hr>
                        <div class="card-info">
                            <div class="kotak">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="summary">
                                <h1>{{$blmKrjCount}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">Melanjutkan Studi</h4>
                        <hr>
                        <div class="card-info">
                            <div class="kotak">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="summary">
                                <h1>15</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection