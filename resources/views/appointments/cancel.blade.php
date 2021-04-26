@extends('layouts.panel')

@section('content')
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Cancelar citas</h3>
          </div>
        </div>
      </div>

      <div class="card-body">
        @if(session('notification'))
          <div class="alert alert-success" role="alert">
            {{ session('notification') }}
          </div>
        @endif

        @if ($role == 'Paciente')
          <p>Estas a punto de cancelar tu cita reservada con el
            medico {{ $appointment->doctor->person->name }}
            (especialidad {{$appointment->specialty->name}})
            para el dia {{ $appointment->schedule_date }}:</p>
        @elseif ($role == 'Medico')
          <p>Estas a punto de cancelar tu cita con el
            paciente {{ $appointment->patient->person->name }}
            (especialidad {{$appointment->specialty->name}})
            para el dia {{ $appointment->schedule_date }}
            (hora {{ $appointment->schedule_time_12 }}):</p>
        @endif
        <form action="{{ url('/appointmentmedicals/'.$appointment->id.'/cancel') }}" method="POST">
          @csrf

          <div class="form-group">
            <label for="justification">Por favor cuéntanos el motivo de la cancelación de tu cita</label>
            <textarea required id="justification" name="justification" rows="3" class="form-control"></textarea>
          </div>

          <button type="submit" class="btn btn-danger">Cancelar cita</button>
          <a href="{{ url('/appointmentmedicals') }}" class="btn btn-primary">
          Volver al listado de citas sin cancelar</a>
        </form>
      </div>
    </div>

@endsection
