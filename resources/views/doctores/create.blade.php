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
            <h3 class="mb-0">Crear Usuario</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('doctores')}}" class="btn btn-sm btn-default">
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
          <form action="{{url('doctores')}}" method="post">
            @csrf
            <div class="form-group">
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
              <label for="contraseña">Contraseña</label>
              <input type="password" name="password" class="form-control" value="{{ old('password') }}" required>
            </div>
            <div class="form-group">
              <label for="name">Especialidad</label>
              <select class="form-control selectpicker" name="specialties[]" id="specialties" data-style="btn-outline-info" multiple title="Seleccione una o varias especialidades">
                @foreach ($specialties as $specialty)
                  <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
              </select>
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
              <input type="text" name="etnia" class="form-control" value="{{ old('etnia') }}" required>
            </div>
            <div class="form-group">
              <label for="name">Sexo</label>
              <input type="text" name="sex" class="form-control" value="{{ old('sex') }}" required>
            </div>
            <!-- <div class="form-group">
              <label for="datebirth">Fecha de Nacimento</label>
              <input type="date" name="datebirth" class="form-control" value="{{ old('datebirth') }}" required>
            </div> -->
            <div class="form-group">
              <label for="rols">Roles</label>
              <select class="form-control selectpicker" name="rols" id="rols" data-style="btn-secondary">
                @foreach ($rols as $rol)
                  <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                @endforeach
              </select>
            </div>

            <button type="submit" class="btn btn-primary">
              Guardar
            </button>
          </form>

<!-- A partir de aqui no me guarda con ese form el usuario dentro una sesion -->

          <!-- <form role="form" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
              <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" placeholder="Nombre" type="text" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control" placeholder="Email" type="email" name="email"
                value="{{ old('email') }}" required autocomplete="email">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="Contraseña" type="password" name="password"
                required autocomplete="new-password">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="Confirmar contraseña" type="password" name="password_confirmation"
                required autocomplete="new-password">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary mt-4">Confirmar registro</button>
            </div>
          </form> -->
      </div>
      </div>

@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
