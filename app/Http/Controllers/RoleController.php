<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Carbon\Carbon;

class RoleController extends Controller
{
//  Verificar que ha iniciado sesion
    public function __construct(){
      $this->middleware('auth');
    }
//  Metodo GET Mostrar todos los Roles
    public function index(){

      Gate::authorize('haveaccess','role.index');

      $roles = Role::all();
      return view('roles.index', compact('roles'));
    }

//  Metodo GET Abrir Formulario para Crear Nuevos Roles
    public function create(){

      Gate::authorize('haveaccess','role.create');

      $permissions_patients = Permission::where('name', 'LIKE', '%paciente%')->orWhere('name', 'LIKE', '%perfil%')->get(); // 4 resultados
      $permissions_doctor = Permission::where('name', 'LIKE', '%medico%')->where('name', 'NOT LIKE', '%dashboard%')->orWhere('name', 'LIKE', '%perfil%')->orWhere('name', 'LIKE', '%horario%')->get(); // 6 resultados
      $permissions_role = Permission::where('name', 'LIKE', '%rol%')->get(); // 4 resultados
      $permissions_specialty = Permission::where('name', 'LIKE', '%especialidad%')->get(); // 4 resultados
      $permissions_user = Permission::where('name', 'LIKE', '%usuario%')->get(); // 2 resultados
      $permissions_history_clinic = Permission::where('name', 'LIKE', '%clinica%')->get(); // 4 resultados
      $permissions_consultation_appointment_medical = Permission::where('name', 'LIKE', '%medica%')->get(); // 9 resultados
      $permissions_dashboard = Permission::where('name', 'LIKE', '%dashboard%')->get(); // 2 resultados

      //return $permissions_doctor;
      return view('roles.create', compact('permissions_patients', 'permissions_doctor', 'permissions_role', 'permissions_specialty', 'permissions_user', 'permissions_history_clinic', 'permissions_consultation_appointment_medical', 'permissions_dashboard'));
    }

//  Metodo GET Abrir Editar Formulario de un Rol
    public function edit(Role $role){

      Gate::authorize('haveaccess','role.edit');

      $permissions_patients = $role->permissions()->where(function ($query) {
      $query->where('name', 'LIKE', '%paciente%')
      ->orWhere('name', 'LIKE', '%perfil%');
      })->get();

      $permissions_doctor = $role->permissions()->where(function ($query) {
      $query->where('name', 'LIKE', '%medico%')
      ->where('name', 'NOT LIKE', '%dashboard%')
      ->orWhere('name', 'LIKE', '%perfil%')
      ->orWhere('name', 'LIKE', '%horario%');
      })->get();

      $permissions_role = $role->permissions()->where(function ($query) {
      $query->where('name', 'LIKE', '%rol%');})->get();

      $permissions_specialty = $role->permissions()->where(function ($query) {
      $query->where('name', 'LIKE', '%especialidad%');})->get();

      $permissions_user = $role->permissions()->where(function ($query) {
      $query->where('name', 'LIKE', '%usuario%');})->get();

      $permissions_history_clinic = $role->permissions()->where(function ($query) {
      $query->where('name', 'LIKE', '%clinica%');})->get();

      $permissions_consultation_appointment_medical = $role->permissions()->where(function ($query) {
      $query->where('name', 'LIKE', '%medica%');})->get();

      $permissions_dashboard = $role->permissions()->where(function ($query) {
      $query->where('name', 'LIKE', '%dashboard%');})->get();


      // $permissions_patients = $role::whereHas('permissions')->get();

      $time_now = Carbon::now(); // Tiempo Actual
      $time_update = Carbon::parse($role->created_at)->floatDiffInDays($time_now->toDateTimeString());
      if ($time_update <= 0.25) { // Tiempo para actualizar maximo 6 horas
        return view('roles.edit', compact('role', 'permissions_patients', 'permissions_doctor', 'permissions_role', 'permissions_specialty', 'permissions_user', 'permissions_history_clinic', 'permissions_consultation_appointment_medical', 'permissions_dashboard'));
      }else{
        $warning = "El rol no se puede actualizar porque ha caducado el limite de tiempo.";
        return redirect('/roles')->with(compact('warning'));
        // return dd($rol);
      }
    }

//  Metodo Validacion
    private function validation(Request $request){
      //  Validar a los datos del formulario rol a nivel de servidor
      $rules = [
        'name' => 'required',
        'description' => 'required',
        'permissions' => 'required'
      ];
      $messages = [
        'name.required' => 'Es necesario ingresar un nombre.',
        'description.required' => 'Es necesario ingresar una descripción.',
        'permissions.required' => 'Es necesario ingresar por lo menos un permiso.'
      ];
      $this->validate($request, $rules, $messages);
    }

//  Metodo POST Insertar Roles
    public function store(Request $request){
      //dd($request->all());
      $this->validation($request);

      //return $request;

      //  Insertar Rol
      $role = new Role();
      $role->name = $request->input('name');
      $role->description = $request->input('description');
      $role->save(); // Insertar

      // Insertar el rol con su permiso
      $role->permissions()->sync($request->input('permissions'));

      $notification = "El rol se ha registrado correctamente.";
      return redirect('/roles')->with(compact('notification'));
    }

//  Metodo PUT Editar Roles
    public function update(Request $request, Role $role){
      //dd($request->all());
      $this->validation($request);

      //  Editar Rol
      $role->name = $request->input('name');
      $role->description = $request->input('description');
      $role->save(); // Editar

      $notification = "El rol se ha actualizado correctamente.";
      return redirect('/roles')->with(compact('notification'));
    }
}
