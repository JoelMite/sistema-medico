<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
  /**
   * Registro de usuario
   */
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

      $user = $request->user();
      $tokenResult = $user->createToken('Personal Access Token');

      $token = $tokenResult->token;
      // if ($request->remember_me)
      //     $token->expires_at = Carbon::now()->addWeeks(1);
      $token->save();

      $access_token = $tokenResult->accessToken;
      $success = true;
      //$rols = $user->rols;                //  Me devuelve el rol que cumple cada usuario(medico o administrador)
      //$persons = $user->persons;

      return compact('success', 'user', 'access_token');

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
   * Obtener el objeto User como json
   */
  public function user(Request $request)
  {
      return response()->json($request->user());
  }
}
