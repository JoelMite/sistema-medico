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
            <h3 class="mb-0">Crear Paciente</h3>
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
          <form action="{{url('patients')}}" method="post">
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
            </div>
            <!-- <div class="form-group">
              <label for="datebirth">Fecha de Nacimento</label>
              <input type="date" name="datebirth" class="form-control" value="{{ old('datebirth') }}" required>
            </div> -->

            <button type="submit" class="btn btn-primary">
              Guardar
            </button>
          </form>
      </div>
      </div>

@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
