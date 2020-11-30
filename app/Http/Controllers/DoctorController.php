<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Person;
use App\Models\Specialty;

class DoctorController extends Controller
{

//  Verificar que ha iniciado sesion
     public function __construct(){
       $this->middleware('auth');
     }

//  Metodo GET Mostrar todos los Usuarios
    public function index(){
        //$doctores = User::with('rols')->paginate(5);

        //$doctores = User::has('rols')->get();  //  Practicamente me devuelve todos los usuarios asociados a un rol
        $doctores = User::whereHas('rols', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
        $query->whereIn('name', ['Medico','Administrador'])->where('creator_id','=',auth()->id());
        })->get();
        return view('doctores.index', compact('doctores'));
        //return dd($doc);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

//  Metodo GET Abrir Formulario para Crear Nuevos Usuarios (Esencialmente Medicos y Administradores)
     public function create(){
       $rols = Role::all();
       $specialties = Specialty::all();
       return view('doctores.create', compact('rols', 'specialties'));
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

      //  Insertar Doctor o Usuario
      // Nos aseguramos de capturar solamente la informacion que se espera del formulario
      $user = User::create(
        $request->only('email')
        + [
            'password'=>bcrypt($request->input('password')),
            'creator_id'=>auth()->id()
        ]
      );

      $user->rols()->attach($request->input('rols'));
      $user->specialties()->attach($request->input('specialties'));

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
        $doctor = User::findOrfail($id);
        $rols = $doctor->rols;                //  Me devuelve el rol que cumple cada usuario(medico o administrador)
        $persons = $doctor->persons;
        return view('doctores.show', compact('doctor', 'rols', 'persons'));
        //return(dd($persons));
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
        $specialties = Specialty::all();

        $specialty_ids = $doctor->specialties()->pluck('specialties.id');   // Me devuelve un array de solo los ids de las especialidades que tienen relacion con usuarios

        $rols = Role::all();
        $persons = $doctor->persons;
        return view('doctores.edit', compact('doctor', 'specialties', 'rols', 'persons', 'specialty_ids'));
        //return(dd($persons));
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
