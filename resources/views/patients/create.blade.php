@extends('layouts.panel')

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
              <label for="name">Nombre</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
              <label for="description">Email</label>
              <input type="text" name="description" class="form-control" value="{{ old('description') }}" required>
            </div>
            <div class="form-group">
              <label for="description">Contraseña</label>
              <input type="text" name="description" class="form-control" value="{{ old('description') }}" required>
            </div>
            <div class="form-group">
              <label for="description">Confirmar Contraseña</label>
              <input type="text" name="description" class="form-control" value="{{ old('description') }}" required>
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
