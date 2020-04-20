<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>tyr - Controle de Temperatura</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('css/paper-dashboard.css')}}" rel="stylesheet" />

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    {{--
    <link href="asset/css/demo.css" rel="stylesheet" /> --}}

    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">

</head>

<body>

    <div class="wrapper">
        <div class="sidebar" data-background-color="white" data-active-color="danger">

            <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        <img src="{{asset('img/logo_web.png')}}" alt="logo_tyr">
                    </a>
                </div>

                <ul class="nav">
                    <li class="" id="status">
                        <a href="/">
                            <i class="ti-dashboard"></i>
                            <p>Status</p>
                        </a>
                    </li>
                    <li class="" id="report">
                        <a href="{{route('relatorios')}}">
                            <i class="ti-write"></i>
                            <p>Relatórios</p>
                        </a>
                    </li>
                    <li class="" id="live">
                        <a href="{{ route('live') }}">
                            <i class="ti-bar-chart"></i>
                            <p>Acompanhar</p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#componentsExamples">
                            <i class="ti-package"></i>
                            <p>Components
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="componentsExamples">
                            <ul class="nav">
                                <li>
                                    <a href="../components/buttons.html">
                                        <i class="ti-dashboard"></i>
                                        <span class="sidebar-normal">Buttons</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../components/grid.html">
                                        <span class="sidebar-mini">GS</span>
                                        <span class="sidebar-normal">Grid System</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../components/panels.html">
                                        <span class="sidebar-mini">P</span>
                                        <span class="sidebar-normal">Panels</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../components/sweet-alert.html">
                                        <span class="sidebar-mini">SA</span>
                                        <span class="sidebar-normal">Sweet Alert</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../components/notifications.html">
                                        <span class="sidebar-mini">N</span>
                                        <span class="sidebar-normal">Notifications</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../components/icons.html">
                                        <span class="sidebar-mini">I</span>
                                        <span class="sidebar-normal">Icons</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../components/typography.html">
                                        <span class="sidebar-mini"><i class="ti-panel"></i></span>
                                        <span class="sidebar-normal">Typography</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @if(checkPermission(['admin','superadmin']))
                    <li id="usuarios" class="">
                        <a href="{{ route('usuarios.index')}}">
                            <i class="ti-user"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    <li id ="empresas" class="">
                        <a href="{{ route('empresas.index') }}">
                            <i class="ti-info"></i>
                            <p>Empresa</p>
                        </a>
                    </li>
                    <li id ="setores" class="">
                        <a href="{{ route('setores.index') }}">
                            <i class="ti-pie-chart"></i>
                            <p>Setores</p>
                        </a>
                    </li>
                    
                    <li id="sensores">
                        <a href="{{ route('sensores.index') }}">
                            <i class="ti-rss-alt"></i>
                            <p>Sensores</p>
                        </a>
                    </li>
                    @endif



                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="#">@yield('tab')</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{ route('meuusuario') }}" >
                                    <i class="ti-panel"></i>
                                    <p>Configurações</p>
                                </a>
                            </li>
                            {{-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
                                    <p>Notificações</p>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li> --}}
                            <li>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti-power-off"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>


            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>

                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright pull-right">
                        &copy; <script>
                            document.write(new Date().getFullYear())
                        </script>, tyr - Controle de temperatura
                    </div>
                </div>
            </footer>

        </div>
    </div>
    

</body>
@yield('modal')

<!--   Core JS Files   -->
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
{{-- <script src="{{asset('js/bootstrap-checkbox-radio.js')}}"></script> --}}

<!--  Charts Plugin -->
{{-- <script src="{{asset('js/chartist.min.js')}}"></script> --}}

<!--  Notifications Plugin    -->
<script src="{{asset('js/bootstrap-notify.js')}}"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="{{asset('js/paper-dashboard.js')}}"></script>

@if ( Session::has('success') )

<script type="text/javascript">
    $.notify({
        // options
        message: "{{Session::get('success')}}"
    }, {
        // settings
        type: 'success',
        placement: {
            from: "top",
            align: "center"
        }
    });
</script>

@endif
@if ( Session::has('danger') )

<script type="text/javascript">
    $.notify({
        // options
        message: "{{Session::get('danger')}}"
    }, {
        // settings
        type: 'danger',
        placement: {
            from: "top",
            align: "center"
        }
    });
</script>

@endif


@yield('javascript')

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
{{-- <script src="assets/js/demo.js"></script> --}}


</html>
