@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Crear Consulta Médica</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('medical_consultations')}}" class="btn btn-danger">
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
          <form action="{{url('medical_consultations')}}" method="post">
            @csrf
            {{-- @if($histories != null)
              <div class="form-group" style="display: none;">
                <label class="form-control-label" for="input-first-name">Identificador</label>
                <input type="text" name="id_history" class="form-control form-control-alternative" value="{{ $histories->id ? $histories->id:'No hay datos' }}">
              </div>
            @endif --}}

            <div class="accordion" id="acordeon-01">
              <!-- Primer elemento hijo-->
              <div class="form-group">
                <div class="form-group" id="boton-collapse-1">
                  <button class="btn btn-info btn-lg btn-block text-left" type="button" data-toggle="collapse"
                  data-target="#contenido-btn-1" aria-expanded="true"
                  aria-controls="contenido-btn-1">Consulta Médica<i class="ni ni-check-bold text-white" ></i></button>
                </div>

            {{-- <h6 class="heading-small text-muted mb-4">Consulta Medica</h6> --}}
                {{-- <div class="form-group"> --}}

                <!-- Contenedor -->
                <div class="collapse show" id="contenido-btn-1" aria-labelledby="boton-collapse-1"
                data-parent="#acordeon-01">
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="name">Motivo</label>
                        <textarea name="reason" class="form-control" value="{{ old('reason') }}" required></textarea>
                      </div>
                    </div>
                {{-- </div> --}}
                {{-- <div class="form-group"> --}}
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="name">Diagnóstico</label>
                        <textarea name="diagnosis" class="form-control" value="{{ old('diagnosis') }}" required></textarea>
                      </div>
                    </div>
                {{-- </div> --}}
                {{-- <div class="form-group"> --}}
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="name">Observaciones</label>
                        <textarea name="observations" class="form-control" value="{{ old('observations') }}" required></textarea>
                      </div>
                    </div>
                {{-- </div> --}}
                  </div>
                </div>
              </div>

              <!-- Segundo elemento hijo-->
              <div class="form-group">
                <div class="form-group" id="boton-collapse-2">
                  <button class="btn btn-warning btn-lg btn-block text-left collapsed" type="button" data-toggle="collapse"
                  data-target="#contenido-btn-2" aria-expanded="false"
                  aria-controls="contenido-btn-2">Mediciones Físicas<i class="ni ni-check-bold text-white" ></i></button>
                </div>
                <!-- Contenedor -->
                  <div class="collapse" id="contenido-btn-2" aria-labelledby="boton-collapse-2"
                  data-parent="#acordeon-01">
                    <div class="form-row">
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                      {{-- <div class="form-group"> --}}
                          <label for="name">Presión Arterial</label>
                          <input type="text" name="blood_pressure" class="form-control" value="{{ old('blood_pressure') }}" required>
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="name">Frecuencia Cardíaca</label>
                          <input type="text" name="heart_rate" class="form-control" value="{{ old('heart_rate') }}" required>
                          {{-- <textarea name="heart_rate" class="form-control" value="{{ old('heart_rate') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="name">Frecuencia Respiratoria</label>
                          <input type="text" name="breathing_frequency" class="form-control" value="{{ old('breathing_frequency') }}" required>
                          {{-- <textarea name="breathing_frequency" class="form-control" value="{{ old('breathing_frequency') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="name">Peso</label>
                          <input type="text" name="weight" class="form-control" value="{{ old('weight') }}" required>
                          {{-- <textarea name="weight" class="form-control" value="{{ old('weight') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="name">Altura</label>
                          <input type="text" name="height" class="form-control" value="{{ old('height') }}" required>
                          {{-- <textarea name="height" class="form-control" value="{{ old('height') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="name">IMC</label>
                          <input type="text" name="imc" class="form-control" value="{{ old('imc') }}" required>
                          {{-- <textarea name="imc" class="form-control" value="{{ old('imc') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="name">Perímetro Abdominal</label>
                          <input type="text" name="abdominal_perimeter" class="form-control" value="{{ old('abdominal_perimeter') }}" required>
                          {{-- <textarea name="abdominal_perimeter" class="form-control" value="{{ old('abdominal_perimeter') }}" required></textarea> --}}
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="name">Glucemia Capilar</label>
                          <input type="text" name="capillary_glucose" class="form-control" value="{{ old('capillary_glucose') }}" required>
                          {{-- <textarea name="capillary_glucose" class="form-control" value="{{ old('capillary_glucose') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="name">Temperatura</label>
                          <input type="text" name="temperature" class="form-control" value="{{ old('temperature') }}" required>
                          {{-- <textarea name="temperature" class="form-control" value="{{ old('temperature') }}" required></textarea> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                    <create-medical-consultation-component></create-medical-consultation-component>

              </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">
              Guardar
            </button>
          </div>
          </form>
      </div>
      </div>

@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
