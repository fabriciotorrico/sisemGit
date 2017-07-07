<?php

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

Route::get('/h', function () {
    return view('layouts.layout');
});

Route::get('/contadorVehiculos/{ip}/{vehiculos}', 'sensorsController@contadorVehiculos')->name('contadorVehiculos');

//Ruta ubicacion de los semaforos
Route::get('/ubicacionSemaforos', 'mapsController@ubiSemaforos')->name('ubicacionSemaforos');

//Ruta nuevo semaforo
Route::get('/nuevoSemaforo', 'mapsController@nuevoSemaforo')->name('nuevoSemaforo');

//Ruta login
Route::get('/', function () {
    return view('Auth.login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
