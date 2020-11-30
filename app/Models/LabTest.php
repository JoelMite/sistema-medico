<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
  //public $table = "lab_tests";

  protected $fillable = [
    'type_of_exam', 'quantity', 'assessment', 'observations_pru', 'medical_consultation_id',
  ];

  public function medical_consultation(){
    return $this->belongsTo(MedicalConsultation::class);
  }
}
