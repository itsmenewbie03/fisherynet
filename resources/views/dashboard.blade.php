<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="img/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>FisheryNet Dashboard</title>

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('css/dataTables.dataTables.min.css')}}">
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="img/sidebar-5.jpg">
            <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{route('dashboard')}}" class="simple-text">
                        FisheryNet
                    </a>
                </div>

                <ul class="nav">
                    <li class="{{str_contains(Route::currentRouteName(),'dashboard') ? 'active' : ''}}">
                        <a href="{{route('dashboard')}}">
                            <i class="pe-7s-news-paper"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="{{str_contains(Route::currentRouteName(),'reports') ? 'active' : ''}}">
                        <a href="{{route('reports.index')}}">
                            <i class="pe-7s-graph"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                    <li class="{{str_contains(Route::currentRouteName(),'configurations') ? 'active' : ''}}">
                        <a href="{{route('configurations.index')}}">
                            <i class="pe-7s-note2"></i>
                            <p>Configuration</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">@yield('brand','Dashboard')</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                @auth
                                <!-- <form method="POST" action="{{ route('logout') }}"> -->
                                <!--     @csrf -->
                                <!--     <button class="nav-link" type="submit"> -->
                                <!--         <p>Logout</p> -->
                                <!--     </button> -->
                                <!-- </form> -->
                                <form method="POST" action="{{ route('logout') }}" class="form-inline my-2 my-lg-0">
                                    @csrf
                                    <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
                                </form>
                                @endauth
                            </li>
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                @yield('content')
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#"> Home </a>
                            </li>
                            <li>
                                <a href="#"> Company </a>
                            </li>
                            <li>
                                <a href="#"> Portfolio </a>
                            </li>
                            <li>
                                <a href="#"> Blog </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        <a href="http://www.creative-tim.com">Creative Tim</a>, made with
                        love for a better web
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>

<!--   Core JS Files   -->
<script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="{{asset('js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('js/bootstrap-notify.js')}}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<script src="{{asset('js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

<script src="{{asset('js/dataTables.min.js')}}"></script>
@stack("scripts")
<!-- <script type="text/javascript"> -->
<!--     $(document).ready(function() { -->
<!--         demo.initChartist(); -->
<!---->
<!--         // $.notify({ -->
<!--         //     icon: "pe-7s-gift", -->
<!--         //     message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer.", -->
<!--         // }, { -->
<!--         //     type: "info", -->
<!--         //     timer: 4000, -->
<!--         // }, ); -->
<!--     }); -->
<!-- </script> -->

</html>
