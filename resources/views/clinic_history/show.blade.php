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
    <!-- Page content -->
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
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">Antecedentes Personales</label>
                          <textarea class="form-control form-control-alternative" >{{ $history->personal_history ? $history->personal_history:'No hay datos' }}</textarea>
                        </div>
                      </div>
                    @endif
                    </div>

                    <div class="row">
                      @if($history != null)
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Antecedentes Familiares</label>
                            <textarea class="form-control form-control-alternative" >{{ $history->family_background ? $history->family_background:'No hay datos' }}</textarea>
                          </div>
                        </div>
                      @endif
                    </div>

                    <div class="row">
                      @if($history != null)
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Enfermedad Actual</label>
                            <textarea class="form-control form-control-alternative" >{{ $history->current_illness ? $history->current_illness:'No hay datos' }}</textarea>
                          </div>
                        </div>
                      @endif
                    </div>

                    <div class="row">
                      @if($history != null)
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">Habitos</label>
                          <textarea class="form-control form-control-alternative" >{{ $history->habits ? $history->habits:'No hay datos'  }}</textarea>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>

{{--
                <hr class="my-4" />
                <h6 class="heading-small text-muted mb-4">Consulta Medica</h6>
                <div class="pl-lg-4">

                      @if($history != null)
                      @foreach($medical_consultations as $medical_consultation)
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Motivo</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->reason ? $medical_consultation->reason:'No hay datos' }}</textarea>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Diagnostico</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->diagnosis ? $medical_consultation->diagnosis:'No hay datos' }}</textarea>
                          </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Observaciones</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->observations ? $medical_consultation->observations:'No hay datos' }}</textarea>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Presion Arterial</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->blood_pressure ? $medical_consultation->blood_pressure:'No hay datos' }}</textarea>
                          </div>
                        </div>

                      </div>
                      <div class="row">

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Frecuencia Cardiaca</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->heart_rate ? $medical_consultation->heart_rate:'No hay datos' }}</textarea>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Frecuencia Respiratoria</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->breathing_frequency ? $medical_consultation->breathing_frequency:'No hay datos' }}</textarea>
                          </div>
                        </div>

                      </div>
                      <div class="row">

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Peso</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->weight ? $medical_consultation->weight:'No hay datos' }}</textarea>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Altura</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->height ? $medical_consultation->height:'No hay datos' }}</textarea>
                          </div>
                        </div>

                      </div>
                      <div class="row">

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">IMC</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->imc ? $medical_consultation->imc:'No hay datos' }}</textarea>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Perimetro Abdominal</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->abdominal_perimeter ? $medical_consultation->abdominal_perimeter:'No hay datos' }}</textarea>
                          </div>
                        </div>

                      </div>
                      <div class="row">

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Glucemia Capilar</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->capillary_glucose ? $medical_consultation->capillary_glucose:'No hay datos' }}</textarea>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Temperatura</label>
                            <textarea class="form-control form-control-alternative" >{{ $medical_consultation->temperature ? $medical_consultation->temperature:'No hay datos' }}</textarea>
                          </div>
                        </div>

                      </div>

                      @endforeach
                  @endif

                  </div>


                  <hr class="my-4" />
                  <h6 class="heading-small text-muted mb-4">Prescripcion Medica</h6>
                  <div class="pl-lg-4">
                    @if($history != null)
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">Descripcion</label>
                          <textarea class="form-control form-control-alternative" >{{ $medical_prescriptions->description ? $medical_prescriptions->description:'No hay datos' }}</textarea>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">Posologia</label>
                          <textarea class="form-control form-control-alternative" >{{ $medical_prescriptions->posology ? $medical_prescriptions->posology:'No hay datos' }}</textarea>
                        </div>
                      </div>
                    </div>

                      <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">Observaciones</label>
                          <textarea class="form-control form-control-alternative" >{{ $medical_prescriptions->observations_pres ? $medical_prescriptions->observations_pres:'No hay datos' }}</textarea>
                        </div>
                      </div>
                    </div>
                    @endif
                </div>


                <hr class="my-4" />
                <h6 class="heading-small text-muted mb-4">Pruebas de Laboratorio</h6>
                <div class="pl-lg-4">
                @if($history != null)
                @if($lab_tests != null)
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Tipo de Examen</label>
                      <textarea class="form-control form-control-alternative" >{{ $lab_tests->type_of_exam ? $lab_tests->type_of_exam:'No hay datos' }}</textarea>
                    </div>
                  </div>


                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Cantidad</label>
                      <textarea class="form-control form-control-alternative" >{{ $lab_tests->quantity ? $lab_tests->quantity:'No hay datos' }}</textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Valoracion</label>
                      <textarea class="form-control form-control-alternative" >{{ $lab_tests->assessment ? $lab_tests->assessment:'No hay datos' }}</textarea>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Observaciones</label>
                      <textarea class="form-control form-control-alternative" >{{ $lab_tests->observations_pru ? $lab_tests->observations_pru:'No hay datos' }}</textarea>
                    </div>
                  </div>
                </div>
                @endif
                @endif
              </div> --}}
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
