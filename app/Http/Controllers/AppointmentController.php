<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Specialty;
use App\Models\Appointment;
use App\Models\CancelledAppointment;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;
use App\Http\Requests\StoreAppointment;
use Validator;

class AppointmentController extends Controller
{

  public function __construct(){
   $this->middleware('auth');
  }

  public function index()
  {
    $role = auth()->user()->rols()->first()->name;

    if ($role == 'Medico') {
      $pendingAppointments = Appointment::where('status', 'Reservada')
      ->where('doctor_id', auth()->id())
      ->paginate(10);
      $confirmedAppointments = Appointment::where('status', 'Confirmada')
      ->where('doctor_id', auth()->id())
      ->paginate(10);
      $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
      ->where('doctor_id', auth()->id())
      ->paginate(10);

    }elseif($role == 'Paciente'){
      $pendingAppointments = Appointment::where('status', 'Reservada')
      ->where('patient_id', auth()->id())
      ->paginate(10);
      $confirmedAppointments = Appointment::where('status', 'Confirmada')
      ->where('patient_id', auth()->id())
      ->paginate(10);
      $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
      ->where('patient_id', auth()->id())
      ->paginate(10);

    }
    return view('appointments.index', compact('pendingAppointments', 'confirmedAppointments', 'oldAppointments', 'role'));
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

  public function store(StoreAppointment $request)
  {
    //Validaciones a nivel de Servidor
    // $rules = [
    //   'description' => 'required',
    //   'specialty_id' => 'exists:specialties,id',
    //   'doctor_id' => 'exists:users,id',
    //   'schedule_time' => 'required'
    // ];
    //
    // $messages = [
    //   'schedule_time.required' => 'Por favor seleccione una hora valida para su cita.'
    // ];
    //
    // $validator = Validator::make($request->all(), $rules, $messages);
    //
    // $validator->after(function ($validator) use ($request, $scheduleService) {
    //   $date = $request->input('schedule_date');
    //   $doctorId = $request->input('doctor_id');
    //   $schedule_time = $request->input('schedule_time');
    //   if (!$date || !$doctorId  || !$schedule_time) {
    //     return;
    //   }
    //
    //   $start = new Carbon($schedule_time);
    //
    //   if (!$scheduleService->isAvailableInterval($date, $doctorId, $start)) {
    //     $validator->errors()->add('available_time','La hora seleccionada ya se encuentra reservada por otro paciente.');
    //   }
    // });
    //
    // if ($validator->fails()) { // Verificamos que si el validator falla returne con los errores del validator y los datos de los input se mantengan y se han enviados al helper old
    //   return back()
    //   ->withErrors($validator)
    //   ->withInput();
    // }
    //
    // // Guardar una cita
    // $data = $request->only([
    // 	'description',
    // 	'specialty_id',
    // 	'doctor_id',
    // 	'schedule_date',
    // 	'schedule_time',
    // 	'type'
    // ]);
    // $data['patient_id'] = auth()->id();
    //
    // $carbonTime = Carbon::createFromFormat('g:i A', $data['schedule_time']); // Este fomato estaba en 12 horas
    // $data['schedule_time'] = $carbonTime->format('H:i:s'); // Y lo pasamos a 24 horas
    // // //return dd($data);
    //
    // Appointment::create($data);

    $created = Appointment::createForPatient($request, auth()->id());

    if ($created) {
      $notification = "La cita se ha registrado correctamente.";
    }else{
      $notification = "Ocurrio un problema al registrar la cita médica";
    }

    // Notificacion de que se ha creado la cita correctamente
    // $notification = "La cita se ha registrado correctamente.";

    return redirect('/appointments')->with(compact('notification'));

    // return back()->with(compact('notification'));
    // Return back es lo mismo que el redirect sino que aqui no especificamos la ruta, laravel ya hace eso por nosotros
    //Este es el que estaba antes return redirect('/appointments');
  }

  public function showCancelForm(Appointment $appointment)
  {
    if ($appointment->status == 'Confirmada'){
      $role = auth()->user()->rols()->first()->name;
      return view('appointments.cancel', compact('appointment', 'role'));
    }
    return redirect('/appointments');
  }

  public function postCancel(Appointment $appointment, Request $request)
  {
    if ($request->has('justification')){
      $cancellation = new CancelledAppointment();
      $cancellation->justification = $request->input('justification');
      $cancellation->cancelled_by_id = auth()->id();

      $appointment->cancellation()->save($cancellation);
    }

    $appointment->status = 'Cancelada';
    $appointment->save(); // update

    $notification = "La cita se ha cancelado correctamente.";
    return redirect('/appointments')->with(compact('notification'));
  }

  public function show(Appointment $appointment)
  {
    $role = auth()->user()->rols()->first()->name;
    return view('appointments.show', compact('appointment', 'role'));
    //return dd($appointment);
  }

  public function postConfirm(Appointment $appointment)
  {
    $appointment->status = 'Confirmada';
    $appointment->save(); // update

    $notification = "La cita se ha cancelado correctamente.";
    return redirect('/appointments')->with(compact('notification'));
  }
}
