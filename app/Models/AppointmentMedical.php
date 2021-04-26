<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\HistoryClinic;

class AppointmentMedical extends Model
{
  protected $fillable = [
    	'description',
    	'specialty_id',
    	'doctor_id',
    	'patient_id',
      'history_clinic_id',
      'cancellation_justification',
      'cancelled_by_id',
    	'schedule_date',
    	'schedule_time',
    	'type'
    ];

  protected $hidden = [
    'schedule_time', 'created_at'
  ];

  protected $appends = [
    'schedule_time_12', 'created_at_format'
  ];

// // Definimos un atributo date dentro de un modelo laravel se encarga de hacer casts automaticamente
//   protected $dates = [
//     'schedule_time'
//   ];

    // N $appointment->specialty 1
  public function specialty()
  {
    return $this->belongsTo(Specialty::class, 'specialty_id');
  }
    // N $appointment->doctor 1
  public function doctor()
  {
    return $this->belongsTo(User::class, 'doctor_id');
  }
    // N $appointment->patient 1
  public function patient()
  {
    return $this->belongsTo(User::class, 'patient_id');
  }

  public function cancelletion_by()
  {
    return $this->belongsTo(User::class, 'cancelled_by_id');
  }

  public function history_clinic(){
    return $this->belongsTo(HistoryClinic::class);
  }

  // Appointment hasOne 1 - 1/0 belongsTo cancelledAppointments
  //$appointment->cancellation->justification

  public function cancellation()
  {
    return $this->hasOne(CancelledAppointment::class); // Quedaria inutilizable debido al cambio que hice en la base de datos.
  }

  // accesor
  // $appointment->schedule_time_12

  public function getScheduleTime12Attribute()
  {
    return (new Carbon($this->schedule_time))->format('g:i A');
  }

  public function getCreatedAtFormatAttribute()
  {
    return (new Carbon($this->created_at))->toDateTimeString(); // 1975-12-25 14:15:16 cambia el formato de la fecha
  }

  static public function createForPatient(Request $request, $patient_id){
    $data = $request->only([
    	'description',
    	'specialty_id',
    	'doctor_id',
    	'schedule_date',
    	'schedule_time',
    	'type'
    ]);
    $data['patient_id'] = $patient_id;

    $history_clinic_id = HistoryClinic::whereHas('person', function($query){
      $query->where('person_id', '=', auth()->user()->person['id']);
    })->get()->first();

    //$history_clinic_id = $history_clinic_id[0];

    //$history_clinic_id = $history_clinic_id->id;

    $data['history_clinic_id'] = $history_clinic_id->id;

    //return dd($history_clinic_id);

    $carbonTime = Carbon::createFromFormat('g:i A', $data['schedule_time']); // Este fomato estaba en 12 horas
    $data['schedule_time'] = $carbonTime->format('H:i:s'); // Y lo pasamos a 24 horas
    //return dd($data);

    return self::create($data);
  }

}
