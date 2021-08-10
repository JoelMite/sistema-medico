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
        <h3 class="mb-0">Editar Paciente</h3>
      </div>
      <div class="col text-right">
        <a href="{{url('patients')}}" class="btn btn-warning">
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
    <form class="needs-validation" action="{{ url('patients/'.$patient->id) }}" method="post" novalidate>
      @csrf
      @method('PUT')

      <div class="accordion" id="acordeon-01">
        <!-- Primer elemento hijo-->
        <div class="form-group">
          <div class="form-group" id="boton-collapse-1">
            <button class="btn btn-info btn-lg btn-block text-left" type="button" data-toggle="collapse"
              data-target="#contenido-btn-1" aria-expanded="true" aria-controls="contenido-btn-1">Datos Personales
              <i class="ni ni-check-bold text-white"></i></button>
          </div>
          <!-- Contenedor -->
          <div class="collapse show" id="contenido-btn-1" aria-labelledby="boton-collapse-1" data-parent="#acordeon-01">
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label class="form-control-label">Nombres</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input type="text" name="name" placeholder="Nombres Completos" class="form-control"
                      value="{{ old('name', $patient->person->name) }}" required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label class="form-control-label">Apellidos</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input type="text" name="lastname" class="form-control"
                      value="{{ old('lastname', $patient->person->lastname) }}" required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label class="form-control-label">DNI</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-badge"></i></span>
                    </div>
                    <input type="text" name="dni" class="form-control" value="{{ old('dni', $patient->person->dni)  }}"
                      required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Segundo elemento hijo-->
        <div class="form-group">
          <div class="form-group" id="boton-collapse-2">
            <button class="btn btn-warning btn-lg btn-block text-left collapsed" type="button" data-toggle="collapse"
              data-target="#contenido-btn-2" aria-expanded="false" aria-controls="contenido-btn-2">Datos de Usuario
              <i class="ni ni-check-bold text-white"></i></button>
          </div>
          <!-- Contenedor -->
          <div class="collapse" id="contenido-btn-2" aria-labelledby="boton-collapse-2" data-parent="#acordeon-01">
            <div class="form-row">
              <div class="col-md-6 mb-2">
                <div class="form-group">
                  <label class="form-control-label">Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}"
                      required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <div class="form-group">
                  <label class="form-control-label">Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                    </div>
                    <input type="text" name="password" class="form-control" value="">
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                  <p>- Ingrese una contraseña sólo si desea modificarla.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Tercer elemento hijo-->
        <div class="form-group">
          <div class="form-group" id="boton-collapse-3">
            <button class="btn btn-primary btn-lg btn-block text-left collapsed" type="button" data-toggle="collapse"
              data-target="#contenido-btn-3" aria-expanded="false" aria-controls="contenido-btn-3">Datos Adicionales
              <i class="ni ni-check-bold text-white"></i></button>
          </div>
          <!-- Contenedor -->
          <div class="collapse" id="contenido-btn-3" aria-labelledby="boton-collapse-3" data-parent="#acordeon-01">
            <div class="form-row">
              <div class="col-md-6 mb-2">
                <div class="form-group">
                  <label class="form-control-label">Teléfono</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $patient->person->phone) }}"
                      required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <div class="form-group">
                  <label class="form-control-label">Dirección</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                    </div>
                    <input type="text" name="address" class="form-control"
                      value="{{ old('address', $patient->person->address) }}" required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <div class="form-group">
                  <label class="form-control-label">Ciudad</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-city"></i></span>
                    </div>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $patient->person->city) }}"
                      required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <div class="form-group">
                  <label class="form-control-label">Etnia</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-city"></i></span>
                    </div>
                    <select class="form-control selectpicker" name="etnia" id="etnia"
                      data-style="btn-primary text-white" title="Seleccione una etnia" required>
                      <option value="Mestizo">Mestizo</option>
                      <option value="Afroamericano">Afroamericano</option>
                      <option value="Indigena">Indigena</option>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <div class="form-group">
                  <label class="form-control-label">Fecha de Nacimiento</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker" placeholder="Seleccionar fecha" id="date_birth"
                      name="date_birth" type="text" data-date-format="yyyy-mm-dd"
                      value="{{ old('date_birth', $patient->person->date_birth) }}" required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <div class="form-group">
                  <label class="form-control-label">Sexo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-restroom"></i></span>
                    </div>
                    <select class="form-control selectpicker" name="sex" id="sex" data-style="btn-primary text-white"
                      title="Seleccione un género" required>
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
<script src="{{ asset('asset/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
{{-- <script src="{{ asset('/js/doctor/create.js') }}"></script> --}}
<script src="{{ asset('/js/validate/validation.js') }}"></script>

<script>
    $(document).ready(() => {
        $('#etnia').selectpicker('val', @json($patient->person->etnia));
        $('#sex').selectpicker('val', @json($patient->person->sex));
        $('#date_birth').datepicker('val');
    });
</script>
@endsection