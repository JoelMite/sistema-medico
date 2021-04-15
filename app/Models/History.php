<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
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
}
