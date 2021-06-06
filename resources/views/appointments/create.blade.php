@extends('layouts.panel')

@section('content')

    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Registrar Cita</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('patients')}}" class="btn btn-danger">
              Cancelar y Volver
            </a>
          </div>
        </div>
        </div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form action="{{url('appointment_medicals')}}" method="post">
            @csrf

            <div class="form-group">
              <label for="description">Descripcion</label>
              <input name="description" id="description" type="text" class="form-control" value="{{ old('description')}}" placeholder="Describe brevemente tu cita con el medico." required>
            </div>

            <create-appointment-component></create-appointment-component>

            <div class="form-group">
              <label for="phone">Tipo de Consulta</label>
                <div class="custom-control custom-radio mb-3">
                  <input name="type" class="custom-control-input" id="type1" checked type="radio"
                  @if(old('type', 'Consulta médica') == 'Consulta médica') checked @endif value="Consulta médica">
                  <label class="custom-control-label" for="type1">Consulta médica</label>
                </div>
                <div class="custom-control custom-radio mb-3">
                  <input name="type"class="custom-control-input" id="type2" type="radio"
                  @if(old('type', 'Revisión de examenes clinicos') == 'Revisión de examenes clinicos') checked @endif value="Revisión de examenes clinicos">
                  <label class="custom-control-label" for="type2">Revisión de examenes clinicos</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
              Guardar
            </button>
          </form>
      </div>
      </div>

@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
@endsection
