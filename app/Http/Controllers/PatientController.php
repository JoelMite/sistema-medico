<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
class PatientController extends Controller
{
//  Verificar que ha iniciado sesion
   public function __construct(){
     $this->middleware('auth');
   }

//  Metodo GET Mostrar todos los Usuarios
  public function index(){
      $patients = User::all();
      return view('patients.index', compact('patients'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

//  Metodo GET Abrir Formulario para Crear Nuevos Usuarios (Esencialmente Medicos y Administradores)
   public function create(){
     return view('patients.create');
   }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

//  Metodo Validacion
   private function validation(Request $request){
     //  Validar a los datos del formulario rol a nivel de servidor
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

  public function store(Request $request){
    $this->validation($request);

    //  Insertar Rol
    $user = new User();
    $user->name = $request->input('name');
    $user->description = $request->input('description');
    $user->save(); // Insertar

    $notification = "El rol se ha registrado correctamente.";
    return redirect('/rols')->with(compact('notification'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      return view('patients.edit');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Doctor $doctor)
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
