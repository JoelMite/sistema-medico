@extends('layouts.panel')

@section('content')

      {{-- <div class="row">
        <div class="col-lg-6">
          <div class="card bg-gradient-info border-0">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total traffic</h5>
                  <span class="h2 font-weight-bold mb-0 text-white">350,897</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                    <i class="ni ni-active-40"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                <span class="text-nowrap text-light">Since last month</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card bg-gradient-danger border-0">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Performance</h5>
                  <span class="h2 font-weight-bold mb-0 text-white">49,65%</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                    <i class="ni ni-spaceship"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                <span class="text-nowrap text-light">Since last month</span>
              </p>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Mi Perfil</h3>
            </div>
            <div class="col-4 text-right">
              <a href="#!" class="btn btn-sm btn-primary">Editar</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form>
            <h6 class="heading-small text-muted mb-4">Información del Usuario</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="test@example.com" value="{{ $user->email }}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="name">Nombres</label>
                    <input type="text" name="name" class="form-control" placeholder="First name" value="{{ $user->person->name }}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="lastname">Apellidos</label>
                    <input type="text" name="lastname" class="form-control" placeholder="Last name" value="{{ $user->person->lastname }}">
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4" />
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4">Información Adicional</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label" for="address">Dirección</label>
                    <input name="address" class="form-control" placeholder="Home Address" value="{{ $user->person->address }}" type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="city">Ciudad</label>
                    <input type="text" name="city" class="form-control" placeholder="City" value="{{ $user->person->city }}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="phone">Teléfono</label>
                    <input type="text" name="phone" class="form-control" placeholder="Country" value="{{ $user->person->phone }}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="date_birth">Fecha de Nacimiento</label>
                    <input type="text" name="date_birth" class="form-control" placeholder="Fecha de Nacimiento" value="{{ $date_birth }}">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>


@endsection
