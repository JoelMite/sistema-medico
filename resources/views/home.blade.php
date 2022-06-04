@extends('layouts.panel')

@section('dashboard')
    <!-- <div class="row justify-content-center">

    </div> -->

{{-- <div class="row"> --}}
  {{-- <div class="col-md-12 mb-4">
      <div class="card">
          <div class="card-header">Dashboard</div>

          <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif

              Bienvenido! Por favor seleccione una opción del menú lateral izquierdo.
          </div>
      </div>
  </div> --}}

  {{-- @if(auth()->user()->rols()->first()->name == 'Administrador') --}}

  @can('haveaccess','administrator.dashboard')

    <home-dashboard-administrator-component></home-dashboard-administrator-component>
  @endcan

  @can('haveaccess','patient.dashboard')

    <home-dashboard-patient-component></home-dashboard-patient-component>

  @endcan

  {{-- @elseif(auth()->user()->rols()->first()->name == 'Medico') --}}

  @can('haveaccess','doctor.dashboard')

    <home-dashboard-doctor-component></home-dashboard-doctor-component>

    <div class="row align-items-center py-4">
      <div class="col-lg-6 col-7">
          <h6 class="h2 d-inline-block mb-0">Médico</h6>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 mb-5 mb-xl-0">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase ls-1 mb-1">Notificación General</h6>
                <h5 class="h3 mb-0">Enviar a todos mis pacientes</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            {{-- @if(session('success'))
              <div class="alert alert-success" role="alert">
                {{ session('success') }}
              </div>
            @endif --}}
            <form action="{{ url('/fcm/send') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="title">Título</label>
                {{-- <input value="{{ config('app.name') }}" type="text" class="form-control" name="title" id="title" required> --}}
                <input placeholder="Ingresa un título." type="text" class="form-control" name="title" id="title" required>
              </div>
              <div class="form-group">
                <label for="body">Mensaje</label>
                <textarea name="body" id="body" rows="2" class="form-control" placeholder="Escribe un breve mensaje para tus pacientes." required></textarea>
              </div>
              <button class="btn btn-success">Enviar Notificación</button>
            </form>
          </div>
        </div>
      </div>

      {{-- <div class="col-xl-6">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Total de citas</h6>
                <h5 class="h3 mb-0">Según días de la semana</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- Chart -->
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas"></canvas>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
  @endcan
  {{-- @endif --}}
@endsection

@section('scripts')
@if(session('success'))
    <script>
      $.notify({
        title: '<strong>Exito!</strong><br>',
        message: ' {{ session('success') }} '
      },{
        type: 'success',
        animate: {
          enter: 'animated fadeInRight',
          exit: 'animated fadeOutRight'
        }
      });
    </script>
@endif
@endsection
