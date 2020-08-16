<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
  public $table = "history_clinics";

  protected $fillable = [
    'personal_history', 'family_background', 'current_illness', 'person_id',
  ];

  public function person(){
    return $this->belongsTo(Person::class);
  }
}