<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\specialty;
use App\user;

class SpecialtyController extends Controller
{
    public function doctors($id)
    {
      //$user_id = $specialty->users()->get(['users.id', 'users.email']);
      //$a = Specialty::with(['users', 'users.persons'])->get(['name']);
      $specialty = Specialty::findOrfail($id);
      $user_id_pluck = $specialty->users()->pluck('users.id')->first();
      if (empty($user_id_pluck)) {
        return [];
      }else{

        //$especialidad = $specialty->users()->get();
        $doctor = User::findOrfail($user_id_pluck);
        $persons = $doctor->persons()->get(['name', 'lastname', 'user_id']);

        //return dd(($a));
        return $persons ;
        //return dd(($doctor));
        //return dd(($user_id));
      }

    }
}
