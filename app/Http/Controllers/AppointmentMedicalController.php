<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\AppointmentMedical;
// use App\Models\CancelledAppointment;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;
use App\Http\Requests\StoreAppointment;
use Validator;

class AppointmentMedicalController extends Controller
{

  public function __construct(){
   $this->middleware('auth');
  }

  public function indexDoctor()
  {

    Gate::authorize('haveaccess','appointmentmedicalDoctor.index');

      $pendingAppointments = AppointmentMedical::where('status', 'Reservada')
      ->where('doctor_id', auth()->id())
      ->paginate(10);
      $confirmedAppointments = AppointmentMedical::where('status', 'Confirmada')
      ->where('doctor_id', auth()->id())
      ->paginate(10);
      $oldAppointments = AppointmentMedical::whereIn('status', ['Atendida', 'Cancelada'])
      ->where('doctor_id', auth()->id())
      ->paginate(10);

    // return dd($role);
    return view('appointments.index', compact('pendingAppointments', 'confirmedAppointments', 'oldAppointments', 'role'));
  }

  public function indexPatient()
  {

    Gate::authorize('haveaccess','appointmentmedicalPatient.index');

    $pendingAppointments = AppointmentMedical::where('status', 'Reservada')
    ->where('patient_id', auth()->id())
    ->paginate(10);
    $confirmedAppointments = AppointmentMedical::where('status', 'Confirmada')
    ->where('patient_id', auth()->id())
    ->paginate(10);
    $oldAppointments = AppointmentMedical::whereIn('status', ['Atendida', 'Cancelada'])
    ->where('patient_id', auth()->id())
    ->paginate(10);

    return view('appointments.index', compact('pendingAppointments', 'confirmedAppointments', 'oldAppointments', 'role'));

  }

  public function create(ScheduleServiceInterface $scheduleService)
  {

    Gate::authorize('haveaccess','appointmentmedical.create');

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

  // public function test(ScheduleServiceInterface $scheduleService)
  // {
  //
  //   Gate::authorize('haveaccess','appointmentmedical.create');
  //
  //   $specialties = Specialty::all();
  //   //Esta parte de aqui no funciona porque no tengo los valores que se envian en la variable doctor name y lastname no estan en la tabla users.
  //   /*$specialtyId = old('specialty_id');
  //   if ($specialtyId) {
  //     $specialty = Specialty::find($specialtyId);
  //     $doctors = $specialty->users;
  //   }else{
  //     $doctors = collect();
  //   }*/
  //
  //   $date = old('schedule_date');
  //   $doctorId = old('doctor_id');
  //   if ($date && $doctorId) {
  //     $intervals = $scheduleService->getAvailableIntervals($date, $doctorId);;
  //   }else{
  //     $intervals = null;
  //   }
  //
  //
  //   return view('appointments.create', compact('specialties','intervals'));
  // }

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

    $created = AppointmentMedical::createForPatient($request, auth()->user()->id);

    if ($created) {
      $notification = "La cita se ha registrado correctamente.";
    }else{
      $notification = "Ocurrio un problema al registrar la cita médica";
    }

    // Notificacion de que se ha creado la cita correctamente
    // $notification = "La cita se ha registrado correctamente.";

    return redirect('/appointmentmedicals')->with(compact('notification'));

    // return back()->with(compact('notification'));
    // Return back es lo mismo que el redirect sino que aqui no especificamos la ruta, laravel ya hace eso por nosotros
    //Este es el que estaba antes return redirect('/appointments');
  }

  public function showCancelForm(AppointmentMedical $appointment)
  {

    Gate::authorize('haveaccess','appointmentmedical.showCancelForm');

    if ($appointment->status == 'Confirmada'){
      $role = auth()->user()->rols()->first()->name;
      return view('appointments.cancel', compact('appointment', 'role'));
    }
    return redirect('/appointmentmedicals');
  }

  public function postCancel(AppointmentMedical $appointment, Request $request)
  {
    // if ($request->has('justification')){
    //   $cancellation = new CancelledAppointment();
    //   $cancellation->justification = $request->input('justification');
    //   $cancellation->cancelled_by_id = auth()->id();
    //
    //   $appointment->cancellation()->save($cancellation);
    // }

    if ($request->has('justification')){
      $appointment->cancellation_justification = $request->input('justification');
      $appointment->cancelled_by_id = auth()->id();
    }

    $appointment->status = 'Cancelada';
    $saved = $appointment->save(); // update

    if ($saved)
      $appointment->patient->sendFCM('Su cita ha sido cancelada.');

    $notification = "La cita se ha cancelado correctamente.";
    return redirect('/appointmentmedicals')->with(compact('notification'));
  }

  public function show(AppointmentMedical $appointment)
  {

    Gate::authorize('haveaccess','appointmentmedical.show');

    $role = auth()->user()->rols()->first()->name;
    return view('appointments.show', compact('appointment', 'role'));
    //return dd($appointment);
  }

  public function postConfirm(AppointmentMedical $appointment)
  {

    Gate::authorize('haveaccess','appointmentmedical.postConfirm');

    $appointment->status = 'Confirmada';
    $saved = $appointment->save(); // update

    if ($saved)
      $appointment->patient->sendFCM('Su cita ha sido confirmada.');

    $notification = "La cita se ha confirmado correctamente.";
    return redirect('/appointmentmedicals')->with(compact('notification'));
  }

  public function pendingAppointments(){

    $pendingAppointments = AppointmentMedical::where('status', 'Reservada')
    ->where('doctor_id', auth()->id())->count();
    return response()->json($pendingAppointments);

  }

  public function confirmedAppointments(){

    $confirmedAppointments = AppointmentMedical::where('status', 'Confirmada')
    ->where('doctor_id', auth()->id())->count();
    return response()->json($confirmedAppointments);

  }

  public function attendedAppointments(){

    $attendedAppointments = AppointmentMedical::where('status', 'Atendida')
    ->where('doctor_id', auth()->id())->count();
    return response()->json($attendedAppointments);

  }
}
