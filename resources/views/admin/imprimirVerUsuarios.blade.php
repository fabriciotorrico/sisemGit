
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
      <h3 align=center>Usuarios de la Empresa {{$empresa}}</h3>
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
                  <th>E-Mail</th>
                  <th>Nombre(s)</th>
                  <th>Apellido(s)</th>
                  <th>Edad</th>
                  <th>Sexo</th>
                  <th>Tipo de Usuario</th>
                  <th>Activo</th>
                </tr>
              </thead>
              @foreach ($tabla as $t_u)
                  <tr class="gradeA" background-color= "#dddddd;">
                    <td>{{$t_u->email}}</td>
                    <td>{{$t_u->name}}</td>
                    <td>{{$t_u->lastname}}</td>
                    <td>{{$t_u->edad}}</td>
                    <td>{{$t_u->sexo}}</td>
                    <td>{{$t_u->tipo_usuario}}</td>
                    <td class="center">{{$t_u->activo}}</td>
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
