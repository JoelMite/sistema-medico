<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Auth;

use App\Http\Requests\StoreAppointment;

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

    public function store(StoreAppointment $request){
      $patientId = Auth::guard('api')->id();
      // return compact('patientId');
      $appointment = Appointment::createForPatient($request, $patientId);

        if ($appointment) {
          $success = true;
        }else{
          $success = false;
        }

        return compact('success');
    }
}
