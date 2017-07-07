<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class sensorsController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    //Servicio para asignar la cantidad de vehiculos registrada por los sensores
    public function contadorVehiculos(string $ip, int $vehiculos)
    {

      $date = Carbon::now();

     \DB::table('sensores')->insertGetId([
                'ip' => $ip,
                'vehiculos' => $vehiculos,
                'created_at' => $date,
                'updated_at' => $date
        ]);

      $vehiculos = \DB::table('sensores')
                ->where('ip', '=', $ip)
                //->value('vehiculos');
                -> get();
      /*-> update(['t_rojo' => $rojo,
                 't_amarillo' => $amarillo,
                 't_verde' => $verde]);*/
      return $vehiculos;
    }
}
