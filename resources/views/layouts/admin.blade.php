<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HR - @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="icon" href="{{ asset("dist/img/AdminLTELogo.png") }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{asset("plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset("plugins/jqvmap/jqvmap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <!-- overlayScrollbars -->

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset("plugins/daterangepicker/daterangepicker.css")}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset("plugins/summernote/summernote-bs4.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Chart js -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


    @yield('css')

    <title>Statistika</title>


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<style>
    .preloader
    {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url("{{asset("img/loader.gif")}}") 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
    }
    body.loading .preloader {
        overflow: hidden;
    }

    /* Anytime the body has the loading class, our
       modal element will be visible */
    body.loading .preloader {
        display: block;
    }
</style>
<div  class="preloader"></div>
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav" >
            <li class="nav-item">
                <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- SEARCH FORM -->

        <!-- Right navbar links -->

       {{--@yield('notifications')--}}
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <!-- Notifications Dropdown Menu -->

            @if($notificationsEmp->isNotEmpty() || $notificationsDoc->isNotEmpty())
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-danger">{{$totalNotifications}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width:500px!important;">
                    @if($notificationsEmp->isNotEmpty())
                    <span class="dropdown-item dropdown-header">@if(count($notificationsEmp) == 1) {{count($notificationsEmp)}} ugovor uskoro ističe @else {{count($notificationsEmp)}} ugovora uskoro ističu @endif</span>
                    <div class="dropdown-divider"></div>
                    @foreach($notificationsEmp as $notification)
                        <a href="/employees/{{$notification->employee_id}}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> {{$notification->name}} {{$notification->last_name}}
                            <span class="float-right text-muted text-sm">{{$notification->days_till}} dana</span>
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach
                    <div class="dropdown-divider"></div>
@endif
@if($notificationsDoc->isNotEmpty())
                    <span class="dropdown-item dropdown-header"> @if(count($notificationsDoc) == 1) {{count($notificationsDoc)}} dokument uskoro ističe @else {{count($notificationsDoc)}} dokumenata uskoro ističu @endif </span>
                    <div class="dropdown-divider"></div>
                    @foreach($notificationsDoc as $notification)
                        <a href="/search/{{$notification->name}}" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> {{$notification->name}}
                            <span class="float-right text-muted text-sm">{{$notification->days_till}} dana</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        @endforeach
                        @endif
                    <div class="dropdown-divider"></div>
                    <a href="/home" class="dropdown-item dropdown-footer">Pogledaj detalje</a>
                </div>
            </li>
            @endif
        </ul>
    </nav>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
        <img src="{{asset("dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle"
                 style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>










        <!-- SIDEBAR -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->


            <!-- Sidebar Menu -->
             @include('layouts.sidebar-items')
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- SIDEBAR END -->












    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-2">
        <!-- Content Header (Page header) -->
        {{-- <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Marko Marković</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">@yield('bread-active')</a></li>
                        <li class="breadcrumb-item active">@yield('bread-item')</li>
                        </ol>
                    </div>
                </div><
            </div>
        </div> --}}

        <!-- Main content -->

            @yield('content')

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
   @include('layouts.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->


<!-- overlayScrollbars -->

<!-- AdminLTE App -->
<!-- js start -->
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('admin_css_js/ajaxSubmitForm.js') }}"></script>
<script src="{{ asset('admin_css_js/delete.js') }}"></script>
<script src="{{ asset('admin_css_js/ajaxFetch.js') }}"></script>

<script src="{{ asset('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datepicker/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.js') }}"></script>
<script src="{{ asset('assets/vendor/datepicker/datepicker.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<!-- Scipt -->
<script src="{{ asset('js/layout.js') }}"></script>

<!-- js end -->
@yield('js')
</body>
</html>
