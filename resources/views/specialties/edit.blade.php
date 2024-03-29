@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar Especialidad</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('specialties')}}" class="btn btn-warning">
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

        <form action="{{ url('specialties/'.$specialty->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-control-label">Nombre de la especialidad</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                    </div>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $specialty->name) }}"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-control-label">Descripción</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-comments"></i></span>
                    </div>
                    <input type="text" name="description" class="form-control"
                        value="{{ old('description', $specialty->description) }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">
                Guardar
            </button>
        </form>
    </div>
</div>

@endsection