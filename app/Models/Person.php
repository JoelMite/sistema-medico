<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $table = "persons";

    protected $fillable = [
      'name', 'lastname', 'dni', 'phone', 'address', 'city', 'date_birth', 'age', 'etnia', 'sex', 'user_id',
    ];

    public function history(){
      return $this->hasOne(History::class);
    }

    // public function medicalconsultation(){ // Esta de aqui ni sirve
    //   return $this->hasMany(MedicalConsultation::class);
    // }

    public function users(){
      return $this->belongsTo(User::class);
    }
}
