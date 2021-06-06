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
            <a href="{{url('patients')}}" class="btn btn-danger">
              Cancelar y Volver
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
          <form action="{{url('patients')}}" method="post">
            @csrf
            <div class="accordion" id="acordeon-01">
              <!-- Primer elemento hijo-->

              <div class="form-group">
                <div class="form-group" id="boton-collapse-1">
                  <button class="btn btn-info btn-lg btn-block text-left" type="button" data-toggle="collapse"
                  data-target="#contenido-btn-1" aria-expanded="true"
                  aria-controls="contenido-btn-1">Datos Personales  <i class="ni ni-check-bold text-white" ></i></button>
                </div>
                <!-- Contenedor -->
                  <div class="collapse show" id="contenido-btn-1" aria-labelledby="boton-collapse-1"
                  data-parent="#acordeon-01">
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="name">Nombres</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="name">Apellidos</label>
                            <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="name">DNI</label>
                            <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Segundo elemento hijo-->
                <div class="form-group">
                  <div class="form-group" id="boton-collapse-2">
                    <button class="btn btn-warning btn-lg btn-block text-left collapsed" type="button" data-toggle="collapse"
                    data-target="#contenido-btn-2" aria-expanded="false"
                    aria-controls="contenido-btn-2">Datos de Usuario  <i class="ni ni-check-bold text-white" ></i></button>
                  </div>
                  <!-- Contenedor -->
                    <div class="collapse" id="contenido-btn-2" aria-labelledby="boton-collapse-2"
                    data-parent="#acordeon-01">
                      <div class="form-row">
                        <div class="col-md-6 mb-2">
                          <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group input-group-alternative">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                              </div>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 mb-2">
                          <div class="form-group">
                            <label for="contraseña">Contraseña</label>
                            <input type="text" name="password" class="form-control" value="{{ Str::random(15) }}" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Tercer elemento hijo-->
                  <div class="form-group">
                    <div class="form-group" id="boton-collapse-3">
                      <button class="btn btn-primary btn-lg btn-block text-left collapsed" type="button" data-toggle="collapse"
                      data-target="#contenido-btn-3" aria-expanded="false"
                      aria-controls="contenido-btn-3">Datos Adicionales <i class="ni ni-check-bold text-white" ></i></button>
                    </div>
                    <!-- Contenedor -->
                      <div class="collapse" id="contenido-btn-3" aria-labelledby="boton-collapse-3"
                      data-parent="#acordeon-01">
                      <div class="form-row">
                        <div class="col-md-6 mb-2">
                          <div class="form-group">
                            <label for="name">Teléfono</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                          </div>
                        </div>
                        <div class="col-md-6 mb-2">
                          <div class="form-group">
                            <label for="name">Dirección</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                          </div>
                        </div>
                        <div class="col-md-6 mb-2">
                          <div class="form-group">
                            <label for="name">Ciudad</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                          </div>
                        </div>
                          {{-- <div class="form-group">
                            <label for="name">Edad</label>
                            <input type="text" name="age" class="form-control" value="{{ old('age') }}" required>
                          </div> --}}
                          <div class="col-md-6 mb-2">
                            <div class="form-group">
                              <label for="name">Etnia</label>
                              <select class="form-control selectpicker" name="etnia" id="etnia" data-style="btn-secondary">
                                  <option value="Mestizo">Mestizo</option>
                                  <option value="Afroamericano">Afroamericano</option>
                                  <option value="Indigena">Indigena</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 mb-2">
                            <div class="form-group">
                              <label for="name">Fecha de Nacimiento</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker" placeholder="Seleccionar fecha"
                                id="date_birth" name = "date_birth" type="text"
                                value= "{{ old('date_birth') }}"
                                data-date-format="yyyy-mm-dd">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 mb-2">
                            <div class="form-group">
                              <label for="name">Sexo</label>
                              <select class="form-control selectpicker" name="sex" id="sex" data-style="btn-secondary">
                                  <option value="Masculino">Masculino</option>
                                  <option value="Femenino">Femenino</option>
                              </select>
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
@endsection
