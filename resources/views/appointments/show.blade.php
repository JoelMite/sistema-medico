@extends('layouts.panel')

@section('content')
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Cita #{{ $appointment->id }}</h3>
          </div>
        </div>
      </div>

      <div class="card-body">
        <ul>
          <li>
            <strong>Fecha:</strong> {{ $appointment->schedule_date }}
          </li>
          <li>
            <strong>Hora:</strong> {{ $appointment->schedule_time_12 }}
          </li>
          @if ($role == 'Paciente')
            <li>
              <strong>Médico:</strong> {{ $appointment->doctor->person->name }}
            </li>
          @elseif ($role == 'Doctor')
            <li>
              <strong>Paciente:</strong> {{ $appointment->patient->person->name }}
            </li>
          @endif
          <li>
            <strong>Especialidad:</strong> {{ $appointment->specialty->name }}
          </li>
          <li>
            <strong>Tipo:</strong> {{ $appointment->type }}
          </li>
          <li>
            <strong>Estado:</strong>
            @if ($appointment->status == 'Cancelada')
              <span class="badge badge-danger">Cancelada</span>
            @else
              <span class="badge badge-success">{{ $appointment->status }}</span>
            @endif

          </li>
        </ul>

        {{-- @if ($appointment->status == 'Cancelada')
          <div class="alert alert-warning">
            <p>Acerca de la cancelación</p>
              <ul>
                @if ($appointment->cancellation)
                  <li>
                    <strong>Motivo de la cancelación:</strong> {{ $appointment->cancellation->justification }}
                  </li>
                  <li>
                    <strong>Fecha de la cancelación:</strong> {{ $appointment->cancellation->created_at }}
                  </li>
                  <li>
                    <strong>Quién canceló la cita?:</strong> {{ $appointment->cancellation->cancelled_by->persons->name }} --}}
                    {{-- No se que hice pero esta de revisar porque si funciona XD Y ESTA INTERESANTE ESTA RELACION PARA PODER EXTRAER DATOS ASI MISMO A FUTURO --}}
                  {{-- </li>
                @else
                  <li>Esta cita fue cancelada antes de su confirmación.</li>
                @endif
              </ul>
          </div>
        @endif --}}

        @if ($appointment->status == 'Cancelada')
          <div class="alert alert-warning">
            <p>Acerca de la cancelación</p>
              <ul>
                @if ($appointment)
                  <li>
                    <strong>Motivo de la cancelación:</strong> {{ $appointment->cancellation_justification }}
                  </li>
                  {{-- <li>
                    <strong>Fecha de la cancelación:</strong> {{ $appointment->cancellation->created_at }}
                  </li> --}}
                  <li>
                    <strong>Quién canceló la cita?:</strong> {{ $appointment->cancelletion_by->person->name }}
                    {{-- No se que hice pero esta de revisar porque si funciona XD Y ESTA INTERESANTE ESTA RELACION PARA PODER EXTRAER DATOS ASI MISMO A FUTURO --}}
                  </li>
                @else
                  <li>Esta cita fue cancelada antes de su confirmación.</li>
                @endif
              </ul>
          </div>
        @endif

        <a href="{{ url('/appointment_medicals_doctor') }}" class="btn btn-default">Volver</a>

      </div>
    </div>

@endsection
