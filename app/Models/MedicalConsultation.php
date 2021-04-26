<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalConsultation extends Model
{
  public $table = "medical_consultations";

  protected $fillable = [
    'reason', 'diagnosis', 'observations', 'blood_pressure', 'heart_rate',
    'breathing_frequency', 'weight', 'height', 'imc', 'abdominal_perimeter',
    'capillary_glucose', 'temperature', 'history_id', 'created_at',
  ];

  public function medical_prescriptions(){
    return $this->hasMany(MedicalPrescription::class);
  }

  public function lab_tests(){
    return $this->hasMany(LabTest::class);
  }

  public function history_clinic(){
    return $this->belongsTo(HistoryClinic::class, 'history_id');
  }

  public function person(){
    return $this->belongsTo(Person::class); // Practicamente esto no funcionaria
  }
}
