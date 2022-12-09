<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    @vite(['resources/css/app.css'])

    @stack('third_party_stylesheets')
    <link rel="stylesheet" href="{{ url('css/datatable/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('css/datatable/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Jquery.js -->
    <script src="{{ url('js/jquery.min.js') }}" type="text/javascript"></script>

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2014-2022 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
    </footer>
</div>

<!-- @vite(['resources/js/app.js']) -->


@stack('third_party_scripts')
<!-- Select 2 plugin -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Datatable,  -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<!-- Date Range Picker -->
<script src="{{ url('plugins/moment/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}" type="text/javascript"></script>

<!--  -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>

<!-- Toastr for alert message -->
<script src="{{ url('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&libraries=places&callback=initialize" async defer></script>

<!-- Select 2 Plugin -->
<script src="{{ url('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- customer.js for all the custom javascript funcitons -->
<script src="{{ url('js/custom.js') }}" type="text/javascript"></script>





@stack('page_scripts')
<script>
    $(document).ready(function(){
        // alert message for all actions
        var status = "{{ session('status') }}";
        if(status){
        toastr.success(status);
        }
        $("#opening_time").attr('readonly',true);

        // select 2 for list
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    });


  
</script>

</body>
</html>
