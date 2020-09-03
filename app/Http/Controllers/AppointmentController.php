<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\specialty;
use App\appointment;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;
use Validator;

class AppointmentController extends Controller
{

  public function __construct(){
   $this->middleware('auth');
  }

  public function index()
  {
      //
  }

  public function create(ScheduleServiceInterface $scheduleService)
  {
    $specialties = Specialty::all();
    //Esta parte de aqui no funciona porque no tengo los valores que se envian en la variable doctor name y lastname no estan en la tabla users.
    /*$specialtyId = old('specialty_id');
    if ($specialtyId) {
      $specialty = Specialty::find($specialtyId);
      $doctors = $specialty->users;
    }else{
      $doctors = collect();
    }*/

    $date = old('schedule_date');
    $doctorId = old('doctor_id');
    if ($date && $doctorId) {
      $intervals = $scheduleService->getAvailableIntervals($date, $doctorId);;
    }else{
      $intervals = null;
    }


    return view('appointments.create', compact('specialties','intervals'));
  }

  public function store(Request $request, ScheduleServiceInterface $scheduleService)
  {
    //Validaciones a nivel de Servidor
    $rules = [
      'description' => 'required',
      'specialty_id' => 'exists:specialties,id',
      'doctor_id' => 'exists:users,id',
      'schedule_time' => 'required'
    ];

    $messages = [
      'schedule_time.required' => 'Por favor seleccione una hora valida para su cita'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    $validator->after(function($validator) use ($request, $scheduleService){
      $date = $request->input('schedule_date');
      $doctorId = $request->input('doctor_id');
      $schedule_time = $request->input('$schedule_time');
      if ($date & $doctorId & $schedule_time) {
        $start = new Carbon($schedule_time);
      }else{
        return;
      }

      if (!$scheduleService->isAvailableInterval($date, $doctorId, $start)) {
        $validator->errors()->add('available_time','La hora seleccionada ya se encuentra reservada por otro paciente.');
      }
    });

    if ($validator->fails()) {
      return back()
      ->withErrors($validator)
      ->withInput();
    }

    // Guardar una cita
    $data = $request->only([
    	'description',
    	'specialty_id',
    	'doctor_id',
    	'schedule_date',
    	'schedule_time',
    	'type'
    ]);
    $data['patient_id'] = auth()->id();

    $carbonTime = Carbon::createFromFormat('g:i A', $data['schedule_time']);
    $data['schedule_time'] = $carbonTime->format('H:i:s');
    //return dd($data);
    Appointment::create($data);

    // Notificacion de que se ha creado la cita correctamente
    $notification = "La cita se ha registrado correctamente.";
    return back()->with(compact('notification'));
    //return redirect('/appointments');
  }

  public function show($id)
  {
      //
  }

  public function edit()
  {

  }

  public function update(Request $request, $id)
  {
      //
  }

  public function destroy($id)
  {
      //
  }
}
