@extends('layouts.panel')

@section('content')
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Mis citas</h3>
          </div>
        </div>
      </div>


      <div class="card-body">
        @if(session('notification'))
          <div class="alert alert-success" role="alert">
            {{ session('notification') }}
          </div>
        @endif


        <div class="nav-wrapper">
          <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
              <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0 active" id="confirmed-appointments-tab" data-toggle="tab" href="#confirmed-appointments" role="tab" aria-controls="confirmed-appointments" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Mis próximas citas</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="pending-appointments-tab" data-toggle="tab" href="#pending-appointments" role="tab" aria-controls="pending-appointments" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Citas por confirmar</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="old-appointments-tab" data-toggle="tab" href="#old-appointments" role="tab" aria-controls="old-appointments" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Historial de citas atendidas</a>
              </li>
          </ul>
      </div>


      </div>

      <div class="card shadow">
          <div class="card-body">
              <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="confirmed-appointments" role="tabpanel" aria-labelledby="confirmed-appointments-tab">
                    @include('appointments.confirmed-appointments')
                  </div>
                  <div class="tab-pane fade" id="pending-appointments" role="tabpanel" aria-labelledby="pending-appointments-tab">
                    @include('appointments.pending-appointments')
                  </div>
                  <div class="tab-pane fade" id="old-appointments" role="tabpanel" aria-labelledby="old-appointments-tab">
                    @include('appointments.old-appointments')
                  </div>
              </div>
          </div>
      </div>


    </div>

@endsection
