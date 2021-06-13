<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class PatientController extends Controller
{
//  Verificar que ha iniciado sesion
   public function __construct(){
     $this->middleware('auth');
   }

//  Metodo GET Mostrar todos los Usuarios
  public function index(){

      Gate::authorize('haveaccess','patient.index');

      //$patients =  User::with('rols')->paginate(5);
      $patients = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
      $query->where('name', 'Paciente')->where('creator_id','=',auth()->id());
      })->paginate(5);
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

     Gate::authorize('haveaccess','patient.create');

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
           'date_birth' => 'required',
           'dni' => 'ecuador:ci|required',
           // 'age' => 'required',
           'etnia' => 'required',
           'sex' => 'required'

         ];
         $messages = [
           'name.required' => 'Es necesario ingresar los nombres.',
           'email.required' => 'Es necesario ingresar un correo.',
           'password.required' => 'Es necesario ingresar una contraseña.',
           'phone.required' => 'Es necesario ingresar un telefono.',
           'address.required' => 'Es necesario ingresar una direccion.',
           'city.required' => 'Es necesario ingresar una ciudad.',
           'date_birth.required' => 'Es necesario ingresar un a fecha de nacimiento.',
           'dni.required' => 'Es necesario ingresar un DNI.',
           'dni.ecuador' => 'El DNI que ha ingresado es incorrecto.',
           // 'age.required' => 'Es necesario ingresar un año.',
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
          'password'=>bcrypt($request->input('password')),
          'creator_id'=>auth()->id(),
          'state'=>'200'
      ]
    );

    $user->roles()->attach(3);

    $date_birth = Carbon::parse($request['date_birth'])->age; // Utilizo Carbon para calcular la edad a partir de la fecha de nacimiento

    $user->person()->create([
      'name' => $request['name'],
      'lastname' => $request['lastname'],
      'phone' => $request['phone'],
      'address' => $request['address'],
      'city' => $request['city'],
      'date_birth' => $request['date_birth'],
      'dni' => $request['dni'],
      'age' => $date_birth,
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
  public function show(User $id)
  {

    Gate::authorize('haveaccess','patient.show');

      $usuario = auth()->user()->roles()->first()->name;
      return redirect(dd($usuario));
      //return dd($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    Gate::authorize('haveaccess','patient.edit');

      $patient = User::findOrfail($id);
      $time_now = Carbon::now(); // Tiempo Actual
      $time_update = Carbon::parse($patient->person['created_at'])->floatDiffInDays($time_now->toDateTimeString());
      $persons = $patient->person;
      if ($time_update <= 0.25) { // Tiempo para actualizar maximo 6 horas
        return view('patients.edit', compact('persons'));
        //return dd($persons);
      }else{
        $warning = "▪ Los datos del paciente no se pueden actualizar porque se ha caducado el limite de tiempo.";
        return redirect('/patients')->with(compact('warning'));
      }
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

  public function count_patients(){

    Gate::authorize('haveaccess','doctor.dashboard');

      $patients = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
      $query->where('name', 'Paciente')->where('creator_id','=',auth()->id());
      })->count();
      return response()->json($patients);
  }
}
