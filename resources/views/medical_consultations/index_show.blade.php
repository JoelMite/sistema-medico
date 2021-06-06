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

      @if(session('notification'))
      <div class="card-body">
        <div class="alert alert-success" role="alert">
          {{ session('notification') }}
        </div>
      </div>
      @endif


      <div class="table-responsive">
        <!-- doctores table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <!-- <th scope="col">Nombre</th> -->
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Fecha</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($variable as $person)
                  <tr>
                    <td>
                      {{ $person->name }}
                    </td>
                    <td>
                      {{ $person->lastname }}
                    </td>
                    <td>
                      {{ $person->created_at ?? "No hay datos"}}
                    </td>
                    <td>
                      <a href="{{ url('medical_consultations_pdf/'.$person->medical_consultations_id) }}" class="btn btn-sm btn-warning">Ver Consulta Médica PDF</a>
                      <a href="{{ url('medical_consultations_export_pdf/'.$person->medical_consultations_id) }}" class="btn btn-sm btn-success">Exportar Consulta Médica PDF</a>
                    </td>
                  </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

@endsection
