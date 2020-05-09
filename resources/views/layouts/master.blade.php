<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="blue"><!--Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"-->
            <div class="logo" style="display: flex">
                <img src="img/logo-unila.png" alt="Logo" width="45">
                <a href="http://www.creative-tim.com" class="simple-text logo-normal" style="font-size: 15px">
                    Universitas Lampung
                </a>
            </div>
            
            <div class="sidebar-wrapper" id="sidebar-wrapper">
                <div class="user-panel">
                    <div class="image">
                    @if($users_attribut != null)
                        <img src="storage/<?php echo $users_attribut->path_foto ?>" class="img-circle elevation-2" alt="User Image">
                    @endif
                    @if($users_attribut == null)
                    <img src="img/user-hero.png" class="img-circle elevation-2" alt="User Image">
                    @endif
                    </div>
                
                    <div class="info">
                        <a href="{{url('/detail-user')}}" class="d-block">Welcome {{ Auth::user()->name }} </a>
                    </div>
                </div>
                <ul class="nav">
                    <li class="{{ 'dashboard' == request()->path() ? 'active' : '' }}">
                        <a href="/dashboard">
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="./icons.html">
                            <i class="now-ui-icons education_atom"></i>
                            <p>Icons</p>
                        </a>
                    </li>
                    <li>
                        <a href="./map.html">
                            <i class="now-ui-icons location_map-big"></i>
                            <p>Maps</p>
                        </a>
                    </li>
                    <li>
                        <a href="./notifications.html">
                            <i class="now-ui-icons ui-1_bell-53"></i>
                            <p>Notifications</p>
                        </a>
                    </li>
                    <li>
                        <a href="./user.html">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>User Profile</p>
                        </a>
                    </li> -->
                    <li class="{{ 'jurusan' == request()->path() ? 'active' : '' }}">
                        <a href="/jurusan">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                            <p>Jurusan/Prodi</p>
                        </a>
                    </li>
                    <li class="{{ 'alumni' == request()->path() ? 'active' : '' }}">
                        <a href="/alumni">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                            <p>Alumni</p>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="./typography.html">
                            <i class="now-ui-icons text_caps-small"></i>
                            <p>Typography</p>
                        </a>
                    </li> -->
                    <li class="active-pro">
                        <a href="./upgrade.html">
                            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel" id="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#pablo">@yield('header')</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <form>
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="now-ui-icons ui-1_zoom-bold"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons media-2_sound-wave"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Stats</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="now-ui-icons location_world"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Some Actions</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="dropdown-item">
                                        Logout
                                    </a>
                                    <a href="" class="dropdown-item" data-toggle="modal" data-target="#exampleModal" onclick="validate()">
                                        Ganti Password
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons users_single-02"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                        <span>{{ Auth::user()->name }} </span>
                                    </p>
                                    
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
             <!-- MODAL GANTI PASSWORD -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <div class="modal-body">
                <form method="POST" action="{{url('/update-password')}}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="old_password" class="col-md-2 col-form-label">{{ __('Current password') }}</label>
                    <div class="col-md-6">
                        <input id="old_password" name="old_password" type="password" class="form-control" required  value="" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new_password" class="col-md-2 col-form-label">{{ __('New password') }}</label>
                    <div class="col-md-6">
                        <input id="new_password" name="new_password" type="password" class="form-control"   value="" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirm" class="col-md-2 col-form-label">{{ __('Confirm password') }}</label>

                    <div class="col-md-6">
                        <input id="password_confirm" name="password_confirm" type="password" class="form-control"  value=""  required
                            autofocus>
                            <span id='message'></span>
                    </div>
                </div>
                <div class="form-group login-row row mb-0">
                    <div class="col-md-8 offset-md-2">
                        <button id="btn" type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>

                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn" class="btn btn-primary offset-md-2" > {{ __('Submit') }}</button>
                </div> -->
                </form>
                </div>
            </div>
            </div>

            <div class="panel-header panel-header-sm">
            </div>

            <div class="content">
                @yield('content')

            </div>

            <footer class="footer">
                <div class=" container-fluid ">
                    <div class="copyright" id="copyright">
                        <a>Copyright &copy; 2020 Universitas Lampung. All right reserved.</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
    $('#new_password, #password_confirm').on('keyup', function () {
    if ($('#new_password').val() == $('#password_confirm').val()) {
        $('#message').html('Matching').css('color', 'green');
    } else 
        $('#message').html('Not Matching').css('color', 'red');
    });
    </script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
    function validate() {
            $('#old_password, #new_password, #password_confirm').on('keyup', function() {
            if ($('#old_password').val() === ''|| $('#new_password').val() === '' || $('#password_confirm').val() === '' ) {
                return $('#btn').prop('disabled', true);
            }
            else {
                return $('#btn').prop('disabled', false);
            }
        });
    return $('#btn').prop('disabled', true);
    }
    </script>

<script> 
$(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		}); 	
	});
</script>

    @yield('scripts')
</body>

</html>