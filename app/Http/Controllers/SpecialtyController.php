<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Specialty;

class SpecialtyController extends Controller
{
  //  Verificar que ha iniciado sesion
      public function __construct(){
        $this->middleware('auth');
      }
  //  Metodo GET Mostrar todos las Especialidades
      public function index(){

        Gate::authorize('haveaccess','specialty.index');

        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
      }

  //  Metodo GET Abrir Formulario para Crear Nuevas Especialidades
      public function create(){

        Gate::authorize('haveaccess','specialty.create');

        return view('specialties.create');
      }

  //  Metodo GET Abrir Editar Formulario de una Especialidad
      public function edit(Specialty $specialty){

        Gate::authorize('haveaccess','specialty.edit');

        return view('specialties.edit', compact('specialty'));
      }

  //  Metodo Validacion
      private function validation(Request $request){
        //  Validar a los datos del formulario especialidad a nivel de servidor
        $rules = [
          'name' => 'required',
          'description' => 'required'
        ];
        $messages = [
          'name.required' => 'Es necesario ingresar un nombre.',
          'description.required' => 'Es necesario ingresar una descripcion.'
        ];
        $this->validate($request, $rules, $messages);
      }

  //  Metodo POST Insertar Especialidades
      public function store(Request $request){
        //dd($request->all());
        $this->validation($request);

        //  Insertar Especialidad
        $specialty = new Specialty();
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); // Insertar

        $success = "La especialidad se ha registrado correctamente.";
        return redirect('/specialties')->with(compact('success'));
      }

  //  Metodo PUT Editar Especialidades
      public function update(Request $request, Specialty $specialty){
        //dd($request->all());
        $this->validation($request);

        //  Editar Especialidad
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); // Editar

        $success = "La especialidad se ha actualizado correctamente.";
        return redirect('/specialties')->with(compact('success'));
      }


      public function getDoctors(Request $request){
        if ($request->ajax()) {
          $specialty = Specialty::findOrfail($request->specialty_id);
          $user_id_pluck = $specialty->users()->pluck('users.id')->first();
          if (empty($user_id_pluck)) {
            return [];
          }else{

            //Podria ser Esto ////:) Ahi fue Joel Que bien.
            $ens = [];
            foreach ($specialty->users as $user) {
              $en = [];
               $en ['id']= $user['id'] ?? 'Desconocido';
               $en ['name']= $user->person['name'] ?? 'Desconocido';
               $en ['lastname']= $user->person['lastname'] ?? 'Desconocido';
               $en ['user_id']= $user->person['user_id'];

              $ens []= $en;
            }

            return response()->json($ens);
        }
      }
    }

    public function getSpecialties(){
      $specialties = Specialty::all();
      return response()->json($specialties);
    }
}
