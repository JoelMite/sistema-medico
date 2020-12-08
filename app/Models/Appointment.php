<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
  protected $fillable = [
    	'description',
    	'specialty_id',
    	'doctor_id',
    	'patient_id',
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
    return $this->belongsTo(Specialty::class);
  }
    // N $appointment->doctor 1
  public function doctor()
  {
    return $this->belongsTo(User::class);
  }
    // N $appointment->patient 1
  public function patient()
  {
    return $this->belongsTo(User::class);
  }

  // Appointment hasOne 1 - 1/0 belongsTo cancelledAppointments
  //$appointment->cancellation->justification

  public function cancellation()
  {
    return $this->hasOne(CancelledAppointment::class);
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
}
