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
            <h3 class="mb-0">Activar Medico</h3>
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
          <form action="{{ url('doctores') }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="name">Nombres</label>
              <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}"  required>
            </div>
            <div class="form-group">
              <label for="lastname">Apellidos</label>
              <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $doctor->lastname) }}" required>
            </div>
            <div class="form-group">
              <label for="phone">Telefono</label>
              <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}" required>
            </div>
            <div class="form-group">
              <label for="address">Direccion</label>
              <input type="text" name="address" class="form-control" value="{{ old('address', $doctor->address) }}" required>
            </div>
            <div class="form-group">
              <label for="city">Ciudad</label>
              <input type="text" name="city" class="form-control" value="{{ old('city', $doctor->city) }}" required>
            </div>
            <div class="form-group">
              <label for="age">Edad</label>
              <input type="text" name="age" class="form-control" value="{{ old('age', $doctor->age) }}"  required>
            </div>
            <div class="form-group">
              <label for="etnia">Etnia</label>
              <input type="text" name="etnia" class="form-control" value="{{ old('etnia', $doctor->etnia) }}" required>
            </div>
            <div class="form-group">
              <label for="sex">Sexo</label>
              <input type="text" name="sex" class="form-control" value="{{ old('sex', $doctor->sex) }}" required>
            </div>
            <div class="form-group">
              <label for="datebirth">Fecha de Nacimento</label>
              <input type="date" name="datebirth" class="form-control" value="{{ old('datebirth', $doctor->datebirth) }}" required>
            </div>
            <div class="form-group">
              <label for="rols">Roles</label>
              <select class="form-control selectpicker" name="rols" id="rols" data-style="btn-secondary">
                @foreach ($rols as $rol)
                  <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary">
              Activar
            </button>
          </form>
      </div>
      </div>

@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
