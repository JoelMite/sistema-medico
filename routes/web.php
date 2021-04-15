<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});

// Auth::routes(['register' => false]);
//
Route::get('/login', 'Auth\LoginController@getLogin')->name('login');
Route::post('/login', 'Auth\LoginController@postLogin')->name('login');
Route::get('/logout', 'Auth\LoginController@getLogout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

// Middleware para solo Administradores
Route::middleware(['auth', 'administrator', 'state'])->group(function () {
  // Rol
  Route::get('/rols', 'RoleController@index');
  Route::get('/rols/create', 'RoleController@create');   // Formulario de Registro de Roles
  Route::get('/rols/{rol}/edit', 'RoleController@edit');   // Formulario de Edicion de Roles
  Route::post('/rols', 'RoleController@store');    // Envio del Formulario de Roles
  Route::put('/rols/{rol}', 'RoleController@update');   // Editar un Rol
  Route::delete('/rols/{rol}', 'RoleController@destroy');   // Eliminar un Rol

  // Doctores o Usuarios
  Route::get('/doctores', 'DoctorController@index');
  Route::get('/doctores/create', 'DoctorController@create');
  Route::post('/doctores', 'DoctorController@store');
  Route::get('/doctores/{doctor}', 'DoctorController@show');
  Route::get('/doctores/{doctor}/edit', 'DoctorController@edit');
  Route::put('/doctores/{doctor}', 'DoctorController@update');
  Route::delete('/doctores/{doctor}', 'DoctorController@destroy');
  Route::get('/doctores/{doctor}/state', 'DoctorController@state');
  // Route::resource('doctores', 'DoctorController');

  // Especialidades
  Route::get('/specialties', 'SpecialtyController@index');
  Route::get('/specialties/create', 'SpecialtyController@create');   // Formulario de Registro de Roles
  Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');   // Formulario de Edicion de Roles
  Route::post('/specialties', 'SpecialtyController@store');    // Envio del Formulario de Roles
  Route::put('/specialties/{specialty}', 'SpecialtyController@update');   // Editar un Rol
  Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');   // Eliminar un Rol
});

// Middleware para solo Doctores
Route::middleware(['auth', 'doctor', 'state'])->group(function () {
  // Historia Clinica
  Route::get('/histories', 'HistoryController@index');
  Route::get('/histories/{history}/create', 'HistoryController@create');   // Formulario de Registro de HC
  Route::get('/histories/{history}/edit', 'HistoryController@edit');   // Formulario de Edicion de HC
  Route::post('/histories', 'HistoryController@store');    // Envio del Formulario de HC
  Route::put('/histories/{history}', 'HistoryController@update');   // Editar un HC
  Route::get('/histories/{history}', 'HistoryController@show');   // Mostrar un HC
  Route::delete('/histories/{history}', 'HistoryController@destroy');   // Eliminar un Rol
  // Route::resource('clinic_history', 'HistoryController');

  // Consulta Medica
  Route::get('/medical_consultations', 'MedicalConsultationController@index');
  Route::get('/medical_consultations_show', 'MedicalConsultationController@index_show');
  Route::get('/medical_consultations/{history}/create', 'MedicalConsultationController@create');   // Formulario de Registro de HC
  Route::get('/medical_consultations/{history}/edit', 'MedicalConsultationController@edit');   // Formulario de Edicion de HC
  Route::post('/medical_consultations', 'MedicalConsultationController@store');    // Envio del Formulario de HC
  Route::put('/medical_consultations/{history}', 'MedicalConsultationController@update');   // Editar un HC
  Route::get('/medical_consultations/{history}', 'MedicalConsultationController@show');   // Mostrar un HC
  Route::delete('/medical_consultations/{history}', 'MedicalConsultationController@destroy');   // Eliminar un Rol

  // Pacientes
  // Route::resource('patients', 'PatientController');
  Route::get('/patients', 'PatientController@index');
  Route::get('/patients/create', 'PatientController@create');   // Formulario de Registro de Roles
  Route::get('/patients/{patient}/edit', 'PatientController@edit');   // Formulario de Edicion de Roles
  Route::post('/patients', 'PatientController@store');    // Envio del Formulario de Roles
  Route::put('/patients/{patient}', 'PatientController@update');   // Editar un Rol
  Route::get('/patients/{patient}', 'PatientController@show');   // Mostrar un HC
  Route::delete('/patients/{patient}', 'PatientController@destroy');   // Eliminar un Rol

  // Calendario
  Route::get('/schedule', 'ScheduleController@edit');
  Route::post('/schedule', 'ScheduleController@store');

  // FCM
  Route::post('/fcm/send', 'FirebaseController@sendAll');

});

// Middleware para solo Pacientes Y Doctores
Route::middleware(['auth', 'pat_doc', 'state'])->group(function () {

  // Citas Medicas
  Route::get('/appointments/create', 'AppointmentController@create');
  Route::post('/appointments', 'AppointmentController@store');
  Route::get('/appointments', 'AppointmentController@index');
  Route::get('/appointments/{appointment}', 'AppointmentController@show');
  Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm'); // Al  ser este una actualizacion (update) podemos utilizar put p patch
  Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postCancel');
  Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postConfirm');

});

// Middleware para solo Pacientes
Route::middleware(['auth', 'patient'])->group(function () {

  //JSON
  // Route::get('/specialties/{specialty}/doctors', 'Api\SpecialtyController@doctors');
  // Route::get('/schedule/hours', 'Api\ScheduleController@hours');

});
