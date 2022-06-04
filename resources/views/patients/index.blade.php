@extends('layouts.panel')

@section('content')
    <!-- <div class="row justify-content-center">
    </div> -->
<!--<div class="row">
  <div class="col-md-12 mb-4">
      <div class="card">
          <div class="card-header">Dashboard</div>

          <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif

              You are logged in!
          </div>
      </div>
  </div>
  <div class="col-xl-8 mb-5 mb-xl-0">
    <div class="card bg-gradient-default shadow">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
            <h2 class="text-white mb-0">Sales value</h2>
          </div>
          <div class="col">
            <ul class="nav nav-pills justify-content-end">
              <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                  <span class="d-none d-md-block">Month</span>
                  <span class="d-md-none">M</span>
                </a>
              </li>
              <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                  <span class="d-none d-md-block">Week</span>
                  <span class="d-md-none">W</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body"> -->
        <!-- Chart -->
        <!-- <div class="chart"> -->
          <!-- Chart wrapper -->
          <!-- <canvas id="chart-sales" class="chart-canvas"></canvas>
        </div>
      </div>
    </div>
  </div> -->
  <!-- <div class="col-xl-4">
    <div class="card shadow">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
            <h2 class="mb-0">Total orders</h2>
          </div>
        </div>
      </div>
      <div class="card-body"> -->
        <!-- Chart -->
        <!-- <div class="chart">
          <canvas id="chart-orders" class="chart-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>
</div> -->
<!-- <div class="row mt-5">
  <div class="col-xl-8 mb-5 mb-xl-0"> -->
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Pacientes</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('patients/create')}}" class="btn btn-success">
              Nuevo Paciente
            </a>
          </div>
        </div>
      </div>

      {{-- @if(session('notification'))
      <div class="card-body">
        <div class="alert alert-success" role="alert">
          {{ session('notification') }}
        </div>
      </div>
      @endif

      @if(session('warning'))
      <div class="card-body">
        <div class="alert alert-warning" role="alert">
          {{ session('warning') }}
        </div>
      </div>
      @endif --}}

      <div class="table-responsive py-4">
        <table class="table table-striped table-bordered" id="datatable">
          <thead class="thead-light">
            <tr>
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Telefono</th>
              <th scope="col">Domicilio</th>
              <th scope="col">Ciudad</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($patients as $patient)
                {{-- @foreach ($patient->rols as $rol) --}}
                  {{-- @if($rol->name == 'Paciente') --}}
                  <tr>
                    {{-- <td>
                      {{ $patient->email }}
                    </td> --}}
                    <td>
                      {{ $patient->person->name }}
                    </td>
                    <td>
                      {{ $patient->person->lastname }}
                    </td>
                    <td>
                      {{ $patient->person->phone }}
                    </td>
                    <td>
                      {{ $patient->person->address }}
                    </td>
                    <td>
                      {{ $patient->person->city }}
                    </td>
                    <td>
                      <a href="{{ url('/patients/'.$patient->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                      <a href="{{ url('/patients/'.$patient->id) }}" class="btn btn-sm btn-warning">Ver</a>
                      @if($patient->state == '403')
                        <a href="{{ url('/patients/'.$patient->id.'/state') }}" class="btn btn-sm btn-success">Activar</a>
                      @elseif($patient->state == '200')
                        <a href="{{ url('/patients/'.$patient->id.'/state') }}" class="btn btn-sm btn-danger">Banear</a>
                      @endif
                    </td>
                  </tr>
                  {{-- @endif --}}
                {{-- @endforeach --}}
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- <div class="card-body">
        {{ $patients->links() }}
      </div> --}}
    </div>

@endsection

@section('scripts')
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script> --}}

<script src="{{ asset('/js/datatable/table.js') }}"></script>

  @if(session('warning'))
    <script>
    $.notify({
    	title: '<strong>Error!</strong><br>',
    	message: '{{ session('warning') }}'
    },{
    	type: 'danger',
      animate: {
    		enter: 'animated bounceInDown',
    		exit: 'animated bounceOutUp'
  	  }
    });
    </script>
  @endif

  @if(session('success'))
      <script>
      $.notify({
      	title: '<strong>Exito!</strong><br>',
      	message: '{{ session('success') }}'
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

