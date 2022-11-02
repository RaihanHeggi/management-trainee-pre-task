@extends('Dashboard.template.template_dashboard')

@section('depedencies_upper')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
   
    <script src="https://kit.fontawesome.com/13a7b28a80.js" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    
    <!-- Styles -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .select2-container .select2-selection--single {
            height: 40px;
        }
    </style>
@endsection

@section('title_name')
    <title>Add User Data</title>
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
                        <h1 class="m-0">User Data</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Data Management</a></li>
                        <li class="breadcrumb-item active">Add User Data</li>
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
                        <h3 class="card-title">Adding New User Account</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('Login.template.flash-message')
                        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('user-input')}}">
                            @csrf
                            <div class="col-lg-6 connectedSortable" style="padding-left: 20px">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 120px;">Nama</span>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama" />
                                </div>
                                <br />
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 120px;">Username</span>
                                    <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping"/>
                                </div>
                                <br />
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 120px;">Password</span>
                                    <input type="password" class="form-control" name="password"  placeholder="Password" aria-label="Password" minlength="5" aria-describedby="addon-wrapping" />
                                </div>
                                <br />
                                
                                <div class="input-group">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 120px;">Department</span>
                                    <select class='form-control' data-width='83%' id='department_list' name='department'>
                                        <option value="">Choose Departement</option>
                                        @foreach ($data_department as $dw)
                                            <option value='{{ $dw->id}}'>{{ $dw->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 120px;">Position</span>
                                    <select class="form-control" data-width='83%' id="position" name="position">
                                        <option selected>Choose Position</option>
                                        <option name="position" value="PM">PM</option>
                                        <option name="position" value="Trainee">Trainee</option>
                                        <option name="position" value="Intern">Intern</option>
                                    </select>
                                </div>
                                <br />
                                <div class="input-group">
                                    <span class="input-group-text" id="addon-wrapping" style="width: 120px;">Access Level</span>
                                    <select class="form-control" data-width='83%' id="role_user" name="role_user">
                                        <option selected>Choose Access Level</option>
                                        <option name="role_user" value="Admin">Admin</option>
                                        <option name="role_user" value="Karyawan">Karyawan</option>
                                    </select>
                                </div>
                                <br />
                            </div>
                            <div class="text-center mt-3">
                                <a class="btn btn-secondary mt-3 w-40" href="{{ url('dashboard-admin') }}" role="button">Back</a>
                                <button style="background-color:#f2a900;border-color:#f2a900" type="submit" class="btn btn-success mt-3 w-40" name='action' >Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('#department_list').select2();    
            $('#position').select2();   
            $('#role_user').select2();
        });
    </script>

@endsection

@section('depedencies_bottom')
        
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
@endsection