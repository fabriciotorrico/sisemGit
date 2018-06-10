<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registroUsuarioExitoso';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:empresarios_cajeros',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      if ($data['password']==$data['password_confirmation']) {

        //Seleccionamos el id ciudad del usuario actual, que será el empresario que creará un nuevo usuario
        $id_ciudad = \DB::table('personas')
            ->where('id_persona', auth()->user()->id_persona)
            ->value("id_ciudad");

        //Crear registro en la tabla personas
          $usuario = \DB::table('personas')->insert([
                      'name' => $data['name'],
                      'lastname' => $data['lastname'],
                      'id_ciudad' => $id_ciudad,
                      'created_at' => $date = Carbon::now(),
                      'updated_at' => $date = Carbon::now(),
                     ]);

        //Obtener el id del usuario registrado (que es el ultimo)
          $ultimo_registro = \DB::table('personas')->orderBy('id_persona', 'DESC')->first();
          $id_persona = $ultimo_registro->id_persona;

        //Registrar el nuevo usuario en la tabla empresarios_cajeros
          \DB::table('empresarios_cajeros')->insert([
              'id_empresa' => auth()->user()->id_empresa,
              'id_persona' => $id_persona,
              'id_tipo_usuario' => $data['id_tipo_usuario'],
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              'created_at' => $date = Carbon::now(),
              'updated_at' => $date = Carbon::now(),
          ]);

            $mensaje = "Usuario Registrado con Éxito.";
            return view('partials.exitoso',compact('mensaje'));
      }
      else {
        $mensaje = "Las contraseñas no coinciden.";
        return view('partials.error',compact('mensaje'));
      }
    }
}
