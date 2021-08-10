@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Cancelar Cita</h3>
            </div>
            <div class="col text-right">
                @if ($role == 'patient')
                  <a href="{{url('appointment_medicals_patient')}}" class="btn btn-danger">
                    Volver
                  </a>
                @elseif($role == 'doctor')
                  <a href="{{url('appointment_medicals_doctor')}}" class="btn btn-danger">
                    Volver
                  </a>
                @endif
            </div>
        </div>
    </div>

    <div class="card-body">

        <div class="form-row">
            <div class="col-md-6 mb-3">
                
                    <form action="{{ url('appointment_medicals/'.$appointment->id.'/cancel') }}" method="POST">
                    @csrf
                        
                    <div class=" form-group">

                        <label for="justification">Por favor cuéntanos el motivo de la cancelación de tu cita.</label>
                        <textarea required name="justification" rows="4" class="form-control"></textarea>
                    
                    </div>       
                
                        <button type="submit" class="btn btn-success">Aceptar</button>

                    </form>
                
              </div>


            <div class="col-md-6 mb-3">
                <div class=" form-group">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h3 class="card-title text-white"><i class="fas fa-exclamation"></i>&nbsp RECUERDA</h3>

                            <blockquote blockquote class="blockquote text-white mb-0">
                                @if ($role == 'patient')
                                    <p>Estas a punto de cancelar tu cita reservada con el
                                      médico <b>{{ $appointment->doctor->person->name }}</b>
                                      (especialidad <b>{{$appointment->specialty->name}}</b>)
                                      para el día <b>{{ $appointment_reservation }}</b>
                                      (hora <b>{{ $appointment->schedule_time_12 }}</b>)
                                    </p>
                                @elseif ($role == 'doctor')
                                    
                                    <p>Estas a punto de cancelar tu cita reservada con el
                                      paciente <b>{{ $appointment->patient->person->name }}</b>
                                      (especialidad <b>{{$appointment->specialty->name}}</b>)
                                      para el día <b>{{ $appointment_reservation }}</b>
                                      (hora <b>{{ $appointment->schedule_time_12 }}</b>)
                                    </p>

                                @endif
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  @endsection