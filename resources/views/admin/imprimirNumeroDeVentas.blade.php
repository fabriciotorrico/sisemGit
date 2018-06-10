
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

<meta charset="UTF-8" />

<style>
tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

</head>

<body>


<table>
  <tr>
    <td WIDTH="5%">
      <p align=center><img src={{ asset('/img/logo_groupon.png') }} alt="Logo" /></p>
    </td>
    <th WIDTH="40%">
      <h3 align=center>Cantidad de Cupones Vendidos por la Empresa {{$empresa}}</h3>
      <p align=center>De Fecha: {{$deFecha}} - A Fecha: {{$aFecha}}</p>
      <p align=center>Fecha de emisión del reporte: {{$fecha}}</p>
      <p align=center>Hora de emisión del reporte: {{$hora}}</p>
    </th>
  </tr>
</table>


<br>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span3">
      </div>
      <div class="span-5">
        <div class="widget-box">
          <div class="widget-content nopadding">
            <table
            font-family="arial, sans-serif;"
            border="1 solid #dddddd"
            border-collaps=: "collapse;"
            width= "100%;"
            align=center id="tabla_usuarios" >
              <thead>
                <tr>
                  <th>Promoción</th>
                  <th>Precio de Promoción (Bs.)</th>
                  <th>Precio Cobrado (Bs.)</th>
                  <th>Cantidad de cupones Canjeados</th>
                  <th>Dinero ganado de la promoción (Bs.)</th>
                  <th>Dinero cobrado de los cupones (Bs.)</th>
                </tr>
              </thead>
              @foreach (json_decode($tabla_json) as $tabla)
                  <tr class="gradeA">
                    <td>{{$tabla->promocion}}</td>
                    <td>{{$tabla->precio_promocion}}</td>
                    <td>{{$tabla->precio_pagar}}</td>
                    <td>{{$tabla->cantidad}}</td>
                    <td>{{$tabla->dinero_ganado}}</td>
                    <td>{{$tabla->dinero_cobrado}}</td>
                  </tr>
              @endforeach
            </table>
          </div>
    </div>
  </div>
  </div>
</div>

<br><br><br><br><br><br><br>
<HR align="CENTER" size="1" width="200" color="Red" noshade>
<p align=center>{{$apellido}} {{$nombre}}</p>
</body>
</html>
