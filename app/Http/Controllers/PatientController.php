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
      $patients =  User::with('rols')->paginate(5);
      return view('patients.index', compact('patients'));
      //return redirect(dd($patients));
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
         //  Validar a los datos del formulario doctor a nivel de servidor
         $rules = [
           'name' => 'required',
           'lastname' => 'required',
           'email' => 'required|email',
           'password' => 'required',
           'phone' => 'required',
           'address' => 'required',
           'city' => 'required',
           'age' => 'required',
           'etnia' => 'required',
           'sex' => 'required'

         ];
         $messages = [
           'name.required' => 'Es necesario ingresar los nombres.',
           'lastname.required' => 'Es necesario ingresar los apellidos.',
           'email.required' => 'Es necesario ingresar un correo.',
           'password.required' => 'Es necesario ingresar una contraseña.',
           'phone.required' => 'Es necesario ingresar un telefono.',
           'address.required' => 'Es necesario ingresar una direccion.',
           'city.required' => 'Es necesario ingresar una ciudad.',
           'age.required' => 'Es necesario ingresar un año.',
           'etnia.required' => 'Es necesario ingresar una etnia.',
           'sex.required' => 'Es necesario ingresar un sexo.'
         ];
         $this->validate($request, $rules, $messages);
       }

  public function store(Request $request){
    $this->validation($request);

    //  Insertar Paciente
    // Nos aseguramos de capturar solamente la informacion que se espera del formulario
    $user = User::create(
      $request->only('email')
      + [
          'password'=>bcrypt($request->input('password'))
      ]
    );

    $user->rols()->attach(3);

    $user->persons()->create([
      'name' => $request['name'],
      'lastname' => $request['lastname'],
      'phone' => $request['phone'],
      'address' => $request['address'],
      'city' => $request['city'],
      'age' => $request['age'],
      'etnia' => $request['etnia'],
      'sex' => $request['sex'],
    ]);

    $notification = "El paciente se ha registrado correctamente.";
    return redirect('/patients')->with(compact('notification'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $usuario = auth()->user()->rols()->first()->name;
      return redirect(dd($usuario));
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
