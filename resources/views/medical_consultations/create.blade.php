@extends('layouts.panel')

@section('content')

    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Nueva Consulta Médica</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('medical_consultations')}}" class="btn btn-warning">
              Volver
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
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label class="form-control-label">Motivo</label>
                        <textarea name="reason" class="form-control" value="{{ old('reason') }}" rows="4" required></textarea>
                      </div>
                    </div>
                {{-- </div> --}}
                {{-- <div class="form-group"> --}}
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label class="form-control-label">Diagnóstico</label>
                        <textarea name="diagnosis" class="form-control" value="{{ old('diagnosis') }}" rows="4" required></textarea>
                      </div>
                    </div>
                {{-- </div> --}}
                {{-- <div class="form-group"> --}}
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label class="form-control-label">Observaciones</label>
                        <textarea name="observations" class="form-control" value="{{ old('observations') }}" rows="4" required></textarea>
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
                          <label class="form-control-label">Presión Arterial</label>
                          <div class="input-group">
                            <input type="text" name="blood_pressure" class="form-control" value="{{ old('blood_pressure') }}" required>
                            <div class="input-group-append">
                              <span class="input-group-text">mm Hg</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label class="form-control-label">Frecuencia Cardíaca</label>
                          <div class="input-group">
                            <input type="text" name="heart_rate" class="form-control" value="{{ old('heart_rate') }}" required>
                            <div class="input-group-append">
                              <span class="input-group-text">lpm</span>
                            </div>
                          </div>
                          {{-- <textarea name="heart_rate" class="form-control" value="{{ old('heart_rate') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label class="form-control-label">Frecuencia Respiratoria</label>
                          <div class="input-group">
                            <input type="text" name="breathing_frequency" class="form-control" value="{{ old('breathing_frequency') }}" required>
                            <div class="input-group-append">
                              <span class="input-group-text">rpm</span>
                            </div>
                          </div>
                          {{-- <textarea name="breathing_frequency" class="form-control" value="{{ old('breathing_frequency') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-1 mb-3">
                        <div class="form-group">
                          <label class="form-control-label">Peso</label>
                          <div class="input-group">
                            <input type="text" name="weight" class="form-control" value="{{ old('weight') }}" required>
                            <div class="input-group-append">
                              <span class="input-group-text">kg</span>
                            </div>
                          </div>
                          {{-- <textarea name="weight" class="form-control" value="{{ old('weight') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-1 mb-3">
                        <div class="form-group">
                          <label class="form-control-label">Estatura</label>
                          <div class="input-group">
                            <input type="text" name="height" class="form-control" value="{{ old('height') }}" required>
                            <div class="input-group-append">
                              <span class="input-group-text">m</span>
                            </div>
                          </div>
                          {{-- <textarea name="height" class="form-control" value="{{ old('height') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}

                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label class="form-control-label">Perímetro Abdominal</label>
                          <div class="input-group">
                            <input type="text" name="abdominal_perimeter" class="form-control" value="{{ old('abdominal_perimeter') }}" required>
                            <div class="input-group-append">
                              <span class="input-group-text">cm</span>
                            </div>
                          </div>
                          {{-- <textarea name="abdominal_perimeter" class="form-control" value="{{ old('abdominal_perimeter') }}" required></textarea> --}}
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label class="form-control-label">Glucemia Capilar</label>
                          <div class="input-group">
                            <input type="text" name="capillary_glucose" class="form-control" value="{{ old('capillary_glucose') }}" required>
                            <div class="input-group-append">
                              <span class="input-group-text">mg/dL</span>
                            </div>
                          </div>
                          {{-- <textarea name="capillary_glucose" class="form-control" value="{{ old('capillary_glucose') }}" required></textarea> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      {{-- <div class="form-group"> --}}
                      <div class="col-md-1 mb-3">
                        <div class="form-group">
                          <label class="form-control-label">Temperatura</label>
                          <div class="input-group">
                            <input type="text" name="temperature" class="form-control" value="{{ old('temperature') }}" required>
                            <div class="input-group-append">
                              <span class="input-group-text">°C</span>
                            </div>
                          </div>
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
