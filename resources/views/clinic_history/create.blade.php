@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nueva Historia Clínica</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('histories')}}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{url('histories')}}" method="post">
            @csrf
            {{-- @if($persons != null)
            <div class="form-group" style="display: none;">
                <label class="form-control-label" for="input-first-name">Identificador</label>
                <input type="text" name="id_person" class="form-control form-control-alternative" value="{{ $persons->id ? $persons->id:'No hay datos' }}">
    </div>
    @endif --}}

    <div class="form-group">
        <label class="form-control-label">Antecedentes Personales</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-address-book"></i></span>
            </div>
            <textarea name="personal_history" class="form-control" value="{{ old('personal_history') }}" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label">Antecedentes Familiares</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-address-book"></i></span>
            </div>
            <textarea name="family_background" class="form-control" value="{{ old('family_background') }}" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label">Enfermedad Actual</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-heartbeat"></i></span>
            </div>
            <textarea name="current_illness" class="form-control" value="{{ old('current_illness') }}" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label">Hábitos</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
            </div>
            <textarea name="habits" class="form-control" value="{{ old('current_illness') }}" required></textarea>
        </div>
    </div>

    {{-- <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">Consulta Medica</h6>
            <div class="form-group">
              <label for="name">Motivo</label>
              <textarea name="reason" class="form-control" value="{{ old('reason') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Diagnostico</label>
    <textarea name="diagnosis" class="form-control" value="{{ old('diagnosis') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Observaciones</label>
    <textarea name="observations" class="form-control" value="{{ old('observations') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Presion Arterial</label>
    <textarea name="blood_pressure" class="form-control" value="{{ old('blood_pressure') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Frecuencia Cardiaca</label>
    <textarea name="heart_rate" class="form-control" value="{{ old('heart_rate') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Frecuencia Respiratoria</label>
    <textarea name="breathing_frequency" class="form-control" value="{{ old('breathing_frequency') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Peso</label>
    <textarea name="weight" class="form-control" value="{{ old('weight') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Altura</label>
    <textarea name="height" class="form-control" value="{{ old('height') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">IMC</label>
    <textarea name="imc" class="form-control" value="{{ old('imc') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Perimetro Abdominal</label>
    <textarea name="abdominal_perimeter" class="form-control" value="{{ old('abdominal_perimeter') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Glucemia Capilar</label>
    <textarea name="capillary_glucose" class="form-control" value="{{ old('capillary_glucose') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Temperatura</label>
    <textarea name="temperature" class="form-control" value="{{ old('temperature') }}" required></textarea>
</div>

<hr class="my-4" />
<h6 class="heading-small text-muted mb-4">Prescripcion Medica</h6>
<div class="form-group">
    <label for="name">Descripcion</label>
    <textarea name="description" class="form-control" value="{{ old('description') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Posologia</label>
    <textarea name="posology" class="form-control" value="{{ old('description') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Observaciones</label>
    <textarea name="observations_pres" class="form-control" value="{{ old('observations_pres') }}" required></textarea>
</div>

<hr class="my-4" />
<h6 class="heading-small text-muted mb-4">Pruebas de Laboratorio</h6>
<div class="form-group">
    <label for="name">Tipo de Examen</label>
    <textarea name="type_of_exam" class="form-control" value="{{ old('type_of_exam') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Cantidad</label>
    <textarea name="quantity" class="form-control" value="{{ old('quantity') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Valoracion</label>
    <textarea name="assessment" class="form-control" value="{{ old('assessment') }}" required></textarea>
</div>
<div class="form-group">
    <label for="name">Observaciones</label>
    <textarea name="observations_pru" class="form-control" value="{{ old('observations_pru') }}" required></textarea>
</div> --}}

<button type="submit" class="btn btn-success">
    Guardar
</button>
</form>
</div>
</div>

@endsection
