<!-- Brand Logo -->
<a href="index3.html" class="brand-link text-center">
    <span class="brand-text font-weight-light">Feedback Untuk Heggi</span>
</a>
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }} " class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a style="text-decoration:none" class="d-block">{{ Session::get('user') }}</a>
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
                <a href="{{ url('home') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Home
                    <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('dashboard-admin') }}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Kelola Akses
                    <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link">
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