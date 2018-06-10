
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
    <td WIDTH="25%">
      <p align=center><img src={{ asset('/img/logo_groupon.png') }} alt="Logo" /></p>
    </td>
    <th WIDTH="50%">
      <h3 align=center>Detalle de Ventas de la Empresa {{$empresa}}</h3>
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
                  <th>Código del Cupón</th>
                  <th>Precio de Promoción (Bs.)</th>
                  <th>Precio Cobrado (Bs.)</th>
                  <th>Personal que realizó el canje</th>
                  <th>Fecha de Canje</th>
                  <th>Hora de Canje</th>
                </tr>
              </thead>
              @foreach ($cupones as $cupon)
                <tr class="gradeA" background-color= "#dddddd;">
                  <td>{{$cupon->nombre}}</td>
                  <td>{{$cupon->codigo_de_cupon}}</td>
                  <td>{{$cupon->precio_promocion}}</td>
                  <td>{{$cupon->precio_pagar}}</td>
                  <td>{{$cupon->name.' '.$cupon->lastname}}</td>
                  <td>{{substr($cupon->fecha_utilizado, 0, 10)}}</td>
                  <td>{{substr($cupon->fecha_utilizado, 11, 18)}}</td>
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
