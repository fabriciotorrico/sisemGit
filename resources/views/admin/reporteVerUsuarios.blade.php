@extends('layouts.layout')

@section('content')

<div class="container">
        <div class="container-fluid">
          <div class="row-fluid">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                  <h5>Usuarios Creados - Empresa: {{$empresa}}</h5>
                </div>
                <div class="widget-content nopadding">
                  <table  id="tabla_tiempos_verde" class="table table-bordered data-table">
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
                    @foreach ($tabla as $t_v)
                        <tr class="gradeA">
                          <td>{{$t_v->email}}</td>
                          <td>{{$t_v->name}}</td>
                          <td>{{$t_v->lastname}}</td>
                          <td>{{$t_v->edad}}</td>
                          <td>{{$t_v->sexo}}</td>
                          <td>{{$t_v->tipo_usuario}}</td>
                          <td>
                            @if ($t_v->activo==1)
                              Si
                            @else
                              No
                            @endif
                          </td>
                        </tr>
                      </form>
                    @endforeach
                  </table>
                </div>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row-fluid">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Exportar Reporte en PDF</h5>
              </div>
              <div class="widget-content nopadding">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('imprimirVerUsuarios') }}">
                    {{ csrf_field() }}
                  <div class="form-actions">
                    <button type="submit" class="btn btn-success">Imprimir Reporte</button>
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.uniform.js"></script>

<script src="js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>

<script src="js/matrix.tables.js"></script>

<script src="js/matrix.dashboard.js"></script>

@endsection
