@extends('layouts.layout')
@section('content')
<div class="container">
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5>Detalle de Ventas</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('reporteVerDetalleDeVentas') }}">
              {{ csrf_field() }}

            <label class="control-label">Promoción: </label>
            <div class="controls">
              <select name="promocion">
                <option value="todas"> Todas las Promociones </option>
                @foreach($promociones as $promocion)
                  <option value="{{$promocion->codigo_promocion}}"> {{$promocion->nombre}} </option>
                @endforeach
              </select>
            </div>

            <label class="control-label">De Fecha: </label>
            <div class="controls">
                <input type="date" name="deFecha" required autofocus>
            </div>

            <label class="control-label">A Fecha: </label>
            <div class="controls">
              <input type="date" name="aFecha" required autofocus>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-success">Generar Reporte</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5>Número de Ventas</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('reporteVerNumeroDeVentas') }}">
              {{ csrf_field() }}

            <label class="control-label">Promoción: </label>
            <div class="controls">
              <select name="promocion">
                <option value="todas"> Todas las Promociones </option>
                @foreach($promociones as $promocion)
                  <option value="{{$promocion->codigo_promocion}}"> {{$promocion->nombre}} </option>
                @endforeach
              </select>
            </div>

            <label class="control-label">De Fecha: </label>
            <div class="controls">
                <input type="date" name="deFecha" required autofocus>
            </div>

            <label class="control-label">A Fecha: </label>
            <div class="controls">
              <input type="date" name="aFecha" required autofocus>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-success">Generar Reporte</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection
