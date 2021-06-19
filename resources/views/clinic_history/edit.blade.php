@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar Historia Clínica</h3>
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

        <form action="{{ url('histories/'.$history->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-control-label">Antecedentes Personales</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                    </div>
                    <textarea name="personal_history" class="form-control" required> {{ old('personal_history', $history->personal_history) }} </textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="form-control-label">Antecedentes Familiares</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                    </div>
                    <textarea name="family_background" class="form-control" required> {{ old('family_background', $history->family_background) }} </textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="form-control-label">Enfermedad Actual</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-heartbeat"></i></span>
                    </div>
                    <textarea name="current_illness" class="form-control" required> {{ old('current_illness', $history->current_illness) }} </textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="form-control-label">Hábitos</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                    </div>
                    <textarea name="habits" class="form-control" required> {{ old('habits', $history->habits) }} </textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Guardar
            </button>
        </form>
    </div>
</div>

@endsection
