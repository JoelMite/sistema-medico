<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\MedicalConsultation;
use App\Models\HistoryClinic;
use App\Models\User;
use App\Models\Person;
use Session;
//use DB;

class MedicalConsultationController extends Controller
{

    public function __construct(){
     $this->middleware('auth');
    }

    public function index()
    {

      Gate::authorize('haveaccess','medicalconsultation.index');

      //$histories = HistoryClinic::all();
      $havePersonHistory = Person::has('history_clinic')->whereHas('user', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
      $query->where('creator_id','=',auth()->id())
        ->whereHas('roles', function($query){
          $query->whereHas('permissions', function($query){
            $query->where('name','=','Crear Cita Médica');
          });
        });
      })->get(['id', 'name', 'lastname', 'phone', 'address']);

      //return $havePersonHistory;

      return view('medical_consultations.index', compact('havePersonHistory'));
    }

    public function index_show()
    {

      Gate::authorize('haveaccess','medicalconsultation.indexShow');

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

    public function create(Person $person)
    {

      Gate::authorize('haveaccesscreateMedicalConsultations', [$person, 'medicalconsultation.create']);

      //$persons = Person::findOrfail($id);
      $history_id = $person->history_clinic->id;

      // TODO Ojo, utilizar una sesion flash no es factible, podemos reemplazar por una sesion normal.
      Session::flash('history_id', "$history_id");

      return view('medical_consultations.create');
      // return dd($persons->history->medical_consultations);
    }

//  Metodo Validacion
      private function validation(Request $request){
        //  Validar a los datos del formulario consulta medica a nivel de servidor
        $rules = [
          'reason' => 'required',
          'diagnosis' => 'required',
          'observations' => 'required',

          'blood_pressure' => 'required|max:10',
          'heart_rate' => 'required|max:10',
          'breathing_frequency' => 'required|max:10',
          'weight' => 'required|max:5',
          'height' => 'required|max:5',
          'abdominal_perimeter' => 'required|max:5',
          'capillary_glucose' => 'required|max:10',
          'temperature' => 'required|max:10',

          'description' => 'required',
          'posology' => 'required',
          'observations_pres' => 'required',

          'type_of_exam' => 'required',
          'quantity' => 'required',
          'assessment' => 'required',
          'observations_pru' => 'required',
        ];
        $messages = [
          'reason.required' => 'Es necesario ingresar el motivo de la consulta.',
          'diagnosis.required' => 'Es necesario ingresar el diagnóstico de la consulta.',
          'observations.required' => 'Es necesario ingresar la observación de la consulta.',

          'blood_pressure.required' => 'Es necesario ingresar la presión arterial.',
          'blood_pressure.max' => 'La presión arterial no puede exceder los 10 caracteres.',
          'heart_rate.required' => 'Es necesario ingresar la frecuencia cardíaca',
          'heart_rate.max' => 'La frecuencia cardíaca no puede exceder los 10 caracteres.',
          'breathing_frequency.required' => 'Es necesario ingresar la frecuencia respiratoria.',
          'breathing_frequency.max' => 'La frecuencia respiratoria no puede exceder los 10 caracteres.',
          'weight.required' => 'Es necesario ingresar el peso.',
          'weight.max' => 'El peso no puede exceder los 5 caracteres.',
          'height.required' => 'Es necesario ingresar la altura.',
          'height.max' => 'La altura no puede exceder los 5 caracteres.',
          'abdominal_perimeter.required' => 'Es necesario ingresar el perímetro abdominal.',
          'abdominal_perimeter.max' => 'El perímetro abdominal no puede exceder los 5 caracteres.',
          'capillary_glucose.required' => 'Es necesario ingresar la glucosa capilar.',
          'capillary_glucose.max' => 'La glucosa capilar no puede exceder los 10 caracteres.',
          'temperature.required' => 'Es necesario ingresar la temperatura.',
          // 'temperature.numeric' => 'La temperatura debe ser de tipo numérico.',
          'temperature.max' => 'La temperatura no puede exceder los 10 caracteres.',

          'description.required' => 'Es necesario ingresar una descripción a la prescripción médica.',
          'posology.required' => 'Es necesario ingresar la posología a la prescripción médica.',
          'observations_pres.required' => 'Es necesario ingresar una observación a la prescripción médica.',

          'type_of_exam.required' => 'Es necesario ingresar un tipo de exámen.',
          'quantity.required' => 'Es necesario ingresar una cantidad.',
          'assessment.required' => 'Es necesario ingresar valoración.',
          'observations_pru.required' => 'Es necesario ingresar una observación a las pruebas de laboratorio.',
        ];
        $this->validate($request, $rules, $messages);
      }

    public function store(Request $request)
    {
      $this->validation($request);

      //return dd($request);

      $history_id = session('history_id');
      $imc = $request['weight']/(pow($request['height'], 2)); // IMC = Peso/Estatura^2

      $medical_consultations = MedicalConsultation::create([
        'reason' => $request['reason'],
        'diagnosis' => $request['diagnosis'],
        'observations' => $request['observations'],
        'blood_pressure' => $request['blood_pressure'],
        'heart_rate' => $request['heart_rate'],
        'breathing_frequency' => $request['breathing_frequency'],
        'weight' => $request['weight'],
        'height' => $request['height'],
        'imc' => $imc,
        'abdominal_perimeter' => $request['abdominal_perimeter'],
        'capillary_glucose' => $request['capillary_glucose'],
        'temperature' => $request['temperature'],
        'history_id' => $history_id,
      ]);

      //$id_med_cons = MedicalConsultation::latest('id')->first()->id;

      // Esta tenia antes

      // $medical_consultations->medical_prescriptions()->create([
      //   'description' => $request['description'],
      //   'posology' => $request['posology'],
      //   'observations_pres' => $request['observations_pres'],
      //   //'medical_consultation_id' => $id_med_cons,
      // ]);

      foreach ($request->description as $key => $value) {
        $medical_consultations->medical_prescriptions()->create([
          'description' => $value,
          'posology' => $request->posology[$key],
          'observations_pres' => $request->observations_pres[$key],
          //'medical_consultation_id' => $id_med_cons,

        ]);
      }

      // $medical_consultations->lab_tests()->create([
      //   'type_of_exam' => $request['type_of_exam'],
      //   'quantity' => $request['quantity'],
      //   'assessment' => $request['assessment'],
      //   'observations_pru' => $request['observations_pru'],
      //   //'medical_consultation_id' => $id_med_cons,
      //
      // ]);

      foreach ($request->type_of_exam as $key => $value) {
        $medical_consultations->lab_tests()->create([
          'type_of_exam' => $value,
          'quantity' => $request->quantity[$key],
          'assessment' => $request->assessment[$key],
          'observations_pru' => $request->observations_pru[$key],
          //'medical_consultation_id' => $id_med_cons,

        ]);
      }

      $success = "La consulta médica se ha registrado correctamente.";
      return redirect('/medical_consultations')->with(compact('success'));

    }

}
