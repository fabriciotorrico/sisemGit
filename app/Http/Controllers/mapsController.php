<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mapsController extends Controller
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



    //Función para ubicacion de semaforos en el mapa
    public function ubiSemaforos()
    {
    	$semaforos = \DB::table('semaforos')->get();
    	return view('admin.ubicacionSemaforos',compact('semaforos'));
    }

    //Función para nuevo semaforos en el mapa
    public function nuevoSemaforo()
    {
    	$semaforos = \DB::table('semaforos')->get();
    	return view('admin.nuevoSemaforo',compact('semaforos'));
    }
}
