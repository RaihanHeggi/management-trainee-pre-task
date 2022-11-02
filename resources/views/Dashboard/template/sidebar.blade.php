<style>
    #company-logo{
        background-color: #5e514d !important 
    }

    .sidebar { 
        background-color: #776e64 !important;
    }

</style>


<!-- Brand Logo -->
<a href="#" id="company-logo" class="brand-link text-center">
    <img src="{{ asset('assets/images/KB_SymbolMark.png') }}" style="width:40%;height:40%" class="img" alt="Company Logo">
</a>
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }} " class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info ml-2">
            <a style="text-decoration:none;font-size:20px" class="d-block">{{ $data->name }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
        </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Home
                    <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('dashboard-admin') }}" class="nav-link">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Working Attendance
                </p>
                </a>
            </li>



            @if(Auth::user()->user_role == "Admin" || Auth::user()->user_role == "Karyawan")
                <li class="nav-item">
                    <a href="{{ url('dashboard-admin') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Admin Management
                        <!-- <i class="right fas fa-angle-left"></i> -->
                    </p>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                    <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
                </a>
            </li>
        </ul>
    </nav>
<!-- /.sidebar-menu -->
</div>