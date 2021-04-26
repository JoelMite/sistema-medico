<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $table = "persons";

    protected $fillable = [
      'name', 'lastname', 'dni', 'phone', 'address', 'city', 'date_birth', 'age', 'etnia', 'sex', 'user_id',
    ];

    public function history_clinic(){
      return $this->hasOne(HistoryClinic::class);
    }

    // public function medicalconsultation(){ // Esta de aqui ni sirve
    //   return $this->hasMany(MedicalConsultation::class);
    // }

    public function user(){
      return $this->belongsTo(User::class);
    }
}
