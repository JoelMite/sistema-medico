@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

  <!-- Main content -->
  <div class="main-content">

    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <!-- <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.html">User profile</a> -->

      </div>
    </nav>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 order-xl-1 center"> <!-- Aqui le coloque un "center" para que se alinie toda la informacion -->
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Historia Clinica</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Información</h6>
                <div class="pl-lg-4">
                  <div class="row">

                    @if($history != null)
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Antecedentes Personales</label>
                        <textarea class="form-control form-control-alternative" >{{ $history->personal_history ? $history->personal_history:'No hay datos' }}</textarea>
                      </div>
                    </div>
                    @endif

                    @if($history != null)
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Antecedentes Familiares</label>
                        <textarea class="form-control form-control-alternative" >{{ $history->family_background ? $history->family_background:'No hay datos' }}</textarea>
                      </div>
                    </div>
                    @endif

                    @if($history != null)
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Enfermedad Actual</label>
                        <textarea class="form-control form-control-alternative" >{{ $history->current_illness ? $history->current_illness:'No hay datos' }}</textarea>
                      </div>
                    </div>
                    @endif

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
