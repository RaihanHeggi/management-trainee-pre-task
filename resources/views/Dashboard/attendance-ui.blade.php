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
    <title>Attendance</title>
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
                        <h1 class="m-0">Working Attendance</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance Clocking</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">                  
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Carbon\Carbon::parse(Carbon\Carbon::now()->timezone('Asia/Jakarta'))->format('Y-m-d') }} Working Attendance</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('Login.template.flash-message')
                        <table id="tabel_admin" style="width:100%" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Clock in</th>
                                    <th class="text-center" scope="col">Clock Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <div>
                                            @if($clock_in_data == "No Data Recorded")
                                                <button type="button" id="checkin-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Check In</button>
                                            @else
                                                <a style="font-weight:bold"> Done Check in</a>
                                            @endif
                                            <br>
                                        </div>
                                       <div>
                                        @if($clock_in_data != "No Data Recorded")
                                                <a>Already Checkin</a>
                                                <br>
                                                <a>on</a>
                                                <br>
                                                <a>{{ $clock_in_data }} WIB</a>
                                            @else
                                                <a>No Data Recorded</a>
                                            @endif
                                       </div>                                       
                                    </td>
                                    <td class="text-center">
                                        @if($clock_in_data == "No Data Recorded" )
                                            <a style="font-weight:bold"> No Check-in Recorded</a>
                                        @elseif($clock_out_data == "No Data Recorded")
                                            <a class="btn btn-primary" href="{{ url('clock_out') }}" role="button">Check Out</a>
                                        @else
                                            <a style="font-weight:bold"> Done Checkout</a>
                                        @endif
                                        <br>
                                        @if($clock_out_data != "No Data Recorded")
                                            <a>Already Check-Out</a>
                                            <br>
                                            <a>on</a>
                                            <br>
                                            <a>{{ $clock_out_data }} WIB</a>
                                        @else
                                            <a>No Data Recorded</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>                 
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section> 
    </div>

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Clock In</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ url('clock_in') }}">
                @csrf
                <div class="modal-body">
                    <p><center>Please Click Outside the Modal To Close this modal</center></p>
                    <span class="input-group-text" id="addon-wrapping" style="width: 30%;">Work Location</span>
                    <select class="form-control" data-width='30%' id="position" name="position">
                        <option selected>Choose Location</option>
                        <option name="position" value="WFH">WFH</option> 
                        <option name="position" value="WFO">WFO</option> 
                    </select>
                </div>
                <div class="modal-footer">
                    <button style="background-color:#f2a900;border-color:#f2a900" type="submit" class="btn btn-success mt-3 w-40" name='action' >Submit</button>
                </div>
            </form>            
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function($) {
            $('#checkin-btn').on('click', function(){
                $('#exampleModal').modal('show');
            }),

            $('#close-modal').on('click', function(){
                $('exampleModal').modal('toggle'); 
            });
        });

    </script>

@endsection

@section('depedencies_bottom')
    <!-- jQuery -->
    <!-- <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script> -->
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
            $("#tabel_admin").DataTable({
                responsive:true,
                paging: false,
                ordering: false,
                searching: false,
            });
        });
    </script>
@endsection