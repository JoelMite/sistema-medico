<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\specialty;
use App\appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{

  public function __construct(){
   $this->middleware('auth');
  }

  public function index()
  {
      //
  }

  public function create()
  {
    $specialties = Specialty::all();
    /*$specialtyId = old('specialty_id');
    if ($specialtyId) {
      $specialty = Specialty::find($specialtyId);
      $doctors = $specialty->users;
    }else{
      $doctors = collect();
    }*/
    return view('appointments.create', compact('specialties'));
  }

  public function store(Request $request)
  {
    // $rules = [
    //   'description' => 'required',
    //   'specialty_id' => 'exists:specialties,id',
    //   'doctor_id' => 'exists:users,id',
    //   'scheduled_time' => 'required'
    // ];
    //
    // $messages = [
    //   'scheduled_time.required' => 'Por favor seleccione una hora valida para su cita'
    // ];
    //
    // $this->validate($request, $rules, $messages);
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
