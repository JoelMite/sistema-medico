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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Rol
Route::get('/rols', 'RolController@index');
Route::get('/rols/create', 'RolController@create');   // Formulario de Registro de Roles
Route::get('/rols/{rol}/edit', 'RolController@edit');   // Formulario de Edicion de Roles
Route::post('/rols', 'RolController@store');    // Envio del Formulario de Roles
Route::put('/rols/{rol}', 'RolController@update');   // Editar un Rol
Route::delete('/rols/{rol}', 'RolController@destroy');   // Eliminar un Rol

// Doctores
Route::resource('doctores', 'DoctorController');

// Historia Clinica
Route::get('/histories', 'HistoryController@index');
Route::get('/histories/{history}/create', 'HistoryController@create');   // Formulario de Registro de HC
Route::get('/histories/{history}/edit', 'HistoryController@edit');   // Formulario de Edicion de HC
Route::post('/histories', 'HistoryController@store');    // Envio del Formulario de HC
Route::put('/histories/{history}', 'HistoryController@update');   // Editar un HC
Route::get('/histories/{history}', 'HistoryController@show');   // Mostrar un HC
Route::delete('/histories/{history}', 'HistoryController@destroy');   // Eliminar un Rol
// Route::resource('clinic_history', 'HistoryController');

// Pacientes
Route::resource('patients', 'PatientController');
