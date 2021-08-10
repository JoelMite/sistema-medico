@extends('layouts.panel')

@section('content')

    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Consulta Medica</h3>
          </div>
        </div>
      </div>

      {{-- @if(session('notification'))
      <div class="card-body">
        <div class="alert alert-success" role="alert">
          {{ session('notification') }}
        </div>
      </div>
      @endif --}}

      <div class="table-responsive py-4">
        <!-- doctores table -->
        <table class="table table-striped table-bordered" id="datatable">
          <thead class="thead-light">
            <tr>
              <!-- <th scope="col">Nombre</th> -->
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Teléfono</th>
              <th scope="col">Dirección</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($havePersonHistory as $person)
                  <tr>
                    <td>
                      {{ $person->name }}
                    </td>
                    <td>
                      {{ $person->lastname }}
                    </td>
                    <td>
                      {{ $person->phone }}
                    </td>
                    <td>
                      {{ $person->address }}
                    </td>
                    <td>
                      <a href="{{ url('medical_consultations/'.$person->id.'/create') }}" class="btn btn-sm btn-success">Crear Consulta Médica</a>
                    </td>
                  </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

@endsection

@section('scripts')

<script src="{{ asset('/js/datatable/table.js') }}"></script>

  @if(session('success'))
      <script>
      $.notify({
        title: '<strong>Exito!</strong><br>',
        message: '{{ session('success') }}'
      },{
        type: 'success',
        animate: {
          enter: 'animated bounceInDown',
          exit: 'animated bounceOutUp'
        }
      });
      </script>
  @endif

@endsection
