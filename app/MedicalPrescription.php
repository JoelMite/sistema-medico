<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalPrescription extends Model
{
  public $table = "medical_prescriptions";

  protected $fillable = [
    'description', 'posology', 'observations_pres', 'medical_consultation_id',
  ];

  public function medical_consultation(){
    return $this->belongsTo(MedicalConsultation::class);
  }
}
