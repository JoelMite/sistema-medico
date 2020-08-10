<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $table = "persons";
    
    protected $fillable = [
      'name', 'lastname', 'phone', 'address', 'city', 'age', 'etnia', 'sex', 'user_id',
    ];
}
