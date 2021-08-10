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
        <h3 class="mb-0">Nuevo Paciente</h3>
      </div>
      <div class="col text-right">
        <a href="{{url('patients')}}" class="btn btn-warning">
          Volver
        </a>
      </div>
      {{-- <div class="col text-right">
            <a href="{{url('patients')}}" class="btn btn-sm btn-default">
      Cancelar y Volver
      </a>
    </div> --}}
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
  <form class="needs-validation" action="{{url('patients')}}" method="post">
    @csrf
    <div class="accordion" id="acordeon-01">
      <!-- Primer elemento hijo-->

      <div class="form-group">
        <div class="form-group" id="boton-collapse-1">
          <button class="btn btn-info btn-lg btn-block text-left" type="button" data-toggle="collapse"
            data-target="#contenido-btn-1" aria-expanded="true" aria-controls="contenido-btn-1">Datos Personales <i
              class="ni ni-check-bold text-white"></i></button>
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
                    value="{{ old('name') }}" required>
                  {{-- <div class="valid-feedback">Looks good!</div> --}}
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
                  <input type="text" name="lastname" placeholder="Apellidos Completos" class="form-control"
                    value="{{ old('lastname') }}" required>
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
                  <input type="text" name="dni" placeholder="Cédula" class="form-control" value="{{ old('dni') }}"
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
            data-target="#contenido-btn-2" aria-expanded="false" aria-controls="contenido-btn-2">Datos de Usuario <i
              class="ni ni-check-bold text-white"></i></button>
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
                  <input type="email" name="email" placeholder="name@example.com" class="form-control"
                    value="{{ old('email') }}" required>
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
                  <input type="text" name="password" placeholder="******" class="form-control"
                    value="{{ Str::random(6) }}" required>
                  <div class="invalid-feedback">Este campo es obligatorio.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tercer elemento hijo-->
      <div class="form-group">
        <div class="form-group" id="boton-collapse-3">
          <button class="btn btn-primary btn-lg btn-block text-left collapsed" type="button" data-toggle="collapse"
            data-target="#contenido-btn-3" aria-expanded="false" aria-controls="contenido-btn-3">Datos Adicionales <i
              class="ni ni-check-bold text-white"></i></button>
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
                  <input type="text" name="phone" placeholder="Número Telefónico o Celular" class="form-control"
                    value="{{ old('phone') }}" required>
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
                  <input type="text" name="address" placeholder="Dirección Domiciliaria" class="form-control"
                    value="{{ old('address') }}" required>
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
                  <input type="text" name="city" placeholder="Ciudad" class="form-control" value="{{ old('city') }}"
                    required>
                  <div class="invalid-feedback">Este campo es obligatorio.</div>
                </div>
              </div>
            </div>
            {{-- <div class="form-group">
                            <label for="name">Edad</label>
                            <input type="text" name="age" class="form-control" value="{{ old('age') }}" required>
          </div> --}}
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label class="form-control-label">Etnia</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-city"></i></span>
                </div>
                <select class="form-control selectpicker" name="etnia" id="etnia" data-style="btn-primary text-white"
                  title="Seleccione una etnia" required>
                  <option value="Mestizo" @if(old('etnia')=="Mestizo" ) selected @endif>Mestizo</option>
                  <option value="Afroamericano" @if(old('etnia')=="Afroamericano" ) selected @endif>Afroamericano
                  </option>
                  <option value="Indígena" @if(old('etnia')=="Indígena" ) selected @endif>Indígena</option>
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
                <input class="form-control datepicker" placeholder="Seleccione una fecha de nacimiento" id="date_birth"
                  name="date_birth" type="text" value="{{ old('date_birth') }}" data-date-format="yyyy-mm-dd" required>
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
                  <option value="Masculino" @if(old('sex')=="Masculino" ) selected @endif>Masculino</option>
                  <option value="Femenino" @if(old('sex')=="Femenino" ) selected @endif>Femenino</option>
                </select>
                <div class="invalid-feedback">Este campo es obligatorio.</div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="form-group">
                          <label for="datebirth">Fecha de Nacimento</label>
                          <input type="date" name="datebirth" class="form-control" value="{{ old('datebirth') }}" required>
                        </div> -->
      </div>
    </div>
    {{-- <div class="form-group">
                <h6 class="heading-small text-muted mb-4">Datos Personales</h6>
                <label for="name">Nombres</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
</div>
<div class="form-group">
  <label for="name">Apellidos</label>
  <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
</div>

<hr class="my-4" />
<h6 class="heading-small text-muted mb-4">Datos de Usuario</h6>
<div class="form-group">
  <label for="email">Email</label>
  <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
</div>
<div class="form-group">
  <label for="password">Contraseña</label>
  <input type="text" name="password" class="form-control" value="{{ Str::random(15) }}" required>
</div>

<hr class="my-4" />
<h6 class="heading-small text-muted mb-4">Datos Adicionales</h6>
<div class="form-group">
  <label for="name">Telefono</label>
  <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
</div>
<div class="form-group">
  <label for="name">Direccion</label>
  <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
</div>
<div class="form-group">
  <label for="name">Ciudad</label>
  <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
</div>
<div class="form-group">
  <label for="name">Edad</label>
  <input type="text" name="age" class="form-control" value="{{ old('age') }}" required>
</div>
<div class="form-group">
  <label for="name">Etnia</label>
  <select class="form-control selectpicker" name="etnia" id="etnia" data-style="btn-secondary">
    <option value="Mestizo">Mestizo</option>
    <option value="Afroamericano">Afroamericano</option>
    <option value="Indigena">Indigena</option>
  </select>
</div>
<div class="form-group">
  <label for="name">Sexo</label>
  <select class="form-control selectpicker" name="sex" id="sex" data-style="btn-secondary">
    <option value="Masculino">Masculino</option>
    <option value="Femenino">Femenino</option>
  </select>
</div> --}}

<!-- <div class="form-group">
              <label for="datebirth">Fecha de Nacimento</label>
              <input type="date" name="datebirth" class="form-control" value="{{ old('datebirth') }}" required>
            </div> -->

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
<script src="{{ asset('/js/validate/validation.js') }}"></script>
<script>
  $(document).ready(() => {
      $('#date_birth').datepicker('val');
  });

</script>
@endsection