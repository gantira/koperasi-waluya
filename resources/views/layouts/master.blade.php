<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Waluya</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    <!-- Bootstrap jquery.bootstrap-touchspin.min.css     -->
    {{-- {!! Html::style('css/jquery.bootstrap-touchspin.min.css') !!} --}}
    <!-- Animation library for notifications   -->
    {!! Html::style('assets/css/animate.min.css') !!}
    <!--  Paper Dashboard core CSS    -->
    {!! Html::style('assets/css/paper-dashboard.css') !!}
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    {!! Html::style('assets/css/demo.css') !!}
    <!--  Fonts and icons     -->
    {!! Html::style('http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css') !!}
    {!! Html::style('https://fonts.googleapis.com/css?family=Muli:400,300') !!}
    {!! Html::style('assets/css/themify-icons.css') !!}
    <!--  JQuery UI & Date Range Picker     -->
    {!! Html::style('jquery-ui-1.12.1/jquery-ui.min.css') !!}
    {!! Html::style('jquery-date-range-picker/css/daterangepicker.min.css') !!}
    
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
        <a href="{{ url('/') }}" class="simple-text">
            Waluya
        </a>
    </div>

    <ul class="nav">
        @if (Auth::check())
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                <li class="{!! $dashboard or '' !!}">
                    <a href="{{ url('/') }}">
                        <i class="ti-panel"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="{!! $anggota or '' !!}">
                    <a href="{{ url('anggota') }}">
                        <i class="ti-user"></i>
                        <p>Anggota</p>
                    </a>
                </li>
                <li class="{!! $akun or '' !!}">
                    <a href="{{ url('akun') }}">
                        <i class="ti-view-list-alt"></i>
                        <p>Akun</p>
                    </a>
                </li>
                <li class="{!! $simpanan or '' !!}">
                    <a href="{{ url('simpanan') }}">
                        <i class="ti-layers-alt"></i>
                        <p>Simpanan</p>
                    </a>
                </li>
                <li class="{!! $pinjaman or '' !!}">
                    <a href="{{ url('pinjaman') }}">
                        <i class="ti-layers-alt"></i>
                        <p>Pinjaman</p>
                    </a>
                </li>
                <li class="{!! $transaksi or '' !!}">
                    <a href="{{ url('transaksi') }}">
                        <i class="ti-layers-alt"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
                <li class="{!! $rit or '' !!}">
                    <a href="{{ url('rit') }}">
                        <i class="ti-layers-alt"></i>
                        <p>RIT Perahu</p>
                    </a>
                </li>
                <li class="{!! $laporan or '' !!}">
                    <a href="{{ url('laporan') }}">
                        <i class="ti-book"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'anggota')
                <li class="{!! $dashboard or '' !!}">
                    <a href="{{ url('/') }}">
                        <i class="ti-panel"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="{!! $simpanan or '' !!}">
                    <a href="{{ url('simpanan') }}">
                        <i class="ti-layers-alt"></i>
                        <p>Simpanan</p>
                    </a>
                </li>
                <li class="{!! $pinjaman or '' !!}">
                    <a href="{{ url('pinjaman') }}">
                        <i class="ti-layers-alt"></i>
                        <p>Pinjaman</p>
                    </a>
                </li>
                <li class="{!! $laporan or '' !!}">
                    <a href="{{ url('laporan') }}">
                        <i class="ti-book"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            @endif
                <li class="">
                    <a href="{{ url('logout') }}">
                        <i class="ti-shift-right"></i>
                        <p>Keluar</p>
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
                <a class="navbar-brand" href="#">@yield('title', 'default')</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    {{-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ti-bell"></i>
                            <p class="notification">5</p>
                            <p>Notifications</p>
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
                    @if (Auth::user()->role == 'admin')
                        <li>
                            <a href="{{ url('/') }}">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('setting') }}">
                                <i class="ti-settings"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                        @if(Request::path() == 'laporan/keuangan' || Request::path() == 'laporan/keuangan/labarugi' || Request::path() == 'laporan/anggota' || Request::path() == 'laporan/rit' || Request::path() == 'laporan/keuangan/pengeluaran')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-export"></i>
                                {{-- <p class="notification">5</p> --}}
                                <p>Eksport</p>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{!! url()->full().'&print=true' !!}">Excel</a></li>
                            </ul>
                        </li>
                        @endif 
                    @endif
                </ul>

            </div>
        </div>
    </nav>


    @yield('content', 'default')

    <footer class="footer">
        <div class="container-fluid">
      
            <div class="copyright pull-right">
                &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> theme by <a href="http://www.creative-tim.com">Creative Tim</a>
            </div>
        </div>
    </footer>


</div>
</div>


</body>

<!--   Core JS Files   -->
{!! Html::script('assets/js/jquery-1.10.2.js') !!}
{!! Html::script('assets/js/bootstrap.min.js') !!}
<!--  Checkbox, Radio & Switch Plugins -->
{!! Html::script('assets/js/bootstrap-checkbox-radio.js') !!}
<!--  Charts Plugin -->
{!! Html::script('assets/js/chartist.min.js') !!}
<!--  Notifications Plugin    -->
{!! Html::script('assets/js/bootstrap-notify.js') !!}
<!--  Google Maps Plugin    -->
{{-- {!! Html::script('https://maps.googleapis.com/maps/api/js') !!} --}}
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
{!! Html::script('assets/js/paper-dashboard.js') !!}
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
{!! Html::script('assets/js/demo.js') !!}
<!-- jquery.decimalMask.min.js -->
{{-- {!! Html::script('js/jquery.decimalMask.min.js') !!} --}}
{!! Html::script('js/jquery.maskedinput.min.js') !!}
{!! Html::script('js/jquery.bootstrap-touchspin.min.js') !!}
<!--  JQuery UI & Date Range Picker     -->
{!! Html::script('jquery-ui-1.12.1/jquery-ui.min.js') !!}
{!! Html::script('jquery-ui-1.12.1/i18n/datepicker-id.js') !!}
{!! Html::script('jquery-date-range-picker/js/moment.min.js') !!}
{!! Html::script('jquery-date-range-picker/js/jquery.daterangepicker.min.js') !!}


@stack('scripts')

</html>