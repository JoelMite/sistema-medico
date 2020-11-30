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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Middleware para solo Administradores
Route::middleware(['auth', 'administrator'])->group(function () {
  // Rol
  Route::get('/rols', 'RoleController@index');
  Route::get('/rols/create', 'RoleController@create');   // Formulario de Registro de Roles
  Route::get('/rols/{rol}/edit', 'RoleController@edit');   // Formulario de Edicion de Roles
  Route::post('/rols', 'RoleController@store');    // Envio del Formulario de Roles
  Route::put('/rols/{rol}', 'RoleController@update');   // Editar un Rol
  Route::delete('/rols/{rol}', 'RoleController@destroy');   // Eliminar un Rol

  // Doctores o Usuarios
  Route::resource('doctores', 'DoctorController');

  // Especialidades
  Route::get('/specialties', 'SpecialtyController@index');
  Route::get('/specialties/create', 'SpecialtyController@create');   // Formulario de Registro de Roles
  Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');   // Formulario de Edicion de Roles
  Route::post('/specialties', 'SpecialtyController@store');    // Envio del Formulario de Roles
  Route::put('/specialties/{specialty}', 'SpecialtyController@update');   // Editar un Rol
  Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');   // Eliminar un Rol
});

// Middleware para solo Doctores
Route::middleware(['auth', 'doctor'])->group(function () {
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
  Route::get('/medical_consultations/{history}/create', 'MedicalConsultationController@create');   // Formulario de Registro de HC
  Route::get('/medical_consultations/{history}/edit', 'MedicalConsultationController@edit');   // Formulario de Edicion de HC
  Route::post('/medical_consultations', 'MedicalConsultationController@store');    // Envio del Formulario de HC
  Route::put('/medical_consultations/{history}', 'MedicalConsultationController@update');   // Editar un HC
  Route::get('/medical_consultations/{history}', 'MedicalConsultationController@show');   // Mostrar un HC
  Route::delete('/medical_consultations/{history}', 'MedicalConsultationController@destroy');   // Eliminar un Rol

  // Pacientes
  Route::resource('patients', 'PatientController');

  // Calendario
  Route::get('/schedule', 'ScheduleController@edit');
  Route::post('/schedule', 'ScheduleController@store');

});

// Middleware para solo Pacientes Y Doctores
Route::middleware(['auth', 'pat_doc'])->group(function () {

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
  Route::get('/specialties/{specialty}/doctors', 'Api\SpecialtyController@doctors');
  Route::get('/schedule/hours', 'Api\ScheduleController@hours');

});
