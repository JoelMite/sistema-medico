<!-- Navigation -->
<h6 class="navbar-heading text-muted">Gestionar Datos</h6>
<ul class="navbar-nav">
  @if(auth()->user()->rols()->first()->name == 'Administrador')
  <li class="nav-item">
    <a class="nav-link" href="/home">
      <i class="ni ni-tv-2 text-red"></i> Dashboard
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/rols">
      <i class="ni ni-badge text-blue"></i> Roles
    </a>
  </li>
  <li>
    <a class="nav-link" href="/specialties">
      <i class="ni ni-active-40 text-green"></i> Especialidades
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/doctores">
      <i class="ni ni-single-02 text-orange"></i> Usuarios
    </a>
  </li>
  @elseif(auth()->user()->rols()->first()->name == 'Medico')
  <li class="nav-item">
    <a class="nav-link" href="/histories">
      <i class="ni ni-collection text-default"></i> Historia Clinica
    </a>
  </li>

  <li class="nav-item dropdown">
      <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="ni ni-single-copy-04 text-green"></i> Consulta Medica
      </a>
      @include('includes.panel.dropdown_menu_medical_consultations')
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/schedule">
      <i class="ni ni-calendar-grid-58 text-red"></i> Gestionar Horario
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/appointments">
      <i class="ni ni-ruler-pencil text-purple"></i> Mis citas
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/patients">
      <i class="ni ni-satisfied text-yellow"></i> Mis Pacientes
    </a>
  </li>
@elseif(auth()->user()->rols()->first()->name == 'Paciente')

  <li class="nav-item">
    <a class="nav-link" href="/appointments/create">
      <i class="ni ni-ruler-pencil text-purple"></i> Reservar Cita
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/appointments">
      <i class="ni ni-satisfied text-yellow"></i> Mis Citas
    </a>
  </li>


  @endif
  <!-- <li class="nav-item">
    <a class="nav-link" href="./examples/tables.html">
      <i class="ni ni-bullet-list-67 text-red"></i> Tables
    </a>
  </li> -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
    document.getElementById('formLogout').submit();">
      <i class="ni ni-key-25"></i> Cerrar sesión
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display:none;" id="formLogout">
      @csrf

    </form>
  </li>
</ul>
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reporte</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
  <!-- <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="ni ni-sound-wave text-yellow"></i> Frecuencia de Citas
    </a>
  </li> -->
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="ni ni-spaceship text-orange"></i> Medicos Activos
    </a>
  </li>
</ul>
