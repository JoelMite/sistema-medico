<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalConsultation;
use App\Models\HistoryClinic;
use App\Models\User;
use App\Models\Person;
//use DB;

class MedicalConsultationController extends Controller
{

    public function __construct(){
     $this->middleware('auth');
    }

    public function index()
    {
      $histories = HistoryClinic::all();
      $havePersonHistory = Person::has('history_clinic')->get(); // Este metodo me retorna las personas que no tienen una historia clinica
      return view('medical_consultations.index', compact('havePersonHistory'));
    }

    public function index_show()
    {
      $histories = HistoryClinic::all();
      //$havePersonHistory = Person::whereHas('history')->with('medical_consultations')->get(); // Este metodo me retorna las personas que no tienen una historia clinica
      // $variable = DB::table('persons')
      // ->join('history_clinics', 'history_clinics.person_id', '=', 'persons.id')
      // ->join('')
      // $variable = Person::has('history', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
      // $query->has('medical_consultations');
      // })->get();
      // $variable = Person
      // ::join("history_clinics", "history_clinics.person_id", "=", "persons.id")
      // ->join("medical_consultations", "medical_consultations.id", "=", "history_clinics.id")
      // ->select("persons.id as id", "persons.name as name", "persons.lastname as lastname", "medical_consultations.created_at as created_at")
      // ->get();
      $variable = MedicalConsultation
      ::join("history_clinics", "history_clinics.id", "=", "medical_consultations.history_id")
      ->join("persons", "persons.id", "=", "history_clinics.person_id")
      ->select("persons.id as id", "persons.name as name", "persons.lastname as lastname", "medical_consultations.created_at as created_at", "medical_consultations.id as medical_consultations_id")
      ->get();
      return view('medical_consultations.index_show', compact('variable'));
      //$medical_consultation = $havePersonHistory->medical_consultations->first();
      // return dd($variable);
    }

    public function create($id)
    {
      $persons = Person::findOrfail($id);
      $histories = $persons->history_clinic;

      return view('medical_consultations.create', compact('histories'));
      // return dd($persons->history->medical_consultations);
    }

//  Metodo Validacion
      private function validation(Request $request){
        //  Validar a los datos del formulario consulta medica a nivel de servidor
        $rules = [
          'reason' => 'required',
          'diagnosis' => 'required',
          'observations' => 'required',
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

      $notification = "La consulta médica se ha registrado correctamente en la base de datos.";
      return redirect('/medical_consultations')->with(compact('notification'));

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
