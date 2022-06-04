<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function () {
  // Recursos Publicos -- Rutas Publicas
  Route::post('login', 'AuthController@login');
  Route::post('signup', 'AuthController@signUp');
  Route::get('specialties', 'SpecialtyController@index');
  Route::get('specialties/{specialty}/doctors', 'SpecialtyController@doctors');
  Route::get('schedule/hours', 'ScheduleController@hours');

  Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'AuthController@logout');
    Route::get('person', 'PatientController@show');
    Route::post('person', 'PatientController@update');

    // Post Appointment
    Route::post('/appointments', 'AppointmentController@store');
    // Appointments
    Route::get('/appointments', 'AppointmentController@index');

    // FCM
    Route::post('/fcm/token', 'FirebaseController@postToken');
      });

});

// Esta es la ruta que viene por defecto

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
