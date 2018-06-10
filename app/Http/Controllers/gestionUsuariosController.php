<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class gestionUsuariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Función prueba inicio
    public function inicio()
    {
      return view('admin.inicio');
    }

    //Función prueba ayuda
    public function ayuda()
    {
      return view('admin.ayuda');
    }

    //Función para mostrar error 403, ruta no permitida por tipo de usuario
    public function error403()
    {
      return view('errors.403');
    }

    //Función para ver datos del usuario autenticado
    public function verMisDatos()
    {
      //Seleccionamos todos los datos del usuario logueado
      $usuario = \DB::table('empresarios_cajeros')
          ->where('email', auth()->user()->email)
          ->get();

      //Seleccionamos datos de la persona logueada
      $persona = \DB::table('personas')
          ->where('id_persona', auth()->user()->id_persona)
          ->get();


      //Seleccionamos el tipo de usuario del usuario logueado
      foreach ($usuario as $user) {
        $tipo_usuario = \DB::table('tipos_de_usuarios')
            ->where('id_tipo_usuario', $user->id_tipo_usuario)
            ->value("tipo_usuario");
      }

      //Seleccionamos el tipo de usuario del usuario logueado
      foreach ($persona as $person) {
        $ciudad = \DB::table('ciudades')
              ->where('id_ciudad', $person->id_ciudad)
              ->value("ciudad");
      }

      return view('admin.verMisDatos',compact('usuario', 'persona', 'tipo_usuario', 'ciudad'));
    }

    //Función para ver el formulario de modificar datos del usuario autenticado
    public function formularioModificarMisDatos()
    {
      //Seleccionamos todos los datos del usuario autenticado
      $usuario = \DB::table('empresarios_cajeros')
          ->where('email', auth()->user()->email)
          ->get();

      //Seleccionamos datos de la persona
      foreach ($usuario as $user) {
        $persona = \DB::table('personas')
            ->where('id_persona', $user->id_persona)
            ->get();
      }

      //Seleccionamos su rol;
      foreach ($usuario as $user) {
            $tipo_usuario = \DB::table('tipos_de_usuarios')
            ->where('id_tipo_usuario', $user->id_tipo_usuario)
            ->get();
      }

      //Tomamos todos los tipos de usuarios existentes
      $tipo_de_usuarios = \DB::table('tipos_de_usuarios')
            ->get();

      //Tomamos todas las ciudades
      $ciudades = \DB::table('ciudades')
            ->get();

      return view('admin.formularioModificarMisDatos',compact('usuario', 'persona', 'tipo_de_usuarios', 'tipo_usuario', 'ciudades'));
    }


    //Función para modificar datos del usuario autenticado
    public function modificarMisDatos(Request $request)
    {
      //Verificar si la contraseña y la confirmación de contraseña son iguales
      if ($request->password==$request->password_confirmation) {
        //Modificamos la tabla personas
        \DB::table('personas')
            ->where('id_persona', $request->id_persona)
            ->update(['name' => $request->name,
                    'lastname' => $request->lastname,
                    'edad' => $request->edad,
                    'sexo' => $request->sexo,
                    'updated_at' => $date = Carbon::now(),
                    ]);

          //Modificamos la tabla personas
          \DB::table('empresarios_cajeros')
              ->where('email', $request->email)
              ->update(['password' => bcrypt($request->password),
                      'updated_at' => $date = Carbon::now(),
                      ]);

        $mensaje = "Usuario Modificado con Éxito";
        return view('partials.exitoso',compact('mensaje'));
      }
      else {
        $mensaje = "Las contraseñas no coinciden.";
        return view('partials.error',compact('mensaje'));
      }
    }

    //Función para ver usuarios y pulsar modificar
    public function verModificarUsuarios()
    {
      $ruta = "formularioModificarUsuario";
      $accion = "Modificar";
      $usuarios = \DB::table('empresarios_cajeros')
          ->select('email')
          ->get();
    	return view('admin.verUsuarios',compact('ruta', 'usuarios', 'accion'));
    }

    //Funcion para ver el formulario modificar usuario
    public function formularioModificarUsuario(Request $request)
    {
      //Seleccionamos todos los datos del usuario
      $usuario = \DB::table('empresarios_cajeros')
          ->where('email', $request->usuario)
          ->get();

      //Seleccionamos datos de la persona
      foreach ($usuario as $user) {
        $persona = \DB::table('personas')
            ->where('id_persona', $user->id_persona)
            ->get();
      }

      //Seleccionamos su rol;
      foreach ($usuario as $user) {
            $tipo_usuario = \DB::table('tipos_de_usuarios')
            ->where('id_tipo_usuario', $user->id_tipo_usuario)
            ->get();
      }

      //Tomamos todos los tipos de usuarios existentes
      $tipo_de_usuarios = \DB::table('tipos_de_usuarios')
            ->get();

      //Tomamos todas las ciudades
      $ciudades = \DB::table('ciudades')
            ->get();

      return view('admin.modificarUsuario',compact('usuario', 'persona', 'tipo_de_usuarios', 'tipo_usuario', 'ciudades'));
    }


      //Funcion para modificar usuario
      public function modificarUsuario(Request $request)
      {
        //Verificar si la contraseña y la confirmación de contraseña son iguales
        if ($request->password==$request->password_confirmation) {
          //Modificamos la tabla personas
          \DB::table('personas')
              ->where('id_persona', $request->id_persona)
              ->update(['name' => $request->name,
                      'lastname' => $request->lastname,
                      'edad' => $request->edad,
                      'sexo' => $request->sexo,
                      'id_ciudad' => $request->id_ciudad,
                      'updated_at' => $date = Carbon::now(),
                      ]);

            //Modificamos la tabla personas
            \DB::table('empresarios_cajeros')
                ->where('email', $request->email)
                ->update(['id_tipo_usuario' => $request->id_tipo_usuario,
                        'password' => bcrypt($request->password),
                        'activo' => $request->activo,
                        'updated_at' => $date = Carbon::now(),
                        ]);

          $mensaje = "Usuario Modificado con Éxito";
          return view('partials.exitoso',compact('mensaje'));
        }
        else {
          $mensaje = "Las contraseñas no coinciden.";
          return view('partials.error',compact('mensaje'));
        }
      }

      //Función para ver usuarios y pulsar borrar
      public function verBorrarUsuarios()
      {
        $ruta = "borrarUsuario";
        $accion = "Borrar";
        $usuarios = \DB::table('users')
            ->where('email',  '!=', 'Admin@hotmail.com')
            ->select('email')
            ->get();
      	return view('admin.verUsuarios',compact('ruta', 'usuarios', 'accion'));
      }

      //Funcion para modificar usuario
      public function borrarUsuario(Request $request)
      {
        \DB::table('users')->where('email', $request->usuario)->delete();
        $mensaje = "Usuario Borrado con Éxito";
        return view('partials.exitoso',compact('mensaje'));
      }
}
