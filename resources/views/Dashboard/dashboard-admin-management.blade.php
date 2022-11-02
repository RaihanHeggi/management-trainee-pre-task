@extends('Dashboard.template.template_dashboard')

@section('depedencies_upper')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
    <script src="https://kit.fontawesome.com/13a7b28a80.js" crossorigin="anonymous"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
@endsection

@section('title_name')
    <title>Admin Management</title>
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
                        <h1 class="m-0">Data Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data User</li>
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
                        <h3 class="card-title">Data Users</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('Login.template.flash-message')
                        <form action="{{ url('add-user') }}" method="get" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <button class="btn btn-primary w-22" type="submit" id="button-addon2">Add Data</button>
                            </div>
                        </form>
                        <table id="tabel_admin" style="width:100%" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Account Status</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data_user as $index => $dc)
                                <tr>
                                    <th scope="row">{{ $index+1 }}</th>
                                    <td>{{ $dc->username }}</td>
                                    <td>{{ $dc->user_role }}</td>
                                    <td>{{ $dc->account_status }}</td>
                                    @if($dc->username == Auth::user()->username)
                                        <td><a class="btn btn-primary" href="#" role="button"><i class="fa fa-edit"></a></td>
                                        <td><button class="btn btn-danger" type="submit" style="border-radius: 10px;"  data-toggle="modal" data-target="#delete_data_{{ $dc->username }}" disabled> <i class="fa fa-trash"></button></td>
                                    @else
                                        <td><a class="btn btn-primary" href="#" role="button"><i class="fa fa-edit"></a></td>
                                        <td><button class="btn btn-danger" type="submit" style="border-radius: 10px;"  data-toggle="modal" data-target="#delete_data_{{ $dc->username }}"> <i class="fa fa-trash"></button></td>
                                    @endif
                                </tr>
                                @empty
                                <td colspan="5" class="table-active text-center">Tidak Ada Data</td>
                                @endforelse
                            </tbody>
                        </table>                 
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section> 

        <section class="content">
            <div class="container-fluid">                  
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Users</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('Login.template.flash-message')
                        <form action="{{ url('user-import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-primary ml-2" type="submit" id="button-addon2">Import</button>
                            </div>
                        </form>
                        <table id="tabel_department" style="width:100%" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Account Status</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data_user as $index => $dc)
                                <tr>
                                    <th scope="row">{{ $index+1 }}</th>
                                    <td>{{ $dc->username }}</td>
                                    <td>{{ $dc->user_role }}</td>
                                    <td>{{ $dc->account_status }}</td>
                                    @if($dc->username == Auth::user()->username)
                                        <td><a class="btn btn-primary" href="#" role="button"><i class="fa fa-edit"></a></td>
                                        <td><button class="btn btn-danger" type="submit" style="border-radius: 10px;"  data-toggle="modal" data-target="#delete_data_{{ $dc->username }}" disabled> <i class="fa fa-trash"></button></td>
                                    @else
                                        <td><a class="btn btn-primary" href="#" role="button"><i class="fa fa-edit"></a></td>
                                        <td><button class="btn btn-danger" type="submit" style="border-radius: 10px;"  data-toggle="modal" data-target="#delete_data_{{ $dc->username }}"> <i class="fa fa-trash"></button></td>
                                    @endif
                                </tr>
                                @empty
                                <td colspan="5" class="table-active text-center">Tidak Ada Data</td>
                                @endforelse
                            </tbody>
                        </table>                 
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section> 


        <!-- Modal Delete -->
        @foreach($data_user as $dc)
        <div class="modal fade" id="delete_data_{{ $dc->username }}" tabindex="-1" role="dialog" aria-labelledby="delete_data_{{ $dc->username }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are Sure To Delete This Items</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="">Hapus</a>
                </div>
                </div>
            </div>
        </div>
        @endforeach


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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script>
        $(function () {
            $("#tabel_admin").DataTable({
                responsive:true,
            });
            $("#tabel_department").DataTable({
                responsive:true,
            });
        });
    </script>
@endsection