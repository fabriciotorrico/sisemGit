@extends('layouts.layout')
@section('content')

<div class="container">
        <div class="container-fluid">
          <div class="row-fluid">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                  <h5>Detalle de Cupones Canjeados de fecha {{$deFecha}} a fecha {{$aFecha}} </h5>
                </div>
                <div class="widget-content nopadding">
                  <table  id="tabla_tiempos_verde" class="table table-bordered data-table">
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
                        <tr class="gradeA">
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

      <div class="container-fluid">
        <div class="row-fluid">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Exportar Reporte en PDF</h5>
              </div>
              <div class="widget-content nopadding">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('imprimirDetalleDeVentas') }}">
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
