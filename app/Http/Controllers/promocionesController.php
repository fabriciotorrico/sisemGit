<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class promocionesController extends Controller
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

      //Funcion para ver promociones disponbiles a ser usadas
      public function verPromociones()
      {
        //Seleccionamos las categorías existentes
        $categorias = \DB::table('categorias')
              ->select('id', 'nombre_de_categoria')
              ->get();

        //Seleccionamos las promociones que tiene la empresa
        $promociones = \DB::table('promociones')
              ->where('id_empresa', auth()->user()->id_empresa)
              ->get();

        //PARA PRODUCCIÓN VERIFICAR QUE ESTÉ ACTIVO, Y QUE SE PUEDA COPRAR SEGÚN EL DÍA Y LA HORA

        return view('admin.verPromociones', compact('categorias', 'promociones'));
      }

      //Funcion para ver el formulario de introducir un cupón de un cliente
      public function formularioIntroducirCupon(Request $request)
      {
        $id_codigo_promocion = $request->id_codigo_promocion;
        $imagen = $request->imagen;
        $nombre = $request->nombre;
        $precio_pagar = $request->precio_pagar;
        return view('admin.formularioIntroducirCupon', compact('id_codigo_promocion', 'imagen', 'nombre', 'precio_pagar'));
      }

      //Funcion para introducir un cupón de un cliente
      public function introducirCupon(Request $request)
      {
        //Verificamos si el cupón existe y si fue o no utlizado
        $utilizado = \DB::table('cupones')
              ->where('id_codigo_promocion', $request->id_codigo_promocion)
              ->where('codigo_de_cupon', $request->codigo_cupon)
              ->value('utilizado');


        //Si no existe el cupon
        if ($utilizado != 0 && $utilizado != 1 ) {

        }



          //Si el cupon ya fue usado, es decir utilizado es 1
          if ($utilizado == "1") {
            //Seleccionamos el cupon
            $cupon = \DB::table('cupones')
                  ->where('id_codigo_promocion', $request->id_codigo_promocion)
                  ->where('codigo_de_cupon', $request->codigo_cupon)
                  ->get();
            //Tomamos fecha e id cajero del cupon utlizado
            foreach ($cupon as $cupon) {
              $fecha_utilizado = $cupon->fecha_utilizado;
              $id_cajero = $cupon->id_cajero;
            }
            $fecha = substr($fecha_utilizado, 0, 10);
            $hora = substr($fecha_utilizado, 11, 18);

            //Tomamos los datos del cajero
            $cajero = \DB::table('empresarios_cajeros')
                  ->where('id', $id_cajero)
                  ->get();

            //Tomamos la persona del cajero y la empresa donde fue canjeado
            foreach ($cajero as $cajero) {
              $persona = \DB::table('personas')
                    ->where('id_persona', $cajero->id_persona)
                    ->get();
              $empresa = \DB::table('empresas')
                          ->where('id_empresa', $cajero->id_empresa)
                          ->get();
            }

            //Tomamos el nombre y apellido del empresario
            foreach ($persona as $person) {
              $nombre = $person->name;
              $apellido = $person->lastname;
            }

            //Tomamos el nombre de la empresa
            foreach ($empresa as $empresa) {
              $nombre_empresa = $empresa->nombre;
            }

            $mensaje = "El cupón fue canjeado en fecha ". $fecha . ", a horas " . $hora .
                      ", por el cajero ". $nombre . " " . $apellido . " de " . $nombre_empresa;
            return view('partials.error',compact('mensaje'));
          }
          else {
            //En caso de no haber sido utilizado, es decir utilizado es 0
            if ($utilizado == "0") {
              //Actualizamos el cupon
              \DB::table('cupones')
                  ->where('id_codigo_promocion', $request->id_codigo_promocion)
                  ->where('codigo_de_cupon', $request->codigo_cupon)
                  ->update(['utilizado' => "1",
                            'fecha_utilizado' => $date = Carbon::now(),
                            'id_cajero' => auth()->user()->id,
                            'updated_at' => $date = Carbon::now()
                          ]);
              $mensaje = "Cupón canjeado con éxito, favor entregar producto.";
              return view('partials.exitoso',compact('mensaje'));
            }
            //Caso contario, (que no sea 1 ni 0), ¡revisar la base de datos!
            else {
              $mensaje = "El cupón no existe, probalemente el usuario no compró el mismo o hubo un error
                          al introducir el código.";
              return view('partials.error',compact('mensaje'));
            }
          }
      }
}
