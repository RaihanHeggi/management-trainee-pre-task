@extends('Dashboard.template.template_dashboard')

@section('depedencies_upper')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://kit.fontawesome.com/13a7b28a80.js" crossorigin="anonymous"></script>

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
@endsection

@section('title_name')
    <title>Home</title>
@endsection

@section('sidebar')
    @include('Dashboard.template.sidebar')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Main Dashboard</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: green; color:aliceblue">
                            <div class="inner">
                                <h4 class="text-right"><b>Ontime</b></h4>
                                <h3><sub style="font-size: 20px">On Time</sub></h3>
                                <h5>{{ $statisticData['count_ontime'] ?? "0" }}</h5>
                                <p><b>Total Waktu On Time</b></p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users" style="padding: 35px;"></i> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #3197D0; color:aliceblue">
                            <div class="inner">
                                <h4 class="text-right"><b>{{ $timeData['isOverwork'] }} Minutes</b></h4>
                                <h3><sub style="font-size: 20px">Overtime</sub></h3>
                                <h5>{{ $statisticData['count_overwork'] ?? "0"}}</h5>
                                <p><b>Total Waktu Overwork</b></p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users" style="padding: 35px;"></i> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #ffc107; color:aliceblue">
                            <div class="inner">
                                <h4 class="text-right"><b>{{ $timeData['isEarly'] }} Minutes</b></h4>
                                <h3><sub style="font-size: 20px">Early</sub></h3>
                                <h5>{{ $statisticData['count_early'] ?? "0" }}</h5>
                                <p><b>Total Waktu Early</b></p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users" style="padding: 35px;"></i> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: maroon; color:aliceblue">
                            <div class="inner">
                                <h4 class="text-right"><b>{{ $timeData['isLate'] }} Minutes</b></h4>
                                <h3><sub style="font-size: 20px">Late</sub></h3>
                                <h5>{{ $statisticData['count_telat'] ?? "0"}}</h5>
                                <p><b>Total Waktu Telat</b></p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users" style="padding: 35px;"></i> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content mb-2">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Attendance Logs</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table style="width:100%"  id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Date</th>
                        <th scope="col">Clock In </th>
                        <th scope="col">Clock Out </th>
                        <th scope="col">Status</th>
                        <th scope="col">Clock In Status</th>
                        <th scope="col">Clock Out Status</th>
                    </tr>
                    </thead>
                        <tbody>
                            @forelse($dataAttendances as $index => $dk)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ Carbon\Carbon::parse($dk->absents_date)->format('Y-m-d') }}</td>
                                    <td>{{ $dk->clock_in }}</td>
                                    <td>{{ $dk->clock_out ?? 'Not Yet'}}</td>
                                    <td>{{ $dk->absents_note }}</td>

                                    @if($dk->is_telat == "1")
                                        <td><span class="badge badge-danger">Telat</span></td>
                                    @elseif($dk->is_telat == "0")
                                        <td><span class="badge badge-success">Ontime</span></td>
                                    @endif


                                    @if($dk->is_early == "1")
                                        <td><span class="badge badge-warning">Early</span></td>
                                    @elseif($dk->is_overwork == "1")
                                        <td><span class="badge badge-primary">Overwork</span></td>
                                    @elseif($dk->is_ontime == "1")
                                        <td><span class="badge badge-success">Ontime</span></td>
                                    @else 
                                        <td><span class="badge badge-warning">Not Yet</span></td>
                                    @endif

                                </tr>
                            @empty
                                <td colspan="7" class="table-active text-center">Tidak Ada Data</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
        </section>
    </div>
@endsection

@section('depedencies_bottom')
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                responsive:true,
            });
        });
    </script>
    
@endsection