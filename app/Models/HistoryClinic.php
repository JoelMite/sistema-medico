<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryClinic extends Model
{
  public $table = "history_clinics";
  //
  // protected $table = "history_clinics";

  protected $fillable = [
    'personal_history', 'family_background', 'current_illness', 'habits', 'person_id',
  ];

  public function person(){
    return $this->belongsTo(Person::class);
  }

  public function medical_consultations(){
    return $this->hasMany(MedicalConsultation::class);
  }

  public function appointment_medicals(){
    return $this->hasMany(AppointmentMedical::class);
  }
}
