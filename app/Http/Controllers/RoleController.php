<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Carbon\Carbon;

class RoleController extends Controller
{
//  Verificar que ha iniciado sesion
    public function __construct(){
      $this->middleware('auth');
    }
//  Metodo GET Mostrar todos los Roles
    public function index(){

      $rols = Role::all();
      return view('rols.index', compact('rols'));
    }

//  Metodo GET Abrir Formulario para Crear Nuevos Roles
    public function create(){
      return view('rols.create');
    }

//  Metodo GET Abrir Editar Formulario de un Rol
    public function edit(Role $rol){
      $time_now = Carbon::now(); // Tiempo Actual
      $time_update = Carbon::parse($rol->created_at)->floatDiffInDays($time_now->toDateTimeString());
      if ($time_update <= 0.25) { // Tiempo para actualizar maximo 6 horas
        return view('rols.edit', compact('rol'));
      }else{
        $warning = "El rol no se puede actualizar porque ha caducado el limite de tiempo.";
        return redirect('/rols')->with(compact('warning'));
        // return dd($rol);
      }
    }

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

//  Metodo POST Insertar Roles
    public function store(Request $request){
      //dd($request->all());
      $this->validation($request);

      //  Insertar Rol
      $rol = new Role();
      $rol->name = $request->input('name');
      $rol->description = $request->input('description');
      $rol->save(); // Insertar

      $notification = "El rol se ha registrado correctamente.";
      return redirect('/rols')->with(compact('notification'));
    }

//  Metodo PUT Editar Roles
    public function update(Request $request, Role $rol){
      //dd($request->all());
      $this->validation($request);

      //  Editar Rol
      $rol->name = $request->input('name');
      $rol->description = $request->input('description');
      $rol->save(); // Editar

      $notification = "El rol se ha actualizado correctamente.";
      return redirect('/rols')->with(compact('notification'));
    }
}
