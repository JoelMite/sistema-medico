@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
<!-- <div class="row justify-content-center">
    </div> -->
<!--<div class="row">
  <div class="col-md-12 mb-4">
      <div class="card">
          <div class="card-header">Dashboard</div>

          <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif

              You are logged in!
          </div>
      </div>
  </div>
  <div class="col-xl-8 mb-5 mb-xl-0">
    <div class="card bg-gradient-default shadow">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
            <h2 class="text-white mb-0">Sales value</h2>
          </div>
          <div class="col">
            <ul class="nav nav-pills justify-content-end">
              <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                  <span class="d-none d-md-block">Month</span>
                  <span class="d-md-none">M</span>
                </a>
              </li>
              <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                  <span class="d-none d-md-block">Week</span>
                  <span class="d-md-none">W</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body"> -->
<!-- Chart -->
<!-- <div class="chart"> -->
<!-- Chart wrapper -->
<!-- <canvas id="chart-sales" class="chart-canvas"></canvas>
        </div>
      </div>
    </div>
  </div> -->
<!-- <div class="col-xl-4">
    <div class="card shadow">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
            <h2 class="mb-0">Total orders</h2>
          </div>
        </div>
      </div>
      <div class="card-body"> -->
<!-- Chart -->
<!-- <div class="chart">
          <canvas id="chart-orders" class="chart-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>
</div> -->
<!-- <div class="row mt-5">
  <div class="col-xl-8 mb-5 mb-xl-0"> -->
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nuevo Rol</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('roles')}}" class="btn btn-warning">
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
        <form action="{{url('roles')}}" method="post">
            @csrf
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-control-label">Nombre del rol</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dot-circle"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>
                </div>

                  <div class="col-md-8 mb-3">
                      <div class="form-group">
                          <label class="form-control-label">Descripción</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-comments"></i></span>
                              </div>
                              <input type="text" name="description" class="form-control" value="{{ old('description') }}" required>
                          </div>
                      </div>
                  </div>

                    <div class="form-group">
                        <label class="form-control-label">Permisos</label>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Gestionar Pacientes</label>
                                <select class="form-control selectpicker" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                                  title="Seleccione una o varios permisos">
                                    @foreach ($permissions_patient as $permission_patient)
                                    <option value="{{ $permission_patient->id }}">{{ $permission_patient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Gestionar Doctores</label>
                                <select class="form-control selectpicker" multiple data-selected-text-format="count" multiple data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                                  title="Seleccione una o varios permisos">
                                    @foreach ($permissions_doctor as $permission_doctor)
                                    <option value="{{ $permission_doctor->id }}">{{ $permission_doctor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Gestionar Roles</label>
                                <select class="form-control selectpicker" multiple data-selected-text-format="count" multiple data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                                  title="Seleccione una o varios permisos">
                                    @foreach ($permissions_role as $permission_role)
                                    <option value="{{ $permission_role->id }}">{{ $permission_role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Gestionar Especialidades</label>
                                <select class="form-control selectpicker" multiple data-selected-text-format="count" multiple data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                                  title="Seleccione una o varios permisos">
                                    @foreach ($permissions_specialty as $permission_specialty)
                                    <option value="{{ $permission_specialty->id }}">{{ $permission_specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Gestionar Estado de Cuenta</label>
                                <select class="form-control selectpicker" multiple data-selected-text-format="count" multiple data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                                  title="Seleccione una o varios permisos">
                                    @foreach ($permissions_user as $permission_user)
                                    <option value="{{ $permission_user->id }}">{{ $permission_user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Gestionar Historia Clinica</label>
                                <select class="form-control selectpicker" multiple data-selected-text-format="count" multiple data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                                  title="Seleccione una o varios permisos">
                                    @foreach ($permissions_history_clinic as $permission_history_clinic)
                                    <option value="{{ $permission_history_clinic->id }}">{{ $permission_history_clinic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Gestionar Consultas y Citas Médicas</label>
                                <select class="form-control selectpicker" multiple data-selected-text-format="count" multiple data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                                  title="Seleccione una o varios permisos">
                                    @foreach ($permissions_consultation_appointment_medical as $permission_consultation_appointment_medical)
                                    <option value="{{ $permission_consultation_appointment_medical->id }}">{{ $permission_consultation_appointment_medical->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Gestionar Dashboard</label>
                                <select class="form-control selectpicker" multiple data-selected-text-format="count" multiple data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                                  title="Seleccione una o varios permisos">
                                    @foreach ($permissions_dashboard as $permission_dashboard)
                                    <option value="{{ $permission_dashboard->id }}">{{ $permission_dashboard->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                  </div>
                    <button type="submit" class="btn btn-success">
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
