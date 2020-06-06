<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/cetak.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="{{url('img/logo-unila.png')}}" alt="Logo">
            <div class="header-title">
                <h3>Sistem Informasi Alumni</h3>
                <h5>Universitas Lampung</h5>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-12 main">
                <img src="{{url('img/img-cetak.jpg')}}" alt="Logo">
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

    <!-- <div class="form-group">
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
        <input type="text" class="form-control" id="tahun_masuk" placeholder="tahun masuk" name="th_masuk" value="{{substr($users_attribut->th_masuk,0,4)}}">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="tahun_lulus" placeholder="tahun lulus" name="th_lulus" value="{{substr($users_attribut->th_lulus,0,4)}}">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="status" placeholder="status" name="status" value="{{$users_attribut->status}}">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="status" placeholder="tempat bekerja" name="tempat_bekerja" value="{{$users_attribut->tempat_bekerja}}">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="status" placeholder="waktu lulus kerja" name="waktu_lulus_bekerja" value="{{substr($users_attribut->waktu_lulus_bekerja,0,4)}}">
    </div>
</div> -->

</body>
</html>