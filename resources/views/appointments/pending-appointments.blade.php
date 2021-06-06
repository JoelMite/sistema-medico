<div class="table-responsive">
  <table class="table align-items-center table-flush">
    <thead class="thead-light">
      <tr>
        <th scope="col">Descripción</th>
        <th scope="col">Especialidad</th>
        @can('haveaccess','appointmentmedicalPatient.index')
        {{-- @if ($role == 'Paciente') --}}
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
      @foreach ($pendingAppointments as $appointment)
            <tr>
              <th scope="row">
                {{ $appointment->description }}
              </th>
              <td>
                {{ $appointment->specialty->name }}
              </td>
              {{-- @if ($role == 'Paciente') --}}
              @can('haveaccess','appointmentmedicalPatient.index')
                <td>
                  {{ $appointment->doctor->person->name }}
                </td>
              @endcan
              {{-- @elseif ($role == 'Medico') --}}
              @can('haveaccess','appointmentmedicalDoctor.index')
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
                <a class="btn btn-sm btn-primary" title="Ver cita"
                  href="{{ url('/appointment_medicals/'.$appointment->id) }}">
                    Ver
                </a>
                @can('haveaccess','appointmentmedicalDoctor.index')
                {{-- @if ($role == 'Medico') --}}
                  <form action="{{ url('/appointment_medicals/'.$appointment->id.'/confirm') }}" method="POST" class="d-inline-block">
                    @csrf
                    <button class="btn btn-sm btn-success" type="submit" data-toggle="tooltip" title="Confirmar cita">
                      <i class="ni ni-check-bold"></i>
                    </button>
                  </form>
                @endcan
                {{-- @endif --}}

                <form action="{{ url('/appointment_medicals/'.$appointment->id.'/cancel') }}" method="POST" class="d-inline-block">
                  @csrf
                  <button class="btn btn-sm btn-danger" type="submit" data-toggle="tooltip" title="Cancelar cita">
                    <i class="ni ni-fat-delete"></i>
                  </button>
                </form>
              </td>
            </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="card-body">
  {{ $pendingAppointments->links() }}
</div>
