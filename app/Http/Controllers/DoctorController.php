<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Person;
use App\Models\Specialty;
use Carbon\Carbon;


class DoctorController extends Controller
{

//  Verificar que ha iniciado sesion
     public function __construct(){
       $this->middleware('auth');
     }

//  Metodo GET Mostrar todos los Usuarios
    public function index(){

        Gate::authorize('haveaccess','doctor.index');
        //$doctores = User::with('rols')->paginate(5);

        //$doctores = User::has('rols')->get();  //  Practicamente me devuelve todos los usuarios asociados a un rol
        $doctores = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
        $query->where('creator_id','=',auth()->id());
        })->get();
        return view('doctors.index', compact('doctores'));
        //return dd($doc);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

//  Metodo GET Abrir Formulario para Crear Nuevos Usuarios (Esencialmente Medicos y Administradores)
     public function create(){

       Gate::authorize('haveaccess','doctor.create');

       $roles = Role::all();
       $specialties = Specialty::all();
       return view('doctors.create', compact('roles', 'specialties'));
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
         // 'dni' => 'bail|required|unique:persons,dni|ecuador:ci|digits:10',
         'dni' => 'bail|required|ecuador:ci|digits:10',
         // 'email' => 'required|unique:users,email|email',
         'email' => 'required|email',
         'password' => 'required|min:6',
         'specialties' => 'required|array',
         'phone' => 'required|max:15',
         'address' => 'required',
         'city' => 'required',
         'etnia' => 'required',
         'date_birth' => 'required|date',
         'sex' => 'required',
         'roles' => 'required|array'

       ];
       $messages = [
         'name.required' => 'Es necesario ingresar los nombres.',
         'lastname.required' => 'Es necesario ingresar los apellidos.',
         'dni.required' => 'Es necesario ingresar un DNI.',
         // 'dni.unique' => 'Este DNI ya se encuentra registrado.',
         'dni.ecuador' => 'El DNI que ha ingresado es invalido.',
         'dni.digits' => 'El DNI que tiene que tener exactamente 10 dígitos.',
         'email.required' => 'Es necesario ingresar un correo.',
         // 'email.unique' => 'Este email ya se encuentra registrado.',
         'email.email' => 'Es necesario ingresar un correo válido.',
         'password.required' => 'Es necesario ingresar una contraseña.',
         'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
         'specialties.required' => 'Es necesario ingresar por lo menos una especialidad.',
         'phone.required' => 'Es necesario ingresar un telefono.',
         'phone.max' => 'El número telefónico no puede exceder los 15 dígitos.',
         'address.required' => 'Es necesario ingresar una direccion.',
         'city.required' => 'Es necesario ingresar una ciudad.',
         'etnia.required' => 'Es necesario ingresar una etnia.',
         'date_birth.required' => 'Es necesario ingresar una fecha de nacimiento.',
         'date_birth.date' => 'Es necesario ingresar una fecha de nacimiento válida.',
         'sex.required' => 'Es necesario ingresar un sexo.',
         'roles.required' => 'Es necesario ingresar por lo menos un rol.'
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
            'creator_id'=>auth()->id(),
            'state'=>'200'
        ]
      );

      $user->specialties()->attach($request->input('specialties'));
      $user->roles()->attach($request->input('roles'));

      $date_birth = Carbon::parse($request['date_birth'])->age; // Utilizo Carbon para calcular la edad a partir de la fecha de nacimiento

      $user->person()->create([
        'name' => $request['name'],
        'lastname' => $request['lastname'],
        'dni' => $request['dni'],
        'phone' => $request['phone'],
        'address' => $request['address'],
        'city' => $request['city'],
        'etnia' => $request['etnia'],
        'date_birth' => $request['date_birth'],
        'age' => $date_birth,
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

      $success = "El usuario se ha registrado correctamente.";
      return redirect('/doctors')->with(compact('success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        Gate::authorize('haveaccess','doctor.show');

        $doctor = User::findOrfail($id);
        $roles = $doctor->roles;                //  Me devuelve el rol que cumple cada usuario(medico o administrador)
        $persons = $doctor->person;
        return view('doctors.show', compact('doctor', 'roles', 'persons'));
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

        Gate::authorize('haveaccess','doctor.edit');

        $doctor = User::findOrfail($id);
        $specialties = Specialty::all();

        $specialty_ids = $doctor->specialties()->pluck('specialties.id');   // Me devuelve un array de solo los ids de las especialidades que tienen relacion con usuarios
        $role_ids = $doctor->roles()->pluck('roles.id');

        // return $role_ids;

        $roles = Role::all();
        $persons = $doctor->person;
        return view('doctors.edit', compact('doctor', 'specialties', 'roles', 'persons', 'specialty_ids', 'role_ids'));
        //return(dd($persons));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $doctor)
    {
      // $this->validation($request);

      //  Validar a los datos del formulario doctor a nivel de servidor
      $rules = [
        'name' => 'required',
        'lastname' => 'required',
        // 'dni' => 'bail|required|unique:persons,dni|ecuador:ci|digits:10',
        'dni' => 'bail|required|ecuador:ci|digits:10',
        // 'email' => 'required|unique:users,email|email',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'specialties' => 'required|array',
        'phone' => 'required|max:15',
        'address' => 'required',
        'city' => 'required',
        'etnia' => 'required',
        'date_birth' => 'required|date',
        'sex' => 'required',
        'roles' => 'required|array'

      ];
      $messages = [
        'name.required' => 'Es necesario ingresar los nombres.',
        'lastname.required' => 'Es necesario ingresar los apellidos.',
        'dni.required' => 'Es necesario ingresar un DNI.',
        // 'dni.unique' => 'Este DNI ya se encuentra registrado.',
        'dni.ecuador' => 'El DNI que ha ingresado es invalido.',
        'dni.digits' => 'El DNI que tiene que tener exactamente 10 dígitos.',
        'email.required' => 'Es necesario ingresar un correo.',
        // 'email.unique' => 'Este email ya se encuentra registrado.',
        'email.email' => 'Es necesario ingresar un correo válido.',
        'password.required' => 'Es necesario ingresar una contraseña.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        'specialties.required' => 'Es necesario ingresar por lo menos una especialidad.',
        'phone.required' => 'Es necesario ingresar un telefono.',
        'phone.max' => 'El número telefónico no puede exceder los 15 dígitos.',
        'address.required' => 'Es necesario ingresar una direccion.',
        'city.required' => 'Es necesario ingresar una ciudad.',
        'etnia.required' => 'Es necesario ingresar una etnia.',
        'date_birth.required' => 'Es necesario ingresar una fecha de nacimiento.',
        'date_birth.date' => 'Es necesario ingresar una fecha de nacimiento válida.',
        'sex.required' => 'Es necesario ingresar un sexo.',
        'roles.required' => 'Es necesario ingresar por lo menos un rol.'
      ];
      $this->validate($request, $rules, $messages);

      $date_birth = Carbon::parse($request['date_birth'])->age;

      $doctor->email = $request->input('email');
      $password = $request->input('password');

      if ($password)
      $doctor->password = bcrypt($request->input('password'));

      $doctor->save(); // Editar

      $doctor->specialties()->sync($request->input('specialties'));
      $doctor->roles()->sync($request->input('roles'));

      $person = $doctor->person;

      $person->name = $request->name;
      $person->lastname = $request->lastname;
      $person->dni = $request->dni;
      $person->phone = $request->phone;
      $person->address = $request->address;
      $person->city = $request->city;
      $person->etnia = $request->etnia;
      $person->date_birth = $request->date_birth;
      $person->age = $date_birth;
      $person->sex = $request->sex;

      $person->save();

      $success = "El usuario se ha actualizado correctamente.";
      return redirect('/doctors')->with(compact('success'));
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

    public function state($id)
    {

      Gate::authorize('haveaccess','user.state');

      //dd($request->all());
      $doctor = User::findOrfail($id);
      if($doctor->state == "403"){
        $doctor->state = "200";
        $success = "El usuario a sido activado";
      }
      elseif($doctor->state == "200"){
        $doctor->state = "403";
        $success = "El usuario a sido baneado";
      }
        if ($doctor->save()){ // Editar
        return redirect('/doctors')->with(compact('success'));
        // return dd($notification);
      }
    }

    public function count_users(){

      Gate::authorize('haveaccess','administrator.dashboard');

      $user = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
      $query->where('name', 'Medico')->where('creator_id','=',auth()->id());
      })->count();
      return response()->json($user);

    }

    public function activeUsers(){

      Gate::authorize('haveaccess','administrator.dashboard');

      $user = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
      $query->where('name', 'Medico')->where('creator_id','=',auth()->id())->where('state', '200');
      })->count();
      return response()->json($user);

    }

    public function bannedUsers(){

      Gate::authorize('haveaccess','administrator.dashboard');

      $user = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
      $query->where('name', 'Medico')->where('creator_id','=',auth()->id())->where('state', '403');
      })->count();
      return response()->json($user);

    }
}
