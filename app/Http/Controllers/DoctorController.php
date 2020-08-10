<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\rol;
class DoctorController extends Controller
{

//  Verificar que ha iniciado sesion
     public function __construct(){
       $this->middleware('auth');
     }

//  Metodo GET Mostrar todos los Usuarios
    public function index(){
        $doctores = User::all();
        return view('doctores.index', compact('doctores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

//  Metodo GET Abrir Formulario para Crear Nuevos Usuarios (Esencialmente Medicos y Administradores)
     public function create(){
       $rols = Rol::all();
       return view('doctores.create', compact('rols'));
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
         'name' => 'required',
         'email' => 'required|email',
         'password' => 'required'
       ];
       $messages = [
         'name.required' => 'Es necesario ingresar un nombre.',
         'email.required' => 'Es necesario ingresar un correo.',
         'password.required' => 'Es necesario ingresar una contraseña.'
       ];
       $this->validate($request, $rules, $messages);
     }

    public function store(Request $request){
      $this->validation($request);

      //  Insertar Doctor o Usuario
      // Nos aseguramos de capturar solamente la informacion que se espera del formulario
      $user = User::create(
        $request->only('name','email')
        + [
            'password'=>bcrypt($request->input('password'))
        ]
      );

      $user->rols()->attach($request->input('rols'));

      // $user = new User();
      // $user->name = $request->input('name');
      // $user->description = $request->input('description');
      // $user->save(); // Insertar

      $notification = "El usuario se ha registrado correctamente.";
      return redirect('/doctores')->with(compact('notification'));
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
        $doctor = User::findOrfail($id);
        $rols = Rol::all();
        return view('doctores.edit', compact('doctor', 'rols'));
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
