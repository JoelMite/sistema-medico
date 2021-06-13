@extends('layouts.panel')

@section('content')

    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Especialidades</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('specialties/create')}}" class="btn btn-success">
              Nueva Especialidad
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
          @endif --}}


      <div class="table-responsive py-4">
        <!-- Specialties table -->
        <table class="table table-striped table-bordered" id="datatable">
          <thead class="thead-light">
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($specialties as $specialty)
            <tr>
              <th scope="row">
                {{ $specialty->name }}
              </th>
              <td>
                {{ $specialty->description }}
              </td>
              <td>
                <a href="{{ url('/specialties/'.$specialty->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                <a href="" class="btn btn-sm btn-danger">Eliminar</a>
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
        enter: 'animated fadeInRight',
        exit: 'animated fadeOutRight'
      }
    });
    </script>
@endif

@endsection
