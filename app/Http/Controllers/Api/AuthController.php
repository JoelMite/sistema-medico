<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\User;

class AuthController extends Controller
{
  /**
   * Registro de usuario
   */

  // Todo Este ya no funcionaria porque es para registrar usuarios desde el movil. 
  public function signUp(Request $request)
  {
      $request->validate([
          'name' => 'required|string',
          'email' => 'required|string|email|unique:users',
          'password' => 'required|string'
      ]);

      User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password)
      ]);

      return response()->json([
          'message' => 'Successfully created user!'
      ], 201);
  }

  /**
   * Inicio de sesión y creación de token
   */
  public function login(Request $request)
  {
    //return $request->only('email','password');

    $request->validate([
          'email' => 'required|string|email',
          'password' => 'required|string',
          'remember_me' => 'boolean'
      ]);

      //$credentials = request(['email', 'password']);

       $credentials = $request->only('email', 'password');
      //
      if (!Auth::attempt($credentials)){
        $success = false;
          // return response()->json([
          //     'message' => 'Unauthorized'
          // ], 401);
        $message = "Unauthorized";
          return compact('success', 'message');
      }

      $user = User::find(auth()->id());
      $name = User::find(auth()->id())->person->name;
      $patient = Auth::user()->havePermission('appointmentmedical.create');
      
      /* $patient = auth()->user()->whereHas('roles', function($query){
        $query->whereHas('permissions', function($query){
            $query->where('name','=','Crear Cita Médica');
        });
      })->get(); */

      $tokenResult = $user->createToken('Personal Access Token');

      $token = $tokenResult->token;
      // if ($request->remember_me)
      //     $token->expires_at = Carbon::now()->addWeeks(1);
      $token->save();

      $access_token = $tokenResult->accessToken;
      $success = true;
      //$rols = $user->rols;                //  Me devuelve el rol que cumple cada usuario(medico o administrador)
      //$persons = $user->persons;

      return compact('user', 'patient', 'name', 'access_token', 'success');

      // return response()->json([
      //     'access_token' => $tokenResult->accessToken,
      //     'token_type' => 'Bearer',
      //     'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
      // ]);
  }

  /**
   * Cierre de sesión (anular el token)
   */
  public function logout(Request $request)
  {
      $request->user()->token()->revoke();

      return response()->json([
          'message' => 'Successfully logged out'
      ]);
  }

  /**
   * Obtener el objeto Person como json
   */
  /* public function show()
  {
      return Auth::guard('api')->user()->person()->first();
  } */
}
