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

Auth::routes(['login' => false, 'logout' => false, 'register' => false]);
//
Route::get('/login', 'Auth\LoginController@getLogin')->name('loginUser');
Route::post('/login', 'Auth\LoginController@postLogin')->name('loginUser');
Route::get('/logout', 'Auth\LoginController@getLogout')->name('logoutUser');

Route::get('/home', 'HomeController@index')->name('home');

// Middleware para solo Administradores
Route::middleware(['auth', 'role', 'state'])->group(function () {
    // Rol
    Route::get('/roles', 'RoleController@index');
    Route::get('/roles/create', 'RoleController@create'); // Formulario de Registro de Roles
    Route::get('/roles/{role}/edit', 'RoleController@edit'); // Formulario de Edicion de Roles
    Route::post('/roles', 'RoleController@store'); // Envio del Formulario de Roles
    Route::put('/roles/{role}', 'RoleController@update'); // Editar un Rol
    Route::delete('/roles/{role}', 'RoleController@destroy'); // Eliminar un Rol

    // Doctores o Usuarios
    Route::get('/doctors', 'DoctorController@index');
    Route::get('/doctors/create', 'DoctorController@create');
    Route::post('/doctors', 'DoctorController@store');
    Route::get('/doctors/{doctor}', 'DoctorController@show');
    Route::get('/doctors/{doctor}/edit', 'DoctorController@edit');
    Route::put('/doctors/{doctor}', 'DoctorController@update');
    Route::delete('/doctors/{doctor}', 'DoctorController@destroy');
    Route::get('/doctors/{doctor}/state', 'DoctorController@state');
    // Route::resource('doctores', 'DoctorController');

    // Especialidades
    Route::get('/specialties', 'SpecialtyController@index');
    Route::get('/specialties/create', 'SpecialtyController@create'); // Formulario de Registro de Roles
    Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit'); // Formulario de Edicion de Roles
    Route::post('/specialties', 'SpecialtyController@store'); // Envio del Formulario de Roles
    Route::put('/specialties/{specialty}', 'SpecialtyController@update'); // Editar un Rol
    Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy'); // Eliminar un Rol

    // Ruta de Prueba para probarlo con vue
    Route::get('/count_users', 'DoctorController@count_users');
    // Ruta de Prueba para probarlo con vue
    Route::get('/bannedUsers', 'DoctorController@bannedUsers');
    // Ruta de Prueba para probarlo con vue
    Route::get('/activeUsers', 'DoctorController@activeUsers');

});

// Middleware para solo Doctores
Route::middleware(['auth', 'role', 'state'])->group(function () {
    // Historia Clinica
    Route::get('/histories', 'HistoryClinicController@index');
    Route::get('/histories/{user}/create', 'HistoryClinicController@create'); // Formulario de Registro de HC
    Route::get('/histories/{history}/edit', 'HistoryClinicController@edit'); // Formulario de Edicion de HC
    Route::post('/histories', 'HistoryClinicController@store'); // Envio del Formulario de HC
    Route::put('/histories/{history}', 'HistoryClinicController@update'); // Editar un HC // Al  ser este una actualizacion (update) podemos utilizar put p patch
    Route::get('/histories/{history}', 'HistoryClinicController@show'); // Mostrar un HC
    Route::delete('/histories/{history}', 'HistoryClinicController@destroy'); // Eliminar un Rol
    // Route::resource('clinic_history', 'HistoryController');

    // Consulta Medica
    Route::get('/medical_consultations', 'MedicalConsultationController@index');
    Route::get('/medical_consultations_show', 'MedicalConsultationController@index_show');
    Route::get('/medical_consultations/{person}/create', 'MedicalConsultationController@create'); // Formulario de Registro de HC
    Route::get('/medical_consultations/{history}/edit', 'MedicalConsultationController@edit'); // Formulario de Edicion de HC
    Route::post('/medical_consultations', 'MedicalConsultationController@store'); // Envio del Formulario de HC
    Route::put('/medical_consultations/{history}', 'MedicalConsultationController@update'); // Editar un HC
    Route::get('/medical_consultations/{history}', 'MedicalConsultationController@show'); // Mostrar un HC
    Route::delete('/medical_consultations/{history}', 'MedicalConsultationController@destroy'); // Eliminar un Rol

    // PDF Consultas Medicas
    Route::get('/medical_consultations_pdf/{medical_consultations}', 'PdfController@show');

    // Pacientes
    // Route::resource('patients', 'PatientController');
    Route::get('/patients', 'PatientController@index');
    Route::get('/patients/create', 'PatientController@create'); // Formulario de Registro de Roles
    Route::get('/patients/{patient}/edit', 'PatientController@edit'); // Formulario de Edicion de Roles
    Route::post('/patients', 'PatientController@store'); // Envio del Formulario de Roles
    Route::put('/patients/{patient}', 'PatientController@update'); // Editar un Rol
    Route::get('/patients/{patient}', 'PatientController@show'); // Mostrar un HC
    Route::delete('/patients/{patient}', 'PatientController@destroy'); // Eliminar un Rol
    Route::get('/patients/{patient}/state', 'PatientController@state');

    // Ruta de Prueba para probarlo con vue
    Route::get('/count_patients', 'PatientController@count_patients');
    // Ruta de Prueba para probarlo con vue
    Route::get('/pendingAppointments', 'AppointmentMedicalController@pendingAppointments');
    // Ruta de Prueba para probarlo con vue
    Route::get('/confirmedAppointments', 'AppointmentMedicalController@confirmedAppointments');
    // Ruta de Prueba para probarlo con vue
    Route::get('/attendedAppointments', 'AppointmentMedicalController@attendedAppointments');

// Ruta para descargar el PDF
    Route::get('/medical_consultations_export_pdf/{medical_consultations}', 'PdfController@export');

    // Calendario
    Route::get('/schedule', 'ScheduleController@edit');
    Route::post('/schedule', 'ScheduleController@store');

    // FCM
    Route::post('/fcm/send', 'FirebaseController@sendAll');

});

// Middleware para solo Pacientes Y Doctores
Route::middleware(['auth', 'role', 'state'])->group(function () {

    // Citas Medicas
    Route::get('/appointment_medicals/create', 'AppointmentMedicalController@create');
    Route::post('/appointment_medicals', 'AppointmentMedicalController@store');
    
    // Ruta de Prueba para probarlo con vue
    Route::get('/indexpendingAppointments', 'AppointmentMedicalController@indexPendingAppointments');
    // Ruta de Prueba para probarlo con vue
    Route::get('/indexconfirmedAppointments', 'AppointmentMedicalController@indexConfirmedAppointments');
    // Ruta de Prueba para probarlo con vue
    Route::get('/indexoldAppointments', 'AppointmentMedicalController@indexOldAppointments');

    Route::get('/appointment_medicals_patient', 'AppointmentMedicalController@indexPatient');
    Route::get('/appointment_medicals_doctor', 'AppointmentMedicalController@indexDoctor');
    /* Route::get('/appointment_medicals_doctor/{appointment}', 'AppointmentMedicalController@showDoctor');
    Route::get('/appointment_medicals_patient/{appointment}', 'AppointmentMedicalController@showPatient'); */
    /* Route::get('/appointment_medicals/{appointment}', 'AppointmentMedicalController@show'); */
    Route::get('/appointment_medicals/{appointment}/cancel', 'AppointmentMedicalController@showCancelForm');
    Route::post('/appointment_medicals/{appointment}/cancel', 'AppointmentMedicalController@postCancel');
    /* Route::post('/appointment_medicals_patient/{appointment}/cancel', 'AppointmentMedicalController@postCancel'); */
    Route::post('/appointment_medicals/{appointment}/confirm', 'AppointmentMedicalController@postConfirm');

    Route::post('/appointment_medicals/{appointment}/attend', 'AppointmentMedicalController@postAttend');
    // Ruta de Prueba en el Panel del Paciente
    // Route::get('/appointmentmedicals_test/test', 'AppointmentMedicalController@test');

    // Ruta de Prueba para probarlo con vue
    Route::get('appointment_medicals/get/doctors', 'SpecialtyController@getDoctors');
    // Ruta de Prueba para probarlo con vue
    Route::get('appointment_medicals/get/hours', 'ScheduleController@hours');
    // Ruta de Prueba para probarlo con vue
    Route::get('appointment_medicals/get/specialtiesAll', 'SpecialtyController@getSpecialties');

});

// Middleware para solo Pacientes
Route::middleware(['auth', 'patient'])->group(function () {

    //JSON
    // Route::get('/specialties/{specialty}/doctors', 'Api\SpecialtyController@doctors');
    // Route::get('/schedule/hours', 'Api\ScheduleController@hours');

});

// Middleware para Paciente, Doctor y Administrador
Route::middleware(['auth', 'role', 'state'])->group(function () {

    // Ruta del Perfil del Usuario
    Route::get('/profile', 'ProfileController@show');
    Route::put('/profile/{profile}', 'ProfileController@update');

});
