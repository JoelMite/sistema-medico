<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\history;
use App\person;
use App\user;

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
      $persons = Person::all();
      $histories = History::all();
      $nohavePersonHistory = Person::doesntHave('history')->get(); // Este metodo me retorna las personas que no tienen una historia clinica
      return view('clinic_history.index', compact('persons', 'histories', 'nohavePersonHistory'));
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
         'current_illness' => 'required'
       ];
       $messages = [
         'personal_history.required' => 'Es necesario ingresar los antecedentes personales.',
         'family_background.required' => 'Es necesario ingresar los antecedentes familiares.',
         'current_illness.required' => 'Es necesario ingresar la enfermedad actual.'
       ];
       $this->validate($request, $rules, $messages);
     }
    public function store(Request $request)
    {
      $this->validation($request);

      //  Insertar Doctor o Usuario
      // Nos aseguramos de capturar solamente la informacion que se espera del formulario

      $history = new History();
      $history->personal_history = $request->input('personal_history');
      $history->family_background = $request->input('family_background');
      $history->current_illness = $request->input('current_illness');
      $history->person_id = $request->input('id_person');
      $history->save(); // Insertar

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
      $history = History::findOrfail($id);
      return view('clinic_history.show', compact('history'));
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
