@extends('layouts.panel')

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
            <h3 class="mb-0">Crear Rol</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('rols')}}" class="btn btn-sm btn-default">
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
          <form action="{{url('rols')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="name">Nombre del rol</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
              <label for="description">Descripcion</label>
              <input type="text" name="description" class="form-control" value="{{ old('description') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">
              Guardar
            </button>
          </form>
      </div>
      </div>



      <!-- <div class="table-responsive"> -->
        <!-- Rols table -->
        <!-- <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
                /argon/
              </th>
              <td>
                4,569
              </td>
              <td>
                <a href="" class="btn btn-sm btn-primary">Editar</a>
                <a href="" class="btn btn-sm btn-danger">Eliminar</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> -->
  <!-- </div> -->
  <!-- <div class="col-xl-4">
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Social traffic</h3>
          </div>
          <div class="col text-right">
            <a href="#!" class="btn btn-sm btn-primary">See all</a>
          </div>
        </div>
      </div>
      <div class="table-responsive"> -->
        <!-- Projects table -->
        <!-- <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Referral</th>
              <th scope="col">Visitors</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
                Facebook
              </th>
              <td>
                1,480
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">60%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                Facebook
              </th>
              <td>
                5,480
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">70%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                Google
              </th>
              <td>
                4,807
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">80%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                Instagram
              </th>
              <td>
                3,678
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">75%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                twitter
              </th>
              <td>
                2,645
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2">30%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div> -->

@endsection
