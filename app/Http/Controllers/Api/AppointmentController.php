<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AppointmentController extends Controller
{
    public function index(){

      $user = Auth::guard('api')->user();
      // $persons = $user->persons;
      // $appointments = $user->asPatientAppointments()
      //   ->with([
      //       'specialty' => function ($query){
      //           $query->select('id', 'name');
      //       },
      //       'doctor.persons' => function ($query){
      //           $query->select('id');
      //       }
      //     ])
      //     ->get([
      //       "id",
      //       "description",
      //       "specialty_id",
      //       "doctor_id",
      //       "schedule_date",
      //       "schedule_time",
      //       "type",
      //       "created_at",
      //       "status"
      //   ]);

        $appointments = $user->asPatientAppointments()->with(['specialty', 'doctor.persons'])->get();

        return $appointments;
    }

    public function store(){

    }
}
