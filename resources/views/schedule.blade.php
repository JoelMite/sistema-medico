@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
<form action="{{ url('/schedule') }}" method="post">
  @csrf
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Gestionar Horario</h3>
            </div>
            <div class="col text-right">
              <button type="submit" class="btn btn-success">
                Guardar
              </a>
            </div>
          </div>
        </div>

        @if(session('notification'))
        <div class="card-body">
          <div class="alert alert-success" role="alert">
            {{ session('notification') }}
          </div>
        </div>
        @endif

        @if(session('errors'))
        <div class="card-body">
          <div class="alert alert-danger" role="alert">
            Los cambios se han guardado pero tener en cuenta que:
            <ul>
              @foreach (session('errors') as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif

        <div class="table-responsive">
          <!-- doctores table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Dia</th>
                <th scope="col">Activo</th>
                <th scope="col">Turno Mañana</th>
                <th scope="col">Turno Tarde</th>
              </tr>
            </thead>
            <tbody>
              {{--@if(!$workDays->isEmpty())--}}
              @foreach($workDays as $key => $workDay)
                <tr>
                  <th>{{ $days[$key] }}</th>
                  <td>
                    <label class="custom-toggle">
                      <input type="checkbox" name="active[]" value="{{ $key }}" @if($workDay->active) checked @endif>

                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label></td>
                  <td>
                    <div class="row">
                      <div class="col">
                        {{-- input type="time" class="form-control"> --}}
                        <select class="form-control selectpicker" data-style="btn-secondary" name="morning_start[]">
                          @for($i=5; $i<=11; $i++)
                          <option value="{{ ($i < 10 ? '0' : ''). $i }}:00" @if($i.':00 AM' == $workDay->morning_start) selected @endif>{{ $i }}:00 AM</option>
                          <option value="{{ ($i < 10 ? '0' : ''). $i }}:30" @if($i.':30 AM' == $workDay->morning_start) selected @endif>{{ $i }}:30 AM</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col">
                        {{-- input type="time" class="form-control"> --}}
                        <select class="form-control selectpicker" data-style="btn-secondary" name="morning_end[]">
                          @for($i=5; $i<=11; $i++)
                          <option value="{{ ($i < 10 ? '0' : ''). $i }}:00" @if($i.':00 AM' == $workDay->morning_end) selected @endif>{{ $i }}:00 AM</option>
                          <option value="{{ ($i < 10 ? '0' : ''). $i }}:30" @if($i.':30 AM' == $workDay->morning_end) selected @endif>{{ $i }}:30 AM</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col">
                        <select class="form-control selectpicker" data-style="btn-secondary" name="afternoon_start[]">
                          @for($i=1; $i<=11; $i++)
                          <option value="{{ $i+12 }}:00" @if($i.':00 PM' == $workDay->afternoon_start) selected @endif>{{ $i }}:00 PM</option>
                          <option value="{{ $i+12 }}:30" @if($i.':30 PM' == $workDay->afternoon_start) selected @endif>{{ $i }}:30 PM</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col">
                        <select class="form-control selectpicker" data-style="btn-secondary" name="afternoon_end[]">
                          @for($i=1; $i<=11; $i++)
                          <option value="{{ $i+12 }}:00" @if($i.':00 PM' == $workDay->afternoon_end) selected @endif>{{ $i }}:00 PM</option>
                          <option value="{{ $i+12 }}:30" @if($i.':30 PM' == $workDay->afternoon_end) selected @endif>{{ $i }}:30 PM</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            {{--@else
              @foreach ($days as $key => $day)
                <tr>
                  <th>{{ $day }}</th>
                  <td>
                    <label class="custom-toggle">
                      <input type="checkbox" name="active[]" value="{{ $key }}">
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label></td>
                  <td>
                    <div class="row">
                      <div class="col">
                        <select class="form-control" name="morning_start[]">
                          @for($i=5; $i<=11; $i++)
                          <option value="{{ ($i < 10 ? '0' : ''). $i }}:00">{{ $i }}:00 am</option>
                          <option value="{{ ($i < 10 ? '0' : ''). $i }}:30">{{ $i }}:30 am</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col">
                        <select class="form-control" name="morning_end[]">
                          @for($i=5; $i<=11; $i++)
                          <option value="{{ ($i < 10 ? '0' : ''). $i }}:00">{{ $i }}:00 am</option>
                          <option value="{{ ($i < 10 ? '0' : ''). $i }}:30">{{ $i }}:30 am</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col">
                        <select class="form-control" name="afternoon_start[]">
                          @for($i=1; $i<=11; $i++)
                          <option value="{{ $i+12 }}:00">{{ $i }}:00 pm</option>
                          <option value="{{ $i+12 }}:30">{{ $i }}:30 pm</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col">
                        <select class="form-control" name="afternoon_end[]">
                          @for($i=1; $i<=11; $i++)
                          <option value="{{ $i+12 }}:00">{{ $i }}:00 pm</option>
                          <option value="{{ $i+12 }}:30">{{ $i }}:30 pm</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            @endif--}}
            </tbody>
          </table>
        </div>
      </div>

</form>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

@endsection
