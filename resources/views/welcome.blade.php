<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Sistem Informasi Alumni | Universitas Lampung</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

 </head>
<body>
        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div> -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
        <img src="{{url('img/logo-unila.png')}}" alt="Logo" width="45">
            <a class="navbar-brand" href="#">
                  Universitas Lampung
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @if (Route::has('login'))
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Welcom {{ Auth::user()->name }} <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Admin <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();" class="dropdown-item">
                           <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            <p>Logout</p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                             </form>              
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
                @endif
            </div>
        </div>
    </nav>

    <div class="jumbotron2">
        <div class="container">
            <div class="main-content">
                <div class="main-title">
                    <h1 class="line-1 anim-typewriter">Selamat Datang di Trace Study Alumni</h1>
                    <h2>Sistem Informasi Alumni</h2>
                    <h2>Universitas Lampung</h2>
                </div>
                                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                {!! $chart->html() !!}
                            </div>
                        </div>
                    </div>
                <div class="main-summary" style="margin-top: -10px;">
                    <div class="summary d-flex justify-content-center">
                        <ul>
                            <li>
                                <h1>{{$usrCount}}</h1>
                                <hr>
                                <span>Alumni</span>
                            </li>
                            <li>
                                <h1>{{$jrsanCount}}</h1>
                                <hr>
                                <span>Jurusan/Prodi</span>
                            </li>
                            <li>
                                <h1>{{$sdhKrjCount}}</h1>
                                <hr>
                                <span>Bekerja</span>
                            </li>
                            <li>
                                <h1>{{$blmKrjCount}}</h1>
                                <hr>
                                <span>Belum Bekerja</span>
                            </li>
                            <li>
                                <h1>{{$lnjtStdCount}}</h1>
                                <hr>
                                <span>Lanjut Studi</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Charts::scripts() !!}
{!! $chart->script() !!}
</body>
</html>

<style>
    .highcharts-background{
        display: none
    }
    .highcharts-container  {
    position: relative;
    overflow: hidden;
    width: 600px;
    height: 300px;
    text-align: left;
    line-height: normal;
    z-index: 0;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    margin-left: 225px;
    }
    .highcharts-title {
        display: none
    }
</style>
