@extends('layouts.panel')

@section('content')

    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Registrar Nueva Cita</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('patients')}}" class="btn btn-sm btn-default">
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
          <form action="{{url('appointments')}}" method="post">
            @csrf

            <div class="form-group">
              <label for="description">Descripcion</label>
              <input name="description" id="description" type="text" class="form-control" placeholder="Describe brevemente tu cita con el medico." required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="specialty">Especialidad</label>
                  <select class="form-control selectpicker" name="specialty_id" id="specialty" data-style="btn-secondary" required>
                    <option value="">Seleccionar especialidad</option>
                      @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group col-md-6">
                <label for="doctor">Medico</label>
                  <select class="form-control" name="doctor_id" id="doctor" required>

                  </select>
              </div>
            </div>

            <div class="form-group">
              <label for="name">Fecha</label>
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input class="form-control datepicker" placeholder="Select date"
                id="date" name = "schedule_date" type="text"
                value={{ date('Y-m-d') }}
                data-date-format="yyyy-mm-dd"
                data-date-start-date="{{ date('Y-m-d') }}">
              </div>
            </div>

            <div class="form-group">
              <label for="address">Hora de Atencion</label>
              <div id= "hours">
                <div class="alert alert-info" role="alert">
                    Seleccione un medico y una fecha para ver sus horarios disponibles.
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="phone">Tipo de Consulta</label>
                <div class="custom-control custom-radio mb-3">
                  <input name="type" value="consulta" class="custom-control-input" id="type1" checked type="radio">
                  <label class="custom-control-label" for="type1">Consulta</label>
                </div>
                <div class="custom-control custom-radio mb-3">
                  <input name="type" value="examen" class="custom-control-input" id="type2" type="radio">
                  <label class="custom-control-label" for="type2">Examen</label>
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
<script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/js/appointments/create.js') }}" ></script>
@endsection
