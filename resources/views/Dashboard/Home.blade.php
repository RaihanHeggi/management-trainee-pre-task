@extends('Dashboard.template.template_dashboard')

@section('depedencies_upper')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <style>
        .carousel .item {
            height: 200px;
        }

        .item img {
            position: absolute;
            top: 0;
            left: 0;
            min-height: 300px;
        }

    </style>
@endsection

@section('title_name')
    <title>Online Attendance| Home</title>
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
                        <h1 class="m-0">Home</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
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
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                responsive:true,
            });
        });
    </script>
    
@endsection