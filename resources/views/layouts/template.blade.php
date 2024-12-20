<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS Dependencies -->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <img src="{{asset('assets/logo-lldikti4.png')}}" width="70%">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('spmi_ppep') || request()->is('spmi_pt') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSPMI"
                    aria-expanded="true" aria-controls="collapseSPMI">
                    <i class="fas fa-fw fa-file"></i>
                    <span>SPMI PT</span>
                </a>
                <!-- Dropdown Menu -->
                <div id="collapseSPMI" class="collapse {{ request()->is('spmi_ppep') || request()->is('spmi_pt') || request()->is('detail/{pt}')  ? 'active' : '' }} ? 'show' : '' }}">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">SPMI PT</h6>
                        <!-- <a class="collapse-item {{ request()->is('fasilitator_wilayah') ? 'active' : '' }}" href="/fasilitator_wilayah">Verifikator SPMI</a> -->
                        <a class="collapse-item {{ request()->is('spmi_ppep') ? 'active' : '' }}" href="/spmi_ppep">Pelaporan SPMI per PPEP</a>
                        <a class="collapse-item {{ request()->is('spmi_pt') ? 'active' : '' }}" href="/spmi_pt">Pelaporan SPMI per PT</a> 
                    </div>
                </div>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <!-- Nav Item - Verifikator SPMI -->
            <li class="nav-item {{ request()->is('admin/fasilitator_wilayah') || request()->is('fasilitator_wilayah') ? 'active' : '' }}">
                @if(session('admin_username'))
                <a class="nav-link" href="/admin/fasilitator_wilayah">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Verifikator SPMI</span>
                </a>
                @else
                <a class="nav-link" href="/fasilitator_wilayah">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Verifikator SPMI</span>
                </a>
                @endif
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ request()->is('klasterisasi') ? 'active' : '' }}">
                <a class="nav-link" href="/klasterisasi">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Klasterisasi SPMI</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ request()->is('pt_pengimbas') || request()->is('admin/pt_pengimbas') ? 'active' : ''}}">
                @if(session('admin_username'))
                <a class="nav-link collapsed" href="/admin/pt_pengimbas">
                    <i class="fas fa-fw fa-building"></i>
                    <span>PT Pengimbas</span>
                </a>
                @else
                <a class="nav-link collapsed" href="/pt_pengimbas">
                    <i class="fas fa-fw fa-building"></i>
                    <span>PT Pengimbas</span>
                </a>
                @endif
            </li>


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item  {{request()->is('klinik_spmi') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKlinik"
                    aria-expanded="true" aria-controls="collapseKlinik">
                    <i class="fas fa-fw fa-hospital-alt"></i>
                    <span>Klinik SPMI</span>
                </a>    
                <div id="collapseKlinik" class="collapse {{ request()->is('klinik_spmi') || request()->is('visualisasi_spmi') || request()->is('detail/{pt}') ? 'show' : '' }}">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Klinik SPMI</h6>
                        @if(session('admin_username'))
                        <a class="collapse-item {{ request()->is('klinik_spmi') ? 'active' : '' }}" href="/admin/klinik_spmi">Data Klinik SPMI</a>
                        @else
                        <a class="collapse-item {{ request()->is('klinik_spmi') ? 'active' : '' }}" href="/klinik_spmi">Data Klinik SPMI</a>
                        @endif
                        <a class="collapse-item {{ request()->is('spmi_pt') ? 'active' : '' }}" href="/visualisasi_spmi">Visualisasi Klinik SPMI</a>
                    </div>
                </div>
            </li>

            <li class="nav-item  {{request()->is('direktori_pts') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDirektori"
                    aria-expanded="true" aria-controls="collapseDirektori">
                    <i class="fas fa-fw fa-folder-open"></i>
                    <span>Direktori PTS</span>
                </a>    
                <div id="collapseDirektori" class="collapse {{ request()->is('direktori_pts') || request()->is('sebaran_pts') || request()->is('detail/{pt}') ? 'show' : '' }}">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Direktori SPMI</h6>
                        <a class="collapse-item {{ request()->is('direktori_pts') ? 'active' : '' }}" href="/direktori_pts">Data Perguruan Tinggi</a>
                        <a class="collapse-item {{ request()->is('sebaran_pts') ? 'active' : '' }}" href="/sebaran_pts">Sebaran Perguruan Tinggi</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            @if(session('admin_username'))
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat datang, <b>{{ session('admin_username') }}</b> !</span>
                                </a>
                                
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            @else
                                <a class="nav-link d-flex align-items-center" href="/login" id="userDropdown">
                                    <img src="{{ asset('admin_assets/img/arrow-right-to-bracket-solid.svg') }}" class="me-2" height="20%">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Login</span>
                                </a>
                            @endif
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->  
                <div class="content-wrapper">
                     @yield('content')
                </div>


        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Akademik LLDIKTI IV 2024</span>
            </div>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript-->
        <!-- <script src="{{asset('admin_assets/vendor/jquery/jquery.min.js')}}"></script> -->
        <script src="{{asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('admin_assets/js/sb-admin-2.min.js')}}"></script>
</body>
</html>