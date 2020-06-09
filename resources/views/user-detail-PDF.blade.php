<!-- <!DOCTYPE html> -->
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!--     Fonts and icons     -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
    <!-- CSS Files -->
    <link href="{{  public_path('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ public_path('css/cetak.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="{{public_path('img/logo-unila.png')}}" alt="Logo">
            <div class="header-title">
                <h3>Sistem Informasi Alumni</h3>
                <h5>Universitas Lampung</h5>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12 main">
                <img src="{{public_path('img/img-cetak.jpg')}}" alt="Logo">
                <h1>{{$users_attribut->nama}}</h1>
            </div>
        </div>

        <div class="main-content">
            <div class="main-title">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Tempat Lahir</h5>
                        <p>{{$users_attribut->tempat_lahir}}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Tanggal Lahir</h5>
                        <p>{{$users_attribut->tgl_lahir}}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Alamat</h5>
                        <p>{{$users_attribut->alamat}}</p>
                    </div>
                </div>
            </div>

            <div class="main-title-2">
                <div class="row">
                    <div class="col-md-4">
                        <h5>No.Handphone</h5>
                        <p>{{$users_attribut->no_hp}}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Jurusan/Prodi</h5>
                        <p>{{$users_attribut->jurusan_prodi}}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Tahun Masuk</h5>
                        <p>{{substr($users_attribut->th_masuk,0,4)}}</p>
                    </div>
                </div>
            </div>

            <div class="main-title-3">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Tahun Lulus</h5>
                        <p>{{substr($users_attribut->th_lulus,0,4)}}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Status</h5>
                        <p>{{$users_attribut->status}}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Tempat Bekerja</h5>
                        <p>{{$users_attribut->tempat_bekerja}}</p>
                    </div>
                </div>
            </div>

            <div class="main-title-4">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Waktu Lulus Kerja</h5>
                        <p>{{$users_attribut->waktu_lulus_bekerja}}</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>