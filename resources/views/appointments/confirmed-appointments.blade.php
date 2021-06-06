<div class="table-responsive">
  <table class="table align-items-center table-flush">
    <thead class="thead-light">
      <tr>
        <th scope="col">Descripción</th>
        <th scope="col">Especialidad</th>
        {{-- @if ($role == 'Paciente') --}}
        @can('haveaccess','appointmentmedicalPatient.index')
          <th scope="col">Médico</th>
        @endcan
        @can('haveaccess','appointmentmedicalDoctor.index')
        {{-- @elseif ($role == 'Medico') --}}
        <th scope="col">Paciente</th>
        @endcan
        {{-- @endif --}}
        <th scope="col">Fecha</th>
        <th scope="col">Hora</th>
        <th scope="col">Tipo</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($confirmedAppointments as $appointment)
            <tr>
              <th scope="row">
                {{ $appointment->description }}
              </th>
              <td>
                {{ $appointment->specialty->name }}
              </td>
              @can('haveaccess','appointmentmedicalPatient.index')
                {{-- @if ($role == 'Paciente') --}}
                  <td>
                    {{ $appointment->doctor->person->name }}
                  </td>
              @endcan
              @can('haveaccess','appointmentmedicalDoctor.index')
                {{-- @elseif ($role == 'Medico') --}}
                  <td>
                    {{ $appointment->patient->person->name }}
                  </td>
              @endcan
                {{-- @endif --}}
              <td>
                {{ $appointment->schedule_date }}
              </td>
              <td>
                {{ $appointment->schedule_time_12 }}
              </td>
              <td>
                {{ $appointment->type }}
              </td>
              <td>
                  <a class="btn btn-sm btn-danger" title="Cancelar cita"
                  href="{{ url('/appointment_medicals/'.$appointment->id.'/cancel') }}">Cancelar</a>
              </td>
            </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="card-body">
  {{ $confirmedAppointments->links() }}
</div>
