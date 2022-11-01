<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title_name')
    <link rel="icon" href="{{ asset('assets/images/KB_SymbolMark.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @yield('depedencies_upper')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        @include('Dashboard.template.preloader')
        <!-- Navbar -->
        @include('Dashboard.template.header_admin')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            @yield('sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        
        <!-- Footer -->
        @include('Dashboard.template.footer')
        <!-- /.Footer -->

        <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
         <!-- /.control-sidebar -->
        <!-- ./wrapper -->
    </div>

    @yield('depedencies_bottom')
</body>
</html>
