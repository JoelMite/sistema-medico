<div class="table-responsive">
  <table class="table align-items-center table-flush">
    <thead class="thead-light">
      <tr>
        <th scope="col">Descripción</th>
        <th scope="col">Especialidad</th>
        @if ($role == 'Paciente')
          <th scope="col">Médico</th>
        @elseif ($role == 'Medico')
        <th scope="col">Paciente</th>
        @endif
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
                @if ($role == 'Paciente')
                  <td>
                    {{ $appointment->doctor->persons->name }}
                  </td>
                @elseif ($role == 'Medico')
                  <td>
                    {{ $appointment->patient->persons->name }}
                  </td>
                @endif
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
                  href="{{ url('/appointments/'.$appointment->id.'/cancel') }}">Cancelar</a>
              </td>
            </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="card-body">
  {{ $confirmedAppointments->links() }}
</div>
