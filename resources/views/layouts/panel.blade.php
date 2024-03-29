<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
  <title>Sistema de Seguimiento y Control Medico | {{ config('app.name') }}</title>
  <!-- Favicon -->
  <link href="{{ asset('asset/img/brand/favicon.png') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href=" {{ asset('asset/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link href=" {{ asset('asset/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href=" {{ asset('asset/vendor/animate.css/animate.min.css') }}" rel="stylesheet">

  <link href="{{ asset('asset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  {{-- <link href="{{ asset('asset/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"> --}}
  {{-- <link href="{{ asset('asset/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"> --}}
  <!-- Argon CSS -->
  <link href=" {{ asset('asset/css/argon.css') }}" rel="stylesheet">
  {{-- <link href=" {{ asset('css/plantilla.css') }} " rel="stylesheet"> --}}
  {{-- <link href=" {{ asset('css/app.css') }}" rel="stylesheet"> --}}
  @yield('styles')
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="/home">
          <img src="{{ asset('img/brand/Brand-Medical.png') }}" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->

          <ul class="navbar-nav">
            {{-- @if(auth()->user()->rols()->first()->name == 'Administrador') --}}
            @if(auth()->user()->can('haveaccess', 'administrator.dashboard') ||
            auth()->user()->can('haveaccess', 'doctor.dashboard') ||
            auth()->user()->can('haveaccess', 'patient.dashboard'))
            <li class="nav-item">
              <a class="nav-link" href="/home">
                <i class="ni ni-tv-2 text-red"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            @endif
            @can('haveaccess','role.index')
            <li class="nav-item">
              <a class="nav-link" href="/roles">
                <i class="ni ni-badge text-blue"></i>
                <span class="nav-link-text">Roles</span>
              </a>
            </li>
            @endcan
            <li class="nav-item">
              <a class="nav-link" href="/specialties">
                <i class="ni ni-active-40 text-green"></i>
                <span class="nav-link-text">Especialidades</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/doctors">
                <i class="ni ni-single-02 text-orange"></i>
                <span class="nav-link-text">Usuarios</span>
              </a>
            </li>
            {{-- @elseif(auth()->user()->rols()->first()->name == 'Medico') --}}
            {{-- <li class="nav-item">
              <a class="nav-link" href="/home">
                <i class="ni ni-tv-2 text-red"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="/histories">
                <i class="ni ni-collection text-default"></i>
                <span class="nav-link-text">Historia Clinica</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#navbar-dashboards" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
                <i class="fas fa-paste text-primary"></i>
                <span class="nav-link-text">Consulta Médica</span>
              </a>
              <div class="collapse show" id="navbar-dashboards">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="/medical_consultations" class="nav-link">Crear Consulta Médica</a>
                  </li>
                  <li class="nav-item">
                    <a href="/medical_consultations_show" class="nav-link">Ver Consultas Médicas</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/schedule">
                <i class="ni ni-calendar-grid-58 text-red"></i>
                <span class="nav-link-text">Gestionar Horario</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/appointment_medicals_doctor">
                <i class="fas fa-book-medical"></i>
                <span class="nav-link-text">Mis citas (Doctor)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/patients">
                <i class="ni ni-satisfied text-yellow"></i>
                <span class="nav-link-text">Mis Pacientes</span>
              </a>
            </li>
            {{-- @elseif(auth()->user()->rols()->first()->name == 'Paciente') --}}
            {{-- <li class="nav-item">
              <a class="nav-link" href="/home">
                <i class="ni ni-tv-2 text-red"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="/appointment_medicals/create">
                <i class="ni ni-ruler-pencil text-purple"></i>
                <span class="nav-link-text">Reservar Cita</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/appointment_medicals_patient">
                <i class="fas fa-book-medical"></i>
                <span class="nav-link-text">Mis Citas (Paciente)</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="/appointmentmedicals_prueba/prueba">
                <i class="ni ni-satisfied text-yellow"></i>
                <span class="nav-link-text">Prueba Citas</span>
              </a>
            </li> --}}
            {{-- @endif --}}
            <li class="nav-item">
              <a class="nav-link" href="/profile">
                <i class="ni ni-circle-08 text-blue"></i>
                <span class="nav-link-text">Mi Perfil</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logoutUser') }}" >
              {{-- <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('formLogout').submit();"> --}}
                <i class="ni ni-key-25"></i>
                <span class="nav-link-text">Cerrar sesión</span>
              </a>
              {{-- <form action="{{ route('logout') }}" method="POST" style="display:none;" id="formLogout">
                @csrf

              </form> --}}
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Documentation</h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html" target="_blank">
                <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">Getting started</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank">
                <i class="ni ni-palette"></i>
                <span class="nav-link-text">Foundation</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html" target="_blank">
                <i class="ni ni-ui-04"></i>
                <span class="nav-link-text">Components</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html" target="_blank">
                <i class="ni ni-chart-pie-35"></i>
                <span class="nav-link-text">Plugins</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div id="app" class="main-content">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          {{-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form> --}}
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            {{-- <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li> --}}
            {{-- <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-bell-55"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                  <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</h6>
                </div>
                <!-- List group -->
                <div class="list-group list-group-flush">
                  <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg" class="avatar rounded-circle">
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                          </div>
                          <div class="text-right text-muted">
                            <small>2 hrs ago</small>
                          </div>
                        </div>
                        <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                      </div>
                    </div>
                  </a>
                  <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="../../assets/img/theme/team-2.jpg" class="avatar rounded-circle">
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                          </div>
                          <div class="text-right text-muted">
                            <small>3 hrs ago</small>
                          </div>
                        </div>
                        <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                      </div>
                    </div>
                  </a>
                  <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="../../assets/img/theme/team-3.jpg" class="avatar rounded-circle">
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                          </div>
                          <div class="text-right text-muted">
                            <small>5 hrs ago</small>
                          </div>
                        </div>
                        <p class="text-sm mb-0">Your posts have been liked a lot.</p>
                      </div>
                    </div>
                  </a>
                  <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="../../assets/img/theme/team-4.jpg" class="avatar rounded-circle">
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                          </div>
                          <div class="text-right text-muted">
                            <small>2 hrs ago</small>
                          </div>
                        </div>
                        <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                      </div>
                    </div>
                  </a>
                  <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="../../assets/img/theme/team-5.jpg" class="avatar rounded-circle">
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                          </div>
                          <div class="text-right text-muted">
                            <small>3 hrs ago</small>
                          </div>
                        </div>
                        <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                      </div>
                    </div>
                  </a>
                </div>
                <!-- View all -->
                <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
              </div>
            </li> --}}
            {{-- <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-ungroup"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                <div class="row shortcuts px-4">
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                      <i class="ni ni-calendar-grid-58"></i>
                    </span>
                    <small>Calendar</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                      <i class="ni ni-email-83"></i>
                    </span>
                    <small>Email</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                      <i class="ni ni-credit-card"></i>
                    </span>
                    <small>Payments</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                      <i class="ni ni-books"></i>
                    </span>
                    <small>Reports</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                      <i class="ni ni-pin-3"></i>
                    </span>
                    <small>Maps</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                      <i class="ni ni-basket"></i>
                    </span>
                    <small>Shop</small>
                  </a>
                </div>
              </div>
            </li> --}}
          </ul>
          <ul class="navbar-nav align-items-center ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  {{-- <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{ asset('asset/img/theme/team-4.jpg') }}">
                  </span> --}}
                  {{-- <div class="media-body ml-2 d-none d-lg-block"> --}}
                    <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->person()->first()->name }}</span>
                  {{-- </div> --}}
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Bienvenido!</h6>
                </div>
                <a href="/profile" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>Mi perfil</span>
                </a>
                {{-- <a href="#!" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Ajustes</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Actividad</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Soporte</span>
                </a> --}}
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logoutUser') }}" >
                {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('formLogout').submit();"> --}}
                  <i class="ni ni-key-25"></i>
                  <span class="nav-link-text">Cerrar sesión</span>
                </a>
                {{-- <form action="{{ route('logout') }}" method="POST" style="display:none;" id="formLogout">
                  @csrf

                </form> --}}
                {{-- <a href="#!" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Cerrar sesión</span>
                </a> --}}
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header pb-6">
      <div class="container-fluid">
        <div class="header-body">
          
          @yield('dashboard')
          <!-- Card stats -->
          {{-- <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total traffic</h5>
                      <span class="h2 font-weight-bold mb-0">350,897</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                      <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                      <span class="h2 font-weight-bold mb-0">924</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                      <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <!-- Page content -->

    <div class="container-fluid mt--6">
      <div class="row align-items-center py-4">
        {{-- <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
              <li class="breadcrumb-item active" aria-current="page">Default</li>
            </ol>
          </nav>
        </div> --}}
        {{-- <div class="col-lg-6 col-5 text-right">
          <a href="#" class="btn btn-sm btn-neutral">New</a>
          <a href="#" class="btn btn-sm btn-neutral">Filters</a>
        </div> --}}
      </div>
      @yield('content')

      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center text-lg-left text-muted">
              &copy; 2021 <a href="#" class="font-weight-bold ml-1" target="_blank">{{ config('app.name') }}</a>
            </div>
          </div>
          {{-- <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link" target="_blank">License</a>
              </li>
            </ul>
          </div> --}}
        </div>
      </footer>

    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src=" {{ asset('asset/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src=" {{ asset('asset/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src=" {{ asset('asset/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <script src=" {{ asset('asset/vendor/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

  <script src=" {{ asset('asset/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  {{-- <script src=" {{ asset('asset/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src=" {{ asset('asset/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script> --}}

  @yield('scripts')
  <!-- Argon JS -->

  {{-- <script src=" {{ asset('js/app.js') }} "></script> --}}
  <script src=" {{ asset('asset/js/argon.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  {{-- <script src=" {{ asset('js/plantilla.js') }} "></script>  --}}
</body>

</html>
