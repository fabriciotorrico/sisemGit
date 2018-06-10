@extends('layouts.layout')
@section('content')

<div class="container">
        <div class="container-fluid">
          <div class="row-fluid">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                  <h5>Cantidad Vendida de fecha {{$deFecha}} a fecha {{$aFecha}} </h5>
                </div>
                <div class="widget-content nopadding">
                  <table  id="tabla_tiempos_verde" class="table table-bordered data-table">
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

      <div class="container-fluid">
        <div class="row-fluid">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Exportar Reporte en PDF</h5>
              </div>
              <div class="widget-content nopadding">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('imprimirNumeroDeVentas') }}">
                    {{ csrf_field() }}

                  <input id="promocion" type="hidden" class="form-control" name="promocion" value="{{$promocion}}">
                  <input id="deFecha" type="hidden" class="form-control" name="deFecha" value="{{$deFecha}}">
                  <input id="aFecha" type="hidden" class="form-control" name="aFecha" value="{{$aFecha}}">

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
