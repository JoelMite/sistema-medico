<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medicalconsultation;
use App\history;
use App\user;
use App\person;

class MedicalConsultationController extends Controller
{

    public function __construct(){
     $this->middleware('auth');
    }

    public function index()
    {
      $histories = History::all();
      $havePersonHistory = Person::has('history')->get(); // Este metodo me retorna las personas que no tienen una historia clinica
      return view('medical_consultations.index', compact('havePersonHistory'));
    }

    public function create($id)
    {
      $persons = Person::findOrfail($id);
      $histories = $persons->history;

      return view('medical_consultations.create', compact('histories'));
    }

//  Metodo Validacion
      private function validation(Request $request){
        //  Validar a los datos del formulario consulta medica a nivel de servidor
        $rules = [
          'reason' => 'required',
          'diagnosis' => 'required',
          'observations' => 'required',
          'blood_pressure' => 'required|max:3|integer',
          'heart_rate' => 'required'
        ];
        $messages = [
          'reason.required' => 'Es necesario ingresar el motivo de la consulta.',
          'diagnosis.required' => 'Es necesario ingresar el diagnostico de la consulta.',
          'observations.required' => 'Es necesario ingresar la observacion de la consulta.',
          'blood_pressure.required' => 'Es necesario ingresar la presion arterial',
          'blood_pressure.integer' => 'Es necesario ingresar la presion arterial en valores enteros',
          'heart_rate.required' => 'Es necesario ingresar la frecuencia cardiaca'
        ];
        $this->validate($request, $rules, $messages);
      }

    public function store(Request $request)
    {
      $this->validation($request);

      $medical_consultations = MedicalConsultation::create([
        'reason' => $request['reason'],
        'diagnosis' => $request['diagnosis'],
        'observations' => $request['observations'],
        'blood_pressure' => $request['blood_pressure'],
        'heart_rate' => $request['heart_rate'],
        'breathing_frequency' => $request['breathing_frequency'],
        'weight' => $request['weight'],
        'height' => $request['height'],
        'imc' => $request['imc'],
        'abdominal_perimeter' => $request['abdominal_perimeter'],
        'capillary_glucose' => $request['capillary_glucose'],
        'temperature' => $request['temperature'],
        'history_id' => $request['id_history'],
      ]);

      //$id_med_cons = MedicalConsultation::latest('id')->first()->id;

      $medical_consultations->medical_prescriptions()->create([
        'description' => $request['description'],
        'posology' => $request['posology'],
        'observations_pres' => $request['observations_pres'],
        //'medical_consultation_id' => $id_med_cons,
      ]);

      $medical_consultations->lab_tests()->create([
        'type_of_exam' => $request['type_of_exam'],
        'quantity' => $request['quantity'],
        'assessment' => $request['assessment'],
        'observations_pru' => $request['observations_pru'],
        //'medical_consultation_id' => $id_med_cons,

      ]);

      $notification = "El usuario se ha registrado correctamente.";
      return redirect('/medicalconsultation')->with(compact('notification'));

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
