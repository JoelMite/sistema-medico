<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Person;
use App\Models\User;
use App\Models\MedicalConsultation;
use App\Models\MedicalPrescription;
use App\Models\LabTest;
use DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
       $this->middleware('auth');
     }

    public function index()
    {
      // $doctores = User::all();
      //$histories = History::all();
      $nohavePersonHistory = Person::doesntHave('history')->get(); // Este metodo me retorna las personas que no tienen una historia clinica
      $havePersonHistory = Person::has('history')->get();
      return view('clinic_history.index', compact('havePersonHistory', 'nohavePersonHistory'));


      //return(dd($histories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $doctor = User::findOrfail($id);
      $persons = $doctor->persons;
      return view('clinic_history.create', compact('persons'));
      //return $id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

//  Metodo Validacion
     private function validation(Request $request){
       //  Validar a los datos del formulario doctor a nivel de servidor
       $rules = [
         'personal_history' => 'required',
         'family_background' => 'required',
         'current_illness' => 'required',
         'habits' => 'required'
       ];
       $messages = [
         'personal_history.required' => 'Es necesario ingresar los antecedentes personales.',
         'family_background.required' => 'Es necesario ingresar los antecedentes familiares.',
         'current_illness.required' => 'Es necesario ingresar la enfermedad actual.',
         'habits.required' => 'Es necesario ingresar los habitos actuales.'
       ];
       $this->validate($request, $rules, $messages);
     }
    public function store(Request $request)
    {
      $this->validation($request);

      //  Insertar Doctor o Usuario
      // Nos aseguramos de capturar solamente la informacion que se espera del formulario

      // $history = new History();
      // $history->personal_history = $request->input('personal_history');
      // $history->family_background = $request->input('family_background');
      // $history->current_illness = $request->input('current_illness');
      // $history->person_id = $request->input('id_person');
      // $history->save(); // Insertar

      $history = History::create([

        'personal_history' => $request['personal_history'],
        'family_background' => $request['family_background'],
        'current_illness' => $request['current_illness'],
        'habits' => $request['habits'],
        'person_id' => $request['id_person']
      ]);








      // $history->medical_consultations()->create([
      //   'reason' => $request['reason'],
      //   'diagnosis' => $request['diagnosis'],
      //   'observations' => $request['observations'],
      //   'blood_pressure' => $request['blood_pressure'],
      //   'heart_rate' => $request['heart_rate'],
      //   'breathing_frequency' => $request['breathing_frequency'],
      //   'weight' => $request['weight'],
      //   'height' => $request['height'],
      //   'imc' => $request['imc'],
      //   'abdominal_perimeter' => $request['abdominal_perimeter'],
      //   'capillary_glucose' => $request['capillary_glucose'],
      //   'temperature' => $request['temperature'],
      //   //'person_id' => $request['id_person'],
      // ]);
      //
      // $id_med_cons = MedicalConsultation::latest('id')->first()->id;
      //
      // $medical_prescription = MedicalPrescription::create([
      //   'description' => $request['description'],
      //   'posology' => $request['posology'],
      //   'observations_pres' => $request['observations_pres'],
      //   'medical_consultation_id' => $id_med_cons,
      // ]);
      //
      // $lab_test = LabTest::create([
      //   'type_of_exam' => $request['type_of_exam'],
      //   'quantity' => $request['quantity'],
      //   'assessment' => $request['assessment'],
      //   'observations_pru' => $request['observations_pru'],
      //   'medical_consultation_id' => $id_med_cons,
      //
      // ]);










      //return redirect(dd($id_med_cons));

      // $medical_prescription = new MedicalPrescription();
      // $medical_prescription->description = $request->input('description');
      // $medical_prescription->posology = $request->input('posology');
      // $medical_prescription->observations_pres = $request->input('observations_pres');
      // $medical_prescription->medical_consultation_id = $id_med_cons;
      // $medical_prescription->save(); // Insertar

      // $history = History::create(
      //   $request->input('personal_history'),
      //   $request->input('family_background'),
      //   $request->input('current_illness'),
      //   $request->input('id_person')
      // );

      // $history = History::create([
      //   $request->only('personal_history'),
      //   $request->only('family_background'),
      //   $request->only('current_illness'),
      // ]);
      //
      // $history->persons()->create([
      //   'name' => $request['name'],
      //   'lastname' => $request['lastname'],
      //   'phone' => $request['phone'],
      //   'address' => $request['address'],
      //   'city' => $request['city'],
      //   'age' => $request['age'],
      //   'etnia' => $request['etnia'],
      //   'sex' => $request['sex'],
      // ]);

      // Person::create([
      //   'name' => $request['name'],
      //   'lastname' => $request['lastname'],
      //   'phone' => $request['phone'],
      //   'address' => $request['address'],
      //   'city' => $request['city'],
      //   'age' => $request['age'],
      //   'etnia' => $request['etnia'],
      //   'sex' => $request['sex'],
      //   'user_id' => $user->id,
      // ]);

      // $person = new Person();
      // $person->name = $request->input('name');
      // $person->lastname = $request->input('lastname');
      // $person->phone = $request->input('phone');
      // $person->address = $request->input('address');
      // $person->city = $request->input('city');
      // $person->age = $request->input('age');
      // $person->etnia = $request->input('etnia');
      // $person->sex = $request->input('sex');
      // $person->save(); // Insertar

      // $user = new User();
      // $user->name = $request->input('name');
      // $user->description = $request->input('description');
      // $user->save(); // Insertar

      $notification = "El usuario se ha registrado correctamente.";
      return redirect('/histories')->with(compact('notification'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $history = History::findOrfail($id);  //Esto es un solo registro por lo tanto se lo puede imprimir sin ningun problema en la vista sin utilizar for each
      //$medical_consultations = $history->medical_consultations; // ojo Esto es una coleccion por lo tanto se necesita de un for each en la vista
      //$data = DB::table('medical_consultations')->where('history_id',$id)->first()->id;     //Esta consulta es la famosa builder query (ojo)
      //$id_medical_prescriptions = $history->medical_consultations->first()->id; // ojo Me trae solo el id de la relacion de la historia clinica y la consulta medica
      //$medical_prescriptions = MedicalPrescription::findOrfail($id_medical_prescriptions); // ojo Esto es un solo registro por lo tanto se lo puede imprimir sin ningun problema en la vista sin utilizar for each
      //$lab_tests = LabTest::findOrfail($id_medical_prescriptions);
      //$lab_tests = DB::table('lab_tests')->where('medical_consultation_id',$id_medical_prescriptions)->first(); //ojo
      return view('clinic_history.show', compact('history')); // ojo
      //return redirect(dd($history, $medical_consultations, $id_medical_prescriptions, $medical_prescriptions, $lab_tests )); //Este codigo me ayuda a ver la coleccion que me trae
      //return(dd($history));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
