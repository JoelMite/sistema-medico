@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

  <!-- Main content -->
  <div class="main-content">

    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <!-- <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.html">User profile</a> -->

      </div>
    </nav>
    <!-- Header -->
    <!-- <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;"> -->
      <!-- Mask -->
      <!-- <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center">
      <span class="mask bg-gradient-default opacity-8"></span> -->
      <!-- Header container -->
      <!-- <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-19 col-md-19"> -->
            <!-- <h1 class="display-2 text-white">Hello Jesse</h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p> -->
            <!-- <a href="#!" class="btn btn-info">Historia Clinica</a>
            <a href="#!" class="btn btn-info">Consulta Medica</a>
            <a href="#!" class="btn btn-info">Prescripcion Medica</a>
            <a href="#!" class="btn btn-info">Prueba de Laboratorio</a>
            <a href="#!" class="btn btn-info">Cita Medica</a>
          </div>
        </div>
      </div> -->
    <!-- </div> -->
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <!-- <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="../assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">22</span>
                      <span class="description">Friends</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Photos</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Comments</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  Jessica Jones<span class="font-weight-light">, 27</span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>Bucharest, Romania
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of Computer Science
                </div>
                <hr class="my-4" />
                <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
                <a href="#">Show more</a>
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-xl-8 order-xl-1 center"> <!-- Aqui le coloque un "center" para que se alinie toda la informacion -->
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Datos Personales</h3>
                </div>
                <div class="col-4 text-right">
                  <!-- <a href="#!" class="btn btn-sm btn-primary">Editar</a> -->
                  <a href="#!" class="btn btn-sm btn-success">Activar o Desactivar</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Información</h6>
                <div class="pl-lg-4">
                  <div class="row">

                    @foreach ($rols as $rol)
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Rol</label>
                        <input type="text" id="input-rols" class="form-control form-control-alternative" value="{{ $rol->name }}">
                      </div>
                    </div>
                    @endforeach

                    <div class="col-lg-8">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" value="{{ $doctor->email }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">

                    @if($persons != null)
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Nombres</label>
                        <input type="text" id="input-name" class="form-control form-control-alternative" value="{{ $doctor->persons->name ? $doctor->persons->name:'No hay datos' }}">
                      </div>
                    </div>
                    @endif

                    @if($persons != null)
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Apellidos</label>
                        <input type="text" id="input-last-name" class="form-control form-control-alternative" value="{{ $doctor->persons->lastname ? $doctor->persons->lastname:'No hay datos' }}">
                      </div>
                    </div>
                    @endif

                    </div>
                    <div class="row">

                    @if($persons != null)
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Edad</label>
                        <input type="text" id="input-age" class="form-control form-control-alternative" value="{{ $doctor->persons->age ? $doctor->persons->age:'No hay datos' }}">
                      </div>
                    </div>
                    @endif

                    @if($persons != null)
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Sexo</label>
                        <input type="text" id="input-sex" class="form-control form-control-alternative" value="{{ $doctor->persons->sex ? $doctor->persons->sex:'No hay datos' }}">
                      </div>
                    </div>
                    @endif

                  </div>
                </div>
                @if($persons != null)
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Información Adicional</h6>
                <div class="pl-lg-4">
                  <div class="row">

                    @if($persons != null)
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Dirección</label>
                        <input id="input-address" class="form-control form-control-alternative" value="{{ $doctor->persons->address ? $doctor->persons->address:'No hay datos' }}" type="text">
                      </div>
                    </div>
                    @endif

                  </div>
                  <div class="row">

                    @if($persons != null)
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Telefono</label>
                        <input type="text" id="input-phone" class="form-control form-control-alternative" value="{{ $doctor->persons->phone ? $doctor->persons->phone:'No hay datos' }}">
                      </div>
                    </div>
                    @endif

                    @if($persons != null)
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Ciudad</label>
                        <input type="text" id="input-city" class="form-control form-control-alternative" value="{{ $doctor->persons->city ? $doctor->persons->city:'No hay datos' }}">
                      </div>
                    </div>
                    @endif

                    @if($persons != null)
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Etnia</label>
                        <input type="text" id="input-etnia" class="form-control form-control-alternative" value="{{ $doctor->persons->etnia ? $doctor->persons->etnia:'No hay datos' }}">
                      </div>
                    </div>
                    @endif
                  </div>
                </div>
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
