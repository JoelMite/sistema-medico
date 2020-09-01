<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\specialty;

class SpecialtyController extends Controller
{
  //  Verificar que ha iniciado sesion
      public function __construct(){
        $this->middleware('auth');
      }
  //  Metodo GET Mostrar todos las Especialidades
      public function index(){

        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
      }

  //  Metodo GET Abrir Formulario para Crear Nuevas Especialidades
      public function create(){
        return view('specialties.create');
      }

  //  Metodo GET Abrir Editar Formulario de una Especialidad
      public function edit(Specialty $specialty){
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

        $notification = "La especialidad se ha registrado correctamente.";
        return redirect('/specialties')->with(compact('notification'));
      }

  //  Metodo PUT Editar Especialidades
      public function update(Request $request, Specialty $specialty){
        //dd($request->all());
        $this->validation($request);

        //  Editar Especialidad
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); // Editar

        $notification = "La especialidad se ha actualizado correctamente.";
        return redirect('/specialties')->with(compact('notification'));
      }
}
