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


//Ruta para ir al inicio
Route::get('/inicio', 'gestionUsuariosController@inicio')->name('inicio');

//Ruta login
Route::get('/', function () {
    return view('Auth.login');
});

//Route::group(['middleware' => ['auth']], function () {
Auth::routes();
//});

Route::get('/home', 'HomeController@index')->name('home');


/*********************************************RUTA AYUDA*******************************************************/
//Ruta para ver video y manual en ayuda
Route::get('/ayuda', 'gestionUsuariosController@ayuda')->name('ayuda');
/*********************************************FIN RUTA AYUDA*******************************************************/



/*********************************************RUTA ERRORES*******************************************************/
//Ruta error 403
Route::get('/403', 'gestionUsuariosController@error403')->name('error403');
/*********************************************FIN RUTA ERRORES*******************************************************/



/*********************************************RUTAS PROMOCIONES*******************************************************/
//Ruta para ver las promociones disponibles a ser canjeadas
Route::get('/verPromociones', 'promocionesController@verPromociones')->name('verPromociones');

//Ruta para ver formulario de introducir cupones
Route::post('/formularioIntroducirCupon', 'promocionesController@formularioIntroducirCupon')->name('formularioIntroducirCupon');

//Ruta para introducir cupones
Route::post('/introducirCupon', 'promocionesController@introducirCupon')->name('introducirCupon');
/*************** **************************FIN RUTAS PROMOCIONES *****************************************************/



/*********************************************RUTAS MIS DATOS*******************************************************/
//Ruta para ver datos del usuario autenticado
Route::get('/verMisDatos', 'gestionUsuariosController@verMisDatos')->name('verMisDatos');

//Ruta para ver formulario de modificar datos del usuario autenticado
Route::get('/formularioModificarMisDatos', 'gestionUsuariosController@formularioModificarMisDatos')->name('formularioModificarMisDatos');

//Ruta para modificar datos del usuario autenticado
Route::post('/modificarMisDatos', 'gestionUsuariosController@modificarMisDatos')->name('modificarMisDatos');
/*********************************************FIN RUTAS MIS DATOS*******************************************************/



/*********************************************RUTAS REPORTES*******************************************************/

Route::group(['middleware' => 'tipoDeUsuario:1'], function () {

  //Ruta para ver usuarios existentes
  Route::get('/reporteVerUsuarios', 'reportesController@reporteVerUsuarios')->name('reporteVerUsuarios');

  //Ruta para imprimir reporte en pdf de usuarios existentes
  Route::post ('/imprimirVerUsuarios', 'reportesController@imprimirVerUsuarios')->name('imprimirVerUsuarios');

  //Ruta para ver contratos
  Route::get('/reporteContratos', 'reportesController@reporteContratos')->name('reporteContratos');

  //Ruta para descargar contrato seleccionado
  Route::post ('/reporteContratos', 'reportesController@descargarContrato')->name('descargarContrato');

  //Ruta para selleccionar el tipo de reporte de ventas a generar
  Route::get ('/seleccionarReporteDeVentas', 'reportesController@seleccionarReporteDeVentas')->name('seleccionarReporteDeVentas');

  //Ruta para ver reporte de detalle de ventas
  Route::post ('/reporteDetalle', 'reportesController@reporteVerDetalleDeVentas')->name('reporteVerDetalleDeVentas');

  //Ruta para imprimir reporte en pdf el detalle de ventas
  Route::post ('/imprimirDetalle', 'reportesController@imprimirDetalleDeVentas')->name('imprimirDetalleDeVentas');

  //Ruta para ver reporte de numero de ventas
  Route::post ('/reporteNumero', 'reportesController@reporteVerNumeroDeVentas')->name('reporteVerNumeroDeVentas');

  //Ruta para imprimir reporte en pdf el numero de ventas
  Route::post ('/imprimirNumero', 'reportesController@imprimirNumeroDeVentas')->name('imprimirNumeroDeVentas');
});

/*************** **************************FIN RUTAS REPORTES *****************************************************/



/*************** ************************** RUTAS GESTIÓN DE USUARIOS *****************************************************/
Route::group(['middleware' => 'tipoDeUsuario:1'], function () {

  //Ruta para vista de registrar usuario con grupo para que pida autenticacion
  Route::group(['middleware' => ['auth']], function () {
    Route::get('/registrarUsuario', function () {
          $tipo_de_usuario = \DB::table('tipos_de_usuarios')
              ->select('id_tipo_usuario', 'tipo_usuario')
              ->get();
          return view('admin.registrarUsuario', compact('tipo_de_usuario'));
    })->name('registrarUsuario');

  //Rutas de Confirmacion y Error en Operaciones
    Route::get('/registroUsuarioExitoso', function () {
          $mensaje = "Usuario Registrado con Exito.";
          return view('partials.exitoso', compact('mensaje'));
    })->name('registroUsuarioExitoso');
  });

  //Ruta para ver usuarios y modificarlos
  Route::get('/usuariosModificar', 'gestionUsuariosController@verModificarUsuarios')->name('verModificarUsuarios');

  //Ruta para ver formulario de modificar usuarios
  Route::post('/formModificarUsuario', 'gestionUsuariosController@formularioModificarUsuario')->name('formularioModificarUsuario');

  //Ruta para modificar usuarios
  Route::post('/modificarUsuario', 'gestionUsuariosController@modificarUsuario')->name('modificarUsuario');

  //Ruta para ver usuarios y borrarlos (OJO, no sirve, modificar codigo)
  Route::get('/usuariosBorrar', 'gestionUsuariosController@verBorrarUsuarios')->name('verBorrarUsuarios');

  //Ruta para borrar usuarios (OJO, no sirve, modificar codigo)
  Route::post('/borrarUsuario', 'gestionUsuariosController@borrarUsuario')->name('borrarUsuario');

});
/*************** **************************FIN RUTAS GESTIÓN DE USUARIOS *****************************************************/
