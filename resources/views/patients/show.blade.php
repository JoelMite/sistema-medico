@extends('layouts.panel')

@section('content')

<!-- Page content -->
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-8 order-xl-1 center">
            <!-- Aqui le coloque un "center" para que se alinie toda la informacion -->
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Datos Personales</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <h6 class="heading-small text-muted mb-4">Información</h6>
                        <div class="pl-lg-4">
                            <div class="row">

                                @foreach ($roles as $role)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Rol</label>
                                        <input type="text" id="input-roles"
                                            class="form-control form-control-alternative" value="{{ $role->name }}">
                                    </div>
                                </div>
                                @endforeach

                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email</label>
                                        <input type="email" id="input-email"
                                            class="form-control form-control-alternative" value="{{ $patient->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                @if($persons != null)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Nombres</label>
                                        <input type="text" id="input-name" class="form-control form-control-alternative"
                                            value="{{ $patient->person->name ? $patient->person->name:'No hay datos' }}">
                                    </div>
                                </div>
                                @endif

                                @if($persons != null)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">Apellidos</label>
                                        <input type="text" id="input-last-name"
                                            class="form-control form-control-alternative"
                                            value="{{ $patient->person->lastname ? $patient->person->lastname:'No hay datos' }}">
                                    </div>
                                </div>
                                @endif

                            </div>
                            <div class="row">

                                @if($persons != null)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">Edad</label>
                                        <input type="text" id="input-age" class="form-control form-control-alternative"
                                            value="{{ $patient->person->age ? $patient->person->age:'No hay datos' }}">
                                    </div>
                                </div>
                                @endif

                                @if($persons != null)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">Sexo</label>
                                        <input type="text" id="input-sex" class="form-control form-control-alternative"
                                            value="{{ $patient->person->sex ? $patient->person->sex:'No hay datos' }}">
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                        @if($persons != null)
                        <hr class="my-4" />
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Información Adicional</h6>
                        <div class="pl-lg-4">
                            <div class="row">

                                @if($persons != null)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Dirección</label>
                                        <input id="input-address" class="form-control form-control-alternative"
                                            value="{{ $patient->person->address ? $patient->person->address:'No hay datos' }}"
                                            type="text">
                                    </div>
                                </div>
                                @endif

                            </div>
                            <div class="row">

                                @if($persons != null)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-city">Telefono</label>
                                        <input type="text" id="input-phone"
                                            class="form-control form-control-alternative"
                                            value="{{ $patient->person->phone ? $patient->person->phone:'No hay datos' }}">
                                    </div>
                                </div>
                                @endif

                                @if($persons != null)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Ciudad</label>
                                        <input type="text" id="input-city" class="form-control form-control-alternative"
                                            value="{{ $patient->person->city ? $patient->person->city:'No hay datos' }}">
                                    </div>
                                </div>
                                @endif

                                @if($persons != null)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Etnia</label>
                                        <input type="text" id="input-etnia"
                                            class="form-control form-control-alternative"
                                            value="{{ $patient->person->etnia ? $patient->person->etnia:'No hay datos' }}">
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection