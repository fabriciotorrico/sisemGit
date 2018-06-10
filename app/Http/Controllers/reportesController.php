<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class reportesController extends Controller
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

    public function imprimir (){
      //return \PDF::loadView('admin.inicio')->download('nombre-archivo.pdf');
      return \PDF::loadFile('http://www.github.com')->inline('github.pdf');
    }

    //Funcion para reporte de ver usuarios
    public function reporteVerUsuarios()
    {
      //Empleando joins construimos la tabla a mostrar
      $tabla = \DB::table('empresarios_cajeros')
            ->join('personas', 'empresarios_cajeros.id_persona', '=', 'personas.id_persona')
            ->join('tipos_de_usuarios', 'empresarios_cajeros.id_tipo_usuario', '=', 'tipos_de_usuarios.id_tipo_usuario')
            ->where('id_empresa', auth()->user()->id_empresa)
            ->select('empresarios_cajeros.email',
                     'personas.name',
                     'personas.lastname',
                     'personas.edad',
                     'personas.sexo',
                     'tipos_de_usuarios.tipo_usuario',
                     'empresarios_cajeros.activo'
                     )
            ->get();

      //Seleccionamos el nombre de la empresa
      $empresa = \DB::table('empresas')
            ->where('id_empresa', auth()->user()->id_empresa)
            ->value("nombre");

      return view('admin.reporteVerUsuarios',compact('tabla', 'empresa'));
    }

    //Funcion para ver los contratos existentes y generar el reporte de contratos
    public function reporteContratos()
    {
      //Seleccionamos los contratos existentes
      $contratos = \DB::table('contratos')
            ->get();
      return view('admin.reporteContratos',compact('contratos'));
    }

    //Funcion para descargar el contrato seleccionado (reporte contratos)
    public function descargarContrato(Request $request)
    {
      if(!$this->downloadFile("..\\archivos\\contratos\\".$request->nombre_archivo)){
        print '<script language="JavaScript">';
        print 'alert("Archivo no encontrado");';
        print '</script>';
      }
      //Seleccionamos los contratos existentes
      $contratos = \DB::table('contratos')
            ->get();
      return view('admin.reporteContratos',compact('contratos'));
    }


    //Funcion para descargar archivos
    protected function downloadFile($src){
      if(is_file($src)){
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $content_type = finfo_file($finfo, $src);
        finfo_close($finfo);
        $file_name = basename($src).PHP_EOL;
        $size = filesize($src);
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment; filename = $file_name");
        header("Content-Transfer-Encodign: binary");
        header("Content-Length: $size");
        readfile($src);
        return true;
      } else{
        return false;
      }
    }


    //Funcion para seleccionar el tipo de reporte de ventas
    public function seleccionarReporteDeVentas()
    {
      //Seleccionamos las promociones de la empresa
      $promociones = \DB::table('promociones')
            ->where('id_empresa', auth()->user()->id_empresa)
            ->select('nombre', 'codigo_promocion')
            ->get();
      return view('admin.seleccionarReporteDeVentas',compact('promociones'));
    }

    //Funcion para ver reporte de detalle de ventas
    public function reporteVerDetalleDeVentas(Request $request)
    {
      //Seleccionamos los cupones vendidos entre echas requeridas
      //Si selecciono ver todas las promociones
      if ($request->promocion == "todas") {
        $cupones = \DB::table('cupones')
            ->join('promociones', 'cupones.id_codigo_promocion', '=', 'promociones.codigo_promocion')
            ->join('personas', 'cupones.id_cajero', '=', 'personas.id_persona')
            ->where('promociones.id_empresa', auth()->user()->id_empresa)
            ->where('cupones.fecha_utilizado', '>=', $request->deFecha)
            ->where('cupones.fecha_utilizado', '<=', $request->aFecha)
            ->select('promociones.nombre', 'cupones.codigo_de_cupon', 'promociones.precio_promocion', 'promociones.precio_pagar',
                  'promociones.precio_promocion', 'cupones.fecha_utilizado', 'cupones.fecha_utilizado', 'personas.name', 'personas.lastname')
            ->get();
      }
      //Caso contrario, si selecciono una promocion en concreto
      else {
        $cupones = \DB::table('cupones')
            ->join('promociones', 'cupones.id_codigo_promocion', '=', 'promociones.codigo_promocion')
            ->join('personas', 'cupones.id_cajero', '=', 'personas.id_persona')
            ->where('promociones.id_empresa', auth()->user()->id_empresa)
            ->where('cupones.fecha_utilizado', '>=', $request->deFecha)
            ->where('cupones.fecha_utilizado', '<=', $request->aFecha)
            ->where('cupones.id_codigo_promocion', '=', $request->promocion)
            ->select('promociones.nombre', 'cupones.codigo_de_cupon', 'promociones.precio_promocion', 'promociones.precio_pagar',
                  'promociones.precio_promocion', 'cupones.fecha_utilizado', 'cupones.fecha_utilizado', 'personas.name', 'personas.lastname')
            ->get();
      }
      $deFecha=$request->deFecha;
      $aFecha=$request->aFecha;
      $promocion=$request->promocion;
      return view('admin.reporteVerDetalleDeVentas',compact('cupones', 'deFecha', 'aFecha', 'promocion'));
    }


    //Funcion para imprimir en pdf reporte de detalle de ventas
    public function imprimirDetalleDeVentas (Request $request)
    {
      //Datos de la tabla a imprimir
      //Seleccionamos los cupones vendidos entre echas requeridas
      //Si selecciono ver todas las promociones
      if ($request->promocion == "todas") {
        $cupones = \DB::table('cupones')
            ->join('promociones', 'cupones.id_codigo_promocion', '=', 'promociones.codigo_promocion')
            ->join('personas', 'cupones.id_cajero', '=', 'personas.id_persona')
            ->where('promociones.id_empresa', auth()->user()->id_empresa)
            ->where('cupones.fecha_utilizado', '>=', $request->deFecha)
            ->where('cupones.fecha_utilizado', '<=', $request->aFecha)
            ->select('promociones.nombre', 'cupones.codigo_de_cupon', 'promociones.precio_promocion', 'promociones.precio_pagar',
                  'promociones.precio_promocion', 'cupones.fecha_utilizado', 'cupones.fecha_utilizado', 'personas.name', 'personas.lastname')
            ->get();
      }
      //Caso contrario, si selecciono una promocion en concreto
      else {
        $cupones = \DB::table('cupones')
            ->join('promociones', 'cupones.id_codigo_promocion', '=', 'promociones.codigo_promocion')
            ->join('personas', 'cupones.id_cajero', '=', 'personas.id_persona')
            ->where('promociones.id_empresa', auth()->user()->id_empresa)
            ->where('cupones.fecha_utilizado', '>=', $request->deFecha)
            ->where('cupones.fecha_utilizado', '<=', $request->aFecha)
            ->where('cupones.id_codigo_promocion', '=', $request->promocion)
            ->select('promociones.nombre', 'cupones.codigo_de_cupon', 'promociones.precio_promocion', 'promociones.precio_pagar',
                  'promociones.precio_promocion', 'cupones.fecha_utilizado', 'cupones.fecha_utilizado', 'personas.name', 'personas.lastname')
            ->get();
      }
      $deFecha=$request->deFecha;
      $aFecha=$request->aFecha;

      //Seleccionamos el nombre de la empresa
      $empresa = \DB::table('empresas')
            ->where('id_empresa', auth()->user()->id_empresa)
            ->value("nombre");

      //Consultamos fecha para el nombre del archivo generado
      $date = Carbon::now();
      $fecha = $date->format('d-m-Y');
      $hora = $date->toTimeString();

      //Consultamos nombre, apellido y tipo de usuario para el pie de firma
      $nombre = \DB::table('personas')
            ->where('id_persona', auth()->user()->id_persona)
            ->value("name");
      $apellido = \DB::table('personas')
            ->where('id_persona', auth()->user()->id_persona)
            ->value("lastname");

      return \PDF::loadView('admin.imprimirDetalleDeVentas', compact( 'cupones', 'deFecha', 'aFecha', 'empresa', 'fecha', 'hora','nombre', 'apellido'))
      ->download('DetalleDeVentas_'.$empresa.'_'.$fecha.'.pdf');
    }


    //Funcion para ver reporte de detalle de ventas
    public function reporteVerNumeroDeVentas(Request $request)
    {
      //Seleccionamos los cupones vendidos entre echas requeridas
      //Si selecciono ver todas las promociones
      if ($request->promocion == "todas") {
        //Seleccionamos todas las promociones de la empresa
        $promociones = \DB::table('promociones')
            ->where('id_empresa', auth()->user()->id_empresa)
            ->select('codigo_promocion', 'nombre', 'precio_promocion', 'precio_pagar')
            ->get();
        //Creamos un array donde almacenar un registro por cada promocion, para la tabla a mostrar
        $tabla_array = [];

        //Para cada promocion existente en la empresa, llenamos la tabla con los valores requeridos
        foreach ($promociones as $promocion) {
          //Contamos la cantidad de cupones vendidos
          $cantidad_de_cupones = \DB::table('cupones')
              ->where('id_codigo_promocion', $promocion->codigo_promocion)
              ->where('utilizado', 1)
              ->where('fecha_utilizado', '>=', $request->deFecha)
              ->where('fecha_utilizado', '<=', $request->aFecha)
              ->count();

          //Calculamos el dinero ganado y el dinero Cobrado
          $dinero_ganado = $cantidad_de_cupones * $promocion->precio_promocion;
          $dinero_cobrado = $cantidad_de_cupones * $promocion->precio_pagar;

          //Introducimos los datos de cada columna
          $tabla_array[] = [
                      'promocion' => $promocion->nombre,
                      'precio_promocion' => $promocion->precio_promocion,
                      'precio_pagar' => $promocion->precio_pagar,
                      'cantidad' => $cantidad_de_cupones,
                      'dinero_ganado' => $dinero_ganado,
                      'dinero_cobrado' => $dinero_cobrado
                  ];
        }
        $tabla_json = json_encode($tabla_array);
      }

      //Caso contrario, si selecciono una promocion en concreto
      else {
        //Seleccionamos todas las promociones de la empresa
        $promociones = \DB::table('promociones')
            ->where('codigo_promocion', $request->promocion)
            ->select('codigo_promocion', 'nombre', 'precio_promocion', 'precio_pagar')
            ->get();

        //Creamos un array donde almacenar un registro por cada promocion, para la tabla a mostrar
        $tabla_array = [];

        //Para cada promocion existente en la empresa, llenamos la tabla con los valores requeridos
        foreach ($promociones as $promocion) {
          //Contamos la cantidad de cupones vendidos
          $cantidad_de_cupones = \DB::table('cupones')
              ->where('id_codigo_promocion', $promocion->codigo_promocion)
              ->where('utilizado', 1)
              ->where('fecha_utilizado', '>=', $request->deFecha)
              ->where('fecha_utilizado', '<=', $request->aFecha)
              ->count();

          //Calculamos el dinero ganado y el dinero Cobrado
          $dinero_ganado = $cantidad_de_cupones * $promocion->precio_promocion;
          $dinero_cobrado = $cantidad_de_cupones * $promocion->precio_pagar;

          //Introducimos los datos de cada columna
          $tabla_array[] = [
                      'promocion' => $promocion->nombre,
                      'precio_promocion' => $promocion->precio_promocion,
                      'precio_pagar' => $promocion->precio_pagar,
                      'cantidad' => $cantidad_de_cupones,
                      'dinero_ganado' => $dinero_ganado,
                      'dinero_cobrado' => $dinero_cobrado
                  ];
        }
        $tabla_json = json_encode($tabla_array);
      }
      $deFecha=$request->deFecha;
      $aFecha=$request->aFecha;
      $promocion=$request->promocion;
      return view('admin.reporteVerNumeroDeVentas',compact('tabla_json', 'deFecha', 'aFecha', 'promocion'));
    }


    //Funcion para imprimir en pdf reporte de numero de ventas
    public function imprimirNumeroDeVentas (Request $request)
    {
      //Datos de la tabla a imprimir
      //Seleccionamos los cupones vendidos entre echas requeridas
      //Si selecciono ver todas las promociones
      if ($request->promocion == "todas") {
        //Seleccionamos todas las promociones de la empresa
        $promociones = \DB::table('promociones')
            ->where('id_empresa', auth()->user()->id_empresa)
            ->select('codigo_promocion', 'nombre', 'precio_promocion', 'precio_pagar')
            ->get();
        //Creamos un array donde almacenar un registro por cada promocion, para la tabla a mostrar
        $tabla_array = [];

        //Para cada promocion existente en la empresa, llenamos la tabla con los valores requeridos
        foreach ($promociones as $promocion) {
          //Contamos la cantidad de cupones vendidos
          $cantidad_de_cupones = \DB::table('cupones')
              ->where('id_codigo_promocion', $promocion->codigo_promocion)
              ->where('utilizado', 1)
              ->where('fecha_utilizado', '>=', $request->deFecha)
              ->where('fecha_utilizado', '<=', $request->aFecha)
              ->count();

          //Calculamos el dinero ganado y el dinero Cobrado
          $dinero_ganado = $cantidad_de_cupones * $promocion->precio_promocion;
          $dinero_cobrado = $cantidad_de_cupones * $promocion->precio_pagar;

          //Introducimos los datos de cada columna
          $tabla_array[] = [
                      'promocion' => $promocion->nombre,
                      'precio_promocion' => $promocion->precio_promocion,
                      'precio_pagar' => $promocion->precio_pagar,
                      'cantidad' => $cantidad_de_cupones,
                      'dinero_ganado' => $dinero_ganado,
                      'dinero_cobrado' => $dinero_cobrado
                  ];
        }
        $tabla_json = json_encode($tabla_array);
      }

      //Caso contrario, si selecciono una promocion en concreto
      else {
        //Seleccionamos todas las promociones de la empresa
        $promociones = \DB::table('promociones')
            ->where('codigo_promocion', $request->promocion)
            ->select('codigo_promocion', 'nombre', 'precio_promocion', 'precio_pagar')
            ->get();

        //Creamos un array donde almacenar un registro por cada promocion, para la tabla a mostrar
        $tabla_array = [];

        //Para cada promocion existente en la empresa, llenamos la tabla con los valores requeridos
        foreach ($promociones as $promocion) {
          //Contamos la cantidad de cupones vendidos
          $cantidad_de_cupones = \DB::table('cupones')
              ->where('id_codigo_promocion', $promocion->codigo_promocion)
              ->where('utilizado', 1)
              ->where('fecha_utilizado', '>=', $request->deFecha)
              ->where('fecha_utilizado', '<=', $request->aFecha)
              ->count();

          //Calculamos el dinero ganado y el dinero Cobrado
          $dinero_ganado = $cantidad_de_cupones * $promocion->precio_promocion;
          $dinero_cobrado = $cantidad_de_cupones * $promocion->precio_pagar;

          //Introducimos los datos de cada columna
          $tabla_array[] = [
                      'promocion' => $promocion->nombre,
                      'precio_promocion' => $promocion->precio_promocion,
                      'precio_pagar' => $promocion->precio_pagar,
                      'cantidad' => $cantidad_de_cupones,
                      'dinero_ganado' => $dinero_ganado,
                      'dinero_cobrado' => $dinero_cobrado
                  ];
        }
        $tabla_json = json_encode($tabla_array);
      }

      $deFecha=$request->deFecha;
      $aFecha=$request->aFecha;

      //Seleccionamos el nombre de la empresa
      $empresa = \DB::table('empresas')
            ->where('id_empresa', auth()->user()->id_empresa)
            ->value("nombre");

      //Consultamos fecha para el nombre del archivo generado
      $date = Carbon::now();
      $fecha = $date->format('d-m-Y');
      $hora = $date->toTimeString();

      //Consultamos nombre, apellido y tipo de usuario para el pie de firma
      $nombre = \DB::table('personas')
            ->where('id_persona', auth()->user()->id_persona)
            ->value("name");
      $apellido = \DB::table('personas')
            ->where('id_persona', auth()->user()->id_persona)
            ->value("lastname");

      return \PDF::loadView('admin.imprimirNumeroDeVentas', compact( 'tabla_json', 'deFecha', 'aFecha', 'empresa', 'fecha', 'hora','nombre', 'apellido'))
      ->download('CantidadVendida_'.$empresa.'_'.$fecha.'.pdf');
    }




    //Funcion para imprimir reporte de usuarios existentes en pdf
    public function imprimirVerUsuarios (Request $request)
    {
      //Empleando joins construimos la tabla a mostrar
      $tabla = \DB::table('empresarios_cajeros')
            ->join('personas', 'empresarios_cajeros.id_persona', '=', 'personas.id_persona')
            ->join('tipos_de_usuarios', 'empresarios_cajeros.id_tipo_usuario', '=', 'tipos_de_usuarios.id_tipo_usuario')
            ->where('id_empresa', auth()->user()->id_empresa)
            ->select('empresarios_cajeros.email',
                     'personas.name',
                     'personas.lastname',
                     'personas.edad',
                     'personas.sexo',
                     'tipos_de_usuarios.tipo_usuario',
                     'empresarios_cajeros.activo'
                     )
            ->get();

      //Seleccionamos el nombre de la empresa
      $empresa = \DB::table('empresas')
            ->where('id_empresa', auth()->user()->id_empresa)
            ->value("nombre");

      //Consultamos fecha para el nombre del archivo generado
      $date = Carbon::now();
      $fecha = $date->format('d-m-Y');
      $hora = $date->toTimeString();

      //Consultamos nombre, apellido y tipo de usuario para el pie de firma
      $nombre = \DB::table('personas')
            ->where('id_persona', auth()->user()->id_persona)
            ->value("name");
      $apellido = \DB::table('personas')
            ->where('id_persona', auth()->user()->id_persona)
            ->value("lastname");

      return \PDF::loadView('admin.imprimirVerUsuarios', compact( 'tabla', 'empresa', 'fecha', 'hora','nombre', 'apellido'))
      ->download('Usuarios_'.$empresa.'_'.$fecha.'.pdf');
    }

    //Función para descargar archivo de matlab de 2 fases
    public function descargarYsubir2fases(Request $request)
    {
      //Si el boton que se pulso en el formulario es descargar, descargara el archivo
      if($request->botonPulsado=="descargar")
      {
        if(!$this->downloadFile("..\\archivos\\contratos\\Proyecto_Fabian.pdf")){
          print '<script language="JavaScript">';
          print 'alert("Archivo no encontrado");';
          print '</script>';
        }
      }

      //Si el boton que se pulso en el formulario es subir, subira el archivo
      if($request->botonPulsado=="subir")
      {
        //Ejecutar la funcion para subir archvos y guardar resultados
        list($resultado, $mensaje)=$this->uploadFile("..\\public\\codigoMatlabLogicaDifusa/", "logicaDifusaSisemDosFases.m");

        //Mostrar en alerta el mensaje correspondiente
          print '<script language="JavaScript">';
          print 'alert("'.$mensaje.'");';
          print '</script>';
      }
      return view('admin.subirCodigoMatlab');
    }















    //Funcion ver la tabla de asignacion de tiempos
    public function verAsignacionTiempos()
    {
      $tabla = \DB::table('tiempos_verde')
            ->join('intersecciones', 'tiempos_verde.id_interseccion', '=', 'intersecciones.id_interseccion')
            ->join('horarios', 'tiempos_verde.id_horario', '=', 'horarios.id_horario')
            ->select('intersecciones.descripcion as interseccion', 'tiempos_verde.fase', 'horarios.descripcion as horario', 'tiempos_verde.tiempo_verde')
            ->get();
      //echo $tabla;
      return view('admin.verAsignacionTiempos',compact('tabla'));
    }

    //Funcion para seleccionar interseccion y dia para el reporte de afluencia vehicular
    public function formularioSeleccionarInterseccionDia(){

      //Obtenemos las intersecciones existentes para graficarlas
      $intersecciones = \DB::table('intersecciones')->get();

      //Obtenemos los dias existentes
      $horarios = \DB::table('horarios')->get();

      return view('admin.formularioSeleccionarInterseccionDia',compact('intersecciones', 'horarios'));
    }

    //Funcion para ver afluencia vehicular
    public function verAfluenciaVehicular(Request $request)
    {
      //Asignamos el nombre de la interseccion a mostrar en el titulo del grafico
      $id_interseccion=\DB::table('Intersecciones')
                  ->where('id_interseccion', $request->id_interseccion)
                  ->value('id_interseccion');

      //Obtenemos tambienel dia en ingles para pasarla a la vista, a partir de la cual se generara el pdf
      $dia_ingles = $request->dia;

      //Si el id de intreseccion que introducimos no corresponde a ninguno registrado, la variable $id_interseccion estara vacio, por tanto mostramos el error
      if ($id_interseccion == "") {
        $mensaje = "El id de la intersección introducida no corresponde a ninguna registrada, por favor verifique el campo 'Intersección' para generar el reporte.";
        return view('partials.error',compact('mensaje'));
      }
      else {
        //Asignamos el nombre de la interseccion a mostrar en el titulo del grafico
        $interseccion=\DB::table('Intersecciones')
                    ->where('id_interseccion', $request->id_interseccion)
                    ->value('descripcion');

        //Asignamos a la variable dia el dia en español
        if ($request->dia=="Monday") {$dia="Lunes";}
        elseif ($request->dia=="Tuesday") {$dia="Martes";}
        elseif ($request->dia=="Wednesday") {$dia="Miércoles";}
        elseif ($request->dia=="Thursday") {$dia="Jueves";}
        elseif ($request->dia=="Friday") {$dia="Viernes";}
        elseif ($request->dia=="Saturday") {$dia="Sábado";}
        elseif ($request->dia=="Sunday") {$dia="Domingo";}

        //Obtenemos los semaforos que pertenecen a la fase requerida
        $semaforos = \DB::table('semaforos')
                    ->where('id_interseccion', $request->id_interseccion)
                    ->get();

        //Join de tablas horarios y promedios_afluencia, que seran los datos a graficar
        $datos = \DB::table('promedios_afluencia')
              ->join('horarios', 'promedios_afluencia.id_horario', '=', 'horarios.id_horario')
              ->where('dia', $request->dia)
              ->select('horarios.id_horario', 'horarios.de_horas', 'horarios.a_horas', 'promedios_afluencia.ip_sensor', 'promedios_afluencia.promedio_de_vehiculos')
              ->get();

        //Verificamos que existan registros para el dia e interseccion seleccionados
        $existe = false;
        foreach ($semaforos as $semaforo) {
          foreach ($datos as $dato)
          {
            if ($semaforo->ip_sensor == $dato->ip_sensor) $existe=true;
          }
        }

        //Si no existen datos registrados para la interseccion seleccionada, la variable $existe no habra cambiado a true, por tanto:
        if (!$existe) {
          $mensaje = "No existen datos registrados para la intersección y día seleccionado, por favor elija otra opción.";
          return view('partials.error',compact('mensaje'));
        }
        else {
          return view('admin.verAfluenciaVehicular',compact('id_interseccion', 'dia_ingles','interseccion', 'dia', 'semaforos', 'datos'));
        }
      }
    }

    //Funcion para generar reporte en pdf
    public function reporteAsignacionDeTiempos (Request $request){
          $interseccion = $request->interseccion;
          $date = Carbon::now();
          $fecha = $date->format('d-m-Y');
          $hora = $date->toTimeString();
          $tabla = \DB::table('tiempos_verde')
                ->join('intersecciones', 'tiempos_verde.id_interseccion', '=', 'intersecciones.id_interseccion')
                ->join('horarios', 'tiempos_verde.id_horario', '=', 'horarios.id_horario')
                ->where('intersecciones.descripcion', $request->interseccion)
                ->select('intersecciones.descripcion as interseccion', 'tiempos_verde.fase', 'horarios.descripcion as horario', 'tiempos_verde.tiempo_verde')
                ->get();
          $nombre = auth()->user()->name;
          $apellido = auth()->user()->lastname;
          $tipo_usuario = \DB::table('tipos_de_usuarios')
              ->where('id_tipo_usuario',auth()->user()->id_tipo_usuario)
              ->value('tipo_usuario');
          return \PDF::loadView('admin.reporteAsignacionDeTiempos', compact('interseccion', 'fecha', 'hora', 'tabla','nombre', 'apellido', 'tipo_usuario'))
          ->download('asignacionDeTiempos_'.$interseccion.'.pdf');
    }

    //Funcion para generar reporte en pdf
    public function reporteAfluenciaVehicular(Request $request)
    {
      //Asignamos el nombre de la interseccion a mostrar en el titulo del grafico
      $id_interseccion=\DB::table('Intersecciones')
                  ->where('id_interseccion', $request->id_interseccion)
                  ->value('id_interseccion');

      $dia_ingles = $request->dia_ingles;

     //Asignamos el nombre de la interseccion a mostrar en el titulo del grafico
        $interseccion=\DB::table('Intersecciones')
                    ->where('id_interseccion', $request->id_interseccion)
                    ->value('descripcion');

        //Asignamos a la variable dia el dia en español
        if ($request->dia_ingles=="Monday") {$dia="Lunes";}
        elseif ($request->dia=="Tuesday") {$dia="Martes";}
        elseif ($request->dia_ingles=="Wednesday") {$dia="Miércoles";}
        elseif ($request->dia_ingles=="Thursday") {$dia="Jueves";}
        elseif ($request->dia_ingles=="Friday") {$dia="Viernes";}
        elseif ($request->dia_ingles=="Saturday") {$dia="Sábado";}
        elseif ($request->dia_ingles=="Sunday") {$dia="Domingo";}

        //Obtenemos los semaforos que pertenecen a la fase requerida
        $semaforos = \DB::table('semaforos')
                    ->where('id_interseccion', $request->id_interseccion)
                    ->get();

        //Join de tablas horarios y promedios_afluencia, que seran los datos a graficar
        $datos = \DB::table('promedios_afluencia')
              ->join('horarios', 'promedios_afluencia.id_horario', '=', 'horarios.id_horario')
              ->where('dia', $request->dia_ingles)
              ->select('horarios.id_horario', 'horarios.de_horas', 'horarios.a_horas', 'promedios_afluencia.ip_sensor', 'promedios_afluencia.promedio_de_vehiculos')
              ->get();

        //Verificamos que existan registros para el dia e interseccion seleccionados
        $existe = false;
        foreach ($semaforos as $semaforo) {
          foreach ($datos as $dato)
          {
            if ($semaforo->ip_sensor == $dato->ip_sensor) $existe=true;
          }
        }

        //Si no existen datos registrados para la interseccion seleccionada, la variable $existe no habra cambiado a true, por tanto:
        if (!$existe) {
          $mensaje = "No existen datos registrados para la intersección y día seleccionado, por favor elija otra opción.";
          return view('partials.error',compact('mensaje'));
        }
        else {
          $nombre = auth()->user()->name;
          $apellido = auth()->user()->lastname;
          $tipo_usuario = \DB::table('tipos_de_usuarios')
              ->where('id_tipo_usuario',auth()->user()->id_tipo_usuario)
              ->value('tipo_usuario');
          $date = Carbon::now();
          $fecha = $date->format('d-m-Y');
          $hora = $date->toTimeString();

          return \PDF::loadView('admin.reporteAfluenciaVehicular',compact('fecha', 'hora', 'id_interseccion', 'dia_ingles','interseccion', 'dia', 'semaforos', 'datos', 'nombre', 'apellido', 'tipo_usuario'))
              ->download('afluenciaVehicular_'.$interseccion.'.pdf');

          /*return \PDF::loadView('admin.reporteAfluenciaVehicular',compact('id_interseccion', 'dia_ingles','interseccion', 'dia', 'semaforos', 'datos', 'nombre', 'apellido', 'tipo_usuario'))
          ->setOption('enable-javascript', true)
          ->setOption('javascript-delay', 13500)
          ->setOption('enable-smart-shrinking', true)
          ->setOption('no-stop-slow-scripts', true)
          ->download('afluenciaVehicular_'.$interseccion.'.pdf');*/

  //        return view('admin.reporteAfluenciaVehicular',compact('id_interseccion', 'dia_ingles','interseccion', 'dia', 'semaforos', 'datos'));
        }
    }
}
