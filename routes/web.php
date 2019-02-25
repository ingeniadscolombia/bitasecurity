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

Route::get('/', function () {
    return view('welcome');
});

// resource recibe nos parámetros(URI del recurso, Controlador que gestionará las peticiones)
Route::resource('Ciudades','CiudadesController');
// resource recibe nos parámetros(URI del recurso, Controlador que gestionará las peticiones)
Route::resource('departamentos','DepartamentosController');
// resource recibe nos parámetros(URI del recurso, Controlador que gestionará las peticiones)
Route::resource('paises','PaisesController');
// resource recibe nos parámetros(URI del recurso, Controlador que gestionará las peticiones)
Route::resource('usuarios','UsuariosController');
Route::post('login','UsuariosController@loguin');
Route::post('recordarContraseña','UsuariosController@recordarContraseña');

/**
 * |--------------------------------------------------------------------------------
 * |    RUTAS PARA ADMINISTRAR APP (web)
 * |-------------------------------------------------------------------------------
 * | Estas son las rutas para realizar la administracion de la aplicacion desde la 
 * | web.
 * |
 */
Route::get('/app/ciudades',function(){return view('app.ciudades');})->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
