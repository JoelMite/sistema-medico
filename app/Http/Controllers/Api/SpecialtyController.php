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

        //Podria ser Esto ////:) Ahi fue Joel Que bien.
        $ens = [];
        foreach ($specialty->users as $user) {
          $en = [];
           $en ['name']= $user->persons['name'];
           $en ['lastname']= $user->persons['lastname'];
           $en ['user_id']= $user->persons['user_id'];
           $ens []= $en;
        }


        //$user = $specialty->users()->get();

        //$especialidad = $specialty->users()->get();
        $doctor = User::findOrfail($user_id_pluck);
        $persons = $doctor->persons()->get(['name', 'lastname', 'user_id']);

        //return dd(($a));
        //return $persons ;
        return $ens;
        //return dd(($doctor));
        //return $ens;
      }

    }
}
