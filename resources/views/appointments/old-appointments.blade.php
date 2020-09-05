<div class="table-responsive">
  <table class="table align-items-center table-flush">
    <thead class="thead-light">
      <tr>
        <th scope="col">Especialidad</th>
        <th scope="col">Fecha</th>
        <th scope="col">Hora</th>
        <th scope="col">Estado</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($oldAppointments as $appointment)
            <tr>
              <th scope="row">
                {{ $appointment->specialty->name }}
              </th>
              {{-- <td>
                {{ $appointment->doctor->persons->name }}
              </td> --}}
              <td>
                {{ $appointment->schedule_date }}
              </td>
              <td>
                {{ $appointment->schedule_time_12 }}
              </td>
              <td>
                {{ $appointment->status }}
              </td>
              <td>
                <a href="{{ url('/appointments/'.$appointment->id) }}" class="btn btn-sm btn-primary">Ver</a>
              </td>
            </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="card-body">
  {{ $oldAppointments->links() }}
</div>
