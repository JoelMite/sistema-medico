<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $table = "persons";

    protected $fillable = [
      'name', 'lastname', 'phone', 'address', 'city', 'age', 'etnia', 'sex', 'user_id',
    ];

    public function history(){
      return $this->hasOne(History::class);
    }

    public function medicalconsultation(){
      return $this->hasMany(MedicalConsultation::class);
    }

    public function user(){
      return $this->belongsTo(User::class);
    }
}
